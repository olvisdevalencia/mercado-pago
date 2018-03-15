# Mercado Pago SDK for Laravel

* [Instalar](#install)
* [Configurando](#config)
* [Como usar](#how-to)
* [Mais informações](#info)

<a name="install"></a>
### Instalar

`composer require olvisdevalencia/mercado-pago`

En su archivo `config/app.php` agregue el siguiente código:

```php
'providers' => [

    /*
     * Laravel Framework Service Providers...
     */

    'olvisdevalencia\MercadoPago\Providers\MercadoPagoServiceProvider',
],
```

También puede crear un `alias` con el siguiente código:

```php
'aliases' => [
	// otros alias

    'MP' => 'olvisdevalencia\MercadoPago\Facades\MP',
]
```

<a name="config"></a>
### Configurando

Antes de empezar a usar vamos a publicar el archivo de configuración. En la carpeta de su proyecto Laravel, ejecute el siguiente comando artisan:

`php artisan vendor:publish`

El comando anterior generará un archivo `config / mercadopago.php`. En este archivo debe agregar su App Id y App Secret. Para saber cuál es su acceso a [sitio de Mercado Pago](https://www.mercadopago.com/mla/herramientas/aplicaciones)

```php
return [
	'app_id'     => env('MP_APP_ID', 'SEU CLIENT ID'),
	'app_secret' => env('MP_APP_SECRET', 'SEU CLIENT SECRET')
];
```

También puede configurar añadiendo las claves `MP_APP_ID` ​​y` MP_APP_SECRET` en su archivo `.env` (recomendado).

<a name="how-to"></a>
### Como usar

En este ejemplo, vamos a crear una preferencia de pago y luego redirigir al usuario para realizar el pago en el Mercado Pago.

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Exception;
use MP;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $preference_data = array (
            "items" => array (
                array (
                    "title" => "Test2",
                    "quantity" => 1,
                    "currency_id" => "BRL",
                    "unit_price" => 10.41
                )
            )
        );

        try {
            $preference = MP::create_preference($preference_data);
            return redirect()->to($preference['response']['init_point']);
        } catch (Exception $e){
            dd($e->getMessage());
        }
    }
}
```

<a name="info"></a>
### Mas información

Para más información visite el sitio web [Mercado Pago para desarrolladrores](https://developers.mercadopago.com/) y tambien el [repositório SDK oficial](https://github.com/mercadopago/sdk-php)
