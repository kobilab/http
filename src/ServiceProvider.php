<?php

	namespace KobiLab\Http;

	class ServiceProvider extends \Illuminate\Support\ServiceProvider
	{

		public function register() {
		}

		public function boot() {
			$this->loadHttp();
			$this->loadView();

			$this->app->router->middleware('auth', 'KobiLab\Http\Middleware\LoggedIn');
			$this->app->router->middleware('unauth', 'KobiLab\Http\Middleware\NotLoggedIn');
		}

		public function loadHttp()
		{
			$this->app->router->group(['namespace' => 'KobiLab\Http\Controllers', 'middleware' => 'web'], function() {
				require __DIR__.'/../config/routes.php';
			});
		}

		public function loadView()
		{
		\Blade::setRawTags('{{', '}}');
		\Blade::setContentTags('{{', '}}');
		\Blade::setEscapedContentTags('{{{', '}}}');

		\Blade::extend(function($value)
		{
			return preg_replace('/(?<!\w)(\s*)@set\s*\(\s*\${0,1}[\'\"\s]*(.*?)[\'\"\s]*,\s*([\W\w^]*?)\)\s*$/m', 
<<<'EOT'
$1<?php \$$2 = $3; $__data['$2'] = $3; ?>
EOT
, $value);
		});
			if(file_exists(__DIR__.'/Themes/'.config('zahmetsizce.general.theme').'/config.php')) {
				$compose  = require __DIR__.'/Themes/'.config('zahmetsizce.general.theme').'/config.php';
				view()->composers($compose);
			}
			
			$this->loadViewsFrom(__DIR__.'/Themes/'.config('zahmetsizce.general.theme').'/resources', 'zahmetsizce');

			if(file_exists(__DIR__.'/Themes/'.config('zahmetsizce.general.theme').'/helpers.php'))
				require __DIR__.'/Themes/'.config('zahmetsizce.general.theme').'/helpers.php';

			if(file_exists(__DIR__.'/helpers.php'))
				require __DIR__.'/helpers.php';
		}

    protected function registerMiddleware($middleware)
    {
        $kernel = $this->app['Illuminate\Contracts\Http\Kernel'];
        $kernel->pushMiddleware($middleware);
    }

	}