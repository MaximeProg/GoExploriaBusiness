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
            console.log('✅ Événements hover ajoutés sur le trigger');
            
            // Événements sur le trigger
            this.trigger.addEventListener('mouseenter', () => {
                console.log('🖱️ Hover sur DESTINATIONS');
                this.show();
            });
            this.trigger.addEventListener('mouseleave', () => this.scheduleHide());
            
            // Événements sur le mega menu
            this.megaMenu.addEventListener('mouseenter', () => this.cancelHide());
            this.megaMenu.addEventListener('mouseleave', () => this.scheduleHide());
        } else {
            console.error('❌ Trigger non trouvé (.search-bar-v2-destinations)');
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
        this.grid.innerHTML = '';
        
        // Limiter à 4 continents pour l'affichage
        const displayContinents = continents.slice(0, 4);
        
        for (const continent of displayContinents) {
            const column = await this.createContinentColumn(continent);
            this.grid.appendChild(column);
        }
    }
    
    async createContinentColumn(continent) {
        const column = document.createElement('div');
        column.className = 'destinations-mega-menu-column';
        
        // Titre du continent
        const title = document.createElement('div');
        title.className = 'destinations-mega-menu-column-title';
        title.textContent = continent.name;
        column.appendChild(title);
        
        // Conteneur des items
        const items = document.createElement('div');
        items.className = 'destinations-mega-menu-items';
        
        // Charger les pays du continent
        const countries = await this.service.getCountriesByContinent(continent.id);
        
        // Limiter à 8 pays
        const displayCountries = countries.slice(0, 8);
        
        displayCountries.forEach(country => {
            const item = this.createDestinationItem(country, 'country', continent);
            items.appendChild(item);
        });
        
        // Si plus de 8 pays, ajouter un lien "Voir plus"
        if (countries.length > 8) {
            const moreLink = document.createElement('a');
            moreLink.className = 'destinations-mega-menu-item';
            moreLink.href = this.service.getDestinationUrl(continent);
            moreLink.innerHTML = `
                <div class="destinations-mega-menu-item-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
                <span class="destinations-mega-menu-item-name">Voir tous les pays (${countries.length})</span>
            `;
            items.appendChild(moreLink);
        }
        
        column.appendChild(items);
        return column;
    }
    
    createDestinationItem(destination, type, parent = null) {
        const item = document.createElement('a');
        item.className = 'destinations-mega-menu-item';
        item.href = this.service.getDestinationUrl(destination);
        
        // Icône selon le type
        const icon = this.getIconForType(type);
        
        item.innerHTML = `
            <div class="destinations-mega-menu-item-icon">
                ${icon}
            </div>
            <span class="destinations-mega-menu-item-name">${destination.name}</span>
        `;
        
        // Événement hover pour mettre à jour le fil d'Ariane
        item.addEventListener('mouseenter', () => {
            this.updateBreadcrumb(destination, type, parent);
        });
        
        return item;
    }
    
    getIconForType(type) {
        const icons = {
            continent: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>',
            country: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" y1="22" x2="4" y2="15"></line></svg>',
            province: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>',
            region: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon></svg>',
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
    
    updateBreadcrumb(destination, type, parent = null) {
        console.log('🔄 updateBreadcrumb appelé:', {destination, type, parent, breadcrumbElement: !!this.breadcrumb});
        
        if (!this.breadcrumb) {
            console.error('❌ Élément breadcrumb non trouvé!');
            return;
        }
        
        const breadcrumbParts = [];
        
        // Construire le fil d'Ariane selon le type
        if (parent) {
            breadcrumbParts.push({
                name: parent.name,
                url: this.service.getDestinationUrl(parent)
            });
        }
        
        breadcrumbParts.push({
            name: destination.name,
            url: this.service.getDestinationUrl(destination)
        });
        
        console.log('📋 Parties du fil d\'Ariane:', breadcrumbParts);
        
        // Générer le HTML du fil d'Ariane
        const breadcrumbHTML = breadcrumbParts.map((part, index) => {
            const separator = index > 0 ? '<span class="search-bar-v2-separator">/</span>' : '';
            return `${separator}<a href="${part.url}" class="search-bar-v2-destinations-link">${part.name}</a>`;
        }).join('');
        
        console.log('✅ HTML du fil d\'Ariane généré:', breadcrumbHTML);
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
