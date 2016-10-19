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
                'from_address' => 'fake@example.com',
            ],
        ], [
            'mailers' => [
                'default' => [
                    'prepend_subject' => '[TESTSYSTEM!]',
                    'prepend_body' => 'swiftmailer/prepend_body.txt.twig',
                    'from_address' => 'fake@example.com',
                ],
            ],
        ]);
    }

    public function testSubjectOnlyIsProcessed()
    {
        $this->assertProcessedConfigurationEquals([
            [
                'prepend_subject' => '[TESTSYSTEM!]',
            ],
        ], [
            'mailers' => [
                'default' => [
                    'prepend_subject' => '[TESTSYSTEM!]',
                ],
            ],
        ]);
    }

    public function testFromAddressOnlyIsProceeded()
    {
        $this->assertProcessedConfigurationEquals([
            [
                'from_address' => 'fake@example.com',
            ],
        ], [
            'mailers' => [
                'default' => [
                    'from_address' => 'fake@example.com',
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
                        'from_address' => 'fake@example.com',
                    ],
                ],
            ],
        ], [
            'mailers' => [
                'main_mailer' => [
                    'prepend_subject' => '[TESTSYSTEM!]',
                    'prepend_body' => 'swiftmailer/prepend_body.txt.twig',
                    'from_address' => 'fake@example.com',
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
                        'from_address' => 'fake_1@example.com',
                    ],
                    'secondary_mailer' => [
                        'prepend_subject' => '[TESTSYSTEM 2!]',
                        'prepend_body' => 'swiftmailer/prepend_body_2.txt.twig',
                        'from_address' => 'fake_2@example.com',
                    ],
                    'third_mailer' => [
                        'prepend_subject' => '[TESTSYSTEM 3!]',
                        'prepend_body' => 'swiftmailer/prepend_body_3.txt.twig',
                        'from_address' => 'fake_3@example.com',
                    ],
                ],
            ],
        ], [
            'mailers' => [
                'first_mailer' => [
                    'prepend_subject' => '[TESTSYSTEM 1!]',
                    'prepend_body' => 'swiftmailer/prepend_body_1.txt.twig',
                    'from_address' => 'fake_1@example.com',
                ],
                'secondary_mailer' => [
                    'prepend_subject' => '[TESTSYSTEM 2!]',
                    'prepend_body' => 'swiftmailer/prepend_body_2.txt.twig',
                    'from_address' => 'fake_2@example.com',
                ],
                'third_mailer' => [
                    'prepend_subject' => '[TESTSYSTEM 3!]',
                    'prepend_body' => 'swiftmailer/prepend_body_3.txt.twig',
                    'from_address' => 'fake_3@example.com',
                ],
            ],
        ]);
    }

    protected function getConfiguration()
    {
        return new Configuration();
    }
}
