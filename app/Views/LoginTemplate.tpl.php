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
    <div id="login">
                <div class="container">
                    <div class="jumbotron">
                        <div id="login-row" class="row justify-content-center align-items-center">
                            <div id="login-column" class="col-md-6">
                                <div id="login-box" class="col-md-12">
                                    <form id="login-form" class="form" action="" method="POST">
                                        <h3 class="text-center text-info">Přihlášení</h3>
                                        <div class="form-group">
                                            <label for="username" class="text-info">Uživatelské jméno:</label><br>
                                            <input type="text" name="username" id="username" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="text-info">Heslo:</label><br>
                                            <input type="text" name="password" id="password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="login" class="btn btn-info btn-md" value="Přihlásit">
                                        </div>
                                        <div id="register-link" class="text-right">
                                            <a href="index.php?page=signup" class="text-info">Zaregistrovat se</a>
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
    $tplHeaders->getHTMLFooterShort();

?>
<?php
