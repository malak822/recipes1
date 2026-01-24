@extends('layouts.guest')

@section('content')
  <div dir="ltr" class="w-full flex flex-col items-center">
    <!-- صورة دائرية للشيف -->
    <div class="flex justify-center mb-4 w-full">
    <img src="{{ asset('images/cooking-logo.jpg') }}" alt="Chef" class="chef-circle" /></div>

    <div class="text-center mb-3">
      <h1 class="fr-heading">Connexion Chef</h1>
      <p class="muted">Connectez-vous pour partager vos recettes</p>
    </div>

    <!-- نموذج داخل حاوية ضيقة -->
    <div class="form-container">
      <!-- رسائل الخطأ -->
      @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
          <p class="text-red-700 font-semibold text-sm">{{ $errors->first() }}</p>
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <div class="space-y-4">
          <!-- E-mail -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 shadow-sm focus:ring-2 focus:ring-amber-300" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>

          <!-- Mot de passe -->
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input id="password" name="password" type="password" required autocomplete="current-password"
                   class="mt-1 block w-full rounded-lg border border-gray-200 px-3 py-2 shadow-sm focus:ring-2 focus:ring-amber-300" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>

          <!-- Remember me -->
          <div class="flex items-center">
            <input id="remember_me" name="remember" type="checkbox"
                   class="h-4 w-4 rounded border-gray-300 text-amber-600 focus:ring-amber-500" />
            <label for="remember_me" class="ml-2 block text-sm text-gray-700">
              Se souvenir de moi
            </label>
          </div>
        </div>

        <div class="mt-6 flex items-center justify-between">
          <a class="already-link" href="{{ route('register') }}">Créer un compte</a>

          <button type="submit" class="ms-4 inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white font-semibold px-4 py-2 rounded-lg shadow">
            Se connecter
          </button>
        </div>
      </form>

      <!-- حساب تجريبي -->
      <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <p class="text-sm font-semibold text-blue-700 mb-2">🔐 Compte de test:</p>
        <p class="text-xs text-blue-600">Email: malak@gmail.com</p>
        <p class="text-xs text-blue-600">Password: 12345678</p>
      </div>

      <div class="mt-6 text-center text-sm text-gray-400">
        En vous connectant, vous acceptez les conditions d'utilisation et la politique de confidentialité.
      </div>
    </div>
  </div>
@endsection

@push('styles')
<style>
/* نفس الـ CSS من صفحة Register */
.auth-card label,
.auth-card .block.text-sm.font-medium,
.auth-card .text-sm.font-medium {
  color: #000 !important;
  font-weight: 700 !important;
  font-size: 15px !important;
  line-height: 1.25;
}

.auth-card,
.auth-card h1,
.auth-card h2,
.auth-card p,
.auth-card .muted,
.auth-card .already-link,
.auth-card .text-sm,
.auth-card .fr-heading {
  color: #000 !important;
}

.auth-card .already-link {
  font-weight: 800 !important;
  font-size: 17px !important;
  color: #000 !important;
  text-decoration: none;
}
.auth-card .already-link:hover { text-decoration: underline; }

.auth-card .text-sm.text-gray-400 {
  color: #000 !important;
  font-weight: 600 !important;
  font-size: 15px !important;
  opacity: 0.95;
  text-align: center;
}

.auth-card input,
.auth-card textarea,
.auth-card select {
  color: #000 !important;
  font-weight: 600 !important;
}

.form-container { width:100%; max-width:380px; }
.chef-circle { width:192px; height:192px; border-radius:50%; object-fit:cover; box-shadow:0 20px 40px rgba(15,23,42,0.07); border:6px solid rgba(249,115,22,0.06); background:#fff; }

@media (max-width:700px){
  .chef-circle{ width:140px; height:140px; }
  .form-container{ max-width:100%; }
  .auth-card label, .auth-card .already-link { font-size:15px !important; }
}

.fr-heading {
  font-family: 'Rye', 'Playfair Display', serif;
  font-weight: 700;
  color: #D35400;
  font-size: 22px;
  letter-spacing: 0.6px;
}

.muted {
  color: #6b7280;
  font-weight: 400;
}

label {
  color: #374151;
  font-weight: 600;
}

input, textarea, select {
  color: #111827;
}

button[type="submit"], .btn-primary {
  background-color: #D35400;
  border-color: #B84300;
  color: #ffffff;
  font-weight: 700;
}

button[type="submit"]:hover, .btn-primary:hover {
  background-color: #B84300;
}

a {
  color: #374151;
}

img.rounded-full {
  border: 6px solid rgba(211,84,0,0.06);
  box-shadow: 0 14px 30px rgba(15,23,42,0.06);
}
</style>
@endpush