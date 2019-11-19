<?php

namespace Framework;

use App\Components\LoginAdapter;
use Aura\Auth\Adapter\PdoAdapter;
use Aura\Auth\Auth;
use Aura\Auth\AuthFactory;
use Aura\Auth\Service\LoginService;
use Aura\Auth\Service\LogoutService;
use Aura\Auth\Service\ResumeService;
use Aura\Auth\Verifier\PasswordVerifier;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

/**
 * Class Framework
 * @package Framework
 */
class Framework extends HttpKernel
{
    /**
     * @var ContainerBuilder
     */
    public static $container;

    /**
     * @var self
     */
    public static $app;

    /**
     * @var RouteCollection
     */
    public static $routes;

    /**
     * @var RequestStack
     */
    public static $request;

    public static $response;

    /**
     * @var EntityManager
     */
    public static $db;

    /**
     * @var UrlGenerator
     */
    public static $urlGenerator;

    /**
     * @var RequestContext
     */
    public static $requestContext;

    /**
     * @var Auth
     */
    public static $auth;

    /**
     * @var AuthFactory
     */
    public static $authFactory;

    /**
     * @var PdoAdapter
     */
    public static $authAdapter;

    /**
     * @var LoginService
     */
    public static $authLoginService;

    /**
     * @var LogoutService
     */
    public static $authLogoutService;

    /**
     * @var ResumeService
     */
    private static $authResumeService;

    /**
     * @param $request
     * @param $routes
     * @param $container
     * @throws \Exception
     */
    public static function create($request, $routes, $container)
    {
        Framework::$container = $container;
        Framework::$routes = $routes;
        Framework::$request = $request;
        Framework::$db = Framework::$container->get('db');
        Framework::$app = Framework::$container->get('framework');
        Framework::$requestContext = new RequestContext();
        Framework::$requestContext->fromRequest(Framework::$request);
        Framework::$urlGenerator = new UrlGenerator($routes, Framework::$requestContext);
        Framework::$authFactory = new \Aura\Auth\AuthFactory($_COOKIE);
        Framework::$auth = Framework::$authFactory->newInstance();
        Framework::$authAdapter = new LoginAdapter();
        Framework::$authLoginService = Framework::$authFactory->newLoginService(Framework::$authAdapter);
        Framework::$authLogoutService = Framework::$authFactory->newLogoutService(Framework::$authAdapter);
        Framework::$authResumeService = Framework::$authFactory->newResumeService(Framework::$authAdapter);
        Framework::$authResumeService->resume(Framework::$auth);
        Framework::$response = Framework::$app->handle($request);
        Framework::$response->send();
        Framework::$app->terminate($request, Framework::$response);
    }
}