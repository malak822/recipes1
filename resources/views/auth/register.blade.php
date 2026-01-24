<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - RecipeShare</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-orange-50 to-red-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
        <!-- Logo et titre -->
        <div class="text-center mb-8">
            <div class="inline-block p-4 bg-gradient-to-br from-orange-400 to-red-500 rounded-2xl mb-4">
                <span class="text-5xl">🍳</span>
            </div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">
                RecipeShare
            </h1>
            <p class="text-gray-500 mt-2">Créez votre compte</p>
        </div>

        <!-- Messages d'erreur -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                <p class="font-semibold">Erreurs de validation</p>
                <ul class="text-sm mt-2 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">
                    👤 Nom complet
                </label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}"
                    required
                    autofocus
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-orange-200 focus:border-orange-500 transition-all"
                    placeholder="Votre nom"
                >
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">
                    📧 Email
                </label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    required
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-orange-200 focus:border-orange-500 transition-all"
                    placeholder="votre@email.com"
                >
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">
                    🔒 Mot de passe
                </label>
                <input 
                    type="password" 
                    name="password" 
                    required
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-orange-200 focus:border-orange-500 transition-all"
                    placeholder="Au moins 8 caractères"
                >
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">
                    🔒 Confirmer le mot de passe
                </label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    required
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:ring-4 focus:ring-orange-200 focus:border-orange-500 transition-all"
                    placeholder="Retapez le mot de passe"
                >
            </div>

            <!-- Bouton inscription -->
            <button 
                type="submit"
                class="w-full py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl hover:from-orange-600 hover:to-red-600 transition-all shadow-lg hover:shadow-xl transform hover:scale-105 font-bold text-lg"
            >
                S'inscrire
            </button>
        </form>

        <!-- Lien connexion -->
        <div class="mt-6 text-center">
            <p class="text-gray-600">
                Vous avez déjà un compte? 
                <a href="{{ route('login') }}" class="text-orange-500 hover:text-orange-600 font-semibold">
                    Se connecter
                </a>
            </p>
        </div>
    </div>
</body>
</html>