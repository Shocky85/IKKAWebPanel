<?php

//declaration of all services used in the developpement

//can help for debug
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
ErrorHandler::register();
ExceptionHandler::register();

//Templating service
//
//point to view's folder
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());
$app['twig'] = $app->share($app->extend('twig', function(Twig_Environment $twig, $app) {
            $twig->addExtension(new Twig_Extensions_Extension_Text());
            return $twig;
        }));

//used to edit seesions variables
$app->register(new Silex\Provider\SessionServiceProvider());

//declaraction of all DAO classes
//
//UserDAO
$app['dao.user'] = $app->share(function ($app) {
    return new IKKA\DAO\UserDAO();
});
//AccountDAO
$app['dao.account'] = $app->share(function ($app) {
    return new IKKA\DAO\AccountDAO();
});
//TransactionDAO
$app['dao.transaction'] = $app->share(function ($app) {
    return new IKKA\DAO\TransactionDAO();
});
//RoleDAO
$app['dao.role'] = $app->share(function ($app) {
    return new IKKA\DAO\RoleDAO();
});
//BadgeDAO
$app['dao.badge'] = $app->share(function ($app) {
    return new IKKA\DAO\BadgeDAO();
});
//ConnectionDAO
$app['dao.connection'] = $app->share(function ($app) {
    return new IKKA\DAO\ConnectionDAO();
});
