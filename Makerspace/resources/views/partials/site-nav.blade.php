@php
    $activeNav = $activeNav ?? 'home';
@endphp

<header class="site-header">
    <div class="site-header__inner">
        <a class="site-brand" href="{{ route('home') }}">
            <span class="site-brand__mark">3D</span>
            <span>3D Printer Bestelsysteem</span>
        </a>

        <nav class="site-nav" aria-label="Hoofdnavigatie">
            <a class="site-nav__link {{ $activeNav === 'home' ? 'is-active' : '' }}" href="{{ route('home') }}">Home</a>
            <a class="site-nav__link {{ $activeNav === 'new-order' ? 'is-active' : '' }}" href="{{ route('orders.index') }}#nieuwe-bestelling">Nieuwe Bestelling</a>
            <a class="site-nav__link {{ $activeNav === 'orders' ? 'is-active' : '' }}" href="{{ route('orders.index') }}#bestellingen">Bestellingen</a>
            <a class="site-nav__link {{ $activeNav === 'contact' ? 'is-active' : '' }}" href="{{ route('home') }}#contact">Contact</a>
        </nav>
    </div>
</header>
