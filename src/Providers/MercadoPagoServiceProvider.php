<?php namespace olvisdevalencia\MercadoPago\Providers;

use Illuminate\Support\ServiceProvider;
use olvisdevalencia\MercadoPago\MP;

class MercadoPagoServiceProvider extends ServiceProvider
{

	protected $mp_app_id;
    protected $mp_app_secret;
    protected $mp_app_access_token;

    public function boot()
    {

        $this->publishes([__DIR__.'/../resources/config/mercadopago.php' => config_path('mercadopago.php')]);

        $this->mp_app_access_token= config('mercadopago.access_token');
    }

	public function register()
	{
		$this->app->singleton('MP', function(){
		    return new MP($this->mp_app_access_token);
		});
	}
}
