<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	protected $table;

	function __construct()
	{
		parent::__construct();

		$this->load->model('GlobalCrud', 'crud');
		$this->load->model('UserModel', 'user');
		if ($this->session->userdata('role') == 0) {
			return $this->load->view('login');
		}
	}

	function export_excel()
	{
		$data = array(
			'title' => 'Laporan Hasil Pendaftaran Excel',
			'user' => $this->crud->listing()
		);
		$this->load->view('layouts/laporan_user', $data);
	}

	function index()
	{


		$data = array(
			'set_siswa' => $this->crud->count_table('siswa'),
			'png' => $this->crud->all('pengumuman')->result(),
			'set_ekskul' => $this->crud->count_table('ekskul'),
			'set_akun' => $this->crud->count_table('user'),
			'set_pendaftar' => $this->crud->count_table('registrasi'),
			'total_asset' => $this->crud->hitungJumlahAsset(),
			'eks' => $this->crud->all('ekskul')->result()
		);


		$this->load->view('layouts/header');
		$this->load->view('layouts/nav');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('layouts/footer');
	}

	function siswa()
	{
		if ($this->session->userdata('role') == 1) {
			$data = array(
				'set' => $this->crud->all('siswa')->result()
			);

			$data['dtbidang'] = $this->crud->admin_dtbidang();
			$this->load->view('layouts/header');
			$this->load->view('layouts/nav');
			$this->load->view('admin/siswa/kelola', $data);
			$this->load->view('layouts/footer');
		} else if ($this->session->userdata('role') == 2) {
			$this->db->from('siswa');
			$this->db->where('siswa.rombel', $this->session->userdata('id_ekskul'));
			$query = $this->db->get();
			$data = array(
				'set' => $query->result(),
			);

			$data['dtbidang'] = $this->crud->admin_dtbidang();
			$this->load->view('layouts/header');
			$this->load->view('layouts/nav');
			$this->load->view('admin/siswa/kelola', $data);
			$this->load->view('layouts/footer');
		}
	}

	function laporan()
	{
		if ($this->session->userdata('role') == 1) {
			$data = array(
				'set' => $this->crud->joinsiswa()->result()
			);

			$data['dtbidang'] = $this->crud->admin_dtbidang();
			$this->load->view('layouts/header');
			$this->load->view('layouts/nav');
			$this->load->view('admin/siswa/laporan', $data);
			$this->load->view('layouts/footer');
		} else if ($this->session->userdata('role') == 2) {
			$id = $this->session->userdata('id_ekskul');
			$data = array(
				'set' => $this->crud->joinsiswaPembina($id)->result()
			);

			$data['dtbidang'] = $this->crud->admin_dtbidang();
			$this->load->view('layouts/header');
			$this->load->view('layouts/nav');
			$this->load->view('admin/siswa/laporan', $data);
			$this->load->view('layouts/footer');
		}
	}

	public function search()
	{
		$data = array(
			'set' => $this->crud->joinsiswa()->result()
		);
		$keyword = $this->input->post('kategori');

		$data['set'] = $this->crud->get_product_keyword($keyword);

		$data['dtbidang'] = $this->crud->admin_dtbidang();

		$this->load->view('layouts/header');
		$this->load->view('layouts/nav');
		$this->load->view('admin/siswa/laporan', $data);
		$this->load->view('layouts/footer');
	}

	function penjadwalan()
	{


		$data = array(
			'eks' => $this->crud->all('ekskul')->result(),

		);



		$this->load->view('layouts/header');
		$this->load->view('layouts/nav');
		$this->load->view('admin/siswa/penjadwalan', $data);
		$this->load->view('layouts/footer');
	}


	function pengumuman()
	{


		$data = array(
			'png' => $this->crud->all('pengumuman')->result(),
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/nav');
		$this->load->view('admin/siswa/pengumuman', $data);
		$this->load->view('layouts/footer');
	}

	function pengguna()
	{
		$data = array(
			'set' => $this->crud->joinsiswa()->result(),
			'set_siswa' => $this->crud->all('siswa')->result()
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/nav');
		$this->load->view('admin/pengguna/kelola', $data);
		$this->load->view('layouts/footer');
	}

	function ekskul()
	{
		$data = array(
			'set' => $this->crud->all('ekskul')->result(),


		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/nav');
		$this->load->view('admin/ekskul/kelola', $data);
		$this->load->view('layouts/footer');
	}

	function pembina()
	{
		$data = array(
			'set' => $this->crud->twoTablesFusion('ekskul', 'pembina', '*', 'ekskul.id_ekskul=pembina.id_ekskul')->result(),
			'set_ekskul' => $this->crud->all('ekskul')->result(),
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/nav');
		$this->load->view('admin/pembina/kelola', $data);
		$this->load->view('layouts/footer');
	}

	function pembinaEkskul($id)
	{
		$query = array(
			'id_ekskul' => $id
		);
		$data = array(
			'set_ekskul' => $this->crud->get('ekskul', $query)->result(),
			'set' => $this->crud->joinsiswabyId($id)->result(),
			'set_siswa' => $this->crud->all('siswa')->result()
		);
		$data['dtbidang'] = $this->crud->admin_dtbidang();
		$this->load->view('layouts/header');
		$this->load->view('layouts/nav');
		$this->load->view('admin/pembina/ekskul_view', $data);
		$this->load->view('layouts/footer');
	}

	function galeri()
	{
		$data = array(
			'set' => $this->crud->twoTablesFusion('dokumentasi', 'ekskul', '*', 'dokumentasi.id_ekskul=ekskul.id_ekskul')->result()
		);

		$this->load->view('layouts/header');
		$this->load->view('layouts/nav');
		$this->load->view('galeri/kelola', $data);
		$this->load->view('layouts/footer');
	}
}
