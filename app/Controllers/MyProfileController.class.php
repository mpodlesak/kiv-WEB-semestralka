<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");
require_once(DIRECTORY_CONTROLLERS . "/Login.class.php");

/**
 * Ovladac zajistujici vypsani uvodni stranky.
 */
class MyProfileController implements IController {

    /** @var DatabaseModel $db  Sprava databaze. */
    private $db;


    /**
     * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace prace s DB
        require_once (DIRECTORY_MODELS ."/DatabaseModel.class.php");
        $this->db = new DatabaseModel();
    }

    /**
     * Vrati obsah uvodni stranky.
     * @param string $pageTitle     Nazev stranky.
     * @return string               Vypis v sablone.
     */
    public function show(string $pageTitle):string {
        $login = new Login;

        global $tplData;
        $tplData = [];
        // nazev
        $tplData['title'] = $pageTitle;



        if (isset($_POST["logout"])) {
            if ($_POST["logout"] == "Odhlásit") {
                // odhlasim uzivatele
                $login->logout();
            } // neznamy pozadavek
            else {
                echo "<script>alert('Chyba: Nebyla rozpoznána požadovaná akce.');</script>";
            }
        }


        //// vypsani prislusne sablony
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam

        if ($login->isUserLoged()){

            require(DIRECTORY_VIEWS ."/LogoutTemplate.tpl.php");
            // ziskam obsah output bufferu, tj. vypsanou sablonu
            $obsah = ob_get_clean();

        }
        else{
            header("Location: index.php?page=login");
            die();
        }


        return $obsah;
    }

}

?>