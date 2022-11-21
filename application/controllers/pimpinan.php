<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pimpinan extends CI_Controller {

	function __construct() {
		parent::__construct();

		if($this->session->userdata('login') != TRUE)
		{
			$this->load->view('pimpinan/error');
		}

		$this->load->model('pimpinanmodel');
		$this->load->model('model');
	}

	function index(){

		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '2'){
			
			$this->load->view('pimpinan/error');

		}
		else {
		
			$this->load->model('model');
			$data = array(
				'title'			=> 'Selamat Datang Pimpinan',
				'nama'			=> $sesinya['nama'],
				'petunjuk'		=> $this->model->getPetunjuk(),
				'wewenang'		=> $this->model->getWewenang(),
				'titlesistem'	=> $this->model->getTitle(),
			);
			
			$this->load->view('pimpinan/header',$data);
			$this->load->view('pimpinan/dashboard');
			$this->load->view('pimpinan/footer');

		}
	}

	function cetak_kebun(){

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '2'){
			
				$this->load->view('pimpinan/error');

		}
		else {

			$data_kebun = $this->pimpinanmodel->selectdata('data_kebun')->result_array();

			$data = array(
				'title'			=> 'Cetak Data Kebun',
				'nama'			=> $sesinya['nama'],
				'data_kebun'		=> $data_kebun,
				'titlesistem'	=> $this->model->getTitle(),
			);
			
			$this->load->view('pimpinan/header',$data);
			$this->load->view('pimpinan/cetak_kebun');
			$this->load->view('pimpinan/footer');

		}	

	}

	function cetak_hasilpanen(){

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '2'){
			
				$this->load->view('pimpinan/error');

		}
		else {

			$data_hasilpanen = $this->pimpinanmodel->selectdata('data_hasilpanen LEFT JOIN data_kebun on data_hasilpanen.nomor_petak=data_kebun.nomor_petak')->result_array();

			$data = array(
				'title'			=> 'Cetak Data Hasil Panen',
				'nama'			=> $sesinya['nama'],
				'data_hasilpanen'		=> $data_hasilpanen,
				'titlesistem'	=> $this->model->getTitle(),
			);
			
			$this->load->view('pimpinan/header',$data);
			$this->load->view('pimpinan/cetak_hasilpanen');
			$this->load->view('pimpinan/footer');

		}	

	}

	function cetak_hasilpanen_view(){

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '2'){
			
				$this->load->view('pimpinan/error');

		}
		else {

		


		$this->load->library('Pdf');

 		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		$pdf->AddPage();
		$pdf->Image(base_url().'assets/img/logo-SMA.png', 15, 15, 25, 25, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
		$pdf->SetFont('helvetica', 'B', 14);
		$pdf->Write(0, 'SISTEM INFORMASI EVALUASI', '', 0, 'C', true, 0, false, false, 0);
		$pdf->Write(0, 'PT. PERKEBUNAN NUSANTARA II Kwala Madu', '', 0, 'C', true, 0, false, false, 0);
		$pdf->Write(0, 'Kecamatan Stabat, Kabupaten Langkat', '', 0, 'C', true, 0, false, false, 0);
		$pdf->SetFont('helvetica', '', 9);
		$pdf->Write(0, 'Jalan Binjai - Stabat No.99'.' Telp. 061-111-222', '', 0, 'C', true, 0, false, false, 0);
		$pdf->Write(0, 'Email : admin@ptpn2.com Kode Pos : 20811', '', 0, 'C', true, 0, false, false, 0);
		//$pdf->Write(0, 'Peringkat Akreditasi : A Nomor : 200/BAP-S/M/TU/XI/2015 Tanggal 22 Desember 2015', '', 0, 'C', true, 0, false, false, 0);
		$pdf->Ln();

		//header
		$data_hasilpanen = $this->pimpinanmodel->selectdata('data_hasilpanen LEFT JOIN data_kebun on data_hasilpanen.nomor_petak=data_kebun.nomor_petak')->result_array();
		$pdf->SetFont('helvetica', '', 12);

		$tbl_header = '
		<table cellspacing="0" cellpadding="5" border="1">
			<tr>
				<td colspan="2" align="center">LAPORAN DATA HASIL PANEN</td>
			</tr>
		</table>';

		$tbl_header .='
		<table border="1" align="center">
		<thead><tr><th>No</th><th>Nomor SPTA</th><th>Nomor Petak</th><th>Kebun</th><th>Blok</th><th>Luas (Hektar)</th><th>Bruto (Kg)</th><th>Tara (Kg)</th><th>Netto (Kg)</th><th>Tanggal Timbang</th></tr></thead>
        <tbody>';

        $tbl='';

		
	    foreach($data_hasilpanen as $p)
	    {
	        $tbl .= '<tr><td style="border:1px solid #000;text-align:center">'.$p["no_hasilpanen"].'</td>'; 
	        $tbl .= '<td style="border:1px solid #000;text-align:center">'.$p["no_spta"].'</td>';
	        $tbl .= '<td style="border:1px solid #000;text-align:center">'.$p["nomor_petak"].'</td>';
			$tbl .= '<td style="border:1px solid #000;text-align:center">'.$p["nama_kebun"].'</td>'; 
	        $tbl .= '<td style="border:1px solid #000;text-align:center">'.$p["blok"].'</td>';
			$tbl .= '<td style="border:1px solid #000;text-align:center">'.$p["luas"].'</td>';
			$tbl .= '<td style="border:1px solid #000;text-align:center">'.number_format($p['bruto']).'</td>';
			$tbl .= '<td style="border:1px solid #000;text-align:center">'.number_format($p["tara"]).'</td>';
			$tbl .= '<td style="border:1px solid #000;text-align:center">'.number_format($p["netto"]).'</td>';
	        $tbl .= '<td style="border:1px solid #000;text-align:center">'.$p["tgl_timbang"].'</td>    </tr>';
	    }
		
		$tbl_footer = "</table>";


		$pdf->writeHTML($tbl_header.$tbl.$tbl_footer, true, false, false, false, '');
		$pdf->Output('cetak_hasilpanen.pdf', 'I');

		//pdf
		}	

	}

	function cetak_kebun_view(){

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '2'){
			
				$this->load->view('pimpinan/error');

		}
		else {

		


		$this->load->library('Pdf');

 		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		$pdf->AddPage();
		$pdf->Image(base_url().'assets/img/logo-SMA.png', 15, 15, 25, 25, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
		$pdf->SetFont('helvetica', 'B', 14);
		$pdf->Write(0, 'SISTEM INFORMASI EVALUASI', '', 0, 'C', true, 0, false, false, 0);
		$pdf->Write(0, 'PT. PERKEBUNAN NUSANTARA II Kwala Madu', '', 0, 'C', true, 0, false, false, 0);
		$pdf->Write(0, 'Kecamatan Stabat, Kabupaten Langkat', '', 0, 'C', true, 0, false, false, 0);
		$pdf->SetFont('helvetica', '', 9);
		$pdf->Write(0, 'Jalan Binjai - Stabat No.99'.' Telp. 061-111-222', '', 0, 'C', true, 0, false, false, 0);
		$pdf->Write(0, 'Email : admin@ptpn2.com Kode Pos : 20811', '', 0, 'C', true, 0, false, false, 0);
		//$pdf->Write(0, 'Peringkat Akreditasi : A Nomor : 200/BAP-S/M/TU/XI/2015 Tanggal 22 Desember 2015', '', 0, 'C', true, 0, false, false, 0);
		$pdf->Ln();

		//header
		$data_kebun = $this->pimpinanmodel->selectdata('data_kebun')->result_array();
		$pdf->SetFont('helvetica', '', 12);

		$tbl_header = '
		<table cellspacing="0" cellpadding="5" border="1">
			<tr>
				<td colspan="2" align="center">LAPORAN DATA KEBUN</td>
			</tr>
		</table>';

		$tbl_header .='
		<table border="1" align="center">
		<thead><tr><th>No</th><th>Nomor Petak</th><th>Kebun</th><th>Blok</th><th>Luas (Hektar)</th></tr></thead>
        <tbody>';

        $tbl='';

		
	    foreach($data_kebun as $p)
	    {
	        $tbl .= '<tr><td style="border:1px solid #000;text-align:center">'.$p["no"].'</td>'; 
	        $tbl .= '<td style="border:1px solid #000;text-align:center">'.$p["nomor_petak"].'</td>';
	        $tbl .= '<td style="border:1px solid #000;text-align:center">'.$p["nama_kebun"].'</td>';
	        $tbl .= '<td style="border:1px solid #000;text-align:center">'.$p["blok"].'</td>';
	        $tbl .= '<td style="border:1px solid #000;text-align:center">'.$p["luas"].'</td> </tr>';
	    }
		
		$tbl_footer = "</table>";


		$pdf->writeHTML($tbl_header.$tbl.$tbl_footer, true, false, false, false, '');
		$pdf->Output('cetak_kebun.pdf', 'I');

		//pdf
		}	

	}

	function logout(){
		$this->session->sess_destroy();
		redirect('');
	}


}