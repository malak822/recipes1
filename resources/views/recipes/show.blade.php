@extends('layouts.app')

@section('title', $recipe->title)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-orange-50/40 to-pink-50/40">
    <!-- Hero Header with Enhanced Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-orange-500 via-red-500 to-pink-500">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white rounded-full blur-3xl animate-pulse" style="animation-delay: 0.5s;"></div>
        </div>
        
        <!-- Pattern Overlay -->
        <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <!-- Navigation -->
            <div class="flex items-center justify-end mb-10">
                @if($recipe->user_id === Auth::id())
                <div class="flex gap-4">
                    <a href="{{ route('recipes.edit', $recipe) }}" 
                       class="group inline-flex items-center gap-2 px-6 py-3 bg-green-500 text-white rounded-2xl hover:bg-green-600 transition-all duration-300 font-black shadow-2xl hover:shadow-3xl hover:scale-110 border-2 border-green-400">
                        <svg class="w-5 h-5 transform group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Modifier
                    </a>
                    <form method="POST" action="{{ route('recipes.destroy', $recipe) }}" 
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette recette?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="group inline-flex items-center gap-2 px-6 py-3 bg-red-500 text-white rounded-2xl hover:bg-red-600 transition-all duration-300 font-black shadow-2xl hover:shadow-3xl hover:scale-110 border-2 border-red-400">
                            <svg class="w-5 h-5 transform group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Supprimer
                        </button>
                    </form>
                </div>
                @endif
            </div>

            <!-- Title Section -->
            <div class="text-white">
                <div class="relative mb-10">
                    <!-- Chef Card - Positioned Absolute Right -->
                    <div class="absolute top-0 right-0 hidden lg:block">
                        <div class="group bg-white rounded-3xl shadow-2xl p-8 border-2 border-white/30 hover:border-white/50 hover:shadow-3xl transition-all duration-500 w-[350px]">
                            <div class="text-center mb-6">
                                <div class="inline-flex items-center gap-3 px-5 py-2.5 bg-gradient-to-r from-orange-100 to-red-100 rounded-full mb-6 shadow-lg">
                                    <span class="text-2xl">👨‍🍳</span>
                                    <span class="font-black text-orange-600 text-sm uppercase tracking-wider">Le Chef</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-center mb-6">
                                <div class="w-24 h-24 bg-gradient-to-br from-orange-400 via-red-500 to-pink-500 rounded-full flex items-center justify-center text-white text-4xl font-black shadow-2xl mb-5 ring-4 ring-white/30 group-hover:ring-white/50 group-hover:scale-110 transition-all duration-500">
                                    {{ $recipe->user ? strtoupper(substr($recipe->user->name, 0, 1)) : '?' }}
                                </div>
                                <h3 class="font-black text-gray-900 text-2xl mb-2 text-center">{{ $recipe->user ? $recipe->user->name : 'Utilisateur inconnu' }}</h3>
                                <p class="text-gray-600 font-bold text-sm text-center">Chef cuisinier professionnel</p>
                            </div>
                            <div class="pt-6 border-t-2 border-gray-200">
                                <div class="flex items-center justify-between p-5 bg-gradient-to-r from-orange-50 via-red-50 to-pink-50 rounded-2xl border-2 border-orange-100">
                                    <span class="text-gray-700 font-bold text-sm">Recettes publiées</span>
                                    <span class="font-black text-orange-600 text-3xl">{{ $recipe->user ? $recipe->user->recipes()->count() : 0 }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Title - Centered -->
                    <div class="text-center">
                        <h1 class="text-5xl lg:text-7xl font-black mb-10 leading-tight drop-shadow-2xl tracking-tight">
                            {{ $recipe->title }}
                        </h1>
                    </div>
                    <!-- Chef Card - Mobile Version -->
                    <div class="lg:hidden mt-8">
                        <div class="group bg-white rounded-3xl shadow-2xl p-8 border-2 border-white/30 mx-auto max-w-[350px]">
                            <div class="text-center mb-6">
                                <div class="inline-flex items-center gap-3 px-5 py-2.5 bg-gradient-to-r from-orange-100 to-red-100 rounded-full mb-6 shadow-lg">
                                    <span class="text-2xl">👨‍🍳</span>
                                    <span class="font-black text-orange-600 text-sm uppercase tracking-wider">Le Chef</span>
                                </div>
                            </div>
                            <div class="flex flex-col items-center mb-6">
                                <div class="w-24 h-24 bg-gradient-to-br from-orange-400 via-red-500 to-pink-500 rounded-full flex items-center justify-center text-white text-4xl font-black shadow-2xl mb-5 ring-4 ring-white/30 group-hover:ring-white/50 group-hover:scale-110 transition-all duration-500">
                                    {{ $recipe->user ? strtoupper(substr($recipe->user->name, 0, 1)) : '?' }}
                                </div>
                                <h3 class="font-black text-gray-900 text-2xl mb-2 text-center">{{ $recipe->user ? $recipe->user->name : 'Utilisateur inconnu' }}</h3>
                                <p class="text-gray-600 font-bold text-sm text-center">Chef cuisinier professionnel</p>
                            </div>
                            <div class="pt-6 border-t-2 border-gray-200">
                                <div class="flex items-center justify-between p-5 bg-gradient-to-r from-orange-50 via-red-50 to-pink-50 rounded-2xl border-2 border-orange-100">
                                    <span class="text-gray-700 font-bold text-sm">Recettes publiées</span>
                                    <span class="font-black text-orange-600 text-3xl">{{ $recipe->user ? $recipe->user->recipes()->count() : 0 }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-5">
                    <div class="flex items-center gap-4 px-6 py-4 bg-white/25 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 hover:bg-white/35 transition-all duration-300">
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center text-orange-600 font-black text-2xl shadow-2xl ring-4 ring-white/30">
                            {{ $recipe->user ? strtoupper(substr($recipe->user->name, 0, 1)) : '?' }}
                        </div>
                        <div>
                            <p class="font-bold text-lg leading-tight">{{ $recipe->user ? $recipe->user->name : 'Utilisateur inconnu' }}</p>
                            <p class="text-white/80 text-sm font-medium">Chef</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 px-6 py-4 bg-white/25 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 hover:bg-white/35 transition-all duration-300">
                        <div class="w-12 h-12 bg-white/30 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-black text-2xl">{{ $recipe->cooking_time }}</p>
                            <p class="text-white/80 text-xs font-medium uppercase tracking-wide">minutes</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 px-6 py-4 bg-white/25 backdrop-blur-lg rounded-2xl shadow-xl border border-white/20 hover:bg-white/35 transition-all duration-300">
                        <div class="w-12 h-12 bg-white/30 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-black text-xl">{{ $recipe->created_at->format('d/m/Y') }}</p>
                            <p class="text-white/80 text-xs font-medium">Publié le</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 -mt-12">
        <div class="space-y-10">
                <!-- Ingredients Card -->
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border-2 border-orange-200 hover:border-orange-400 transition-all duration-500">
                    <div class="relative bg-gradient-to-br from-orange-500 via-red-500 to-pink-500 p-10 overflow-hidden">
                        <!-- Animated Background -->
                        <div class="absolute inset-0 opacity-30">
                            <div class="absolute top-0 right-0 w-72 h-72 bg-white rounded-full blur-3xl animate-pulse"></div>
                            <div class="absolute bottom-0 left-0 w-56 h-56 bg-white rounded-full blur-3xl animate-pulse" style="animation-delay: 0.7s;"></div>
                        </div>
                        <!-- Pattern -->
                        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 3px 3px, white 2px, transparent 0); background-size: 30px 30px;"></div>
                        
                        <div class="relative flex items-center gap-5">
                            <div class="w-20 h-20 bg-white/25 backdrop-blur-lg rounded-3xl flex items-center justify-center shadow-2xl ring-4 ring-white/20">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h2 class="text-4xl font-black text-white drop-shadow-lg">Ingrédients</h2>
                        </div>
                    </div>
                    <div class="p-10 bg-gradient-to-br from-orange-50/50 to-red-50/50">
                        <div class="grid sm:grid-cols-2 gap-5">
                            @foreach(explode("\n", $recipe->ingredients) as $ingredient)
                                @if(trim($ingredient))
                                <div class="group flex items-center gap-4 p-5 bg-white rounded-2xl border-2 border-orange-100 hover:border-orange-300 hover:shadow-xl transition-all duration-300 hover:scale-105 hover:-translate-y-1">
                                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg group-hover:rotate-180 transition-transform duration-500 ring-2 ring-orange-200">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-800 font-bold text-lg flex-1">{{ trim($ingredient, '- ') }}</span>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Instructions Card -->
                <div class="bg-white rounded-3xl shadow-2xl p-10 border-2 border-green-200 hover:border-green-400 transition-all duration-500">
                    <div class="flex items-center gap-5 mb-10 pb-8 border-b-2 border-green-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 via-teal-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-xl ring-4 ring-green-100">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h2 class="text-4xl font-black text-gray-900">Instructions</h2>
                    </div>
                    <div class="space-y-6">
                        @php
                            $steps = array_filter(array_map('trim', explode("\n", $recipe->instructions)));
                            $stepNumber = 1;
                        @endphp
                        @foreach($steps as $step)
                            <div class="group flex gap-6 p-7 bg-gradient-to-r from-green-50 via-teal-50 to-emerald-50 rounded-2xl border-2 border-green-100 hover:border-green-300 hover:shadow-xl transition-all duration-300 hover:scale-[1.02] hover:-translate-y-1">
                                <div class="w-16 h-16 bg-gradient-to-br from-green-500 via-teal-500 to-emerald-600 text-white rounded-2xl flex items-center justify-center font-black text-2xl flex-shrink-0 shadow-xl group-hover:rotate-12 group-hover:scale-110 transition-all duration-500 ring-4 ring-green-100">
                                    {{ $stepNumber++ }}
                                </div>
                                <p class="text-gray-800 font-bold text-lg leading-relaxed pt-3 flex-1">{{ $step }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
