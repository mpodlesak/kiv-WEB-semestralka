<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

/**
 * Ovladac zajistujici vypsani stranky se spravou uzivatelu.
 */
class UserManagementController implements IController {

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
        //// vsechna data sablony budou globalni
        global $tplData;
        $tplData = [];
        // nazev
        $tplData['title'] = $pageTitle;


        if (!$this->login->isUserLoged() || $this->login->getUserRole() != 1){
            header("Location: index.php?page=uvod");
            die();
        }


        //// smazani uzivatele
        if(isset($_POST['action']) and $_POST['action'] == "delete" and isset($_POST['id_user'])){
            $ok = $this->db->deleteUser(intval($_POST['id_user']));
            if($ok){
                $tplData['alert'] = "Uživatel s ID:$_POST[id_user] byl smazán z databáze.";
            } else {
                $tplData['alert'] = "CHYBA: Uživatele s ID:$_POST[id_user] se nepodařilo smazat z databáze.";
            }
        }

        if(isset($_POST['action']) and $_POST['action'] == 'verify' and isset($_POST['id_user'])){
            $this->db->verifyUser($_POST['id_user']);
            $tplData['alert'] = "Uživatel s ID:$_POST[id_user] byl ověřen a jeho účet byl aktivován.";
        }

        //// nactu aktulani data uzivatelu
        $tplData['users'] = $this->db->getAllUsers();

        //// vypsani prislusne sablony
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS ."/UserManagementTemplate.tpl.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }

}

?>