<?php

/**
 *  Objekt pro spravu prihlaseni uzivatelu.
 *  @author Michal Nykl
 */
class LoginController implements IController {

    private $db;

    public function show(string $pageTitle): string {

        // nacteni souboru s funkcemi loginu (prace se session)
        require_once("Login.class.php");
        $login = new Login;

        require_once (DIRECTORY_MODELS ."/DatabaseModel.class.php");
        $this->db = new DatabaseModel();

        if ($login->isUserLoged()){
            header("Location: index.php?page=uvod");
            die();
        }

        // zpracovani odeslanych formularu - mam akci?
        if (isset($_POST["login"])) {
            // mam pozadavek na login ?
            if ($_POST["login"] == "Přihlásit") {
                // je zadane uziv. jmeno i heslo?
                if (isset($_POST["username"]) && $_POST["username"] != "" && isset($_POST["password"]) && $_POST["password"] != "") {

                    if ($login->userExist($_POST["username"], $_POST["password"])){
                        if (!$login->isUserLoged()){
                            if ($this->db->isVerified($this->db->getIDByCredentials($_POST["username"], $_POST["password"]))){
                                $login->login($_POST["username"], $_POST["password"]);
                                header("Location: index.php?page=uvod");
                                die();
                            }
                            else echo "<script>alert('Počkejte prosím, než váš účet ověří administrátor.');</script>";
                        }
                        else echo "<script>alert('Nejdříve se musíte odhlásit.');</script>";
                    }
                    else echo "<script>alert('Špatné Uživatelské jméno a heslo.');</script>";


                } else {
                    echo "<script>alert('Zadejte Uživatelské jméno a heslo.');</script>";
                }
            } // mam pozadavek na logout?
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
        require(DIRECTORY_VIEWS . "/LoginTemplate.tpl.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }

}
?>
