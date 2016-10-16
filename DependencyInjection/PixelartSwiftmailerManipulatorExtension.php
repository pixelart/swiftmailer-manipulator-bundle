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

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class PixelartSwiftmailerManipulatorExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        foreach ($config['mailers'] as $name => $mailer) {
            $this->configureMailer($name, $mailer, $container);
        }
    }

    /**
     * @param string           $name      The mailer name
     * @param array            $mailer    The mailer configuration
     * @param ContainerBuilder $container The container builder
     */
    private function configureMailer($name, array $mailer, ContainerBuilder $container)
    {
        $this->configureMailerManipulator($name, $mailer, $container);
    }

    /**
     * @param string           $name      The mailer name
     * @param array            $mailer    The mailer configuration
     * @param ContainerBuilder $container The container builder
     */
    private function configureMailerManipulator($name, array $mailer, ContainerBuilder $container)
    {
        if (!empty($mailer['prepend_subject']) || !empty($mailer['prepend_body'])) {
            $container->setParameter(
                sprintf('pixelart_swiftmailer_manipulator.mailer.%s.manipulator.prepend_subject', $name),
                !empty($mailer['prepend_subject']) ? $mailer['prepend_subject'] : null
            );
            $container->setParameter(
                sprintf('pixelart_swiftmailer_manipulator.mailer.%s.manipulator.prepend_body', $name),
                !empty($mailer['prepend_body']) ? $mailer['prepend_body'] : null
            );

            $definitionDecorator = new DefinitionDecorator(
                'pixelart_swiftmailer_manipulator.plugin.manipulator.abstract'
            );

            $container
                ->setDefinition(
                    sprintf('pixelart_swiftmailer_manipulator.mailer.%s.plugin.manipulator', $name),
                    $definitionDecorator
                )
                ->addArgument(
                    sprintf('%%pixelart_swiftmailer_manipulator.mailer.%s.manipulator.prepend_subject%%', $name)
                )
                ->addArgument(
                    sprintf('%%pixelart_swiftmailer_manipulator.mailer.%s.manipulator.prepend_body%%', $name)
                )
            ;

            $container
                ->getDefinition(sprintf('pixelart_swiftmailer_manipulator.mailer.%s.plugin.manipulator', $name))
                ->addTag(sprintf('swiftmailer.%s.plugin', $name))
            ;
        }
    }
}
