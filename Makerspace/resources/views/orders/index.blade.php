<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellingen | 3D Printer Bestelsysteem</title>
    @vite(['resources/css/site.css'])
</head>
<body>
    <div class="site-shell">
        @include('partials.site-nav', ['activeNav' => 'orders'])

        <main class="site-main">
            <div class="site-container">
                <section class="hero" aria-labelledby="orders-hero-title">
                    <article class="hero__content">
                        <div class="eyebrow">Nieuwe aanvraag indienen</div>
                        <h1 class="hero__title" id="orders-hero-title">Beheer jouw 3D print bestellingen</h1>
                        <p class="hero__text">
                            Upload je model, kies filament en houd al je aanvragen overzichtelijk bij binnen dezelfde rustige interface.
                        </p>
                        <div class="hero__actions">
                            <a class="button-primary" href="#nieuwe-bestelling">Start Nieuwe Bestelling</a>
                            <a class="button-secondary" href="#bestellingen">Bekijk Overzicht</a>
                        </div>
                    </article>

                    <aside class="hero__panel" aria-label="Bestelinformatie">
                        <div class="stat-block">
                            <span class="stat-block__value">{{count($orders)}}</span>
                            <span class="stat-block__value">Bestellingen</span>
                        </div>
                        <div class="stat-block">
                            <span class="stat-block__label">Beschikbare filamenttypes</span>
                            <span class="stat-block__value">{{ count($orders) }}  opties</span>
                        </div>
                        <div class="stat-block">
                            <span class="stat-block__label">Bestandstypen</span>
                            <span class="stat-block__value">STL, OBJ, 3MF</span>
                        </div>
                    </aside>
                </section>

                <section class="section" id="nieuwe-bestelling" aria-labelledby="nieuwe-bestelling-title">
                    <div class="form-card">
                        <header class="section__header">
                            <h2 class="section__title" id="nieuwe-bestelling-title">Nieuwe bestelling</h2>
                            <p class="section__text">Vul hieronder de gegevens van je 3D print aanvraag in.</p>
                        </header>

                        @if (session('success'))
                            <div class="notice notice--success">{{ session('success') }}</div>
                        @endif

                        @if (! $isLoggedIn)
                            @include('partials.auth-required-notice')
                        @else
                        <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data" class="form-grid">
                            @csrf

                            <div>
                                <label for="naam">Naam</label>
                                <input class="input" type="text" id="naam" name="naam" value="{{ old('naam') }}" required>
                            </div>

                            <div>
                                <label for="filament-type">Type filament</label>
                                <select class="select" id="filament-type" name="filament_type">
                                    <option value="PLA" @selected(old('filament_type') === 'PLA')>PLA</option>
                                    <option value="ABS" @selected(old('filament_type') === 'ABS')>ABS</option>
                                    <option value="PETG" @selected(old('filament_type') === 'PETG')>PETG</option>
                                </select>
                            </div>

                            <div>
                                <label for="kleur-filament">Kleur filament</label>
                                <input class="input" type="text" id="kleur-filament" name="kleur_filament" value="{{ old('kleur_filament') }}" placeholder="Bijvoorbeeld zwart, wit of blauw">
                            </div>

                            <div>
                                <label for="model-bestand">3D model bestand (.stl, .obj, .3mf)</label>
                                <input class="input" type="file" id="model-bestand" name="model_bestand" accept=".stl,.obj,.3mf" required>
                                @error('model_bestand')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="beschrijving">Beschrijving van de print</label>
                                <textarea class="textarea" maxlength="120" id="beschrijving" name="beschrijving" placeholder="Omschrijf kort het model, de afwerking of speciale wensen">{{ old('beschrijving') }}</textarea>
                            </div>
                            
                            <div>
                                <label for="datum">Deadline</label>
                                <input class="input" type="date" id="datum" name="datum" value="{{ old('datum') }}" required>
                            </div>
                            
                            <div>
                                <button class="button-primary" type="submit">Verstuur bestelling</button>
                            </div>
                        </form>
                        @endif
                    </div>
                </section>

                <section class="section" id="bestellingen" aria-labelledby="bestellingen-title">
                    <header class="section__header">
                        <h2 class="section__title" id="bestellingen-title">Recente bestellingen</h2>
                        <p class="section__text">Een overzicht van de meest recente aanvragen binnen het systeem.</p>
                    </header>

                    <div class="orders-grid">
                        @forelse ($orders as $order)
                            <article class="preview-card">
                                <div class="order-card__meta">
                                    <span>Bestelling</span>
                                    <span>{{ optional($order->created_at)->format('d-m-Y') }}</span>
                                </div>
                                <h3 class="card-title">{{ $order->title }}</h3>
                                <p class="card-text">{{ $order->description ?: 'Geen extra beschrijving toegevoegd bij deze aanvraag.' }}</p>
                                <p class="card-text"><strong>Bestand:</strong> {{ $order->file_path }}</p>
                            </article>
                        @empty
                            <article class="empty-card">
                                <h3 class="card-title">Nog geen bestellingen</h3>
                                <p class="card-text">Zodra er aanvragen worden geplaatst, verschijnen ze hier automatisch in het overzicht.</p>
                            </article>
                        @endforelse
                    </div>
                </section>
            </div>
        </main>

        <footer class="site-footer">
            <div class="site-footer__inner">© 2026 3D Printer Bestelsysteem</div>
        </footer>
    </div>
</body>
</html>
