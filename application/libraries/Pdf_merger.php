<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('./vendor/tecnickcom/tcpdf/tcpdf.php');
require_once('./vendor/setasign/fpdi/src/autoload.php');
require_once('./vendor/setasign/fpdf/fpdf.php');

use setasign\Fpdi\Fpdi;

class Pdf_merger extends Fpdi
{
  public function __construct()
  {
    parent::__construct();
  }

  public function merge_pdfs($files, $output_filename)
  {
    foreach ($files as $file) {
      $pageCount = $this->setSourceFile($file);
      for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
        $templateId = $this->importPage($pageNo);
        $size = $this->getTemplateSize($templateId);

        // Menentukan orientasi halaman berdasarkan lebar dan tinggi
        $orientation = $size['width'] > $size['height'] ? 'L' : 'P';

        $this->AddPage($orientation, [$size['width'], $size['height']]);
        $this->useTemplate($templateId);
      }
    }
    $this->Output($output_filename, 'D');
  }
}
