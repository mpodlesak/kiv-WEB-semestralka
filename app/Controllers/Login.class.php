<?php

/**
 *  Objekt pro spravu prihlaseni uzivatelu.
 *  @author Michal Nykl
 */
class Login {

    /** @var MySession $ses  Objekt pro praci se session. */
    public $ses;

    private $db;

    /** @var string $dName  Klic pro ulozeni jmena do session. */
    private $dName = "jmeno";
    /** @var string $dDate  Klic pro ulozeni datumu do session. */
    private $dDate = "datum";

    private $dRole = "role";

    private $dID = "id";

    /**
     *  Pri vytvoreni objektu zahaji session.
     */
    public function __construct(){
        require_once("MySession.class.php");
        require_once(DIRECTORY_MODELS . "/DatabaseModel.class.php");
        // inicializuju objekt sessny
        $this->ses = new MySession;
        $this->db = new DatabaseModel();
    }

    /**
     *  Otestuje, zda je uzivatel prihlasen.
     *  @return boolean
     */
    public function isUserLoged(){
        return $this->ses->isSessionSet($this->dName);
    }

    /**
     *  Nastavi do session jmeno uzivatele a datum prihlaseni.
     *  @param string $userName Jmeno uzivatele.
     */
    public function login($username, $password){

        $name = $this->db->getNameByCredentials($username, $password);
        $role = $this->db->getRoleByCredentials($username, $password);
        $id = $this->db->getIDByCredentials($username, $password);

        if ($name != ""){
            $this->ses->addSession($this->dName,$name); // jmeno
            $this->ses->addSession($this->dRole,$role); // role
            $this->ses->addSession($this->dID,$id); // id
            $this->ses->addSession($this->dDate,date("d. m. Y, G:m:s"));
        }
    }

    /**
     *  Odhlasi uzivatele.
     */
    public function logout(){

        $this->ses->removeSession($this->dName);
        $this->ses->removeSession($this->dRole);
        $this->ses->removeSession($this->dDate);
    }

    /**
     *  Vrati informace o uzivateli.
     *  @return string  Informace o uzivateli.
     */
    public function getUserID(){
        return $this->ses->readSession($this->dID);
    }

    public function getUserName(){
        return $this->ses->readSession($this->dName);
    }

    public function getUserRole(){
        return $this->ses->readSession($this->dRole);
    }

    public function userAlreadyExist($email, $username){
        if ($this->db->userAlreadyExist($username, $email))
            return true;

        return false;
    }

    public function userExist($username, $password){
        if ($this->db->userExist($username, $password))
            return true;

        return false;
    }


    public function registerUser($firstName, $lastName, $email, $username, $password, $role){

        if ($role == "autor"){
            $role = 3;
        }
        else if ($role == "recenzent") {
            $role = 2;
        }

        $this->db->addUser($firstName, $lastName, $email, $username, $password, $role);
    }
}
?>
