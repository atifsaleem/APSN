=== Enhanced Meta Widget===
Contributors: NeuroDawg
Donate Link: http://neurodawg.wordpress.com/enhanced-meta-widget/
Version: 3.0.0
Tags: meta, customize, custom, widget
Requires at least: 3.0
Tested up to: 3.0
Stable Tag: 3.0.0

This plugin replaces the meta sidebar included with WordPress, and displays links based upon user roles.

== Description ==

This plugin replaces the meta sidebar included with WordPress, and displays links based upon user roles. 

For logged in users all links are based upon that user's role/permissions. Can the user write posts? A link for "Write Post" is presented. On a post/page that the user can edit? There are links for "Edit Post" or "Edit Page". If the user is an administrator, then there are links to all the main sections of the administrator pages, plus a few of the subsections like "Manage Widgets" and "Manage Drafts".

If a user is not logged in can present a log-in form or simple link to the standard login page, as well as a link to register (if allowed in site settings).

There are also links for the standard entries and comments RSS feeds, as well as to wordpress.org, like in the original meta widget.

All links can be turned on/off, and a different title for the sidebar widget can be set.

Enhanded Meta Widget is also a multi-widget -- it can be used in multiple instances on the same or different sidebars. Want your admin links only on a right-hand sidebar, but your general meta links on the left? Can be done. Want one widget just for the standard meta RSS and wordpress.org links, and a section below, with a different title for admin links? That can be done too, just add two separate widgets to the same sidebar and enable different options.

This widget is fully internationalized. A list of current languages can be found in [Other Notes](http://wordpress.org/extend/plugins/enhanced-meta-widget/other_notes/), the [Faq](http://wordpress.org/extend/plugins/enhanced-meta-widget/faq/), or at the end of the readme.txt file. If anyone is willing to translate for me, please contact me or follow the directions found at the plugin homepage (see [Faq](http://wordpress.org/extend/plugins/enhanced-meta-widget/faq/)).

This plugin was developed using ideas gathered from a number of different WordPress plugins. Credits and Copyright information can be found in [Other Notes](http://wordpress.org/extend/plugins/enhanced-meta-widget/other_notes/) (or at the end of the readme.txt file).

== Installation ==

1. Extract admin-links-enhanced.php into your wp-content/plugins folder (or any subfolder)
2. If you want to use this plugin in different languages, then install the plugin in the wp-content/plugins/enhanced-meta-widget directory.
3. Choose any language you may want to use, and upload that directory into the lang/ subdirectory. (i.e. the French(France) language files will be uploaded to wp-content/plugins/enhanced-meta-widget/lang/fr_FR)
4. Activate the plugin in Wordpress
5. Add the widget to your page
6. Set the options to select which links you want displayed

If you want to keep the original meta widget included with WordPress, then comment out or remove line #30 in the php file, it's commented.

Please inform me of any problems/issues. Recommendations for improvement are always welcome!

== Frequently Asked Questions ==

= Into what languages has EMW been translated? =
* French (fr_FR) - [Florian Stoffel](http://florianstoffel.com/ "Florian Stoffel Architecture & Urbanisme")
* Dutch (nl_NL) - [Mado](http://www.zijnwijdat.nl "Zijn Wij Dat? persoonlijke observaties in een wereld die steeds gekker wordt.") and [Sandra Rietveld](http://www.coachsan.nl)
* Polish (pl_PL) - [Daniel Frużyński](http://blog.poradnik-webmastera.com/)
* Danish (da_DK) - Mette Olsen
* German (de_DE) - [Dirk Rasmussen](http://www.bevis.de)
* Turkish (tr_TR) - Gökçe Ozan Toptas
* Belarusian (be_BY) - [M. Comfi](http://www.fatcow.com)
* Italian (it_IT) - [Gianni Diurno](http://gidibao.net "Gidibao's Cafe")
* Czech (cs_CZ) - Tomas Vesely
* Hungarian (hu_HU) - Csaba Sarkadi
* Argentinian Spanish (es_AR) - Sebastián Asegurado
* Spanish (Spain) - Sebastián Asegurado
* Russian (ru_RU) - [Vladimir Zhoukov](http://www.orktos.ru)

= How can I translate this widget into my language? =
I've written a fairly [detailed tutorial](http://neurodawg.wordpress.com/translating-emw/) on how to translate any WordPress plugin.

= How can I contact you with a question, suggestion, or complaint? =
Send your questions to neurodawg@hebers.us

== Screenshots ==

1. **Sidebar**: This is what the widget looks like when you're logged in as admin. (Not all possible links are shown).
2. **Sidebar**: This is what the widget looks like when a user isn't admin, but can edit or write a new post.
3. **Sidebar**: This is the sidebar when you're not logged in. Note that the widget includes both the "meta" and "Log In" sections.
4. **Options**: You can select which links you want displayed. No links are displayed unless they're relevant to the currently logged in user, on the page they're currently viewing.

== Change Log ==

= 3.0.0 =
* Updated to fix the new links for creating and editing pages.
* While it isn't a major release, version number increased to 3.0.0 to match numbering of WordPress versions.

= 2.3.3 =
* Adds language files for Czech, Hungarian, Argentinian Spanish, and Russian.

= 2.3.2 =
* Adds language files for Italian.
* Corrected errors in the Dutch Translation.

= 2.3.1 =
* Adds language files for Belarusian.

= 2.3 =
* Added option to add a new page.
* Fixed link to Dashboard to link to the index.php file rather than just the wp-admin directory.
* Language files updated with most recent changes.

= 2.2 =
* Changed wording from _site admin_ to _dashboard_ in both the options and the links.
* If display dashboard is selected, the link will appear for all logged-in users, not just admins. This allows non-admin users access to all settings for which they have permissions.
* For admin, the link to the dashboard still appears at the top of all admin links. For non-admin logged-in users it appears just after _my profile_.
* In the "Welcome, UserName" phrase, it is now an option to have the username link to the user profile.
* Added Turkish (tr\_TR) language files

= 2.1 =
* Fixed situations where an empty sidebar would be displayed, showing only a title, depending on what options were chosen for display. The most common was if \_show login form\_ was selected by itself (perhaps to have just a "log in" section of the sidebar). If this was done then logged in users would see an empty sidebar with just a title. Further testing identified some additional, likely rare, situations where this could occur as well, so those were all fixed.
* All html should now be XHTML 1.0 Transitional, unless login form is used with other links in certain situations (see below).
* Fixed coding error that would generate empty unordered lists if certain options were not selected, which is not valid XHTML. (Thanks Ian)
* If W3C validation is important, do not use the login form with other options if your $before\_widget variable uses id="%1$s" in its tag (usually a div or li). This widget uses $before\_widget, $before\_title, $after\_title, and $after\_widget to display the login form to be identical to other sidebar widgets, and thus there will be two tags with the same id which is not valid XHTML. In order to use the login form and have it validate in this situation, add a second widget to your sidebar and select only the login form (or change your settings for $before\_widget).

= 2.0.1 =
* Added German (de\_DE) and Danish (da\_DK) language files.
* Polish language files updated.

= 2.0 =
* Changed the format of the administration panel to a cleaner presentation. Gone are the "Display..." or "Show..." statements/questions, and they have been replaced with just a simple "Display:" header with all the options simply listed as options with checkboxes.
* Changed "UserName is logged in" to "Welcome, UserName" and moved to top, under the title.
* "Welcome, UserName" displays the username as set with "Display name publicly as" in the user profile.
* Added link to "my profile" for logged in users.
* Updated log in and log out links to return to the current page/post.
* Created option to have linebreaks or not. (I prefer to have breaks between some sections of links - user actions, admin actions, and the orignal meta links - but others prefer all links to be a list without breaks. So now "Line breaks between sections" is an option.)
* Added hook to allow other plugins to run actions just before the end of the login form - do\_action('login\_form').
* Corrected the order in which the options are presented on the admin page to reflect how they're presented on the sidebar.
* Added Polish (pl\_PL) language files.
* Updated French (fr\_FR) and Dutch (nl\_NL) language files.
* Found and translated another missed phrase. I think all phrases are now coded for i18n. If you are using a different language and find a phrase I have missed, please let me know.

= 1.7 =
* I18n now works correctly.
* All phrases have now been coded for I18n
* Added option to display register link. Depends both on "anyone can register" in the settings->general, and "show register link?" in this widget.
* Changed directory structure to put language files in individual directories. Now the POT file is in the directory "lang" with all language files having their own directories below "lang". For example, the french(France) files are found in the wp-content/plugins/enahnced-meta-widget/lang/fr_FR directory.

= 1.6.1 =
* Please note I18n is not working correctly. Will be corrected in next version.
* Fixed translation string of "username logged in" to include the whole string, including the username. (Allows for different word placement for different languages. Thanks to Daryan for pointing this out to me.)
* French Translation now included.

= 1.6 =
* Coded for I18n. Now just looking for translators.
* As part of I18n, the POT file is included with each distribution.
* Fixed bug where $after\_widget was being displayed inappropriately. (Thanks Jose.)
* Fixed improper insertion of a couple of br tags.
* Moved the display of "username is logged in." to the bottom of the sidebar widget. I didn't like it at the top.

= 1.5 =
* Added New Features
  *Can choose to display login link or login form*
  *Separated logout link from login link/form*
  *Display "username is logged in."*
* Fixed display of login form if it's the only thing showing on the sidebar (now surrounded by $before\_widget and $after\_widget).

= 1.4.1 =
* Fixed a typo that prevented the "edit this post" link from working correctly.

= 1.4 =
* Fixed problem with display of too many line breaks/spaces showing in sidebar depending on the options selected.

= 1.3 =
* Fixed error that would place widget title on the sidebar without content if user logged out and if links for register, RSS, and wordpress.org are not to be visible (log in form still displays).
* Fixed a couple of spelling and html code errors

= 1.2 =
* Fixed the proper display of the "register link" based upon whether or not the Administration > Settings > General > **Membership: Anyone can register** box is checked.
* Fixed the proper display of RSS and wordpress.org links for users that are not logged in.

= 1.1 =
* Fixed to show the RSS and wordpress.org links for logged in, non-admin, users.

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 3.0.0 =
Updated to fix the new links for creating and editing pages.
While it isn't a major release, version number increased to 3.0.0 to match numbering of WordPress versions.

= 2.3.3 =
Added language files for Czech, Hungarian, Argentinian Spanish, and Russian.

= 2.3.2 =
Adds language files for Italian and corrects the Dutch translation.

= 2.3.1 =
Adds the language files for Belarusian.

= 2.3 =
This version fixes a problem some users had with the dashboard link. Instead of just linking to the /wp-admin directory, the link now directs to the /wp-admin/index.php file directly.


== Languages and Translators ==

* French (fr_FR) - [Florian Stoffel](http://florianstoffel.com/ "Florian Stoffel Architecture & Urbanisme")
* Dutch (nl_NL) - [Mado](http://www.zijnwijdat.nl "Zijn Wij Dat? persoonlijke observaties in een wereld die steeds gekker wordt.") and [Sandra Rietveld](http://www.coachsan.nl)
* Polish (pl_PL) - [Daniel Frużyński](http://blog.poradnik-webmastera.com/)
* Danish (da_DK) - Mette Olsen
* German (de_DE) - [Dirk Rasmussen](http://www.bevis.de)
* Turkish (tr_TR) - Gökçe Ozan Toptas
* Belarusian (be_BY) - [M. Comfi](http://www.fatcow.com)
* Italian (it_IT) - [Gianni Diurno](http://gidibao.net "Gidibao's Cafe")
* Czech (cs_CZ) - Tomas Vesely
* Hungarian (hu_HU) - Csaba Sarkadi
* Argentinian Spanish (es_AR) - Sebastián Asegurado
* Spanish (Spain) - Sebastián Asegurado
* Russian (ru_RU) - [Vladimir Zhoukov](http://www.orktos.ru)

== Credits and Copyright ==
Copyright 2009 NeuroDawg.

The devlopment of this plugin took inspiration from the plugins [Admin Links Plus](http://alicious.com/admin-links-plus-sidebar-widget/), [Admin Links](http://kdmurray.net/2007/08/14/wordpress-plugin-admin-links-widget/) and [Quick Admin Links](http://www.4-14.org.uk/wordpress-plugins/quick-admin-links), created by pbhj, Keith Murray (kdmurray), and Mark Barnes, respectively.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

A copy of the GNU General Public License can be downloaded from http://www.gnu.org/licenses
