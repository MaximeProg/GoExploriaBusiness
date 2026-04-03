{{-- Info Mega Menu Component --}}
<div class="header-mega-menu info-mega-menu-v2" id="infoMegaMenuV2">
    {{-- Ticker Section --}}
    <div class="mega-menu-ticker">
        <div class="ticker-item">
            <img src="{{ asset('header_info/megamenu/bourse.png') }}" alt="Bourse" style="width: 20px;">
            <span style="color: #ffd700;">Bourse TSX: 21,450.12 <span style="color: #4cd137;">+1.2%</span></span>
        </div>
        <div class="ticker-item">
            <i class="fas fa-sun" style="color: #ffd700;"></i>
            <span>Météo QC: -5°C Ensoleillé</span>
        </div>
        <div class="ticker-item">
            <img src="{{ asset('header_info/megamenu/bourse.png') }}" alt="Bourse" style="width: 20px;">
            <span style="color: #ffd700;">Bourse TSX: 21,450.12 <span style="color: #4cd137;">+1.2%</span></span>
        </div>
    </div>
    
    <div class="mega-menu-main-content">
        {{-- 5 Columns Grid --}}
        <div class="mega-menu-columns-container">
            {{-- Column 1 --}}
            <div class="mega-menu-column">
                <a href="{{url('/landing/accessibilite')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/k-roule-acces-andicape-quebec.png')}}" alt="Accessibilité" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Accessibilité</span>
                </a>
                <a href="{{url('/landing/ambulance')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/AMBULANCE-911-QUEBEC.png')}}" alt="Ambulance" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Ambulance 911</span>
                </a>
                <a href="{{url('/landing/defibrillateur')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/borne-defibrilateur-urgence.png')}}" alt="Défibrillateur" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Défibrillateur</span>
                </a>
                <a href="{{url('/landing/indigo')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/indigo.png')}}" alt="Indigo" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Indigo</span>
                </a>
            </div>
            
            {{-- Column 2 --}}
            <div class="mega-menu-column">
                <a href="{{url('/landing/fabrique-quebec')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/fabriquer-au-quebec.png')}}" alt="Fabriqué" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Fabriqué Québec</span>
                </a>
                <a href="{{url('/landing/info-tourisme')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/INFO-TOURISME.png')}}" alt="Info" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Info Tourisme</span>
                </a>
                <a href="{{url('/landing/transport')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/MOYEN-TRANSPORT-QUEBEC.png')}}" alt="Transport" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Transport</span>
                </a>
                <a href="{{url('/landing/experiences')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/EXPERIENCES-QUEBEC-CANADA.png')}}" alt="Expériences" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Expériences</span>
                </a>
            </div>
            
            {{-- Column 3 --}}
            <div class="mega-menu-column">
                <a href="{{url('/landing/garage')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/GARAGE.png')}}" alt="Garage" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Garage</span>
                </a>
                <a href="{{url('/landing/indice-uv')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/INDICE-UV.png')}}" alt="UV" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Indice UV</span>
                </a>
                <a href="{{url('/landing/indice')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/INDICE.png')}}" alt="Indices" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Indices</span>
                </a>
                <a href="{{url('/landing/parcs')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/PARC-CANADA.png')}}" alt="Parcs" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Parcs Canada</span>
                </a>
            </div>
            
            {{-- Column 4 --}}
            <div class="mega-menu-column">
                <a href="{{url('/landing/chasse')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/CHASSE-PERIODE-DE.png')}}" alt="Chasse" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Chasse</span>
                </a>
                <a href="{{url('/landing/croisieres')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/croisieres.png')}}" alt="Croisières" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Croisières</span>
                </a>
                <a href="{{url('/landing/billets-avion')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/billet-avion-pas-cher.png')}}" alt="Billets" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Billets Avion</span>
                </a>
                <a href="{{url('/landing/evenements')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/EVENEMENTS-QUEBEC.png')}}" alt="Evenements" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Événements</span>
                </a>
            </div>

            {{-- Column 5 --}}
            <div class="mega-menu-column">
                <a href="{{url('/landing/culture')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/CULTURE-ATTRAITS.png')}}" alt="Culture" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Culture</span>
                </a>
                <a href="{{url('/landing/ferry')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/FERRY.png')}}" alt="Ferry" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Ferry</span>
                </a>
                <a href="{{url('/landing/nouvelles')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/nouvelles-proviciales.png')}}" alt="Nouvelles" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Nouvelles</span>
                </a>
                <a href="{{url('/landing/canada-quebec')}}" class="mega-menu-item">
                    <div class="mega-menu-img-wrapper"><img src="{{asset('header_info/megamenu/CANADA-QUEBEC.png')}}" alt="Fermeture" class="mega-menu-image"></div>
                    <span class="mega-menu-label">Canada Québec</span>
                </a>
            </div>
        </div>
        
        {{-- Dual-Mode Media Slider (Strict Separation) --}}
        <div class="mega-menu-carousel-clean">
            <div class="carousel-media-viewport" id="exclusiveMediaViewport">
                {{-- Slide 1: Video (Only Video Player) --}}
                <div class="carousel-item-simple active">
                    <div class="media-container-v2">
                        <iframe src="https://www.youtube.com/embed/hdxKTW1ER5w" class="slide-media-direct"></iframe>
                        <button class="expand-media-btn" onclick="openDedicatedVideo('hdxKTW1ER5w', 'Québec Travel')">
                            <i class="fas fa-play"></i> Mode Vidéo
                        </button>
                    </div>
                </div>

                {{-- Slide 2: Image (Only Image Lightbox) --}}
                <div class="carousel-item-simple">
                     <div class="media-container-v2">
                        <img src="https://picsum.photos/1000/1500?random=51" class="slide-media-direct">
                        <button class="expand-media-btn" onclick="openDedicatedImage('https://picsum.photos/1000/1500?random=51', 'Paysage Québec')">
                            <i class="fas fa-camera"></i> Mode Image
                        </button>
                    </div>
                </div>

                {{-- Navigation --}}
                <button class="mega-nav-btn prev" id="mediaPrev"><i class="fas fa-chevron-left"></i></button>
                <button class="mega-nav-btn next" id="mediaNext"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
    
    {{-- Footer --}}
    <div class="mega-menu-footer-btns">
        <a href="{{url('/landing/experiences-quebec')}}" class="footer-btn btn-quebec"><span>EXPÉRIENCES QUÉBEC</span></a>
        <a href="{{url('/landing/experiences-canada')}}" class="footer-btn btn-canada"><i class="fas fa-flag"></i> <span>EXPÉRIENCES CANADA</span></a>
        <a href="{{url('/landing/experiences-monde')}}" class="footer-btn btn-monde"><i class="fas fa-globe"></i> <span>EXPÉRIENCES MONDE</span></a>
    </div>

    {{-- System-Specific Scripts --}}
    <script>
    (function() {
        // SYSTEM 1: Dedicated Video Player (Uses platform modal)
        window.openDedicatedVideo = function(videoId, title) {
            console.log('[InfoMegaMenu] Opening Dedicated Video Player');
            if (window.VideoModalInstance) {
                window.VideoModalInstance.open({ id: videoId, title: title, category: 'VIDÉO' });
            }
        };

        // SYSTEM 2: Dedicated Image Lightbox (Totally separate from video player)
        window.openDedicatedImage = function(src, title) {
            console.log('[InfoMegaMenu] Opening Dedicated Image Lightbox');
            let lb = document.getElementById('megaImageLightbox');
            if(!lb) {
                lb = document.createElement('div'); lb.id = 'megaImageLightbox';
                lb.style = "display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.95);z-index:9999999;flex-direction:column;justify-content:center;align-items:center;";
                lb.innerHTML = `<button onclick="this.parentElement.style.display='none'" style="position:fixed;top:20px;right:20px;color:white;font-size:40px;background:none;border:none;">&times;</button><img id="lb-img" style="max-width:90%;max-height:85%;object-fit:contain;border:5px solid white;border-radius:10px;"><h3 id="lb-title" style="color:white;margin-top:20px;"></h3>`;
                document.body.appendChild(lb);
            }
            document.getElementById('lb-img').src = src;
            document.getElementById('lb-title').textContent = title;
            lb.style.display = 'flex';
        };

        document.addEventListener('DOMContentLoaded', function() {
            const viewport = document.getElementById('exclusiveMediaViewport');
            if (!viewport) return;
            const slides = viewport.querySelectorAll('.carousel-item-simple');
            let current = 0;
            function update(n) { slides.forEach(s => s.classList.remove('active')); current = (n + slides.length) % slides.length; slides[current].classList.add('active'); }
            document.getElementById('mediaPrev').onclick = (e) => { e.stopPropagation(); update(current - 1); };
            document.getElementById('mediaNext').onclick = (e) => { e.stopPropagation(); update(current + 1); };
        });
    })();
    </script>
</div>
