<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrasi extends CI_Controller {

	function __construct() {
		parent::__construct();

		if($this->session->userdata('login') != TRUE)
		{
			$this->load->view('admin/error');
		}

		$this->load->model('adminmodel');
		$this->load->model('model');
	}

	function index(){

		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
			$this->load->view('admin/error');

		}
		else {
		
			$this->load->model('model');
			$data = array(
				'title'			=> 'Selamat Datang Bagian Admin',
				'nama'			=> $sesinya['nama'],
				'petunjuk'		=> $this->model->getPetunjuk(),
				'wewenang'		=> $this->model->getWewenang(),
				'titlesistem'	=> $this->model->getTitle(),
			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/dashboard');
			$this->load->view('admin/footer');

		}

	}

	function data_kebun_view(){

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data_kebun = $this->adminmodel->selectdata('data_kebun order by no asc')->result_array();

			$data = array(
				'title'			=> 'Data Kebun',
				'nama'			=> $sesinya['nama'],
				'data_kebun'	=> $data_kebun,
				'titlesistem'	=> $this->model->getTitle(),
			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_kebun');
			$this->load->view('admin/footer');

		}	

	}

	function data_kebun_add(){
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data = array(
				'title'				=> 'Tambah Data Kebun',
				'nama'				=> $sesinya['nama'],
				'titlesistem'		=> $this->model->getTitle(),
				'no'				=> '',
				'status'			=> 'baru',
				'nomor_petak'		=> '',
				'nama_kebun'		=> '',
				'blok'				=> '',
				'luas'				=> ''
			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_kebun_form');
			$this->load->view('admin/footer');

		}	
	}

	function data_kebun_save(){
		if($_POST){

			$status 				= $this->input->post('status');
			$no 					= $this->input->post('no');
			$nomor_petak			= $this->input->post('nomor_petak');
			$nama_kebun				= $this->input->post('nama_kebun');
			$blok					= $this->input->post('blok');
			$luas					= $this->input->post('luas');

			if($status == 'baru'){
				$data = array(
					'nomor_petak'	=> $nomor_petak,
					'nama_kebun'	=> $nama_kebun,
					'blok'			=> $blok,
					'luas'			=> $luas
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah tesimpan.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->insertdata('data_kebun',$data);
				redirect('administrasi/data_kebun');

			}
			else {
				$data = array(
					'nomor_petak'	=> $nomor_petak,
					'nama_kebun'	=> $nama_kebun,
					'blok'			=> $blok,
					'luas'			=> $luas
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah diperbarui.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->updatedata('data_kebun',$data,array('no' => $no));
				redirect('administrasi/data_kebun');
			}
		}
		else {
			$this->load->view('admin/error');
		}
	}


	function data_kebun_edit($id = ''){
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data_kebun = $this->adminmodel->selectdata('data_kebun where no = "'.$id.'"')->result_array();

			$data = array(
				'title'				=> 'Edit Data Kebun',
				'titlesistem'		=> $this->model->getTitle(),
				'nama'				=> $sesinya['nama'],
				'no'				=> $data_kebun[0]['no'],
				'status'			=> 'edit',
				'nomor_petak'		=> $data_kebun[0]['nomor_petak'],
				'nama_kebun'		=> $data_kebun[0]['nama_kebun'],
				'luas'				=> $data_kebun[0]['luas'],
				'blok'				=> $data_kebun[0]['blok'],

			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_kebun_form');
			$this->load->view('admin/footer');

		}	
	}

	function data_kebun_del($id = ''){
		$hasil	= $this->adminmodel->deldata('data_kebun',array('no' => $id));
		$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda berhasil dihapus.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
		redirect('administrasi/data_kebun');
	}

	function data_hasilpanen_view(){

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data_hasilpanen = $this->adminmodel->selectdata('data_hasilpanen LEFT JOIN data_kebun on data_hasilpanen.nomor_petak=data_kebun.nomor_petak')->result_array();

			$data = array(
				'title'				=> 'Hasil Panen',
				'nama'				=> $sesinya['nama'],
				'data_hasilpanen'	=> $data_hasilpanen,
				'titlesistem'		=> $this->model->getTitle(),
			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_hasilpanen');
			$this->load->view('admin/footer');

		}	

	}

	function data_hasilpanen_add(){
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data_kebun = $this->adminmodel->selectdata('data_kebun order by no asc')->result_array();

			$data = array(
				'title'				=> 'Tambah Data Hasil Panen',
				'nama'				=> $sesinya['nama'],
				'titlesistem'		=> $this->model->getTitle(),
				'no_hasilpanen'		=> '',
				'status'			=> 'baru',
				'no_spta'			=> '',
				'nomor_petak'		=> '',
				'bruto'				=> '',
				'tara'				=> '',
				'netto'				=> '',
				'tgl_timbang'		=> '',

			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_hasilpanen_form');
			$this->load->view('admin/footer');

		}	
	}


	function data_hasilpanen_save(){
		if($_POST){

			$status 			= $this->input->post('status');
			$no_hasilpanen 		= $this->input->post('no_hasilpanen');
			$no_spta			= $this->input->post('no_spta');
			$nomor_petak		= $this->input->post('nomor_petak');
			$bruto				= $this->input->post('bruto');
			$tara				= $this->input->post('tara');
			$netto				= $this->input->post('netto');
			$tgl_timbang		= $this->input->post('tgl_timbang');

			if($status == 'baru'){
				$data = array(
					'no_hasilpanen'		=> $no_hasilpanen,
					'no_spta'			=> $no_spta,
					'nomor_petak'		=> $nomor_petak,
					'bruto' 			=> $bruto,
					'tara'				=> $tara,
					'netto'				=> $netto,
					'tgl_timbang'		=> $tgl_timbang
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah tesimpan.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->insertdata('data_hasilpanen',$data);
				redirect('administrasi/data_hasilpanen');

			}
			else {
				$data = array(
					'no_hasilpanen'		=> $no_hasilpanen,
					'no_spta'			=> $no_spta,
					'nomor_petak'		=> $nomor_petak,
					'bruto' 			=> $bruto,
					'tara'				=> $tara,
					'netto'				=> $netto,
					'tgl_timbang'		=> $tgl_timbang
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah diperbarui.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->updatedata('data_hasilpanen',$data,array('no_hasilpanen' => $no_hasilpanen));
				redirect('administrasi/data_hasilpanen');
			}
		}
		else {
			$this->load->view('admin/error');
		}
	}


	function data_hasilpanen_edit($id = ''){
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data_hasilpanen = $this->adminmodel->selectdata('data_hasilpanen where no_hasilpanen = "'.$id.'"')->result_array();
			$data_kebun = $this->adminmodel->selectdata('data_kebun order by no asc')->result_array();

			$data = array(
				'title'				=> 'Edit Data Hasil Panen',
				'titlesistem'		=> $this->model->getTitle(),
				'nama'				=> $sesinya['nama'],
				'no_hasilpanen'		=> $data_hasilpanen[0]['no_hasilpanen'],
				'status'			=> 'edit',
				'no_spta'			=> $data_hasilpanen[0]['no_spta'],
				'nomor_petak'		=> $data_hasilpanen[0]['nomor_petak'],
				'bruto' 			=> $data_hasilpanen[0]['bruto'],
				'tara'				=> $data_hasilpanen[0]['tara'],
				'netto'				=> $data_hasilpanen[0]['netto'],
				'tgl_timbang'		=> $data_hasilpanen[0]['tgl_timbang'],

			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_hasilpanen_form');
			$this->load->view('admin/footer');

		}	
	}

	function data_hasilpanen_del($id = ''){
		$hasil	= $this->adminmodel->deldata('data_hasilpanen',array('no_hasilpanen' => $id));
		$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda berhasil dihapus.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
		redirect('administrasi/data_hasilpanen');
	}

function data_puskesmas_view(){

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data_puskesmas = $this->adminmodel->selectdata('data_puskesmas order by no_puskesmas desc')->result_array();

			$data_update = mysql_query("select data_puskesmas.no_puskesmas,data_puskesmas.nama_puskesmas, ROUND(AVG(jumlah_fasilitas_puskesmas.jumlah_fasilitas)) AS jumlah_fasilitas_total,ROUND(AVG(jumlah_obat_puskesmas.jumlah_obat)) AS ketersediaan_obat_total,ROUND(AVG(jumlah_penyakit_puskesmas.no_penyakit-20)) AS jumlah_pasien_total from data_puskesmasINNER JOIN jumlah_fasilitas_puskesmas on jumlah_fasilitas_puskesmas.no_puskesmas=data_puskesmas.no_puskesmas INNER JOIN jumlah_penyakit_puskesmas on jumlah_penyakit_puskesmas.no_puskesmas=data_puskesmas.no_puskesmas INNER JOIN jumlah_obat_puskesmas on jumlah_obat_puskesmas.no_puskesmas=data_puskesmas.no_puskesmas GROUP by data_puskesmas.no_puskesmas");
			
			$data = array(
				'title'			=> '.:: Data Puskesmas ::. ',
				'nama'			=> $sesinya['nama'],
				'data_puskesmas'		=> $data_puskesmas,
				'titlesistem'	=> $this->model->getTitle(),
			);
			



			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_puskesmas');
			$this->load->view('admin/footer');

		}	

	}

	function data_puskesmas_add(){
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data = array(
				'title'				=> '.:: Tambah Data Penyakit ::. ',
				'nama'				=> $sesinya['nama'],
				'titlesistem'		=> $this->model->getTitle(),
				'no_puskesmas'		=> '',
				'status'			=> 'baru',
				'nama_puskesmas'		=> '',

			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_puskesmas_form');
			$this->load->view('admin/footer');

		}	
	}

	function data_puskesmas_save(){
		if($_POST){

			$status 			= $this->input->post('status');
			$no_puskesmas 				= $this->input->post('no_puskesmas');
			$nama_puskesmas				= $this->input->post('nama_puskesmas');

			if($status == 'baru'){
				$data = array(
					'nama_puskesmas'	=> $nama_puskesmas,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah tesimpan.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->insertdata('data_puskesmas',$data);
				redirect('administrasi/data_puskesmas');

			}
			else {
				$data = array(
					'nama_puskesmas'	=> $nama_puskesmas,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah diperbarui.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->updatedata('data_puskesmas',$data,array('no_puskesmas' => $no_puskesmas));
				redirect('administrasi/data_puskesmas');
			}
		}
		else {
			$this->load->view('admin/error');
		}
	}


	function data_puskesmas_edit($id = ''){
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data_puskesmas = $this->adminmodel->selectdata('data_puskesmas where no_puskesmas = "'.$id.'"')->result_array();

			$data = array(
				'title'				=> 'Edit Data Penyakit',
				'titlesistem'	=> $this->model->getTitle(),
				'nama'				=> $sesinya['nama'],
				'no_puskesmas'				=> $data_puskesmas[0]['no_puskesmas'],
				'status'			=> 'edit',
				'nama_puskesmas'			=> $data_puskesmas[0]['nama_puskesmas'],

			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_puskesmas_form');
			$this->load->view('admin/footer');

		}	
	}

	function data_puskesmas_del($id = ''){
		$hasil	= $this->adminmodel->deldata('data_puskesmas',array('no_puskesmas' => $id));
		$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda berhasil dihapus.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
		redirect('administrasi/data_puskesmas');
	}


	function data_tahun_view(){

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data_tahun = $this->adminmodel->selectdata('data_tahun order by no_tahun desc')->result_array();

			$data = array(
				'title'			=> '.:: Data Tahun ::. ',
				'nama'			=> $sesinya['nama'],
				'data_tahun'		=> $data_tahun,
				'titlesistem'	=> $this->model->getTitle(),
			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_tahun');
			$this->load->view('admin/footer');

		}	

	}

	function data_tahun_add(){
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data = array(
				'title'				=> '.:: Tambah Data Tahun ::. ',
				'nama'				=> $sesinya['nama'],
				'titlesistem'		=> $this->model->getTitle(),
				'no_tahun'		=> '',
				'status'			=> 'baru',
				'nama_tahun'		=> '',

			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_tahun_form');
			$this->load->view('admin/footer');

		}	
	}

	function data_tahun_save(){
		if($_POST){

			$status 			= $this->input->post('status');
			$no_tahun 				= $this->input->post('no_tahun');
			$nama_tahun				= $this->input->post('nama_tahun');

			if($status == 'baru'){
				$data = array(
					'nama_tahun'	=> $nama_tahun,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah tesimpan.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->insertdata('data_tahun',$data);
				redirect('administrasi/data_tahun');

			}
			else {
				$data = array(
					'nama_tahun'	=> $nama_tahun,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah diperbarui.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->updatedata('data_tahun',$data,array('no_tahun' => $no_tahun));
				redirect('administrasi/data_tahun');
			}
		}
		else {
			$this->load->view('admin/error');
		}
	}


	function data_tahun_edit($id = ''){
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data_tahun = $this->adminmodel->selectdata('data_tahun where no_tahun = "'.$id.'"')->result_array();

			$data = array(
				'title'				=> '.:: Edit Data Tahun ::. ',
				'titlesistem'	=> $this->model->getTitle(),
				'nama'				=> $sesinya['nama'],
				'no_tahun'				=> $data_tahun[0]['no_tahun'],
				'status'			=> 'edit',
				'nama_tahun'			=> $data_tahun[0]['nama_tahun'],

			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_tahun_form');
			$this->load->view('admin/footer');

		}	
	}

	function data_tahun_del($id = ''){
		$hasil	= $this->adminmodel->deldata('data_tahun',array('no_tahun' => $id));
		$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda berhasil dihapus.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
		redirect('administrasi/data_tahun');
	}


	function data_fasilitas_view(){

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data_fasilitas = $this->adminmodel->selectdata('data_fasilitas order by no_fasilitas desc')->result_array();

			$data = array(
				'title'			=> '.:: Data Fasilitas ::. ',
				'nama'			=> $sesinya['nama'],
				'data_fasilitas'		=> $data_fasilitas,
				'titlesistem'	=> $this->model->getTitle(),
			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_fasilitas');
			$this->load->view('admin/footer');

		}	

	}

	function data_fasilitas_add(){
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data = array(
				'title'				=> '.:: Tambah Data Fasilitas ::. ',
				'nama'				=> $sesinya['nama'],
				'titlesistem'		=> $this->model->getTitle(),
				'no_fasilitas'		=> '',
				'status'			=> 'baru',
				'nama_fasilitas'		=> '',

			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_fasilitas_form');
			$this->load->view('admin/footer');

		}	
	}

	function data_fasilitas_save(){
		if($_POST){

			$status 			= $this->input->post('status');
			$no_fasilitas 				= $this->input->post('no_fasilitas');
			$nama_fasilitas				= $this->input->post('nama_fasilitas');

			if($status == 'baru'){
				$data = array(
					'nama_fasilitas'	=> $nama_fasilitas,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah tesimpan.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->insertdata('data_fasilitas',$data);
				redirect('administrasi/data_fasilitas');

			}
			else {
				$data = array(
					'nama_fasilitas'	=> $nama_fasilitas,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah diperbarui.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->updatedata('data_fasilitas',$data,array('no_fasilitas' => $no_fasilitas));
				redirect('administrasi/data_fasilitas');
			}
		}
		else {
			$this->load->view('admin/error');
		}
	}


	function data_fasilitas_edit($id = ''){
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data_fasilitas = $this->adminmodel->selectdata('data_fasilitas where no_fasilitas = "'.$id.'"')->result_array();

			$data = array(
				'title'				=> '.:: Edit Data Tahun ::. ',
				'titlesistem'	=> $this->model->getTitle(),
				'nama'				=> $sesinya['nama'],
				'no_fasilitas'				=> $data_fasilitas[0]['no_fasilitas'],
				'status'			=> 'edit',
				'nama_fasilitas'			=> $data_fasilitas[0]['nama_fasilitas'],

			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_fasilitas_form');
			$this->load->view('admin/footer');

		}	
	}

	function data_fasilitas_del($id = ''){
		$hasil	= $this->adminmodel->deldata('data_fasilitas',array('no_fasilitas' => $id));
		$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda berhasil dihapus.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
		redirect('administrasi/data_fasilitas');
	}


	function data_jumlah_penyakit_puskesmas_view(){

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			// $data_jumlah_penyakit_puskesmas = $this->adminmodel->selectdata('jumlah_penyakit_puskesmas order by no_jumlah_penyakit desc')->result_array();

			$data_jumlah_penyakit_puskesmas = $this->adminmodel->selectdata('jumlah_penyakit_puskesmas INNER JOIN data_tahun ON jumlah_penyakit_puskesmas.no_tahun = data_tahun.no_tahun INNER JOIN data_puskesmas on jumlah_penyakit_puskesmas.no_puskesmas = data_puskesmas.no_puskesmas INNER JOIN data_penyakit on jumlah_penyakit_puskesmas.no_penyakit=data_penyakit.no_penyakit LEFT JOIN data_kebun on data_penyakit.no=data_kebun.no')->result_array();

			// $this->db->select('*');    
			// $this->db->from('table1');
			// $this->db->join('table2', 'table1.id = table2.id');
			// $this->db->join('table3', 'table1.id = table3.id');
			// $query = $this->db->get();

			$data = array(
				'title'			=> '.:: Data Jumlah Penyakit ::. ',
				'nama'			=> $sesinya['nama'],
				'data_jumlah_penyakit_puskesmas'		=> $data_jumlah_penyakit_puskesmas,
				'titlesistem'	=> $this->model->getTitle(),
			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_jumlah_penyakit_puskesmas');
			$this->load->view('admin/footer');

		}	

	}

	function data_jumlah_penyakit_puskesmas_add(){
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {
			$pilih_tahun = $this->adminmodel->selectdata('data_tahun order by no_tahun desc')->result_array();
			$pilih_puskesmas = $this->adminmodel->selectdata('data_puskesmas order by no_puskesmas desc')->result_array();
			$pilih_penyakit = $this->adminmodel->selectdata('data_penyakit order by no_penyakit desc')->result_array();

			$data = array(
				'title'				=> '.:: Tambah Data Jumlah ::. ',
				'nama'				=> $sesinya['nama'],
				'titlesistem'		=> $this->model->getTitle(),
				'no_jumlah_penyakit'		=> '',
				'status'			=> 'baru',
				'no_tahun'			=> $pilih_tahun,
				'no_puskesmas'		=> $pilih_puskesmas,
				'nama_pasien'			=> '',
				'no_penyakit'		=> $pilih_penyakit,

			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_jumlah_penyakit_puskesmas_form');
			$this->load->view('admin/footer');

		}	
	}

	function data_jumlah_penyakit_puskesmas_save(){
		if($_POST){

			$status 				= $this->input->post('status');
			$no_jumlah_penyakit		= $this->input->post('no_jumlah_penyakit');
			$no_tahun				= $this->input->post('no_tahun');
			$no_puskesmas			= $this->input->post('no_puskesmas');
			$nama_pasien			= $this->input->post('nama_pasien');
			$no_penyakit				= $this->input->post('no_penyakit');

			if($status == 'baru'){
				$data = array(
					'no_tahun'	=> $no_jumlah_penyakit,
					'no_puskesmas'	=> $no_puskesmas,
					'nama_pasien'	=> $nama_pasien,
					'no_penyakit'	=> $no_penyakit,
					'no_tahun'	=> $no_tahun,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah tesimpan.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->insertdata('jumlah_penyakit_puskesmas',$data);
				redirect('administrasi/data_jumlah_penyakit_puskesmas');

			}
			else {
				$data = array(
					'no_jumlah_penyakit'	=> $no_penyakit,
					'no_puskesmas'	=> $no_puskesmas,
					'nama_pasien'	=> $nama_pasien,
					'no_penyakit'	=> $no_penyakit,
					'no_tahun'	=> $no_tahun,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah diperbarui.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->updatedata('jumlah_penyakit_puskesmas',$data,array('no_jumlah_penyakit' => $no_jumlah_penyakit));
				redirect('administrasi/data_jumlah_penyakit_puskesmas');
			}
		}
		else {
			$this->load->view('admin/error');
		}
	}


	function data_jumlah_penyakit_puskesmas_edit($id = ''){
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$jumlah_penyakit_puskesmas = $this->adminmodel->selectdata('jumlah_penyakit_puskesmas where no_jumlah_penyakit = "'.$id.'"')->result_array();
			$pilih_tahun = $this->adminmodel->selectdata('data_tahun order by no_tahun desc')->result_array();
			$pilih_puskesmas = $this->adminmodel->selectdata('data_puskesmas order by no_puskesmas desc')->result_array();
			$pilih_penyakit = $this->adminmodel->selectdata('data_penyakit order by no_penyakit desc')->result_array();

			$data = array(
				'title'				=> '.:: Edit Data Jumlah Penyakit ::. ',
				'titlesistem'	=> $this->model->getTitle(),
				'nama'				=> $sesinya['nama'],
				'no_jumlah_penyakit'				=> $jumlah_penyakit_puskesmas[0]['no_jumlah_penyakit'],
				'status'			=> 'edit',
				'no_tahun'			=> $pilih_tahun,
				'no_puskesmas'			=> $pilih_puskesmas,
				'nama_pasien'				=> $jumlah_penyakit_puskesmas[0]['nama_pasien'],
				'no_penyakit'			=> $pilih_penyakit,

			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_jumlah_penyakit_puskesmas_form');
			$this->load->view('admin/footer');

		}	
	}

	function data_jumlah_penyakit_puskesmas_del($id = ''){
		$hasil	= $this->adminmodel->deldata('jumlah_penyakit_puskesmas',array('no_jumlah_penyakit' => $id));
		$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda berhasil dihapus.
					</div>
				';
		$this->session->set_flashdata('sukses', $sukses);
		redirect('administrasi/data_jumlah_penyakit_puskesmas');
	}

	function data_jumlah_fasilitas_puskesmas_view(){

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data_jumlah_fasilitas_puskesmas = $this->adminmodel->selectdata('jumlah_fasilitas_puskesmas LEFT JOIN data_puskesmas on jumlah_fasilitas_puskesmas.no_puskesmas = data_puskesmas.no_puskesmas LEFT JOIN data_fasilitas on jumlah_fasilitas_puskesmas.no_fasilitas=data_fasilitas.no_fasilitas')->result_array();

			$data = array(
				'title'			=> '.:: Data Fasilitas Penyakit ::. ',
				'nama'			=> $sesinya['nama'],
				'data_jumlah_fasilitas_puskesmas'		=> $data_jumlah_fasilitas_puskesmas,
				'titlesistem'	=> $this->model->getTitle(),
			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_jumlah_fasilitas_puskesmas');
			$this->load->view('admin/footer');

		}	

	}

	function data_jumlah_fasilitas_puskesmas_add(){
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {
			$pilih_puskesmas = $this->adminmodel->selectdata('data_puskesmas order by no_puskesmas desc')->result_array();
			$pilih_fasilitas = $this->adminmodel->selectdata('data_fasilitas order by no_fasilitas desc')->result_array();

			$data = array(
				'title'				=> '.:: Tambah Data Fasilitas ::. ',
				'nama'				=> $sesinya['nama'],
				'titlesistem'		=> $this->model->getTitle(),
				'no_jumlah_fasilitas'		=> '',
				'status'			=> 'baru',
				'no_puskesmas'		=> $pilih_puskesmas,
				'no_fasilitas'		=> $pilih_fasilitas,
				'jumlah_fasilitas'			=> '',

			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_jumlah_fasilitas_puskesmas_form');
			$this->load->view('admin/footer');

		}	
	}

	function data_jumlah_fasilitas_puskesmas_save(){
		if($_POST){

			$status 				= $this->input->post('status');
			$no_jumlah_fasilitas		= $this->input->post('no_jumlah_fasilitas');
			$no_puskesmas			= $this->input->post('no_puskesmas');
			$no_fasilitas				= $this->input->post('no_fasilitas');
			$jumlah_fasilitas			= $this->input->post('jumlah_fasilitas');

			if($status == 'baru'){
				$data = array(
					'no_puskesmas'	=> $no_puskesmas,
					'no_fasilitas'	=> $no_fasilitas,
					'jumlah_fasilitas'	=> $jumlah_fasilitas,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah tesimpan.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->insertdata('jumlah_fasilitas_puskesmas',$data);
				redirect('administrasi/data_jumlah_fasilitas_puskesmas');

			}
			else {
				$data = array(
					'no_puskesmas'	=> $no_puskesmas,
					'no_fasilitas'	=> $no_fasilitas,
					'jumlah_fasilitas'	=> $jumlah_fasilitas,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah diperbarui.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->updatedata('jumlah_fasilitas_puskesmas',$data,array('no_jumlah_fasilitas' => $no_jumlah_fasilitas));
				redirect('administrasi/data_jumlah_fasilitas_puskesmas');
			}
		}
		else {
			$this->load->view('admin/error');
		}
	}


	function data_jumlah_fasilitas_puskesmas_edit($id = ''){
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$jumlah_fasilitas_puskesmas = $this->adminmodel->selectdata('jumlah_fasilitas_puskesmas where no_jumlah_fasilitas = "'.$id.'"')->result_array();
			$pilih_puskesmas = $this->adminmodel->selectdata('data_puskesmas order by no_puskesmas desc')->result_array();
			$pilih_fasilitas = $this->adminmodel->selectdata('data_fasilitas order by no_fasilitas desc')->result_array();

			$data = array(
				'title'					=> '.:: Edit Data Jumlah Penyakit ::. ',
				'titlesistem'			=> $this->model->getTitle(),
				'nama'					=> $sesinya['nama'],
				'no_jumlah_fasilitas'	=> $jumlah_fasilitas_puskesmas[0]['no_jumlah_fasilitas'],
				'status'			=> 'edit',
				'no_puskesmas'			=> $pilih_puskesmas,
				'no_fasilitas'			=> $pilih_fasilitas,
				'jumlah_fasilitas'		=> $jumlah_fasilitas_puskesmas[0]['jumlah_fasilitas'],

			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_jumlah_fasilitas_puskesmas_form');
			$this->load->view('admin/footer');

		}	
	}

	function data_jumlah_fasilitas_puskesmas_del($id = ''){
		$hasil	= $this->adminmodel->deldata('jumlah_fasilitas_puskesmas',array('no_jumlah_fasilitas' => $id));
		$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda berhasil dihapus.
					</div>
				';
		$this->session->set_flashdata('sukses', $sukses);
		redirect('administrasi/data_jumlah_fasilitas_puskesmas');
	}

		function data_jumlah_obat_puskesmas_view(){

		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$data_jumlah_obat_puskesmas = $this->adminmodel->selectdata('jumlah_obat_puskesmas LEFT JOIN data_puskesmas on jumlah_obat_puskesmas.no_puskesmas = data_puskesmas.no_puskesmas LEFT JOIN data_kebun on jumlah_obat_puskesmas.no=data_kebun.no')->result_array();

			$data = array(
				'title'			=> '.:: Data Obat Penyakit ::. ',
				'nama'			=> $sesinya['nama'],
				'data_jumlah_obat_puskesmas'		=> $data_jumlah_obat_puskesmas,
				'titlesistem'	=> $this->model->getTitle(),
			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_jumlah_obat_puskesmas');
			$this->load->view('admin/footer');

		}	

	}

	function data_jumlah_obat_puskesmas_add(){
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {
			$pilih_puskesmas = $this->adminmodel->selectdata('data_puskesmas order by no_puskesmas desc')->result_array();
			$pilih_obat = $this->adminmodel->selectdata('data_kebun order by no desc')->result_array();

			$data = array(
				'title'				=> '.:: Tambah Data Obat ::. ',
				'nama'				=> $sesinya['nama'],
				'titlesistem'		=> $this->model->getTitle(),
				'no_jumlah_obat'		=> '',
				'status'			=> 'baru',
				'no_puskesmas'		=> $pilih_puskesmas,
				'no'		=> $pilih_obat,
				'jumlah_obat'			=> '',

			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_jumlah_obat_puskesmas_form');
			$this->load->view('admin/footer');

		}	
	}

	function data_jumlah_obat_puskesmas_save(){
		if($_POST){

			$status 				= $this->input->post('status');
			$no_jumlah_obat		= $this->input->post('no_jumlah_obat');
			$no_puskesmas			= $this->input->post('no_puskesmas');
			$no				= $this->input->post('no');
			$jumlah_obat			= $this->input->post('jumlah_obat');

			if($status == 'baru'){
				$data = array(
					'no_puskesmas'	=> $no_puskesmas,
					'no'	=> $no,
					'jumlah_obat'	=> $jumlah_obat,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah tesimpan.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->insertdata('jumlah_obat_puskesmas',$data);
				redirect('administrasi/data_jumlah_obat_puskesmas');

			}
			else {
				$data = array(
					'no_puskesmas'	=> $no_puskesmas,
					'no'	=> $no,
					'jumlah_obat'	=> $jumlah_obat,
				);
				$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda telah diperbarui.
					</div>
				';
				$this->session->set_flashdata('sukses', $sukses);
				$this->adminmodel->updatedata('jumlah_obat_puskesmas',$data,array('no_jumlah_obat' => $no_jumlah_obat));
				redirect('administrasi/data_jumlah_obat_puskesmas');
			}
		}
		else {
			$this->load->view('admin/error');
		}
	}


	function data_jumlah_obat_puskesmas_edit($id = ''){
		$this->load->library('session');
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '1'){
			
				$this->load->view('admin/error');

		}
		else {

			$jumlah_obat_puskesmas = $this->adminmodel->selectdata('jumlah_obat_puskesmas where no_jumlah_obat = "'.$id.'"')->result_array();
			$pilih_puskesmas = $this->adminmodel->selectdata('data_puskesmas order by no_puskesmas desc')->result_array();
			$pilih_obat = $this->adminmodel->selectdata('data_kebun order by no desc')->result_array();

			$data = array(
				'title'					=> '.:: Edit Data Jumlah Penyakit ::. ',
				'titlesistem'			=> $this->model->getTitle(),
				'nama'					=> $sesinya['nama'],
				'no_jumlah_obat'	=> $jumlah_obat_puskesmas[0]['no_jumlah_obat'],
				'status'			=> 'edit',
				'no_puskesmas'			=> $pilih_puskesmas,
				'no'			=> $pilih_obat,
				'jumlah_obat'		=> $jumlah_obat_puskesmas[0]['jumlah_obat'],

			);
			
			$this->load->view('admin/header',$data);
			$this->load->view('admin/data_jumlah_obat_puskesmas_form');
			$this->load->view('admin/footer');

		}	
	}

	function data_jumlah_obat_puskesmas_del($id = ''){
		$hasil	= $this->adminmodel->deldata('jumlah_obat_puskesmas',array('no_jumlah_obat' => $id));
		$sukses = '
					<div class="alert alert-success">
					  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					  <strong>Sukses!</strong> Data anda berhasil dihapus.
					</div>
				';
		$this->session->set_flashdata('sukses', $sukses);
		redirect('administrasi/data_jumlah_obat_puskesmas');
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('');
	}

}