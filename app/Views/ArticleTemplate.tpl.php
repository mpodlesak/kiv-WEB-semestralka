<?php

/** Sablona ... */

global $tplData;

require(DIRECTORY_VIEWS ."/TemplateBasics.class.php");
$tplHeaders = new TemplateBasics();

?>
    <!-- ------------------------------------------------------------------------------------------------------- -->

    <!-- Vypis obsahu sablony -->
<?php


    $i = 0;
    foreach ($tplData['articles'] as $article){
        if ($article['id_prispevek'] == $_GET['article']){
            $arrayID = $i;
            break;
        }
        $i++;
    }



    $title = $tplData['articles'][$i]['nazev'];

    $fileName = $tplData['articles'][$i]['file'];

    // hlavicka
    $tplHeaders->getHTMLHeader($title);


    $res = "";

    if(array_key_exists('articles', $tplData)) {

        //$article = $tplData['articles'][$_GET['article']-1];


        $res .= '<div class="container">';
        $res .= '<article class="container">
                            <div class="jumbotron">
                                <div class="col-12 text-justify">';

        $res .= "<h3>$article[nazev]</h3>";
        $res .= '<div style="font-weight: lighter">Autor: ' . $article['id_autor'] . '</div>';
        //$res .= "<div style='text-align:justify;'><b>Úryvek:</b> $article[text]</div><hr>";
        $res .= "<div>";
        // $res .= getStarsHTML();
        $res .= "</div>";

        $res .= '<img src="' . $article['obrazky'][0] . '" class="img-fluid" alt="" style="width:100%; height:100%;">';
        $res .= "<br><br><br>";
        $res .= $article['text'];

        //existuje soubor
        if (strlen($fileName) > 1){
            $res.= '<form action="" method="post" enctype="multipart/form-data">
                      <br><br>
                      <label for="submit" class="text-info">Příloha:</label><br>
                      <input type="submit" value="' . $fileName . '" name="download">
                    </form>';
        }


        if (sizeof($article['obrazky']) > 1) {


                $res .= '<br><br><br><br><br>
                    <div class="container">
                        <h2>Fotografie</h2>  
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
    
    
                        <!-- Wrapper for slides -->
                            <div class="carousel-inner">';


                $res .= '<div class="item active">
                             <img src="' . $article['obrazky'][1] . '" class="img-fluid">
                         </div>';

                for ($i = 2; $i < sizeof($article['obrazky']); $i++) {

                    $res .= '<div class="item">
                             <img src="' . $article['obrazky'][$i] . '" class="img-fluid">
                         </div>';
                }

                $res .= '
                            </div>
                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                              <span class="glyphicon glyphicon-chevron-left"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                              <span class="glyphicon glyphicon-chevron-right"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
                        </div>
                ';

        }

        $res .=             '</div>
                        </div>
                    </article>';
        $res .= "</div>";

    } else {
        $res .= "Články nenalezen";
    }
    echo $res;





    // paticka
    $tplHeaders->getHTMLFooter()

?>
