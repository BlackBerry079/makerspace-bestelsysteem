@php
    $loginRedirect = $loginRedirect ?? route('orders.index') . '#nieuwe-bestelling';
    $message = $message ?? session('auth_required', 'Je moet eerst inloggen om een bestelling te plaatsen.');
@endphp

<div class="notice notice--warning auth-required">
    <p class="auth-required__message">{{ $message }}</p>
    <a class="button-primary auth-required__button" href="{{ route('auth.login', ['redirect' => $loginRedirect]) }}">Inloggen</a>
</div>
