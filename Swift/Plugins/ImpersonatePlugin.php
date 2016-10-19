<?php

/*
 * This file is part of the pixelart Swiftmailer manipulator bundle.
 *
 * (c) pixelart GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pixelart\Bundle\SwiftmailerManipulatorBundle\Swift\Plugins;

/**
 * Allows changing sender's address before sending the message.
 *
 * @author Dejan Angelov <angelovdejan92@gmail.com>
 */
class ImpersonatePlugin implements \Swift_Events_SendListener
{
    /**
     * @var string
     */
    private $fromAddress;

    /**
     * @param string $fromAddress Address the message should be sent from
     */
    public function __construct($fromAddress)
    {
        $this->fromAddress = $fromAddress;
    }

    /**
     * @param \Swift_Events_SendEvent $event
     */
    public function beforeSendPerformed(\Swift_Events_SendEvent $event)
    {
        $message = $event->getMessage();
        $headers = $message->getHeaders();

        $headers->addMailboxHeader('X-Swift-From', $message->getFrom());

        $message->setFrom($this->fromAddress);
    }

    /**
     * @param \Swift_Events_SendEvent $event
     */
    public function sendPerformed(\Swift_Events_SendEvent $event)
    {
        $message = $event->getMessage();
        $headers = $message->getHeaders();

        $originalFrom = $headers->get('X-Swift-From')->getFieldBodyModel();

        $message->setFrom($originalFrom);
    }
}
