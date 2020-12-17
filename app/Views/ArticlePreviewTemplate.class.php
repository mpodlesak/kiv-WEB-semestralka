<?php



/**
 * Trida vypisujici HTML hlavicku a paticku stranky.
 */
class ArticlePreviewTemplate {

    /**
     *  Vrati vrsek stranky az po oblast, ve ktere se vypisuje obsah stranky.
     *  @param string $pageTitle    Nazev stranky.
     */
    public function getHTMLArticlePreview() {

        global $tplData;

        $res = "";

        if(array_key_exists('articles', $tplData)) {

            $res .= '<div class="container">';

            foreach ($tplData['articles'] as $article) {

                if ($article['is_active'] == 0)
                    continue;


                $res .= '<article class="container">
                            <div class="jumbotron">
                                <div class="col-12 text-justify">

                                    <a href="index.php?page=article&article=' . $article['id_prispevek'] . '" class="stretched-link"></a>';

                $res .= "<h3 style='text-align: center'>$article[nazev]</h3>";
                $res .= '<div style="font-weight: lighter">Autor: ' . $article['id_autor'] . '</div>';
                $res .= "<div>";
                $res .= $this->getStarsHTML($article['id_prispevek']);
                $res .= "</div>";

                $res .= '<img src="' . $article['obrazky'][0] . '" class="img-fluid" alt="" style="width:100%; height:100%;">';
                $res .=             '</div>
                                </div>
                        </article>';
            }

            $res .= "</div>";
        } else {
            $res .= "Žádné články nenalezeny";
        }
        echo $res;

    }

    public function getStarsHTML($idPrispevek):string{
        global $tplData;
        $result = "";
        $average = 0;
        $count = 0;


        foreach ($tplData['reviews'] as $review){
            if ($review['id_prispevek'] == $idPrispevek){
                $average += ($review['hodnoceni_titulek'] + $review['hodnoceni_obsah'] + $review['hodnoceni_styl']) / 3;
                $count++;
            }
        }

        $average = round($average/$count, 1);


        $result .= '<div>';

        for ($i = 0; $i < round($average, 0); $i++){
            $result .= '<i class="fa fa-star" aria-hidden="true"></i>';
        }

        $result .= ' ' . $average . ' / 5';

        $result .= '</div>';
        return $result;
    }
}

?>