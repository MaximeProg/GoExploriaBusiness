{{-- Hero Section Component --}}
<section class="hero-v2">
    {{-- Video Carousel Background - Confiné au Hero --}}
    <div class="video-carousel-background">
        <div class="video-carousel-container">
            <div class="video-slide active" data-slide="0">
                <video class="video-background" autoplay muted loop playsinline>
                    <source src="{{ asset('home2/videos/hero-video-1.mp4.mp4') }}" type="video/mp4">
                </video>
            </div>
            
            <div class="video-slide" data-slide="1">
                <video class="video-background" muted loop playsinline>
                    <source src="{{ asset('home2/videos/hero-video-2.mp4.mp4') }}" type="video/mp4">
                </video>
            </div>
            
            <div class="video-slide" data-slide="2">
                <video class="video-background" muted loop playsinline>
                    <source src="{{ asset('home2/videos/hero-video-3.mp4.mp4') }}" type="video/mp4">
                </video>
            </div>
        </div>
        
        <div class="carousel-controls">
            <button class="carousel-dot" data-slide="0" aria-label="Video 1"></button>
            <button class="carousel-dot" data-slide="1" aria-label="Video 2"></button>
            <button class="carousel-dot" data-slide="2" aria-label="Video 3"></button>
        </div>
    </div>

    {{-- Section mobile uniquement : Email + Logo + Map --}}
    <div class="hero-mobile-header">
        <div class="hero-mobile-email">
            <a href="mailto:INFOGOEXPLORIA@GMAIL.COM">INFOGOEXPLORIA@GMAIL.COM</a>
        </div>
        <div class="hero-mobile-logo-container">
            <a href="#" class="hero-mobile-logo">
                <img src="{{ asset('logo.png') }}" alt="GO EXPLORIA" class="hero-mobile-logo-img">
                <!-- <div class="logo-text">
                    <div class="logo-exploria">GO EXPLORIA</div>
                    <div class="logo-location">QUÉBEC, CANADA</div>
                </div> -->
            </a>
            <img src="{{ asset('header_info/map2.png') }}" alt="Map" class="hero-mobile-map">
        </div>
    </div>
    
    <div class="hero-content">
        <!-- <div class="hero-text">
            <h1 class="hero-title">
                <span class="hero-main">GO EXPLORIA</span>
            </h1>
        </div> -->
        
        {{-- Barre horizontale complète avec destinations + recherche --}}
        <div class="search-bar-v2">
            <div class="search-bar-v2-container">
                {{-- Logo REDI + DESTINATIONS (un seul élément à gauche) --}}
                <div class="search-bar-v2-destinations" style="position: relative;">
                    <img src="{{ asset('REDI.png') }}" alt="Destinations" class="search-bar-v2-globe-icon">
                    <span class="search-bar-v2-destinations-title">DESTINATIONS</span>
                    <div class="search-bar-v2-destinations-links" id="destinationsBreadcrumb">
                        {{-- Le fil d'Ariane sera généré dynamiquement par JavaScript --}}
                        <span class="search-bar-v2-destinations-link">Survolez pour explorer</span>
                    </div>
                    
                    {{-- Mega Menu Destinations --}}
                    @include('home-v2.components.DestinationsMegaMenu')
                </div>

                {{-- Barre de recherche --}}
                <div class="search-bar-v2-search">
                    <div class="search-bar-v2-input-wrapper">
                        <svg class="search-bar-v2-search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                        <input 
                            type="text" 
                            class="search-bar-v2-input" 
                            id="searchBarInput"
                            placeholder="Rechercher une destination..."
                            aria-label="Rechercher une destination"
                            autocomplete="off"
                        >
                        <button class="search-bar-v2-clear-btn" id="searchBarClearBtn" aria-label="Effacer">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>

                    {{-- Dropdown des résultats --}}
                    <div class="search-bar-v2-results" id="searchBarResults">
                        <div class="search-bar-v2-results-header">
                            <h4 class="search-bar-v2-results-title">Résultats de la recherche</h4>
                        </div>
                        <ul class="search-bar-v2-results-list" id="searchBarResultsList">
                            {{-- Les résultats seront injectés ici par JavaScript --}}
                        </ul>
                    </div>
                </div>

                {{-- Logo Plan-n-go --}}
                <div class="search-bar-v2-brand">
                    <img src="{{ asset('plan-n-go.png') }}" alt="PLAN-N-GO" class="search-bar-v2-logo">
                </div>
            </div>
        </div>
        
        <button class="hero-scroll-btn" aria-label="Défiler vers le bas">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14"></path>
                <path d="m19 12-7 7-7-7"></path>
            </svg>
        </button>
    </div>
</section>
