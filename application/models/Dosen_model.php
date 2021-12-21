<?php

class Dosen_model extends CI_Model 
{
	public function getDosen($id_dosen = null)
	{
		if($id_dosen === null) {
		return $this->db->get('dosen')->result_array();
		} else {
			return $this->db->get_where('dosen', ['id_dosen' => $id_dosen])->result_array();
		}
 	}

 	public function deleteDosen($id_dosen)
 	{

 		$this->db->delete('dosen', ['id_dosen' => $id_dosen]);
 		return $this->db->affected_rows();
 	}


 	public function createDosen($data)
 	{
 		$this->db->insert('dosen',$data);
 		return $this->db->affected_rows();
 	}


 	public function updateDosen($data, $id_dosen)
 	{
 		$this->db->update('dosen', $data, ['id_dosen' => $id_dosen] );
 		return $this->db->affected_rows();
 	}



} 