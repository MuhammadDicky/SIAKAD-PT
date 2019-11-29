<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Include the main TCPDF library (search for installation path).
require_once('../vendor/tecnickcom/tcpdf/tcpdf.php');

class CustomHeader extends TCPDF {
    /* custom table */
    // Load table data from file
    public function Header() {
        // Logo
        $image_file = get_real_path('/assets/web-images/pt-icon-profile.png');
        $this->Image($image_file, 15, 15, 20, 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 18);
        // Title
        /*$this->Cell(143, 0, web_detail('_pt_name'), 1, 1, 'C', 0, '', 0,false, 'T', 'M');*/
        $html = '<font>'.web_detail('_pt_name').'</font>';
        $this->writeHTMLCell(143, 0, 35, 17, $html, 0, 1, 0, false, 'C',false);
        /*$this->writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)*/
        $this->Image($image_file, 178, 15, 20, 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', '', 8);
        // Page number
        $this->Cell(0, 10, 'Halaman '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    public function LoadData($file) {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line) {
            $data[] = explode(';', chop($line));
        }
        return $data;
    }

    // Colored table
    public function ColoredTable($header,$data,$lvl) {
        // Colors, line width and bold font
        $this->SetFillColor(255);
        $this->SetTextColor(0);
        $this->SetDrawColor(0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        //$w = array(40, 35, 40, 45);
        
        $num_headers = count($header);
        if ($lvl == 'mhs') {
            $this->SetY(60);
            switch($num_headers){
                case 3:{$w = array(30,110,40);break;}
                case 4:{$w = array(20,30,90,40);break;}
            }
        }
        elseif ($lvl == 'ptk') {
            $this->SetY(55);
            switch($num_headers){
                case 3:{$w = array(30,110,40);break;}
                case 4:{$w = array(20,45,75,40);break;}
            }
        }
        $i = 0;
        foreach($header as $row=>$value) {
            $this->Cell($w[$i], 7, $value, 1, 0, 'C', 1);
            $i++;
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(245);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        $i = 0;
        $kolom = count($header);
        
        for($i = 0; $i < count($data); $i++) {
            $c = 0;
            foreach($data[$i] as $row=>$key){
                
                //format tanggal ditengah
                if($row == "no" || $row == "nim" || $row == "nidn" || $row == "password"){
                    $this->Cell($w[$c], 6,$key, 'LR', 0,'C',$fill);
                }
                else {
                    //format jumlah uang dikanan
                    if($row == "jumlah"){
                        $this->Cell($w[$c], 6,$key, 'LR', 0, 'R',$fill);    
                    }
                    else {
                        $this->Cell($w[$c], 6,$key, 'LR', 0, 'L',$fill);
                    }    
                } 
                $c++;
            }
            $this->Ln();
               $fill=!$fill;         
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}