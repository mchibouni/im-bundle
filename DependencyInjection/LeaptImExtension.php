<?php

namespace Leapt\ImBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 *
 * @codeCoverageIgnore
 */
class LeaptImExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('leapt_im.formats', $config['formats']);
        $container->setParameter('leapt_im.web_path', $config['web_path']);
        $container->setParameter('leapt_im.cache_path', $config['cache_path']);
        $container->setParameter('leapt_im.timeout', $config['timeout']);
        $container->setParameter('leapt_im.binary_path', $config['binary_path']);
    }
}