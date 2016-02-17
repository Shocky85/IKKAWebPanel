<?php

use Symfony\Component\HttpFoundation\Request;

//OK
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
})->bind('home');

//Basic Auth OK
$app->get('/users/', function () use ($app) {
    $users = $app['dao.user']->findAll($app);
    return $app['twig']->render('users.html.twig', array('users' => $users));
})->bind('users');

//Basic Auth OK
$app->get('/users/{uuid}', function ($uuid) use ($app) {
    $user = $app['dao.user']->find($uuid, $app);
    return $app['twig']->render('user.html.twig', array('user' => $user));
})->bind('user');

// OK
$app->get('/accounts/', function () use ($app) {
    $accounts = $app['dao.account']->findAll();
    return $app['twig']->render('accounts.html.twig', array('accounts' => $accounts));
})->bind('accounts');

//Basic Auth OK
$app->get('/accounts/{id}', function ($id) use ($app) {
    $account = $app['dao.account']->find($id, $app);
    $transactions = $app['dao.transaction']->findAll($id, $app);
    return $app['twig']->render('detailsAccount.html.twig', array('account' => $account, 'transactions' => $transactions));
})->bind('myAccount');

//Basic Auth OK
$app->get('/badges/', function () use ($app) {
    $badges = $app['dao.badge']->findAll($app);
    return $app['twig']->render('badges.html.twig', array('badges' => $badges));
})->bind('badges');

//Basic Auth OK
$app->get('/badges/categories/{id}', function ($id) use ($app) {
    $badges = $app['dao.badge']->findAllByCateg($id, $app);
    return $app['twig']->render('badges.html.twig', array('badges' => $badges));
})->bind('badgesByCateg');

//Basic Auth OK
$app->get('/badges/user/{uuid}', function ($uuid) use ($app) {
    $badges = $app['dao.badge']->findAllByUser($uuid, $app);
    return $app['twig']->render('badgesPerUser.html.twig', array('badges' => $badges));
})->bind('badgesByUserAndState');


$app->get('/delete/user/{uuid}', function ($uuid) use ($app) {
    $app['dao.user']->delete($uuid, $app);
    return $app->redirect($app["url_generator"]->generate("users"));
})->bind('deleteUser');

$app->match('/new/user', function (Request $request) use ($app) {
    $userForm = $app['form.factory']->create(new IKKA\Form\Type\UserType());
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        $app['dao.user']->create();
        $app['session']->getFlashBag()->add('success', 'Utilisateur ajouté avec succés.');
    }
    $userFormView = $userForm->createView();
    return $app['twig']->render('userForm.html.twig', array('userForm' => $userFormView)
    );
})->bind('newUser');

$app->match('/new/transaction', function (Request $request) use ($app) {
    $transactionForm = $app['form.factory']->create(new IKKA\Form\Type\TransactionType());
    $transactionForm->handleRequest($request);
    if ($transactionForm->isSubmitted() && $transactionForm->isValid()) {
        $app['dao.transaction']->create($app);
        $app['session']->getFlashBag()->add('success', 'La transaction est bien enregitrée');
    }
    $transactionFormView = $transactionForm->createView();
    return $app['twig']->render('transactionForm.html.twig', array('transactionForm' => $transactionFormView)
    );
})->bind('newTransaction');

$app->match('/new/badge', function (Request $request) use ($app) {
    $badgeForm = $app['form.factory']->create(new IKKA\Form\Type\BadgeType());
    $badgeForm->handleRequest($request);
    if ($badgeForm->isSubmitted() && $badgeForm->isValid()) {
        $app['dao.badge']->create();
        $app['session']->getFlashBag()->add('success', 'Nouveau badge enregistré !');
    }
    $badgeFormView = $badgeForm->createView();
    return $app['twig']->render('badgeForm.html.twig', array('badgeForm' => $badgeFormView));
})->bind('newBadge');

//OK
$app->match('/login', function (Request $request) use ($app) {
    $loginForm = $app['form.factory']->create(new IKKA\Form\Type\ConnectionType());
    $loginForm->handleRequest($request);
    if ($loginForm->isSubmitted() && $loginForm->isValid()) {
        $result = $app['dao.connection']->login($app);
        if ($result != null) {
            return $app->redirect('./');
        } else {
            $app['session']->getFlashBag()->add('error', 'Connexion échouée.');
        }
    }
    $loginFormView = $loginForm->createView();
    return $app['twig']->render('loginForm.html.twig', array('loginForm' => $loginFormView)
    );
})->bind('login');

//OK
$app->get('/logout', function () use ($app) {
    $app['dao.connection']->logout($app);
    return $app->redirect('./login');
})->bind('logout');


$app->error(function (\Exception $e, $code) use ($app) {
    if (500 === $code) {
        return $app->redirect($app['url_generator']->generate('login'));
    } elseif (404 == $$code) {
        return $app->redirect($app['url_generator']->generate('login'));
    }
});


