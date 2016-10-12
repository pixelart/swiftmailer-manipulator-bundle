<?php

/*
 * This file is part of the pixelart Swiftmailer manipulator bundle.
 *
 * (c) pixelart GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$container->loadFromExtension('pixelart_swiftmailer_manipulator', [
    'mailers' => [
        'main_mailer' => [
            'prepend_subject' => '[TESTSYSTEM!]',
            'prepend_body' => 'swiftmailer/prepend_body.txt.twig',
        ],
    ],
]);
