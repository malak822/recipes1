<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Recettes Gourmandes</title>
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    @include('recipes.partials.site-styles')
    <style>
        .dash-wrap {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem 1.5rem 3rem;
        }
        .dash-hero {
            background: var(--card);
            border: 1px solid #e7e5e4;
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            text-align: center;
        }
        .dash-hero h1 {
            margin: 0 0 0.75rem;
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 800;
            color: var(--dark);
        }
        .dash-hero p {
            margin: 0 auto 1.5rem;
            max-width: 520px;
            color: var(--muted);
            line-height: 1.7;
            font-size: 1.05rem;
        }
        .dash-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 0.75rem;
        }
        .dash-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            padding: 1.25rem 1rem;
            border-radius: 1rem;
            border: 2px solid #e7e5e4;
            background: #fafaf9;
            text-decoration: none;
            color: var(--dark);
            font-weight: 700;
            transition: all 0.2s ease;
        }
        .dash-card i {
            font-size: 1.5rem;
            color: var(--accent);
        }
        .dash-card:hover {
            border-color: #fed7aa;
            background: #fff7ed;
            transform: translateY(-2px);
        }
        .dash-card.primary {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }
        .dash-card.primary i { color: #fff; }
        .dash-card.primary:hover {
            background: var(--accent-dark);
            border-color: var(--accent-dark);
        }
        .dash-stats {
            margin-top: 1.25rem;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
        }
        .stat-box {
            background: var(--card);
            border: 1px solid #e7e5e4;
            border-radius: 1rem;
            padding: 1.25rem;
        }
        .stat-box p { margin: 0; }
        .stat-label { font-size: 0.85rem; color: var(--muted); font-weight: 600; }
        .stat-value { font-size: 1.75rem; font-weight: 800; color: var(--accent-dark); margin-top: 0.35rem !important; }
        .stat-detail { font-size: 0.9rem; color: var(--muted); margin-top: 0.5rem !important; }
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
        body { display: flex; flex-direction: column; min-height: 100vh; }
    </style>
</head>
<body>

@php
    $user = $user ?? Auth::user();
    $recipesCount = $user->recipes()->count();
    $latestRecipe = $user->recipes()->latest()->first();
@endphp

@include('recipes.partials.site-header')

<div class="dash-wrap">
    <section class="dash-hero">
        <h1>Bonjour, {{ $user->name }} 👋</h1>
        <p>Un espace qui rassemble tous les passionnés de cuisine.</p>

        <div class="dash-actions">
            <a href="{{ route('recipes.create') }}" class="dash-card primary">
                <i class="fas fa-plus-circle"></i>
                <span>Ajouter une recette</span>
            </a>
            <a href="{{ route('recipes.index') }}" class="dash-card">
                <i class="fas fa-utensils"></i>
                <span>Choisir des recettes</span>
            </a>
            <a href="{{ route('about') }}" class="dash-card">
                <i class="fas fa-heart"></i>
                <span>À propos</span>
            </a>
        </div>
    </section>

    <section class="dash-stats">
        <div class="stat-box">
            <p class="stat-label">Mes recettes</p>
            <p class="stat-value">{{ $recipesCount }}</p>
            <p class="stat-detail">recette{{ $recipesCount > 1 ? 's' : '' }} publiée{{ $recipesCount > 1 ? 's' : '' }}</p>
        </div>
        <div class="stat-box">
            <p class="stat-label">Dernière activité</p>
            @if($latestRecipe)
                <p class="stat-value" style="font-size:1.1rem;">{{ $latestRecipe->title }}</p>
                <p class="stat-detail">Ajoutée {{ $latestRecipe->created_at->diffForHumans() }}</p>
            @else
                <p class="stat-value" style="font-size:1.1rem;">—</p>
                <p class="stat-detail">Ajoutez votre première recette</p>
            @endif
        </div>
    </section>
</div>

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
