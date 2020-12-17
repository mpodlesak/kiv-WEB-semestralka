<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");
require_once(DIRECTORY_CONTROLLERS . "/Login.class.php");

/**
 * Ovladac zajistujici vypsani uvodni stranky.
 */
class ReviewsController implements IController {

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
    public function show(string $pageTitle):string
    {
        $login = new Login;

        global $tplData;
        $tplData = [];
        $tplData['title'] = $pageTitle;
        $tplData['articles'] = $this->db->getAllIntroductions();
        $tplData['reviews'] = $this->db->getAllReviews();

        if (!$login->isUserLoged()){
            header("Location: index.php?page=uvod");
            die();
        }



        //// vypsani prislusne sablony
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS . "/ReviewsTemplate.tpl.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}

?>