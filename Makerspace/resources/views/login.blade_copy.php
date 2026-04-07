<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>3D Printer Bestel Forum</title>
  <style>
    :root {
      --bg: #f5f5f5;
      --card: #ffffff;
      --text: #111827;
      --accent: #4f46e5;
      --accent-hover: #4338ca;
      --line: #e5e7eb;
      --muted: #6b7280;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: var(--bg);
      color: var(--text);
      line-height: 1.5;
    }

    header {
      background-color: var(--card);
      border-bottom: 1px solid var(--line);
      padding: 28px 20px;
      text-align: center;
    }

    h1 {
      margin: 0;
      font-size: 2rem;
      letter-spacing: 0.2px;
    }

    main {
      max-width: 800px;
      margin: 36px auto 56px;
      padding: 0 20px;
    }

    .card {
      background-color: var(--card);
      border-radius: 14px;
      box-shadow: 0 8px 20px rgba(17, 24, 39, 0.08);
      padding: 24px;
    }

    .section-header {
      margin: 0 0 18px;
      font-size: 1.4rem;
    }

    .section-divider {
      border: 0;
      border-top: 1px solid var(--line);
      margin: 34px 0;
    }

    form label {
      display: block;
      font-weight: 600;
      margin: 0 0 8px;
    }

    form input,
    form select,
    form textarea {
      width: 100%;
      padding: 12px 14px;
      border: 1px solid #d1d5db;
      border-radius: 10px;
      font: inherit;
      color: var(--text);
      background-color: #ffffff;
      margin-bottom: 16px;
    }

    form textarea {
      resize: vertical;
      min-height: 110px;
    }

    button {
      display: inline-block;
      border: none;
      border-radius: 10px;
      padding: 12px 18px;
      font: inherit;
      font-weight: 600;
      color: #ffffff;
      background-color: var(--accent);
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    button:hover {
      background-color: var(--accent-hover);
    }

    .orders {
      display: grid;
      gap: 16px;
    }

    .order-card h3 {
      margin: 0 0 10px;
      font-size: 1.1rem;
    }

    .order-card p {
      margin: 6px 0;
      color: #1f2937;
      font-size: 0.96rem;
    }

    .order-date {
      margin-top: 12px;
      color: var(--muted);
      font-size: 0.9rem;
    }

    .error-message {
      margin: -8px 0 16px;
      font-size: 0.9rem;
      color: #b91c1c;
    }

    .modal-backdrop {
      position: fixed;
      inset: 0;
      background: rgba(15, 23, 42, 0.55);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 20;
      padding: 16px;
    }

    .modal {
      background: var(--card);
      border-radius: 16px;
      box-shadow: 0 20px 45px rgba(15, 23, 42, 0.28);
      max-width: 380px;
      width: 100%;
      padding: 24px 22px 20px;
      text-align: center;
    }

    .modal-title {
      margin: 0 0 8px;
      font-size: 1.25rem;
    }

    .modal-body {
      margin: 0 0 20px;
      font-size: 0.98rem;
      color: var(--muted);
    }

    .modal button {
      width: 100%;
    }
  </style>
</head>
<body>
  <header>
    <h1>3D Printer Bestel Forum</h1>
  </header>

  <main>
    <section class="card">
      <h2 class="section-header">Nieuwe bestelling</h2>
      <form id="order-form">
        <label for="naam">Naam</label>
        <input type="text" id="naam" name="naam" required>

        <label for="filament-type">Type filament</label>
        <select id="filament-type" name="filament-type">
          <option value="PLA">PLA</option>
          <option value="ABS">ABS</option>
          <option value="PETG">PETG</option>
        </select>

        <label for="kleur-filament">Kleur filament</label>
        <input type="text" id="kleur-filament" name="kleur-filament">

        <label for="model-bestand">3D model bestand (.stl, .obj, .3mf)</label>
        <input
          type="file"
          id="model-bestand"
          name="model-bestand"
          accept=".stl,.obj,.3mf"
          required
        >
        <p id="file-error" class="error-message" style="display: none;">
          Alleen bestanden met de extensie .stl, .obj of .3mf zijn toegestaan.
        </p>

        <label for="beschrijving">Beschrijving van de print</label>
        <textarea id="beschrijving" name="beschrijving"></textarea>

        <label for="datum">Datum</label>
        <input type="date" id="datum" name="datum" required>

        <button type="submit">Verstuur bestelling</button>
      </form>
    </section>

    <hr class="section-divider">

    <section>
      <h2 class="section-header">Geplaatste bestellingen</h2>

      <div class="orders">
        <div class="card order-card">
          <h3>Alex</h3>
          <p><strong>Filament type:</strong> PLA</p>
          <p><strong>Kleur:</strong> Zwart</p>
          <p><strong>Hoeveelheid:</strong> 120 gram</p>
          <p><strong>Beschrijving:</strong> Telefoonhouder voor bureau</p>
          <p class="order-date">Datum: 2026-03-20</p>
        </div>

        <div class="card order-card">
          <h3>Samira</h3>
          <p><strong>Filament type:</strong> PETG</p>
          <p><strong>Kleur:</strong> Wit</p>
          <p><strong>Hoeveelheid:</strong> 250 gram</p>
          <p><strong>Beschrijving:</strong> Behuizing voor sensorproject</p>
          <p class="order-date">Datum: 2026-03-22</p>
        </div>

        <div class="card order-card">
          <h3>Daan</h3>
          <p><strong>Filament type:</strong> ABS</p>
          <p><strong>Kleur:</strong> Rood</p>
          <p><strong>Hoeveelheid:</strong> 180 gram</p>
          <p><strong>Beschrijving:</strong> Tandwielset voor robotarm</p>
          <p class="order-date">Datum: 2026-03-24</p>
        </div>
      </div>
    </section>
  </main>

  <div id="thankyou-backdrop" class="modal-backdrop">
    <div class="modal">
      <h2 class="modal-title">Bedankt voor je bestelling!</h2>
      <p class="modal-body">
        Je aanvraag is ontvangen. We gaan zo snel mogelijk voor je aan de slag.
      </p>
      <button type="button" id="close-modal">Sluit</button>
    </div>
  </div>

  <script>
    (function () {
      var form = document.getElementById('order-form');
      var fileInput = document.getElementById('model-bestand');
      var fileError = document.getElementById('file-error');
      var backdrop = document.getElementById('thankyou-backdrop');
      var closeBtn = document.getElementById('close-modal');

      if (!form || !fileInput) {
        return;
      }

      function hasValidExtension(fileName) {
        var lowered = fileName.toLowerCase();
        return (
          lowered.endsWith('.stl') ||
          lowered.endsWith('.obj') ||
          lowered.endsWith('.3mf')
        );
      }

      form.addEventListener('submit', function (event) {
        event.preventDefault();
        fileError.style.display = 'none';

        var file = fileInput.files[0];

        if (!file || !hasValidExtension(file.name)) {
          fileError.style.display = 'block';
          return;
        }

        if (backdrop) {
          backdrop.style.display = 'flex';
        }
      });

      if (closeBtn && backdrop) {
        closeBtn.addEventListener('click', function () {
          backdrop.style.display = 'none';
        });

        backdrop.addEventListener('click', function (event) {
          if (event.target === backdrop) {
            backdrop.style.display = 'none';
          }
        });
      }
    })();
  </script>
</body>
</html>