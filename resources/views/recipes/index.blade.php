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
            background-color: var(--bg);
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
            font-size: 3.8rem;
            font-weight: 800;
            letter-spacing: -1.5px;
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

        .card-body { padding: 1.8rem 2rem; }

        .card-title {
            font-size: 1.55rem;
            margin-bottom: 1rem;
            line-height: 1.3;
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
            background: #2c2c2c;
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
    </style>
</head>
<body>

<main>
    <div class="container container-main py-5">
        <div class="header text-center mb-5">
            <h1 class="mb-4">Recettes Gourmandes</h1>
            
            <a href="/recipes/create" class="btn btn-add text-white shadow">
                <i class="fas fa-plus me-2"></i> Ajouter une recette
            </a>
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
                        
                        <p class="ingredients-preview">
                            {!! nl2br(e(\Illuminate\Support\Str::limit($recipe->ingredients, 180, '...'))) !!}
                        </p>

                        <div class="d-flex gap-2">
                            <a href="/recipes/{{ $recipe->id }}" class="btn btn-outline-primary action-btn flex-fill">
                                <i class="fas fa-eye me-2"></i> Voir
                            </a>
                            
                            <a href="/recipes/{{ $recipe->id }}/edit" class="btn btn-outline-warning action-btn flex-fill">
                                <i class="fas fa-edit me-2"></i> Modifier
                            </a>
                            
                            <form action="/recipes/{{ $recipe->id }}" method="POST" class="d-inline" 
                                  onsubmit="return confirm('Voulez-vous vraiment supprimer cette recette définitivement ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger action-btn flex-fill">
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
