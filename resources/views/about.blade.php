<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Recettes Gourmandes</title>
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    @include('recipes.partials.site-styles')

    <style>
        :root {
            --bg: #faf8f5;
            --accent: #f97316;
            --accent-dark: #ea580c;
            --dark: #1c1917;
            --muted: #78716c;
            --card: #ffffff;
            --radius: 1.25rem;
            --shadow: 0 20px 40px rgba(28, 25, 23, 0.12);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background: radial-gradient(circle at top right, #fff7ed, var(--bg));
            color: var(--dark);
            min-height: 100vh;
        }

        .about-wrapper {
            max-width: 1180px;
            margin: 0 auto;
            padding: 2rem 1.5rem 3.5rem;
        }

        .about-card {
            background: #fff;
            border: 1px solid #f5f5f4;
            border-radius: 1.5rem;
            box-shadow: var(--shadow);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .about-image {
            min-height: 400px;
            position: relative;
        }

        .about-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .about-image::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.06), rgba(0, 0, 0, 0.4));
        }

        .about-content {
            padding: 2.2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1rem;
        }

        .kicker {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            width: fit-content;
            background: #fff7ed;
            color: var(--accent-dark);
            border: 1px solid #fed7aa;
            border-radius: 999px;
            padding: 0.4rem 0.9rem;
            font-weight: 700;
            font-size: 0.88rem;
        }

        h1 {
            margin: 0;
            font-size: clamp(1.65rem, 3vw, 2.4rem);
            line-height: 1.25;
        }

        .lead {
            margin: 0;
            color: var(--muted);
            line-height: 1.9;
            font-size: 1.02rem;
        }

        .stats {
            margin-top: 0.4rem;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.7rem;
        }

        .stat {
            background: #fafaf9;
            border: 1px solid #e7e5e4;
            border-radius: 0.9rem;
            padding: 0.9rem;
            text-align: center;
        }

        .stat strong {
            display: block;
            font-size: 1.05rem;
            color: var(--accent-dark);
        }

        .stat span {
            color: var(--muted);
            font-size: 0.86rem;
            font-weight: 600;
        }

        .actions {
            margin-top: 0.8rem;
            display: flex;
            gap: 0.7rem;
            flex-wrap: wrap;
        }

        .btn {
            text-decoration: none;
            border-radius: 0.8rem;
            padding: 0.75rem 1.1rem;
            font-size: 0.92rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
            transform: translateY(-1px);
        }

        .btn-ghost {
            border: 1px solid #d6d3d1;
            color: var(--muted);
            background: #fff;
        }

        .btn-ghost:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        footer {
            background: var(--dark);
            color: #a8a29e;
            text-align: center;
            padding: 2rem 1.5rem;
            font-size: 0.85rem;
            margin-top: auto;
        }

        footer .social { margin-bottom: 0.75rem; }

        footer .social a {
            color: #fff;
            font-size: 1.25rem;
            margin: 0 0.6rem;
            opacity: 0.7;
            transition: opacity 0.2s, color 0.2s;
        }

        footer .social a:hover { opacity: 1; color: var(--accent); }

        @media (max-width: 900px) {
            .about-card { grid-template-columns: 1fr; }
            .about-image { min-height: 280px; }
            .about-content { padding: 1.4rem; }
            .stats { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    @include('recipes.partials.site-header')

    <section class="about-wrapper">
        <div class="about-card">
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?auto=format&fit=crop&w=1400&q=80" alt="Equipe en uniformes de chef en cuisine">
            </div>
            <div class="about-content">
                <span class="kicker"><i class="fas fa-heart"></i> Qui sommes-nous</span>
                <h1>Un espace qui rassemble tous les passionnés de cuisine</h1>
                <p class="lead">
                    Cette plateforme de recettes est conçue pour partager vos plats du quotidien
                    et vos meilleures créations avec tout le monde.
                    Nous croyons que la cuisine n'est pas seulement une recette, mais une expérience
                    qui rapproche la famille et les amis autour d'une table conviviale.
                </p>
                <p class="lead">
                    Ici, vous pouvez explorer de nouvelles idees, publier vos propres recettes
                    et apprendre des meilleurs chefs avec des etapes simples et claires.
                </p>

                <div class="stats">
                    <div class="stat">
                        <strong>+100</strong>
                        <span>Recettes inspirees</span>
                    </div>
                    <div class="stat">
                        <strong>+50</strong>
                        <span>Utilisateurs actifs</span>
                    </div>
                    <div class="stat">
                        <strong>24/7</strong>
                        <span>Inspiration cuisine</span>
                    </div>
                </div>

                <div class="actions">
                    <a href="{{ route('recipes.index') }}" class="btn btn-primary">
                        <i class="fas fa-book-open"></i> Voir les recettes
                    </a>
                    @auth
                        <a href="{{ route('recipes.create') }}" class="btn btn-ghost">
                            <i class="fas fa-plus-circle"></i> Ajouter votre recette
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="social">
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
        </div>
        <p>© {{ date('Y') }} Recettes Gourmandes</p>
    </footer>
</body>
</html>
