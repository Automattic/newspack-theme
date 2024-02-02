# Contributing to Newspack ✨

Hi! Thank you for your interest in contributing to Newspack!

These guidelines explain how the contribution process works. Following these guidelines helps to communicate that you respect the time of the developers managing and developing this open source project. In return, we will reciprocate that respect in addressing your issue, assessing changes, and helping you finalize your pull requests.

There are many ways to contribute – reporting bugs, fixing or triaging bugs, feature suggestions, submitting pull requests for enhancements, improving the documentation. Your help making Newspack awesome will be greatly appreciated.

**Please don't use the issue tracker for support questions or general inquiries. We are not currently looking for plugins or services to recommend within Newspack.**

## Bug reports

**[To disclose a security issue to our team, please submit a report via HackerOne here.](https://hackerone.com/automattic)**

To report a bug, please [open a new issue](https://github.com/Automattic/newspack-theme/issues/new?template=Bug_report.md). In order for us to better understand and reproduce the bug, please include as much of the following information as possible:

- Steps to reproduce the issue.
- What you expected to happen.
- What actually happened.
- Details about your environment (WordPress version, Newspack version, PHP version, etc.)
- Screenshots if applicable.
- URL of the site experiencing the issue.

The more information you include, the better we can reproduce and fix the issue.

## Feature requests

Feature requests can be [submitted to our issue tracker](https://github.com/Automattic/newspack-theme/issues/new?template=Feature_request.md). Be sure to include a description of the expected behavior and use case, and before submitting a request, please search for similar ones in the closed issues.

## Pull requests

To submit a patch to the Newspack theme, simply create a pull request to the trunk branch of the Newspack theme repository. Please test and provide an explanation for your changes. When opening a pull request, please follow these guidelines:

- **Ensure you stick to the [WordPress Coding Standards](https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/) and the [VIP Go Coding Standards](https://vip.wordpress.com/documentation/vip-go/code-review-blockers-warnings-notices/)**
- Install our pre-commit hook using composer. It'll help with the coding standards by automatically checking code when you commit. To install them run `composer install` from the command line within the Newspack plugin or theme directory.
- Ensure you use LF line endings in your code editor. Use [EditorConfig](http://editorconfig.org/) if your editor supports it so that indentation, line endings and other settings are auto configured.
- When committing, reference your issue number (#1234) and include a note about the fix.
- Please **don't** modify the changelog or update the .pot files. These will be maintained by the Newspack team.

### Code review process

Code reviews are an important part of the Newspack workflow. They help to keep code quality consistent, and they help every person working on Newspack learn and improve over time. We want to make you the best Newspack contributor you can be.

Every PR should be reviewed and approved by someone other than the author, even if the author has write access. Fresh eyes can find problems that can hide in the open if you’ve been working on the code for a while.

_Everyone_ is encouraged to review PRs and add feedback and ask questions, even people who are new to Newspack. Also, don’t just review PRs about what you’re working on. Reading other people’s code is a great way to learn new techniques, and seeing code outside of your own feature helps you to see patterns across the project. It’s also helpful to see the feedback other contributors are getting on their PRs.

### Development Workflow

Any standard WordPress local development environment should be able to run Newspack. The official development environment is [the VIP Go local development environment](https://vip.wordpress.com/documentation/vip-go/local-vip-go-development-environment/) with [VIP Go Skeleton](https://github.com/Automattic/vip-go-skeleton).

Once your environment is set up, run `composer install` and `npm install` to get all of the environmental dependencies.

When the dependencies are installed, you can use them to compile the SCSS. After making a change to a .scss file, run `npm run build` from within the theme directory to build the CSS files with your new changes. You can also “watch” the theme directory for Sass changes and rebuild the CSS anytime a change occurs by running `npm run watch`.

## License

Newspack is licensed under [GNU General Public License v2 (or later)](../LICENSE.md).

All materials contributed should be compatible with the GPLv2. This means that if you own the material, you agree to license it under the GPLv2 license. If you are contributing code that is not your own, such as adding a component from another Open Source project, or adding an `npm` package, you need to make sure you follow these steps:

1. Check that the code has a license. If you can't find one, you can try to contact the original author and get permission to use, or ask them to release under a compatible Open Source license.
2. Check the license is compatible with [GPLv2](http://www.gnu.org/licenses/license-list.en.html#GPLCompatibleLicenses), note that the Apache 2.0 license is _not_ compatible.
