Swiftmailer Manipulator for Symfony
===================================

Sometimes you have staging systems, where you can't install [MailHog] and
using `delivery_address` or `disable_delivery` on the SwiftmailerBundle is
not enough. For example your customer wants the mail to be really delivered.

But maybe the crafted mail goes to a partner, retailer, user, whatever and now
they are worried why they got them (for example notification systems).

This bundle can help you! It provides a plugin into Swiftmailer, which allows
you to modify every the subject or body of the mail before delivery.

[MailHog]: https://github.com/mailhog/MailHog
