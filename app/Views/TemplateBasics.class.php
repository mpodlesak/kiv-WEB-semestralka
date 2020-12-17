<?php

/**
 * Trida vypisujici HTML hlavicku a paticku stranky.
 */
class TemplateBasics {

    /**
     *  Vrati vrsek stranky az po oblast, ve ktere se vypisuje obsah stranky.
     *  @param string $pageTitle    Nazev stranky.
     */
    public function getHTMLHeader(string $pageTitle) {

        require_once(DIRECTORY_CONTROLLERS . "/Login.class.php");
        $login = new Login;
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <!-- nastaveni viewportu je zakladem pro responzivni design i Boostrap -->
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title><?php echo $pageTitle; ?></title>

            <style>
                body {background: #bdbdbd url("Styles/bgtexture.jpg") repeat top left fixed;}

                /* Make the image fully responsive */
                .carousel-inner img {
                    width: 100%;
                    height: 100%;
                }
            </style>

            <!--
            <link rel="stylesheet" href="Styles/npm/node_modules/bootstrap/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="Styles/npm/node_modules/font-awesome/css/font-awesome.min.css">
            -->

            <link rel="stylesheet" href="Styles\composer\vendor\twbs\bootstrap\dist\css\bootstrap.min.css">
            <link rel="stylesheet" href="Styles\composer\vendor\components\font-awesome\css/font-awesome.min.css">

            <script src="vendor/components/jquery/jquery.min.js"></script>
            <script src="vendor/alexandermatveev/popper-bundle/AlexanderMatveev/PopperBundle/Resources/public/popper.min.js"></script>
            <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


        </head>
        <body>

        <!-- Header -->
        <header class="container">
            <!-- <img src="logo.png" alt="..."  class="w-25 p-3">    -->
            <h1>Auto forum</h1>
            <p class="text-danger font-weight-bold">Všechny novinky ze světa aut na jednom místě.</p>
        </header>
        <!-- Header konec -->

        <!-- Menu -->
        <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand" href="index.php?page=uvod">
                    <i class="fa fa-car" aria-hidden="true"></i>
                    Auto Forum
                </a>

                <!-- Toggler/collapsibe Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=uvod">Úvod</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=contacts">Kontakt</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=aboutus"> <?php echo "O&nbspnás"; ?></a>
                        </li>

                    </ul>
                </div>

                <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <?php

                                // pro autory
                                if($login->isUserLoged() && $login->getUserRole()==3){
                                    echo '<li class="nav-item">
                                            <button type="button" class="btn btn-success" onclick="location.href=\'index.php?page=addNew\'"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Přidat</button>
                                          </li>';
                                }

                                // pro recenzenty
                                if($login->isUserLoged() && $login->getUserRole()==2){
                                    echo '<li class="nav-item">
                                                <button type="button" class="btn btn-warning" onclick="location.href=\'index.php?page=reviews\'"><i class="fa fa-list-ul" aria-hidden="true"></i> Recenze</button>
                                              </li>';
                                }

                            // pro adminy
                            if($login->isUserLoged() && $login->getUserRole()==1){
                                echo '<li class="nav-item">
                                          <a class="nav-link" href="index.php?page=userList">Uživatelé</a>
                                      </li>';
                                echo '<li class="nav-item">
                                          <a class="nav-link" href="index.php?page=articleList">Články</a>
                                      </li>';
                                echo '<li class="nav-item">
                                          <a class="nav-link">|</a>
                                      </li>';
                            }


                                if ($login->isUserLoged()){
                                        $str = $login->getUserName();
                                    echo '<a class="nav-link" href="index.php?page=myProfile"> ' . $str . '</a>';
                                }
                                else echo  '<a class="nav-link" href="index.php?page=login"> ' . "Přihlásit se" . '</a>';
                            ?>
                        </li>
                    </ul>
                </div>
            </div>


        </nav>
        <br>
        <!-- KONEC: Menu -->
        <?php
    }
    
    /**
     *  Vrati paticku stranky.
     */
    public function getHTMLFooter(){
        ?>
                <br>
                <!-- Paticka -->
                <footer class="container-fluid bg-dark text-white text-right font-weight-bold">
                    <br>
                    (c) Marek Podlešák 2020
                    <br><br>
                    <p style="color: #8c8f91; font-weight: normal">Zdroj textu, obrázků a článků je web autoforum.cz</p>
                    <br>
                </footer>
                <!-- KONEC: Paticka -->
            </body>
        </html>

        <?php
    }

    /**
     *  Vrati paticku pro moc kratke stranky
     */
    public function getHTMLFooterShort(){
        ?>
        <br>
        <!-- Paticka -->
        <footer class="fixed-bottom container-fluid bg-dark text-white text-right font-weight-bold align-content-md-end">
            <br>
            (c) Marek Podlešák 2020
            <br><br>
            <p style="color: #8c8f91; font-weight: normal">Zdroj textu, obrázků a článků je web autoforum.cz</p>
            <br>
        </footer>
        <!-- KONEC: Paticka -->
        </body>
        </html>

        <?php
    }
        
}

?>