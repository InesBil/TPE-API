<?php
require_once 'libs/Router.php';
require_once './app/controllers/review-api.controller.php';

$router = new Router();

$router->addRoute('reviews', 'GET', 'ReviewApiController', 'getReviews');
$router->addRoute('reviews/:ID', 'GET', 'ReviewApiController', 'getReview');
$router->addRoute('reviews/:ID', 'DELETE', 'ReviewApiController', 'deleteReview');
$router->addRoute('reviews', 'POST', 'ReviewApiController', 'insertReview');
$router->addRoute('reviews/:ID', 'PUT', 'ReviewApiController', 'updateReview');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
