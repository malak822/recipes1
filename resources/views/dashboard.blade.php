<x-app-layout>
    <div class="py-12 bg-gradient-to-b from-gray-50 to-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-orange-500 via-orange-600 to-red-500 rounded-3xl shadow-2xl p-10 mb-10 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-white opacity-5 rounded-full -ml-48 -mb-48"></div>
                <div class="relative z-10">
                    <h1 class="text-5xl font-black mb-4">Bienvenue, {{ Auth::user()->name }}! 👋</h1>
                    <p class="text-2xl opacity-90 mb-8">Nous vous souhaitons une journée pleine de délicieuses recettes et de créativité!</p>
                    <a href="{{ route('recipes.create') }}" 
                       class="inline-flex items-center gap-3 bg-white text-orange-600 px-8 py-4 rounded-2xl font-black text-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                        <span>➕</span> Commencer à ajouter une nouvelle recette
                    </a>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Total Recipes -->
                <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-orange-100 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="text-6xl">📚</div>
                        <div class="bg-gradient-to-br from-orange-500 to-red-500 text-white px-6 py-3 rounded-full font-bold text-2xl">
                            {{ Auth::user()->recipes()->count() }}
                        </div>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-2">Mes Recettes</h3>
                    <p class="text-gray-600 text-base">Total des recettes créées</p>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-3xl shadow-xl p-8 border-2 border-blue-100 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="text-6xl">🕒</div>
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white px-6 py-3 rounded-full font-bold text-sm">
                            Actif
                        </div>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-2">Activité Récente</h3>
                    <p class="text-gray-600 text-base">
                        @if(Auth::user()->recipes()->count() > 0)
                            Dernière recette: {{ Auth::user()->recipes()->latest()->first()->created_at->diffForHumans() }}
                        @else
                            Aucune activité récente
                        @endif
                    </p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-3xl shadow-xl p-8 mb-10">
                <h2 class="text-3xl font-black text-gray-900 mb-6">Actions Rapides 🚀</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <a href="{{ route('recipes.create') }}" 
                       class="group flex items-center gap-6 p-6 bg-gradient-to-br from-orange-100 to-orange-200 rounded-2xl hover:shadow-xl transition-all duration-300 border-2 border-orange-300 hover:border-orange-500">
                        <div class="text-5xl group-hover:scale-125 transition-transform duration-300">➕</div>
                        <div>
                            <h3 class="text-2xl font-black text-orange-700 mb-1">Ajouter une nouvelle recette</h3>
                            <p class="text-orange-600">Partagez votre recette spéciale</p>
                        </div>
                    </a>

                    <a href="{{ route('recipes.index') }}" 
                       class="group flex items-center gap-6 p-6 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl hover:shadow-xl transition-all duration-300 border-2 border-blue-100 hover:border-blue-300">
                        <div class="text-5xl group-hover:scale-125 transition-transform duration-300">🔍</div>
                        <div>
                            <h3 class="text-2xl font-black text-gray-900 mb-1">Parcourir les recettes</h3>
                            <p class="text-gray-600">Découvrez de nouvelles recettes</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Recipes -->
            @if(Auth::user()->recipes()->count() > 0)
            <div class="bg-white rounded-3xl shadow-xl p-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-black text-gray-900">Mes Dernières Recettes 📝</h2>
                    <a href="{{ route('recipes.index') }}" class="text-orange-600 hover:text-orange-700 font-bold">
                        Voir tout →
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach(Auth::user()->recipes()->latest()->take(3)->get() as $recipe)
                        <a href="{{ route('recipes.show', $recipe) }}" 
                           class="group bg-gradient-to-br from-gray-50 to-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border-2 border-gray-100 hover:border-orange-300">
                            <div class="relative h-40 bg-gradient-to-br from-orange-400 via-red-400 to-pink-500 flex items-center justify-center">
                                <span class="text-8xl opacity-90">
                                    @if($recipe->category == 'Dessert') 🍰
                                    @elseif($recipe->category == 'Plat principal') 🍽️
                                    @elseif($recipe->category == 'Entrée') 🥗
                                    @else 🥤
                                    @endif
                                </span>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                        {{ $recipe->category }}
                                    </span>
                                    <span class="text-gray-500 text-xs flex items-center gap-1">
                                        ⏱️ {{ $recipe->cooking_time }} min
                                    </span>
                                </div>
                                <h3 class="font-black text-xl text-gray-900 mb-2 group-hover:text-orange-600 transition-colors">
                                    {{ $recipe->title }}
                                </h3>
                                <p class="text-gray-600 text-sm">
                                    {{ $recipe->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @else
            <div class="bg-white rounded-3xl shadow-xl p-16 text-center">
                <div class="text-9xl mb-6">🍳</div>
                <h3 class="text-4xl font-black text-gray-900 mb-4">Vous n'avez pas encore ajouté de recette!</h3>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                    Commencez votre voyage de partage de délicieuses recettes avec la communauté. Ajoutez votre première recette maintenant!
                </p>
                <a href="{{ route('recipes.create') }}" 
                   class="inline-flex items-center gap-3 bg-gradient-to-r from-orange-500 to-red-500 text-white px-10 py-5 rounded-2xl hover:shadow-2xl transition-all duration-300 font-black text-xl transform hover:scale-105">
                    <span>➕</span> Ajouter la première recette
                </a>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
