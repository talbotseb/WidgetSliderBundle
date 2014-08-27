<?php

namespace Victoire\Widget\SliderBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('victoire_widget_slider');
        $rootNode
            ->children()
                ->scalarNode('name')->defaultValue('widgetslider')->end()
                ->scalarNode('widgetName')->defaultValue('Slider')->end()
            ->end()
            // Here you should define the parameters that are allowed to configure your bundle.
        ;

        return $treeBuilder;
    }
}