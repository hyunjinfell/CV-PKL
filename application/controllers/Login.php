<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('GlobalCrud', 'crud');
		$this->load->model('UserModel', 'user');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function register()
	{
		$this->load->view('registration_view');
	}

	public function signup()
	{
		// Set validation rules
		$this->form_validation->set_rules('nis', '', 'trim|required|numeric|is_unique[user.nis]');
		$this->form_validation->set_rules('username', '', 'trim|required|min_length[5]|max_length[50]|is_unique[user.username]');
		$this->form_validation->set_rules('password', '', 'trim|required|min_length[5]');
		// Add more validation rules as needed

		if ($this->form_validation->run() === FALSE) {
			// If validation fails, load the registration form again with validation errors
			$this->session->set_flashdata('notify', '<font color="red">Silakan isi form dengan benar</font>');
			return redirect('login/register');
		} else {
			// If validation succeeds, proceed with registration
			$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'role' => 0,
				'nis' => $this->input->post('nis'),
				// Add more user data fields as needed
			);

			$this->user->register_user($data);

			// Optionally, you can redirect to the login page or show a success message
			$this->session->set_flashdata('notify', '<font color="green">Register berhasil. Silakan Login</font>');
			redirect('login'); // Assuming you have a login controller and method
		}
	}

	public function signin()
	{
		$query1 = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
		);
		$result1 = $this->crud->get('user', $query1);

		$query2 = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
		);
		$result2 = $this->crud->get('pembina', $query2);

		if ($result1->num_rows() == 1) {
			$this->user->session($result1);
			$this->session->set_userdata($result1);
		} else if ($result2->num_rows() == 1) {
			$this->user->session($result2);
			$this->session->set_userdata($result2);
		} else {
			$this->session->set_flashdata('notify', '<font color="red">Username atau Password Salah</font>');
			redirect('login');
		}
	}

	function signout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('nama');

		$this->session->unset_userdata('username');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('role');

		redirect('login');
	}
}
