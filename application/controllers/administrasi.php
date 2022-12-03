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

	function logout(){
		$this->session->sess_destroy();
		redirect('');
	}

}