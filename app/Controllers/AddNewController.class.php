<?php
// nactu rozhrani kontroleru
require_once(DIRECTORY_CONTROLLERS."/IController.interface.php");
require_once(DIRECTORY_CONTROLLERS . "/Login.class.php");

/**
 * Ovladac zajistujici vypsani uvodni stranky.
 */
class AddNewController implements IController {

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
        // nazev
        $tplData['title'] = $pageTitle;

        $target_dir = "app/Uploads/";
        $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);

        if (!$login->isUserLoged()){
            header("Location: index.php?page=uvod");
            die();
        }

        if (isset($_POST["Odeslat"])) {

            if ($_POST["Odeslat"] == "Přidat") {

                if (isset($_POST['title']) && isset($_POST['links']) && isset($_POST['text'])){
                    if (isset($_FILES["fileToUpload"]["tmp_name"])){
                        $this->db->addArticle($_POST['title'], $this->createLinks($_POST['links']), $this->filterAndCreateStyling($_POST['text']), $login->getUserID(), $_FILES["fileToUpload"]["name"]);
                    }
                    else{
                        $this->db->addArticle($_POST['title'], $this->createLinks($_POST['links']), $this->filterAndCreateStyling($_POST['text']), $login->getUserID(), " ");
                    }
                }

                if (isset($_FILES["fileToUpload"]["tmp_name"])) {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        echo "<script>alert('Soubor'" . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . "'Byl nahrán úspěšně.')</script>";

                    } else {
                        echo "<script>alert('Pokud jste přidali přílohu, nepodařilo se ji nahrát.');</script>";
                    }
                }
            }

            if ($_POST["Odeslat"] == "Ohodnotit") {

                if (isset($_POST['titleRating']) && isset($_POST['contentRating']) && isset($_POST['styleRating'])){
                    $this->db->addReview($_POST['titleRating'], $_POST['contentRating'], $_POST['styleRating'], $login->getUserID(), $_GET['id']);
                }
            }
        }


        if ($login->getUserRole() == 3){
            //// vypsani prislusne sablony
            // zapnu output buffer pro odchyceni vypisu sablony
            ob_start();
            // pripojim sablonu, cimz ji i vykonam
            require(DIRECTORY_VIEWS . "/AddNewTemplate.tpl.php");
            // ziskam obsah output bufferu, tj. vypsanou sablonu
            $obsah = ob_get_clean();

            // vratim sablonu naplnenou daty
            return $obsah;
        }

        if ($login->getUserRole() == 2){
            //// vypsani prislusne sablony
            // zapnu output buffer pro odchyceni vypisu sablony
            ob_start();
            // pripojim sablonu, cimz ji i vykonam
            require(DIRECTORY_VIEWS . "/AddReviewTemplate.tpl.php");
            // ziskam obsah output bufferu, tj. vypsanou sablonu
            $obsah = ob_get_clean();

            // vratim sablonu naplnenou daty
            return $obsah;
        }

        else {
            return "Někde se stala chyba.";
        }
    }

    /** ve vstupních datech nahradí odřádkování znakem středníku
     *  pro rozeznávání jednotlivých odkazů
     */
    public function createLinks($links){
        $results = explode(PHP_EOL, $links);
        $finalString = "";
        foreach ($results as $link){
            $finalString .= $link;
            $finalString .= ";";
        }
        return $finalString;
    }

    /** ve vstupních datech nahradí odřádkování znakem <br>
     *  pro html odřádkování
     */
    public function filterAndCreateStyling($text){
        $text = htmlspecialchars($text);
        $results = explode(PHP_EOL, $text);
        $finalString = "";
        foreach ($results as $paragraph){
            $finalString .= $paragraph;
            $finalString .= "<br>";
        }
        return $finalString;
    }

}

?>