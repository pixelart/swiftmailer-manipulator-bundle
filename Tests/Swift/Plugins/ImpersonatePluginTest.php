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

use Pixelart\Bundle\SwiftmailerManipulatorBundle\Swift\Plugins\ImpersonatePlugin;
use Prophecy\Argument;

/**
 * @author Dejan Angelov <angelovdejan92@gmail.com>
 */
class ImpersonatePluginTest extends \PHPUnit_Framework_TestCase
{
    public function testImpersonatesSender()
    {
        $oldAddress = 'old@example.com';
        $newAddress = 'new@example.com';

        $message = $this->prepareMessage();
        $message->getFrom()->willReturn([$oldAddress]);

        $headers = $this->prophesize('\Swift_Mime_HeaderSet');
        $message->getHeaders()->willReturn($headers->reveal());

        $header = $this->prophesize('\Swift_Mime_Header');
        $header->getFieldBodyModel()->willReturn([$oldAddress]);

        $headers->addMailboxHeader('X-Swift-From', [$oldAddress])->will(function () use ($header) {
            $this->get('X-Swift-From')->willReturn($header->reveal());
        });

        $plugin = new ImpersonatePlugin($newAddress);

        $event = $this->prepareSendEvent($message->reveal());

        $plugin->beforeSendPerformed($event->reveal());
        self::assertSame([$newAddress], $message->reveal()->getFrom());

        $plugin->sendPerformed($event->reveal());
        self::assertSame([$oldAddress], $message->reveal()->getFrom());
    }

    public function testImpersonatesMultipleSenders()
    {
        $oldAddresses = ['old_1@example.com', 'old_2@example.com'];
        $newAddress = 'new@example.com';

        $message = $this->prepareMessage();
        $message->getFrom()->willReturn($oldAddresses);

        $headers = $this->prophesize('\Swift_Mime_HeaderSet');
        $message->getHeaders()->willReturn($headers->reveal());

        $header = $this->prophesize('\Swift_Mime_Header');
        $header->getFieldBodyModel()->willReturn($oldAddresses);

        $headers->addMailboxHeader('X-Swift-From', $oldAddresses)->will(function () use ($header) {
            $this->get('X-Swift-From')->willReturn($header->reveal());
        });

        $plugin = new ImpersonatePlugin($newAddress);

        $event = $this->prepareSendEvent($message->reveal());

        $plugin->beforeSendPerformed($event->reveal());
        self::assertSame([$newAddress], $message->reveal()->getFrom());

        $plugin->sendPerformed($event->reveal());
        self::assertSame($oldAddresses, $message->reveal()->getFrom());
    }

    private function prepareMessage()
    {
        $message = $this->prophesize('\Swift_Mime_Message');

        $message->setFrom(Argument::type('string'))->will(function ($args) {
            $this->getFrom()->willReturn([$args[0]]);
        });

        $message->setFrom(Argument::type('array'))->will(function ($args) {
            $this->getFrom()->willReturn($args[0]);
        });

        return $message;
    }

    private function prepareSendEvent($message)
    {
        $event = $this->prophesize('\Swift_Events_SendEvent');
        $event->getMessage()->willReturn($message);

        return $event;
    }
}
