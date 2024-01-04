<?php
if (defined('basepath')) exit('No direct access script allowed');

class Siswa extends CI_Controller
{

	var $message;

	function __construct()
	{
		parent::__construct();
		$this->load->model('GlobalCrud', 'crud');
	}

	function create()
	{
		$this->validation();
		if ($this->form_validation->run() == FALSE) {

			$this->message = "Komponen Siswa Wajib Diisi !";
			$this->session->set_flashdata('warning', $this->message);
			redirect('admin/siswa');
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
				'password' => $this->input->post('password'),
				'tanggal_daftar' => $this->input->post('tanggal_daftar'),
				'rombel' => $this->input->post('rombel'),
				'keterangan' => $this->input->post('keterangan'),

			);
			$this->crud->insert('siswa', $query);
			$this->message = "Data Siswa Berhasil Disimpan !";
			$this->session->set_flashdata('success', $this->message);
			redirect('admin/siswa');
		}
	}

	function get($id)
	{
		$query = array(
			'id_siswa' => $id
		);

		$result = $this->crud->get('siswa', $query)->row();
		echo json_encode($result);
	}

	function update()
	{
		$query = array(
			'nis' => $this->input->post('nis'),
			'nama_siswa' => $this->input->post('nama_siswa'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'Jenis_kelamin' => $this->input->post('Jenis_kelamin'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'kelas' => $this->input->post('kelas'),
			'kelas1' => $this->input->post('kelas1'),
			'nilai' => $this->input->post('nilai'),
			'rombel' => $this->input->post('rombel'),
			'keterangan' => $this->input->post('keterangan'),

		);
		$this->crud->edit('siswa', $query, 'id_siswa', $this->input->post('id_siswa'));
		$this->message = "Data Siswa Berhasil Diubah !";
		$this->session->set_flashdata('success', $this->message);
		redirect('admin/siswa');
	}

	function destroy($id)
	{
		$this->crud->delete('siswa', 'id_siswa', $id);
		$this->message = "Data Siswa Berhasil Dihapus !";
		$this->session->set_flashdata('success', $this->message);
		redirect('admin/siswa');
	}

	function validation()
	{
		$this->form_validation->set_rules('nis', '', 'required');
		$this->form_validation->set_rules('nama_siswa', '', 'required');
		$this->form_validation->set_rules('tempat_lahir', '', 'required');
		$this->form_validation->set_rules('tanggal_lahir', '', 'required');
		$this->form_validation->set_rules('Jenis_kelamin', '', 'required');
		$this->form_validation->set_rules('username', '', 'required');
		$this->form_validation->set_rules('kelas', '', 'required');
		$this->form_validation->set_rules('kelas1', '', 'required');
		$this->form_validation->set_rules('nilai', '', 'required');
		$this->form_validation->set_rules('rombel', '', 'required');
	}
}
