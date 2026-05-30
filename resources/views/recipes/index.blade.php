<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recettes Gourmandes</title>
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --bg: #faf8f5;
            --accent: #f97316;
            --accent-dark: #ea580c;
            --dark: #1c1917;
            --muted: #78716c;
            --card: #ffffff;
            --radius: 1.5rem;
            --shadow: 0 4px 24px rgba(28, 25, 23, 0.06);
            --shadow-hover: 0 16px 40px rgba(249, 115, 22, 0.12);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--dark);
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
        }

        a { color: inherit; }

        /* ── Header ── */
        .site-header {
            background: var(--card);
            border-bottom: 1px solid #e7e5e4;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .header-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .logo {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--dark);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo span { color: var(--accent); }

        .header-nav {
            display: flex;
            gap: 0.6rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .header-nav a {
            text-decoration: none;
            font-weight: 700;
            font-size: 0.92rem;
            padding: 0.45rem 0.9rem;
            border-radius: 999px;
            border: 1px solid #fed7aa;
            background: #fff7ed;
            color: var(--accent-dark);
            transition: all 0.2s ease;
        }

        .header-nav a:hover {
            color: #fff;
            background: var(--accent);
            border-color: var(--accent);
        }

        .header-nav a.nav-active {
            color: #fff;
            background: var(--accent);
            border-color: var(--accent);
        }

        .auth-btns {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1.1rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            font-family: inherit;
        }

        .btn-ghost {
            background: transparent;
            color: var(--muted);
            border: 1.5px solid #d6d3d1;
        }

        .btn-ghost:hover { border-color: var(--accent); color: var(--accent); }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(249, 115, 22, 0.35);
        }

        .btn-green {
            background: #22c55e;
            color: #fff;
        }

        .btn-green:hover { background: #16a34a; }

        .user-greeting { font-size: 0.85rem; font-weight: 600; color: var(--muted); }

        .guest-banner {
            background: #fff7ed;
            border-bottom: 1px solid #fed7aa;
            padding: 0.65rem 1.5rem;
            text-align: center;
            font-size: 0.88rem;
            color: var(--muted);
        }
        .guest-banner a { color: var(--accent); font-weight: 700; }

        .fab-wrap {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 60;
            width: 4.25rem;
            height: 4.25rem;
        }

        .fab-wrap::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 2px solid rgba(34, 197, 94, 0.55);
            animation: fab-orbit 2.5s ease-in-out infinite;
        }

        .fab-add {
            position: absolute;
            inset: 0.35rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: auto;
            height: auto;
            padding: 0;
            background: linear-gradient(145deg, #22c55e, #16a34a);
            color: #fff;
            font-weight: 800;
            font-size: 1.35rem;
            border-radius: 50%;
            text-decoration: none;
            box-shadow: 0 6px 22px rgba(34, 197, 94, 0.45);
            border: 2px solid #fff;
        }

        .fab-add:hover {
            background: linear-gradient(145deg, #16a34a, #15803d);
            transform: scale(1.08);
        }

        .fab-add .fab-label {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            border: 0;
        }

        @keyframes fab-orbit {
            0%, 100% { transform: scale(1); opacity: 0.9; }
            50% { transform: scale(1.12); opacity: 0.35; }
        }

        /* ── Hero ── */
        .hero {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 1.5rem;
            text-align: center;
        }

        .hero h1 {
            font-size: clamp(1.75rem, 4vw, 2.75rem);
            font-weight: 800;
            letter-spacing: -0.03em;
            margin: 0 0 0.5rem;
            line-height: 1.15;
        }

        .hero p {
            color: var(--muted);
            font-size: 1.05rem;
            margin: 0 auto 1.25rem;
            max-width: 480px;
        }

        .search-section {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem 1.75rem;
        }

        .search-bar {
            max-width: 640px;
            margin: 0 auto;
            display: flex;
            background: var(--card);
            border-radius: 999px;
            padding: 0.45rem;
            box-shadow: var(--shadow);
            border: 2px solid #e7e5e4;
        }

        .search-bar input {
            flex: 1;
            border: none;
            background: transparent;
            padding: 0.95rem 1.35rem;
            font-size: 1.05rem;
            font-family: inherit;
            outline: none;
        }

        .search-bar button {
            border: none;
            background: var(--accent);
            color: #fff;
            font-weight: 700;
            padding: 0.95rem 1.75rem;
            border-radius: 999px;
            cursor: pointer;
            font-family: inherit;
            font-size: 1rem;
        }

        .search-bar button:hover { background: var(--accent-dark); }

        .filter-chips {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.5rem;
        }

        .chip {
            padding: 0.55rem 1.15rem;
            border-radius: 999px;
            font-size: 0.95rem;
            font-weight: 700;
            text-decoration: none;
            background: var(--card);
            color: var(--muted);
            border: 2px solid #e7e5e4;
            transition: all 0.2s;
        }

        .chip:hover, .chip.active {
            background: #fff7ed;
            color: var(--accent);
            border-color: #fed7aa;
        }

        /* ── Main ── */
        main {
            flex: 1;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem 3rem;
            width: 100%;
        }

        .section-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        .section-top h2 {
            font-size: 1.65rem;
            font-weight: 800;
            margin: 0;
        }

        .recipe-count {
            font-size: 1rem;
            color: var(--muted);
            font-weight: 600;
        }

        .recipe-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        @media (min-width: 1200px) {
            .recipe-grid { grid-template-columns: repeat(4, 1fr); }
        }

        .recipe-card {
            position: relative;
            background: var(--card);
            border-radius: var(--radius);
            overflow: visible;
            border: 2px solid #e7e5e4;
            box-shadow: var(--shadow);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            display: flex;
            flex-direction: column;
        }

        .recipe-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
        }

        .card-img-link {
            display: block;
            position: relative;
            aspect-ratio: 4 / 3;
            overflow: hidden;
            border-radius: var(--radius) var(--radius) 0 0;
        }

        .recipe-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .recipe-card:hover .recipe-img { transform: scale(1.06); }

        .card-body {
            padding: 1.35rem 1.5rem 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
            border-radius: 0 0 var(--radius) var(--radius);
            background: var(--card);
        }

        .card-meta-top {
            display: flex;
            flex-wrap: wrap;
            gap: 0.35rem;
            margin-bottom: 0.65rem;
        }

        .card-category {
            background: #fff7ed;
            color: var(--accent);
            font-size: 0.88rem;
            font-weight: 800;
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
            border: 2px solid #fed7aa;
        }

        .card-time {
            background: #f5f5f4;
            color: var(--muted);
            font-size: 0.88rem;
            font-weight: 700;
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
            border: 1px solid #e7e5e4;
        }

        .card-toolbar-outside {
            position: absolute;
            top: 0.65rem;
            right: 0.65rem;
            z-index: 20;
            display: flex;
            gap: 0.55rem;
        }

        .tb-btn {
            width: 3.25rem;
            height: 3.25rem;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #fff;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.22);
            text-decoration: none;
            font-size: 1.15rem;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .tb-btn:hover {
            transform: scale(1.08);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.28);
        }
        .tb-edit { background: #3b82f6; color: #fff; }
        .tb-delete { background: #e11d48; color: #fff; }

        .card-title {
            font-size: 1.28rem;
            font-weight: 800;
            margin: 0 0 0.55rem;
            line-height: 1.35;
        }

        .card-title a {
            text-decoration: none;
            color: var(--dark);
            transition: color 0.2s;
        }

        .card-title a:hover { color: var(--accent); }

        .card-author {
            font-size: 0.95rem;
            color: var(--muted);
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.35rem;
            margin-bottom: 0.85rem;
        }

        .meta-pill {
            font-size: 0.85rem;
            font-weight: 700;
            padding: 0.35rem 0.75rem;
            border-radius: 999px;
            background: #fafaf9;
            color: var(--muted);
            border: 1px solid #e7e5e4;
        }

        .meta-pill.diff-easy { background: #ecfdf5; color: #059669; border-color: #a7f3d0; }
        .meta-pill.diff-med { background: #fffbeb; color: #d97706; border-color: #fde68a; }
        .meta-pill.diff-hard { background: #fff1f2; color: #e11d48; border-color: #fecdd3; }

        .ingredients-preview {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--muted);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 1rem;
            flex: 1;
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 1rem;
            color: var(--muted);
        }

        .empty-state i { font-size: 3rem; opacity: 0.35; margin-bottom: 1rem; display: block; }

        .pagination-wrap {
            margin-top: 2.5rem;
            display: flex;
            justify-content: center;
        }

        .card-actions {
            display: flex;
            flex-direction: column;
            gap: 0.45rem;
        }

        .btn-view {
            justify-content: center;
            padding: 0.8rem 1.1rem;
            border-radius: 0.85rem;
            font-weight: 700;
            font-size: 0.95rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            width: 100%;
            background: var(--accent);
            color: #fff;
        }

        .btn-view:hover { background: var(--accent-dark); }

        /* ── Catégories ── */
        .categories-section {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem 2rem;
        }

        .categories-section h2 {
            font-size: 1.75rem;
            font-weight: 800;
            margin: 0 0 0.35rem;
        }

        .categories-section > p {
            color: var(--muted);
            font-size: 1.05rem;
            margin: 0 0 1.35rem;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1.5rem 1rem;
            justify-items: center;
            max-width: 920px;
            margin: 0 auto;
        }

        @media (max-width: 520px) {
            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem 1rem;
                max-width: 100%;
            }
        }

        .cat-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            max-width: 190px;
            width: 100%;
        }

        .cat-circle {
            width: 100%;
            aspect-ratio: 1;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #fff;
            outline: 3px solid #fed7aa;
            box-shadow: 0 8px 24px rgba(28, 25, 23, 0.12);
            transition: transform 0.3s ease, outline-color 0.3s ease;
        }

        .cat-card:hover .cat-circle {
            transform: scale(1.06);
            outline-color: var(--accent);
        }

        .cat-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .cat-label {
            color: var(--dark);
            font-size: 1.1rem;
            font-weight: 800;
            text-align: center;
            line-height: 1.25;
        }

        /* ── Footer ── */
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

        .pagination-wrap nav { width: 100%; }
        .pagination-wrap nav > div { display: flex; flex-wrap: wrap; justify-content: center; gap: 0.35rem; align-items: center; }
        .pagination-wrap a,
        .pagination-wrap span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.25rem;
            padding: 0.45rem 0.75rem;
            border-radius: 0.6rem;
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            border: 1px solid #e7e5e4;
            background: var(--card);
            color: var(--dark);
        }
        .pagination-wrap span[aria-current="page"] {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }
        .pagination-wrap a:hover { border-color: var(--accent); color: var(--accent); }

.chef-title{
    font-size: 40px;
    font-style: italic;
    font-weight: 900;
    color: white;
    text-align: center;

    text-shadow:
        0 0 8px #fff,
        0 0 15px #ff9800,
        0 0 30px #ff5722,
        0 0 45px #ff5722;

    animation: shine 2s infinite alternate;
}

@keyframes shine{
    from{
        text-shadow:
            0 0 8px #fff,
            0 0 15px #ff9800;
    }

    to{
        text-shadow:
            0 0 15px #fff,
            0 0 30px #ff9800,
            0 0 45px #ff5722,
            0 0 60px #ff5722;
    }
}
</style>
</head>
<body>

@php
    $categoryFallbacks = [
        'Desserts' => 'desserts.jpg',
        'Entrées & Salades' => 'entrees.jpg',
        'Plats principaux' => 'plats.jpg',
        'Cuisine algérienne' => 'plats.jpg',
        'Cuisine française' => 'plats.jpg',
        'Soupes' => 'entrees.jpg',
        'Autres' => 'plats.jpg',
    ];
    $filterCategories = [
        'all' => 'Toutes',
        'Desserts' => 'Desserts',
        'Cuisine algérienne' => 'Cuisine algérienne',
        'Entrées & Salades' => 'Entrées & Salades',
        'Plats principaux' => 'Plats',
        'Soupes' => 'Soupes',
    ];
@endphp

@include('recipes.partials.site-header')

<section class="hero">
    <h1>Découvrez les meilleures recettes</h1>
    <p>Découvrez les meilleures recettes — faites un mouvement</p>

    <div class="filter-chips">
        @foreach($filterCategories as $value => $label)
            @php
                $chipParams = request('search') ? ['search' => request('search')] : [];
                if ($value !== 'all') {
                    $chipParams['category'] = $value;
                }
                $isActive = $value === 'all'
                    ? !request()->filled('category')
                    : request('category') === $value;
            @endphp
            <a href="{{ route('recipes.index', $chipParams) }}"
               class="chip {{ $isActive ? 'active' : '' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
</section>

<section id="categories" class="categories-section">
    <h2>Catégories</h2>
    <p class="chef-title">Choisir un plat</p>
    <div class="categories-grid">
        <a href="{{ route('recipes.index', ['category' => 'Cuisine algérienne']) }}" class="cat-card">
            <div class="cat-circle">
                <img src="{{ asset('images/entrees.jpg') }}" alt="">
            </div>
            <span class="cat-label">Cuisine algérienne</span>
        </a>
        <a href="{{ route('recipes.index', ['category' => 'Plats principaux']) }}" class="cat-card">
            <div class="cat-circle">
                <img src="https://images.unsplash.com/photo-1583394293214-28ded15ee548?auto=format&fit=crop&w=600&q=80" alt="Chef Lina">
            </div>
            <span class="cat-label">Plats principaux</span>
        </a>
        <a href="{{ route('recipes.index', ['category' => 'Desserts']) }}" class="cat-card">
            <div class="cat-circle">
                <img src="https://images.unsplash.com/photo-1592861956120-e524fc739696?auto=format&fit=crop&w=600&q=80" alt="chef Amina">
            </div>
            <span class="cat-label">Desserts</span>
        </a>
        <a href="{{ route('recipes.index', ['category' => 'Entrées & Salades']) }}" class="cat-card">
            <div class="cat-circle">
                <img src="https://images.unsplash.com/photo-1607631568010-a87245c0daf8?auto=format&fit=crop&w=600&q=80" alt="Chef Yasmine">
            </div>
            <span class="cat-label">Entrées &amp; Salades</span>
        </a>
    </div>
</section>

<section class="search-section">
    <form class="search-bar" action="{{ route('recipes.index') }}" method="GET">
        @if(request('category') && request('category') !== 'all')
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <input type="text" name="search" placeholder="Rechercher une recette…" value="{{ request('search') }}">
        <button type="submit">Rechercher</button>
    </form>
</section>

<main>
    <div class="section-top">
        <h2>
            @if(request('search'))
                Résultats pour « {{ request('search') }} »
            @elseif(request('category') && request('category') !== 'all')
                {{ $filterCategories[request('category')] ?? request('category') }}
            @else
                Toutes les recettes
            @endif
        </h2>
        <span class="recipe-count">{{ $recipes->total() }} recette{{ $recipes->total() > 1 ? 's' : '' }}</span>
    </div>

    <div class="recipe-grid">
        @forelse ($recipes as $recipe)
            @php
                $fallback = $categoryFallbacks[$recipe->category] ?? 'plats.jpg';
                $recipeImage = $recipe->image
                    ? str_starts_with($recipe->image, 'http') ? $recipe->image : asset('storage/' . $recipe->image)
                    : asset('images/' . $fallback);
                $totalMinutes = ($recipe->prep_time ?? 0) + ($recipe->cook_time ?? 0);
                $diffClass = match($recipe->difficulty) {
                    'سهل' => 'diff-easy',
                    'متوسط' => 'diff-med',
                    'صعب' => 'diff-hard',
                    default => '',
                };
            @endphp
            <article class="recipe-card">
                @auth
                <div class="card-toolbar-outside">
                    <a href="{{ route('recipes.edit', $recipe) }}" class="tb-btn tb-edit" title="Modifier">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form action="{{ route('recipes.destroy', $recipe) }}" method="POST"
                          onsubmit="return confirm('Supprimer cette recette ?');" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="tb-btn tb-delete" title="Supprimer">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
                @endauth

                <a href="{{ route('recipes.show', $recipe) }}" class="card-img-link">
                    <img src="{{ $recipeImage }}" class="recipe-img" alt="{{ $recipe->title }}">
                </a>

                <div class="card-body">
                    <div class="card-meta-top">
                        @if($recipe->category)
                            <span class="card-category">{{ $recipe->category }}</span>
                        @endif
                        @if($totalMinutes > 0)
                            <span class="card-time">⏱ {{ $totalMinutes }} min</span>
                        @endif
                    </div>

                    <h3 class="card-title">
                        <a href="{{ route('recipes.show', $recipe) }}">{{ $recipe->title }}</a>
                    </h3>

                    @if($recipe->user)
                        <p class="card-author">Par {{ $recipe->user->name }}</p>
                    @endif

                    <div class="meta-row">
                        @if($recipe->difficulty)
                            <span class="meta-pill {{ $diffClass }}">{{ $recipe->difficulty }}</span>
                        @endif
                    </div>

                    <p class="ingredients-preview">
                        {{ \Illuminate\Support\Str::limit(strip_tags($recipe->ingredients), 100) }}
                    </p>

                    <div class="card-actions">
                        <a href="{{ route('recipes.show', $recipe) }}" class="btn-view">
                            <i class="fas fa-eye"></i> Voir la recette
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="empty-state">
                <i class="fas fa-utensils"></i>
                <h3>Aucune recette trouvée</h3>
                <p>Essayez une autre recherche ou ajoutez la première recette !</p>
                @auth
                    <a href="{{ route('recipes.create') }}" class="btn btn-primary" style="margin-top:1rem;">Ajouter une recette</a>
                @endauth
            </div>
        @endforelse
    </div>

    @if($recipes->hasPages())
        <div class="pagination-wrap">
            {{ $recipes->withQueryString()->links() }}
        </div>
    @endif
</main>

@auth
<div class="fab-wrap" title="Ajouter une recette">
    <a href="{{ route('recipes.create') }}" class="fab-add" aria-label="Ajouter une recette">
        <i class="fas fa-plus"></i>
        <span class="fab-label">Ajouter</span>
    </a>
</div>
@endauth

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
