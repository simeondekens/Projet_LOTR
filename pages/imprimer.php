<?php

require './admin/lib/php/dbConnectMysql.php';
//require './admin/lib/php/classe/Connexion.class.php';
require './admin/lib/php/classe/VueArticleDB.class.php';
$cnx = Connexion::getInstance($dsn, $user, $pass);

// recuperation des données
$obj = new VueArticleDB($cnx);
$liste = $obj->getVueArticle();
$nbrG = count($liste);

require './admin/lib/php/fpdf/fpdf.php';

$pdf = new FPDF('P', 'cm', 'A4'); // P pour format portrait , cm pour la hauteur de page, de ligne et A4 pour la taille de la page
$pdf->SetFont('Arial', 'B', 14);
$pdf->AddPage();
$pdf->setX(8.5);
$pdf->cell(3.5, 1, UTF8_decode('Nos articles'), 0, 0, 'C');
//sous_titre
$pdf->SetFillColor(200, 10, 10);
$pdf->SetDrawColor(0, 0, 255);
$pdf->SetTextColor(255, 255, 255);
$pdf->setXY(3, 2);
$pdf->cell(15, .7, UTF8_decode('Pour tout cadeau'), 0, 0, 'C',1);

$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetTextColor(0, 0, 0);

$x = 3;
$y = 3;
$pdf->setXY($x, $y);
$pdf->SetFont('Arial', 'B', '12');
$pdf->cell(8, 1, utf8_decode('Nom'), 0, 0, 'L');
$pdf->cell(4, 1, 'Prix', 0, 0, 'L');
$pdf->cell(5, 1, utf8_decode('Image'), 0, 0, 'L');

$pdf->SetFont('Arial', '',12);
$y = $y +2;
for($i=0;$i<$nbrG;$i++){ // on met 5 au lieu $nbrG pcq on a pas les images WEDDING
    $pdf->setXY($x,$y);
    $pdf->cell(3.5,1,$liste[$i]['NOM'],0,0,'C');
    $pdf->SetXY($x+8,$y);
    $pdf->cell(1,1,$liste[$i]['PRIX'],0,0,'C');
    $pdf->Image('./images/LoTR_projet_pics/'.$liste[$i]['IMAGE'],$x+12,$y,1.5,'JPG');
    
    $y = $y + 2;
}

ob_end_clean();
$pdf->Output();
?>
