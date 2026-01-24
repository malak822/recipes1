<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une recette - Recettes Gourmandes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            background-color: #fdf9f5;
            font-family: 'Roboto', system-ui, sans-serif;
            min-height: 100vh;
        }
        .form-container {
            max-width: 1000px;
            margin: 4rem auto;
        }
        .card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        h1 {
            font-family: 'Playfair Display', serif;
            color: #c8102e;
            font-weight: 900;
            font-size: 2.8rem;
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .form-control, .form-select {
            border-radius: 12px;
            padding: 0.8rem 1.3rem;
            font-size: 1.05rem;
        }
        .required::after {
            content: " *";
            color: #dc3545;
            font-weight: bold;
        }
        .time-input {
            max-width: 170px;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-radius: 12px 0 0 12px;
            font-weight: 500;
        }
        /* Emojis plus grands dans le select */
        .form-select option {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

<div class="container form-container">
    <div class="card p-5 bg-white">
        <h1 class="text-center mb-5">Ajouter une nouvelle recette</h1>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Attention !</strong> Veuillez corriger les erreurs suivantes :
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Titre -->
            <div class="mb-4">
                <label for="title" class="form-label required">Titre de la recette</label>
                <input type="text" name="title" id="title" class="form-control form-control-lg" 
                       value="{{ old('title') }}" required placeholder="Ex : Tajine d'agneau aux pruneaux et amandes">
            </div>

            <!-- Ingrédients -->
            <div class="mb-4">
                <label for="ingredients" class="form-label required">Ingrédients (un par ligne)</label>
                <textarea name="ingredients" id="ingredients" rows="7" class="form-control form-control-lg" 
                          required placeholder="1 kg d'agneau&#10;300 g de pruneaux&#10;100 g d'amandes pelées&#10;...">{{ old('ingredients') }}</textarea>
            </div>

            <!-- Instructions -->
            <div class="mb-4">
                <label for="instructions" class="form-label required">Instructions de préparation</label>
                <textarea name="instructions" id="instructions" rows="10" class="form-control form-control-lg" 
                          required placeholder="1. Faire chauffer l'huile dans le tajine à feu moyen...&#10;2. Ajouter l'agneau et le faire dorer...&#10;...">{{ old('instructions') }}</textarea>
            </div>

            <!-- Temps + Catégorie + Difficulté -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <label for="prep_time" class="form-label required">Temps de préparation</label>
                    <div class="input-group">
                        <input type="number" name="prep_time" id="prep_time" class="form-control form-control-lg time-input" 
                               min="1" value="{{ old('prep_time') }}" required>
                        <span class="input-group-text">minutes</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="cook_time" class="form-label">Temps de cuisson</label>
                    <div class="input-group">
                        <input type="number" name="cook_time" id="cook_time" class="form-control form-control-lg time-input" 
                               min="0" value="{{ old('cook_time') }}">
                        <span class="input-group-text">minutes</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="category" class="form-label required">Catégorie</label>
                    <select name="category" id="category" class="form-select form-select-lg" required>
                        <option value="" disabled selected>Choisir une catégorie...</option>
                        <option value="Cuisine algérienne" {{ old('category') == 'Cuisine algérienne' ? 'selected' : '' }}>🇩🇿 Cuisine algérienne</option>
                        <option value="Desserts" {{ old('category') == 'Desserts' ? 'selected' : '' }}>🧁 Desserts</option>
                        <option value="Entrées & Salades" {{ old('category') == 'Entrées & Salades' ? 'selected' : '' }}>🥗 Entrées & Salades</option>
                        <option value="Soupes" {{ old('category') == 'Soupes' ? 'selected' : '' }}>🍲 Soupes</option>
                        <option value="Cuisine française" {{ old('category') == 'Cuisine française' ? 'selected' : '' }}>🇫🇷 Cuisine française</option>
                        <option value="Plats principaux" {{ old('category') == 'Plats principaux' ? 'selected' : '' }}>🍽️ Plats principaux</option>
                        <option value="Autres" {{ old('category') == 'Autres' ? 'selected' : '' }}>🌍 Autres</option>
                    </select>
                </div>
            </div>

            <!-- Difficulté -->
            <div class="mb-4">
                <label for="difficulty" class="form-label required">Niveau de difficulté</label>
                <select name="difficulty" id="difficulty" class="form-select form-select-lg" required>
                    <option value="" disabled selected>Choisir le niveau...</option>
                    <option value="سهل" {{ old('difficulty') == 'سهل' ? 'selected' : '' }}>😊 Facile</option>
                    <option value="متوسط" {{ old('difficulty') == 'متوسط' ? 'selected' : '' }}>😐 Moyen</option>
                    <option value="صعب" {{ old('difficulty') == 'صعب' ? 'selected' : '' }}>😓 Difficile</option>
                </select>
            </div>

            <!-- Image -->
            <div class="mb-5">
                <label for="image" class="form-label">Photo de la recette (facultatif)</label>
                <input type="file" name="image" id="image" class="form-control form-control-lg" accept="image/*">
                <small class="form-text text-muted mt-2 d-block">L'image sera affichée sur la page de la recette.</small>
            </div>

            <!-- Boutons -->
            <div class="d-flex gap-3 justify-content-end mt-5">
                <a href="{{ route('recipes.index') }}" class="btn btn-outline-secondary btn-lg px-5">Annuler</a>
                <button type="submit" class="btn btn-danger btn-lg px-5 fw-bold">Publier la recette</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>