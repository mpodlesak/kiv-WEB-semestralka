<?php

/** Sablona pro vypis login stranky */

global $tplData;

// pripojim objekt pro vypis hlavicky a paticky HTML
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
    <div id="register">
        <div class="container">
            <div class="jumbotron">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="" method="post">
                                <h3 class="text-center text-info">Registrace</h3>
                                <div class="form-group">
                                    <label for="firstName" class="text-info">Jméno:</label><br>
                                    <input type="text" name="firstName" id="firstName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="lastName" class="text-info">Příjmení:</label><br>
                                    <input type="text" name="lastName" id="lastName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="text-info">Email:</label><br>
                                    <input type="text" name="email" id="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="username" class="text-info">Uživatelské jméno:</label><br>
                                    <input type="text" name="username" id="username" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="password" class="text-info">Heslo:</label><br>
                                    <input type="text" name="password" id="password" class="form-control">
                                </div>
                                <div class="form-group">

                                    <label for="autor" class="text-info"><span>Autor</span> <span><input id="autor" value="autor" name="role" type="radio" checked></span></label>
                                    &emsp;
                                    <label for="recenzent" class="text-info"><span>Recenzent</span> <span><input id="recenzent" value="recenzent" name="role" type="radio"></span></label><br>
                                    <input type="submit" name="signup" class="btn btn-info btn-md" value="Zaregistrovat">
                                </div>
                                <div id="register-link" class="text-right">
                                    <a href="index.php?page=login" class="text-info">Máte účet? Přihlaste se.</a>
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
