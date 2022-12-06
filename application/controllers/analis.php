<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class analis extends CI_Controller {

	function __construct() {
		parent::__construct();

		if($this->session->userdata('login') != TRUE)
		{
			$this->load->view('analis/error');
		}

		$this->load->model('analismodel');
		$this->load->model('model');
	}

	function index(){

		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '3'){
			
			$this->load->view('analis/error');

		}
		else {
		
			$this->load->model('model');
			$data = array(
				'title'			=> 'Selamat Datang Analis',
				'nama'			=> $sesinya['nama'],
				'petunjuk'		=> $this->model->getPetunjuk(),
				'wewenang'		=> $this->model->getWewenang(),
				'titlesistem'	=> $this->model->getTitle(),
			);
			
			$this->load->view('analis/header',$data);
			$this->load->view('analis/dashboard');
			$this->load->view('analis/footer');

		}
	}

	function generate_rata(){

		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '3'){
			
			$this->load->view('analis/error');

		}
		else {
		$data_hasilpanen = $this->db->query('SELECT *, AVG(data_hasilpanen.netto) AS avgnetto
		FROM data_hasilpanen INNER JOIN data_kebun ON data_hasilpanen.nomor_petak = data_kebun.nomor_petak GROUP BY data_hasilpanen.nomor_petak');
		$v = "";
		if(count($data_hasilpanen->result())<0)
		{
			$nilai = $s->avgnetto;
			$v = "insert into rata_rata (nomor_petak,rata_rata) values ('".$s->nomor_petak."','".$nilai."')";
			$this->db->query($v);
		}
		else
		{
			$this->db->query('truncate table rata_rata');
			foreach($data_hasilpanen->result() as $s)
			{
				$nilai = $s->avgnetto;
				$v = "insert into rata_rata (nomor_petak,rata_rata) values ('".$s->nomor_petak."','".$nilai."')";
				$this->db->query($v);
			}
		}
		
			$data = array(
				'title'			=> 'Selamat Datang Analis',
				'nama'			=> $sesinya['nama'],
				'titlesistem'	=> $this->model->getTitle(),
			);


		$data['data_hasilpanen'] = $this->db->query('select *, COUNT(data_hasilpanen.netto) AS jumlahpanen from data_hasilpanen inner join data_kebun on data_hasilpanen.nomor_petak = data_kebun.nomor_petak 
		inner join rata_rata on data_hasilpanen.nomor_petak=rata_rata.nomor_petak GROUP BY data_hasilpanen.nomor_petak');

		$this->load->view('analis/header',$data);
		$this->load->view('analis/generate_rata');
		$this->load->view('analis/footer');
		}
	}


	function generate_centroid(){

		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '3'){
			
			$this->load->view('analis/error');

		}
		else {

			$data = array(
				'title'			=> 'Selamat Datang Analis',
				'nama'			=> $sesinya['nama'],
				'titlesistem'	=> $this->model->getTitle(),
		);
		
		$kluster = 3;
		//C1 = Baik
		//C2 = Cukup
		//C3 = Kurang
		$data['c1'] = 5800;
		$data['c2'] = 5200;
		$data['c3'] = 4600;
		$data_hasilpanen = $this->db->query('select * from data_hasilpanen left join rata_rata on data_hasilpanen.nomor_petak=rata_rata.nomor_petak');
		$st = "";
		
		$this->db->query('truncate table hasil');
		foreach($data_hasilpanen->result() as $s)
		{
			$d1 = abs($s->rata_rata-$data['c1']); 
			$d2 = abs($s->rata_rata-$data['c2']);
			$d3 = abs($s->rata_rata-$data['c3']);
			$array_sort_awal = array($d1,$d2,$d3);
			$array_sort = $array_sort_awal;
			for ($j=1;$j<=$kluster-1;$j++){//1 4 --> 2
				for ($k=0;$k<=$kluster-2;$k++) {//0 2 --> 1
					if ($array_sort[$k] > $array_sort[$k + 1]){ // $array_sort[0] > $array_sort[1] --> 6 > 3
						$temp = $array_sort[$k]; // 3
						$array_sort[$k] = $array_sort[$k + 1]; // 4
						$array_sort[$k + 1] = $temp; //$array_sort[1] = 4
					}
				}
			}
			
			for ($i = 0; $i < $kluster; $i++){
				for($r = 0; $r < $kluster; $r++)
				{
					if($array_sort[0]==$array_sort_awal[$r])
					{
						if($r==0) $st =  "Baik";
						else if($r==1) $st =  "Cukup";
						else if($r==2) $st =  "Kurang";
					}
				}
			}
			$this->db->query("insert into hasil (nomor_petak,predikat,d1,d2,d3) values('".$s->nomor_petak."','".$st."','".$d1."','".$d2."','".$d3."')");
		}

		$data['data_hasilpanen'] = $this->db->query("select *, COUNT(data_hasilpanen.netto) AS jumlahpanen from data_hasilpanen left join (data_kebun,rata_rata,hasil) on data_hasilpanen.nomor_petak=rata_rata.nomor_petak and data_hasilpanen.nomor_petak=data_kebun.nomor_petak and data_hasilpanen.nomor_petak=hasil.nomor_petak group by data_hasilpanen.nomor_petak");

		$this->load->view('analis/header',$data);
		$this->load->view('analis/generate_centroid');
		$this->load->view('analis/footer');
		}
	}

	function iterasi_kmeans(){
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '3'){
			
			$this->load->view('analis/error');

		}
		else {
			$this->load->model('model');

			$data_hasilpanen = $this->db->query('SELECT *, AVG(data_hasilpanen.netto) AS avgnetto, COUNT(netto) AS jumlahpanen
			FROM data_hasilpanen INNER JOIN data_kebun ON data_hasilpanen.nomor_petak = data_kebun.nomor_petak GROUP BY data_hasilpanen.nomor_petak');

			$data = array(
				'title'			=> 'Selamat Datang Analis',
				'nama'			=> $sesinya['nama'],
				'data_hasilpanen'=> $data_hasilpanen,
				'titlesistem'	=> $this->model->getTitle(),
			);

			$this->load->view('analis/header',$data);
			$this->load->view('analis/iterasi_kmeans');
			$this->load->view('analis/footer');
		}
	}



	function iterasi_kmeans_lanjut(){
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '3'){
			
			$this->load->view('analis/error');

		}
		else {
		$data = array(
			'title'			=> 'Selamat Datang Analis',
			'nama'			=> $sesinya['nama'],
			'titlesistem'	=> $this->model->getTitle(),
		);
			
		$data['data_hasilpanen'] = $this->db->query('SELECT *, AVG(data_hasilpanen.netto) AS avgnetto, COUNT(data_hasilpanen.netto) AS jumlahpanen
		FROM data_hasilpanen INNER JOIN data_kebun ON data_hasilpanen.nomor_petak = data_kebun.nomor_petak GROUP BY data_hasilpanen.nomor_petak');

		$id = "";
		$id = $this->db->query('select max(nomor) as m from hasil_centroid');
		foreach($id->result() as $i)
		{
			$id = $i->m;
		}
		$this->db->where('nomor', $id);
		$data['centroid'] = $this->db->get('hasil_centroid');
		$data['id'] = $id+1;
		
		$it = "";
		$it = $this->db->query('select max(iterasi) as it from centroid_temp');
		foreach($it->result() as $i)
		{
			$it = $i->it;
		}
		
		$it_temp = $it-1;
		$this->db->where('iterasi', $it_temp);
		$it_sebelum = $this->db->get('centroid_temp');
		$c1_sebelum = array();
		$c2_sebelum = array();
		$c3_sebelum = array();
		$no=0;
		foreach($it_sebelum->result() as $it_prev)
		{
			$c1_sebelum[$no] = $it_prev->c1;
			$c2_sebelum[$no] = $it_prev->c2;
			$c3_sebelum[$no] = $it_prev->c3;
			$no++;
		}
		
		$this->db->where('iterasi', $it);
		$it_sesesudah = $this->db->get('centroid_temp');
		$c1_sesesudah = array();
		$c2_sesesudah = array();
		$c3_sesesudah = array();
		$no=0;
		foreach($it_sesesudah->result() as $it_next)
		{
			$c1_sesesudah[$no] = $it_next->c1;
			$c2_sesesudah[$no] = $it_next->c2;
			$c3_sesesudah[$no] = $it_next->c3;
			$no++;
		}
		
		if($c1_sebelum==$c1_sesesudah || $c2_sebelum==$c2_sesesudah || $c3_sebelum==$c3_sesesudah)
		{
			?>
				<script>
					alert("Proses iterasi berakhir pada tahap ke-<?php echo $it; ?>");
				</script>
			<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."analis/iterasi_kmeans_hasil'>";
		}
		else
		{
			$this->load->view('analis/header',$data);
			$this->load->view('analis/iterasi_kmeans_lanjut');
			$this->load->view('analis/footer');
		}
		}
	}	

	

	function iterasi_kmeans_hasil(){
		$sesinya	= $this->session->userdata('login');
		if($sesinya['level'] != '3'){
			
			$this->load->view('analis/error');

		}
		else {

			$data_hasil = $this->db->query('SELECT * FROM hasil INNER JOIN data_hasilpanen on hasil.nomor_petak = data_hasilpanen.nomor_petak INNER JOIN data_kebun on data_hasilpanen.nomor_petak = data_kebun.nomor_petak GROUP BY data_hasilpanen.nomor_petak order by predikat');

			$data = array(
				'title'			=> 'Selamat Datang Analis',
				'nama'			=> $sesinya['nama'],
				'titlesistem'	=> $this->model->getTitle(),
				'data_hasil'	=> $data_hasil,
			);

			$data['q'] = $this->db->query('select * from centroid_temp group by iterasi');

			$this->load->view('analis/header',$data);
			$this->load->view('analis/iterasi_kmeans_hasil');
			$this->load->view('analis/footer');
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('');
	}


}