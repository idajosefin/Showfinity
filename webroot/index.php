<?php
/**
 * This is a Anax pagecontroller.
 *
 */

// Get environment & autoloader and the $app-object.
require __DIR__.'/config_with_app.php';

// Create services and inject into the app.

// Extra stylesheet
$app->theme->addStylesheet('css/flash.css');

$app->views ->addString($app->FlashMessages->get('icons'), 'flash');
$content = $app->fileContent->get('welcome.md');

$app->views->addString('<div class="footertitle">Showfinity</div>Showfinity lets you discuss your favorite TV series, characters and discover new and upcoming shows.', 'footer-col-1');


$app->dispatcher->forward([
    'controller' => 'questions',
    'action'     => 'footer',
    'params' => ["footer-col-2"]
]);

$app->dispatcher->forward([
    'controller' => 'questions',
    'action'     => 'footer2',
    'params' => ["footer-col-3"]
]);


// Routes
$app->router->add('', function() use ($app) {

    $app->theme->setTitle("Home");

    $content = $app->fileContent->get('welcome.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

    $app->views->addString('  <div class="jumbotron"><h1>All about TV Shows</h1><p class="lead">Showfinity is a question and answer site about TV Shows and series.</p></div>', 'flash');

    $app->dispatcher->forward([
        'controller' => 'questions',
        'params' => ["main"]
    ]);

    $app->dispatcher->forward([
        'controller' => 'questions',
        'action'     => 'footer2',
        'params' => ["triptych-1"]
    ]);

    $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'top',
        'params' => ["triptych-2"]
    ]);
});

$app->router->add('about', function() use ($app) {

    $app->theme->setTitle("About");

    $content = $app->fileContent->get('about.md');
    $content = $app->textFilter->doFilter($content, 'markdown, shortcode');

    $app->views->addString($content, 'main');

        $app->dispatcher->forward([
            'controller' => 'questions',
            'action'     => 'sidebar',
        ]);

});

$app->router->add('setup', function() use ($app) {

    $app->theme->setTitle("Setup");

    $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'setup',
    ]);

    $app->dispatcher->forward([
        'controller' => 'questions',
        'action'     => 'setup',
    ]);

    $app->dispatcher->forward([
        'controller' => 'tags',
        'action'     => 'setup',
    ]);


});

$app->router->add('source', function() use ($app) {

    $app->theme->addStylesheet('css/source.css');
    $app->theme->setTitle("Källkod");

    if ($app->auth->isAdmin()) {
        $source = new \Mos\Source\CSource([
            'secure_dir' => '..',
            'base_dir' => '..',
            'add_ignore' => ['.htaccess'],
        ]);

        $app->views->add('default/source', [
            'content' => $source->View(),
        ]);
    } else {
        $app->FlashMessages->add('error', 'You do not have permission to this page!');
    }

});

$app->router->handle();
$app->theme->render();