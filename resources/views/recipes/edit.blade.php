<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la recette : {{ $recipe->title }} - Recettes Gourmandes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Roboto', system-ui, sans-serif;
            background: linear-gradient(-45deg, #fdf9f5, #fff0e6, #ffe6d9, #ffd9cc);
            background-size: 400% 400%;
            animation: gradientAnimation 18s ease infinite;
            color: #333;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .form-container {
            max-width: 1000px;
            margin: 4rem auto;
            position: relative;
            z-index: 2;
        }

        .card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            color: #c8102e;
            font-weight: 900;
            font-size: 2.8rem;
            text-shadow: 0 2px 8px rgba(200,16,46,0.2);
        }

        .form-label {
            font-weight: 600;
            color: #333;
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 0.8rem 1.3rem;
            font-size: 1.05rem;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #c8102e;
            box-shadow: 0 0 0 0.25rem rgba(200,16,46,0.15);
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

        .current-img {
            max-height: 280px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .btn-danger {
            background-color: #c8102e;
            border-color: #c8102e;
        }

        .btn-danger:hover {
            background-color: #a50d22;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(200,16,46,0.3);
        }
    </style>
</head>
<body>

<div class="container form-container">
    <div class="card p-5">
        <h1 class="text-center mb-5">Modifier la recette : {{ $recipe->title }}</h1>

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

        <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

<!-- Titre -->
            <div class="mb-4">
                <label for="title" class="form-label required">Titre de la recette</label>
                <input type="text" name="title" id="title" class="form-control form-control-lg" 
                       value="{{ old('title', $recipe->title) }}" required>
            </div>

            <!-- Ingrédients -->
            <div class="mb-4">
                <label for="ingredients" class="form-label required">Ingrédients (un par ligne)</label>
                <textarea name="ingredients" id="ingredients" rows="7" class="form-control form-control-lg" required>
{{ old('ingredients', $recipe->ingredients) }}
                </textarea>
            </div>

            <!-- Instructions -->
            <div class="mb-4">
                <label for="instructions" class="form-label required">Instructions de préparation</label>
                <textarea name="instructions" id="instructions" rows="10" class="form-control form-control-lg" required>
{{ old('instructions', $recipe->instructions) }}
                </textarea>
            </div>

            <!-- Temps + Catégorie + Difficulté -->
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <label for="prep_time" class="form-label required">Temps de préparation</label>
                    <div class="input-group">
                        <input type="number" name="prep_time" id="prep_time" class="form-control form-control-lg time-input" 
                               min="1" value="{{ old('prep_time', $recipe->prep_time) }}" required>
                        <span class="input-group-text">minutes</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="cook_time" class="form-label">Temps de cuisson</label>
                    <div class="input-group">
                        <input type="number" name="cook_time" id="cook_time" class="form-control form-control-lg time-input" 
                               min="0" value="{{ old('cook_time', $recipe->cook_time ?? '') }}">
                        <span class="input-group-text">minutes</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="category" class="form-label required">Catégorie</label>
                    <select name="category" id="category" class="form-select form-select-lg" required>
                        <option value="Cuisine algérienne" {{ old('category', $recipe->category) == 'Cuisine algérienne' ? 'selected' : '' }}>Cuisine algérienne</option>
                        <option value="Desserts" {{ old('category', $recipe->category) == 'Desserts' ? 'selected' : '' }}>Desserts</option>
                        <option value="Entrées & Salades" {{ old('category', $recipe->category) == 'Entrées & Salades' ? 'selected' : '' }}>Entrées & Salades</option>
                        <option value="Soupes" {{ old('category', $recipe->category) == 'Soupes' ? 'selected' : '' }}>Soupes</option>
                        <option value="Cuisine française" {{ old('category', $recipe->category) == 'Cuisine française' ? 'selected' : '' }}>Cuisine française</option>
                        <option value="Plats principaux" {{ old('category', $recipe->category) == 'Plats principaux' ? 'selected' : '' }}>Plats principaux</option>
                        <option value="Autres" {{ old('category', $recipe->category) == 'Autres' ? 'selected' : '' }}>Autres</option>
                    </select>
                </div>
            </div>

<!-- Difficulté -->
            <div class="mb-4">
                <label for="difficulty" class="form-label required">Niveau de difficulté</label>
                <select name="difficulty" id="difficulty" class="form-select form-select-lg" required>
                    <option value="سهل" {{ old('difficulty', $recipe->difficulty) == 'سهل' ? 'selected' : '' }}>Facile</option>
                    <option value="متوسط" {{ old('difficulty', $recipe->difficulty) == 'متوسط' ? 'selected' : '' }}>Moyen</option>
                    <option value="صعب" {{ old('difficulty', $recipe->difficulty) == 'صعب' ? 'selected' : '' }}>Difficile</option>
                </select>
            </div>

            <!-- Image actuelle + changement -->
            <div class="mb-5">
                <label class="form-label fw-bold">Image actuelle</label>
                <div class="text-center mb-4">
                    @if($recipe->image)
                        <img src="{{ asset('storage/' . $recipe->image) }}" alt="Image actuelle" class="current-img img-fluid">
                    @else
                        <p class="text-muted">Aucune image actuelle</p>
                    @endif
                </div>

                <label for="image" class="form-label">Changer l'image (facultatif)</label>
                <input type="file" name="image" id="image" class="form-control form-control-lg" accept="image/*">
                <small class="form-text text-muted mt-2 d-block">Laissez vide pour conserver l'image actuelle.</small>
            </div>

            <!-- Boutons -->
            <div class="d-flex gap-3 justify-content-end mt-5">
                <a href="{{ route('recipes.index') }}" class="btn btn-outline-secondary btn-lg px-5">Annuler</a>
                <button type="submit" class="btn btn-danger btn-lg px-5 fw-bold">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>