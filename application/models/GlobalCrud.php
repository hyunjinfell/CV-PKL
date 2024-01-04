<?php
// application/models/User_model.php

class GlobalCrud extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function register_user($data)
	{
		// Insert user data into the 'users' table
		$this->db->insert('user', $data);
	}

	public function listing()
	{
		$this->db->select('*');
		$this->db->from('siswa');

		$this->db->join('ekskul', 'siswa.rombel=ekskul.id_ekskul');
		$query = $this->db->get();
		return $query->result();
	}

	public function hitungJumlahAsset()
	{

		$query = $this->db->query('SELECT ekskul.nama_ekskul, rombel, COUNT( * ) as total FROM ekskul
                JOIN siswa ON ekskul.id_ekskul = siswa.rombel
                 GROUP BY id_ekskul
                ');


		return $query->result();
	}

	public function jumlahkan()
	{

		$query = $this->db->query('SELECT * FROM ekskul');


		return $query->result();
	}



	public function admin_dtbidang()
	{
		return $query = $this->db->query("SELECT * FROM ekskul");
	}

	public function get_product_keyword($keyword)
	{

		$this->db->from('siswa');
		$this->db->join('ekskul', 'siswa.rombel=ekskul.id_ekskul');
		$this->db->like('nama_ekskul', $keyword);
		return $this->db->get()->result();
	}
	function join2table()
	{
		$this->db->select('*');
		$this->db->order_by('id_ekskul', 'desc');
		$this->db->from('ekskul', 'id_ekskul, COUNT(id_ekskul) as total');

		$query = $this->db->get();
		return $query;
	}
	function joinsiswa()
	{
		$this->db->from('siswa');
		$this->db->join('ekskul', 'siswa.rombel=ekskul.id_ekskul');
		$query = $this->db->get();
		return $query;
	}
	function joinsiswaPembina($id)
	{
		$this->db->from('siswa');
		$this->db->join('ekskul', 'siswa.rombel=ekskul.id_ekskul');
		$this->db->where('ekskul.id_ekskul', $id);
		$query = $this->db->get();
		return $query;
	}
	function joinsiswabyId($id)
	{
		$this->db->select('siswa.*,ekskul.*,registrasi.*');
		$this->db->from('siswa');
		$this->db->join('ekskul', 'siswa.rombel=ekskul.id_ekskul');
		$this->db->join('registrasi', 'siswa.id_siswa=registrasi.id_siswa');
		$this->db->where('ekskul.id_ekskul', $id);
		$query = $this->db->get();
		return $query;
	}
	function all($table)
	{
		return $this->db->get($table);
	}

	function get($table, $query)
	{
		return $this->db->get_where($table, $query);
	}

	function insert($table, $query)
	{
		$this->db->insert($table, $query);
	}

	function delete($table, $column, $id)
	{
		$this->db->where($column, $id);
		$this->db->delete($table);
	}

	function edit($table, $data, $where_field, $where_value)
	{
		$this->db->where($where_field, $where_value);
		$this->db->update($table, $data);
	}


	function count_table($table)
	{
		return $this->db->count_all($table);
	}

	function twoTablesFusion($table1, $table2, $select, $clause)
	{
		$this->db->select($select);
		$this->db->from($table1);
		$this->db->join($table2, $clause);
		return $this->db->get();
	}

	function twoTablesFusionCondition($table1, $table2, $select, $clause, $condition, $where)
	{
		$this->db->select($select);
		$this->db->from($table1);
		$this->db->join($table2, $clause);
		$this->db->where($condition, $where);
		return $this->db->get();
	}

	function threeTablesFusionCondition($table1, $table2, $table3, $select, $clause1, $clause2, $condition, $where)
	{
		$this->db->select($select);
		$this->db->from($table1);
		$this->db->join($table2, $clause1);
		$this->db->join($table3, $clause2);
		$this->db->where($condition, $where);
		return $this->db->get();
	}

	/* custom query */
	function delete_pendaftar($id_ekskul, $id_siswa)
	{
		$this->db->where('id_ekskul', $id_ekskul);
		$this->db->where('id_siswa', $id_siswa);
		$this->db->delete('registrasi');
	}
}
