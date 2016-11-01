Swiftmailer Manipulator for Symfony
===================================

[![Build Status](https://travis-ci.org/pixelart/swiftmailer-manipulator-bundle.svg?branch=master)](https://travis-ci.org/pixelart/swiftmailer-manipulator-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pixelart/swiftmailer-manipulator-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pixelart/swiftmailer-manipulator-bundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/pixelart/swiftmailer-manipulator-bundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/pixelart/swiftmailer-manipulator-bundle/?branch=master)
[![Code Style](https://styleci.io/repos/70606516/shield?style=flat)](https://styleci.io/repos/70606516)

Sometimes you have staging systems, where you can't install [MailHog] and
using `delivery_address` or `disable_delivery` on the SwiftmailerBundle is
not enough. For example your customer wants the mail to be really delivered.

But maybe the crafted mail goes to a partner, retailer, user, whatever and now
they are worried why they got them (for example notification systems).

This bundle can help you! It provides a plugin into Swiftmailer, which allows
you to modify the subject or body or the from address of every message before
delivery.

Installation
------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require pixelart/swiftmailer-manipulator-bundle ^1.0
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter][composer global install] of the Composer
documentation.

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Pixelart\Bundle\SwiftmailerManipulatorBundle\PixelartSwiftmailerManipulatorBundle(),
        );

        // ...
    }

    // ...
}
```

For more informations, see the [configuration page](Resources/doc/configuration.md).

Full configuration options
--------------------------

```yaml
# app/config/config.yml

pixelart_swiftmailer_manipulator:
    mailers:
        first_mailer:
            prepend_subject: 'String prepend to subject'  # String which is prepended onto the subject
            prepend_body: 'path/to/prepend_body.txt.twig' # Path to template which is prepended onto the mail body
            from_address: 'altered-form@example.com'      # The address message should be sent from
        second_mailer:
            # ...
```


Contributing
------------

The [contributing](CONTRIBUTING.md) guidelines contains all the information
about contributing to the bundle.

Bug tracking
------------

We use [GitHub issues](https://github.com/pixelart/swiftmailer-manipulator-bundle/issues)
and [waffle.io board](https://waffle.io/pixelart/swiftmailer-manipulator-bundle)
to track issues. If you have found bug, please create an issue.

MIT License
-----------

License can be found [here](LICENSE).

Code of Conduct
---------------

This project adheres to the Contributor Covenant [code of conduct](CODE_OF_CONDUCT.md).
By participating, you are expected to uphold this code.

[MailHog]: https://github.com/mailhog/MailHog
[composer global install]: https://getcomposer.org/doc/00-intro.md
