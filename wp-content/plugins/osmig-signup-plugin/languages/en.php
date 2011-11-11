<?php
/* SIDEBAR MENU */
define("LANG_SIDEBAR_REPLIES","Osmig Signups");
define("LANG_SIDEBAR_CONFIGURATION","Osmig Configuration");
define("LANG_SIDEBAR_HELP","Osmig Help");

/* MAIN PAGE */
define("LANG_DESC_ONE","Osmig Signup Plugin is a flexible and simple plugin designed to got the data you need for your signups.");
define("LANG_DESC_TWO","Beneath you'll find a few general settings for the plugin.");
define("LANG_SAVE_CHANGES_BUTTON","Save Changes");
define("LANG_CHOOSE_LANGUAGE","Choose language");
define("LANG_DANISH","Danish");
define("LANG_ENGLISH","English");

/* CONFIGURATION PAGE */
define("LANG_CONFIGURATION_PAGE_TITLE","Osmig Configuration");
define("LANG_CONFIGURATION_DELETION_SUCCESS","Your field was succesfully removed, along with any data associated with it.");
define("LANG_CONFIGURATION_DELETION_PARTIAL_SUCCESS","Your field was succesfully removed. However we were unable to remove data associated with the field.");
define("LANG_CONFIGURATION_DELETION_FAILURE","An error occurred and the field was not deleted. Please try again.");
define("LANG_CONFIGURATION_ADDING_SUCCESS","Field has been added.");
define("LANG_CONFIGURATION_ADDING_FAILURE","Field was <strong>not</strong> added. Please try again.");
define("LANG_CONFIGURATION_TABLE_NAME","Name");
define("LANG_CONFIGURATION_TABLE_TYPE","Type");
define("LANG_CONFIGURATION_TABLE_DEFAULT","Default");
define("LANG_CONFIGURATION_TABLE_HELPTEXT","Help text");
define("LANG_CONFIGURATION_TABLE_ORDER","Order");
define("LANG_CONFIGURATION_TABLE_DESCRIPTION","Deleting a form field will also destroy any data saved to that form field. It is <strong>NOT</strong> possible to undo this action.");
define("LANG_CONFIGURATION_FORM_TITLE","Add Field");
define("LANG_CONFIGURATION_FORM_NAME","Name");
define("LANG_CONFIGURATION_FORM_TYPE","Type");
define("LANG_CONFIGURATION_FORM_DEFAULT","Default");
define("LANG_CONFIGURATION_FORM_DEFAULT_DESCRIPTION","This is the values that will appear as default in the form field you're creating. For select fields and multiple checkboxes you must separate the different options with commas.");
define("LANG_CONFIGURATION_FORM_HELPTEXT","Help text");
define("LANG_CONFIGURATION_FORM_HELPTEXT_DESCRIPTION","Write any helpful tips on how to fill out this field here.");
define("LANG_CONFIGURATION_FORM_ORDER","Ordering");
define("LANG_CONFIGURATION_FORM_ORDER_DESCRIPTION","This field is optional. In a number from 1 to 99 place this field in the order you want it in the form. 1 is first, 99 is last. If you do not give your fields an order they will be output in the order you create them.");
define("LANG_CONFIGURATION_FORM_SUBMIT_BUTTON","Add Field");

/* SIGNUPS PAGE */
define("LANG_SIGNUPS_PAGE_TITLE","Osmig Signups");
define("LANG_SIGNUPS_DESCRIPTION","This is a list of all the signups you've received so far. The table only shows the first 5 fields in your form.");
define("LANG_SIGNUPS_DELETION_SUCCESS","The signup was deleted.");
define("LANG_SIGNUPS_DELETION_FAILURE","An error occurred and the signup was not deleted. Please try again.");

/* HELP PAGE */
define("LANG_HELP_PAGE_TITLE","Osmig Help");
define("LANG_HELP_PAGE_DESCRIPTION","Osmig has two distinct shortcodes you can use to include the plugin in the frontend of your site, [osmig-form] and [osmig-signups].");
define("LANG_HELP_PAGE_SHORTCODE_FORM","[osmig-form] shortcode");
define("LANG_HELP_PAGE_SHORTCODE_FORM_DESCRIPTION","<p>This shortcode outputs the form you build in the Configuration page.</p><p><strong>Example:</strong> [osmig-form]</p>");
define("LANG_HELP_PAGE_SHORTCODE_SIGNUPS","[osmig-signups] shortcode");
define("LANG_HELP_PAGE_SHORTCODE_SIGNUPS_DESCRIPTION","<p>This shortcode outputs the list of signups received. It requires one variable, namely the slug of the field you'd like to list, ie. 'name'.</p><p><strong>Example:</strong> [osmig-signups slug=\"name\"]</p>");

/* GLOBAL */
define("LANG_GLOBAL_DELETE","Delete");
?>