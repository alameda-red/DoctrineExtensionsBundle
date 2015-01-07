<?php

namespace Alameda\Bundle\DoctrineExtensionsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * @author Sebastian Kuhlmann <zebba@hotmail.de>
 */
class AlamedaDoctrineExtensionsExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
    }

    /**
     * {@inheritDoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        if (isset($bundles['DoctrineBundle'])) {
            $configs = $container->getExtensionConfig($this->getAlias());
            $config = $this->processConfiguration(new Configuration(), $configs);

            $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/Doctrine'));
            $loader->load('dql.xml');
            $loader->load('types.xml');

            $container->prependExtensionConfig('doctrine', $config);
        }
    }
}
