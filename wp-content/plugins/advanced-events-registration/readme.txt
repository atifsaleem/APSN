=== Event Espresso Lite - Event Registration and Management ===

Contributors: 
Seth Shoultes http://eventespresso.com

Donate link: http://eventespresso.com

Tags: event registration, events calendar, wordpress events, event ticketing, class registration, conference registration, online registration, event management, buddypress, tickets, ticketing, ticket, registration, wordcamp, event manager

Requires at least: 3.1

Tested up to: 3.2.1

Stable tag: 3.1.12.L

== Description ==

ATTENTION!! This is a major update. The plugin has been completely rewritten and we are no longer supporting version 2.1.29. If you are currently holding events, please finish your events, you may not be able to roll back the changes. Before you update, please backup all files and databases. If you absolutely need to roll back, you can download the [older versions from here] (http://wordpress.org/extend/plugins/advanced-events-registration/download/). You will also need to revert the shortcodes, in yor registration pages, to the ones used in version 2.1.29.

If your organization offers classes, workshops, events, trainings, conferences or concerts for which participants need to register or buy a ticket in advance, Event Espresso can make you a hero [WordPress event manager](http://eventespresso.com/). Why? Because this online [event registration](http://eventespresso.com/) and ticketing management system will save your organization countless hours of administrative time, create a "green" and paperless [event registration](http://eventespresso.com/) process, reduce costs and be available to take sign-ups 24/7. Everything from custom event registration questions, registration confirmation and reminder emails to payment management, and quite a bit more is all included and automatically handled for you. Install the Event Espresso [WordPress events calendar](http://eventespresso.com/features/event-calendar/) to list your upcoming events in day, week, or month views (including list view).

Event Espresso events are created from within the WordPress admin. The [WordPress events plugin](http://eventespresso.com/) even creates registration forms so attendees can easily sign up right on your website.

Where is the attendee registration or ticketing information stored? Attendee ticket information is stored right in the WordPress database, allowing you to have access to any and all the information you collect from your attendees at any time.

Event Espresso has all the event management tools you need, from accepting payments to reports to promotions.

This version of Event Espresso only uses the PayPal IPN to record payments to a database. A premium support license can be purchased to extend the event management plugin to use Authorize.net and other payment options. This is basically a fully working preview of the pro version. Some advanced functionality has been left out and is only available in the pro version of this event management plugin.

**[Buy a Premium Support License](http://eventespresso.com/download/) to get access to more features (including [recurring events](http://eventespresso.com/download/plugins-and-addons/recurring-events-manager/), [Groupon integration](http://eventespresso.com/download/add-ons/groupon-integration/), [members integration](http://eventespresso.com/download/add-ons/members-integration/), [custom files](http://eventespresso.com/download/add-ons/custom-files-addon/), etc.) and payment options for your WordPress events.**

[Most Comprehensive Event Solution for WordPress](http://s3.amazonaws.com/espresso-site/images/event-solution.jpg "Most Comprehensive Event Solution for WordPress")


Reporting features provide a list of events, list of attendees, and excel export.


== Support ==
Please visit the forums http://www.eventespresso.com/forums/ or visit the "Help/Support" menu within the Event Espresso admin

Current Version: 3.1.12.L

Author: Seth Shoultes
Author URI: http://eventespresso.com

== Screenshots ==

[View Sample Screens Here](http://eventespresso.com/features/)

**[Buy a Premium Support License](http://eventespresso.com/download/) to get access to more features (including [recurring events](http://eventespresso.com/download/plugins-and-addons/recurring-events-manager/), [Groupon integration](http://eventespresso.com/download/add-ons/groupon-integration/), [members integration](http://eventespresso.com/download/add-ons/members-integration/), [custom files](http://eventespresso.com/download/add-ons/custom-files-addon/), etc.) and payment options for your WordPress events.**

== Installation ==

1. After unzipping, upload everything in the `event-espresso` folder to your `/wp-content/plugins/` directory (preserving directory structure).

2. Activate the plugin through the 'Plugins' menu in WordPress.

3. Go to the Event Registration Menu and Configure Organization and enter your company info - note you will need a paypal id if you plan on accepting paypal payments

4. Go to the Event Setup and create a new event, make sure you select 'make active'.

5. Create a new page (not post) on your site. Put [ESPRESSO_EVENTS] in it on a line by itself.

6. Note: if you are upgradings from a previous version please backup your data prior to upgrade.

= License =

This plugin is provided "as is" and without any warranty or expectation of function. I'll probably try to help you if you ask nicely, but I can't promise anything. You are welcome to use this plugin and modify it however you want, as long as you give credit where it is due. 


== Frequently Asked Questions ==

To display a single event on a page use the [SINGLEEVENT single_event_id="Unique Event ID"]

To display a list of events in sidebar, use the Event Registration Widget. If your theme doesn't use widgets, you can use  <?php display_all_events(); ?> in theme code.

To use, create a new page with only  [ESPRESSO_EVENTS]

To display list of attendees of an active event use [LISTATTENDEES] on a page or post.

*For URL link back to the payment/thank you page use  [ESPRESSO_PAYMENTS] on a new page.

*For PayPal to notify about payment confirmation use  [ESPRESSO_TXN_PAGE] on a new page.

*This page should be hidden from from your navigation menu. Exclude pages by using the 'Exclude Pages' plugin from http://wordpress.org/extend/plugins/exclude-pages/ or using the 'exclude' parameter in your 'wp_list_pages' template tag. Please refer to http://codex.wordpress.org/Template_Tags/wp_list_pages for more inforamation about excluding pages.

= Email Confirmations =
For customized confirmation emails, the following tags can be placed in the email form and they will pull data from the database to include in the email.

[fname], [lname], [phone], [event],[description], [cost], [company], [co_add1], [co_add2], [co_city],[co_state], [co_zip],[contact], [payment_url], [start_date], [start_time], [end_date], [end_time]


= Sample Mail Send =

***This is an automated response - Do Not Reply***

Thank you [fname] [lname] for registering for [event].  We hope that you will find this event both informative and enjoyable.  Should have any questions, please contact [contact].

If you have not done so already, please submit your payment in the amount of [cost].

Click here to review your payment information [payment_url].

Thank You.

 
