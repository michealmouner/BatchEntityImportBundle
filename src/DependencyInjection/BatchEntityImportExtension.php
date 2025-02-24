<?php

declare(strict_types=1);

namespace JG\BatchEntityImportBundle\DependencyInjection;

use Exception;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class BatchEntityImportExtension extends Extension
{
    /**
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yaml');

        $this->setParameters($configs, $container);
    }

    private function setParameters(array $configs, ContainerBuilder $container): void
    {
        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $templates = $config['templates'];
        $container->setParameter('batch_entity_import.templates', $templates);
        $container->setParameter('batch_entity_import.templates.select_file', $templates['select_file']);
        $container->setParameter('batch_entity_import.templates.edit_matrix', $templates['edit_matrix']);
        $container->setParameter('batch_entity_import.templates.layout', $templates['layout']);
    }
}
