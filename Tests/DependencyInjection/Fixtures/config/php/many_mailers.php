<?php

/**
 * This file is part of the pixelart Swiftmailer manipulator bundle.
 *
 * (c) pixelart GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$container->loadFromExtension('pixelart_swiftmailer_manipulator', [
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
