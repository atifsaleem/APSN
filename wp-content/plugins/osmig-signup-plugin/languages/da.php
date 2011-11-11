<?php
/* SIDEBAR MENU */
define("LANG_SIDEBAR_REPLIES","Osmig Tilmeldinger");
define("LANG_SIDEBAR_CONFIGURATION","Osmig Konfiguration");
define("LANG_SIDEBAR_HELP","Osmig Hjælp");

/* MAIN PAGE */
define("LANG_DESC_ONE","Osmig Signup Plugin er et fleksibelt og simpelt plugin der er designet til at hjælpe dig med at få fat i de data du har brug for til dine tilmeldinger.");
define("LANG_DESC_TWO","Herunder finder du nogle generelle indstillinger for plugin'et.");
define("LANG_SAVE_CHANGES_BUTTON","Gem Ændringer");
define("LANG_CHOOSE_LANGUAGE","Vælg sprog");
define("LANG_DANISH","Dansk");
define("LANG_ENGLISH","Engelsk");

/* CONFIGURATION PAGE */
define("LANG_CONFIGURATION_PAGE_TITLE","Osmig Konfiguration");
define("LANG_CONFIGURATION_DELETION_SUCCESS","Fletet blev slettet, sammen med alle data associeret med feltet.");
define("LANG_CONFIGURATION_DELETION_PARTIAL_SUCCESS","Feltet blev slettet. Desværre var vi ikke istand til at slette data associeret med feltet.");
define("LANG_CONFIGURATION_DELETION_FAILURE","Der opstod en fejl og feltet blev ikke slettet. Prøv venligst igen.");
define("LANG_CONFIGURATION_ADDING_SUCCESS","Feltet er blevet tilføjet.");
define("LANG_CONFIGURATION_ADDING_FAILURE","Feltet blev <strong>ikke</strong> tilføjet. Prøv venligst igen.");
define("LANG_CONFIGURATION_TABLE_NAME","Navn");
define("LANG_CONFIGURATION_TABLE_TYPE","Type");
define("LANG_CONFIGURATION_TABLE_DEFAULT","Standard");
define("LANG_CONFIGURATION_TABLE_HELPTEXT","Hjælpetekst");
define("LANG_CONFIGURATION_TABLE_ORDER","Rækkefølge");
define("LANG_CONFIGURATION_TABLE_DESCRIPTION","Hvis du sletter et felt sletter du også al data forbundet med feltet. Det er <strong>IKKE</strong> muligt at fortryde denne handling.");
define("LANG_CONFIGURATION_FORM_TITLE","Tilføj Felt");
define("LANG_CONFIGURATION_FORM_NAME","Navn");
define("LANG_CONFIGURATION_FORM_TYPE","Type");
define("LANG_CONFIGURATION_FORM_DEFAULT","Standard");
define("LANG_CONFIGURATION_FORM_DEFAULT_DESCRIPTION","This is the values that will appear as default in the form field you're creating. For select fields and multiple checkboxes you must separate the different options with commas.");
define("LANG_CONFIGURATION_FORM_HELPTEXT","Hjælpetekst");
define("LANG_CONFIGURATION_FORM_HELPTEXT_DESCRIPTION","Skriv hjælpsomme tips til feltet her.");
define("LANG_CONFIGURATION_FORM_ORDER","Rækkefølge");
define("LANG_CONFIGURATION_FORM_ORDER_DESCRIPTION","Dette felt er valgfrit. Brug et nummer fra  1 til 99 for at placere feltet i en ønsket rækkefølge. 1 er først, 99 er sidst. Hvis du ikke giver dit felt en placering vil de blive placeret i den rækkefølge du tilføjer dem.");
define("LANG_CONFIGURATION_FORM_SUBMIT_BUTTON","Gem Felt");

/* SIGNUPS PAGE */
define("LANG_SIGNUPS_PAGE_TITLE","Osmig Tilmeldinger");
define("LANG_SIGNUPS_DESCRIPTION","Dette er en liste over de tilmeldinger du har modtaget indtil nu. Tabellen viser kun data fra de første fem felter i din tilmelding.");
define("LANG_SIGNUPS_DELETION_SUCCESS","Tilmeldingen blev slettet.");
define("LANG_SIGNUPS_DELETION_FAILURE","Der opstod en fejl og tilmeldingen blev ikke slettet. Prøv venligst igen.");

/* HELP PAGE */
define("LANG_HELP_PAGE_TITLE","Osmig Hjælp");
define("LANG_HELP_PAGE_DESCRIPTION","Osmig har to specifikke shortcodes som du kan bruge til at inkludere plugin'et i din hjemmeside, [osmig-form] og [osmig-signups].");
define("LANG_HELP_PAGE_SHORTCODE_FORM","[osmig-form] shortcode");
define("LANG_HELP_PAGE_SHORTCODE_FORM_DESCRIPTION","<p>Denne shortcode viser den formular du bygger i konfigurationen.</p><p><strong>Eksempel:</strong> [osmig-form]</p>");
define("LANG_HELP_PAGE_SHORTCODE_SIGNUPS","[osmig-signups] shortcode");
define("LANG_HELP_PAGE_SHORTCODE_SIGNUPS_DESCRIPTION","<p>Denne shortcode viser en liste af modtagne tilmeldinger. Der er en påkrævet variabel, nemlig slug'et for det felt du gerne vil bruge til at definere listen, f.eks. 'navn'.</p><p><strong>Eksempel:</strong> [osmig-signups slug=\"navn\"]</p>");

/* GLOBAL */
define("LANG_GLOBAL_DELETE","Delete");
?>