<?php
// This bootstrap file used for Doctrine-CLI tool

require_once "vendor/autoload.php";
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$isDevMode = true;
$paths = array("src/RecipeApp/Model/Entity");

// database configuration parameters
$dbParams = array(
    'driver'   => 'pdo_pgsql',
    'host'     => '172.18.0.4',
    'post'     => '5432',
    'user'     => 'hellofresh',
    'password' => 'hellofresh',
    'dbname'   => 'hellofresh',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);