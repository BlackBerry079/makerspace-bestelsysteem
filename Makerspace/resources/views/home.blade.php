<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Printer Bestelsysteem</title>
    @vite(['resources/css/site.css'])
</head>
<body>
    <div class="site-shell">
        @include('partials.site-nav', ['activeNav' => 'home'])

        <main class="site-main">
            <div class="site-container">
                <section class="hero" aria-labelledby="hero-title">
                    <article class="hero__content">
                        <div class="eyebrow">Professionele 3D print service</div>
                        <h1 class="hero__title" id="hero-title">3D Printer Bestelsysteem</h1>
                        <p class="hero__text">
                            Plaats eenvoudig jouw 3D print bestelling en beheer filament, kleuren en ontwerpen.
                        </p>
                        <div class="hero__actions">
                            <a class="button-primary" href="{{ route('orders.index') }}#nieuwe-bestelling">Nieuwe Bestelling</a>
                            <a class="button-secondary" href="{{ route('orders.index') }}#bestellingen">Bekijk Bestellingen</a>
                        </div>
                    </article>

                    <aside class="hero__panel" aria-label="Snelle service informatie">
                        <div class="stat-block">
                            <span class="stat-block__label">Beschikbaar proces</span>
                            <span class="stat-block__value">Van upload tot printaanvraag</span>
                        </div>
                        <div class="stat-block">
                            <span class="stat-block__label">Ondersteunde materialen</span>
                            <span class="stat-block__value">PLA, ABS en PETG</span>
                        </div>
                        <div class="stat-block">
                            <span class="stat-block__label">Beheer</span>
                            <span class="stat-block__value">Overzichtelijk en centraal</span>
                        </div>
                    </aside>
                </section>

                <section class="section" aria-labelledby="voordelen-title">
                    <header class="section__header">
                        <h2 class="section__title" id="voordelen-title">Waarom dit bestelsysteem werkt</h2>
                        <p class="section__text">Een duidelijke homepage die bezoekers direct naar de juiste actie leidt.</p>
                    </header>

                    <div class="info-grid">
                        <article class="info-card">
                            <div class="info-card__icon">01</div>
                            <h3 class="card-title">Snelle bestellingen</h3>
                            <p class="card-text">Nieuwe aanvragen kunnen in een paar stappen worden geplaatst, zonder onnodige velden of afleiding.</p>
                        </article>

                        <article class="info-card">
                            <div class="info-card__icon">02</div>
                            <h3 class="card-title">Meerdere filament opties</h3>
                            <p class="card-text">Kies eenvoudig tussen filamenttypes en kleuren zodat elke printaanvraag meteen compleet is.</p>
                        </article>

                        <article class="info-card">
                            <div class="info-card__icon">03</div>
                            <h3 class="card-title">Overzichtelijk beheer</h3>
                            <p class="card-text">Bestellingen, materiaalkeuzes en bestanden blijven netjes gegroepeerd in een rustige interface.</p>
                        </article>
                    </div>
                </section>

                <section class="section" aria-labelledby="preview-title">
                    <header class="section__header">
                        <h2 class="section__title" id="preview-title">Recente bestellingen</h2>
                        <p class="section__text">Een kleine preview maakt de homepage levendig en laat meteen zien waarvoor het systeem bedoeld is.</p>
                    </header>

                    <div class="preview-grid">
                        @forelse ($previewOrders as $order)
                            <article class="preview-card">
                                <div class="preview-card__meta">
                                    <span class="status-pill">Actief</span>
                                    <span>{{ optional($order->created_at)->format('d-m-Y') }}</span>
                                </div>
                                <h3 class="card-title">{{ $order->title }}</h3>
                                <p class="card-text">{{ $order->description ?: 'Deze bestelling bevat een nieuw 3D print verzoek zonder extra toelichting.' }}</p>
                            </article>
                        @empty
                            <article class="preview-card">
                                <div class="preview-card__meta">
                                    <span class="status-pill">Voorbeeld</span>
                                    <span>Vandaag</span>
                                </div>
                                <h3 class="card-title">Prototype behuizing</h3>
                                <p class="card-text">Compacte printopdracht met focus op nette afwerking en snelle verwerking.</p>
                            </article>

                            <article class="preview-card">
                                <div class="preview-card__meta">
                                    <span class="status-pill">Voorbeeld</span>
                                    <span>Vandaag</span>
                                </div>
                                <h3 class="card-title">Filament testmodel</h3>
                                <p class="card-text">Testprint met meerdere kleurkeuzes om materiaal en kwaliteit te vergelijken.</p>
                            </article>

                            <article class="preview-card">
                                <div class="preview-card__meta">
                                    <span class="status-pill">Voorbeeld</span>
                                    <span>Vandaag</span>
                                </div>
                                <h3 class="card-title">Maatwerk onderdeel</h3>
                                <p class="card-text">Functioneel onderdeel voor een snelle interne aanvraag binnen de makerspace.</p>
                            </article>
                        @endforelse
                    </div>
                </section>

                <section class="section" id="contact" aria-labelledby="contact-title">
                    <div class="section-card contact-card">
                        <div>
                            <h2 class="section__title" id="contact-title">Contact</h2>
                            <p class="section__text">Heb je vragen over je print, materiaalkeuze of bestand? Neem contact op met het makerspace team.</p>
                        </div>

                        <div class="contact-list">
                            <article class="contact-item">
                                <strong>E-mail</strong>
                                <span>makerspace@school.nl</span>
                            </article>
                            <article class="contact-item">
                                <strong>Ondersteuning</strong>
                                <span>Maandag t/m vrijdag, 09:00 - 17:00</span>
                            </article>
                        </div>
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
