{{-- Mega Menu Component pour Destinations --}}
<div class="destinations-mega-menu" id="destinationsMegaMenu" style="display: none;">
    <div class="destinations-mega-menu-container">
        <div class="destinations-mega-menu-content">
            {{-- Loader --}}
            <div class="destinations-mega-menu-loader" id="destinationsLoader">
                <div class="spinner"></div>
                <p>Chargement des destinations...</p>
            </div>

            {{-- Contenu principal --}}
            <div class="destinations-mega-menu-grid" id="destinationsGrid" style="display: none;">
                {{-- Les colonnes seront générées dynamiquement par JavaScript --}}
            </div>

            {{-- Message si aucune destination --}}
            <div class="destinations-mega-menu-empty" id="destinationsEmpty" style="display: none;">
                <p>Aucune destination disponible pour le moment.</p>
            </div>
        </div>
    </div>
</div>

<style>
/* Mega Menu Destinations */
.destinations-mega-menu {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background: rgba(0, 0, 0, 0.95);
    backdrop-filter: blur(10px);
    border-top: 2px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    z-index: 1000;
    opacity: 0;
    transform: translateY(-10px);
    transition: opacity 0.3s ease, transform 0.3s ease;
    pointer-events: none;
}

.destinations-mega-menu.active {
    opacity: 1;
    transform: translateY(0);
    pointer-events: all;
}

.destinations-mega-menu-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 40px 20px;
}

.destinations-mega-menu-loader {
    text-align: center;
    padding: 60px 20px;
    color: #fff;
}

.destinations-mega-menu-loader .spinner {
    width: 40px;
    height: 40px;
    margin: 0 auto 20px;
    border: 3px solid rgba(255, 255, 255, 0.1);
    border-top-color: #fff;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.destinations-mega-menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
}

.destinations-mega-menu-column {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 12px;
    padding: 20px;
    transition: background 0.3s ease;
}

.destinations-mega-menu-column:hover {
    background: rgba(255, 255, 255, 0.08);
}

.destinations-mega-menu-column-title {
    font-size: 16px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 2px solid rgba(255, 255, 255, 0.2);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.destinations-mega-menu-items {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.destinations-mega-menu-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 12px;
    border-radius: 6px;
    transition: all 0.2s ease;
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-size: 14px;
}

.destinations-mega-menu-item:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    transform: translateX(5px);
}

.destinations-mega-menu-item-icon {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.destinations-mega-menu-item-icon svg {
    width: 16px;
    height: 16px;
    stroke: currentColor;
}

.destinations-mega-menu-item-name {
    flex: 1;
}

.destinations-mega-menu-item-count {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.5);
    background: rgba(255, 255, 255, 0.1);
    padding: 2px 8px;
    border-radius: 10px;
}

.destinations-mega-menu-empty {
    text-align: center;
    padding: 60px 20px;
    color: rgba(255, 255, 255, 0.6);
}

/* Responsive */
@media (max-width: 768px) {
    .destinations-mega-menu-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .destinations-mega-menu-container {
        padding: 30px 15px;
    }
}
</style>
