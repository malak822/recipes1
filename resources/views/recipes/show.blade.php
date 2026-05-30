<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->title }} — Recettes Gourmandes</title>
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    @include('recipes.partials.site-styles')
    <style>
        .show-wrap { max-width: 900px; margin: 0 auto; padding: 1.5rem; flex: 1; width: 100%; }
        .back-link {
            display: inline-flex; align-items: center; gap: 0.4rem;
            font-size: 0.88rem; font-weight: 600; color: var(--muted);
            text-decoration: none; margin-bottom: 1.25rem;
        }
        .back-link:hover { color: var(--accent); }
        .recipe-header {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            margin-bottom: 2rem;
        }
        @media (min-width: 640px) {
            .recipe-header { flex-direction: row; align-items: flex-start; }
        }
        .recipe-thumb {
            width: 100%;
            max-width: 280px;
            height: 200px;
            object-fit: cover;
            border-radius: 1rem;
            box-shadow: var(--shadow);
            flex-shrink: 0;
        }
        .recipe-info { flex: 1; min-width: 0; }
        .recipe-info h1 {
            font-size: 1.65rem;
            font-weight: 800;
            margin: 0 0 0.75rem;
            line-height: 1.25;
        }
        .badges { display: flex; flex-wrap: wrap; gap: 0.4rem; margin-bottom: 1rem; }
        .badge {
            font-size: 0.72rem; font-weight: 700;
            padding: 0.3rem 0.65rem; border-radius: 999px;
        }
        .badge-time { background: #fff7ed; color: var(--accent); }
        .badge-date { background: #f5f5f4; color: var(--muted); }
        .badge-cat { background: #ecfdf5; color: #059669; }
        .chef-box {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.75rem 1rem; background: var(--card);
            border-radius: 0.75rem; border: 1px solid #e7e5e4;
            margin-bottom: 1rem;
        }
        .chef-avatar {
            width: 44px; height: 44px; border-radius: 50%;
            background: linear-gradient(135deg, #fb923c, #ec4899);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 800; overflow: hidden;
        }
        .chef-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .owner-actions {
            display: flex; flex-wrap: wrap; gap: 0.5rem;
        }
        .owner-actions .btn { border-radius: 0.75rem; }
        .content-grid {
            display: grid;
            gap: 1.25rem;
        }
        @media (min-width: 768px) {
            .content-grid { grid-template-columns: 1fr 1fr; }
        }
        .panel {
            background: var(--card);
            border-radius: var(--radius);
            border: 1px solid #e7e5e4;
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        .panel-head {
            padding: 0.85rem 1.15rem;
            font-weight: 800;
            font-size: 1rem;
            border-bottom: 1px solid #e7e5e4;
        }
        .panel-head.orange { background: #fff7ed; color: var(--accent-dark); }
        .panel-head.green { background: #ecfdf5; color: #059669; }
        .panel-body { padding: 1rem 1.15rem; }
        .panel-body ul { margin: 0; padding: 0; list-style: none; }
        .panel-body li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #f5f5f4;
            font-size: 0.92rem;
            line-height: 1.5;
            color: #44403c;
        }
        .panel-body li:last-child { border-bottom: none; }
        .step-num {
            display: inline-flex; align-items: center; justify-content: center;
            width: 1.5rem; height: 1.5rem; border-radius: 50%;
            background: #22c55e; color: #fff;
            font-size: 0.75rem; font-weight: 800; margin-right: 0.5rem;
        }
        footer {
            background: var(--dark); color: #a8a29e;
            text-align: center; padding: 1.5rem; font-size: 0.85rem; margin-top: 2rem;
        }
    </style>
</head>
<body>

@php
    $chef = $recipe->user;
    $chefPhoto = $chef && $chef->profile_photo_path
        ? asset('storage/' . $chef->profile_photo_path) : null;
    $chefInitial = $chef ? strtoupper(mb_substr($chef->name, 0, 1, 'UTF-8')) : '?';
    $categoryFallbacks = [
        'Desserts' => 'desserts.jpg',
        'Entrées & Salades' => 'entrees.jpg',
        'Plats principaux' => 'plats.jpg',
        'Cuisine algérienne' => 'plats.jpg',
        'Cuisine française' => 'plats.jpg',
    ];
    $fallbackKey = $categoryFallbacks[$recipe->category] ?? 'plats.jpg';
    $recipeImage = $recipe->image
        ? asset('storage/' . $recipe->image)
        : asset('images/' . $fallbackKey);
    $totalMinutes = ($recipe->prep_time ?? 0) + ($recipe->cook_time ?? 0);
    $ingredientsList = array_filter(array_map('trim', explode("\n", $recipe->ingredients)));
    $steps = array_filter(array_map('trim', explode("\n", $recipe->instructions)));
@endphp

@include('recipes.partials.site-header')

<div class="show-wrap">
    <a href="{{ route('recipes.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Retour aux recettes
    </a>

    <div class="recipe-header">
        <img src="{{ $recipeImage }}" alt="{{ $recipe->title }}" class="recipe-thumb">
        <div class="recipe-info">
            <h1>{{ $recipe->title }}</h1>
            <div class="badges">
                @if($recipe->category)
                    <span class="badge badge-cat">{{ $recipe->category }}</span>
                @endif
                <span class="badge badge-time">⏱ {{ $totalMinutes }} min</span>
                <span class="badge badge-date">{{ $recipe->created_at->format('d/m/Y') }}</span>
                @if($recipe->difficulty)
                    <span class="badge badge-date">{{ $recipe->difficulty }}</span>
                @endif
            </div>
            <div class="chef-box">
                <div class="chef-avatar">
                    @if($chefPhoto)
                        <img src="{{ $chefPhoto }}" alt="{{ $chef->name }}">
                    @else
                        {{ $chefInitial }}
                    @endif
                </div>
                <div>
                    <div style="font-size:0.75rem;color:var(--muted);font-weight:600;">Par</div>
                    <div style="font-weight:800;">{{ $chef ? $chef->name : 'Utilisateur inconnu' }}</div>
                </div>
            </div>
            @auth
            <div class="owner-actions">
                <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-edit">
                    <i class="fas fa-pen"></i> Modifier
                </a>
                <form method="POST" action="{{ route('recipes.destroy', $recipe) }}"
                      onsubmit="return confirm('Supprimer cette recette ?');" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i> Supprimer
                    </button>
                </form>
            </div>
            @else
            <p style="font-size:0.88rem;color:var(--muted);margin:0;">
                <a href="{{ route('login') }}" style="color:var(--accent);font-weight:700;">Connectez-vous</a>
                pour modifier les recettes.
            </p>
            @endauth
        </div>
    </div>

    <div class="content-grid">
        <section class="panel">
            <div class="panel-head orange">🥗 Ingrédients ({{ count($ingredientsList) }})</div>
            <div class="panel-body">
                <ul>
                    @foreach($ingredientsList as $ingredient)
                    <li>• {{ trim($ingredient, '- ') }}</li>
                    @endforeach
                </ul>
            </div>
        </section>
        <section class="panel">
            <div class="panel-head green">👨‍🍳 Instructions ({{ count($steps) }})</div>
            <div class="panel-body">
                <ul>
                    @foreach($steps as $index => $step)
                    <li>
                        <span class="step-num">{{ $index + 1 }}</span>
                        {{ $step }}
                    </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </div>
</div>

<footer>© {{ date('Y') }} Recettes Gourmandes</footer>

</body>
</html>
