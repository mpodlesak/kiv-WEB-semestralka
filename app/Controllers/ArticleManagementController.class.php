<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

/**
 * Ovladac zajistujici vypsani stranky se spravou uzivatelu.
 */
class ArticleManagementController implements IController {

    /** @var DatabaseModel $db  Sprava databaze. */
    private $db;

    private $login;


    /**
     * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace prace s DB
        require_once (DIRECTORY_MODELS ."/DatabaseModel.class.php");
        $this->db = new DatabaseModel();
        require_once("Login.class.php");
        $this->login = new Login;
    }

    /**
     * Vrati obsah stranky se spravou uzivatelu.
     * @param string $pageTitle     Nazev stranky.
     * @return string               Vypis v sablone.
     */
    public function show(string $pageTitle):string {

        global $tplData;
        $tplData = [];
        $tplData['title'] = $pageTitle;
        $tplData['articles'] = $this->db->getAllIntroductions();
        $tplData['reviews'] = $this->db->getAllReviews();


        if (!$this->login->isUserLoged() || $this->login->getUserRole() != 1){
            header("Location: index.php?page=uvod");
            die();
        }


        // smazani prispevku
        if(isset($_POST['action']) and $_POST['action'] == "delete" and isset($_POST['id_article'])){
            $this->db->deleteArticle($_POST['id_article']);
            $tplData['alert'] = "Příspěvek s ID: $_POST[id_article] byl smazán z databáze.";
        }

        // overeni prispevku
        if(isset($_POST['action']) and $_POST['action'] == 'verify' and isset($_POST['id_article'])){
            $this->db->verifyArticle($_POST['id_article']);
            $tplData['alert'] = "Příspěvek s ID:$_POST[id_article] byl ověřen a publikován.";
        }

        //// nactu aktulani data uzivatelu
        $tplData['users'] = $this->db->getAllUsers();

        //// vypsani prislusne sablony
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS ."/ArticleManagementTemplate.tpl.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }

}

?>