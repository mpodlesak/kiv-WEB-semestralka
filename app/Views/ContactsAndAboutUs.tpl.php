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
$tplHeaders->getHTMLHeader("Autoforum");


    $res = "";

    $article = $tplData['articles'][$_GET['article']-1];

    $res .= '<div class="container">';
    $res .= '<article class="container">
                            <div class="jumbotron">
                                <div class="col-12 text-justify">';


    if ($_GET['page']== 'aboutus') {
        $res .= "<h3> O Nás </h3>";
        $res .= "Pro většinu automobilových žurnalistů je psaní o autech prostě práce. Některé baví více, jiné méně, ale pořád je to pro ně jen práce. Pro nás, redaktory Autoforum.cz je ale psaní o autech především zábavou a tomu odpovídá i náš přístup k věci. <br><br>

                V životě se zkrátka najde mnoho okamžiků, kdy chutí do práce nepřekypuje nikdo z nás a děláme ji tak, aby už už byla hotová. Dokážete si ale představit, že byste podobně přistoupili k dělání něčeho, co jste si sami vybrali a na co se těšíte? Třeba odpolednímu setkání s přáteli, víkendové projížďce autem nebo letní dovolené?<br><br>

                Co Vás baví, to děláte na sto procent a přejete si, aby to pokud možno trvalo věčně. Proto také my píšeme o autech tak poctivě, jak se jen dá, je to pro nás vítanou zábavou, ne otravnou prací.";
    }
if ($_GET['page']== 'contacts') {
    $res .= "<h4> Kontakty </h4>";
    $res .= "
Šéfredaktor: Pavel Píšťala <br>
e-mail: ppistala@autoforum.cz <br><br>

Editor: Mirek Mikeš<br>
e-mail: mmikes@autoforum.cz<br><br>

Hlavní redaktor: Petr Pstruh<br>
e-mail: ppstruh@autoforum.cz<br><br><br>

<h4>Adresa redakce</h4>
Autoforum.cz s.r.o.<br>
Nám. 2. ledna 123/4<br>
150 00 Praha 5<br><br>

e-mail: info@autoforum.cz";
}


    $res .=             '</div>
                        </div>
                    </article>';
    $res .= "</div>";


    echo $res;





// paticka
$tplHeaders->getHTMLFooterShort();

?>
