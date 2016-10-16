<?php

/*
 * This file is part of the pixelart Swiftmailer manipulator bundle.
 *
 * (c) pixelart GmbH
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

$finder = Symfony\CS\Finder::create()
    ->exclude('vendor')
    ->in(__DIR__)
;

$header = <<<EOF
This file is part of the pixelart Swiftmailer manipulator bundle.

(c) pixelart GmbH

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

Symfony\CS\Fixer\Contrib\HeaderCommentFixer::setHeader($header);

return Symfony\CS\Config::create()
    ->fixers([
        'combine_consecutive_unsets',
        'header_comment',
        'no_useless_else',
        'no_useless_return',
        'ordered_use',
        'php_unit_construct',
        'php_unit_dedicate_assert',
        'php_unit_strict',
        'phpdoc_order',
        'short_array_syntax',
        'silenced_deprecation_error',
        'strict',
        'strict_param',
    ])
    ->finder($finder)
    ->setUsingCache(true)
;
