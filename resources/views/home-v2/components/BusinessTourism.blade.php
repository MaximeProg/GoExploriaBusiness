{{-- Business & Tourism Component (100% Content - Design System Bosse) --}}
<section class="business-tourism-v2-section design-bosse-section" id="business-tourism">
    <div class="design-bosse-container">
        
        {{-- BLOC DESIGN BOSSE --}}
        <div class="design-bosse-block business-tourism-v2">
            <h1 class="design-bosse-title">Business & Tourisme</h1>
            
            <div class="design-bosse-controls" style="justify-content: center; text-align: center; margin-bottom: 40px;">
                <p style="font-size: 16px; color: #666; font-weight: 500; max-width: 800px; margin: 0 auto;">
                    Découvrez comment nous combinons expertise commerciale et expériences touristiques pour créer des opportunités uniques et mémorables.
                </p>
                
                {{-- Badge d'excellence à droite sur desktop --}}
                <div style="position: absolute; right: 40px; top: 110px;" class="desktop-only">
                    <span class="web-badge-pro" style="background: rgba(0, 201, 183, 0.05); color: #00c9b7; border-color: rgba(0, 201, 183, 0.1);">
                        <i class="fas fa-star"></i> EXCELLENCE PROFESSIONNELLE
                    </span>
                </div>
            </div>

            {{-- 1. Duo de Cartes Business & Tourisme --}}
            <div class="bt-dual-grid">
                
                {{-- Carte Business --}}
                <div class="bt-card">
                    <div class="bt-icon-box"><i class="fas fa-chart-line"></i></div>
                    <h2 class="info-title">Solutions Business</h2>
                    <p class="intro">Nous offront des stratégies sur mesure pour développer votre entreprise, optimiser vos processus et maximiser votre rentabilité sur le marché international.</p>
                    
                    <ul class="bt-features">
                        <li><i class="fas fa-check-circle"></i> Consultation stratégique et analyse de marché</li>
                        <li><i class="fas fa-check-circle"></i> Développement de partenariats internationaux</li>
                        <li><i class="fas fa-check-circle"></i> Optimisation des processus opérationnels</li>
                        <li><i class="fas fa-check-circle"></i> Solutions digitales innovantes</li>
                    </ul>

                    {{-- Vidéo YouTube Business --}}
                    <div class="bt-video-wrapper">
                        <iframe src="https://www.youtube.com/embed/7Pq-S557XQU" 
                                title="Solutions Business" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                        </iframe>
                    </div>
                    
                    <div style="margin-top: 25px;">
                        <a href="#" class="design-bosse-more-btn" style="background: #1a3a8f; color: #fff; border: none; padding: 12px 30px;">
                            DÉCOUVRIR NOS SOLUTIONS <span class="events-vedette-v2-plus-icon">+</span>
                        </a>
                    </div>
                </div>

                {{-- Carte Tourisme --}}
                <div class="bt-card">
                    <div class="bt-icon-box"><i class="fas fa-globe-americas"></i></div>
                    <h2 class="info-title">Expériences Touristiques</h2>
                    <p class="intro">Nous concevons des voyages sur mesure qui combinent découvertes culturelles, aventures uniques et moments de détente pour les professionnels et leurs équipes.</p>
                    
                    <ul class="bt-features">
                        <li><i class="fas fa-check-circle"></i> Voyages d'affaires sur mesure</li>
                        <li><i class="fas fa-check-circle"></i> Retraites d'entreprise en destinations exclusives</li>
                        <li><i class="fas fa-check-circle"></i> Team-building aventure et culturel</li>
                        <li><i class="fas fa-check-circle"></i> Circuits découverte pour partenaires</li>
                    </ul>

                    {{-- Vidéo YouTube Tourisme --}}
                    <div class="bt-video-wrapper">
                        <iframe src="https://www.youtube.com/embed/Bk4KkC3Efdw" 
                                title="Expériences Touristiques" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                        </iframe>
                    </div>
                    
                    <div style="margin-top: 25px;">
                        <a href="#" class="design-bosse-more-btn" style="background: transparent; border: 2px solid #1a3a8f; color: #1a3a8f; padding: 10px 30px;">
                            EXPLORER NOS DESTINATIONS <span class="events-vedette-v2-plus-icon">+</span>
                        </a>
                    </div>
                </div>

            </div>

            {{-- 2. Stats Section --}}
            <div class="bt-stats-grid">
                <div class="bt-stat-unit">
                    <span class="bt-stat-number" data-count="250">250</span>
                    <span class="bt-stat-label">Projets réalisés</span>
                </div>
                <div class="bt-stat-unit">
                    <span class="bt-stat-number" data-count="40">40</span>
                    <span class="bt-stat-label">Pays couverts</span>
                </div>
                <div class="bt-stat-unit">
                    <span class="bt-stat-number" data-count="98">98%</span>
                    <span class="bt-stat-label">Satisfaction</span>
                </div>
                <div class="bt-stat-unit">
                    <span class="bt-stat-number" data-count="15">15</span>
                    <span class="bt-stat-label">Années d'expérience</span>
                </div>
            </div>

            {{-- 3. Carte Interactive --}}
            <div style="margin-top: 100px; text-align: center;">
                <h2 class="design-bosse-label" style="font-size: 22px; color: #1a3a8f; margin-bottom: 10px;">Notre Carte Interactive</h2>
                <p style="font-size: 14px; color: #666; margin-bottom: 40px;">Découvrez nos lieux d'intérêt business et tourisme sur la carte</p>
            </div>

            <div class="bt-map-container">
                {{-- Zone Carte Leaflet --}}
                <div class="map-view-box">
                    <div id="map"></div>
                    <div class="map-overlay-loading" id="mapLoading" style="display: none;">
                        <i class="fas fa-spinner fa-spin"></i> Chargement...
                    </div>
                </div>

                {{-- Sidebar Filtres & Liste --}}
                <div class="bt-sidebar">
                    <div class="bt-sidebar-header">
                        <div style="margin-bottom: 15px;">
                            <label style="font-size: 11px; font-weight: 800; color: #888; text-transform: uppercase;">Province/Région</label>
                            <select id="province-filter" class="form-select" style="margin-top: 5px; border-radius: 10px; font-size: 13px;">
                                <option value="">Toutes les provinces</option>
                                <option value="qc">Québec</option>
                                <option value="on">Ontario</option>
                                <option value="bc">Colombie-Britannique</option>
                                <option value="ab">Alberta</option>
                            </select>
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <label style="font-size: 11px; font-weight: 800; color: #888; text-transform: uppercase;">Catégorie</label>
                            <select id="category-filter" class="form-select" style="margin-top: 5px; border-radius: 10px; font-size: 13px;">
                                <option value="all">Toutes les catégories</option>
                                <option value="business">Business</option>
                                <option value="tourism">Tourisme</option>
                                <option value="hotel">Hôtels</option>
                                <option value="restaurant">Restaurants</option>
                            </select>
                        </div>

                        <button id="locate-me" class="bt-filter-btn">
                            <i class="fas fa-location-arrow"></i> ME LOCALISER
                        </button>
                    </div>

                    <div class="bt-places-list" id="places-list">
                        {{-- Liste générée via JS --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Modal pour les détails (cachée au démarrage) --}}
<div id="place-modal" class="modal" style="display: none; background: rgba(0,0,0,0.85); z-index: 10000;">
    <div class="modal-content" style="max-width: 900px; margin: 50px auto; border-radius: 30px; overflow: hidden; position: relative;">
        <button class="close-modal" id="closePlaceModal" style="position: absolute; right: 25px; top: 25px; z-index: 10; background: #fff; border: none; width: 40px; height: 40px; border-radius: 50%; box-shadow: 0 10px 20px rgba(0,0,0,0.1); cursor: pointer;"><i class="fas fa-times"></i></button>
        <div id="modal-content-body">
            {{-- Dynamique via JS --}}
        </div>
    </div>
</div>
