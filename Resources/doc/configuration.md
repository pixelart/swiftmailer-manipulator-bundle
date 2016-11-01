# Configure the Bundle

Now, configure your wanted manipulations. You have the option to prepend
the subject with an string, to prepend the body with the content of a
template or change the message's from address.

If you are using the default swiftmailer configuration, the config is:

```yaml
# app/config/config.yml

pixelart_swiftmailer_manipulator:
    prepend_subject: '[TESTSYSTEM!]'
    prepend_body: 'swiftmailer/prepend_body.txt.twig'
    from_address: 'impersonated@example.com'
```

The bundle supports multiple swiftmailer mailers too. You only need to add
the mailers you want to manipulate. For example if you have three configured
mailers, `first_mailer`, `secondary_mailer` and `third_mailer`, but you don't
want to prepend `third_mailer`:

```yaml
# app/config/config.yml

pixelart_swiftmailer_manipulator:
    mailers:
        first_mailer:
            prepend_subject: '[TESTSYSTEM 1!]'
            prepend_body: 'swiftmailer/prepend_body_1.txt.twig'
        secondary_mailer:
            prepend_subject: '[TESTSYSTEM 2!]'
            prepend_body: 'swiftmailer/prepend_body_2.txt.twig'
```
