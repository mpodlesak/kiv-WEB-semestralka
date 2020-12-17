<?php
//////////////////////////////////////////////////////////////////
/////////////////  Globalni nastaveni aplikace ///////////////////
//////////////////////////////////////////////////////////////////

//// Vypnuti error a warning hlaseni ////
error_reporting(E_ALL ^ E_WARNING);
error_reporting(E_ERROR | E_PARSE);
error_reporting(0);



//// Pripojeni k databazi ////

/** Adresa serveru. */
define("DB_SERVER","localhost"); // https://students.kiv.zcu.cz lze 147.228.63.10, ale musite byt na VPN
/** Nazev databaze. */
define("DB_NAME","semestralka_v4");
/** Uzivatel databaze. */
define("DB_USER","root");
/** Heslo uzivatele databaze */
define("DB_PASS","");


//// Nazvy tabulek v DB ////

/** Tabulka s pohadkami. */
define("TABLE_ARTICLES", "prispevek");
/** Tabulka s uzivateli. */
define("TABLE_USER", "uzivatel");
/** Tabulka s uzivateli. */
define("TABLE_REVIEWS", "recenze");


//// Nazvy sloupcu v tabulce uzivatel ////

define("ID", "id_uzivatel");
define("PERMISSION", "id_pravo");
define("FIRST_NAME", "jmeno");
define("LAST_NAME", "prijmeni");
define("USERNAME", "login");
define("PASSWORD", "password");
define("EMAIL", "email");


//// Dostupne stranky webu ////

/** Adresar kontroleru. */
const DIRECTORY_CONTROLLERS = "app\Controllers";
/** Adresar modelu. */
const DIRECTORY_MODELS = "app\Models";
/** Adresar sablon */
const DIRECTORY_VIEWS = "app\Views";

/** Klic defaultni webove stranky. */
const DEFAULT_WEB_PAGE_KEY = "uvod";

/** Dostupne webove stranky. */
const WEB_PAGES = array(
    //// Uvodni stranka ////
    "uvod" => array(
        "title" => "Úvodní stránka",

        //// kontroler
        "file_name" => "IntroductionController.class.php",
        "class_name" => "IntroductionController",
    ),
    //// KONEC: Uvodni stranka ////

    //// Login uzivatelu ////
    "login" => array(
        "title" => "Login",

        //// kontroler
        "file_name" => "LoginController.class.php",
        "class_name" => "LoginController",
    ),
    //// KONEC: Login uzivatelu ////

    //// Login uzivatelu ////
    "signup" => array(
        "title" => "Registrace",

        //// kontroler
        "file_name" => "SignUpController.class.php",
        "class_name" => "SignUpController",
    ),
    //// KONEC: Login uzivatelu ////

    //// prispevek ////
    "article" => array(
        "title" => "Article",

        //// kontroler
        "file_name" => "ArticleController.class.php",
        "class_name" => "ArticleController",
    ),
    //// KONEC: prispevek ////

    //// prispevek ////
    "myProfile" => array(
        "title" => "Můj Profil",

        //// kontroler
        "file_name" => "MyProfileController.class.php",
        "class_name" => "MyProfileController",
    ),
    //// KONEC: prispevek ////

    //// novy prispevek ////
    "addNew" => array(
        "title" => "Přidat Nový Příspěvek",

        //// kontroler
        "file_name" => "AddNewController.class.php",
        "class_name" => "AddNewController",
    ),
    //// KONEC: novy prispevek ////

    //// recenze ////
    "reviews" => array(
        "title" => "Recenze",

        //// kontroler
        "file_name" => "ReviewsController.class.php",
        "class_name" => "ReviewsController",
    ),
    //// KONEC: recenze ////

    //// userList ////
    "userList" => array(
        "title" => "Seznam Uživatelů",

        //// kontroler
        "file_name" => "UserManagementController.class.php",
        "class_name" => "UserManagementController",
    ),
    //// KONEC: userList ////

    //// articleList ////
    "articleList" => array(
        "title" => "Seznam Článků",

        //// kontroler
        "file_name" => "ArticleManagementController.class.php",
        "class_name" => "ArticleManagementController",
    ),
    //// KONEC: articleList ////

    //// articleList ////
    "contacts" => array(
        "title" => "Kontakty",

        //// kontroler
        "file_name" => "ContactsAndAboutUsController.class.php",
        "class_name" => "ContactsAndAboutUsController",
    ),
    //// KONEC: articleList ////

    //// articleList ////
    "aboutus" => array(
        "title" => "Seznam Článků",

        //// kontroler
        "file_name" => "ContactsAndAboutUsController.class.php",
        "class_name" => "ContactsAndAboutUsController",
    ),
    //// KONEC: articleList ////
);

?>
