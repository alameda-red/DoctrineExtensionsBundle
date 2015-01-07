<?php

namespace Alameda\Bundle\DoctrineExtensionsBundle\Tests\Types;

use Alameda\Bundle\DoctrineExtensionsBundle\Types\DateIntervalType;
use Doctrine\DBAL\Types\Type;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Bundle\DoctrineExtensionsBundle\Tests\Types
 */
class DateIntervalTypeTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (! Type::hasType('dateinterval')) {
            Type::addType('dateinterval', 'Alameda\Bundle\DoctrineExtensionsBundle\Types\DateIntervalType');
        } else {
            if (! Type::getType('dateinterval') instanceof DateIntervalType) {
                Type::overrideType('dateinterval', 'Alameda\Bundle\DoctrineExtensionsBundle\Types\DateIntervalType');
            }
        }
    }

    public function testName()
    {
        $type = Type::getType('dateinterval');

        $this->assertInstanceof('\Alameda\Bundle\DoctrineExtensionsBundle\Types\DateIntervalType', $type);

        $this->assertEquals('dateinterval', $type->getName());
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
        $type = Type::getType('dateinterval');

        $this->assertInstanceof('\Alameda\Bundle\DoctrineExtensionsBundle\Types\DateIntervalType', $type);

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

            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\DB2Platform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\DrizzlePlatform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\MySQL57Platform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\MySqlPlatform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\OraclePlatform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\PostgreSQL91Platform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\PostgreSQL92Platform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\PostgreSQLPlatform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\SQLAnywhere11Platform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\SQLAnywhere12Platform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\SQLAnywhere16Platform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\SQLAnywherePlatform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\SQLAzurePlatform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\SqlitePlatform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\SQLServer2005Platform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\SQLServer2008Platform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\SQLServer2012Platform),
            array('P1Y1M1DT1H1M1S', new \DateInterval('P1Y1M1DT1H1M1S'), new \Doctrine\DBAL\Platforms\SQLServerPlatform),
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
        $type = Type::getType('dateinterval');

        $this->assertInstanceof('\Alameda\Bundle\DoctrineExtensionsBundle\Types\DateIntervalType', $type);

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

            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\DB2Platform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\DrizzlePlatform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\MySQL57Platform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\MySqlPlatform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\OraclePlatform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\PostgreSQL91Platform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\PostgreSQL92Platform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\PostgreSQLPlatform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\SQLAnywhere11Platform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\SQLAnywhere12Platform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\SQLAnywhere16Platform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\SQLAnywherePlatform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\SQLAzurePlatform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\SqlitePlatform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\SQLServer2005Platform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\SQLServer2008Platform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\SQLServer2012Platform),
            array(new \DateInterval('P1Y1M1DT1H1M1S'), 'P1Y1M1DT1H1M1S', new \Doctrine\DBAL\Platforms\SQLServerPlatform),
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
    public function testConvertToPHPValueConversionException($input, $platform)
    {
        $type = Type::getType('dateinterval');

        $this->assertInstanceof('\Alameda\Bundle\DoctrineExtensionsBundle\Types\DateIntervalType', $type);

        $type->convertToPHPValue($input, $platform);
    }

    public function toPHPConversionExceptionProvider()
    {
        return array(
            array('P!S', new \Doctrine\DBAL\Platforms\DB2Platform),
            array('P!S', new \Doctrine\DBAL\Platforms\DrizzlePlatform),
            array('P!S', new \Doctrine\DBAL\Platforms\MySQL57Platform),
            array('P!S', new \Doctrine\DBAL\Platforms\MySqlPlatform),
            array('P!S', new \Doctrine\DBAL\Platforms\OraclePlatform),
            array('P!S', new \Doctrine\DBAL\Platforms\PostgreSQL91Platform),
            array('P!S', new \Doctrine\DBAL\Platforms\PostgreSQL92Platform),
            array('P!S', new \Doctrine\DBAL\Platforms\PostgreSQLPlatform),
            array('P!S', new \Doctrine\DBAL\Platforms\SQLAnywhere11Platform),
            array('P!S', new \Doctrine\DBAL\Platforms\SQLAnywhere12Platform),
            array('P!S', new \Doctrine\DBAL\Platforms\SQLAnywhere16Platform),
            array('P!S', new \Doctrine\DBAL\Platforms\SQLAnywherePlatform),
            array('P!S', new \Doctrine\DBAL\Platforms\SQLAzurePlatform),
            array('P!S', new \Doctrine\DBAL\Platforms\SqlitePlatform),
            array('P!S', new \Doctrine\DBAL\Platforms\SQLServer2005Platform),
            array('P!S', new \Doctrine\DBAL\Platforms\SQLServer2008Platform),
            array('P!S', new \Doctrine\DBAL\Platforms\SQLServer2012Platform),
            array('P!S', new \Doctrine\DBAL\Platforms\SQLServerPlatform),
        );
    }

    /**
     * @param $output
     * @param $platform
     *
     * @dataProvider getSQLDeclarationDataProvider
     */
    public function testGetSQLDeclaration($output, $platform)
    {
        $type = Type::getType('dateinterval');

        $this->assertInstanceof('\Alameda\Bundle\DoctrineExtensionsBundle\Types\DateIntervalType', $type);

        $this->assertEquals($output, $type->getSQLDeclaration(array(), $platform));
    }

    public function getSQLDeclarationDataProvider()
    {
        return array(
            array('VARCHAR(255)', new \Doctrine\DBAL\Platforms\DB2Platform),
            array('VARCHAR(255)', new \Doctrine\DBAL\Platforms\DrizzlePlatform),
            array('VARCHAR(255)', new \Doctrine\DBAL\Platforms\MySQL57Platform),
            array('VARCHAR(255)', new \Doctrine\DBAL\Platforms\MySqlPlatform),
            array('VARCHAR2(255)', new \Doctrine\DBAL\Platforms\OraclePlatform),
            array('VARCHAR(255)', new \Doctrine\DBAL\Platforms\PostgreSQL91Platform),
            array('VARCHAR(255)', new \Doctrine\DBAL\Platforms\PostgreSQL92Platform),
            array('VARCHAR(255)', new \Doctrine\DBAL\Platforms\PostgreSQLPlatform),
            array('VARCHAR(1)', new \Doctrine\DBAL\Platforms\SQLAnywhere11Platform),
            array('VARCHAR(1)', new \Doctrine\DBAL\Platforms\SQLAnywhere12Platform),
            array('VARCHAR(1)', new \Doctrine\DBAL\Platforms\SQLAnywhere16Platform),
            array('VARCHAR(1)', new \Doctrine\DBAL\Platforms\SQLAnywherePlatform),
            array('NVARCHAR(255)', new \Doctrine\DBAL\Platforms\SQLAzurePlatform),
            array('VARCHAR(255)', new \Doctrine\DBAL\Platforms\SqlitePlatform),
            array('NVARCHAR(255)', new \Doctrine\DBAL\Platforms\SQLServer2005Platform),
            array('NVARCHAR(255)', new \Doctrine\DBAL\Platforms\SQLServer2008Platform),
            array('NVARCHAR(255)', new \Doctrine\DBAL\Platforms\SQLServer2012Platform),
            array('NVARCHAR(255)', new \Doctrine\DBAL\Platforms\SQLServerPlatform),
        );
    }
} 