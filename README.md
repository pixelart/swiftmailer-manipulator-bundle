Swiftmailer Manipulator for Symfony
===================================

Sometimes you have staging systems, where you can't install [MailHog] and
using `delivery_address` or `disable_delivery` on the SwiftmailerBundle is
not enough. For example your customer wants the mail to be really delivered.

But maybe the crafted mail goes to a partner, retailer, user, whatever and now
they are worried why they got them (for example notification systems).

This bundle can help you! It provides a plugin into Swiftmailer, which allows
you to modify every the subject or body of the mail before delivery.

Installation
------------

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require pixelart/swiftmailer-manipulator-bundle ^1.0@dev
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter][composer global install] of the Composer
documentation.

Step 2: Enable the Bundle
-------------------------

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

[MailHog]: https://github.com/mailhog/MailHog
[composer global install]: https://getcomposer.org/doc/00-intro.md
