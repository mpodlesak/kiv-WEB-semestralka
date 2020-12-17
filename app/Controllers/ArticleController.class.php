<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");

/**
 * Ovladac zajistujici vypsani uvodni stranky.
 */
class ArticleController implements IController {

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

        global $tplData;
        $tplData = [];
        // nazev
        $tplData['title'] = $pageTitle;
        // data pohadek
        $tplData['articles'] = $this->db->getAllIntroductions();
        // hodnoceni
        $tplData['ratings'] = $this->db->getAllReviews();


        //// vypsani prislusne sablony
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS ."/ArticleTemplate.tpl.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        //pozadavek na download
        if (isset($_POST["download"])) {
            $file = "app/Uploads/".$tplData['articles'][$_GET['article']-1]['file'];

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
        }



        // vratim sablonu naplnenou daty
        return $obsah;


    }

}

?>