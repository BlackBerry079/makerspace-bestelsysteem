
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>Admin Dashboard demo</title>
        @vite(['resources/css/', 'resources/js/app.js'])
    <body>

<style>

@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');

body{
    margin:0;
    font-family:'Inter', sans-serif;
    background:#f1f5f9;
    overflow:hidden;
    color:#1f2937;
}

/* HEADER */

header{
    height:60px;
    background:#01313e;
    color:white;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 40px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

.nav{
    display:flex;
    gap:35px;
}

.nav a{
    color:#d1d5db;
    text-decoration:none;
    font-weight:500;
    transition:0.2s;
}

.nav a:hover{
    color:white;
}

.logout{
    background:#ef4444;
    border:none;
    color:white;
    padding:8px 18px;
    border-radius:8px;
    cursor:pointer;
    font-weight:500;
    transition:0.2s;
}

.logout:hover{
    background:#dc2626;
}

/* NIEUWSBRIEF PANEL */

.nieuwsbrief{
    position:fixed;
    right:0;
    top:60px;
    width:260px;
    height:calc(100% - 60px);
    background:#ffffff;
    border-left:1px solid #e5e7eb;
    box-shadow:-4px 0 15px rgba(0,0,0,0.05);
    transition:transform 0.3s ease;
    
}

.nieuwsbrief.closed{
    transform:translateX(220px);
}

.nieuws-header{
    display:flex;
    justify-content:space-between;
    padding:18px;
    font-weight:600;
    border-bottom:1px solid #eee;
    color: white;
    background:#34869d;
}

.arrow{
    cursor:pointer;
    font-size:18px;
    transition:0.2s;
}

.arrow:hover{
    transform:scale(1.2);
}

/* MAIN */

.main{
    margin-right:260px;
    padding:30px;
    height:calc(100vh - 60px);
    display:flex;
    flex-direction:column;
    align-items:center;
    transition:0.3s;
}

.main.full{
    margin-right:30px;
}

/* OVERVIEW */

.overview{
    width:900px;
    background:white;
    border-radius:14px;
    padding:30px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
    display:flex;
    justify-content:space-around;
    margin-bottom:25px;
    font-size:20px;
    font-weight:500;
}

.overview div{
    background:#f8fafc;
    padding:18px 24px;
    border-radius:10px;
}

/* ORDERS */

.orders{
    width:900px;
    background:white;
    border-radius:14px;
    padding:25px;
    box-shadow:0 10px 25px rgba(0,0,0,0.05);
    flex-grow:1;
    overflow-y:auto;
}

/* ORDER CARD */

.order{
    background:#f8fafc;
    border-radius:10px;
    padding:18px 20px;
    margin-bottom:12px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    transition:0.2s;
}

.order:hover{
    background:#eef2ff;
    transform:translateY(-1px);
}

/* STATUS */

.status{
    font-weight:600;
    padding:6px 12px;
    border-radius:20px;
    font-size:14px;
}

/* STATUS COLORS */

.status:contains("Done"){
    background:#dcfce7;
    color:#166534;
}

.status:contains("In progress"){
    background:#dbeafe;
    color:#1e40af;
}

.status:contains("Waiting"){
    background:#fef3c7;
    color:#92400e;
}

/* Scrollbar */

.orders::-webkit-scrollbar{
    width:6px;
}

.orders::-webkit-scrollbar-thumb{
    background:#d1d5db;
    border-radius:10px;
}

</style>
</head>

<body>

<header>
    <div class="nav">
        <a href="/">Dashboard</a>
        <a href="/printer">Printers</a>
        <a href="/inventory">Voorraad</a>
        <a href="/users">Gebruiker</a>
    </div>
    
    <button class="logout">Logout</button>
</header>


<!-- NIEUWSBRIEF -->
<div class="nieuwsbrief" id="nieuwsbrief">
    <div class="nieuws-header">
        <span class="arrow" onclick="toggleNieuws()">▶</span>
        Nieuwsbrief
    </div>
</div>


<!-- MAIN --> 
<div class="main" id="main">

    <!-- OVERVIEW -->
    <div class="overview">
        <div>Printer<span id="printers">{{ count($active_printer) }} / {{ count($printer) }}</span></div>        <!--1e count moet nog de gebruikte printers zijn 2e count de maximale die er zijn -->
        <div>Voorraad <span id="voorraad">{{ count($active_voorraad_filaments) }} / {{ count($voorraad) }}</span></div>
        <div>Orders <span id="ordersCount">{{ count($orders) ?? 12 }}</span></div>
    </div>
        
    
    
    <!-- ORDERS LIST -->
    @foreach ($orders as $order)
        <div class="order">
            <div>#{{ $order->id }} - {{ $order->name }}</div>
            <div class="status">{{ $order->status }}</div>
        </div>
    
    @endforeach
    <!-- <div class="orders">
        
        <div class="order">
            <div>#101 - John Doe</div>
            <div class="status">In progress</div>
        </div>
        
        <div class="order">
            <div>#102 - Anna Smith</div>
            <div class="status">Done</div>
        </div>
        
        <div class="order">
            <div>#103 - Mark Jansen</div>
            <div class="status">Waiting for acceptation</div>
        </div>
        
        <div class="order">
            <div>#104 - Lisa Brown</div>
            <div class="status">In progress</div>
        </div>

        <div class="order">
            <div>#105 - David Wilson</div>
            <div class="status">Done</div>
        </div>
        
        <div class="order">
            <div>#106 - Emma Garcia</div>
            <div class="status">Waiting for acceptation</div>
        </div>

        <div class="order">
            <div>#107 - Noah Miller</div>
            <div class="status">In progress</div>
        </div>
    
    </div> -->

</div> 
   
   <!-- DEMO NIEWSBRIEF BASIS
     -->
    <form action="/create_nieuwsbrief" method="POST" enctype="multipart/form-data" class="formulier">
        @csrf
        <label for="name">Naam</label>
        <input type="text" name="name" placeholder="Naam van printer" class="invoer">
        
          <select name="type" class="invoer">
            <option value="announcement">announcement</option>
            <option value="stock">stock</option>
            <option value="error">error</option>
            <option value="info">info</option>
        </select>

        <label for="beschrijving">Beschrijving</label>
        <input type="text" name="beschrijving" placeholder="" class="invoer beschrijving">
        
        <button type="submit" class="knop">Maak Printer aan</button>
    </form>


<script>
function toggleNieuws(){

    const panel = document.getElementById("nieuwsbrief");
    const main = document.getElementById("main");

    panel.classList.toggle("closed");
    main.classList.toggle("full");

}
</script>

</body>
</html>