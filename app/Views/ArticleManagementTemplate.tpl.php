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
                            <th>Článek</th><th>Autor</th><th>Počet Recenzí</th><th>Průměrné Hodnocení</th><th>Publikováno</th><th>Smazat</th>
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
                                $publicity = "<button type='submit' name='action' value='verify' class='btn btn-outline-dark btn-sm'>Potvrdit</button>";
                            }

                            $reviewCount = 0;
                            $titleRating =  0;
                            $contentRating = 0;
                            $styleRating = 0;
                            foreach ($tplData['reviews'] as $review){
                                if ($review['id_prispevek'] == $article['id_prispevek']) {
                                    $titleRating += $review['hodnoceni_titulek'];
                                    $contentRating += $review['hodnoceni_obsah'];
                                    $styleRating += $review['hodnoceni_styl'];
                                    $reviewCount++;
                                }
                            }

                            if (!$reviewCount == 0){
                                $titleRating =  'Titulek: ' . $titleRating/$reviewCount;
                                $contentRating = 'Obsah: ' . $contentRating/$reviewCount;
                                $styleRating = 'Styl: ' . $styleRating/$reviewCount;
                            }
                            else{
                                $titleRating = " ";
                                $contentRating = "Neohodnoceno";
                                $styleRating = " ";
                            }

                            $row = "";
                            $row .= '<form method="post">';
                            $row .= "<input type='hidden' name='id_article' value='" . $article['id_prispevek'] . "'>";
                            $row .= '<tr class="position-relative">
                                            <td rowspan="3">' .$title. '</td>
                                            <td rowspan="3">' .$author. '</td>
                                            <td rowspan="3">'. $reviewCount .'</td>
                                            <td>' .$titleRating. '</td>
                                            <td rowspan="3" class="text-center">' .$publicity. '</td>
                                            <td rowspan="3" class="text-center"> 
                                                <button type="submit" name="action" value="delete" style="border: none; background: none">
                                                    <i class="fa fa-trash text-danger">
                                                    </i>
                                                </button>
                                            </td></form>
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
