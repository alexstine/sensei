
=== Sensei LMS - Online Courses, Quizzes, & Learning ===
Contributors: automattic, aaronfc, burtrw, donnapep, fjorgemota, gabrielcaires, gikaragia, imranh920, jakeom, luchad0res, merkushin, m1r0, onubrooks, renathoc, yscik
Tags: lms, eLearning, teach, online courses, woocommerce
Requires at least: 6.0
Tested up to: 6.2
Requires PHP: 7.2
Stable tag: 4.11.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create beautiful and engaging online courses, lessons, and quizzes.

== Description ==

**Create beautiful and engaging online courses, lessons, and quizzes.**

[Sensei LMS](https://senseilms.com) is a teaching and learning management plugin built by Automattic, the company behind WordPress.com, WooCommerce, and Jetpack. In fact, Sensei LMS is used to power all of Automattic’s employee training and courses too.

Your knowledge is worth teaching - teach freely with Sensei LMS!

### Powerful LMS Features ###

- Integrates seamlessly with your WordPress site, and courses look great with any theme.
- Track student progress and performance with detailed reports.
- Craft engaging lessons with no code required.
- Embed videos from YouTube, Vimeo, and VideoPress for video-based courses.
- Add the Course List block to any page or post to display available courses.
- Customize the look and feel to match your branding and site style.
- Enable the optional Learning Mode for a distraction free and immersive learning experience.

### Quizzes That Reinforce ###
Leverage the power of quizzes to strengthen your students’ understanding of key concepts and evaluate their progress.

Choose from many question types and quiz settings, including multiple-choice, fill-in-the-blank, true/false, free response, file uploads, and more.

### Get More with Sensei Pro ###

Do more and sell courses with Sensei Pro, which includes:

**WooCommerce Integration:** Set a price and sell courses with just a few clicks. Sensei Pro integrates perfectly with WooCommerce Subscriptions, Payments, Memberships, and Affiliates extensions too.

**Content Drip:** For each lesson in a course, you can specify when students will be able to access the lesson content, either at a fixed interval after the date they start the course or on a specific date.

**Interactive Blocks:** Videos, flashcards, image hotspots, and tasklists can be added to any lesson, and any WordPress page or post.

https://videopress.com/v/tLYw7R27

**Advanced Quiz Features:** Enable a quiz timer and add an ordering quiz question type. With Pro, you can add individual quiz questions to any WordPress content, not just in a quiz.

**Groups & Cohorts:** Organize students into groups and cohorts to manage access and customize learning experiences.

**Course Access Periods:** Select a start date, end date, or a specific amount of time that courses will remain accessible to students.

**Conditional Content:** Hide and show lessons and content in lessons based on groups, enrollment status, and date.

**Priority Support:** Our team of expert and friendly engineers are standing by and ready to help!

[Learn more about Sensei Pro](https://senseilms.com/sensei-pro/).

### Free Extensions ###

**Certificates:** Automatically generate beautiful downloadable PDF certificates for students when they complete a course.

[Learn more about Sensei LMS Certificates](https://wordpress.org/plugins/sensei-certificates/).

**Media & Attachments:** Upload media and files like PDFs to a separate uploads area of your course or lesson.

[Learn more about Sensei LMS Media Attachments](https://wordpress.org/plugins/sensei-media-attachments/).

**Post To Course Creator:** Create courses quickly by converting existing blog posts into course lessons in just a few clicks.

[Learn more about Sensei LMS Post To Course Creator](https://wordpress.org/plugins/sensei-post-to-course/).

== Installation ==

= Automatic installation =

1. Log into your WordPress admin panel and go to *Plugins* > *Add New*.
2. Enter "Sensei LMS" into the search field.
3. Once you've located the plugin, click *Install Now*.
4. Click *Activate*.
5. Configure the settings by going to *Sensei LMS* > *Settings*.

= Manual installation =

1. Download the plugin file to your computer and unzip it.
2. Using an FTP program, or your hosting control panel, upload the unzipped plugin folder to your WordPress installation's `wp-content/plugins/` directory on the server.
3. Log into your WordPress admin panel and activate the plugin from the *Plugins* menu.
4. Configure the settings by going to *Sensei LMS* > *Settings*.

== Frequently Asked Questions ==

= Where can I get support for Sensei LMS? =
For the free plugin, please use the [Support Forums](https://wordpress.org/support/plugin/sensei-lms/) for any questions that you may have. We monitor the forums regularly and will reply as soon as we can.

You can also check our [Documentation](https://senseilms.com/docs) on our website for guides, tutorials, and other helpful information.

= Where can I report bugs or contribute improvements to the plugin? =
Sensei is developed in public on Github. We welcome anyone to report a bug, submit a pull request, and follow along with our progress.

[Visit Sensei LMS on Github](https://github.com/Automattic/sensei/).

= Does Sensei work with membership plugins? =
Sensei LMS can be used in conjunction with [Sensei Pro](https://senseilms.com/sensei-pro/) and [WooCommerce Memberships](https://woocommerce.com/products/woocommerce-memberships/) to enable you to sell courses as part of a membership plan. See [Selling Courses as a Membership](https://senseilms.com/documentation/selling-courses-as-a-membership/) for more details.

= How can I keep up to date with new releases and announcements for Sensei LMS? =

Please visit the [Sensei Blog](https://senseilms.com/blog/) or sign up for our [mailing list](https://senseilms.com/mailing-list/).

== Screenshots ==
1. Lesson editor
2. Lesson page with Learning Mode enabled
3. Quiz editor
4. Course editor

== Changelog ==

### 4.12.0 - 2023-03-07
#### Added
- Register setup wizard option in settings endpoint.
- Add template name as CSS class to body element in Learning Mode
- Prepend sensei in CSS collapsed class
- Add support for customizing the tabs on the wp-admin Courses page

#### Fixed
- Run activation hooks when plugin is activated in the background.
- Fix global heading colors not working in Learning Mode
- Fix deprecation warnings due to missmatching return type in PHP 8.1.
- Fix progress bar and modules in Learning Mode not adhering to global colors
- Fix students context menu
- Disable Divi Theme Builder when Learning Mode enabled.
- Fix error in import job
- Auto select specific template for pattern at course creation if specified

### 4.11.1 - 2023-02-03

- Add: Auto select course template depending on selected course pattern [#6200](https://github.com/Automattic/sensei/pull/6200)
- Fix: Prevent html entities from showing up in module titles in editor [#6372](https://github.com/Automattic/sensei/pull/6372)
- Fix: Remove separator from course list pattern [#6435](https://github.com/Automattic/sensei/pull/6435)
- Fix: Alignment of url buttons for Blockbase/Astra themes [#5814](https://github.com/Automattic/sensei/pull/5814)
- Fix: Type error when `the_content` is not a string [#6484](https://github.com/Automattic/sensei/pull/6484)
- Fix: `the_content` hook called twice when viewing a lesson in learning mode [#6438](https://github.com/Automattic/sensei/pull/6438)
- Tweak: Suppress theme without comments.php deprecation message [#6453](https://github.com/Automattic/sensei/pull/6453)
- Tweak: Round course progress to integer [#6232](https://github.com/Automattic/sensei/pull/6232)

### 4.11.0 - 2023-02-02

- New: Guest users and teachers preview [#6421](https://github.com/Automattic/sensei/pull/6421)
- Add: Add Course List block to My Courses and course archive on page creation [#6343](https://github.com/Automattic/sensei/pull/6343) [#6354](https://github.com/Automattic/sensei/pull/6354) [#6414](https://github.com/Automattic/sensei/pull/6416)
- Add: Curate list of installed plugins that are logged [#6424](https://github.com/Automattic/sensei/pull/6424)
- Add: Add filter for the student bulk action modal [#6366](https://github.com/Automattic/sensei/pull/6366)
- Fix: Redirect to correct contact form if the user has a WPCOM subscription [#6407](https://github.com/Automattic/sensei/pull/6407)
- Fix: Fix archive page going on infinite loop in Astra theme [#6431](https://github.com/Automattic/sensei/pull/6431)
- Fix: Do not show quiz notice if it is the quiz page [#6313](https://github.com/Automattic/sensei/pull/6313)
- Fix: Fix error when calling `the_content` filter with no post context [#6406](https://github.com/Automattic/sensei/pull/6406)
- Fix: Fix issue where Quiz Timer options would appear only when the Random Question Order is enabled [#6377](https://github.com/Automattic/sensei/pull/6377)
- Fix: Fix block editor check [#6359](https://github.com/Automattic/sensei/pull/6359)
- Fix: Fix Twenty Fifteen and Learning Mode layout issue [#6360](https://github.com/Automattic/sensei/pull/6360)
- Tweak: Change reset progress copy by [#6371](https://github.com/Automattic/sensei/pull/6371)
