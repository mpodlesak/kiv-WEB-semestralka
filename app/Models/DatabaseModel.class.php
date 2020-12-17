<?php

/**
 * Trida spravujici databazi.
 */
class DatabaseModel {

    /** @var PDO $pdo  Objekt pracujici s databazi prostrednictvim PDO. */
    private $pdo;

    /**
     * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace DB
        $this->pdo = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS);
        // vynuceni kodovani UTF-8
        $this->pdo->exec("set names utf8");
    }

    /**
     *  Vrati seznam vsech pohadek pro uvodni stranku.
     *  @return array Obsah uvodu.
     */
    public function getAllIntroductions():array {
        // pripravim dotaz
        $q = "SELECT * FROM ".TABLE_ARTICLES;
        // provedu a vysledek vratim jako pole
        // protoze je o uzkazku, tak netestuju, ze bylo neco vraceno
        $result = $this->pdo->query($q)->fetchAll();
        foreach ($result as &$d) {
            $index = $d['id_autor'];
            $d['id_autor'] = $this->getUserName($index);
            $d['obrazky'] =  $this->getImagesArray($d['obrazky']);
        }
        return $result;

        /*
        // pripravim dotaz
        $q = "SELECT * FROM ".TABLE_ARTICLES;
        // provedu a vysledek vratim jako pole
        // protoze je o uzkazku, tak netestuju, ze bylo neco vraceno
        $result = $this->pdo->query($q)->fetchAll();

        $count = $result[sizeof($result)-1]['id_prispevek'];

        for($i = 0; $i < $count; $i++) {
            echo $count;
            echo $i;
            echo "<br>";
            $index = $result[$i]['id_autor'];
            if ($index == null) {
                $result[$i] = null;
                continue;
            }
            $result[$i]['id_autor'] = $this->getUserName($index);
            $result[$i]['obrazky'] =  $this->getImagesArray($result[$i]['obrazky']);
        }
        return $result;
        */
    }


    public function getAllReviews():array {
        // pripravim dotaz
        $q = "SELECT * FROM ".TABLE_REVIEWS;
        // provedu a vysledek vratim jako pole
        // protoze je o uzkazku, tak netestuju, ze bylo neco vraceno
        $result = $this->pdo->query($q)->fetchAll();
        return $result;
    }
    
    
    /**
     *  Vrati seznam vsech uzivatelu pro spravu uzivatelu.
     *  @return array Obsah spravy uzivatelu.
     */
    public function getAllUsers():array {
        // pripravim dotaz
        $q = "SELECT * FROM ".TABLE_USER;
        // provedu a vysledek vratim jako pole
        // protoze je o uzkazku, tak netestuju, ze bylo neco vraceno
        return $this->pdo->query($q)->fetchAll();
    }

    /**
     *  Vrati uzivatele podle jeho id
     *  @param int $userId  ID uzivatele.
     */
    public function getUserName(int $userId):string{
        // pripravim dotaz
        $q = "SELECT jmeno FROM ".TABLE_USER." WHERE id_uzivatel = $userId";
        $res = $this->pdo->query($q)->fetch();

        $q = "SELECT prijmeni FROM ".TABLE_USER." WHERE id_uzivatel = $userId";
        $res2 = $this->pdo->query($q)->fetch();

        return $res['jmeno'] ." ". $res2['prijmeni'];
    }

    public function getNameByCredentials(string $username, string $password):string{

        $q = "SELECT jmeno FROM " . TABLE_USER . " WHERE login = '$username' AND heslo = '$password'";
        $res = $this->pdo->query($q)->fetch();

        $q = "SELECT prijmeni FROM " . TABLE_USER . " WHERE login = '$username' AND heslo = '$password'";
        $res2 = $this->pdo->query($q)->fetch();

        return $res['jmeno'] ." ". $res2['prijmeni'];
    }


    public function getRoleByCredentials($username, $password){
        $q = "SELECT id_pravo FROM " . TABLE_USER . " WHERE login = '$username' AND heslo = '$password'";
        $res = $this->pdo->query($q)->fetch();
        return $res['id_pravo'];
    }

    public function getIDByCredentials($username, $password){
        $q = "SELECT id_uzivatel FROM " . TABLE_USER . " WHERE login = '$username' AND heslo = '$password'";
        $res = $this->pdo->query($q)->fetch();
        return $res['id_uzivatel'];
    }
    
    /**
     *  Smaze daneho uzivatele z DB.
     *  @param int $userId  ID uzivatele.
     */
    public function deleteUser(int $userId):bool {
        // pripravim dotaz
        $q = "DELETE FROM ".TABLE_USER." WHERE id_uzivatel = $userId";
        // provedu dotaz
        $res = $this->pdo->query($q);
        // pokud neni false, tak vratim vysledek, jinak null
        if ($res) {
            // neni false
            return true;
        } else {
            // je false
            return false;
        }
    }

    public function deleteArticle(int $id){
        $q = "DELETE FROM ".TABLE_ARTICLES." WHERE id_prispevek = $id";
        $this->pdo->query($q);
    }

    public function userAlreadyExist($username, $email):bool{

        $q = "SELECT jmeno FROM ".TABLE_USER." WHERE login = '$username'";
        $res = $this->pdo->query($q)->fetch();

        if ($res != ""){
            return true;
        }

        $q = "SELECT jmeno FROM ".TABLE_USER." WHERE email = '$email'";
        $res = $this->pdo->query($q)->fetch();

        if ($res != ""){
            return true;
        }

        return false;
    }

    public function userExist($username, $password):bool{

        $q = "SELECT jmeno FROM ".TABLE_USER." WHERE login = '$username' AND heslo = '$password'";
        $res = $this->pdo->query($q)->fetch();

        if ($res != ""){
            return true;
        }
        return false;
    }

    public function isVerified($id){
        $q = "SELECT is_active FROM ".TABLE_USER." WHERE id_uzivatel = '$id'";
        $res = $this->pdo->query($q)->fetch();

        return$res['is_active'];
    }

    public function addUser($firstName, $lastName, $email, $username, $password, $userRole){
        $firstName = htmlspecialchars($firstName);
        $lastName = htmlspecialchars($lastName);
        $email = htmlspecialchars($email);
        $username = htmlspecialchars($username);
        $password = htmlspecialchars($password);

        if ($userRole == 2){
            $active = 0;
        }
        else{
            $active = 1;
        }
        //$q = "INSERT INTO ".TABLE_USER." (id_pravo, jmeno, prijmeni, login, heslo, email, is_active) VALUES
        //        ($role, '$firstName', '$lastName', '$username', '$password', '$email', '$active')";
        //$this->pdo->query($q);

        $q = "INSERT INTO ".TABLE_USER." (id_pravo, jmeno, prijmeni, login, heslo, email, is_active) VALUES 
                (:userRole, :firstName, :lastName, :username, :password, :email, :active)";
        $output = $this->pdo->prepare($q);
        $output->bindValue(":role", $userRole);
        $output->bindValue(":firstName", $firstName);
        $output->bindValue(":lastName", $lastName);
        $output->bindValue(":username", $username);
        $output->bindValue(":password", $password);
        $output->bindValue(":email", $email);
        $output->bindValue(":active", $active);

        if($output->execute()){
            // dotaz probehl v poradku
            echo "<script>alert('Registrace proběhla v pořádku.');</script>";
        } else {
            // dotaz skoncil chybou
            echo "<script>alert('Chyba při vytváření novéhu účtu.');</script>";
        }
    }

    public function verifyUser($id){
        $q = "UPDATE ". TABLE_USER ." SET is_active = '1' WHERE id_uzivatel = '$id'";
        $this->pdo->query($q);
    }

    public function verifyArticle($id){
        $q = "UPDATE ". TABLE_ARTICLES ." SET is_active = '1' WHERE id_prispevek = '$id'";
        $this->pdo->query($q);
    }

    public function addArticle($title, $links, $text, $idAuthor, $fileName){
        //$q = "INSERT INTO ".TABLE_ARTICLES." (id_autor, nazev, text, obrazky, is_active) VALUES
        //        ('$idAuthor', '$title', '$text', '$links', '0')";
        //$this->pdo->query($q);

        $title = htmlspecialchars($title);
        $links = htmlspecialchars($links);
        //text jiz prosel fci htmlspecialchars, pote do nej byly vlozeny <br> tagy pro odrakovani
        //$text = htmlspecialchars($text);

        if ($fileName == " "){
            $q = "INSERT INTO ".TABLE_ARTICLES." (id_autor, nazev, text, obrazky, is_active) VALUES 
                (:idAuthor, :title, :text, :links, '0')";

            $output = $this->pdo->prepare($q);
            $output->bindValue(":idAuthor", $idAuthor);
            $output->bindValue(":title", $title);
            $output->bindValue(":text", $text);
            $output->bindValue(":links", $links);
        }
        else{
            $q = "INSERT INTO ".TABLE_ARTICLES." (id_autor, nazev, text, obrazky, is_active, file) VALUES 
                (:idAuthor, :title, :text, :links, '0', :file)";

            $output = $this->pdo->prepare($q);
            $output->bindValue(":idAuthor", $idAuthor);
            $output->bindValue(":title", $title);
            $output->bindValue(":text", $text);
            $output->bindValue(":links", $links);
            $output->bindValue(":file", $fileName);
        }


        if($output->execute()){
            // dotaz probehl v poradku
            echo "<script>alert('Článek byl přidán v pořádku.');</script>";
        } else {
            // dotaz skoncil chybou
            echo "<script>alert('Chyba při vkládání článku.');</script>";
        }
    }

    public function addReview($title, $content, $style, $idAuthor, $idArticle){
        $q = "INSERT INTO ".TABLE_REVIEWS." (id_recenzent, id_prispevek, hodnoceni_titulek, hodnoceni_obsah, hodnoceni_styl) VALUES 
                ('$idAuthor', '$idArticle', '$title', '$content', '$style')";

        $this->pdo->query($q);
    }

    public function getImagesArray($linksString):array{
        $outArr = explode(";", $linksString);

        // prazndy element v pripade ze je na konci ';', je nutno ho zahodit
        if (strlen($outArr[sizeof($outArr)-1]) < 3){
            array_pop($outArr);
        }

        return $outArr;
    }

    public function isArticleActive($id){
        $q = "SELECT is_active FROM ".TABLE_ARTICLES." WHERE id_prispevek = '$id'";
        $res = $this->pdo->query($q)->fetch();
        return $res['is_active'];
    }

    public function getTitleByID($id){
        $q = "SELECT nazev FROM ".TABLE_ARTICLES." WHERE id_prispevek = '$id'";
        $res = $this->pdo->query($q)->fetch();
        return $res['nazev'];
    }
    
}

?>