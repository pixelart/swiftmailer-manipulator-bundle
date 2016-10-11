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

    /**
     * @test
     */
    public function empty_configuration_is_empty()
    {
        $this->assertProcessedConfigurationEquals([
            [],
        ], [
            'mailers' => [],
        ]);
    }

    /**
     * @test
     */
    public function full_configuration_is_processed()
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

    /**
     * @test
     */
    public function one_mailer_is_processed()
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

    /**
     * @test
     */
    public function many_mailers_are_processed()
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
