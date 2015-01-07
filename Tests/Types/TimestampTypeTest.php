<?php

namespace Alameda\Bundle\DoctrineExtensionsBundle\Tests\Types;

use Alameda\Bundle\DoctrineExtensionsBundle\Types\TimestampType;
use Doctrine\DBAL\Types\Type;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Bundle\DoctrineExtensionsBundle\Tests\Types
 */
class TimestampTypeTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (! Type::hasType('timestamp')) {
            Type::addType('timestamp', 'Alameda\Bundle\DoctrineExtensionsBundle\Types\TimestampType');
        } else {
            if (! Type::getType('timestamp') instanceof TimestampType) {
                Type::overrideType('timestamp', 'Alameda\Bundle\DoctrineExtensionsBundle\Types\TimestampType');
            }
        }
    }

    public function testName()
    {
        $type = Type::getType('timestamp');

        $this->assertInstanceof('\Alameda\Bundle\DoctrineExtensionsBundle\Types\TimestampType', $type);

        $this->assertEquals('timestamp', $type->getName());
    }

    /**
     * @dataProvider sqlDeclarationProvider
     *
     * @param $output
     * @param $platform
     * @throws \Doctrine\DBAL\DBALException
     */
    public function testSqlDeclaration($output, $platform)
    {
        $type = Type::getType('timestamp');

        $this->assertInstanceof('\Alameda\Bundle\DoctrineExtensionsBundle\Types\TimestampType', $type);

        $this->assertEquals($output, $type->getSQLDeclaration(array(), $platform));
    }

    public function sqlDeclarationProvider()
    {
        return array(
            array('TIMESTAMP(0)', new \Doctrine\DBAL\Platforms\DB2Platform),
            array('DATETIME', new \Doctrine\DBAL\Platforms\DrizzlePlatform),
            array('DATETIME', new \Doctrine\DBAL\Platforms\MySQL57Platform),
            array('DATETIME', new \Doctrine\DBAL\Platforms\MySqlPlatform),
            array('TIMESTAMP(0)', new \Doctrine\DBAL\Platforms\OraclePlatform),
            array('TIMESTAMP(0) WITHOUT TIME ZONE', new \Doctrine\DBAL\Platforms\PostgreSQL91Platform),
            array('TIMESTAMP(0) WITHOUT TIME ZONE', new \Doctrine\DBAL\Platforms\PostgreSQL92Platform),
            array('TIMESTAMP(0) WITHOUT TIME ZONE', new \Doctrine\DBAL\Platforms\PostgreSQLPlatform),
            array('DATETIME', new \Doctrine\DBAL\Platforms\SQLAnywhere11Platform),
            array('DATETIME', new \Doctrine\DBAL\Platforms\SQLAnywhere12Platform),
            array('DATETIME', new \Doctrine\DBAL\Platforms\SQLAnywhere16Platform),
            array('DATETIME', new \Doctrine\DBAL\Platforms\SQLAnywherePlatform),
            array('DATETIME2(6)', new \Doctrine\DBAL\Platforms\SQLAzurePlatform),
            array('DATETIME', new \Doctrine\DBAL\Platforms\SqlitePlatform),
            array('DATETIME', new \Doctrine\DBAL\Platforms\SQLServer2005Platform),
            array('DATETIME2(6)', new \Doctrine\DBAL\Platforms\SQLServer2008Platform),
            array('DATETIME2(6)', new \Doctrine\DBAL\Platforms\SQLServer2012Platform),
            array('DATETIME', new \Doctrine\DBAL\Platforms\SQLServerPlatform),
        );
    }

    /**
     * @dataProvider toPHPProvider
     *
     * @param $input
     * @param $output
     * @param $platform
     * @throws \Doctrine\DBAL\DBALException
     */
    public function testConvertToPHPValue($input, $output, $platform)
    {
        $type = Type::getType('timestamp');

        $this->assertInstanceof('\Alameda\Bundle\DoctrineExtensionsBundle\Types\TimestampType', $type);

        $this->assertEquals($output, $type->convertToPHPValue($input, $platform));
    }

    public function toPHPProvider()
    {
        return array(
            array(null, null, new \Doctrine\DBAL\Platforms\DB2Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\DrizzlePlatform),
            array(null, null, new \Doctrine\DBAL\Platforms\MySQL57Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\MySqlPlatform),
            array(null, null, new \Doctrine\DBAL\Platforms\OraclePlatform),
            array(null, null, new \Doctrine\DBAL\Platforms\PostgreSQL91Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\PostgreSQL92Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\PostgreSQLPlatform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLAnywhere11Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLAnywhere12Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLAnywhere16Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLAnywherePlatform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLAzurePlatform),
            array(null, null, new \Doctrine\DBAL\Platforms\SqlitePlatform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLServer2005Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLServer2008Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLServer2012Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLServerPlatform),

            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\DB2Platform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\DrizzlePlatform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\MySQL57Platform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\MySqlPlatform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\OraclePlatform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\PostgreSQL91Platform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\PostgreSQL92Platform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\PostgreSQLPlatform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\SQLAnywhere11Platform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\SQLAnywhere12Platform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\SQLAnywhere16Platform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\SQLAnywherePlatform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\SQLAzurePlatform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\SqlitePlatform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\SQLServer2005Platform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\SQLServer2008Platform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\SQLServer2012Platform),
            array('2014-03-24 08:26:05', new \DateTime('2014-03-24 08:26:05'), new \Doctrine\DBAL\Platforms\SQLServerPlatform),
        );
    }

    /**
     * @dataProvider toDBProvider
     *
     * @param $input
     * @param $output
     * @param $platform
     * @throws \Doctrine\DBAL\DBALException
     */
    public function testConvertToDatabaseValue($input, $output, $platform)
    {
        $type = Type::getType('timestamp');

        $this->assertInstanceof('\Alameda\Bundle\DoctrineExtensionsBundle\Types\TimestampType', $type);

        $this->assertEquals($output, $type->convertToDatabaseValue($input, $platform));
    }

    public function toDBProvider()
    {
        return array(
            array(null, null, new \Doctrine\DBAL\Platforms\DB2Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\DrizzlePlatform),
            array(null, null, new \Doctrine\DBAL\Platforms\MySQL57Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\MySqlPlatform),
            array(null, null, new \Doctrine\DBAL\Platforms\OraclePlatform),
            array(null, null, new \Doctrine\DBAL\Platforms\PostgreSQL91Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\PostgreSQL92Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\PostgreSQLPlatform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLAnywhere11Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLAnywhere12Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLAnywhere16Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLAnywherePlatform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLAzurePlatform),
            array(null, null, new \Doctrine\DBAL\Platforms\SqlitePlatform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLServer2005Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLServer2008Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLServer2012Platform),
            array(null, null, new \Doctrine\DBAL\Platforms\SQLServerPlatform),

            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05', new \Doctrine\DBAL\Platforms\DB2Platform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05', new \Doctrine\DBAL\Platforms\DrizzlePlatform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05', new \Doctrine\DBAL\Platforms\MySQL57Platform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05', new \Doctrine\DBAL\Platforms\MySqlPlatform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05', new \Doctrine\DBAL\Platforms\OraclePlatform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05', new \Doctrine\DBAL\Platforms\PostgreSQL91Platform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05', new \Doctrine\DBAL\Platforms\PostgreSQL92Platform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05', new \Doctrine\DBAL\Platforms\PostgreSQLPlatform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05.000000', new \Doctrine\DBAL\Platforms\SQLAnywhere11Platform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05.000000', new \Doctrine\DBAL\Platforms\SQLAnywhere12Platform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05.000000', new \Doctrine\DBAL\Platforms\SQLAnywhere16Platform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05.000000', new \Doctrine\DBAL\Platforms\SQLAnywherePlatform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05.000000', new \Doctrine\DBAL\Platforms\SQLAzurePlatform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05', new \Doctrine\DBAL\Platforms\SqlitePlatform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05.000', new \Doctrine\DBAL\Platforms\SQLServer2005Platform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05.000000', new \Doctrine\DBAL\Platforms\SQLServer2008Platform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05.000000', new \Doctrine\DBAL\Platforms\SQLServer2012Platform),
            array(new \DateTime('2014-03-24 08:26:05'), '2014-03-24 08:26:05.000', new \Doctrine\DBAL\Platforms\SQLServerPlatform),
        );
    }

    /**
     * @dataProvider toPHPConversionExceptionProvider
     *
     * @expectedException \Doctrine\DBAL\Types\ConversionException
     *
     * @param $input
     * @param $platform
     * @throws \Doctrine\DBAL\DBALException
     */
    public function testConvertToTPHPValueConversionException($input, $platform)
    {
        $type = Type::getType('timestamp');

        $this->assertInstanceof('\Alameda\Bundle\DoctrineExtensionsBundle\Types\TimestampType', $type);

        $type->convertToPHPValue($input, $platform);
    }

    public function toPHPConversionExceptionProvider()
    {
        return array(
            array('foo', new \Doctrine\DBAL\Platforms\DB2Platform),
            array('foo', new \Doctrine\DBAL\Platforms\DrizzlePlatform),
            array('foo', new \Doctrine\DBAL\Platforms\MySQL57Platform),
            array('foo', new \Doctrine\DBAL\Platforms\MySqlPlatform),
            array('foo', new \Doctrine\DBAL\Platforms\OraclePlatform),
            array('foo', new \Doctrine\DBAL\Platforms\PostgreSQL91Platform),
            array('foo', new \Doctrine\DBAL\Platforms\PostgreSQL92Platform),
            array('foo', new \Doctrine\DBAL\Platforms\PostgreSQLPlatform),
            array('foo', new \Doctrine\DBAL\Platforms\SQLAnywhere11Platform),
            array('foo', new \Doctrine\DBAL\Platforms\SQLAnywhere12Platform),
            array('foo', new \Doctrine\DBAL\Platforms\SQLAnywhere16Platform),
            array('foo', new \Doctrine\DBAL\Platforms\SQLAnywherePlatform),
            array('foo', new \Doctrine\DBAL\Platforms\SQLAzurePlatform),
            array('foo', new \Doctrine\DBAL\Platforms\SqlitePlatform),
            array('foo', new \Doctrine\DBAL\Platforms\SQLServer2005Platform),
            array('foo', new \Doctrine\DBAL\Platforms\SQLServer2008Platform),
            array('foo', new \Doctrine\DBAL\Platforms\SQLServer2012Platform),
            array('foo', new \Doctrine\DBAL\Platforms\SQLServerPlatform),

            array(array(), new \Doctrine\DBAL\Platforms\DB2Platform),
            array(array(), new \Doctrine\DBAL\Platforms\DrizzlePlatform),
            array(array(), new \Doctrine\DBAL\Platforms\MySQL57Platform),
            array(array(), new \Doctrine\DBAL\Platforms\MySqlPlatform),
            array(array(), new \Doctrine\DBAL\Platforms\OraclePlatform),
            array(array(), new \Doctrine\DBAL\Platforms\PostgreSQL91Platform),
            array(array(), new \Doctrine\DBAL\Platforms\PostgreSQL92Platform),
            array(array(), new \Doctrine\DBAL\Platforms\PostgreSQLPlatform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLAnywhere11Platform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLAnywhere12Platform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLAnywhere16Platform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLAnywherePlatform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLAzurePlatform),
            array(array(), new \Doctrine\DBAL\Platforms\SqlitePlatform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLServer2005Platform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLServer2008Platform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLServer2012Platform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLServerPlatform),

            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\DB2Platform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\DrizzlePlatform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\MySQL57Platform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\MySqlPlatform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\OraclePlatform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\PostgreSQL91Platform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\PostgreSQL92Platform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\PostgreSQLPlatform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\SQLAnywhere11Platform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\SQLAnywhere12Platform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\SQLAnywhere16Platform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\SQLAnywherePlatform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\SQLAzurePlatform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\SqlitePlatform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\SQLServer2005Platform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\SQLServer2008Platform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\SQLServer2012Platform),
            array(new \DateTime('now'), new \Doctrine\DBAL\Platforms\SQLServerPlatform),
        );
    }

    /**
     * @dataProvider toDBConversionExceptionProvider
     *
     * @expectedException \Doctrine\DBAL\Types\ConversionException
     *
     * @param $input
     * @param $platform
     * @throws \Doctrine\DBAL\DBALException
     */
    public function testConvertToDatabaseValueConversionException($input, $platform)
    {
        $type = Type::getType('timestamp');

        $this->assertInstanceof('\Alameda\Bundle\DoctrineExtensionsBundle\Types\TimestampType', $type);

        $type->convertToDatabaseValue($input, $platform);
    }

    public function toDBConversionExceptionProvider()
    {
        return array(
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\DB2Platform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\DrizzlePlatform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\MySQL57Platform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\MySqlPlatform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\OraclePlatform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\PostgreSQL91Platform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\PostgreSQL92Platform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\PostgreSQLPlatform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\SQLAnywhere11Platform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\SQLAnywhere12Platform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\SQLAnywhere16Platform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\SQLAnywherePlatform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\SQLAzurePlatform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\SqlitePlatform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\SQLServer2005Platform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\SQLServer2008Platform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\SQLServer2012Platform),
            array(new \DateInterval('P1D'), new \Doctrine\DBAL\Platforms\SQLServerPlatform),

            array(array(), new \Doctrine\DBAL\Platforms\DB2Platform),
            array(array(), new \Doctrine\DBAL\Platforms\DrizzlePlatform),
            array(array(), new \Doctrine\DBAL\Platforms\MySQL57Platform),
            array(array(), new \Doctrine\DBAL\Platforms\MySqlPlatform),
            array(array(), new \Doctrine\DBAL\Platforms\OraclePlatform),
            array(array(), new \Doctrine\DBAL\Platforms\PostgreSQL91Platform),
            array(array(), new \Doctrine\DBAL\Platforms\PostgreSQL92Platform),
            array(array(), new \Doctrine\DBAL\Platforms\PostgreSQLPlatform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLAnywhere11Platform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLAnywhere12Platform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLAnywhere16Platform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLAnywherePlatform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLAzurePlatform),
            array(array(), new \Doctrine\DBAL\Platforms\SqlitePlatform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLServer2005Platform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLServer2008Platform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLServer2012Platform),
            array(array(), new \Doctrine\DBAL\Platforms\SQLServerPlatform),
        );
    }
}