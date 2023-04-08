<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pdf extends CI_Controller
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
	public function generate_pdf()
	{
		// Load library TCPDF
		$this->load->library('tcpdf');

		// Create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// Set document properties
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Your Name');
		$pdf->SetTitle('Hello World');
		$pdf->SetSubject('Hello World using TCPDF');
		$pdf->SetKeywords('TCPDF, PDF, Hello World');

		// Add page
		$pdf->AddPage();

		// Write content to PDF
		$pdf->SetFont('helvetica', '', 12);
		$pdf->Write(0, 'Hello World using TCPDF');

		// Output the PDF to browser
		$pdf->Output('hello_world.pdf', 'I');
	}

	public function generate_pdf2()
	{
		// Load library TCPDF
		$this->load->library('tcpdf');

		// Create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// Set document properties
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Your Name');
		$pdf->SetTitle('Complex PDF');
		$pdf->SetSubject('Complex PDF using TCPDF');
		$pdf->SetKeywords('TCPDF, PDF, Complex');

		// Add page
		$pdf->AddPage();

		// Set font
		$pdf->SetFont('helvetica', '', 12);

		// Add image
		$image_file = FCPATH . 'assets/images/logo.png';
		$pdf->Image($image_file, 10, 10, 50, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		// Add table
		$html = '
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>john.doe@example.com</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jane Doe</td>
                    <td>jane.doe@example.com</td>
                </tr>
            </tbody>
        </table>
    ';
		$pdf->writeHTML($html, true, false, true, false, '');

		// Output the PDF to browser
		$pdf->Output('complex.pdf', 'I');
	}

	public function generate_pdf_with_barcode()
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
