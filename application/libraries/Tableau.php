<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'third_party/fpdf.php');
require(APPPATH . 'third_party/makefont/makefont.php');

class Tableau extends FPDF
{
    
   
    // En-tête
    function Header()
    {
        // Logo ou en-tête
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,'FICHE DE PAIE EMPLOYE',0,1,'C');
        $this->Ln(10);
    }

    // Pied de page
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Numéro de page
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    // Tableau amélioré
    function details($header,$emp,$hn,$hs30,$hs50,$hnuit,$hdim,$hf,$hfw,$montant,$indemnite,$total)
    {
        // Couleurs, epaisseur du trait et police grasse
        $this->SetFillColor(0,0,0);
        $this->SetTextColor(0);
        $this->SetDrawColor(46,46,46);
        $this->SetLineWidth(.3);
        $this->SetFont('Arial','B',8);
        // En-tete
        $w = array(47, 47, 47, 47); // Ajustement des tailles des colonnes
        for($i=0; $i<count($header); $i++) {
            $this->Cell($w[$i], 10, $header[$i], 1, 0, 'C');
        }
        $this->Ln();
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        // DISPLAY 7 ----------------------------------------------------------------
        $this->SetFont('');
        $this->Cell($w[0], 6, 'Heure Normale ','1', 0);
        $this->Cell($w[1], 6, $hn->total_heure,'1', 0,'R');
        $this->Cell($w[2], 6,number_format($hn->taux_horaire,2,',',' '), '1', 0, 'R');
        $this->Cell($w[3], 6, number_format($hn->montant, 2, ',', ' '), '1', 0, 'R');    
        $this->Ln();
        //
        $this->Cell($w[0], 6, 'Heure Nuit ', '1', 0);
        $this->Cell($w[1], 6, $hnuit->total_heure, '1', 0,'R');
        $this->Cell($w[2], 6, number_format($hnuit->taux_horaire,2,',',' '), '1', 0, 'R');
        $this->Cell($w[3], 6, number_format($hnuit->montant, 2, ',', ' '), '1', 0, 'R');    
        $this->Ln();
        //
        $this->Cell($w[0], 6, 'Heure Dimanche', '1', 0);
        $this->Cell($w[1], 6, $hdim->total_heure, '1', 0,'R');
        $this->Cell($w[2], 6,number_format($hdim->taux_horaire,2,',',' '), '1', 0, 'R');
        $this->Cell($w[3], 6, number_format($hdim->montant, 2, ',', ' '), '1', 0, 'R');    
        $this->Ln();
        //
        $this->SetFont('');
        $this->Cell($w[0], 6, 'Heure Jour Ferie avec travail ','1', 0);
        $this->Cell($w[1], 6, $hfw->total_heure,'1', 0,'R');
        $this->Cell($w[2], 6,number_format($hfw->taux_horaire,2,',',' '), '1', 0, 'R');
        $this->Cell($w[3], 6, number_format($hfw->montant, 2, ',', ' '), '1', 0, 'R');    
        $this->Ln();
        //
        $this->Cell($w[0], 6, 'Heure Jour Ferie', '1', 0);
        $this->Cell($w[1], 6, $hf->total_heure, '1', 0,'R');
        $this->Cell($w[2], 6,number_format($hf->taux_horaire,2,',',' '), '1', 0, 'R');
        $this->Cell($w[3], 6, number_format($hf->montant, 2, ',', ' '), '1', 0, 'R');    
        $this->Ln();
        //
        $this->Cell($w[0], 6, 'Heure Sup 30%', '1', 0,);
        $this->Cell($w[1], 6, isset($hs30->total_heure) ? number_format($hs30->total_heure, 2, ',', ' ') : 0, '1', 0,'R');
        $this->Cell($w[2], 6,isset($hs30->taux_horaire) ? number_format($hs30->taux_horaire, 2, ',', ' ') : 0, '1', 0, 'R');
        $this->Cell($w[3], 6, isset($hs30->montant) ? number_format($hs30->montant, 2, ',', ' ') : 0, 1, 0, 'R');
        $this->Ln();

        //
        $this->Cell($w[0], 6, 'Heure Sup 50%', '1', 0,);
        $this->Cell($w[1], 6, isset($hs50->total_heure) ? number_format($hs50->total_heure, 2, ',', ' ') : 0, '1', 0,'R');
        $this->Cell($w[2], 6,isset($hs50->taux_horaire) ? number_format($hs50->taux_horaire, 2, ',', ' ') : 0, '1', 0, 'R');
        $this->Cell($w[3], 6, isset($hs50->montant) ? number_format($hs50->montant, 2, ',', ' ') : 0, 1, 0, 'R');
        $this->Ln();
        
        // SOMME ----------------------------------------------------------------
        $this->SetFont('');
        $this->Cell($w[0], 6, '', 'LR', 0);
        $this->Cell($w[1], 6, '', 'LR', 0);
        $this->Cell($w[2], 6,'Total ', 'LR', 0, 'R');
        $this->Cell($w[3], 6, number_format($montant->montant_total, 2, ',', ' '), '1', 0, 'R');    
        $this->Ln();
        //
        $this->Cell($w[0], 6, '', 'LR', 0);
        $this->Cell($w[1], 6, '', 'LR', 0);
        $this->Cell($w[2], 6,'Indemnite', 'LR', 0, 'R');
        $this->Cell($w[3], 6, number_format($indemnite, 2, ',', ' '), '1', 0, 'R');    
        $this->Ln();
        //
        $this->Cell($w[0], 6, '', 'LR', 0);
        $this->Cell($w[1], 6, '', 'LR', 0);
        $this->Cell($w[2], 6,'Total a payer', 'LR', 0, 'R');
        $this->Cell($w[3], 6, number_format($total, 2, ',', ' '), '1', 0, 'R');    
        $this->Ln();
        // Trait de terminaison
        $this->Cell(array_sum($w),0,'','T');
        $this->Ln(5);
    }

    
}
?>
