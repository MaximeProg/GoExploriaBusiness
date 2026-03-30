/**
 * Mega Menu Destinations pour le Menu Vertical
 * Gère l'affichage des destinations avec hiérarchie complète
 */

class VerticalDestinationsMegaMenu {
    constructor() {
        this.megaMenu = document.getElementById('verticalDestinationsMega');
        this.trigger = document.querySelector('.vertical-menu-v2-destinations-trigger');
        this.closeBtn = document.getElementById('closeVerticalDestinationsMega');
        this.loader = document.getElementById('vDestinationsLoader');
        this.grid = document.getElementById('vDestinationsGrid');
        this.empty = document.getElementById('vDestinationsEmpty');
        this.service = window.megaMenuService; // Utiliser le service existant
        this.isOpen = false;
        this.isLoaded = false;
        this.hideTimeout = null;
        
        this.init();
    }
    
    init() {
        if (!this.megaMenu || !this.trigger) {
            console.error('Éléments du mega menu destinations non trouvés');
            return;
        }
        
        if (!this.service) {
            console.error('MegaMenuService non disponible');
            return;
        }
        
        // Événements sur le trigger
        this.trigger.addEventListener('mouseenter', () => {
            this.cancelHide();
            this.show();
        });
        
        this.trigger.addEventListener('mouseleave', () => {
            this.scheduleHide();
        });
        
        // Événements sur le mega menu
        this.megaMenu.addEventListener('mouseenter', () => {
            this.cancelHide();
        });
        
        this.megaMenu.addEventListener('mouseleave', () => {
            this.scheduleHide();
        });
        
        // Bouton de fermeture
        if (this.closeBtn) {
            this.closeBtn.addEventListener('click', () => {
                this.hide();
            });
        }
    }
    
    async show() {
        this.cancelHide();
        
        if (this.isOpen) return;
        
        this.isOpen = true;
        this.megaMenu.classList.add('active');
        
        // Charger les destinations si pas encore chargées
        if (!this.isLoaded) {
            await this.loadDestinations();
        }
    }
    
    hide() {
        this.isOpen = false;
        this.megaMenu.classList.remove('active');
    }
    
    scheduleHide() {
        this.hideTimeout = setTimeout(() => {
            this.hide();
        }, 300);
    }
    
    cancelHide() {
        if (this.hideTimeout) {
            clearTimeout(this.hideTimeout);
            this.hideTimeout = null;
        }
    }
    
    async loadDestinations() {
        this.showLoader();
        
        try {
            // Charger UNIQUEMENT les continents (pas les pays)
            const continents = await this.service.getContinents();
            
            if (continents.length === 0) {
                this.showEmpty();
                return;
            }
            
            // Générer le HTML des continents SANS charger les pays
            this.renderContinents(continents);
            
            this.isLoaded = true;
            this.showGrid();
            
        } catch (error) {
            console.error('Erreur lors du chargement des destinations:', error);
            this.showEmpty();
        }
    }
    
    renderContinents(continents) {
        // Générer le HTML des continents SANS les pays (lazy loading)
        const html = continents.map(continent => 
            this.createContinentSection(continent, null)
        );
        
        this.grid.innerHTML = html.join('');
        
        // Ajouter les événements d'expansion avec lazy loading
        this.initSectionEvents();
    }
    
    createContinentSection(continent, countries) {
        const imageUrl = continent.image_url || continent.image || 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=400';
        
        // Si countries est null, c'est du lazy loading
        const isLazyLoad = countries === null;
        const countryCount = isLazyLoad ? '...' : countries.length;
        
        return `
            <div class="vmenu-dest-section" data-continent-id="${continent.id}" data-loaded="${!isLazyLoad}">
                <div class="vmenu-dest-section-header">
                    <img src="${imageUrl}" alt="${continent.name}" class="vmenu-dest-section-image" onerror="this.src='https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=400'">
                    <div class="vmenu-dest-section-info">
                        <h4 class="vmenu-dest-section-name">
                            ${continent.name}
                        </h4>
                        <p class="vmenu-dest-section-count">
                            ${isLazyLoad ? 'Cliquez pour explorer' : `${countryCount} pays`}
                        </p>
                    </div>
                    <svg class="vmenu-dest-section-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
                <div class="vmenu-dest-section-content">
                    <div class="vmenu-dest-section-list">
                        ${isLazyLoad ? '<div class="vmenu-dest-section-loader"><div class="vmenu-destinations-spinner"></div></div>' : countries.map(country => this.createDestinationItem(country, 'country')).join('')}
                    </div>
                </div>
            </div>
        `;
    }
    
    createDestinationItem(destination, type) {
        const imageUrl = destination.image_url || destination.image || this.getDefaultImage(type);
        const url = this.service.getDestinationUrl(destination);
        const typeName = this.getTypeName(type);
        
        return `
            <a href="${url}" class="vmenu-dest-item" data-destination-id="${destination.id}" data-type="${type}">
                <img src="${imageUrl}" alt="${destination.name}" class="vmenu-dest-item-image" onerror="this.src='${this.getDefaultImage(type)}'">
                <div class="vmenu-dest-item-info">
                    <h5 class="vmenu-dest-item-name">${destination.name}</h5>
                    <p class="vmenu-dest-item-type">${typeName}</p>
                </div>
            </a>
        `;
    }
    
    getDefaultImage(type) {
        const defaults = {
            continent: 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=400',
            country: 'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=400',
            province: 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400',
            region: 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=400',
            ville: 'https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?w=400',
            secteur: 'https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?w=400'
        };
        
        return defaults[type] || defaults.country;
    }
    
    getTypeName(type) {
        const names = {
            continent: 'Continent',
            country: 'Pays',
            province: 'Province',
            region: 'Région',
            ville: 'Ville',
            secteur: 'Secteur'
        };
        
        return names[type] || type;
    }
    
    initSectionEvents() {
        const sections = this.grid.querySelectorAll('.vmenu-dest-section-header');
        
        sections.forEach(header => {
            header.addEventListener('click', async (e) => {
                e.preventDefault();
                const section = header.closest('.vmenu-dest-section');
                const continentId = section.dataset.continentId;
                const isLoaded = section.dataset.loaded === 'true';
                
                // Si pas encore chargé, charger les pays (LAZY LOADING)
                if (!isLoaded) {
                    await this.loadCountriesForContinent(section, continentId);
                }
                
                // Toggle l'expansion
                section.classList.toggle('expanded');
            });
        });
    }
    
    async loadCountriesForContinent(section, continentId) {
        try {
            // Charger les pays pour ce continent uniquement
            const countries = await this.service.getCountriesByContinent(continentId);
            
            // Mettre à jour le contenu
            const listContainer = section.querySelector('.vmenu-dest-section-list');
            const countElement = section.querySelector('.vmenu-dest-section-count');
            
            if (countries.length > 0) {
                listContainer.innerHTML = countries.map(country => 
                    this.createDestinationItem(country, 'country')
                ).join('');
                countElement.textContent = `${countries.length} pays`;
            } else {
                listContainer.innerHTML = '<p style="padding: 20px; text-align: center; color: rgba(255,255,255,0.5);">Aucun pays disponible</p>';
                countElement.textContent = '0 pays';
            }
            
            // Marquer comme chargé
            section.dataset.loaded = 'true';
            
        } catch (error) {
            console.error(`Erreur chargement pays pour continent ${continentId}:`, error);
            const listContainer = section.querySelector('.vmenu-dest-section-list');
            listContainer.innerHTML = '<p style="padding: 20px; text-align: center; color: rgba(255,100,100,0.8);">Erreur de chargement</p>';
        }
    }
    
    showLoader() {
        this.loader.style.display = 'flex';
        this.grid.style.display = 'none';
        this.empty.style.display = 'none';
    }
    
    showGrid() {
        this.loader.style.display = 'none';
        this.grid.style.display = 'block';
        this.empty.style.display = 'none';
    }
    
    showEmpty() {
        this.loader.style.display = 'none';
        this.grid.style.display = 'none';
        this.empty.style.display = 'flex';
    }
}

// Initialiser quand le DOM est prêt
document.addEventListener('DOMContentLoaded', () => {
    if (window.megaMenuService) {
        window.verticalDestinationsMegaMenu = new VerticalDestinationsMegaMenu();
    } else {
        console.error('MegaMenuService non disponible pour le mega menu destinations vertical');
    }
});
