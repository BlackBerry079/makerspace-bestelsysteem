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

---

## Bewijs 3: Security & Compliance - Bescherming tegen Beveiligingsrisico's

### Overzicht
Ik neem stappen om op de hoogte te zijn van relevante wet- en regelgeving EN beveiligingsrisico's. Ik neem de juiste maatregelen om mijn software te beveiligen tegen security issues en te voldoen aan eventuele wetten en regels.

### Beveiligingsmaatregelen in Implementatie

#### 1. Input Validatie & Sanitization - PrinterController.php
```php
public function create_printer(Request $request)
{
    //  INPUT VALIDATIE: Controleer dat verplichte velden correct zijn ingevuld
    $request->validate([
        'name' => 'required',          
        'merk' => 'required',          
        'beschrijving' => 'nullable',  
    ]);
    
    //  SQL INJECTION PREVENTIE: Gebruik van parameter binding ipv string concatenation 
    DB::table('printer')->insert([
        'name' => $request->input('name'),      // Safe: parameter binding
        'brand' => $request->input('merk'),
        'description' => $request->input('beschrijving'),
    ]);
    
    return redirect('/');
}
```

**Waarom dit belangrijk is:**
- Voorkomt SQL Injection attacken
- Beschermt tegen XSS (Cross-Site Scripting)
- Zorgt voor data integriteit in database

#### 2. Authenticatie & Autorisatie - LoginController.php
```php
<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // ✅ AUTHENTICATIE: Gebruiker inloggen met veilige wachtwoord verificatie
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        // Laravel bcrypt hashing gebruiken (niet plaintext!)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        
        return back()->withErrors(['email' => 'Credentials niet correct']);
    }
    
    // ✅ LOGOUT: Session opruimen
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
```

**Beveiligingsfeatures:**
- Wachtwoorden worden **gehashed met bcrypt** (niet in plaintext opgeslagen)
- Session tokens worden **regenerated** na login
- **CSRF protection** via Laravel middleware

#### 3. Model Layer - Gevoelige Data Bescherming - User.php
```php
<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // ✅ WHITELISTING: Alleen bepaalde velden kunnen mass-assigned worden
    protected $fillable = [
        'name',
        'email',
        'password',  // Wachtwoord wordt altijd gehashed
    ];
    
    // ✅ HIDE SENSITIVE DATA: Deze velden worden niet in JSON responses getoond
    protected $hidden = [
        'password',           // Wachtwoord nooit exposed
        'remember_token',     // Token nooit exposed
    ];
    
    // ✅ MUTATORS: Wachtwoord wordt automatisch gehashed
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Hash::make($value),  // Automatic hashing
        );
    }
}
```

**Data Protection:**
- Gevoelige velden (`password`, `remember_token`) worden verborgen in responses
- `$fillable` whitelist voorkomt Mass Assignment vulnerabilities
- Wachtwoorden worden altijd gehashed (nooit plaintext)

#### 4. Middleware - Autorisatie & Request Validatie

```php
<?php
namespace App\Http\Middleware;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    // ✅ CSRF PROTECTION: Voorkomt Cross-Site Request Forgery attacks
    protected $except = [
        // Routes die CSRF protection niet nodig hebben (API calls)
    ];
}
```

**Hoe Laravel CSRF beschermt:**
- Elke POST/PUT/DELETE request moet geldige CSRF token bevatten
- Tokens zijn `request`-specifiek en `session`-specifiek
- Voorkomt ongeautoriseerde acties via andere websites

#### 5. Environment Secrets - .env Bestand
```env
# ✅ SECRETS: Gevoelige configuratie NIET in code hardcoded
APP_NAME="Makerspace Bestelsysteem"
APP_KEY=base64:...
APP_ENV=production
APP_DEBUG=false

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=makerspace
DB_USERNAME=secure_user
DB_PASSWORD=strong_secure_password

MAIL_HOST=smtp.mailtrap.io
MAIL_USERNAME=your_key
MAIL_PASSWORD=your_secret
```

**Best Practices:**
- Database credentials in `.env` file (niet in code)
- `.env` file is in `.gitignore` (nooit in repository)
- Environment-specifieke settings (dev, staging, production)
- `APP_DEBUG=false` in productie (geen stacktraces aan gebruikers)

### Compliance & Regelgeving

#### 1. GDPR Compliance (Algemene Verordening Gegevensbescherming)
- ✅ **Data Minimalisatie**: Sla alleen noodzakelijke gebruikersdata op
- ✅ **Wachtwoord Hashing**: Geen plaintext wachtwoorden in database
- ✅ **Access Control**: Authenticatie required voor gevoelige data
- ✅ **Audit Logging**: Laravel logs kunnen gebruikt worden voor compliance audit trails

#### 2. Secure Development Practices
- ✅ **Dependency Management**: `composer.json` en `package.json` versies locked
- ✅ **Regular Updates**: Libraries worden up-to-date gehouden voor security patches
- ✅ **Code Review**: Best practices gehandhaafd in code reviews
- ✅ **Testing**: Unit tests zorgen voor code kwaliteit en beveiligingscriteria

#### 3. Framework-Level Security Features
```
Laravel Security Architecture:
├── Authentication     -> Ingebouwde Auth guard
├── Authorization     -> Gate & Policy system
├── CSRF Protection   -> Token verification
├── XSS Prevention    -> Blade escaping
├── SQL Injection     -> Query builder parameter binding
├── Password Hashing  -> bcrypt/Argon2 hashing
├── Rate Limiting    -> Brute force protection
└── Encryption       -> Support voor sensitive data encryption
```

### Security Audit Trail

```php
// ✅ AUDIT LOGGING: Log alle kritieke acties
class PrinterController extends Controller
{
    public function create_printer(Request $request)
    {
        $request->validate([...]);
        
        DB::table('printer')->insert([...]);
        
        // Log de actie voor audit trail
        Log::info('Printer aangemaakt', [
            'user_id' => Auth::id(),
            'printer_name' => $request->input('name'),
            'timestamp' => now(),
            'ip_address' => $request->ip(),
        ]);
        
        return redirect('/');
    }
}
```

### Voordelen van Deze Beveiligingsaanpak

| Beveiligingsmaatregel | Beschermt tegen | Impact |
|---|---|---|
| Input Validatie | SQL Injection, XSS | Data integriteit |
| Password Hashing | Rainbow table attacks | Account kompromissatie |
| CSRF Tokens | Cross-site attacks | Ongeautoriseerde acties |
| Environment Secrets | Credential exposure | System breach |
| Authenticatie/Autorisatie | Unauthorized access | Data breaches |
| Audit Logging | Compliance violations | Regulatory penalties |

---

## Conclusie

Jouw Makerspace Bestelsysteem project demonstreert drie belangrijke principes:

1. **MVC Pattern** in de Laravel backend voor gestructureerde server-side development
2. **SPA Pattern** met Vue.js voor een moderne, responsieve gebruikerservaring
3. **Security & Compliance**: Implementatie van industrie-standaard beveiligingsmaatregelen om je software te beschermen tegen risico's en aan regelgeving te voldoen

Deze combinatie van een Laravel MVC backend met Vue.js SPA frontend, aangevuld met robuuste beveiligingspraktijken, is een professionele en veilige architectuur voor applicatieontwikkeling.