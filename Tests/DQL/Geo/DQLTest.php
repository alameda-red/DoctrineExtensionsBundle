<?php

namespace Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Geo;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Geo
 */
class DQLTest extends \PHPUnit_Framework_TestCase
{
    const PROXIES_PATH = '/tmp';
    const PROXIES_NAMESPACE = 'Test';
    const ENTITIES_PATH = '';

    private $em;

    public function setUp()
    {
        $config = new Configuration();
        $config->setMetadataCacheImpl(new ArrayCache());
        $config->setQueryCacheImpl(new ArrayCache());
        $config->setProxyDir(self::PROXIES_PATH);
        $config->setProxyNamespace(self::PROXIES_NAMESPACE);
        $config->setAutoGenerateProxyClasses(true);

        $driver = $config->newDefaultAnnotationDriver(self::ENTITIES_PATH);
        $config->setMetadataDriverImpl($driver);

        $conn = array(
            'driver' => 'pdo_sqlite',
            'memory' => true,
        );

        $config->addCustomNumericFunction('ACOS', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Acos');
        $config->addCustomNumericFunction('ACOSh', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Acosh');
        $config->addCustomNumericFunction('ASIN', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Asin');
        $config->addCustomNumericFunction('ASINH', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Asinh');
        $config->addCustomNumericFunction('ATAN', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Atan');
        $config->addCustomNumericFunction('ATAN2', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Atan2');
        $config->addCustomNumericFunction('ATANH', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Atanh');
        $config->addCustomNumericFunction('COS', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Cos');
        $config->addCustomNumericFunction('COSH', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Cosh');
        $config->addCustomNumericFunction('DEGREES', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Degrees');
        $config->addCustomNumericFunction('RADIANS', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Radians');
        $config->addCustomNumericFunction('SIN', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Sin');
        $config->addCustomNumericFunction('SINH', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Sinh');
        $config->addCustomNumericFunction('TAN', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Tan');
        $config->addCustomNumericFunction('TANH', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Tanh');

        $config->addCustomNumericFunction('ALAMEDA_GEO_DISTANCE', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Geo\Distance');

        $this->em = EntityManager::create($conn, $config);
    }

    public function testDistance()
    {
        $dql = 'SELECT ALAMEDA_GEO_DISTANCE(50.0663, 5.7147, 58.6438, 3.07) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Geo\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT (6371000.785*2*ATAN2(RADIANS(SQRT(POW(SIN(RADIANS(58.6438-50.0663/2)),2)+'.
            'COS(RADIANS(50.0663))*COS(RADIANS(58.6438))*'.
            'POW(SIN(RADIANS(3.07-5.7147/2)),2))),RADIANS(SQRT(1-POW(SIN(RADIANS(58.6438-50.0663/2)),2)+'.
            'COS(RADIANS(50.0663))*COS(RADIANS(58.6438))*POW(SIN(RADIANS(3.07-5.7147/2)),2))))) AS sclr0 FROM BlogPost b0_';

        $this->assertEquals($sql, $query->getSQL());
    }
}

/**
 * Class BlogPost
 *
 * @Entity
 *
 * @package Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL
 */
final class BlogPost
{
    /**
     * @var integer
     *
     * @Id
     * @Column(type="string")
     * @GeneratedValue
     * */
    public $id;
}