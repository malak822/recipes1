<header class="site-header">
    <div class="header-inner">
        <a href="{{ route('recipes.index') }}" class="logo">
            🍳 <span>Recettes</span> Gourmandes
        </a>
        <nav class="header-nav">
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'nav-active' : '' }}">About</a>
            <a href="{{ route('recipes.index') }}" class="{{ request()->routeIs('recipes.index') && !request()->filled('category') && !request()->filled('search') ? 'nav-active' : '' }}">Accueil</a>
            <a href="{{ route('recipes.index') }}#categories">Catégorie</a>
        </nav>
        @unless(request()->routeIs('about'))
        <div class="auth-btns">
            @auth
                <span class="user-greeting">Bonjour, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-ghost">Déconnexion</button>
                </form>
                <a href="{{ route('recipes.create') }}" class="btn btn-green">
                    <i class="fas fa-plus"></i> Ajouter une recette
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-ghost">Connexion</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Créer un compte</a>
            @endauth
        </div>
        @endunless
    </div>
</header>

@if(!Auth::check() && !request()->routeIs('about'))
<div class="guest-banner">
  <p><i class="fas fa-info-circle"></i> <a href="{{ route('login') }}">Connectez-vous</a> pour ajouter, modifier ou supprimer vos recettes.</p>
</div>
@endif
