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

use Swift_Events_SendEvent;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

/**
 * Allows manipulations of messages on-the-fly.
 */
final class ManipulatorPlugin implements \Swift_Events_SendListener
{
    /**
     * @var EngineInterface
     */
    private $templating;

    /**
     * @var string
     */
    private $prependSubject;

    /**
     * @var string
     */
    private $prependBodyTemplate;

    /**
     * @var string The original subject before manipulations
     */
    private $originalSubject;

    /**
     * @var string The original body before manipulations
     */
    private $originalBody;

    /**
     * @var \Swift_Mime_Message The message that was last replaced
     */
    private $lastMessage;

    /**
     * @param EngineInterface $templating
     * @param string          $prependSubject
     * @param string          $prependBodyTemplate
     */
    public function __construct(EngineInterface $templating, $prependSubject, $prependBodyTemplate)
    {
        $this->templating = $templating;
        $this->prependSubject = $prependSubject;
        $this->prependBodyTemplate = $prependBodyTemplate;
    }

    public function beforeSendPerformed(\Swift_Events_SendEvent $event)
    {
        $message = $event->getMessage();
        $this->restoreMessage($message);

        $this->prependSubject($message);
        $this->prependBodyWithTemplate($message);

        $this->lastMessage = $message;
    }

    /**
     * @param Swift_Events_SendEvent $event
     */
    public function sendPerformed(Swift_Events_SendEvent $event)
    {
        $this->restoreMessage($event->getMessage());
    }

    /**
     * @param \Swift_Mime_Message $message
     */
    private function prependSubject(\Swift_Mime_Message $message)
    {
        if (null !== $this->prependSubject) {
            $this->originalSubject = $message->getSubject();

            $message->setSubject(sprintf(
                '%s %s',
                $this->prependSubject,
                $this->originalSubject
            ));
        }
    }

    /**
     * @param \Swift_Mime_Message $message
     */
    private function prependBodyWithTemplate(\Swift_Mime_Message $message)
    {
        if (null !== $this->prependBodyTemplate) {
            $this->originalBody = $message->getBody();

            $message->setBody(sprintf(
                "%s\n\n---------------------------------------------------------------------------\n\n%s",
                $this->templating->render($this->prependBodyTemplate),
                $this->originalBody
            ));
        }
    }

    /**
     * Restore a changed message back to its original state.
     *
     * @param \Swift_Mime_Message $message
     */
    private function restoreMessage(\Swift_Mime_Message $message)
    {
        if ($this->lastMessage === $message) {
            if (null !== $this->originalSubject) {
                $message->setSubject($this->originalSubject);
                $this->originalSubject = null;
            }

            if (null !== $this->originalBody) {
                $message->setBody($this->originalBody);
                $this->originalBody = null;
            }

            $this->lastMessage = null;
        }
    }
}
