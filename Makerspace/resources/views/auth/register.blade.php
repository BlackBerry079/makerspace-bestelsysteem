<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Makerspace - Registreren</title>
  <style>
    :root { --bg: #f3f4f6; --card-bg: #ffffff; --text: #111827; --line: #e5e7eb; --primary: #2563eb; --danger: #b91c1c; --ok: #166534; --ok-bg: #dcfce7; }
    * { box-sizing: border-box; }
    body { margin: 0; font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; color: var(--text); background: linear-gradient(180deg, #eef2ff 0%, #f8fafc 45%, #f3f4f6 100%); min-height: 100vh; }
    .site-header { background: rgba(255, 255, 255, 0.9); border-bottom: 1px solid var(--line); }
    .navbar { max-width: 1100px; margin: 0 auto; padding: 16px 20px; display: flex; justify-content: space-between; align-items: center; gap: 16px; }
    .brand-link, .nav-link { text-decoration: none; font-weight: 600; }
    .brand-link { color: var(--text); font-size: 1.2rem; font-weight: 700; }
    .nav-link { color: var(--primary); }
    .auth-page { width: 100%; max-width: 420px; margin: 56px auto 24px; padding: 0 18px; }
    .auth-card { background-color: var(--card-bg); border: 1px solid var(--line); border-radius: 18px; box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08); padding: 28px 24px; }
    .auth-title { margin: 0 0 22px; font-size: 1.6rem; text-align: center; }
    .form-group { margin-bottom: 14px; }
    .form-label { display: block; margin-bottom: 7px; font-size: 0.95rem; font-weight: 600; }
    .form-input { width: 100%; border: 1px solid #d1d5db; border-radius: 10px; padding: 12px 13px; font: inherit; color: var(--text); }
    .error-message { margin: 4px 0 0; color: var(--danger); font-size: 0.88rem; min-height: 18px; }
    .primary-button { width: 100%; border: none; border-radius: 10px; padding: 12px 16px; margin-top: 8px; background-color: var(--primary); color: #ffffff; font: inherit; font-weight: 600; cursor: pointer; }
    .notice { padding: 12px; margin-bottom: 16px; border-radius: 10px; }
    .notice-ok { background: var(--ok-bg); color: var(--ok); }
  </style>
</head>
<body>
  <header class="site-header">
    <nav class="navbar">
      <a class="brand-link" href="{{ route('orders.index') }}">Makerspace</a>
      <a class="nav-link" href="{{ route('auth.login') }}">Inloggen</a>
    </nav>
  </header>

  <main class="auth-page">
    <section class="auth-card">
      <h1 class="auth-title">Registreren</h1>

      @if (session('success'))
        <div class="notice notice-ok">{{ session('success') }}</div>
      @endif

      <form method="POST" action="{{ route('auth.register.submit') }}">
        @csrf
        <div class="form-group">
          <label class="form-label" for="name">Naam</label>
          <input class="form-input" type="text" id="name" name="name" value="{{ old('name') }}" required>
          @error('name') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="email">E-mailadres</label>
          <input class="form-input" type="email" id="email" name="email" value="{{ old('email') }}" required>
          @error('email') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Wachtwoord</label>
          <input class="form-input" type="password" id="password" name="password" required>
          @error('password') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
          <label class="form-label" for="password_confirmation">Bevestig wachtwoord</label>
          <input class="form-input" type="password" id="password_confirmation" name="password_confirmation" required>
          @error('password_confirmation') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <button class="primary-button" type="submit">Registreren</button>
      </form>
    </section>
  </main>
</body>
</html>
