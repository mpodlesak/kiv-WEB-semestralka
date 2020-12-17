<?php

/** Sablona pro vypis login stranky */

global $tplData;

global $db;

require(DIRECTORY_VIEWS ."/TemplateBasics.class.php");
$tplHeaders = new TemplateBasics();

?>
    <!-- ------------------------------------------------------------------------------------------------------- -->

    <!-- Vypis obsahu sablony -->
<?php
// hlavicka
$tplHeaders->getHTMLHeader($tplData['title']);

// vypis formu

?>
    <div id="insert">
        <div class="container">
            <div class="jumbotron">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div class="col-md-12">

                        <h3 class="text-center text-dark">Ohodnotit článek</h3>

                        <div class="col-md-6">

                            <form id="login-form" class="form" action="" method="POST">

                                <?php

                                    $result = "";
                                    $result .= '<div class="form-group">
                                                    <label for="title" class="text-info">Titulek</label><br>
                                                    <input type="text" name="title" id="title" class="form-control" placeholder="'. $this->db->getTitleByID($_GET['id']) .'" readonly>
                                                </div>
                
                                                <div class="form-group">
                                                    <label for="links" class="text-info">Titulek</label><br>
                                                    <input type="number" class="form-control" id="titleRating" name="titleRating" min="0" max="5" step="0.1"></input>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="links" class="text-info">Obsah</label><br>
                                                    <input type="number" class="form-control" id="contentRating" name="contentRating" min="0" max="5" step="0.1"></input>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="links" class="text-info">Styl</label><br>
                                                    <input type="number" class="form-control" id="styleRating" name="styleRating" min="0" max="5" step="0.1"></input>
                                                </div>
                
                                                <div class="form-group">
                                                    <input type="submit" name="Odeslat" class="btn btn-info btn-md" value="Ohodnotit">
                                                </div>';

                                    echo $result;

                                ?>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br><br>
<?php


// paticka
$tplHeaders->getHTMLFooter();

?>
<?php
