<?php
/**
 * Config file for pagecontrollers, creating an instance of $app.
 *
 */

// Get environment & autoloader.
require __DIR__.'/config.php'; 

// Create services and inject into the app. 
$di  = new \Anax\DI\CDIFactoryDefault();
$app = new \Anax\Kernel\CAnax($di);

$app->session;

$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/config_mysql.php');
    $db->connect();
    return $db;
});

$di->set('FlashMessages', function() {
    $FlashMessages = new \Anax\FlashMessages\FlashMessages();
    return $FlashMessages;
});

$di->set('CommentsController', function() use ($di) {
    $controller = new \Anax\Comments\CommentsController();
    $controller->setDI($di);
    return $controller;
});

$di->set('UsersController', function () use ($di) {
    $controller = new \Anax\Users\UsersController();
    $controller->setDI($di);
    return $controller;
});

$di->set('TagsController', function () use ($di) {
    $controller = new \Anax\Tag\TagsController();
    $controller->setDI($di);
    return $controller;
});

$di->set('QuestionsController', function() use ($di) {
    $controller = new \Anax\Question\QuestionsController();
    $controller->setDI($di);
    return $controller;
});

$di->setShared('auth', function() use ($di) {
    $module = new \Anax\Authentication\Authentication('user');
    $module->setDI($di);
    return $module;
});

$di->set('form', '\Mos\HTMLForm\CForm');
$di->set('time', '\Anax\Time\Time');

//$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

// Get theme
$app->theme->configure(ANAX_APP_PATH . 'config/theme-grid.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar.php');
