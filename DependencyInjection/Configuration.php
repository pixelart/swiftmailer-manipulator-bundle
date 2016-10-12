<?php

/*
 * This file is part of the pixelart Swiftmailer manipulator bundle.
 *
 * (c) pixelart GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pixelart\Bundle\SwiftmailerManipulatorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('pixelart_swiftmailer_manipulator');

        $rootNode
            ->beforeNormalization()
                ->ifTrue(function ($v) {
                    return is_array($v)
                        && count($v) > 0
                        && !array_key_exists('mailers', $v)
                        && !array_key_exists('mailer', $v)
                    ;
                })
                ->then(function (array $v) {
                    $mailer = [];
                    foreach ($v as $key => $value) {
                        $mailer[$key] = $v[$key];
                        unset($v[$key]);
                    }

                    $v['mailers'] = ['default' => $mailer];

                    return $v;
                })
            ->end()
            ->children()
                ->append($this->getMailersNode())
            ->end()
            ->fixXmlConfig('mailer')
        ;

        return $treeBuilder;
    }

    /**
     * Return the mailers node.
     *
     * @return ArrayNodeDefinition
     */
    private function getMailersNode()
    {
        $treeBuilder = new TreeBuilder();
        $node = $treeBuilder->root('mailers');

        $node
            ->requiresAtLeastOneElement()
            ->useAttributeAsKey('name')
                ->prototype('array')
            ->children()
                ->scalarNode('prepend_subject')
                    ->info('String which is prepended onto the subject')
                ->end()
                ->scalarNode('prepend_body')
                    ->info('Path to template which is prepended onto the mail body')
                ->end()
            ->end()
        ;

        return $node;
    }
}
