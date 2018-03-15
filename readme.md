# Mercado Pago SDK for Laravel

* [Instalar](#install)
* [Configurando](#config)
* [Como usar](#how-to)
* [Mas información](#info)

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

También crear un `alias` con el siguiente código:

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

También debe configurar añadiendo las claves `MP_APP_ID` ​​y` MP_APP_SECRET` en su archivo `.env` (recomendado).

<a name="how-to"></a>
### Como usar

En este ejemplo, vamos a crear una preferencia de pago y luego redirigir al usuario para realizar el pago en el Mercado Pago.

```php
<?php

namespace App\Http\Controllers;

use MP;
use MercadoPagoException;
use Illuminate\Http\Request;
use Teatrix\Http\Controllers\Controller;
use Dingo\Api\Http\Response;

class MercadoPagoController extends Controller {


    /**
     *
     * Method to create a customer on mercadopago
     * @param  Request
     * @return object
     */
    public function createCustomer(Request $request) {

       	try {

            $data = $request;

            $customer_data = [
              'email'       => $data->email, #jhondoe@gmail.com
              'first_name'  => $data->first_name # Jhon Doe
            ];

       	    $customer = MP::post("/v1/customers", $customer_data);

            return $customer;

       	} catch(MercadoPagoException $e) {

       	    return $e->getMessage();

       	} catch (\Exception $e){

       	    print_r(json_decode($e->getMessage()));


       	    return response()->json($e->getMessage());
       	}

    }
}
```

<a name="info"></a>
### Mas información

Para más información visite el sitio web [Mercado Pago para desarrolladrores](https://developers.mercadopago.com/) y tambien el [repositório SDK oficial](https://github.com/mercadopago/sdk-php)
