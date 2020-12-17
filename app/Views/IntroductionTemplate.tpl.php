<?php

/** Sablona pro vypis uvodni stranky */

global $tplData;

// pripojim objekt pro vypis hlavicky a paticky HTML
require(DIRECTORY_VIEWS ."/TemplateBasics.class.php");
require(DIRECTORY_VIEWS ."/ArticlePreviewTemplate.class.php");
$tplHeaders = new TemplateBasics();
$tplArticlePreview = new ArticlePreviewTemplate();

?>
<!-- ------------------------------------------------------------------------------------------------------- -->

<!-- Vypis obsahu sablony -->
<?php

// hlavicka
$tplHeaders->getHTMLHeader($tplData['title']);

// vypis postu
$tplArticlePreview->getHTMLArticlePreview();

// paticka
$tplHeaders->getHTMLFooter()

?>
