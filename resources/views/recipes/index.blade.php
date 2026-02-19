<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recettes Gourmandes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg: #fdf9f5;
            --accent: #c8102e;
            --dark: #1e1e1e;
            --gray: #5c5c5c;
            --shadow: 0 12px 36px rgba(0,0,0,0.09);
        }

        body {
            background:
                radial-gradient(circle at top left, #ffe1bb 0, transparent 55%),
                radial-gradient(circle at bottom right, #ffd6df 0, transparent 55%),
                var(--bg);
            color: var(--dark);
            font-family: 'Roboto', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main { flex: 1; }

        h1, .card-title {
            font-family: 'Playfair Display', serif;
        }

        .container-main { max-width: 1450px; }

        .header { margin-bottom: 4.5rem; }

        h1 {
            font-size: 3.4rem;
            font-weight: 800;
            letter-spacing: -1.5px;
        }

        .page-subtitle {
            max-width: 560px;
            margin: 0 auto 2rem;
            color: var(--gray);
        }

        .btn-add {
            background-color: var(--accent);
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.15rem;
            transition: all 0.35s ease;
        }

        .btn-add:hover {
            background-color: #a50d22;
            transform: translateY(-5px);
            box-shadow: 0 14px 32px rgba(200,16,46,0.32);
        }

        .recipe-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2.2rem;
        }

        @media (min-width: 1200px) {
            .recipe-grid {
                grid-template-columns: repeat(4, 1fr); /* ← 4 colonnes sur grand écran */
            }
        }

        .recipe-card {
            background: white;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.42s cubic-bezier(0.165, 0.84, 0.44, 1);
            border: 1px solid rgba(0,0,0,0.03);
            position: relative;
            backdrop-filter: blur(5px);
        }

        .recipe-card:hover {
            transform: translateY(-16px) scale(1.015);
            box-shadow: 0 32px 68px rgba(0,0,0,0.16);
        }

        .recipe-img {
            height: 260px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.9s ease;
        }

        .recipe-card:hover .recipe-img {
            transform: scale(1.14);
        }

        .card-body { padding: 1.8rem 2rem 1.6rem; }

        .card-title {
            font-size: 1.55rem;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.45rem;
            margin-bottom: 1rem;
            font-size: 0.82rem;
        }

        .meta-pill {
            border-radius: 999px;
            padding: 0.25rem 0.75rem;
            background: rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.04);
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            color: var(--gray);
        }

        .meta-pill i {
            font-size: 0.8rem;
        }

        .ingredients-preview {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--gray);
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 1.4rem;
        }

        .action-btn {
            border-radius: 12px;
            padding: 0.7rem 1.2rem;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .action-btn:hover { transform: translateY(-3px); }

        /* Footer */
        .footer-social {
            background: linear-gradient(90deg, #ff7043, #ff3d7f);
            color: white;
            padding: 3.5rem 0 2.5rem;
            margin-top: auto;
        }

        .social-links a {
            color: white;
            font-size: 2rem;
            margin: 0 1.2rem;
            transition: all 0.35s;
        }

        .social-links a:hover {
            color: var(--accent);
            transform: translateY(-6px);
        }

        /* Hero arabe علوي */
        .hero {
            background: linear-gradient(90deg, #ff7043, #ff3d7f);
            color: #fff;
            padding: 1.2rem 0 3.5rem;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .hero-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .hero-logo {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: .03em;
        }

        .hero-menu {
            display: flex;
            gap: 1.5rem;
            font-size: 0.98rem;
        }

        .hero-menu a {
            color: #ffedf3;
            text-decoration: none;
            font-weight: 500;
        }

        .hero-menu a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        .hero-auth {
            display: flex;
            gap: .75rem;
        }

        .hero-auth .btn-outline-light {
            border-radius: 999px;
            padding-inline: 1.4rem;
            font-size: 0.9rem;
        }

        .hero-auth .btn-light {
            border-radius: 999px;
            padding-inline: 1.4rem;
            font-size: 0.9rem;
            font-weight: 600;
            color: #ff3d7f;
        }

        .hero-content {
            text-align: center;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            font-size: 2.6rem;
            margin-bottom: .75rem;
        }

        .hero-subtitle {
            font-size: 1.02rem;
            opacity: .9;
            margin-bottom: 1.8rem;
        }

        .hero-search {
            max-width: 680px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 999px;
            padding: .35rem;
            backdrop-filter: blur(10px);
        }

        .hero-search form {
            display: flex;
            gap: .5rem;
            align-items: stretch;
        }

        .hero-search input[type="text"] {
            flex: 1;
            border: none;
            border-radius: 999px;
            padding: .85rem 1.2rem;
            font-size: .98rem;
        }

        .hero-search input[type="text"]:focus {
            outline: none;
        }

        .hero-search button {
            border-radius: 999px;
            padding-inline: 1.6rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .hero-nav {
                flex-direction: column;
                align-items: flex-start;
            }

            .hero-menu {
                flex-wrap: wrap;
            }

            .hero {
                padding-bottom: 2.5rem;
            }
        }
    </style>
</head>
<body>
<section class="hero">
    <div class="hero-inner">
        <div class="hero-nav">
            <div class="hero-logo">
                Les recettes
            </div>
            <nav class="hero-menu">
                <a href="/">Accueil</a>
                <a href="#categories">Catégories</a>
                <a href="#about">À propos</a>
            </nav>
            <div class="hero-auth">
                @auth
                    <span class="text-light me-2 d-none d-sm-inline">
                        Bonjour, {{ Auth::user()->name ?? 'chef' }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light">
                            Se déconnecter
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Connexion</a>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-light">Créer un compte</a>
                @endauth
            </div>
        </div>

        <div class="hero-content">
            <h2 class="hero-title">Découvrez les meilleures recettes</h2>
            <p class="hero-subtitle">Des milliers d’idées gourmandes venues du monde entier, à portée de clic.</p>

            <div class="hero-search">
                <form action="/recipes" method="GET">
                    <input type="text" name="search" placeholder="Rechercher une recette..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-dark">
                        Rechercher
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<main>
    <div class="container container-main py-5">
        <div class="header text-center mb-5">
            <h1 class="mb-4">Recettes Gourmandes</h1>
            <p class="page-subtitle">
                Découvrez, créez et partagez vos meilleures idées de cuisine dans une ambiance chaleureuse et élégante.
            </p>

            @auth
                <a href="{{ route('recipes.create') }}" class="btn btn-add text-white shadow">
                    <i class="fas fa-plus me-2"></i> Ajouter une recette
                </a>
            @endauth
        </div>

        <div class="recipe-grid">
            @forelse ($recipes as $recipe)
                <div class="recipe-card">
                    @if($recipe->image)
                        <img src="{{ asset('storage/'.$recipe->image) }}" class="recipe-img" alt="{{ $recipe->title }}">
                    @else
                        <div class="recipe-img d-flex align-items-center justify-content-center bg-light">
                            <i class="fas fa-utensils fa-5x text-muted opacity-40"></i>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $recipe->title }}</h5>

                        <div class="meta-row">
                            @if(!empty($recipe->category))
                                <span class="meta-pill">
                                    <i class="fas fa-tag"></i>
                                    {{ $recipe->category }}
                                </span>
                            @endif

                            @if(!empty($recipe->prep_time))
                                <span class="meta-pill">
                                    <i class="fas fa-clock"></i>
                                    Préparation {{ $recipe->prep_time }} min
                                </span>
                            @endif

                            @if(!empty($recipe->cook_time))
                                <span class="meta-pill">
                                    <i class="fas fa-fire"></i>
                                    Cuisson {{ $recipe->cook_time }} min
                                </span>
                            @endif

                            @if(!empty($recipe->difficulty))
                                <span class="meta-pill">
                                    <i class="fas fa-signal"></i>
                                    Difficulté : {{ $recipe->difficulty }}
                                </span>
                            @endif
                        </div>

                        <p class="ingredients-preview">
                            {!! nl2br(e(\Illuminate\Support\Str::limit($recipe->ingredients, 180, '...'))) !!}
                        </p>

                        <div class="d-flex flex-wrap gap-2">
                            <a href="/recipes/{{ $recipe->id }}" class="btn btn-outline-primary action-btn flex-fill">
                                <i class="fas fa-eye me-2"></i> Voir
                            </a>
                            
                            <a href="/recipes/{{ $recipe->id }}/edit" class="btn btn-outline-warning action-btn flex-fill">
                                <i class="fas fa-edit me-2"></i> Modifier
                            </a>
                            
                            <form action="/recipes/{{ $recipe->id }}" method="POST" class="d-inline flex-fill" 
                                  onsubmit="return confirm('Voulez-vous vraiment supprimer cette recette définitivement ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger action-btn w-100">
                                    <i class="fas fa-trash-alt me-2"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 my-5">
                    <i class="fas fa-book-open fa-6x text-muted mb-4 opacity-50"></i>
                    <h3 class="text-muted mb-3">Aucune recette pour le moment...</h3>
                    <p class="lead text-muted">Soyez le premier à partager votre recette préférée !</p>
                </div>
            @endforelse
        </div>
    </div>
</main>

<footer class="footer-social text-center">
    <div class="container">
        <h4 class="mb-4" style="font-family: 'Playfair Display', serif;">Restons connectés !</h4>
        
        <div class="social-links mb-4">
            <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/213xxxxxxxxx" target="_blank"><i class="fab fa-whatsapp"></i></a>
            <a href="mailto:contact@recettesgourmandes.dz"><i class="fas fa-envelope"></i></a>
        </div>

        <p class="mb-0 opacity-75">© 2026 Recettes Gourmandes - Tous droits réservés</p>
    </div>
</footer>

</body>
</html>
