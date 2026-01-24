 <!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Plateforme de recettes</title>
  
  <!-- هنا نضع الـ CSS (الطريقة  ) -->
  <style>
    
    .navbar-modern {
      position: relative;
      background: linear-gradient(-45deg, #fb923c, #f97316, #ea580c, #c2410c);
      background-size: 400% 400%;
      animation: gradientFlow 20s ease infinite;
      padding: 1.5rem 0;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      overflow: hidden;
    }

    @keyframes gradientFlow {
      0%   { background-position: 0% 50%; }
      50%  { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    .container {
      max-width: 1300px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .nav-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
    }

    .logo-title {
      text-align: center;
      color: #fff;
      flex: 1;
    }

    .logo-title h1 {
      font-size: 2.8rem;
      font-weight: 900;
      margin: 0;
      letter-spacing: -1px;
      background: linear-gradient(to right, #ffffff, #e3f2fd);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .logo-title .slogan {
      margin: 8px 0 0;
      font-size: 1.2rem;
      opacity: 0.9;
    }

    .btn-add-recipe {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 14px 28px;
      background: linear-gradient(135deg, #22c55e, #16a34a);
      color: white;
      font-size: 1.15rem;
      font-weight: bold;
      text-decoration: none;
      border-radius: 50px;
      border: 2px solid #4ade80;
      box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
      transition: all 0.4s ease;
      position: relative;
      overflow: hidden;
    }

    .btn-add-recipe span {
      font-size: 1.8rem;
      font-weight: bold;
    }

    .btn-add-recipe:hover {
      transform: translateY(-4px) scale(1.05);
      box-shadow: 0 12px 30px rgba(34, 197, 94, 0.6);
      background: linear-gradient(135deg, #16a34a, #15803d);
      border-color: #4ade80;
    }

    .btn-add-recipe::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 50%;
      height: 100%;
      background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.4),
        transparent
      );
      transition: 0.7s;
    }

    .btn-add-recipe:hover::before {
      left: 100%;
    }

    @media (max-width: 768px) {
      .nav-content {
        flex-direction: column;
        text-align: center;
      }
      
      .btn-add-recipe {
        margin-top: 15px;
        padding: 12px 24px;
        font-size: 1.1rem;
      }
      
      .logo-title h1 {
        font-size: 2.2rem;
      }
    }
  </style>
</head>
<body>

  <nav class="navbar-modern">
    <div class="container">
      <div class="nav-content">
        <!-- العنوان في الوسط -->
        <a href="/recipes" class="logo-title text-decoration-none">
          <h1>Plateforme de partage de recettes</h1>
          <p class="slogan">شاركوا أشهى وصفاتكم مع العالم 🍳✨</p>
        </a>

        <!-- زر الإضافة -->
        <a href="/recipes/create" class="btn-add-recipe">
          <span>+</span> إضافة وصفة جديدة
        </a>
      </div>
    </div>
  </nav>

  <!-- باقي محتوى الصفحة هنا -->
  
</body>
</html>