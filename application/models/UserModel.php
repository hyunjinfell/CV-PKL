<?php

class UserModel extends CI_Model {
    
    function first($table,$query){
        return $this->db->get_where($table,$query);
    }

    public function register_user($data) {
        // Insert user data into the 'users' table
        $this->db->insert('user', $data);
    }
    
    function session($query){
        foreach($query->result() as $row){
            $createSession = array(
                'id_user' => $row->id_user,
                'nama' => $row->nama,
                'email' => $row->email,
                'password' => $row->password,
                'role' => $row->role,
                'id_siswa' => $row->id_siswa,
				'id_ekskul' => $row->id_ekskul,
				'nis' => $row->nis,
            );
        }
        
        $this->session->set_userdata($createSession);
        if($this->session->userdata('role') == 1 || $this->session->userdata('role') == 2){
            redirect('admin');
        } else {
            redirect('user/pendaftaran');
        }
        
    }
    
    function get_user(){
        
        $this->db->where('role !=','1');
        return $this->db->get('user');
    }
    
     function reset($id){
        $this->db->select('*');
        $this->db->where('id_user',$id);
        $result = $this->db->get('user')->result();
        
        foreach($result as $row){
            $password = $row->password;
        }
        
        return $password;
    }

    
    
}
