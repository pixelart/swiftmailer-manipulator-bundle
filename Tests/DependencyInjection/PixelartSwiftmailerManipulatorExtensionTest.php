<?php

/*
 * This file is part of the pixelart Swiftmailer manipulator bundle.
 *
 * (c) pixelart GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DependencyInjection;

use Pixelart\Bundle\SwiftmailerManipulatorBundle\DependencyInjection\PixelartSwiftmailerManipulatorExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class PixelartSwiftmailerManipulatorExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function getConfigTypes()
    {
        return [
            ['php'],
            ['yml'],
        ];
    }

    /**
     * @dataProvider getConfigTypes
     * @expectedException \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     */
    public function testManipulatorPluginFromEmptyConfig($type)
    {
        $container = $this->loadContainerFromFile('empty', $type);

        $container->get('pixelart_swiftmailer_manipulator.mailer.default.plugin.manipulator');
    }

    /**
     * @dataProvider getConfigTypes
     * @expectedException \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     */
    public function testImpersonatePluginFromEmptyConfig($type)
    {
        $container = $this->loadContainerFromFile('empty', $type);

        $container->get('pixelart_swiftmailer_manipulator.mailer.default.plugin.impersonate');
    }

    /**
     * @dataProvider getConfigTypes
     */
    public function testFull($type)
    {
        $container = $this->loadContainerFromFile('full', $type);

        self::assertSame(
            ['swiftmailer.default.plugin' => [[]]],
            $container->getDefinition('pixelart_swiftmailer_manipulator.mailer.default.plugin.manipulator')->getTags()
        );

        self::assertSame(
            ['swiftmailer.default.plugin' => [[]]],
            $container->getDefinition('pixelart_swiftmailer_manipulator.mailer.default.plugin.impersonate')->getTags()
        );

        self::assertSame(
            '[TESTSYSTEM!]',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.default.manipulator.prepend_subject')
        );

        self::assertSame(
            'swiftmailer/prepend_body.txt.twig',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.default.manipulator.prepend_body')
        );

        self::assertSame(
            'fake@example.com',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.default.impersonate.from_address')
        );
    }

    /**
     * @dataProvider getConfigTypes
     */
    public function testSubjectOnly($type)
    {
        $container = $this->loadContainerFromFile('subject_only', $type);

        self::assertSame(
            ['swiftmailer.default.plugin' => [[]]],
            $container->getDefinition('pixelart_swiftmailer_manipulator.mailer.default.plugin.manipulator')->getTags()
        );

        self::assertSame(
            '[TESTSYSTEM!]',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.default.manipulator.prepend_subject')
        );

        self::assertNull($container->getParameter('pixelart_swiftmailer_manipulator.mailer.default.manipulator.prepend_body'));
    }

    /**
     * @dataProvider getConfigTypes
     */
    public function testFromAddressOnly($type)
    {
        $container = $this->loadContainerFromFile('from_address_only', $type);

        self::assertSame(
            ['swiftmailer.default.plugin' => [[]]],
            $container->getDefinition('pixelart_swiftmailer_manipulator.mailer.default.plugin.impersonate')->getTags()
        );

        self::assertSame(
            'fake@example.com',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.default.impersonate.from_address')
        );
    }

    /**
     * @dataProvider getConfigTypes
     */
    public function testOneMailer($type)
    {
        $container = $this->loadContainerFromFile('one_mailer', $type);

        self::assertSame(
            ['swiftmailer.main_mailer.plugin' => [[]]],
            $container->getDefinition('pixelart_swiftmailer_manipulator.mailer.main_mailer.plugin.manipulator')->getTags()
        );

        self::assertSame(
            ['swiftmailer.main_mailer.plugin' => [[]]],
            $container->getDefinition('pixelart_swiftmailer_manipulator.mailer.main_mailer.plugin.impersonate')->getTags()
        );

        self::assertSame(
            '[TESTSYSTEM!]',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.main_mailer.manipulator.prepend_subject')
        );

        self::assertSame(
            'swiftmailer/prepend_body.txt.twig',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.main_mailer.manipulator.prepend_body')
        );

        self::assertSame(
            'fake@example.com',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.main_mailer.impersonate.from_address')
        );
    }

    /**
     * @dataProvider getConfigTypes
     */
    public function testManyMailers($type)
    {
        $container = $this->loadContainerFromFile('many_mailers', $type);

        // first mailer
        self::assertSame(
            ['swiftmailer.first_mailer.plugin' => [[]]],
            $container->getDefinition('pixelart_swiftmailer_manipulator.mailer.first_mailer.plugin.manipulator')->getTags()
        );

        self::assertSame(
            ['swiftmailer.first_mailer.plugin' => [[]]],
            $container->getDefinition('pixelart_swiftmailer_manipulator.mailer.first_mailer.plugin.impersonate')->getTags()
        );

        self::assertSame(
            '[TESTSYSTEM 1!]',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.first_mailer.manipulator.prepend_subject')
        );

        self::assertSame(
            'swiftmailer/prepend_body_1.txt.twig',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.first_mailer.manipulator.prepend_body')
        );

        self::assertSame(
            'fake_1@example.com',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.first_mailer.impersonate.from_address')
        );

        // second mailer
        self::assertSame(
            ['swiftmailer.secondary_mailer.plugin' => [[]]],
            $container->getDefinition('pixelart_swiftmailer_manipulator.mailer.secondary_mailer.plugin.manipulator')->getTags()
        );

        self::assertSame(
            ['swiftmailer.secondary_mailer.plugin' => [[]]],
            $container->getDefinition('pixelart_swiftmailer_manipulator.mailer.secondary_mailer.plugin.impersonate')->getTags()
        );

        self::assertSame(
            '[TESTSYSTEM 2!]',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.secondary_mailer.manipulator.prepend_subject')
        );

        self::assertSame(
            'swiftmailer/prepend_body_2.txt.twig',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.secondary_mailer.manipulator.prepend_body')
        );

        self::assertSame(
            'fake_2@example.com',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.secondary_mailer.impersonate.from_address')
        );

        // third mailer
        self::assertSame(
            ['swiftmailer.third_mailer.plugin' => [[]]],
            $container->getDefinition('pixelart_swiftmailer_manipulator.mailer.third_mailer.plugin.manipulator')->getTags()
        );

        self::assertSame(
            ['swiftmailer.third_mailer.plugin' => [[]]],
            $container->getDefinition('pixelart_swiftmailer_manipulator.mailer.third_mailer.plugin.impersonate')->getTags()
        );

        self::assertSame(
            '[TESTSYSTEM 3!]',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.third_mailer.manipulator.prepend_subject')
        );

        self::assertSame(
            'swiftmailer/prepend_body_3.txt.twig',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.third_mailer.manipulator.prepend_body')
        );

        self::assertSame(
            'fake_3@example.com',
            $container->getParameter('pixelart_swiftmailer_manipulator.mailer.third_mailer.impersonate.from_address')
        );
    }

    /**
     * @param string $file
     * @param string $type
     *
     * @return ContainerBuilder
     */
    private function loadContainerFromFile($file, $type)
    {
        $container = new ContainerBuilder();

        $container->setParameter('kernel.debug', false);
        $container->setParameter('kernel.cache_dir', '/tmp');

        $container->registerExtension(new PixelartSwiftmailerManipulatorExtension());
        $locator = new FileLocator(__DIR__.'/Fixtures/config/'.$type);

        switch ($type) {
            case 'yml':
                $loader = new YamlFileLoader($container, $locator);
                break;

            case 'php':
                $loader = new PhpFileLoader($container, $locator);
                break;

            default:
                throw new \InvalidArgumentException(sprintf('Unexpected loader format "%s"', $type));
        }

        $loader->load($file.'.'.$type);

        $container->getCompilerPassConfig()->setOptimizationPasses([]);
        $container->getCompilerPassConfig()->setRemovingPasses([]);
        $container->compile();

        return $container;
    }
}
