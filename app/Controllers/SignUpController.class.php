<?php

/**
 *  Objekt pro spravu prihlaseni uzivatelu.
 *  @author Michal Nykl
 */
class SignUpController implements IController {

    /** @var MySession $ses  Objekt pro praci se session. */
    private $ses;

    /** @var string $dName  Klic pro ulozeni jmena do session. */
    private $dName = "jmeno";
    /** @var string $dDate  Klic pro ulozeni datumu do session. */
    private $dDate = "datum";

    /**
     *  Pri vytvoreni objektu zahaji session.
     */
    public function __construct(){
        require_once("MySession.class.php");
        // inicializuju objekt sessny
        $this->ses = new MySession;
    }

    public function show(string $pageTitle): string {



        // nacteni souboru s funkcemi loginu (prace se session)
        require_once("Login.class.php");
        $login = new Login;


        // zpracovani odeslanych formularu - mam akci?
        if (isset($_POST["signup"])) {
            // mam pozadavek na login ?
            if ($_POST["signup"] == "Zaregistrovat") {
                // je zadane uziv. jmeno i heslo?
                if (   isset($_POST["firstName"]) && $_POST["firstName"] != ""
                    && isset($_POST["lastName"]) && $_POST["lastName"] != ""
                    && isset($_POST["email"]) && $_POST["email"] != ""
                    && isset($_POST["username"]) && $_POST["username"] != ""
                    && isset($_POST["password"]) && $_POST["password"] != ""
                ) {

                    if (!$login->userAlreadyExist($_POST["email"], $_POST["username"])){
                        // zaregistruji uzivatele
                        $login->registerUser($_POST["firstName"], $_POST["lastName"], $_POST["email"], $_POST["username"], $_POST["password"], $_POST["role"]);
                    }
                    else echo "<script>alert('Ůčet s tímto uživatelsým jménem / emailem již existuje.');</script>";

                } else {
                    echo "Chyba: chyba :/ <br>";
                }
            }
        }



        if (isset($_POST["logout"])) {
            if ($_POST["logout"] == "Odhlasit") {
                // odhlasim uzivatele
                $login->logout();
            } // neznamy pozadavek
            else {
                echo "<script>alert('Chyba: Nebyla rozpoznána požadovaná akce.');</script>";
            }
        }


        //// vsechna data sablony budou globalni
        global $tplData;
        $tplData = [];
        // nazev
        $tplData['title'] = $pageTitle;

        //// vypsani prislusne sablony
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS ."/SignUpTemplate.tpl.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}
?>
