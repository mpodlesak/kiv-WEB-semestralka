<?php

/** Sablona ... */

global $tplData;

require(DIRECTORY_VIEWS ."/TemplateBasics.class.php");
$tplHeaders = new TemplateBasics();

?>
<!-- ------------------------------------------------------------------------------------------------------- -->

<!-- Vypis obsahu sablony -->
<?php




// hlavicka
$tplHeaders->getHTMLHeader($tplData['title']);

?>
<div id="login">
    <div class="container">
        <div class="jumbotron">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="POST">
                            <h3 class="text-center text-info">Opravdu se chcete odhlásit?</h3>
                            <div class="form-group" style="text-align: center">
                                <br><br>
                                <input type="submit" name="logout" class="btn btn-info btn-md" value="Odhlásit">
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
