<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <link href="https://fonts.googleapis.com/css2?family=Rye&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    :root{
      --card-bg: rgba(255,255,255,0.98);
      --accent: #f97316;
      --muted: #6b7280;
    }

    html,body{height:100%;margin:0;font-family: 'Playfair Display', serif; -webkit-font-smoothing:antialiased; -moz-osx-font-smoothing:grayscale;}

    .page-bg{
      min-height:100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding:32px;
      background: linear-gradient(120deg, #fffaf6 0%, #fff6f0 25%, #fffefc 50%, #fff8f3 75%, #fffaf6 100%);
      background-size: 600% 600%;
      animation: gradientShift 14s ease infinite;
      position:relative;
    }

    @keyframes gradientShift { 0%{background-position:0% 50%} 50%{background-position:100% 50%} 100%{background-position:0% 50%} }

    .page-bg::before{
      content:"";
      position:absolute; inset:0;
      background-image:
        radial-gradient(circle at 10% 10%, rgba(250, 215, 170, 0.02), transparent 8%),
        radial-gradient(circle at 90% 90%, rgba(255, 200, 150, 0.02), transparent 8%);
      pointer-events:none; z-index:0;
    }

    /* البطاقة الآن شبه مربع: عرض أكبر وارتفاع أدنى (قابل للنمو) */
    .auth-card{
      position:relative; z-index:1;
      width:520px;                 /* عرض أكبر يجعلها أقرب للمربع */
      min-height:520px;            /* يجعلها مربّعة تقريبًا */
      max-width:calc(100% - 32px);
      background: var(--card-bg);
      border-radius:16px;
      box-shadow: 0 22px 60px rgba(15,23,42,0.08);
      padding:34px;
      display:flex;
      flex-direction:column;
      align-items:center;
      gap:14px;
      overflow:auto;
    }

    /* داخلياً: نجعل نموذج الإدخال ضيقًا داخل البطاقة حتى تظل البطاقة مربّعة */
    .form-container {
      width:100%;
      max-width:380px; /* يحافظ على محاذاة الحقول ضمن البطاقة */
    }

    /* صورة الدائرة أكبر */
    .chef-circle {
      width:192px;
      height:192px;
      border-radius:50%;
      object-fit:cover;
      box-shadow: 0 20px 40px rgba(15,23,42,0.07);
      border: 6px solid rgba(249,115,22,0.06);
      background:#fff;
    }

    .fr-heading{
      font-family: 'Rye', 'Playfair Display', serif;
      font-size:20px;
      color:var(--accent);
      margin:6px 0 2px;
      letter-spacing:0.6px;
    }

    .muted { color: var(--muted); font-size:14px; }

    @media (max-width: 700px){
      .auth-card{ width:92%; min-height:auto; padding:22px; }
      .chef-circle{ width:140px; height:140px; }
      .form-container{ max-width:100%; }
    }
  </style>

  @stack('styles')
</head>
<body>
  <div class="page-bg">
    <div class="auth-card">
      @yield('content')
    </div>
  </div>

  @stack('scripts')
</body>
</html>