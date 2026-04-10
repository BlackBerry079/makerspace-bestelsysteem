# Software Architectuur Bewijzen - Makerspace Bestelsysteem

## Bewijs 1: MVC (Model-View-Controller) Pattern in Laravel

### Architectuur Overzicht
Jouw project maakt gebruik of the **Laravel framework**, which implements the **MVC (Model-View-Controller)** architectural pattern. This is evident from the project structure:

```
Makerspace/
├── app/
│   ├── Http/
│   │   ├── Controllers/    # CONTROLLER layer
│   │   │   ├── Controller.php
│   │   │   ├── PrinterController.php
│   │   │   ├── DashboardController.php
│   │   │   └── LoginController.php
│   │   └── Middleware/
│   ├── Models/             # MODEL layer
│   │   └── User.php
│   └── Providers/
├── resources/
│   └── views/              # VIEW layer
│       ├── Dashboard.blade.php
│       ├── printer.blade.php
│       ├── login.blade.php
│       └── home.blade.php
└── routes/
    └── web.php             # Route definitions
```

### Concrete Voorbeelden

#### 1. Controller Layer - PrinterController.php
```php
<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PrinterController extends Controller
{
    // Model: Haalt data op uit database
    public function show()
    {
        $printer = DB::table('printer')->get();
        
        // View: Stuurt data naar view
        return view('printer',[
            'printer' => $printer
        ]);
    }
    
    // Controller: Verwerkt request en update model
    public function create_printer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'merk' => 'required',
            'beschrijving' => 'nullable',
        ]);
        
        // Model: Insert into database
        DB::table('printer')->insert([
            'name' => $request->input('name'),
            'brand' => $request->input('merk'),
            'description' => $request->input('beschrijving'),
        ]);
        
        return redirect('/');
    }
}
```

#### 2. Model Layer - User.php
```php
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    // Model properties en methods
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
```

#### 3. View Layer - Dashboard.blade.php
```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><h1><a href="/">Dashboard</a></h1></li>
                <li><h1><a href="/printer">printers</a></h1></li>
                <li><h1><a href="/orders">Orders</a></h1></li>
            </ul>
        </nav>
    </header>
    
    <div class="status">
        <p>printers</p>
        <p>voorraad</p>
        <p>Orders</p>
    </div>
</body>
</html>
```

#### 4. Route Definition - web.php
```php
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrinterController;

// Routes koppelen URL's aan controllers
Route::get('/printer', [PrinterController::class, 'show'])->name('printer');
Route::post('/create_printer', [PrinterController::class, 'create_printer'])->name('printer.create');
```

### MVC Flow in Jouw Project:
1. **Route** ontvangt HTTP request
2. **Controller** verwerkt request, communiceert met **Model**
3. **Model** haalt data op/updated database
4. **Controller** stuurt data naar **View**
5. **View** toont data aan gebruiker

---

## Bewijs 2: SPA (Single Page Application) met Vue.js

### Architectuur Overzicht
Jouw project bevat een **Vue.js SPA** in de `Dev/client` directory, wat een moderne frontend architectuur is.

### Project Structuur
```
Dev/
├── client/                 # Vue.js SPA frontend
│   ├── src/
│   │   ├── App.vue         # Root component
│   │   ├── main.js         # Application entry point
│   │   ├── components/     # Vue components
│   │   │   └── HelloWorld.vue
│   │   └── assets/         # Static assets
│   ├── index.html          # SPA entry HTML
│   ├── package.json        # Dependencies
│   └── vite.config.js      # Build configuration
│
└── api/                    # Laravel API backend
    ├── app/
    ├── routes/
    └── ...
```

### Concrete Voorbeelden

#### 1. SPA Entry Point - index.html
```html
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Makerspace Bestelsysteem</title>
  </head>
  <body>
    <!-- Single div waar de hele Vue app in mounted -->
    <div id="app"></div>
    <script type="module" src="/src/main.js"></script>
  </body>
</html>
```

#### 2. Vue Application Bootstrap - main.js
```javascript
import { createApp } from 'vue'
import './style.css'
import App from './App.vue'

// Creëer Vue applicatie en mount op #app div
createApp(App).mount('#app')
```

#### 3. Root Component - App.vue
```vue
<script setup>
import HelloWorld from './components/HelloWorld.vue'
</script>

<template>
  <HelloWorld />
</template>
```

#### 4. Package Dependencies - package.json
```json
{
  "name": "client",
  "version": "0.0.0",
  "type": "module",
  "scripts": {
    "dev": "vite",
    "build": "vite build",
    "preview": "vite preview"
  },
  "dependencies": {
    "vue": "^3.5.30"
  },
  "devDependencies": {
    "@vitejs/plugin-vue": "^6.0.5",
    "vite": "^8.0.0"
  }
}
```

### SPA Kenmerken in Jouw Project:
1. **Single HTML Entry Point**: Alleen `index.html` met een `<div id="app">`
2. **JavaScript-driven**: `main.js` bootstrapt de Vue applicatie
3. **Component-based**: Gebruik van `.vue` single-file components
4. **Client-side Routing**: Vue regelt navigatie (in plaats van server)
5. **API Communicatie**: Communicatie met Laravel backend via API
6. **Build Tool**: Vite voor development en production builds

### Voordelen van Deze Architectuur:
- **Snellere用户体验**: Geen volledige pagina herladingen
- **Separation of Concerns**: Frontend (Vue) en Backend (Laravel) gescheiden
- **Scalability**: Makkelijk uit te breiden met nieuwe componenten
- **Modern Development**: Gebruik van moderne tools (Vite, Vue 3)

---

## Conclusie

Jouw Makerspace Bestelsysteem project demonstreert twee belangrijke software architectuur patronen:

1. **MVC Pattern** in de Laravel backend voor gestructureerde server-side development
2. **SPA Pattern** met Vue.js voor een moderne, responsieve gebruikerservaring

Deze combinatie van een Laravel MVC backend met a Vue.js SPA frontend is een veelgebruikte en professionele architectuur in modern web development.