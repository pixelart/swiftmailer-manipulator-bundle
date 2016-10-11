<?php

/*
 * This file is part of the PixelartSwiftmailerManipulatorBundle.
 *
 * (c) pixelart GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pixelart\Bundle\SwiftmailerManipulatorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('pixelart_swiftmailer_manipulator');

        return $treeBuilder;
    }
}
