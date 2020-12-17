<?php

/** Sablona pro vypis login stranky */

global $tplData;

global $db;

$login = new Login;

require_once(DIRECTORY_CONTROLLERS . "/Login.class.php");
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

                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped table-hover text-left">
                        <thead class="thead-dark text-center">
                        <tr>
                            <th>Článek</th><th>Autor</th><th>Mé hodnocení</th><th>Publikováno</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                            $table = "";

                            foreach ($tplData['articles'] as $article){
                                $title = '<a href="index.php?page=article&article=' . $article['id_prispevek'] . '" style="color:black"> ' . $article['nazev'] . ' </a>';
                                $author = $article['id_autor'];

                                if ($this->db->isArticleActive($article['id_prispevek'])){
                                    $publicity = '<i class="fa fa-check text-success"></i>';
                                }
                                else {
                                    $publicity = '<i class="fa fa-times text-danger"></i>';
                                }

                                foreach ($tplData['reviews'] as $review){

                                    if ($review['id_recenzent'] == $login->getUserID() && $review['id_prispevek'] == $article['id_prispevek']) {
                                        $titleRating =  'Titulek: ' . $review['hodnoceni_titulek'];
                                        $contentRating = 'Obsah: ' . $review['hodnoceni_obsah'];
                                        $styleRating = 'Styl: ' . $review['hodnoceni_styl'];

                                        break;
                                    }
                                    else {
                                        $titleRating = " ";
                                        $contentRating = '<a href="index.php?page=addNew&id='. $article['id_prispevek'] .'" style="color: black">' . 'Ohodnotit' . '</a>';
                                        $styleRating = " ";
                                    }
                                }

                                $row = "";
                                $row .= '<tr class="position-relative">
                                            <td rowspan="3">' .$title. '</td>
                                            <td rowspan="3">' .$author. '</td>
                                            <td>' .$titleRating. '</td>
                                            <td rowspan="3" class="text-center">' .$publicity. '</td>
                                        </tr>
                                        <tr>
                                            <td>' .$contentRating. '</td>
                                        </tr>
                                        <tr>
                                            <td>' .$styleRating. '</td>
                                        </tr>';

                                $table .= $row;
                            }

                            echo $table;

                        ?>

                        </tbody>
                    </table>
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
