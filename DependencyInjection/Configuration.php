<?php

namespace R2K\FreeTermBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('r2k_free_term');
        
        $rootNode
            ->children()
                ->arrayNode('parameters')
                    ->children()
                        ->scalarNode('google_api_cred')->end()
                        ->scalarNode('google_calendar_id')->end()
                    ->end()
                ->end()
             ->end();
        
        return $treeBuilder;
    }
}