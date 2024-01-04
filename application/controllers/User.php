<?php

if (defined('basepath')) exit('No direct access script allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library('form_validation');
        $this->load->model('GlobalCrud', 'crud');
        date_default_timezone_set('Asia/Jakarta');

        if ($this->session->userdata('role') != '0') {
            redirect('login', 'refresh');
        }
    }

    var $message;

    public function edit()
    {
        $this->upas();
        $this->form_validation->set_rules('id_user', 'id_user', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('role', 'role', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->message = "Komponen Siswa Wajib Diisi !";
            $this->session->set_flashdata('warning', $this->message);
            redirect('user/hasilpendaftaran_nilai');
        } else {
            $data = array(
                "password" => $_POST['password'],
                "role" => $_POST['role'],
            );
            $this->db->where('id_user', $_POST['id_user']);
            $this->db->update('user', $data);
            $this->message = "Data Siswa Berhasil Disimpan !";
            $this->session->set_flashdata('success', $this->message);
            redirect('user/hasilpendaftaran_nilai');
        }
    }

    function create()
    {
        $this->validation();
        if ($this->form_validation->run() === FALSE) {
            $this->message = "Komponen Siswa Wajib Diisi !";
            $this->session->set_flashdata('warning', $this->message);
            redirect('user/pendaftaran');
        } else {

            $query = array(
                'nis' => $this->input->post('nis'),
                'nama_siswa' => $this->input->post('nama_siswa'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'Jenis_kelamin' => $this->input->post('Jenis_kelamin'),
                'rombel' => $this->input->post('rombel'),
                'tanggal_daftar' => $this->input->post('tanggal_daftar'),
                'kelas' => $this->input->post('kelas'),
                'kelas1' => $this->input->post('kelas1')

            );
            $this->crud->insert('siswa', $query);
            $this->message = "Data Siswa Berhasil Disimpan !";
            $this->session->set_flashdata('success', $this->message);
            redirect('user/pendaftaran');
        }
    }

    function validation()
    {
        $this->form_validation->set_rules('nis', '  ', 'required');
        $this->form_validation->set_rules('nama_siswa', '', 'required');
        $this->form_validation->set_rules('tempat_lahir', '', 'required');
        $this->form_validation->set_rules('tanggal_lahir', '', 'required');
        $this->form_validation->set_rules('Jenis_kelamin', '', 'required');
        $this->form_validation->set_rules('kelas', '', 'required');
        $this->form_validation->set_rules('kelas1', '', 'required');
        $this->form_validation->set_rules('rombel', '', 'required');
        $this->form_validation->set_rules('tanggal_daftar', '', 'required');
    }
    function upas()
    {
        $this->form_validation->set_rules('id_user', '', 'required');
        $this->form_validation->set_rules('password', '', 'required');
        $this->form_validation->set_rules('role', '', 'required');
    }

    function pengumuman()
    {


        $count = array(
            'id_siswa' => $this->session->userdata('id_siswa')

        );

        $data = array(
            'set' => $this->crud->all('pengumuman')->result(),
            'total_asset' => $this->crud->hitungJumlahAsset(),
            'set_siswa' => $this->crud->twoTablesFusionCondition('user', 'siswa', '*', 'user.id_siswa = siswa.id_siswa', 'nis', $this->session->userdata('id_user'))->result(),
            'set_ekskul' => $this->crud->twoTablesFusionCondition('registrasi', 'ekskul', '*', 'registrasi.id_ekskul= ekskul.id_ekskul', 'id_siswa', $this->session->userdata('id_siswa'))->result(),
            'eks' => $this->crud->join2table()->result(),
            'png' => $this->crud->all('pengumuman')->result(),
            'total_ekskul' => $this->crud->get('registrasi', $count)->num_rows()
        );

        $this->load->view('layouts/header');
        $this->load->view('user/jadwal', $data);
        $this->load->view('layouts/footer');
    }

    function hasilpendaftaran_nilai()
    {

        $count = array(
            'id_siswa' => $this->session->userdata('id_siswa')

        );

        $data = array(
            'set' => $this->crud->all('ekskul')->result(),
            'total_asset' => $this->crud->hitungJumlahAsset(),
            'set_siswa' => $this->crud->twoTablesFusionCondition('user', 'siswa', '*', 'user.id_siswa = siswa.id_siswa', 'id_user', $this->session->userdata('id_user'))->result(),
            'set_ekskul' => $this->crud->twoTablesFusionCondition('registrasi', 'ekskul', '*', 'registrasi.id_ekskul= ekskul.id_ekskul', 'id_siswa', $this->session->userdata('id_siswa'))->result(),
            'eks' => $this->crud->join2table()->result(),
            'png' => $this->crud->all('pengumuman')->result(),
            'total_ekskul' => $this->crud->get('registrasi', $count)->num_rows(),
            'set_ekskuluser' => $this->crud->twoTablesFusionCondition('siswa', 'ekskul', '*', 'siswa.rombel = ekskul.id_ekskul', 'nis', $this->session->userdata('nis'))->result(),
            // 'set_ekskuluser' => $this->crud->twoTablesFusionCondition('siswa', 'ekskul', '*', 'siswa.rombel = ekskul.id_ekskul', 'nis', $this->session->userdata('nis'))->result(),
        );

        $this->load->view('layouts/header');
        $this->load->view('user/hasilpendaftaran_nilai', $data);
        $this->load->view('layouts/footer');
    }

    function pendaftaran()
    {


        $count = array(
            'id_siswa' => $this->session->userdata('id_siswa')

        );

        $data = array(
            'set' => $this->crud->jumlahkan(),
            'total_asset' => $this->crud->hitungJumlahAsset(),
            'set_siswa' => $this->crud->twoTablesFusionCondition('user', 'siswa', '*', 'user.id_siswa = siswa.id_siswa', 'id_user', $this->session->userdata('id_user'))->result(),
            'set_ekskul' => $this->crud->twoTablesFusionCondition('registrasi', 'ekskul', '*', 'registrasi.id_ekskul= ekskul.id_ekskul', 'id_siswa', $this->session->userdata('id_siswa'))->result(),
            'eks' => $this->crud->join2table()->result(),
            'png' => $this->crud->all('pengumuman')->result(),
            'total_ekskul' => $this->crud->get('registrasi', $count)->num_rows()
        );

        $this->load->view('layouts/header');
        $this->load->view('user/pendaftaran', $data);
        $this->load->view('layouts/footer');
    }

    function registered($id_ekskul)
    {

        $cek = array(
            'id_siswa' => $this->session->userdata('id_siswa'),
            'id_ekskul' => $id_ekskul

        );

        $result = $this->crud->get('registrasi', $cek)->num_rows();
        if ($result > 0) {
            $this->message = 'Anda tidak bisa mengikuti ekskul yang sama lebih dari satu';
            $this->session->set_flashdata('warning', $this->message);
            redirect('user/pendaftaran');
        } else {

            $count = array(
                'id_siswa' => $this->session->userdata('id_siswa')
            );

            $total = $this->crud->get('registrasi', $count)->num_rows();

            if ($total >= 3) {

                $this->message = 'Anda tidak bisa mengikuti ekskul lebih dari 3';
                $this->session->set_flashdata('warning', $this->message);
                redirect('user/pendaftaran');
            } else {

                $query = array(
                    'id_ekskul' => $id_ekskul,
                    'id_siswa'  => $this->session->userdata('id_siswa'),
                    'tanggal_daftar' => date('Y-m-d')
                );

                $this->crud->insert('registrasi', $query);
                $this->message = 'Anda berhasil mengikuti ekskul :)';
                $this->session->set_flashdata('success', $this->message);
                redirect('user/register');
            }
        }
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
