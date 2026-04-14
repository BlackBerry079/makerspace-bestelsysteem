<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>3D Printer Bestel Forum</title>
  <style>
    :root { --bg: #f5f5f5; --card: #ffffff; --text: #111827; --accent: #4f46e5; --accent-hover: #4338ca; --line: #e5e7eb; --muted: #6b7280; --danger: #b91c1c; --ok: #166534; --ok-bg: #dcfce7; --panel-shadow: 0 16px 32px rgba(17, 24, 39, 0.18); }
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
    .newsletter-toggle {
      position: fixed;
      right: 0;
      top: 45%;
      transform: translateY(-50%);
      border-radius: 12px 0 0 12px;
      padding: 12px 10px;
      z-index: 1030;
      box-shadow: 0 6px 18px rgba(79, 70, 229, 0.32);
      display: flex;
      align-items: center;
      gap: 8px;
      min-width: 64px;
      justify-content: center;
    }
    .newsletter-toggle-badge {
      background: #dc2626;
      color: #fff;
      border-radius: 999px;
      padding: 2px 8px;
      font-size: 0.75rem;
      font-weight: 700;
    }
    .newsletter-panel {
      position: fixed;
      top: 0;
      right: 0;
      width: min(420px, 92vw);
      height: 100vh;
      background: #fff;
      box-shadow: var(--panel-shadow);
      z-index: 1040;
      transform: translateX(104%);
      transition: transform 240ms ease;
      display: flex;
      flex-direction: column;
      border-left: 1px solid var(--line);
    }
    .newsletter-panel.is-open { transform: translateX(0); }
    .newsletter-panel-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px 18px;
      border-bottom: 1px solid var(--line);
      background: #f8f9ff;
    }
    .newsletter-panel-title {
      margin: 0;
      font-size: 1.1rem;
    }
    .newsletter-close {
      border-radius: 999px;
      width: 34px;
      height: 34px;
      padding: 0;
      font-size: 1.1rem;
      line-height: 1;
      background: #eef2ff;
      color: #312e81;
    }
    .newsletter-content {
      padding: 14px 16px 20px;
      overflow-y: auto;
      display: grid;
      gap: 12px;
    }
    .newsletter-item {
      border: 1px solid var(--line);
      border-radius: 12px;
      padding: 12px;
      background: #fff;
    }
    .newsletter-item h3 {
      margin: 0 0 6px;
      font-size: 1rem;
    }
    .newsletter-meta {
      display: flex;
      gap: 8px;
      color: var(--muted);
      font-size: 0.82rem;
      margin-bottom: 6px;
    }
    .newsletter-type {
      display: inline-block;
      background: #eef2ff;
      color: #3730a3;
      border-radius: 999px;
      padding: 3px 8px;
      font-weight: 700;
      text-transform: uppercase;
      font-size: 0.68rem;
      letter-spacing: 0.04em;
    }
    .newsletter-empty {
      color: var(--muted);
      text-align: center;
      padding: 24px 10px;
      border: 1px dashed var(--line);
      border-radius: 12px;
    }
    @media (max-width: 640px) {
      .newsletter-panel {
        width: 100vw;
      }
      .newsletter-toggle {
        top: auto;
        bottom: 16px;
        right: 16px;
        transform: none;
        border-radius: 999px;
        padding: 12px 14px;
      }
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

  <button id="newsletter-toggle" class="newsletter-toggle" type="button" aria-label="Open nieuwsbrief">
    <span>Nieuws</span>
    <span id="newsletter-toggle-badge" class="newsletter-toggle-badge" hidden>Nieuw</span>
  </button>

  <aside id="newsletter-panel" class="newsletter-panel" aria-hidden="true">
    <div class="newsletter-panel-header">
      <h2 class="newsletter-panel-title">Laatste nieuwsbrief</h2>
      <button id="newsletter-close" class="newsletter-close" type="button" aria-label="Sluit nieuwsbrief">×</button>
    </div>
    <div id="newsletter-content" class="newsletter-content">
      <div class="newsletter-empty">Nieuwsbrief laden...</div>
    </div>
  </aside>

  <script>
    class NewsletterPanel {
      constructor(options) {
        this.endpoint = options.endpoint;
        this.panel = document.getElementById(options.panelId);
        this.toggle = document.getElementById(options.toggleId);
        this.close = document.getElementById(options.closeId);
        this.content = document.getElementById(options.contentId);
        this.badge = document.getElementById(options.badgeId);
        this.storageKeySeen = "newsletter-last-seen-id";
        this.storageKeyDismissed = "newsletter-panel-dismissed";
      }

      init() {
        if (!this.panel || !this.toggle || !this.close || !this.content) {
          return;
        }

        this.toggle.addEventListener("click", () => this.open());
        this.close.addEventListener("click", () => this.closePanel());
        document.addEventListener("keydown", (event) => {
          if (event.key === "Escape") {
            this.closePanel();
          }
        });

        this.fetchAndRender();
      }

      async fetchAndRender() {
        try {
          const response = await fetch(this.endpoint, { headers: { "Accept": "application/json" } });
          if (!response.ok) {
            throw new Error("Kon nieuwsbrief niet ophalen");
          }

          const payload = await response.json();
          const items = Array.isArray(payload.items) ? payload.items : [];
          this.renderItems(items);
          this.updateNewIndicator(payload.latest);

          const wasDismissed = localStorage.getItem(this.storageKeyDismissed) === "1";
          if (!wasDismissed && items.length > 0) {
            this.open();
          }
        } catch (error) {
          this.content.innerHTML = '<div class="newsletter-empty">Nieuwsbrief tijdelijk niet beschikbaar.</div>';
        }
      }

      renderItems(items) {
        if (!items.length) {
          this.content.innerHTML = '<div class="newsletter-empty">Er zijn nog geen nieuwsbrief-updates.</div>';
          return;
        }

        this.content.innerHTML = items.map((item) => {
          const createdAt = item.created_at ? new Date(item.created_at).toLocaleDateString("nl-NL") : "Onbekend";
          const safeTitle = this.escapeHtml(item.title || "Zonder titel");
          const safeDescription = this.escapeHtml(item.description || "Geen beschrijving");
          const safeType = this.escapeHtml(item.type || "info");

          return `
            <article class="newsletter-item" data-id="${Number(item.id) || 0}">
              <h3>${safeTitle}</h3>
              <div class="newsletter-meta">
                <span class="newsletter-type">${safeType}</span>
                <span>${createdAt}</span>
              </div>
              <p>${safeDescription}</p>
            </article>
          `;
        }).join("");
      }

      updateNewIndicator(latest) {
        if (!latest || !latest.id) {
          this.badge.hidden = true;
          return;
        }

        const lastSeenId = Number(localStorage.getItem(this.storageKeySeen) || 0);
        const hasNew = Number(latest.id) > lastSeenId;
        this.badge.hidden = !hasNew;
      }

      open() {
        this.panel.classList.add("is-open");
        this.panel.setAttribute("aria-hidden", "false");
        localStorage.setItem(this.storageKeyDismissed, "0");
      }

      closePanel() {
        this.panel.classList.remove("is-open");
        this.panel.setAttribute("aria-hidden", "true");
        localStorage.setItem(this.storageKeyDismissed, "1");
        this.markAsSeen();
      }

      markAsSeen() {
        const firstItem = this.content.querySelector(".newsletter-item");
        if (!firstItem) {
          this.badge.hidden = true;
          return;
        }

        const newest = Number((firstItem.querySelector("h3") && firstItem.dataset.id) || 0);
        if (newest > 0) {
          localStorage.setItem(this.storageKeySeen, String(newest));
        }
        this.badge.hidden = true;
      }

      escapeHtml(value) {
        return String(value)
          .replace(/&/g, "&amp;")
          .replace(/</g, "&lt;")
          .replace(/>/g, "&gt;")
          .replace(/"/g, "&quot;")
          .replace(/'/g, "&#039;");
      }
    }

    const newsletterPanel = new NewsletterPanel({
      endpoint: "{{ route('newsletter.latest') }}",
      panelId: "newsletter-panel",
      toggleId: "newsletter-toggle",
      closeId: "newsletter-close",
      contentId: "newsletter-content",
      badgeId: "newsletter-toggle-badge"
    });
    newsletterPanel.init();
  </script>
</body>
</html>
