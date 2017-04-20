<?php
namespace HelloFresh\Model\DB;

require_once __DIR__."/../../../../vendor/autoload.php";
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


class EM
{

    private static $instance;

    public static function getInstance() {

        if(self::$instance == null){
            self::$instance = self::getConnection();
        }

        return self::$instance;
    }

    private static function getConnection() {
        // database configuration parameters
        $dbParams = array(
            'driver'   => 'pdo_pgsql',
            'host'     => '172.18.0.4',
            'post'     => '5432',
            'user'     => 'hellofresh',
            'password' => 'hellofresh',
            'dbname'   => 'hellofresh',
        );

        $isDevMode = true;
        $paths = array(__DIR__."/../Entity");
        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        return EntityManager::create($dbParams, $config);
    }
}
