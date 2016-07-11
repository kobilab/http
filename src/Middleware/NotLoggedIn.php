<?php 
namespace KobiLab\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use KobiLab\Auth;
use Barryvdh\Debugbar\LaravelDebugbar;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Debug\ExceptionHandler;

class NotLoggedIn
{
    /**
     * The App container
     *
     * @var Container
     */
    protected $container;

    /**
     * The DebugBar instance
     *
     * @var LaravelDebugbar
     */
    protected $debugbar;

    /**
     * Create a new middleware instance.
     *
     * @param  Container $container
     * @param  LaravelDebugbar $debugbar
     */


    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::isLoggedIn()===true) {
            return redirectTo('homePage');
        }

        return $next($request);

    }

    /**
     * Handle the given exception.
     *
     * (Copy from Illuminate\Routing\Pipeline by Taylor Otwell)
     *
     * @param $passable
     * @param  Exception $e
     * @return mixed
     * @throws Exception
     */
    protected function handleException($passable, Exception $e)
    {
        if (! $this->container->bound(ExceptionHandler::class) || ! $passable instanceof Request) {
            throw $e;
        }

        $handler = $this->container->make(ExceptionHandler::class);

        $handler->report($e);

        return $handler->render($passable, $e);
    }
}
