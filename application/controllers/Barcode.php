<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barcode extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function generate_barcode()
	{
		// Load library TCPDF
		$this->load->library('tcpdf');

		// Create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// Set document properties
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Your Name');
		$pdf->SetTitle('Barcode PDF');
		$pdf->SetSubject('Barcode PDF using TCPDF');
		$pdf->SetKeywords('TCPDF, PDF, Barcode');

		// Add page
		$pdf->AddPage();

		// Set font
		$pdf->SetFont('helvetica', '', 12);

		// Set barcode settings
		$barcode_value = '123456789';
		$barcode = new TCPDFBarcode($barcode_value, 'C128');

		// Generate barcode image
		$pdf->write1DBarcode($barcode_value, 'C128', '', '', '', 18, 0.4, $style, 'N');

		// Output the PDF to browser
		$pdf->Output('barcode.pdf', 'I');
	}
}
