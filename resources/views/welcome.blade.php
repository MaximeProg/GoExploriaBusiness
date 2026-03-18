<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Exploria Business - Plateforme de Création Digitale</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <script>
// À placer en tête de page
document.addEventListener('DOMContentLoaded', function() {
    // État verrouillé
    let scrollLocked = true;
    
    // Force brute - bloquer physiquement
    document.body.style.overflow = 'hidden';
    document.documentElement.style.overflow = 'hidden';
    
    // Scroll immédiat et répété
    const lockScroll = () => {
        window.scrollTo(0, 0);
        document.documentElement.scrollTop = 0;
        document.body.scrollTop = 0;
    };
    
    // Appliquer intensément
    lockScroll();
    const intenseInterval = setInterval(lockScroll, 10);
    
    // Observer la position de scroll
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!entry.isIntersecting && scrollLocked) {
                lockScroll();
            }
        });
    }, { threshold: 0 });
    
    // Créer un élément d'ancrage en haut
    const anchor = document.createElement('div');
    anchor.id = 'scroll-anchor';
    anchor.style.position = 'absolute';
    anchor.style.top = '0';
    anchor.style.left = '0';
    anchor.style.width = '1px';
    anchor.style.height = '1px';
    document.body.prepend(anchor);
    scrollObserver.observe(anchor);
    
    // Gérer les iframes
    const iframes = document.querySelectorAll('iframe');
    let loadedCount = 0;
    
    iframes.forEach(iframe => {
        // Désactiver le scroll dans l'iframe
        iframe.style.pointerEvents = 'none';
        
        iframe.addEventListener('load', function() {
            loadedCount++;
            
            // Forcer le scroll dans l'iframe
            try {
                this.contentWindow.scrollTo(0, 0);
                this.contentDocument.body.style.overflow = 'hidden';
            } catch(e) {}
            
            // Activer après chargement
            this.style.pointerEvents = 'auto';
            
            // Quand tous sont chargés
            if (loadedCount === iframes.length) {
                setTimeout(() => {
                    scrollLocked = false;
                    clearInterval(intenseInterval);
                    
                    // Libérer le scroll
                    document.body.style.overflow = 'auto';
                    document.documentElement.style.overflow = 'auto';
                    
                    // Dernier ajustement
                    lockScroll();
                    
                    // Nettoyer
                    scrollObserver.unobserve(anchor);
                    anchor.remove();
                }, 500);
            }
        });
    });
    
    // Sécurité : déverrouiller après 3s
    setTimeout(() => {
        if (scrollLocked) {
            scrollLocked = false;
            clearInterval(intenseInterval);
            document.body.style.overflow = 'auto';
            document.documentElement.style.overflow = 'auto';
        }
    }, 3000);
});
</script>
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <style>
        /* Style pour le bouton retour en haut */
        .back-to-top {
            position: fixed;
            bottom: 100px;
            right: 35px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            transform: translateY(-10px);
        }
        
        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .back-to-top:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
        }
        
        /* Styles pour le méga-menu */
        .mega-menu-container {
            position: relative;
            display: inline-block;
        }
        
        .mega-menu {
            position: absolute;
            top: 100%;
            left: 75%;
            transform: translateX(-50%) translateY(15px);
            width: 1100px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            padding: 30px;
            z-index: 1050;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
        }
        
        .mega-menu-container:hover .mega-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }
        
        .mega-menu-column h4 {
            color: var(--dark-color);
            font-size: 1.1rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-color);
        }
        
        .mega-menu-link {
            display: flex;
            align-items: center;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            transition: all 0.2s ease;
            background: #f9f9f9;
        }
        
        .mega-menu-link:hover {
            background: var(--primary-color);
            color: white;
            transform: translateX(5px);
        }
        
        .mega-menu-image {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            margin-right: 15px;
            object-fit: cover;
            transition: all 0.2s ease;
        }
        
        .mega-menu-text {
            flex: 1;
        }
        
        .mega-menu-text h6 {
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        .mega-menu-text p {
            font-size: 0.8rem;
            opacity: 0.8;
            margin: 0;
        }
        
        .mega-menu-highlight {
            grid-column: span 2;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 10px;
            padding: 25px;
            color: white;
            margin-top: 10px;
        }
        
        .mega-menu-highlight h4 {
            color: white;
            border-bottom-color: rgba(255,255,255,0.3);
        }
        
        .highlight-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
        }
        
        .highlight-icon {
            font-size: 1.5rem;
            margin-right: 15px;
        }
        
        /* Style spécifique pour le méga-menu templates */
        .mega-menu-templates {
            width: 1200px !important;
            max-width: 95vw !important;
            grid-template-columns: repeat(4, 1fr) !important;
            gap: 20px !important;
            padding: 25px !important;
        }
        
        .mega-menu-templates .mega-menu-column {
            margin-bottom: 20px;
        }
        
        .mega-menu-templates .mega-menu-column h4 {
            font-size: 1rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .mega-menu-templates .mega-menu-column h4 i {
            color: var(--primary-color);
            font-size: 0.9rem;
        }
        
        .mega-menu-templates .mega-menu-link:hover .mega-menu-image {
            transform: scale(1.05);
        }
        
        /* Footer avec photo de fond filtrée */
        .footer-with-bg {
            position: relative;
            background-color: var(--dark-color);
            color: white;
            padding: 80px 0 30px;
            overflow: hidden;
        }
        
        .footer-bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
            opacity: 0.15;
            filter: blur(2px) grayscale(30%) brightness(0.7);
        }
        
        .footer-content {
            position: relative;
            z-index: 2;
        }
        
        .footer-logo {
            height: 70px;
            margin-bottom: 25px;
            filter: brightness(0) invert(1);
        }
        
        .footer-social-icons {
            margin-top: 25px;
        }
        
        .footer-social-icons a {
            display: inline-block;
            margin-right: 15px;
            color: white;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .footer-social-icons a:hover {
            color: var(--accent-color);
            transform: translateY(-3px);
        }
        
        .footer-section-title {
            color: white;
            font-size: 1.3rem;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--accent-color);
            display: inline-block;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            color: #ddd;
            text-decoration: none;
            transition: var(--transition);
        }
        
        .footer-links a:hover {
            color: white;
            padding-left: 5px;
        }
        
        .footer-contact li {
            margin-bottom: 12px;
            display: flex;
            align-items: flex-start;
        }
        
        .footer-contact i {
            margin-right: 10px;
            color: var(--accent-color);
            margin-top: 3px;
        }
        
        .footer-buttons {
            margin-top: 25px;
        }
        
        .footer-copyright {
            text-align: center;
            padding-top: 40px;
            margin-top: 40px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.7);
            font-size: 0.95rem;
            position: relative;
            z-index: 2;
        }
        
        /* Styles pour le nouveau header avec bande défilante */
        .info-header {
            background: linear-gradient(90deg, #1a3a5f 0%, #2c5282 50%, #1a3a5f 100%);
            padding: 12px 0;
            color: white;
            position: relative;
            overflow: visible;
            z-index: 1000;
        }
        
        .info-header .container {
            display: flex;
            flex-direction: column;
            gap: 0;
        }
        
        /* Layout principal du header */
        .header-content-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            gap: 20px;
            max-width: 100%;
            margin: 0 auto;
        }
        
        /* Barre de 5 icônes de navigation */
        .header-icons-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 25px;
        }
        
        .header-icon-container {
            position: relative;
        }
        
        .header-icon-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
        }
        
        .header-icon-link:hover {
            transform: translateY(-4px);
        }
        
        .icon-circle {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            position: relative;
        }
        
        .icon-circle::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 50%;
            z-index: -1;
        }
        
        .icon-circle i {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            position: absolute !important;
            width: 0 !important;
            height: 0 !important;
        }
        
        .icon-circle img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 50%;
            padding: 5px;
        }
        
        .header-icon-link:hover .icon-circle {
            background: rgba(255, 255, 255, 0.22);
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            transform: scale(1.08);
        }
        
        .icon-label {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.95;
        }
        
        /* Mega Menu Header - Layout Complet */
        .header-mega-menu {
            position: fixed;
            top: 120px;
            left: 50%;
            transform: translateX(-50%);
            width: 1100px;
            max-width: 95vw;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
            padding: 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 2000;
            border: 2px solid #e0e0e0;
            overflow: hidden;
        }
        
        .mega-menu-trigger:hover .header-mega-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }
        
        /* Ticker Bourse/Météo en haut */
        .mega-menu-ticker {
            background: linear-gradient(135deg, #1a3a5f 0%, #2c5282 100%);
            color: white;
            padding: 10px 20px;
            display: flex;
            gap: 30px;
            overflow: hidden;
            border-bottom: 2px solid #3498db;
        }
        
        .ticker-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            white-space: nowrap;
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .ticker-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: scale(1.05);
        }
        
        .ticker-item i {
            font-size: 1rem;
            color: #ffd700;
        }
        
        .ticker-up {
            color: #2ecc71;
            font-weight: 700;
        }
        
        /* Contenu principal : Icônes + Carrousel */
        .mega-menu-main-content {
            display: flex;
            gap: 15px;
            padding: 15px;
            overflow: visible;
            box-sizing: border-box;
        }
        
        /* Container des 3 colonnes d'icônes */
        .mega-menu-icons-container {
            display: flex;
            gap: 20px;
            flex: 1;
        }
        
        /* Colonne verticale */
        .mega-menu-column {
            flex: 1;
            display: flex;
            flex-direction: column-reverse;
        }
        
        .mega-menu-section-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0 0 12px 0;
            padding-bottom: 6px;
            border-bottom: 2px solid #3498db;
        }
        
        /* Grille d'icônes (3 lignes verticales max) */
        .mega-menu-icons-vertical {
            display: grid;
            grid-template-rows: repeat(3, auto);
            grid-auto-flow: column;
            gap: 10px;
        }
        
        /* Item avec icône */
        .mega-icon-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 6px;
            border-radius: 8px;
        }
        
        .mega-icon-item:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
        }
        
        /* Cercle d'icône coloré */
        .mega-icon-circle {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.4rem;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
            line-height: 1;
        }
        
        .mega-icon-circle i {
            line-height: 1;
        }
        
        .mega-icon-item:hover .mega-icon-circle {
            transform: scale(1.08);
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.25);
        }
        
        /* Label sous l'icône */
        .mega-icon-label {
            font-size: 0.65rem;
            font-weight: 600;
            color: #2c3e50;
            text-align: center;
            line-height: 1.1;
        }
        
        /* Carrousel Vidéo/Photo - Défilement Vertical */
        .mega-menu-carousel {
            width: 260px;
            min-width: 260px;
            max-width: 260px;
            position: relative;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            flex-shrink: 0;
            align-self: stretch;
            box-sizing: border-box;
        }
        
        .carousel-scroll-container {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
        }
        
        .carousel-item-simple {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }
        
        .carousel-item-simple.active {
            opacity: 1;
            z-index: 1;
            pointer-events: auto;
        }
        
        .carousel-item-simple img,
        .carousel-item-simple > div {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0;
        }
        
        .carousel-indicators {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 10;
        }
        
        .carousel-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .carousel-dot.active {
            background: #3498db;
            width: 30px;
            border-radius: 5px;
        }
        
        /* Boutons de navigation */
        .carousel-nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.9);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 20;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        
        .carousel-nav-btn:hover {
            background: #3498db;
            color: white;
            transform: translateY(-50%) scale(1.1);
        }
        
        .carousel-nav-btn.prev {
            left: 10px;
        }
        
        .carousel-nav-btn.next {
            right: 10px;
        }
        
        .carousel-nav-btn i {
            font-size: 18px;
        }
        
        .carousel-scroll-container::-webkit-scrollbar {
            width: 6px;
        }
        
        .carousel-scroll-container::-webkit-scrollbar-track {
            background: #1a1a2e;
        }
        
        .carousel-scroll-container::-webkit-scrollbar-thumb {
            background: #3498db;
            border-radius: 3px;
        }
        
        .carousel-scroll-container::-webkit-scrollbar-thumb:hover {
            background: #2980b9;
        }
        
        .carousel-item {
            position: relative;
            width: 100%;
            min-height: 150px;
            height: 150px;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            flex-shrink: 0;
            background: #000;
        }
        
        .carousel-item:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(52, 152, 219, 0.4);
            z-index: 10;
        }
        
        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: all 0.4s ease;
        }
        
        .carousel-item:hover img {
            transform: scale(1.1);
            filter: brightness(1.1);
        }
        
        .play-overlay,
        .zoom-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 3.5rem;
            color: white;
            opacity: 0;
            transition: all 0.3s ease;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.7);
            pointer-events: none;
        }
        
        .carousel-item:hover .play-overlay,
        .carousel-item:hover .zoom-overlay {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.2);
        }
        
        .play-overlay i {
            color: #ff0000;
            filter: drop-shadow(0 0 10px rgba(255, 0, 0, 0.5));
        }
        
        .zoom-overlay i {
            color: #3498db;
            filter: drop-shadow(0 0 10px rgba(52, 152, 219, 0.5));
        }
        
        /* Boutons de navigation */
        .carousel-nav {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 40px;
            background: rgba(52, 152, 219, 0.9);
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 100;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        
        .carousel-nav:hover {
            background: #2980b9;
            transform: translateX(-50%) scale(1.1);
        }
        
        .carousel-prev {
            top: 10px;
        }
        
        .carousel-next {
            bottom: 10px;
        }
        
        /* Modal pour vidéo/image en grand */
        .media-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 10000;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .modal-content-wrapper {
            position: relative;
            width: 90%;
            max-width: 1200px;
            height: 80%;
            background: #000;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.8);
        }
        
        .modal-close {
            position: absolute;
            top: -50px;
            right: 0;
            background: transparent;
            border: none;
            color: white;
            font-size: 3rem;
            cursor: pointer;
            z-index: 10001;
            transition: all 0.3s ease;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .modal-close:hover {
            color: #3498db;
            transform: scale(1.2);
        }
        
        #modalMediaContainer {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #000;
        }
        
        #modalMediaContainer iframe {
            border: none;
        }
        
        .left-info-items {
            display: flex;
            gap: 20px;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: white;
            transition: all 0.3s ease;
            padding: 4px 12px;
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.1);
        }
        
        .info-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        
        .info-icon {
            margin-right: 8px;
            font-size: 0.9rem;
        }
        
        .info-label {
            font-weight: 600;
            font-size: 0.85rem;
            margin-right: 4px;
        }
        
        .info-value {
            font-size: 0.85rem;
        }
        
        .info-up {
            color: #4ade80;
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .info-down {
            color: #f87171;
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .info-details {
            font-size: 0.8rem;
            opacity: 0.9;
        }
        
        /* Bande défilante des voyageurs */
        .travel-marquee-container {
            flex: 1;
            overflow: hidden;
            position: relative;
            height: 24px;
            display: flex;
            align-items: center;
        }
        
        .travel-marquee {
            display: inline-block;
            white-space: nowrap;
            animation: marquee 65s linear infinite;
            padding-left: 100%;
        }
        
        .travel-marquee:hover {
            animation-play-state: paused;
        }
        
        @keyframes marquee {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-100%);
            }
        }
        
        .travel-message {
            display: inline-flex;
            align-items: center;
            margin: 0 30px;
            font-size: 0.85rem;
            color: white;
        }
        
        .travel-icon {
            margin-right: 8px;
            color: #fbbf24;
        }
        
        .travel-icon-img {
            width: 20px;
            height: 20px;
            margin-right: 8px;
            object-fit: contain;
            font-size: 0.9rem;
        }
        
        .travel-end-img {
            width: 16px;
            height: 16px;
            margin-left: 8px;
            object-fit: contain;
        }
        
        .travel-text {
            position: relative;
        }
        
        .travel-text::after {
            content: "•";
            margin-left: 30px;
            color: rgba(255, 255, 255, 0.3);
        }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .mega-menu {
                width: 95vw;
                grid-template-columns: repeat(2, 1fr);
            }
            
            .mega-menu-highlight {
                grid-column: span 2;
            }
            
            .travel-marquee {
                animation: marquee 65s linear infinite;
            }
            
            .mega-menu-templates {
                grid-template-columns: repeat(2, 1fr) !important;
                width: 95vw !important;
            }
            
            .mega-menu-main-content {
                flex-direction: column;
            }
            
            .mega-menu-icons-container {
                flex-direction: column;
            }
            
            .mega-menu-carousel {
                width: 100%;
            }
            
            .header-mega-menu {
                width: 92vw;
            }
            
            .header-content-wrapper {
                gap: 20px;
            }
            
            .mega-icon-circle {
                width: 50px;
                height: 50px;
                font-size: 1.3rem;
            }
        }
        
        @media (max-width: 992px) {
            .mega-menu {
                width: 95vw;
                left: 50%;
                transform: translateX(-50%) translateY(15px);
                grid-template-columns: repeat(2, 1fr);
                padding: 20px;
            }
            
            .mega-menu-container:hover .mega-menu {
                transform: translateX(-50%) translateY(0);
            }
            
            .footer-with-bg {
                padding: 60px 0 25px;
            }
            
            .info-header .container {
                flex-direction: column;
                gap: 10px;
            }
            
            .left-info-items {
                justify-content: center;
                width: 100%;
            }
            
            .travel-marquee-container {
                width: 100%;
                margin: 10px 0;
                order: 3;
            }
        }
        
        @media (max-width: 768px) {
            .back-to-top {
                width: 45px;
                height: 45px;
                font-size: 1.3rem;
                bottom: 250px;
                right: 15px;
            }
            
            .mega-menu {
                width: 90vw;
            }
            
            .footer-with-bg {
                padding: 50px 0 20px;
            }
            
            .footer-logo {
                height: 60px;
            }
            
            .left-info-items {
                flex-direction: column;
                gap: 8px;
            }
            
            .info-item {
                justify-content: center;
                width: 100%;
                max-width: 250px;
            }
            
            .travel-marquee {
                animation: marquee 55s linear infinite;
            }
            
            .travel-message {
                margin: 0 15px;
            }
            
            .mega-menu-templates {
                grid-template-columns: 1fr !important;
            }
            
            .header-content-wrapper {
                flex-direction: column;
                gap: 15px;
            }
            
            .left-info-items {
                width: 100%;
                justify-content: center;
            }
            
            .header-icons-bar {
                gap: 20px;
                flex-wrap: wrap;
            }
            
            .icon-circle {
                width: 45px;
                height: 45px;
                font-size: 1.1rem;
            }
            
            .icon-label {
                font-size: 0.75rem;
            }
            
            .mega-menu-icons-vertical {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }
            
            .header-mega-menu {
                width: 95vw;
            }
            
            .mega-menu-main-content {
                padding: 15px;
            }
            
            .mega-icon-circle {
                width: 45px;
                height: 45px;
                font-size: 1.2rem;
            }
            
            .mega-icon-label {
                font-size: 0.6rem;
            }
            
            .mega-menu-ticker {
                padding: 8px 15px;
                font-size: 0.75rem;
            }
        }
        
        @media (max-width: 576px) {
            .mega-menu {
                grid-template-columns: 1fr;
                width: 85vw;
            }
            
            .mega-menu-highlight {
                grid-column: span 1;
            }
            
            .travel-marquee {
                animation: marquee 50s linear infinite;
            }
            
            .travel-text::after {
                margin-left: 15px;
            }
        }

        /* 5 colonnes - 20% chacune */
        .col-md-2-4 {
            width: 20%;
            float: left;
            padding: 0 8px;
            box-sizing: border-box;
        }
        
        /* Clearfix */
        #regionsDropdownContainer::after {
            content: "";
            display: table;
            clear: both;
        }
        
        /* Style minimaliste des cartes */
        .region-card-simple {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 12px;
            border: 1px solid #e9ecef;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        
        .region-card-simple:hover {
            border-color: #007bff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .region-img-wrapper {
            height: 80px;
            overflow: hidden;
            position: relative;
        }
        
        .region-img-simple {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .region-name {
            padding: 10px 8px;
            text-align: center;
            font-size: 0.85rem;
            font-weight: 600;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }
        
        .region-item-simple {
            text-decoration: none;
            display: block;
            animation: fadeIn 0.3s ease forwards;
            opacity: 0;
        }
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .col-md-2-4 { width: 25%; padding: 0 6px; }
        }
        
        @media (max-width: 992px) {
            .col-md-2-4 { width: 33.333%; padding: 0 5px; }
            .region-img-wrapper { height: 70px; }
        }
        
        @media (max-width: 768px) {
            .col-md-2-4 { width: 50%; padding: 0 4px; }
            .region-img-wrapper { height: 65px; }
            .region-name { font-size: 0.8rem; padding: 8px 4px; }
        }
        
        @media (max-width: 480px) {
            .col-md-2-4 { width: 100%; padding: 0; }
            .region-card-simple { 
                display: flex; 
                align-items: center;
                margin-bottom: 8px;
            }
            .region-img-wrapper { 
                width: 100px; 
                height: 60px; 
                flex-shrink: 0; 
            }
            .region-name { 
                flex-grow: 1; 
                border: none; 
                text-align: left; 
                padding-left: 12px;
                background: white;
            }
        }
        
        /* Loader */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }
        
        /* Dropdown centré */
        .dropdown-menu.full-width {
            min-width: 100vw !important;
        }
    </style>
</head>
<body>
    <!-- Bouton retour en haut -->
    <button class="back-to-top" id="backToTop" aria-label="Retour en haut">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Header avec infos et navigation -->
    <header class="info-header" id="myScrollableContainer">
        <div class="container">
            <div class="header-content-wrapper">
                <!-- Barre de 5 icônes de navigation -->
                <div class="header-icons-bar" style="flex-shrink: 0;">
                <!-- Icône Info avec Mega Menu -->
                <div class="header-icon-container mega-menu-trigger">
                    <a href="#" class="header-icon-link" id="infoIconBtn">
                        <div class="icon-circle">
                            <img src="https://cdn-icons-png.flaticon.com/512/471/471662.png" alt="Info">
                        </div>
                        <span class="icon-label">Info</span>
                    </a>
                    
                    <!-- Mega Menu Info - Layout Complet -->
                    <div class="header-mega-menu" id="infoMegaMenu">
                        <!-- Défilement Bourse/Météo en haut - Cliquable -->
                        <div class="mega-menu-ticker">
                            <a href="#iframe-page-meteo-1" class="ticker-item">
                                <i class="fas fa-chart-line"></i>
                                <span>Bourse TSX: 21,450.12 <span class="ticker-up">+1.2%</span></span>
                            </a>
                            <a href="#iframe-page-meteo-1" class="ticker-item">
                                <i class="fas fa-cloud-sun"></i>
                                <span>Météo QC: -5°C Ensoleillé</span>
                            </a>
                            <a href="#iframe-page-meteo-1" class="ticker-item">
                                <i class="fas fa-chart-line"></i>
                                <span>Bourse TSX: 21,450.12 <span class="ticker-up">+1.2%</span></span>
                            </a>
                            <a href="#iframe-page-meteo-1" class="ticker-item">
                                <i class="fas fa-cloud-sun"></i>
                                <span>Météo QC: -5°C Ensoleillé</span>
                            </a>
                        </div>
                        
                        <!-- Contenu principal : Icônes à gauche + Carrousel à droite -->
                        <div class="mega-menu-main-content">
                            <!-- Gauche: 3 colonnes d'icônes -->
                            <div class="mega-menu-icons-container">
                                <!-- Colonne 1: EXPÉRIENCES QUÉBEC (9 icônes) -->
                                <div class="mega-menu-column">
                                    <h3 class="mega-menu-section-title">EXPÉRIENCES QUÉBEC</h3>
                                    <div class="mega-menu-icons-vertical">
                                <a href="{{url('/landing/experiences-quebec')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #4A90E2;">
                                        <i class="fas fa-wheelchair"></i>
                                    </div>
                                    <span class="mega-icon-label">Accessibilité</span>
                                </a>
                                <a href="{{url('/landing/transport-aerien')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #F5A623;">
                                        <i class="fas fa-plane-departure"></i>
                                    </div>
                                    <span class="mega-icon-label">Vols</span>
                                </a>
                                <a href="{{url('/landing/hotels')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #2C3E50;">
                                        <i class="fas fa-suitcase"></i>
                                    </div>
                                    <span class="mega-icon-label">Bagages</span>
                                </a>
                                <a href="{{url('/landing/transport-terrestre')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #E74C3C;">
                                        <i class="fas fa-bus"></i>
                                    </div>
                                    <span class="mega-icon-label">Transport</span>
                                </a>
                                <a href="{{url('/landing/destinations')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #3498DB;">
                                        <i class="fas fa-globe-americas"></i>
                                    </div>
                                    <span class="mega-icon-label">Destinations</span>
                                </a>
                                <a href="{{url('/landing/guides')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #F39C12;">
                                        <i class="fas fa-bullhorn"></i>
                                    </div>
                                    <span class="mega-icon-label">Guides</span>
                                </a>
                                <a href="{{url('/landing/assurances')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #9B59B6;">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <span class="mega-icon-label">Assurance</span>
                                </a>
                                <a href="{{url('/landing/experiences-quebec')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #1ABC9C;">
                                        <i class="fas fa-camera"></i>
                                    </div>
                                    <span class="mega-icon-label">Photos</span>
                                </a>
                                <a href="{{url('/landing/transport-maritime')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #16A085;">
                                        <i class="fas fa-ship"></i>
                                    </div>
                                    <span class="mega-icon-label">Croisières</span>
                                </a>
                                    </div>
                                </div>
                                
                                <!-- Colonne 2: EXPÉRIENCES CANADA (12 icônes) -->
                                <div class="mega-menu-column">
                                    <h3 class="mega-menu-section-title">EXPÉRIENCES CANADA</h3>
                                    <div class="mega-menu-icons-vertical">
                                <a href="{{url('/landing/experiences-canada')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #E74C3C;">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                    <span class="mega-icon-label">Événements</span>
                                </a>
                                <a href="{{url('/landing/experiences-canada')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #F39C12;">
                                        <i class="fas fa-mountain"></i>
                                    </div>
                                    <span class="mega-icon-label">Rocheuses</span>
                                </a>
                                <a href="{{url('/landing/experiences-canada')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #16A085;">
                                        <i class="fas fa-tree"></i>
                                    </div>
                                    <span class="mega-icon-label">Nature</span>
                                </a>
                                <a href="{{url('/landing/experiences-canada')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #2980B9;">
                                        <i class="fas fa-snowflake"></i>
                                    </div>
                                    <span class="mega-icon-label">Hiver</span>
                                </a>
                                <a href="{{url('/landing/experiences-canada')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #8E44AD;">
                                        <i class="fas fa-city"></i>
                                    </div>
                                    <span class="mega-icon-label">Villes</span>
                                </a>
                                <a href="{{url('/landing/experiences-canada')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #27AE60;">
                                        <i class="fas fa-utensils"></i>
                                    </div>
                                    <span class="mega-icon-label">Gastronomie</span>
                                </a>
                                <a href="{{url('/landing/experiences-canada')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #E67E22;">
                                        <i class="fas fa-flag-checkered"></i>
                                    </div>
                                    <span class="mega-icon-label">Festivals</span>
                                </a>
                                <a href="{{url('/landing/experiences-canada')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #27AE60;">
                                        <i class="fas fa-recycle"></i>
                                    </div>
                                    <span class="mega-icon-label">Écologie</span>
                                </a>
                                <a href="{{url('/landing/certifications')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #2ECC71;">
                                        <i class="fas fa-leaf"></i>
                                    </div>
                                    <span class="mega-icon-label">Qualité</span>
                                </a>
                                <a href="{{url('/landing/experiences-canada')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #E67E22;">
                                        <i class="fas fa-cloud"></i>
                                    </div>
                                    <span class="mega-icon-label">Météo</span>
                                </a>
                                <a href="{{url('/landing/experiences-canada')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #95A5A6;">
                                        <i class="fas fa-swimmer"></i>
                                    </div>
                                    <span class="mega-icon-label">Activités</span>
                                </a>
                                <a href="{{url('/landing/experiences-canada')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #34495E;">
                                        <i class="fas fa-water"></i>
                                    </div>
                                    <span class="mega-icon-label">Nautique</span>
                                </a>
                                    </div>
                                </div>
                                
                                <!-- Colonne 3: EXPÉRIENCES RÉGIONAL (9 icônes) -->
                                <div class="mega-menu-column">
                                    <h3 class="mega-menu-section-title">EXPÉRIENCES RÉGIONAL</h3>
                                    <div class="mega-menu-icons-vertical">
                                <a href="{{url('/landing/experiences-regional')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #3498DB;">
                                        <i class="fas fa-fish"></i>
                                    </div>
                                    <span class="mega-icon-label">Pêche</span>
                                </a>
                                <a href="{{url('/landing/experiences-regional')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #1ABC9C;">
                                        <i class="fas fa-spa"></i>
                                    </div>
                                    <span class="mega-icon-label">Spa</span>
                                </a>
                                <a href="{{url('/landing/experiences-regional')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #9B59B6;">
                                        <i class="fas fa-wine-glass-alt"></i>
                                    </div>
                                    <span class="mega-icon-label">Vignobles</span>
                                </a>
                                <a href="{{url('/landing/locations')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #E74C3C;">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <span class="mega-icon-label">Chalets</span>
                                </a>
                                <a href="{{url('/landing/experiences-regional')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #F39C12;">
                                        <i class="fas fa-binoculars"></i>
                                    </div>
                                    <span class="mega-icon-label">Observation</span>
                                </a>
                                <a href="{{url('/landing/experiences-regional')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #16A085;">
                                        <i class="fas fa-campground"></i>
                                    </div>
                                    <span class="mega-icon-label">Camping</span>
                                </a>
                                <a href="{{url('/landing/experiences-regional')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #2C3E50;">
                                        <i class="fas fa-video"></i>
                                    </div>
                                    <span class="mega-icon-label">Vidéos</span>
                                </a>
                                <a href="{{url('/landing/experiences-regional')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #E74C3C;">
                                        <i class="fas fa-fire"></i>
                                    </div>
                                    <span class="mega-icon-label">Urgence</span>
                                </a>
                                <a href="{{url('/landing/urgences')}}" class="mega-icon-item">
                                    <div class="mega-icon-circle" style="background: #27AE60;">
                                        <i class="fas fa-heartbeat"></i>
                                    </div>
                                    <span class="mega-icon-label">Santé</span>
                                </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Droite: Carrousel Vidéo/Photo -->
                            <div class="mega-menu-carousel">
                                <div class="carousel-scroll-container" id="carouselContainer">
                                    <!-- Vidéo YouTube 1 -->
                                    <div class="carousel-item-simple active" onclick="openMediaModal('video', 'https://www.youtube.com/embed/hdxKTW1ER5w?autoplay=1')">
                                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; position: relative; cursor: pointer; overflow: hidden;">
                                            <i class="fab fa-youtube" style="font-size: 60px; color: white; opacity: 0.9;"></i>
                                            <div style="position: absolute; bottom: 20px; left: 20px; color: white; font-size: 18px; font-weight: 600;">🎥 Québec Travel</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Image 1 -->
                                    <div class="carousel-item-simple" onclick="openMediaModal('image', 'https://picsum.photos/800/600?random=1')">
                                        <img src="https://picsum.photos/270/400?random=1" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px; cursor: pointer;" alt="Québec">
                                    </div>
                                    
                                    <!-- Vidéo YouTube 2 -->
                                    <div class="carousel-item-simple" onclick="openMediaModal('video', 'https://www.youtube.com/embed/SBjQ9tuuTJQ?autoplay=1')">
                                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; position: relative; cursor: pointer; overflow: hidden;">
                                            <i class="fab fa-youtube" style="font-size: 60px; color: white; opacity: 0.9;"></i>
                                            <div style="position: absolute; bottom: 20px; left: 20px; color: white; font-size: 18px; font-weight: 600;">🎥 Canada Travel</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Image 2 -->
                                    <div class="carousel-item-simple" onclick="openMediaModal('image', 'https://picsum.photos/800/600?random=2')">
                                        <img src="https://picsum.photos/270/400?random=2" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px; cursor: pointer;" alt="Montréal">
                                    </div>
                                    
                                    <!-- Image 3 -->
                                    <div class="carousel-item-simple" onclick="openMediaModal('image', 'https://picsum.photos/800/600?random=3')">
                                        <img src="https://picsum.photos/270/400?random=3" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px; cursor: pointer;" alt="Nature">
                                    </div>
                                    
                                    <!-- Vidéo YouTube 3 -->
                                    <div class="carousel-item-simple" onclick="openMediaModal('video', 'https://www.youtube.com/embed/Uj3_KqkI9Zo?autoplay=1')">
                                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; position: relative; cursor: pointer; overflow: hidden;">
                                            <i class="fab fa-youtube" style="font-size: 60px; color: white; opacity: 0.9;"></i>
                                            <div style="position: absolute; bottom: 20px; left: 20px; color: white; font-size: 18px; font-weight: 600;">🎥 Nature Travel</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Image 4 -->
                                    <div class="carousel-item-simple" onclick="openMediaModal('image', 'https://picsum.photos/800/600?random=4')">
                                        <img src="https://picsum.photos/270/400?random=4" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px; cursor: pointer;" alt="Aventure">
                                    </div>
                                    
                                    <!-- Image 5 -->
                                    <div class="carousel-item-simple" onclick="openMediaModal('image', 'https://picsum.photos/800/600?random=5')">
                                        <img src="https://picsum.photos/270/400?random=5" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px; cursor: pointer;" alt="Ski">
                                    </div>
                                    
                                    <!-- Image 6 -->
                                    <div class="carousel-item-simple" onclick="openMediaModal('image', 'https://picsum.photos/800/600?random=6')">
                                        <img src="https://picsum.photos/270/400?random=6" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px; cursor: pointer;" alt="Festival">
                                    </div>
                                    
                                    <!-- Image 7 -->
                                    <div class="carousel-item-simple" onclick="openMediaModal('image', 'https://picsum.photos/800/600?random=7')">
                                        <img src="https://picsum.photos/270/400?random=7" style="width: 100%; height: 100%; object-fit: cover; border-radius: 10px; cursor: pointer;" alt="Gastronomie">
                                    </div>
                                    
                                    <!-- Indicateurs de navigation -->
                                    <div class="carousel-indicators">
                                        <span class="carousel-dot active" data-index="0"></span>
                                        <span class="carousel-dot" data-index="1"></span>
                                        <span class="carousel-dot" data-index="2"></span>
                                        <span class="carousel-dot" data-index="3"></span>
                                        <span class="carousel-dot" data-index="4"></span>
                                        <span class="carousel-dot" data-index="5"></span>
                                        <span class="carousel-dot" data-index="6"></span>
                                        <span class="carousel-dot" data-index="7"></span>
                                        <span class="carousel-dot" data-index="8"></span>
                                        <span class="carousel-dot" data-index="9"></span>
                                    </div>
                                    
                                    <!-- Boutons de navigation -->
                                    <button class="carousel-nav-btn prev" id="carouselPrev">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button class="carousel-nav-btn next" id="carouselNext">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Icône Promotions -->
                <div class="header-icon-container">
                    <a href="{{url('/landing/promotions')}}" class="header-icon-link">
                        <div class="icon-circle">
                            <img src="{{asset('header_info/h2.png')}}" alt="Promotions">
                        </div>
                        <span class="icon-label">Promotions</span>
                    </a>
                </div>
                
                <!-- Icône Recherche/Exploration -->
                <div class="header-icon-container">
                    <a href="{{url('/landing/explorer')}}" class="header-icon-link">
                        <div class="icon-circle">
                            <img src="{{asset('header_info/h3.png')}}" alt="Recherche">
                        </div>
                        <span class="icon-label">Recherche</span>
                    </a>
                </div>
                
                <!-- Icône Globe/Destinations -->
                <div class="header-icon-container">
                    <a href="{{url('/landing/destinations')}}" class="header-icon-link">
                        <div class="icon-circle">
                            <img src="{{asset('header_info/h4.png')}}" alt="Globe">
                        </div>
                        <span class="icon-label">Globe</span>
                    </a>
                </div>
                
                <!-- Icône Validation/Approved -->
                <div class="header-icon-container">
                    <a href="{{url('/landing/certifications')}}" class="header-icon-link">
                        <div class="icon-circle">
                            <img src="{{asset('header_info/h5.png')}}" alt="Certifié">
                        </div>
                        <span class="icon-label">Certifié</span>
                    </a>
                </div>
            </div>
            
            <!-- Bande défilante avec messages aux voyageurs -->
            <div class="travel-marquee-container">
                <div class="travel-marquee">
                    <div class="travel-message">
                        <img src="{{asset('header_info/map1.png')}}" alt="Map" class="travel-icon-img">
                        <span class="travel-text">✈️ Explorez les magnifiques paysages du Québec cet été !</span>
                        <img src="{{asset('header_info/h6.png')}}" alt="End" class="travel-end-img">
                    </div>
                    <div class="travel-message">
                        <img src="{{asset('header_info/map2.png')}}" alt="Map" class="travel-icon-img">
                        <span class="travel-text">❄️ Stations de ski ouvertes - Profitez de la poudreuse fraîche !</span>
                        <img src="{{asset('header_info/h6.png')}}" alt="End" class="travel-end-img">
                    </div>
                    <div class="travel-message">
                        <img src="{{asset('header_info/map1.png')}}" alt="Map" class="travel-icon-img">
                        <span class="travel-text">🗺️ Découvrez nos itinéraires touristiques exclusifs</span>
                        <img src="{{asset('header_info/h6.png')}}" alt="End" class="travel-end-img">
                    </div>
                    <div class="travel-message">
                        <img src="{{asset('header_info/map2.png')}}" alt="Map" class="travel-icon-img">
                        <span class="travel-text">🍽️ Goûtez à la cuisine québécoise authentique dans nos restaurants partenaires</span>
                        <img src="{{asset('header_info/h6.png')}}" alt="End" class="travel-end-img">
                    </div>
                    <div class="travel-message">
                        <img src="{{asset('header_info/map1.png')}}" alt="Map" class="travel-icon-img">
                        <span class="travel-text">🏷️ Offres spéciales vacances - Jusqu'à 30% de réduction</span>
                        <img src="{{asset('header_info/h6.png')}}" alt="End" class="travel-end-img">
                    </div>
                    <div class="travel-message">
                        <img src="{{asset('header_info/map2.png')}}" alt="Map" class="travel-icon-img">
                        <span class="travel-text">📅 Événements à venir : Festival d'été de Québec, Fête nationale et plus !</span>
                        <img src="{{asset('header_info/h6.png')}}" alt="End" class="travel-end-img">
                    </div>
                </div>
            </div>
            </div>
            
            <!-- Modal pour afficher vidéo/image en grand -->
            <div id="mediaModal" class="media-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.95); z-index: 10000; justify-content: center; align-items: center;">
                <button onclick="closeMediaModal()" style="position: absolute; top: 20px; right: 30px; background: transparent; border: none; color: white; font-size: 40px; cursor: pointer; z-index: 10001;">&times;</button>
                <div id="modalMediaContainer" style="width: 90%; max-width: 1200px; height: 80%; background: #000; border-radius: 12px; overflow: hidden;"></div>
            </div>
            
            <script>
            // Fonction pour ouvrir la modal
            function openMediaModal(type, src) {
                const modal = document.getElementById('mediaModal');
                const container = document.getElementById('modalMediaContainer');
                
                container.innerHTML = '';
                
                if (type === 'video') {
                    const iframe = document.createElement('iframe');
                    iframe.src = src;
                    iframe.style.width = '100%';
                    iframe.style.height = '100%';
                    iframe.style.border = 'none';
                    iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
                    iframe.allowFullscreen = true;
                    container.appendChild(iframe);
                } else {
                    const img = document.createElement('img');
                    img.src = src;
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'contain';
                    container.appendChild(img);
                }
                
                modal.style.display = 'flex';
            }
            
            // Fonction pour fermer la modal
            function closeMediaModal() {
                const modal = document.getElementById('mediaModal');
                const container = document.getElementById('modalMediaContainer');
                modal.style.display = 'none';
                container.innerHTML = '';
            }
            
            // Fermer en cliquant en dehors
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('mediaModal');
                if (modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === modal) {
                            closeMediaModal();
                        }
                    });
                }
                
                // Carrousel automatique (slideshow)
                const carouselItems = document.querySelectorAll('.carousel-item-simple');
                const carouselDots = document.querySelectorAll('.carousel-dot');
                let currentIndex = 0;
                let autoPlayInterval;
                
                function showSlide(index) {
                    // Retirer la classe active de tous les items et dots
                    carouselItems.forEach(item => item.classList.remove('active'));
                    carouselDots.forEach(dot => dot.classList.remove('active'));
                    
                    // Ajouter la classe active à l'item et dot courant
                    if (carouselItems[index]) {
                        carouselItems[index].classList.add('active');
                    }
                    if (carouselDots[index]) {
                        carouselDots[index].classList.add('active');
                    }
                    
                    currentIndex = index;
                }
                
                function nextSlide() {
                    let nextIndex = (currentIndex + 1) % carouselItems.length;
                    showSlide(nextIndex);
                }
                
                function startAutoPlay() {
                    autoPlayInterval = setInterval(nextSlide, 4000); // Change toutes les 4 secondes
                }
                
                function stopAutoPlay() {
                    clearInterval(autoPlayInterval);
                }
                
                function prevSlide() {
                    let prevIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
                    showSlide(prevIndex);
                }
                
                // Navigation par les dots
                carouselDots.forEach((dot, index) => {
                    dot.addEventListener('click', function() {
                        stopAutoPlay();
                        showSlide(index);
                        startAutoPlay();
                    });
                });
                
                // Navigation par les boutons
                const prevBtn = document.getElementById('carouselPrev');
                const nextBtn = document.getElementById('carouselNext');
                
                if (prevBtn) {
                    prevBtn.addEventListener('click', function() {
                        stopAutoPlay();
                        prevSlide();
                        startAutoPlay();
                    });
                }
                
                if (nextBtn) {
                    nextBtn.addEventListener('click', function() {
                        stopAutoPlay();
                        nextSlide();
                        startAutoPlay();
                    });
                }
                
                // Pause au hover du carrousel
                const carouselContainer = document.getElementById('carouselContainer');
                if (carouselContainer) {
                    carouselContainer.addEventListener('mouseenter', stopAutoPlay);
                    carouselContainer.addEventListener('mouseleave', startAutoPlay);
                }
                
                // Démarrer l'autoplay
                if (carouselItems.length > 0) {
                    startAutoPlay();
                }
            });
            </script>
        </div>
    </header>

    <!-- Top Bar avec méga-menu -->
    <div class="top-bar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="contact-info">
                    <a href="tel:4185257748" class="contact-link">
                        <i class="fas fa-phone-alt me-1"></i> (418) 525-7748
                    </a>
                    <a href="mailto:infogoexploria@gmail.com" class="contact-link">
                        <i class="fas fa-envelope me-1"></i> infogoexploria@gmail.com
                    </a>
                </div>

                <div class="item-btns">
                    <!-- NOUVEAU : Bouton Nos Templates avec méga-menu -->
                    <div class="mega-menu-container">
                        <button class="btn btn-sm btn-outline-primary me-2" id="templatesBtn">
                            <i class="fas fa-palette me-1"></i>Nos Templates
                        </button>
                        
                        <!-- Méga-menu Templates 8 catégories -->
                        <div class="mega-menu mega-menu-templates" id="templatesMegaMenu">
                            <!-- Colonne 1 : E-commerce & Retail -->
                            <div class="mega-menu-column">
                                <h4><i class="fas fa-shopping-cart me-2"></i>E-commerce</h4>
                                <a href="{{url('template/preview/84')}}" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1523474253046-8cd2748b5fd2?w=400&h=400&fit=crop" class="mega-menu-image" alt="Boutique Mode">
                                    <div class="mega-menu-text">
                                        <h6>Boutique Mode</h6>
                                        <p>Site e-commerce pour vêtements</p>
                                    </div>
                                </a>
                                <a href="{{url('template/preview/87')}}" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=400&h=400&fit=crop" class="mega-menu-image" alt="Marketplace">
                                    <div class="mega-menu-text">
                                        <h6>Marketplace</h6>
                                        <p>Place de marché multi-vendeurs</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400&h=400&fit=crop" class="mega-menu-image" alt="DropShipping">
                                    <div class="mega-menu-text">
                                        <h6>Dropshipping</h6>
                                        <p>Solution clé en main</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1472851294608-062f824d29cc?w=400&h=400&fit=crop" class="mega-menu-image" alt="Cosmétiques">
                                    <div class="mega-menu-text">
                                        <h6>Cosmétiques & Beauté</h6>
                                        <p>Design épuré et élégant</p>
                                    </div>
                                </a>
                            </div>
                            
                            <!-- Colonne 2 : Services & Professionnels -->
                            <div class="mega-menu-column">
                                <h4><i class="fas fa-briefcase me-2"></i>Services</h4>
                                <a href="{{url('template/preview/91')}}" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=400&h=400&fit=crop" class="mega-menu-image" alt="Cabinet Conseil">
                                    <div class="mega-menu-text">
                                        <h6>Cabinet Conseil</h6>
                                        <p>Site vitrine professionnel</p>
                                    </div>
                                </a>
                                <a href="{{url('template/preview/92')}}" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=400&h=400&fit=crop" class="mega-menu-image" alt="Services Médicaux">
                                    <div class="mega-menu-text">
                                        <h6>Services Médicaux</h6>
                                        <p>Prise de rendez-vous en ligne</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=400&h=400&fit=crop" class="mega-menu-image" alt="Services Juridiques">
                                    <div class="mega-menu-text">
                                        <h6>Services Juridiques</h6>
                                        <p>Avocats & notaires</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1560250056-07ba64664864?w=400&h=400&fit=crop" class="mega-menu-image" alt="Coaching">
                                    <div class="mega-menu-text">
                                        <h6>Coaching & Formation</h6>
                                        <p>Plateforme de cours</p>
                                    </div>
                                </a>
                            </div>
                            
                            <!-- Colonne 3 : Travel & Hospitality -->
                            <div class="mega-menu-column">
                                <h4><i class="fas fa-plane me-2"></i>Travel</h4>
                                <a href="{{url('template/preview/89')}}" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=400&h=400&fit=crop" class="mega-menu-image" alt="Agence Voyage">
                                    <div class="mega-menu-text">
                                        <h6>Agence de Voyage</h6>
                                        <p>Forfaits et réservations</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&h=400&fit=crop" class="mega-menu-image" alt="Hôtellerie">
                                    <div class="mega-menu-text">
                                        <h6>Hôtellerie</h6>
                                        <p>Réservation en ligne</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=400&h=400&fit=crop" class="mega-menu-image" alt="Location Saisonnière">
                                    <div class="mega-menu-text">
                                        <h6>Location Saisonnière</h6>
                                        <p>Gestion des disponibilités</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=400&h=400&fit=crop" class="mega-menu-image" alt="Tours Opérateur">
                                    <div class="mega-menu-text">
                                        <h6>Tours Opérateur</h6>
                                        <p>Circuits et excursions</p>
                                    </div>
                                </a>
                            </div>
                            
                            <!-- Colonne 4 : Entreprise & B2B -->
                            <div class="mega-menu-column">
                                <h4><i class="fas fa-building me-2"></i>Entreprise</h4>
                                <a href="{{url('template/preview/90')}}" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=400&h=400&fit=crop" class="mega-menu-image" alt="Site Corporate">
                                    <div class="mega-menu-text">
                                        <h6>Site Corporate</h6>
                                        <p>Présence institutionnelle</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=400&fit=crop" class="mega-menu-image" alt="Startup">
                                    <div class="mega-menu-text">
                                        <h6>Startup</h6>
                                        <p>Landing page moderne</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=400&fit=crop" class="mega-menu-image" alt="Industrie">
                                    <div class="mega-menu-text">
                                        <h6>Industrie & Manufacture</h6>
                                        <p>Catalogue produits</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=400&h=400&fit=crop" class="mega-menu-image" alt="Immobilier">
                                    <div class="mega-menu-text">
                                        <h6>Immobilier</h6>
                                        <p>Listings propriétés</p>
                                    </div>
                                </a>
                            </div>
                            
                            <!-- Colonne 5 : Food & Alimentation -->
                            <div class="mega-menu-column">
                                <h4><i class="fas fa-utensils me-2"></i>Food & Alimentation</h4>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=400&h=400&fit=crop" class="mega-menu-image" alt="Restaurant">
                                    <div class="mega-menu-text">
                                        <h6>Restaurant</h6>
                                        <p>Menu et réservations</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1556740714-a8395b3bf30f?w=400&h=400&fit=crop" class="mega-menu-image" alt="Boulangerie">
                                    <div class="mega-menu-text">
                                        <h6>Boulangerie/Pâtisserie</h6>
                                        <p>Commande en ligne</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1488459716781-31db52582fe9?w=400&h=400&fit=crop" class="mega-menu-image" alt="Traiteur">
                                    <div class="mega-menu-text">
                                        <h6>Traiteur</h6>
                                        <p>Événements et buffets</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1564758582685-88e7885d10c7?w=400&h=400&fit=crop" class="mega-menu-image" alt="Épicerie Fine">
                                    <div class="mega-menu-text">
                                        <h6>Épicerie Fine</h6>
                                        <p>Produits locaux</p>
                                    </div>
                                </a>
                            </div>
                            
                            <!-- Colonne 6 : Beauté & Bien-être -->
                            <div class="mega-menu-column">
                                <h4><i class="fas fa-heart me-2"></i>Beauté & Bien-être</h4>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1560750588-73207b1ef5b8?w=400&h=400&fit=crop" class="mega-menu-image" alt="Salon Coiffure">
                                    <div class="mega-menu-text">
                                        <h6>Salon de Coiffure</h6>
                                        <p>Prise de rendez-vous</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1600334089648-b0d9d3028eb2?w=400&h=400&fit=crop" class="mega-menu-image" alt="Spa">
                                    <div class="mega-menu-text">
                                        <h6>Spa & Bien-être</h6>
                                        <p>Forfaits relaxants</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=400&h=400&fit=crop" class="mega-menu-image" alt="Salle Sport">
                                    <div class="mega-menu-text">
                                        <h6>Salle de Sport</h6>
                                        <p>Abonnements en ligne</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1598514982418-0f7051c30492?w=400&h=400&fit=crop" class="mega-menu-image" alt="Yoga">
                                    <div class="mega-menu-text">
                                        <h6>Yoga & Méditation</h6>
                                        <p>Cours virtuels</p>
                                    </div>
                                </a>
                            </div>
                            
                            <!-- Colonne 7 : Éducation & Formation -->
                            <div class="mega-menu-column">
                                <h4><i class="fas fa-graduation-cap me-2"></i>Éducation & Formation</h4>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=400&h=400&fit=crop" class="mega-menu-image" alt="École">
                                    <div class="mega-menu-text">
                                        <h6>École & Université</h6>
                                        <p>Portail éducatif</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&h=400&fit=crop" class="mega-menu-image" alt="Formation Pro">
                                    <div class="mega-menu-text">
                                        <h6>Formation Professionnelle</h6>
                                        <p>LMS et certifications</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400&h=400&fit=crop" class="mega-menu-image" alt="Cours en Ligne">
                                    <div class="mega-menu-text">
                                        <h6>Cours en Ligne</h6>
                                        <p>Plateforme e-learning</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=400&h=400&fit=crop" class="mega-menu-image" alt="Tutorat">
                                    <div class="mega-menu-text">
                                        <h6>Tutorat</h6>
                                        <p>Soutien scolaire</p>
                                    </div>
                                </a>
                            </div>
                            
                            <!-- Colonne 8 : Créatifs & Artisans -->
                            <div class="mega-menu-column">
                                <h4><i class="fas fa-paint-brush me-2"></i>Créatifs & Artisans</h4>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?w=400&h=400&fit=crop" class="mega-menu-image" alt="Portfolio">
                                    <div class="mega-menu-text">
                                        <h6>Portfolio Artiste</h6>
                                        <p>Galerie d'oeuvres</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?w=400&h=400&fit=crop" class="mega-menu-image" alt="Photographe">
                                    <div class="mega-menu-text">
                                        <h6>Photographe</h6>
                                        <p>Shooting et portfolios</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?w=400&h=400&fit=crop" class="mega-menu-image" alt="Designer">
                                    <div class="mega-menu-text">
                                        <h6>Designer</h6>
                                        <p>Showcase créatif</p>
                                    </div>
                                </a>
                                <a href="#" class="mega-menu-link" target="_blank">
                                    <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?w=400&h=400&fit=crop" class="mega-menu-image" alt="Artisanat">
                                    <div class="mega-menu-text">
                                        <h6>Artisanat</h6>
                                        <p>Créations uniques</p>
                                    </div>
                                </a>
                            </div>
                            
                            <!-- Élément mis en avant -->
                            <div class="mega-menu-highlight">
                                <h4><i class="fas fa-star me-2"></i>Templates Populaires</h4>
                                <div class="d-flex gap-3">
                                    <div class="highlight-item">
                                        <i class="fas fa-crown highlight-icon"></i>
                                        <div>
                                            <h6>Template Premium</h6>
                                            <p>Design exclusif - 30% de réduction</p>
                                        </div>
                                    </div>
                                    <div class="highlight-item">
                                        <i class="fas fa-rocket highlight-icon"></i>
                                        <div>
                                            <h6>Nouveauté 2026</h6>
                                            <p>Templates IA générative</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="#" class="btn btn-sm btn-light">Voir tous les templates →</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton Services Web avec méga-menu -->
                    <div class="mega-menu-container">
                        <button class="btn btn-sm btn-primary me-2" id="servicesWebBtn">
                            <i class="fas fa-globe me-1"></i>Services Web
                        </button>
                        
                        <!-- Méga-menu Services Web -->
                        <div class="mega-menu" id="webServicesMegaMenu">
                            <!-- Colonne 1 : Création Web -->
                            <div class="mega-menu-column">
                                <h4>Création Web</h4>
                                <a href="#iframe-page-web-1" class="mega-menu-link">
                                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=400&fit=crop" class="mega-menu-image" alt="Sites Vitrine">
                                    <div class="mega-menu-text">
                                        <h6>Sites Vitrine</h6>
                                        <p>Présence en ligne professionnelle</p>
                                    </div>
                                </a>
                                
                                <a href="#" class="mega-menu-link">
                                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=400&h=400&fit=crop" class="mega-menu-image" alt="E-commerce">
                                    <div class="mega-menu-text">
                                        <h6>E-commerce</h6>
                                        <p>Boutique en ligne complète</p>
                                    </div>
                                </a>
                                
                                <a href="#" class="mega-menu-link">
                                    <img src="https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?w=400&h=400&fit=crop" class="mega-menu-image" alt="Blogs & CMS">
                                    <div class="mega-menu-text">
                                        <h6>Blogs & CMS</h6>
                                        <p>Plateformes de contenu</p>
                                    </div>
                                </a>
                                
                                <a href="#" class="mega-menu-link">
                                    <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?w=400&h=400&fit=crop" class="mega-menu-image" alt="Applications Web">
                                    <div class="mega-menu-text">
                                        <h6>Applications Web</h6>
                                        <p>Solutions sur mesure</p>
                                    </div>
                                </a>
                            </div>
                            
                            <!-- Colonne 2 : Marketing Digital -->
                            <div class="mega-menu-column">
                                <h4>Marketing Digital</h4>
                                <a href="#" class="mega-menu-link">
                                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=400&fit=crop" class="mega-menu-image" alt="SEO">
                                    <div class="mega-menu-text">
                                        <h6>SEO</h6>
                                        <p>Optimisation pour moteurs</p>
                                    </div>
                                </a>
                                
                                <a href="#" class="mega-menu-link">
                                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=400&fit=crop" class="mega-menu-image" alt="Publicité en Ligne">
                                    <div class="mega-menu-text">
                                        <h6>Publicité en Ligne</h6>
                                        <p>Google Ads, Facebook Ads</p>
                                    </div>
                                </a>
                                
                                <a href="#" class="mega-menu-link">
                                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=400&fit=crop" class="mega-menu-image" alt="Analyse Web">
                                    <div class="mega-menu-text">
                                        <h6>Analyse Web</h6>
                                        <p>Google Analytics, tracking</p>
                                    </div>
                                </a>
                                
                                <a href="#" class="mega-menu-link">
                                    <img src="https://images.unsplash.com/photo-1545235617-9465d2a55698?w=400&h=400&fit=crop" class="mega-menu-image" alt="Email Marketing">
                                    <div class="mega-menu-text">
                                        <h6>Email Marketing</h6>
                                        <p>Campagnes automatiques</p>
                                    </div>
                                </a>
                            </div>
                            
                            <!-- Colonne 3 : Hébergement & Support -->
                            <div class="mega-menu-column">
                                <h4>Hébergement & Support</h4>
                                <a href="#" class="mega-menu-link">
                                    <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=400&h=400&fit=crop" class="mega-menu-image" alt="Hébergement Web">
                                    <div class="mega-menu-text">
                                        <h6>Hébergement Web</h6>
                                        <p>Serveurs performants</p>
                                    </div>
                                </a>
                                
                                <a href="#" class="mega-menu-link">
                                    <img src="https://images.unsplash.com/photo-1556075798-4825dfaaf498?w=400&h=400&fit=crop" class="mega-menu-image" alt="Sécurité SSL">
                                    <div class="mega-menu-text">
                                        <h6>Sécurité SSL</h6>
                                        <p>Certificats de sécurité</p>
                                    </div>
                                </a>
                                
                                <a href="#" class="mega-menu-link">
                                    <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=400&h=400&fit=crop" class="mega-menu-image" alt="Maintenance">
                                    <div class="mega-menu-text">
                                        <h6>Maintenance</h6>
                                        <p>Mises à jour régulières</p>
                                    </div>
                                </a>
                                
                                <a href="#" class="mega-menu-link">
                                    <img src="https://images.unsplash.com/photo-1586281380349-632531db7ed4?w=400&h=400&fit=crop" class="mega-menu-image" alt="Support 24/7">
                                    <div class="mega-menu-text">
                                        <h6>Support 24/7</h6>
                                        <p>Assistance technique</p>
                                    </div>
                                </a>
                            </div>
                            
                            <!-- Colonne 4 : Solutions Entreprise -->
                            <div class="mega-menu-column">
                                <h4>Solutions Entreprise</h4>
                                <a href="#" class="mega-menu-link">
                                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=400&fit=crop" class="mega-menu-image" alt="ERP & CRM">
                                    <div class="mega-menu-text">
                                        <h6>ERP & CRM</h6>
                                        <p>Systèmes de gestion intégrés</p>
                                    </div>
                                </a>
                                
                                <a href="#" class="mega-menu-link">
                                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=400&fit=crop" class="mega-menu-image" alt="Réseaux Sociaux">
                                    <div class="mega-menu-text">
                                        <h6>Gestion Réseaux Sociaux</h6>
                                        <p>Stratégie et publication</p>
                                    </div>
                                </a>
                                
                                <a href="#" class="mega-menu-link">
                                    <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=400&h=400&fit=crop" class="mega-menu-image" alt="Formation">
                                    <div class="mega-menu-text">
                                        <h6>Formation Digital</h6>
                                        <p>Formation à vos outils</p>
                                    </div>
                                </a>
                                
                                <a href="#" class="mega-menu-link">
                                    <img src="https://images.unsplash.com/photo-1533750349088-cd871a92f312?w=400&h=400&fit=crop" class="mega-menu-image" alt="Consultation">
                                    <div class="mega-menu-text">
                                        <h6>Consultation Stratégique</h6>
                                        <p>Audit et recommandations</p>
                                    </div>
                                </a>
                            </div>
                            
                            <div>
                                <a href="">Voir nos plans d'affichages</a>
                            </div>
                        </div>
                    </div>
                    
                    <a href="#info-forfaits-go-exploria" class="btn btn-sm btn-secondary">
                        <i class="fas fa-list me-1"></i>Nos plans
                    </a>
                </div>
                
                <div class="top-bar-icons">
                    <!-- Mon compte -->
                    <a href="{{route('register')}}" class="top-bar-icon">
                        <i class="fas fa-user-plus"></i>
                        <span>S'inscrire</span>
                    </a>
                    <a href="{{route('login')}}" class="top-bar-icon">
                        <i class="fas fa-user"></i>
                        <span>Mon compte</span>
                    </a>
                    
                    <!-- Localisation / Langue -->
                    <div class="language-selector">
                        <button class="language-btn" id="languageBtn">
                            <img src="https://flagcdn.com/w20/fr.png" class="flag-icon" alt="Français">
                            <span>FR</span>
                            <i class="fas fa-chevron-down ms-1"></i>
                        </button>
                        <div class="language-dropdown" id="languageDropdown">
                            <a href="#" class="language-option" data-lang="fr">
                                <img src="https://flagcdn.com/w20/fr.png" class="flag-icon" alt="Français">
                                <span>Français</span>
                            </a>
                            <a href="#" class="language-option" data-lang="en">
                                <img src="https://flagcdn.com/w20/gb.png" class="flag-icon" alt="English">
                                <span>English</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- YouTube Icon -->
                    <a href="https://www.youtube.com/user/explorezlemonde/videos?view_as=subscriber" target="_blank" class="top-bar-icon">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <!-- Panier -->
                    <a href="#" class="top-bar-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Panier</span>
                    </a>
                    <!-- Favoris -->
                    <a href="#" class="top-bar-icon">
                        <i class="fas fa-heart"></i>
                        <span>Favoris</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('components.front.navbar')
    @include('components.front.slideshows')

    <!-- Video Slider Full Width -->
    <section class="video-slider-section d-none">
        <div class="video-slider-container">
            <!-- Slide 1: Vidéo YouTube -->
            <div class="video-slide active">
                <iframe src="https://www.youtube.com/embed/VKWE89nmIWs?autoplay=1&mute=1&loop=1&playlist=VKWE89nmIWs" title="YouTube video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            
            <!-- Slide 2: Image -->
            <div class="video-slide">
                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Montagnes canadiennes">
            </div>
            
            <!-- Slide 3: Image -->
            <div class="video-slide">
                <img src="https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Paysage hivernal">
            </div>
            
            <!-- Slide 4: Image -->
            <div class="video-slide">
                <img src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Ville de Québec">
            </div>
            
            <!-- Slide 5: Image -->
            <div class="video-slide">
                <img src="https://images.unsplash.com/photo-1596394516093-9baa8e6c2b5e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Lac canadien">
            </div>
        </div>
        
        <div class="slider-content">
            <div class="slider-text">
                <h1 class="slider-title">Créez votre présence digitale avec Go Exploria Business</h1>
                <p class="slider-subtitle">Notre plateforme tout-en-un vous permet de créer, gérer et optimiser votre site web avec des outils puissants d'analyse, SEO, messagerie et IA intégrée.</p>
                <div class="hero-buttons">
                    <a href="#editor" class="btn btn-primary btn-lg">
                        <i class="fas fa-play-circle me-2"></i>Essayer la démo
                    </a>
                    <a href="#features" class="btn btn-outline-light btn-lg ms-2">
                        <i class="fas fa-list-alt me-2"></i>Voir les fonctionnalités
                    </a>
                </div>
            </div>
        </div>
        
        <div class="slider-controls">
            <div class="slider-dot active" data-slide="0"></div>
            <div class="slider-dot" data-slide="1"></div>
            <div class="slider-dot" data-slide="2"></div>
            <div class="slider-dot" data-slide="3"></div>
            <div class="slider-dot" data-slide="4"></div>
        </div>
    </section>

    <!-- resources/views/main.blade.php -->
    @php
    // IDs à afficher en premier
    $priorityIds = [22, 23];
    
    // Récupérer les pages prioritaires dans l'ordre spécifié
    $priorityPages = collect();
    foreach ($priorityIds as $id) {
        $page = \App\Models\Menu::where('id', $id)
            ->where('is_active', true)
            ->where('has_page', true)
            ->whereNull('parent_id')
            ->first();
        if ($page) {
            $priorityPages->push($page);
        }
    }
    
    // Récupérer toutes les autres pages
    $otherPages = \App\Models\Menu::where('is_active', true)
        ->where('has_page', true)
        ->where('menu_type', 'Accueil')
        ->whereNull('parent_id')
        ->whereNotIn('id', $priorityIds)
        ->orderBy('order','ASC')
        ->get();
    
    // Fusionner les collections
    $pages = $priorityPages->concat($otherPages);
@endphp

@foreach($pages as $page)
    <iframe 
        id="{{$page->slug}}"
        src="{{ url('/theme/'.$page->slug.'/preview') }}" 
        width="100%" 
        style="border:0; overflow:hidden;"
        scrolling="no">
    </iframe>
@endforeach
    
    <!-- Marketing -->
    <iframe 
        id="iframe-page-web-1"
        src="{{ url('/theme/web/page-1') }}" 
        width="100%" 
        style="border:0; overflow:hidden;"
        scrolling="no">
    </iframe>

    <!-- Business -->
   
<!-- Iframe avec un name pour le cibler -->
<iframe 
    id="affichez-vos-entreprises"
    name="business-iframe"
    src="{{ url('/theme/business/page-1') }}" 
    width="100%" 
    style="border:0; overflow:hidden;"
    scrolling="no">
</iframe>

    <script>
    window.addEventListener('message', function(event) {
        if (!event.data || event.data.type !== 'setHeight') return;

        const iframeId = event.data.iframeId;
        const height   = event.data.height;

        const iframe = document.getElementById(iframeId);
        if (iframe) {
            iframe.style.height = height + 'px';
        }
    });
    </script>

    <!-- Les autres sections restent identiques -->
    <!-- Section Éditeur de Site Web -->
    <section class="editor-section" id="editor">
        <div class="container">
            <h2 class="section-title text-center mb-5">Notre Éditeur de Site Web Intuitif</h2>
            
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="editor-preview">
                        <div class="editor-toolbar">
                            <div class="toolbar-dot dot-red"></div>
                            <div class="toolbar-dot dot-yellow"></div>
                            <div class="toolbar-dot dot-green"></div>
                            <span class="text-white ms-3">Créateur de site Go Exploria Business</span>
                        </div>
                        <div class="editor-window">
                            <div class="editor-content">
                                <div class="editor-element">
                                    <h5>En-tête personnalisable</h5>
                                    <p class="mb-0">Logo, navigation, bannière</p>
                                </div>
                                <div class="editor-element">
                                    <h5>Galerie d'images responsive</h5>
                                    <p class="mb-0">Glisser-déposer pour organiser</p>
                                </div>
                                <div class="editor-element">
                                    <h5>Section services</h5>
                                    <p class="mb-0">Présentez vos offres</p>
                                </div>
                                <div class="editor-element">
                                    <h5>Formulaire de contact intelligent</h5>
                                    <p class="mb-0">Avec gestion des leads</p>
                                </div>
                                <div class="editor-element">
                                    <h5>Intégration réseaux sociaux</h5>
                                    <p class="mb-0">Automatisée et modifiable</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ps-lg-5 mt-5 mt-lg-0">
                        <h3 class="mb-4" style="color: var(--primary-color);">Créez un site professionnel sans codage</h3>
                        <p class="mb-4">Notre éditeur visuel vous permet de créer un site web professionnel en quelques heures, sans aucune connaissance technique.</p>
                        
                        <div class="d-flex align-items-start mb-3">
                            <div class="me-3">
                                <i class="fas fa-check-circle" style="color: var(--secondary-color); font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h5>Glisser-déposer intuitif</h5>
                                <p>Organisez vos pages avec une interface simple de glisser-déposer.</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start mb-3">
                            <div class="me-3">
                                <i class="fas fa-check-circle" style="color: var(--secondary-color); font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h5>Modèles professionnels</h5>
                                <p>Choisissez parmi des centaines de modèles conçus par des experts.</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-start mb-4">
                            <div class="me-3">
                                <i class="fas fa-check-circle" style="color: var(--secondary-color); font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h5>Optimisation mobile automatique</h5>
                                <p>Votre site sera parfaitement adapté à tous les appareils.</p>
                            </div>
                        </div>
                        
                        <a href="#contact" class="btn btn-primary btn-lg">
                            <i class="fas fa-magic me-2"></i>Créer mon site maintenant
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Fonctionnalités -->
    <section class="features-section" id="features">
        <div class="container">
            <h2 class="section-title text-center mb-5">Fonctionnalités Complètes</h2>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="feature-title">Analytics Avancés</h3>
                        <p>Suivez les performances de votre site avec des tableaux de bord détaillés et des rapports personnalisés.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3 class="feature-title">Optimisation SEO</h3>
                        <p>Améliorez votre visibilité sur les moteurs de recherche avec nos outils SEO intégrés.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h3 class="feature-title">Messagerie Intelligente</h3>
                        <p>Gérez vos communications avec un système de messagerie unifié et automatisé.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-robot"></i>
                        </div>
                        <h3 class="feature-title">Assistance IA</h3>
                        <p>Bénéficiez de l'assistance d'une IA pour la rédaction de contenu et l'optimisation.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h3 class="feature-title">Gestion des Tâches</h3>
                        <p>Organisez vos projets avec des outils de gestion de tâches et de collaboration.</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 class="feature-title">Suivi en Temps Réel</h3>
                        <p>Surveillez l'activité sur votre site en temps réel avec des notifications instantanées.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Clients -->
    <section class="clients-section d-none" id="clients">
        <div class="container">
            <h2 class="section-title text-center mb-5">Nos Clients Fidèles</h2>
            
            <div class="row align-items-center justify-content-center g-4">
                <div class="col-lg-2 col-md-3 col-4">
                    <div class="client-logo">
                        <img src="https://www.goexploria.com/uploads/companies/78/logo/logo-78.png" alt="Client 1">
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-4">
                    <div class="client-logo">
                        <img src="https://www.goexploria.com/uploads/companies/147257/logo/logo-147257.png" alt="Client 2">
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-4">
                    <div class="client-logo">
                        <img src="https://www.goexploria.com/uploads/companies/147256/logo/logo-147256.png" alt="Client 3">
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-4">
                    <div class="client-logo">
                        <img src="https://www.goexploria.com/uploads/companies/147255/logo/logo-147255.png" alt="Client 4">
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-4">
                    <div class="client-logo">
                        <img src="https://www.goexploria.com/uploads/companies/147254/logo/logo-147254.png" alt="Client 5">
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-4">
                    <div class="client-logo">
                        <img src="https://www.goexploria.com/uploads/companies/147253/logo/logo-147253.png" alt="Client 6">
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @include('components.front.call-action')
    @include('chat.index')

    <!-- Footer avec photo de fond filtrée -->
   @include('components.front.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    let resizing = false;

    window.addEventListener('message', function(event) {
        if (!event.data || event.data.type !== 'setHeight') return;

        resizing = true;

        const iframe = document.getElementById(event.data.iframeId);
        if (iframe) {
            iframe.style.height = event.data.height + 'px';
        }

        // Restore scroll to top if first load
        if (resizing) {
            window.scrollTo({ top: 0, behavior: 'instant' });
            resizing = false;
        }
    });

    // Script pour le bouton retour en haut
    document.addEventListener('DOMContentLoaded', function() {
        const backToTopButton = document.getElementById('backToTop');
        
        // Afficher/masquer le bouton selon le défilement
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopButton.classList.add('visible');
            } else {
                backToTopButton.classList.remove('visible');
            }
        });
        
        // Retour en haut avec animation fluide
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Script pour fermer le méga-menu en cliquant ailleurs
        const megaMenus = [
            { btn: document.getElementById('servicesWebBtn'), menu: document.getElementById('webServicesMegaMenu') },
            { btn: document.getElementById('templatesBtn'), menu: document.getElementById('templatesMegaMenu') }
        ];
        
        document.addEventListener('click', function(event) {
            megaMenus.forEach(({btn, menu}) => {
                if (menu && btn) {
                    if (!menu.contains(event.target) && !btn.contains(event.target)) {
                        menu.style.opacity = '0';
                        menu.style.visibility = 'hidden';
                        menu.style.transform = 'translateX(-50%) translateY(15px)';
                    }
                }
            });
        });
        
        // Ouvrir/fermer le méga-menu au clic sur mobile pour Services Web
        const servicesBtn = document.getElementById('servicesWebBtn');
        const servicesMegaMenu = document.getElementById('webServicesMegaMenu');
        
        if (servicesBtn && servicesMegaMenu) {
            servicesBtn.addEventListener('click', function(event) {
                event.preventDefault();
                const isVisible = servicesMegaMenu.style.opacity === '1';
                
                // Fermer l'autre menu d'abord
                const templatesBtn = document.getElementById('templatesBtn');
                const templatesMegaMenu = document.getElementById('templatesMegaMenu');
                if (templatesBtn && templatesMegaMenu) {
                    templatesMegaMenu.style.opacity = '0';
                    templatesMegaMenu.style.visibility = 'hidden';
                    templatesMegaMenu.style.transform = 'translateX(-50%) translateY(15px)';
                }
                
                if (isVisible) {
                    servicesMegaMenu.style.opacity = '0';
                    servicesMegaMenu.style.visibility = 'hidden';
                    servicesMegaMenu.style.transform = 'translateX(-50%) translateY(15px)';
                } else {
                    servicesMegaMenu.style.opacity = '1';
                    servicesMegaMenu.style.visibility = 'visible';
                    servicesMegaMenu.style.transform = 'translateX(-50%) translateY(0)';
                }
            });
        }
        
        // Ouvrir/fermer le méga-menu au clic sur mobile pour Templates
        const templatesBtn = document.getElementById('templatesBtn');
        const templatesMegaMenu = document.getElementById('templatesMegaMenu');
        
        if (templatesBtn && templatesMegaMenu) {
            templatesBtn.addEventListener('click', function(event) {
                event.preventDefault();
                const isVisible = templatesMegaMenu.style.opacity === '1';
                
                // Fermer l'autre menu d'abord
                const servicesBtn = document.getElementById('servicesWebBtn');
                const servicesMegaMenu = document.getElementById('webServicesMegaMenu');
                if (servicesBtn && servicesMegaMenu) {
                    servicesMegaMenu.style.opacity = '0';
                    servicesMegaMenu.style.visibility = 'hidden';
                    servicesMegaMenu.style.transform = 'translateX(-50%) translateY(15px)';
                }
                
                if (isVisible) {
                    templatesMegaMenu.style.opacity = '0';
                    templatesMegaMenu.style.visibility = 'hidden';
                    templatesMegaMenu.style.transform = 'translateX(-50%) translateY(15px)';
                } else {
                    templatesMegaMenu.style.opacity = '1';
                    templatesMegaMenu.style.visibility = 'visible';
                    templatesMegaMenu.style.transform = 'translateX(-50%) translateY(0)';
                }
            });
        }
        
        // Mettre à jour l'année dynamiquement
        function updateCurrentYear() {
            const currentYear = new Date().getFullYear();
            document.getElementById('currentYear').textContent = currentYear;
        }
        
        // Appeler la fonction au chargement
        updateCurrentYear();
        
        // Dupliquer le contenu de la bande défilante pour un défilement fluide
        const marquee = document.querySelector('.travel-marquee');
        if (marquee) {
            marquee.innerHTML += marquee.innerHTML;
        }
    });
    </script>

</body>
</html>