<style>
    :root {
        --bg: #faf8f5;
        --accent: #f97316;
        --accent-dark: #ea580c;
        --dark: #1c1917;
        --muted: #78716c;
        --card: #ffffff;
        --radius: 1.25rem;
        --shadow: 0 4px 24px rgba(28, 25, 23, 0.06);
        --shadow-hover: 0 16px 40px rgba(249, 115, 22, 0.12);
    }
    * { box-sizing: border-box; }
    body {
        margin: 0;
        background: var(--bg);
        color: var(--dark);
        font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        -webkit-font-smoothing: antialiased;
    }
    a { color: inherit; }
    .site-header {
        background: var(--card);
        border-bottom: 1px solid #e7e5e4;
        position: sticky;
        top: 0;
        z-index: 50;
    }
    .header-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }
    .logo {
        font-size: 1.15rem;
        font-weight: 800;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .logo span { color: var(--accent); }
    .header-nav {
        display: flex;
        gap: 0.6rem;
        align-items: center;
        flex-wrap: wrap;
    }
    .header-nav a {
        text-decoration: none;
        font-weight: 700;
        font-size: 0.92rem;
        padding: 0.45rem 0.9rem;
        border-radius: 999px;
        border: 1px solid #fed7aa;
        background: #fff7ed;
        color: var(--accent-dark);
        transition: all 0.2s ease;
    }
    .header-nav a:hover {
        color: #fff;
        background: var(--accent);
        border-color: var(--accent);
    }
    .header-nav a.nav-active {
        color: #fff;
        background: var(--accent);
        border-color: var(--accent);
    }
    .auth-btns { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; }
    .user-greeting { font-size: 0.85rem; font-weight: 600; color: var(--muted); }
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.55rem 1.1rem;
        border-radius: 999px;
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        font-family: inherit;
    }
    .btn-ghost { background: transparent; color: var(--muted); border: 1.5px solid #d6d3d1; }
    .btn-ghost:hover { border-color: var(--accent); color: var(--accent); }
    .btn-primary { background: var(--accent); color: #fff; }
    .btn-primary:hover { background: var(--accent-dark); }
    .btn-green { background: #22c55e; color: #fff; }
    .btn-green:hover { background: #16a34a; }
    .btn-edit { background: #3b82f6; color: #fff; }
    .btn-edit:hover { background: #2563eb; }
    .btn-danger { background: #fff; color: #e11d48; border: 1.5px solid #fecdd3; }
    .btn-danger:hover { background: #fff1f2; }
    .guest-banner {
        background: #fff7ed;
        border-bottom: 1px solid #fed7aa;
        padding: 0.65rem 1.5rem;
        text-align: center;
        font-size: 0.88rem;
        color: var(--muted);
    }
    .guest-banner a { color: var(--accent); font-weight: 700; }
    .fab-wrap {
        position: fixed;
        bottom: 1.5rem;
        right: 1.5rem;
        z-index: 60;
        width: 4.25rem;
        height: 4.25rem;
    }
    .fab-wrap::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 2px solid rgba(34, 197, 94, 0.55);
        animation: fab-orbit 2.5s ease-in-out infinite;
    }
    .fab-add {
        position: absolute;
        inset: 0.35rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(145deg, #22c55e, #16a34a);
        color: #fff;
        font-size: 1.35rem;
        border-radius: 50%;
        text-decoration: none;
        border: 2px solid #fff;
        box-shadow: 0 6px 22px rgba(34, 197, 94, 0.45);
    }
    .fab-add:hover { background: linear-gradient(145deg, #16a34a, #15803d); transform: scale(1.08); }
    @keyframes fab-orbit {
        0%, 100% { transform: scale(1); opacity: 0.9; }
        50% { transform: scale(1.12); opacity: 0.35; }
    }
</style>
