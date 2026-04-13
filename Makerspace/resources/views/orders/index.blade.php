<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>3D Printer Bestel Forum</title>
  <style>
    :root { --bg: #f5f5f5; --card: #ffffff; --text: #111827; --accent: #4f46e5; --accent-hover: #4338ca; --line: #e5e7eb; --muted: #6b7280; --danger: #b91c1c; --ok: #166534; --ok-bg: #dcfce7; }
    * { box-sizing: border-box; }
    body { margin: 0; font-family: Arial, sans-serif; background-color: var(--bg); color: var(--text); line-height: 1.5; }
    header { background-color: var(--card); border-bottom: 1px solid var(--line); padding: 28px 20px; text-align: center; }
    h1 { margin: 0; font-size: 2rem; }
    main { max-width: 800px; margin: 36px auto 56px; padding: 0 20px; }
    .card { background-color: var(--card); border-radius: 14px; box-shadow: 0 8px 20px rgba(17, 24, 39, 0.08); padding: 24px; }
    .section-header { margin: 0 0 18px; font-size: 1.4rem; }
    .section-divider { border: 0; border-top: 1px solid var(--line); margin: 34px 0; }
    form label { display: block; font-weight: 600; margin: 0 0 8px; }
    form input, form select, form textarea { width: 100%; padding: 12px 14px; border: 1px solid #d1d5db; border-radius: 10px; font: inherit; color: var(--text); background-color: #ffffff; margin-bottom: 16px; }
    form textarea { resize: vertical; min-height: 110px; }
    button { display: inline-block; border: none; border-radius: 10px; padding: 12px 18px; font: inherit; font-weight: 600; color: #ffffff; background-color: var(--accent); cursor: pointer; }
    button:hover { background-color: var(--accent-hover); }
    .orders { display: grid; gap: 16px; }
    .order-card h3 { margin: 0 0 10px; font-size: 1.1rem; }
    .order-card p { margin: 6px 0; color: #1f2937; font-size: 0.96rem; }
    .order-date { margin-top: 12px; color: var(--muted); font-size: 0.9rem; }
    .error-message { margin: -8px 0 16px; font-size: 0.9rem; color: var(--danger); }
    .notice { padding: 12px; margin-bottom: 16px; border-radius: 10px; }
    .notice-ok { background: var(--ok-bg); color: var(--ok); }
  </style>
</head>
<body>
  <header>
    <h1>3D Printer Bestel Forum</h1>
  </header>

  <main>
    <section class="card">
      <h2 class="section-header">Nieuwe bestelling</h2>

      @if (session('success'))
        <div class="notice notice-ok">{{ session('success') }}</div>
      @endif

      <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
        @csrf

        <label for="naam">Naam</label>
        <input type="text" id="naam" name="naam" value="{{ old('naam') }}" required>

        <label for="filament-type">Type filament</label>
        <select id="filament-type" name="filament_type">
          <option value="PLA" @selected(old('filament_type') === 'PLA')>PLA</option>
          <option value="ABS" @selected(old('filament_type') === 'ABS')>ABS</option>
          <option value="PETG" @selected(old('filament_type') === 'PETG')>PETG</option>
        </select>

        <label for="kleur-filament">Kleur filament</label>
        <input type="text" id="kleur-filament" name="kleur_filament" value="{{ old('kleur_filament') }}">

        <label for="model-bestand">3D model bestand (.stl, .obj, .3mf)</label>
        <input type="file" id="model-bestand" name="model_bestand" accept=".stl,.obj,.3mf" required>
        @error('model_bestand')
          <p class="error-message">{{ $message }}</p>
        @enderror

        <label for="beschrijving">Beschrijving van de print</label>
        <textarea id="beschrijving" name="beschrijving">{{ old('beschrijving') }}</textarea>

        <label for="datum">Datum</label>
        <input type="date" id="datum" name="datum" value="{{ old('datum') }}" required>

        <button type="submit">Verstuur bestelling</button>
      </form>
    </section>

    <hr class="section-divider">

    <section>
      <h2 class="section-header">Geplaatste bestellingen</h2>
      <div class="orders">
        @forelse ($orders as $order)
          <div class="card order-card">
            <h3>{{ $order->title }}</h3>
            <p><strong>Beschrijving:</strong> {{ $order->description ?: 'Geen beschrijving' }}</p>
            <p><strong>Bestand:</strong> {{ $order->file_path }}</p>
            <p class="order-date">Datum: {{ optional($order->created_at)->format('Y-m-d') }}</p>
          </div>
        @empty
          <div class="card order-card">
            <p>Er zijn nog geen bestellingen geplaatst.</p>
          </div>
        @endforelse
      </div>
    </section>
  </main>
</body>
</html>
