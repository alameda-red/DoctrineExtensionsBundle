<?php

namespace Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math
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
        $config->addCustomNumericFunction('POW', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Pow');
        $config->addCustomNumericFunction('RADIANS', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Radians');
        $config->addCustomNumericFunction('SIN', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Sin');
        $config->addCustomNumericFunction('SINH', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Sinh');
        $config->addCustomNumericFunction('TAN', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Tan');
        $config->addCustomNumericFunction('TANH', 'Alameda\Bundle\DoctrineExtensionsBundle\DQL\Math\Tanh');

        $this->em = EntityManager::create($conn, $config);
    }

    public function testAcos()
    {
        $dql = 'SELECT ACOS(1) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT ACOS(1) AS sclr0 FROM BlogPost b0_';

        $this->assertEquals($sql, $query->getSQL());
    }

    public function testAcosh()
    {
        $dql = 'SELECT ACOSH(1) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT ACOSH(1) AS sclr0 FROM BlogPost b0_';

        $this->assertEquals($sql, $query->getSQL());
    }

    public function testAsin()
    {
        $dql = 'SELECT ASIN(1) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT ASIN(1) AS sclr0 FROM BlogPost b0_';

        $this->assertEquals($sql, $query->getSQL());
    }

    public function testAsinh()
    {
        $dql = 'SELECT ASINH(1) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT ASINH(1) AS sclr0 FROM BlogPost b0_';

        $this->assertEquals($sql, $query->getSQL());
    }

    public function testAtan()
    {
        $dql = 'SELECT ATAN(1) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT ATAN(1) AS sclr0 FROM BlogPost b0_';

        $this->assertEquals($sql, $query->getSQL());
    }

    public function testAtan2()
    {
        $dql = 'SELECT ATAN2(1, 2) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT ATAN2(1, 2) AS sclr0 FROM BlogPost b0_';

        $this->assertEquals($sql, $query->getSQL());
    }

    public function testAtanh()
    {
        $dql = 'SELECT ATANH(1) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT ATANH(1) AS sclr0 FROM BlogPost b0_';

        $this->assertEquals($sql, $query->getSQL());
    }

    public function testCos()
    {
        $dql = 'SELECT COS(1) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT COS(1) AS sclr0 FROM BlogPost b0_';

        $this->assertEquals($sql, $query->getSQL());
    }

    public function testCosh()
    {
        $dql = 'SELECT COSH(1) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT COSH(1) AS sclr0 FROM BlogPost b0_';

        $this->assertEquals($sql, $query->getSQL());
    }

    public function testDegrees()
    {
        $dql = 'SELECT DEGREES(1) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT DEGREES(1) AS sclr0 FROM BlogPost b0_';

        $this->assertEquals($sql, $query->getSQL());
    }

    public function testPow()
    {
        $dql = 'SELECT POW(1, 2) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT POW(1, 2) AS sclr0 FROM BlogPost b0_';

        $this->assertEquals($sql, $query->getSQL());
    }

    public function testRadians()
    {
        $dql = 'SELECT RADIANS(1) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT RADIANS(1) AS sclr0 FROM BlogPost b0_';

        $this->assertEquals($sql, $query->getSQL());
    }

    public function testSin()
    {
        $dql = 'SELECT SIN(1) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT SIN(1) AS sclr0 FROM BlogPost b0_';

        $this->assertEquals($sql, $query->getSQL());
    }

    public function testSinh()
    {
        $dql = 'SELECT SINH(1) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT SINH(1) AS sclr0 FROM BlogPost b0_';

        $this->assertEquals($sql, $query->getSQL());
    }

    public function testTan()
    {
        $dql = 'SELECT TAN(1) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT TAN(1) AS sclr0 FROM BlogPost b0_';

        $this->assertEquals($sql, $query->getSQL());
    }

    public function testTanh()
    {
        $dql = 'SELECT TANH(1) FROM \Alameda\Bundle\DoctrineExtensionsBundle\Tests\DQL\Math\BlogPost p';

        $query = $this->em->createQuery($dql);
        $sql = 'SELECT TANH(1) AS sclr0 FROM BlogPost b0_';

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