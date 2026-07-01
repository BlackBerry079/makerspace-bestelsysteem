@php
    $activeNav = $activeNav ?? 'home';
@endphp

<header class="site-header">
    <div class="site-header__inner">
        <a class="site-brand" href="{{ route('home') }}">
            <span>3D Printer Bestelsysteem</span>
        </a>

        <div class="site-header__actions">
            <nav class="site-nav" aria-label="Hoofdnavigatie">
                <a class="site-nav__link {{ $activeNav === 'home' ? 'is-active' : '' }}" href="{{ route('home') }}">Home</a>
                <a class="site-nav__link {{ $activeNav === 'new-order' ? 'is-active' : '' }}" href="{{ route('orders.index') }}#nieuwe-bestelling">Nieuwe Bestelling</a>
                <a class="site-nav__link {{ $activeNav === 'orders' ? 'is-active' : '' }}" href="{{ route('orders.index') }}#bestellingen">Bestellingen</a>
                <a class="site-nav__link {{ $activeNav === 'contact' ? 'is-active' : '' }}" href="{{ route('home') }}#contact">Contact</a>
            </nav>

            @if (session()->has('auth_user'))
                <div class="site-auth">
                    <span class="site-auth__status">Ingelogd als: {{ session('auth_user.name') }}</span>
                    <form method="POST" action="{{ route('auth.logout') }}">
                        @csrf
                        <button class="site-auth__button" type="submit">Uitloggen</button>
                    </form>
                </div>
            @else
                <a class="site-auth__button" href="{{ route('auth.login') }}">Inloggen</a>
            @endif
        </div>
    </div>
</header>
