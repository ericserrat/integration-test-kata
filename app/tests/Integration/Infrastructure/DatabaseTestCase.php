<?php

namespace Tests\Integration\Infrastructure;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Faker\Generator;
use Faker\Factory;
use Faker\Provider;
use PHPUnit\Framework\TestCase;

class DatabaseTestCase extends TestCase
{
    /** @var EntityManager */
    protected $em;

    /** @var Generator */
    protected $faker;

    public function setUp()
    {
        $this->configureEntityManager();
        $this->configureFaker();
        $this->emptyAllTables();
    }

    protected function configureEntityManager()
    {
        $isDevMode = true;
        $config = Setup::createXMLMetadataConfiguration(array(__DIR__ . "/../../../config/xml"), $isDevMode);
        $conn = array(
            'driver' => 'pdo_mysql',
            'host' => getenv('MYSQL_ROOT_HOST'),
            'user' => getenv('MYSQL_USER'),
            'password' => getenv('MYSQL_PASSWORD'),
            'dbname' => getenv('MYSQL_DATABASE'),
            'charset' => getenv('MYSQL_CHARSET'),
        );

        $this->em = EntityManager::create($conn, $config);
    }

    protected function emptyAllTables()
    {
        $this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 0;")->execute();

        foreach ($this->em->getConnection()->getSchemaManager()->listTableNames() as $tableNames) {
            $sql = 'TRUNCATE TABLE ' . $tableNames;
            $this->em->getConnection()->prepare($sql)->execute();
        }

        $this->em->getConnection()->prepare("SET FOREIGN_KEY_CHECKS = 1;")->execute();
    }

    protected function configureFaker()
    {
        $this->faker = Factory::create();
        $this->faker->addProvider(new Provider\es_ES\Person($this->faker));
    }

    protected function tearDown()
    {
        $this->em->close();
        $this->em = null;// avoid memory leaks
    }
}