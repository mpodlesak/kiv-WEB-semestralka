<?php

/** Sablona pro vypis login stranky */

global $tplData;

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

                        <h3 class="text-center text-dark">Přidat nový článek</h3>

                        <div class="col-md-6">

                            <form id="login-form" class="form" action="" method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="title" class="text-info">Titulek</label><br>
                                    <input type="text" name="title" id="title" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="links" class="text-info">Obrázky</label><br>
                                    <textarea class="form-control" id="links" name="links" rows="3" placeholder="Zde vložte odkazy na obrázky, na každý řádek jeden odkaz.     První obrázek bude náhledový."></textarea>
                                </div>

                        </div>

                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="text" class="text-info">Text Příspěvku</label><br>
                                <textarea class="form-control" id="text" name="text" rows="16"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="fileToUpload" class="text-info">Příloha pdf</label><br>
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="Odeslat" class="btn btn-info btn-md" value="Přidat">
                            </div>

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
