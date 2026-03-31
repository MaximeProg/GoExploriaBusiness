/**
 * Gestion du Mega Menu Destinations
 * Affiche les destinations hiérarchiques (Continents > Pays > Provinces > Régions > Villes)
 */

class DestinationsMegaMenu {
    constructor() {
        console.log('🔧 Initialisation DestinationsMegaMenu...');
        
        this.megaMenu = document.getElementById('destinationsMegaMenu');
        this.loader = document.getElementById('destinationsLoader');
        this.grid = document.getElementById('destinationsGrid');
        this.empty = document.getElementById('destinationsEmpty');
        this.breadcrumb = document.getElementById('destinationsBreadcrumb');
        this.trigger = null;
        this.service = window.megaMenuService;
        this.isOpen = false;
        this.hideTimeout = null;
        this.currentBreadcrumb = [];
        
        console.log('📍 Mega Menu trouvé:', !!this.megaMenu);
        console.log('📍 Service API trouvé:', !!this.service);
        
        this.init();
    }
    
    init() {
        if (!this.megaMenu) {
            console.error('❌ Mega Menu DOM element non trouvé (#destinationsMegaMenu)');
            return;
        }
        
        if (!this.service) {
            console.error('❌ MegaMenuService non disponible (window.megaMenuService)');
            return;
        }
        
        // Trouver le trigger (élément DESTINATIONS)
        this.trigger = document.querySelector('.search-bar-v2-destinations');
        
        console.log('📍 Trigger trouvé:', !!this.trigger);
        
        if (this.trigger) {
            // Événements sur le trigger
            this.trigger.addEventListener('mouseenter', () => {
                this.show();
            });
            this.trigger.addEventListener('mouseleave', () => this.scheduleHide());
            
            // Événements sur le mega menu
            this.megaMenu.addEventListener('mouseenter', () => this.cancelHide());
            this.megaMenu.addEventListener('mouseleave', () => this.scheduleHide());
        } else {
            console.error('Trigger non trouvé (.search-bar-v2-destinations)');
        }
    }
    
    async show() {
        console.log('📂 Affichage du mega menu...');
        this.cancelHide();
        
        if (this.isOpen) {
            console.log('ℹ️ Mega menu déjà ouvert');
            return;
        }
        this.isOpen = true;
        
        // Afficher le mega menu
        console.log('👁️ Affichage du mega menu DOM');
        this.megaMenu.style.display = 'block';
        setTimeout(() => {
            this.megaMenu.classList.add('active');
            console.log('✅ Classe "active" ajoutée');
        }, 10);
        
        // Charger les données si pas encore chargées
        if (this.grid.children.length === 0) {
            console.log('📥 Chargement des destinations...');
            await this.loadDestinations();
        } else {
            console.log('ℹ️ Destinations déjà chargées');
        }
    }
    
    scheduleHide() {
        this.hideTimeout = setTimeout(() => this.hide(), 300);
    }
    
    cancelHide() {
        if (this.hideTimeout) {
            clearTimeout(this.hideTimeout);
            this.hideTimeout = null;
        }
    }
    
    hide() {
        this.isOpen = false;
        this.megaMenu.classList.remove('active');
        this.resetBreadcrumb();
        setTimeout(() => {
            if (!this.isOpen) {
                this.megaMenu.style.display = 'none';
            }
        }, 300);
    }
    
    async loadDestinations() {
        this.showLoader();
        
        try {
            // Charger les continents
            const continents = await this.service.getContinents();
            
            if (continents.length === 0) {
                this.showEmpty();
                return;
            }
            
            // Générer le contenu
            await this.renderContinents(continents);
            
            this.showGrid();
        } catch (error) {
            console.error('Erreur lors du chargement des destinations:', error);
            this.showEmpty();
        }
    }
    
    async renderContinents(continents) {
        // Créer le container avec scroll horizontal
        const scrollContainer = document.createElement('div');
        scrollContainer.className = 'destinations-mega-menu-scroll-container';
        
        const horizontalContainer = document.createElement('div');
        horizontalContainer.className = 'destinations-mega-menu-horizontal';
        
        // Créer une colonne pour chaque continent SANS charger les pays
        // Les pays seront chargés au hover (lazy loading)
        continents.forEach((continent) => {
            const column = this.createContinentColumn(continent, []);
            horizontalContainer.appendChild(column);
        });
        
        scrollContainer.appendChild(horizontalContainer);
        this.grid.innerHTML = '';
        this.grid.appendChild(scrollContainer);
    }
    
    createContinentColumn(continent, countries) {
        const column = document.createElement('div');
        column.className = 'destinations-mega-continent-column';
        column.dataset.continentId = continent.id;
        column.dataset.loaded = 'false';
        
        // Header du continent avec image
        const header = document.createElement('div');
        header.className = 'destinations-mega-continent-header';
        
        const imageUrl = continent.image_url || continent.image || this.getDefaultImage('continent');
        
        header.innerHTML = `
            <img src="${imageUrl}" alt="${continent.name}" class="destinations-mega-continent-image" onerror="this.src='${this.getDefaultImage('continent')}'">
            <div class="destinations-mega-continent-info">
                <h3 class="destinations-mega-continent-name">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="2" y1="12" x2="22" y2="12"></line>
                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                    </svg>
                    ${continent.name}
                </h3>
                <p class="destinations-mega-continent-count">Survolez pour voir les pays</p>
            </div>
        `;
        
        // Événement hover sur le header du continent pour charger les pays
        header.addEventListener('mouseenter', async () => {
            this.updateBreadcrumb([continent]);
            
            // Charger les pays si pas encore chargés
            if (column.dataset.loaded === 'false') {
                await this.loadCountriesForContinent(column, continent);
            }
        });
        
        column.appendChild(header);
        
        // Liste des pays (vide au départ)
        const countriesList = document.createElement('div');
        countriesList.className = 'destinations-mega-countries-list';
        column.appendChild(countriesList);
        
        return column;
    }
    
    async loadCountriesForContinent(column, continent) {
        const countriesList = column.querySelector('.destinations-mega-countries-list');
        const countElement = column.querySelector('.destinations-mega-continent-count');
        
        // Afficher un loader
        countriesList.innerHTML = '<div class="destinations-mega-country-loader">Chargement...</div>';
        
        try {
            const countries = await this.service.getCountriesByContinent(continent.id);
            
            // Mettre à jour le compteur
            countElement.textContent = `${countries.length} ${countries.length > 1 ? 'pays' : 'pays'}`;
            
            // Limiter à 6 pays
            const displayCountries = countries.slice(0, 6);
            
            // Vider le loader
            countriesList.innerHTML = '';
            
            // Ajouter les pays
            displayCountries.forEach(country => {
                const countryItem = this.createCountryItem(country, continent);
                countriesList.appendChild(countryItem);
            });
            
            // Marquer comme chargé
            column.dataset.loaded = 'true';
        } catch (error) {
            console.error(`Erreur chargement pays pour ${continent.name}:`, error);
            countriesList.innerHTML = '<div class="destinations-mega-country-error">Erreur de chargement</div>';
        }
    }
    
    createCountryItem(country, continent) {
        const item = document.createElement('a');
        item.className = 'destinations-mega-country-item';
        item.href = this.service.getDestinationUrl(country);
        
        const imageUrl = country.image_url || country.image || this.getDefaultImage('country');
        
        item.innerHTML = `
            <img src="${imageUrl}" alt="${country.name}" class="destinations-mega-country-image" onerror="this.src='${this.getDefaultImage('country')}'">
            <div class="destinations-mega-country-info">
                <h4 class="destinations-mega-country-name">${country.name}</h4>
                <p class="destinations-mega-country-type">Pays</p>
            </div>
            <div class="destinations-mega-country-arrow">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>
        `;
        
        // Événement hover sur le pays
        item.addEventListener('mouseenter', () => {
            this.updateBreadcrumb([continent, country]);
        });
        
        return item;
    }
    
    getDefaultImage(type) {
        const defaults = {
            continent: 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=400',
            country: 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=400'
        };
        return defaults[type] || defaults.country;
    }
    
    getIconForType(type) {
        const icons = {
            continent: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>',
            country: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>',
            ville: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>'
        };
        return icons[type] || icons.ville;
    }
    
    showLoader() {
        this.loader.style.display = 'block';
        this.grid.style.display = 'none';
        this.empty.style.display = 'none';
    }
    
    showGrid() {
        this.loader.style.display = 'none';
        this.grid.style.display = 'grid';
        this.empty.style.display = 'none';
    }
    
    showEmpty() {
        this.loader.style.display = 'none';
        this.grid.style.display = 'none';
        this.empty.style.display = 'block';
    }
    
    updateBreadcrumb(destinations) {
        if (!this.breadcrumb) {
            console.error('❌ Élément breadcrumb non trouvé!');
            return;
        }
        
        if (!destinations || destinations.length === 0) {
            this.resetBreadcrumb();
            return;
        }
        
        // Générer le HTML du fil d'Ariane
        const breadcrumbHTML = destinations.map((dest, index) => {
            const separator = index > 0 ? '<span class="search-bar-v2-separator">/</span>' : '';
            const url = this.service.getDestinationUrl(dest);
            return `${separator}<a href="${url}" class="search-bar-v2-destinations-link">${dest.name}</a>`;
        }).join('');
        
        this.breadcrumb.innerHTML = breadcrumbHTML;
    }
    
    resetBreadcrumb() {
        if (!this.breadcrumb) return;
        this.breadcrumb.innerHTML = '<span class="search-bar-v2-destinations-link">Survolez pour explorer</span>';
    }
}

// Initialiser au chargement de la page
document.addEventListener('DOMContentLoaded', () => {
    console.log('🚀 DOMContentLoaded - Initialisation DestinationsMegaMenu');
    console.log('📍 window.megaMenuService disponible:', !!window.megaMenuService);
    
    // Attendre que le service soit chargé
    if (window.megaMenuService) {
        console.log('✅ Création de l\'instance DestinationsMegaMenu');
        window.destinationsMegaMenu = new DestinationsMegaMenu();
    } else {
        console.error('❌ MegaMenuService non disponible - Vérifier que mega-menu-service.js est chargé avant');
    }
});
