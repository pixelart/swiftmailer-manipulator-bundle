# Contributing

:+1::tada: First off, thanks for taking the time to contribute! :tada::+1:

The following is a set of guidelines for contributing.
These are just guidelines, not rules. Use your best judgment, and feel free to
propose changes to this document in a pull request.

#### Table Of Contents

[What should I know before I get started?](#what-should-i-know-before-i-get-started)
  * [Project Board](#project-board)
  * [License](#license)

[How Can I Contribute?](#how-can-i-contribute)
  * [Reporting Bugs](#reporting-bugs)
  * [Suggesting Enhancements](#suggesting-enhancements)
  * [Your First Code Contribution](#your-first-code-contribution)
  * [Pull Requests](#pull-requests)

[Styleguides](#styleguides)
  * [Git Commit Messages](#git-commit-messages)
  * [Coding Styleguide](#coding-styleguide)
  * [Code Documentation Styleguide](#code-documentation-styleguide)

[Additional Notes](#additional-notes)
  * [Issue and Pull Request Labels](#issue-and-pull-request-labels)

## What should I know before I get started?

### Code of Conduct

This project adheres to the Contributor Covenant [code of conduct](CODE_OF_CONDUCT.md).
By participating, you are expected to uphold this code.
Please report unacceptable behavior to [p.karisch@pixelart.at](mailto:p.karisch@pixelart.at).

### Project Board

Although we use [GitHub issues](https://github.com/pixelart/swiftmailer-manipulator-bundle/issues)
to track our issues we are using a [waffle.io board](https://waffle.io/pixelart/swiftmailer-manipulator-bundle)
to have a visual overview over all issues and pull request. And it helps us to
automate some state changes. Feel free to look into the board to get a feeling.

### License

This projects adheres to the [MIT license](LICENSE).
By participating, you are expected to license your contributions within the
same license and you are allowed to make your contributions under this license.

## How Can I Contribute?

### Reporting Bugs

This section guides you through submitting a bug report. Following these
guidelines helps maintainers and the community understand your report
:pencil:, reproduce the behavior :computer: :computer:, and find related
reports :mag_right:.

Before creating bug reports, please [do a search](https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aissue)
as you might find out that you don't need to create one. When you are creating
a bug report, please include as many details as possible and please fill out
the represented template to you accordingly.

Include details about your configuration and environment:

* **Which version of this project are you using?** (`pixelart/swiftmailer-manipulator-bundle`)
* **Which Symfony version are you using?** (`symfony/symfony`)
* **Which SwiftmailerBundle version are you using?** (`symfony/swiftmailer-bundle`)
* **Which Swiftmailer version are you using?** (`swiftmailer/swiftmailer`)

You can get the exact versions by running `composer show` in your terminal
and looking for the packages mentioned within the parenthesis above.

### Suggesting Enhancements

This section guides you through submitting an enhancement suggestion, including
completely new features and minor improvements to existing functionality.
Following these guidelines helps maintainers and the community understand
your suggestion :pencil: and find related suggestions :mag_right:.

Before creating enhancement suggestions, please check [do a search](https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aissue)
as you might find out that you don't need to create one. When you are creating
an feature or enhancement suggestion, please include as many details as possible
and please fill out the represented template to you accordingly.

### Your First Code Contribution

Unsure where to begin contributing? You can start by looking through these
`easy pick` and `help wanted` issues:

* [Easy pick issues][search-label-easy-pick] - issues which should only require a few lines
  of code, and a test or two.
* [Help wanted issues][search-label-help-wanted] - issues which should be a bit more
  involved than `easy pick` issues.

Both issue lists are sorted by total number of comments. While not perfect,
number of comments is a reasonable proxy for impact a given change will have.

### Pull Requests

* Include screenshots and animated GIFs in your pull request whenever possible.
* Follow the [Coding Styleguide](#coding-styleguide).
* Document new code based on the [Code Documentation Styleguide](#code-documentation-styleguide)
* Include well-structured [PHPUnit](https://phpunit.de/) tests in the `./Tests`
  folder. Run them using `vendor/bin/phpunit`.
* Please fill out the presented pull request template accordingly.

## Styleguides

### Git Commit Messages

* Use the present tense ("Add feature" not "Added feature")
* Use the imperative mood ("Move cursor to..." not "Moves cursor to...")
* Limit the first line to 72 characters or less
* Reference issues and pull requests liberally
* When only changing documentation, include `[ci skip]` in the commit description
* Consider starting the commit message with an applicable emoji:
    * :art: `:art:` when improving the format/structure of the code
    * :racehorse: `:racehorse:` when improving performance
    * :non-potable_water: `:non-potable_water:` when plugging memory leaks
    * :memo: `:memo:` when writing docs
    * :bug: `:bug:` when fixing a bug
    * :fire: `:fire:` when removing code or files
    * :green_heart: `:green_heart:` when fixing the CI build
    * :white_check_mark: `:white_check_mark:` when adding tests
    * :lock: `:lock:` when dealing with security
    * :arrow_up: `:arrow_up:` when upgrading dependencies
    * :arrow_down: `:arrow_down:` when downgrading dependencies
    * :shirt: `:shirt:` when removing cs fixer errors

### Coding Styleguide

All PHP code must adhere to [Symfony Coding Standard](https://symfony.com/doc/current/contributing/code/standards.html).

* Prefer the short array syntax `[ ]` over the long array syntax `array( )`
* Use `vendor/bin/php-cs-fixer fix -v` before committing your code.

### Code Documentation Styleguide

* Use [PHDoc](https://www.phpdoc.org/docs/latest/references/phpdoc/index.html).
* Document every parameter, return type and possible exceptions.
* Format according the [Symfony Coding Standard](https://symfony.com/doc/current/contributing/code/standards.html).
* Please take use of `{@inheritdoc}`.

## Additional Notes

### Issue and Pull Request Labels

This section lists the labels we use to help us track and manage issues and
pull requests. 

[GitHub search](https://help.github.com/articles/searching-issues/) makes it
easy to use labels for finding groups of issues or pull requests you're
interested in. 

The labels are loosely grouped by their purpose, but it's not required that
every issue have a label from every group or that an issue can't have more
than one label from the same group.

Please open an issue  if you have suggestions for new labels, and if you notice
some labels are missing, then please open an issue too.

#### Type of Issue and Issue State

| Label name | :mag_right: | Description |
| --- | --- | --- |
| `feature` | [search][search-label-feature] | Feature requests. |
| `enhancement` | [search][search-label-enhancement] | Improvement requests. |
| `optimization` | [search][search-label-optimization] | Optimization requests, e.g. performance, better syntax, etc. |
| `bug` | [search][search-label-bug] | Confirmed bugs or reports that are very likely to be bugs. |
| `question` | [search][search-label-question] | Questions more than bug reports or feature requests (e.g. how do I do X). |
| `feedback` | [search][search-label-feedback] | General feedback more than bug reports or feature requests. |
| `help wanted` | [search][search-label-help-wanted] | The Atom core team would appreciate help from the community in resolving these issues. |
| `easy pick` | [search][search-label-easy-pick] | Less complex issues which would be good first issues to work on for users who want to contribute. |
| `more information needed` | [search][search-label-more-information-needed] | More information needs to be collected about these problems or feature requests (e.g. steps to reproduce). |
| `needs reproduction` | [search][search-label-needs-reproduction] | Likely bugs, but haven't been reliably reproduced. |
| `backlog` | [search][search-label-backlog] | Issues which are are planned to start work on. |
| `in progress` | [search][search-label-in-progress] | Issues which are currently worked on. |
| `blocked` | [search][search-label-blocked] | Issues blocked on other issues. |
| `duplicate` | [search][search-label-duplicate] | Issues which are duplicates of other issues, i.e. they have been reported before. |
| `wontfix` | [search][search-label-wontfix] | The core team has decided not to fix these issues for now, either because they're working as intended or for some other reason. |
| `invalid` | [search][search-label-invalid] | Issues which aren't valid (e.g. user errors). |

#### Topic Categories

| Label name | :mag_right: | Description |
| --- | --- | --- |
| `docs` | [search][search-label-docs] | Related to any type of documentation. |
| `plugin: manipulator` | [search][search-label-plugin-manipulator] | Related to the manipulator plugin. |
| `plugin: impersonate` | [search][search-label-plugin-impersonate] | Related to the impersonate plugin. |

#### Pull Request Labels

| Label name | :mag_right: | Description
| --- | --- | --- |
| `in-progress` | [search][search-label-pr-in-progress] | Pull requests which are still being worked on, more changes will follow. |
| `in-review` | [search][search-label-pr-in-review] | Pull requests which need or are under code review, and approval from maintainers. |

[search-label-feature]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3Afeature
[search-label-enhancement]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3Aenhancement
[search-label-optimization]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3Aoptimization
[search-label-bug]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3Abug
[search-label-question]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3Aquestion
[search-label-feedback]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3Afeedback
[search-label-help-wanted]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3A"help+wanted"
[search-label-easy-pick]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3A"easy+pick"
[search-label-more-information-needed]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3A"more+information+needed"
[search-label-needs-reproduction]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3A"needs+reproduction"
[search-label-backlog]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3Abacklog
[search-label-in-progress]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3A"in+progress"
[search-label-blocked]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3Ablocked
[search-label-duplicate]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3Aduplicate
[search-label-wontfix]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3Awontfix
[search-label-invalid]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3Ainvalid
[search-label-docs]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3Adocs
[search-label-plugin-manipulator]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3A"plugin%3A+manipulator"
[search-label-plugin-impersonate]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3A"plugin%3A+impersonate"
[search-label-pr-in-progress]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3A"in+progress"
[search-label-pr-in-review]: https://github.com/pixelart/swiftmailer-manipulator-bundle/issues?q=is%3Aopen+is%3Aissue+label%3A"in+review"
