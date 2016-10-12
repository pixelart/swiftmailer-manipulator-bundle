<?php

/*
 * This file is part of the pixelart Swiftmailer manipulator bundle.
 *
 * (c) pixelart GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pixelart\Bundle\SwiftmailerManipulatorBundle\Tests\Swift\Plugins;

use Pixelart\Bundle\SwiftmailerManipulatorBundle\Swift\Plugins\ManipulatorPlugin;
use Prophecy\Argument;

class ManipulatorPluginTest extends \PHPUnit_Framework_TestCase
{
    public function testPrependsSubject()
    {
        $message = $this->prophesize('Swift_Mime_Message')
            ->willBeConstructedWith([
                'Notification Alert',
                '...',
            ])
        ;

        $message->getSubject()->willReturn('Notification Alert');
        $message->setSubject(Argument::type('string'))->will(function ($args) {
            $this->getSubject()->willReturn($args[0]);
        });

        $plugin = new ManipulatorPlugin(
            $this->prophesize('Symfony\Bundle\FrameworkBundle\Templating\EngineInterface')->reveal(),
            '[TESTSYSTEM!]',
            null
        );

        $event = $this->prophesize('Swift_Events_SendEvent');
        $event->getMessage()->willReturn($message->reveal());

        $plugin->beforeSendPerformed($event->reveal());
        self::assertSame('[TESTSYSTEM!] Notification Alert', $message->reveal()->getSubject());

        $plugin->sendPerformed($event->reveal());
        self::assertSame('Notification Alert', $message->reveal()->getSubject());
    }

    public function testPrependsBody()
    {
        $message = $this->prophesize('Swift_Mime_Message')
            ->willBeConstructedWith([
                '...',
                'This is a notification',
            ])
        ;

        $message->getBody()->willReturn('This is a notification');
        $message->setBody(Argument::type('string'))->will(function ($args) {
            $this->getBody()->willReturn($args[0]);
        });

        $templating = $this->prophesize('Symfony\Bundle\FrameworkBundle\Templating\EngineInterface');
        $templating->render('swiftmailer/prepend_body.txt.twig')
            ->willReturn('This is a message from our testsystem!')
        ;

        $plugin = new ManipulatorPlugin(
            $templating->reveal(),
            null,
            'swiftmailer/prepend_body.txt.twig'
        );

        $event = $this->prophesize('Swift_Events_SendEvent');
        $event->getMessage()->willReturn($message->reveal());

        $plugin->beforeSendPerformed($event->reveal());
        $templating->render('swiftmailer/prepend_body.txt.twig')->shouldHaveBeenCalled();

        $expected = <<<'EOT'
This is a message from our testsystem!

---------------------------------------------------------------------------

This is a notification
EOT;

        self::assertSame($expected, $message->reveal()->getBody());

        $plugin->sendPerformed($event->reveal());
        self::assertSame('This is a notification', $message->reveal()->getBody());
    }
}
