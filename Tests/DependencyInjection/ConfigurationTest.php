<?php

/*
 * This file is part of the PixelartSwiftmailerManipulatorBundle.
 *
 * (c) pixelart GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DependencyInjection;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use Pixelart\Bundle\SwiftmailerManipulatorBundle\DependencyInjection\Configuration;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    use ConfigurationTestCaseTrait;

    public function testEmptyConfigurationIsEmpty()
    {
        $this->assertProcessedConfigurationEquals([
            [],
        ], [
            'mailers' => [],
        ]);
    }

    public function testFullConfigurationIsProcessed()
    {
        $this->assertProcessedConfigurationEquals([
            [
                'prepend_subject' => '[TESTSYSTEM!]',
                'prepend_body' => 'swiftmailer/prepend_body.txt.twig',
            ],
        ], [
            'mailers' => [
                'default' => [
                    'prepend_subject' => '[TESTSYSTEM!]',
                    'prepend_body' => 'swiftmailer/prepend_body.txt.twig',
                ],
            ],
        ]);
    }

    public function testOneMailerIsProcessed()
    {
        $this->assertProcessedConfigurationEquals([
            [
                'mailers' => [
                    'main_mailer' => [
                        'prepend_subject' => '[TESTSYSTEM!]',
                        'prepend_body' => 'swiftmailer/prepend_body.txt.twig',
                    ],
                ],
            ],
        ], [
            'mailers' => [
                'main_mailer' => [
                    'prepend_subject' => '[TESTSYSTEM!]',
                    'prepend_body' => 'swiftmailer/prepend_body.txt.twig',
                ],
            ],
        ]);
    }

    public function testManyMailersAreProcessed()
    {
        $this->assertProcessedConfigurationEquals([
            [
                'mailers' => [
                    'first_mailer' => [
                        'prepend_subject' => '[TESTSYSTEM 1!]',
                        'prepend_body' => 'swiftmailer/prepend_body_1.txt.twig',
                    ],
                    'secondary_mailer' => [
                        'prepend_subject' => '[TESTSYSTEM 2!]',
                        'prepend_body' => 'swiftmailer/prepend_body_2.txt.twig',
                    ],
                    'third_mailer' => [
                        'prepend_subject' => '[TESTSYSTEM 3!]',
                        'prepend_body' => 'swiftmailer/prepend_body_3.txt.twig',
                    ],
                ],
            ],
        ], [
            'mailers' => [
                'first_mailer' => [
                    'prepend_subject' => '[TESTSYSTEM 1!]',
                    'prepend_body' => 'swiftmailer/prepend_body_1.txt.twig',
                ],
                'secondary_mailer' => [
                    'prepend_subject' => '[TESTSYSTEM 2!]',
                    'prepend_body' => 'swiftmailer/prepend_body_2.txt.twig',
                ],
                'third_mailer' => [
                    'prepend_subject' => '[TESTSYSTEM 3!]',
                    'prepend_body' => 'swiftmailer/prepend_body_3.txt.twig',
                ],
            ],
        ]);
    }

    protected function getConfiguration()
    {
        return new Configuration();
    }
}
