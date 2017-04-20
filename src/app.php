<?php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();

// List all recipes
$routes->add('get_all_recipes', new Route('/recipe', array(
    '_controller' => 'RecipeApp\Controller\RecipeController::indexAction',
), array(), array(), '', array(), array('GET', 'HEAD')));

$routes->add('get_one_recipe', new Route('/recipe/{recipeId}', array(
    'recipeId' => null,
    '_controller' => 'RecipeApp\Controller\RecipeController::getAction',
), array(), array(), '', array(), array('GET', 'HEAD')));


$routes->add('create_new_recipe', new Route('/recipe', array(
    '_controller' => 'RecipeApp\Controller\RecipeController::createAction',
), array(), array(), '', array(), array('POST')));


$routes->add('update_recipe', new Route('/recipe/{recipeId}', array(
    'recipeId' => 0,
    '_controller' => 'RecipeApp\Controller\RecipeController::updateAction',
), array(), array(), '', array(), array('PUT', 'PATCH')));

$routes->add('delete_recipe', new Route('/recipe/{recipeId}', array(
    'recipeId' => 0,
    '_controller' => 'RecipeApp\Controller\RecipeController::deleteAction',
), array(), array(), '', array(), array('DELETE')));

$routes->add('rate_recipe', new Route('/recipe/{recipeId}/{rate}', array(
    'recipeId' => 0,
    'rate' => 0,
    '_controller' => 'RecipeApp\Controller\RecipeController::rateAction',
), array(), array(), '', array(), array('PUT', 'PATCH')));

return $routes;