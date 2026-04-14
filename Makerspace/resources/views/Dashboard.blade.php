<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<header>
    <div class="nav">
        <a href="/">Dashboard</a>
        <a href="/printer">Printers</a>
        <a href="/nieuwsbrief">Nieuwsbrief</a>
        <a href="/orders">Orders</a>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout">Logout</button>
    </form>
</header>

<!-- Main Content -->
<div class="main">
    <!-- OVERVIEW -->
    <div class="overview">
        <div>
            Printers <span>{{ count($active_printer) }} / {{ count($printer) }}</span>
        </div>
        <div>
            Voorraad <span>{{ count($active_voorraad_filaments) }} / {{ count($voorraad) }}</span>
        </div>
        <div>
            Orders <span>{{ count($orders) ?? 12 }}</span>
        </div>
    </div>

    <!-- ORDERS LIST -->
    <!-- <div class="orders">
        @foreach($orders as $order)
        <div class="order">
                <div>#{{ $order->id }} - {{ $order->klant }}</div>
                <div class="status {{ $order->status }}">
                    {{ $order->status }}
                </div>
            </div>
        @endforeach
    </div>
</div> -->

<!-- Sidebar for Creating Nieuwsbrief -->
<div class="sidebar">
    <h1>Create Nieuwsbrief</h1>

    <form action="{{ route('create_nieuwsbrief') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Title" class="invoer" required>
        <input type="text" name="description" placeholder="Description" class="invoer" required>
        <select name="type" class="invoer" required>
            <option value="announcement">Announcement</option>
            <option value="stock">Stock</option>
            <option value="error">Error</option>
            <option value="info">Info</option>
        </select>
        <button type="submit" class="knop">Create Nieuwsbrief</button>
    </form>
</div>

</body>
</html>