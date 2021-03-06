<?php
declare(strict_types=1);
namespace SONFin;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use SONFin\Plugins\PluginInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\Response\SapiEmitter;

class Application
{
    private $serviceContainer;

    /**
     * Application constructor.
     */
    public function __construct(ServiceContainerInterface $serviceContainer)
    {
        $this->serviceContainer = $serviceContainer;
    }

    public function service($name)
    {
        return $this->serviceContainer->get($name);
    }

    public function addService(string  $name, $service) : void
    {
        if (is_callable($service)) {
            $this->serviceContainer->addLazy($name, $service);
        } else {
            $this->serviceContainer->add($name, $service);
        }
    }

    public function plugin(PluginInterface $plugin) : void
    {
        $plugin->register($this->serviceContainer);
    }

    public function get($path, $action, $name = null) : Application
    {
        $routing = $this->service('routing');
        $routing->get($name, $path, $action);
        return $this;
    }

    public function post($path, $action, $name = null) : Application
    {
        $routing = $this->service('routing');
        $routing->post($name, $path, $action);
        return $this;
    }

    public function redirect($path)
    {
        return new RedirectResponse($path);
    }

    public function route(string $name, array $params = [])
    {
        $generator = $this->service('routing.generator');
        $path = $generator->generate($name, $params);
        return $this->redirect($path);

    }

    public function start()
    {
        $router = $this->service('route');

        /** @var ServerRequestInterface $request */
        $request = $this->service(RequestInterface::class);

        if (!$router) {
            echo "Page no found";
            exit;
        }

        foreach ($router->attributes as $key => $value) {
            $request = $request->withAttribute($key, $value);
        }

        $callable = $router->handler;
        $response = $callable($request);
        $this->emitResponse($response);
    }

    protected function emitResponse(ResponseInterface $response)
    {
        $emitter = new SapiEmitter();
        $emitter->emit($response);
    }
}