<?php

if (defined('basepath')) exit('no direct access script allowed');

class Pembina extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('GlobalCrud', 'crud');
		$this->load->model('UserModel');
	}

	function create()
	{
		$this->validation();
		if ($this->form_validation->run() == FALSE) {

			$this->message = "Komponen Pembina Wajib Diisi !";
			$this->session->set_flashdata('warning', $this->message);
			redirect('admin/pembina');
		} else {

			$query = array(
				'nama_pembina' => $this->input->post('nama_pembina'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'id_ekskul' => $this->input->post('id_ekskul'),
			);
			$this->crud->insert('pembina', $query);
			$this->message = "Data Pembina Berhasil Disimpan !";
			$this->session->set_flashdata('success', $this->message);
			redirect('admin/pembina');
		}
	}

	function create_register()
	{
		$this->validation_register();
		if ($this->form_validation->run() == FALSE) {
			$this->message = "Komponen Siswa Wajib Diisi !";
			$this->session->set_flashdata('warning', $this->message);
			redirect('admin/pembinaEkskul/' . $this->input->post('rombel'));
		} else {

			$query = array(
				'nis' => $this->input->post('nis'),
				'nama_siswa' => $this->input->post('nama_siswa'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'Jenis_kelamin' => $this->input->post('Jenis_kelamin'),
				'username' => $this->input->post('username'),
				'kelas' => $this->input->post('kelas'),
				'kelas1' => $this->input->post('kelas1'),
				'nilai' => $this->input->post('nilai'),
				'rombel' => $this->input->post('rombel'),
				'keterangan' => $this->input->post('keterangan'),
			);

			$this->crud->insert('siswa', $query);
			$id_siswa_terakhir = $this->db->insert_id();
			$query2 = array(
				'id_ekskul' => $this->input->post('rombel'),
				'id_siswa' =>  $id_siswa_terakhir,
				'tanggal_daftar' => date("Y/m/d")
			);
			$this->crud->insert('registrasi', $query2);
			$this->message = "Data Siswa Berhasil Disimpan !";
			$this->session->set_flashdata('success', $this->message);
			redirect('admin/pembinaEkskul/' . $this->input->post('rombel'));
		}
	}

	function get($id)
	{
		$query = array(
			'id_pembina' => $id
		);

		$result = $this->crud->get('ekskul', $query)->row();
		echo json_encode($result);
	}

	public function edit()
	{
		$this->load->model('GlobalCrud'); // Load the model if not already loaded

		$query = array(
			'nama_pembina' => $this->input->post('nama_pembina'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'id_ekskul' => $this->input->post('id_ekskul'),
		);

		$id_pembina = $this->input->post('id_pembina');

		$this->crud->edit('pembina', $query, 'id_pembina', $id_pembina);

		$this->session->set_flashdata('success', 'Data Ekskul Berhasil Diubah!');
		redirect('admin/pembina'); // Change 'admin/pembina' to your actual redirect path
	}

	function edit_register()
	{
		$query = array(
			'nis' => $this->input->post('nis'),
			'nama_siswa' => $this->input->post('nama_siswa'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'Jenis_kelamin' => $this->input->post('Jenis_kelamin'),
			'username' => $this->input->post('username'),
			'kelas' => $this->input->post('kelas'),
			'kelas1' => $this->input->post('kelas1'),
			'nilai' => $this->input->post('nilai'),
			'password' => $this->input->post('password'),
			'rombel' => $this->input->post('rombel'),
			'keterangan' => $this->input->post('keterangan'),
		);

		$this->crud->edit('siswa', $query, 'id_siswa', $this->input->post('id_siswa'));
		$query2 = array(
			'id_ekskul' => $this->input->post('rombel'),
		);
		$this->crud->edit('registrasi', $query2, 'id_siswa', $this->input->post('id_siswa'));
		$this->message = "Data Siswa Berhasil Disimpan !";
		$this->session->set_flashdata('success', $this->message);
		redirect('admin/pembinaEkskul/' . $this->input->post('rombel'));
	}


	function destroy($id)
	{
		$this->crud->delete('pembina', 'id_pembina', $id);
		$this->message = "Data Pembina Berhasil Dihapus !";
		$this->session->set_flashdata('success', $this->message);
		redirect('admin/pembina');
	}

	function validation()
	{
		$this->form_validation->set_rules('nama_pembina', '', 'required');
		$this->form_validation->set_rules('username', '', 'required');
		$this->form_validation->set_rules('password', '', 'required');
		$this->form_validation->set_rules('id_ekskul', '', 'required');
	}

	function validation_register()
	{
		$this->form_validation->set_rules('nis', '', 'required');
		$this->form_validation->set_rules('nama_siswa', '', 'required');
		$this->form_validation->set_rules('tempat_lahir', '', 'required');
		$this->form_validation->set_rules('tanggal_lahir', '', 'required');
		$this->form_validation->set_rules('Jenis_kelamin', '', 'required');
		$this->form_validation->set_rules('username', '', 'required');
		$this->form_validation->set_rules('kelas', '', 'required');
		$this->form_validation->set_rules('kelas1', '', 'required');
		// $this->form_validation->set_rules('nilai', '', 'required');
		$this->form_validation->set_rules('rombel', '', 'required');
	}
}
