<?php

declare(strict_types=1);

$app->get('/', 'App\Controller\Home:getHelp');
$app->get('/status', 'App\Controller\Home:getStatus');


$app->get('/churches', App\Controller\Churches\GetAll::class);
$app->post('/churches', App\Controller\Churches\Create::class);
$app->get('/churches/{id}', App\Controller\Churches\GetOne::class);
$app->put('/churches/{id}', App\Controller\Churches\Update::class);
$app->delete('/churches/{id}', App\Controller\Churches\Delete::class);

$app->get('/users', App\Controller\Users\GetAll::class);
$app->post('/users', App\Controller\Users\Create::class);
$app->get('/users/{id}', App\Controller\Users\GetOne::class);
$app->put('/users/{id}', App\Controller\Users\Update::class);
$app->delete('/users/{id}', App\Controller\Users\Delete::class);

$app->get('/user_notifications', App\Controller\User_notifications\GetAll::class);
$app->post('/user_notifications', App\Controller\User_notifications\Create::class);
$app->get('/user_notifications/{id}', App\Controller\User_notifications\GetOne::class);
$app->put('/user_notifications/{id}', App\Controller\User_notifications\Update::class);
$app->delete('/user_notifications/{id}', App\Controller\User_notifications\Delete::class);

$app->get('/pastors', App\Controller\Pastors\GetAll::class);
$app->post('/pastors', App\Controller\Pastors\Create::class);
$app->get('/pastors/{id}', App\Controller\Pastors\GetOne::class);
$app->put('/pastors/{id}', App\Controller\Pastors\Update::class);
$app->delete('/pastors/{id}', App\Controller\Pastors\Delete::class);

$app->get('/notifications', App\Controller\Notifications\GetAll::class);
$app->post('/notifications', App\Controller\Notifications\Create::class);
$app->get('/notifications/{id}', App\Controller\Notifications\GetOne::class);
$app->put('/notifications/{id}', App\Controller\Notifications\Update::class);
$app->delete('/notifications/{id}', App\Controller\Notifications\Delete::class);
