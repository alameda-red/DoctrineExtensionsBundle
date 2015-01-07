<?php

namespace Alameda\Bundle\DoctrineExtensionsBundle\Tests\DependencyInjection;

use Alameda\Bundle\DoctrineExtensionsBundle\DependencyInjection\AlamedaDoctrineExtensionsExtension;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\DoctrineExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 * @package Alameda\Bundle\DoctrineExtensionsBundle\Tests\DependencyInjection
 */
class AlamedaDoctrineExtensionsExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions()
    {
        return array(new AlamedaDoctrineExtensionsExtension());
    }

    public function testLoad()
    {
        $this->load();
    }

    public function testPrependWithoutDoctrineBundle()
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.bundles', array());

        $extension = new AlamedaDoctrineExtensionsExtension();
        $extension->prepend($container);

        // get an array('orm' => ..., 'dbal' => ...)
        $configs = $container->getExtensionConfig('doctrine');

        $this->assertInternalType('array', $configs);
        $this->assertCount(0, $configs);

        $this->assertArrayNotHasKey('orm', $configs);
        $this->assertArrayNotHasKey('dbal', $configs);
    }

    public function testPrependWithDoctrineBundle()
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.bundles', array('DoctrineBundle' => true));
        $container->registerExtension(new DoctrineExtension());

        $extension = new AlamedaDoctrineExtensionsExtension();
        $extension->prepend($container);

        // get an array('orm' => ..., 'dbal' => ...)
        $configs = call_user_func_array('array_merge', $container->getExtensionConfig('doctrine'));

        $this->assertArrayHasKey('orm', $configs);
        $this->assertArrayHasKey('dql', $configs['orm']);
        $this->assertArrayHasKey('numeric-function', $configs['orm']['dql']);

        $numeric_functions = self::getDqlNumericFunctions();

        $this->assertCount(count($numeric_functions), $configs['orm']['dql']['numeric-function']);

        foreach ($configs['orm']['dql']['numeric-function'] as $data) {
            $this->assertTrue(in_array($data['name'], $numeric_functions));
        }

        $this->assertArrayHasKey('dbal', $configs);
        $this->assertArrayHasKey('type', $configs['dbal']);

        $types = self::getDbalTypes();

        $this->assertCount(count($types), $configs['dbal']['type']);

        foreach ($configs['dbal']['type'] as $data) {
            $this->assertTrue(in_array($data['name'], $types));
        }
    }

    private static function getDqlNumericFunctions()
    {
        return array(
            'acos', // math
            'acosh',
            'asin',
            'asinh',
            'atan',
            'atan2',
            'atanh',
            'cos',
            'cosh',
            'degrees',
            'pow',
            'radians',
            'sin',
            'sinh',
            'tan',
            'tanh',
            'alameda_geo_distance', // geo
        );
    }

    private static function getDbalTypes()
    {
        return array(
            'dateinterval',
            'timestamp',
        );
    }
}