<?php

use Restserver\Libraries\REST_Controller;


defined('BASEPATH') OR exit('No direct script access allowed');



require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Dosen extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dosen_model', 'dosen');

		$this->methods['index_get']['limit'] = 100;
	}




	public function index_get()
	{
		$id_dosen = $this->get('id_dosen');
		if ($id_dosen === null){
			
			$dosen = $this->dosen->getDosen();
		} else{
			$dosen = $this->dosen->getDosen($id_dosen);
		}
		

		if ($dosen){
			$this->response([
                    'status' => true,
                    'data' => $dosen
                ], REST_Controller::HTTP_OK);
		} else {
			$this->response([
                    'status' => false,
                    'message' => 'id dosen tidak ditemukan !!!...'
                ], REST_Controller::HTTP_NOT_FOUND);
		}

	}


	public function index_delete()
	{
		$id_dosen = $this->delete('id_dosen');

		if ($id_dosen === null) {
			$this->response([
                    'status' => false,
                    'message' => 'id dosen tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
		} else {

			if ($this->dosen->deleteDosen($id_dosen) > 0) {
				// ok
				$this->response([
                    'status' => true,
                    'id_dosen' => $id_dosen,
                    'message' => 'deleted.'
                ], REST_Controller::HTTP_NO_CONTENT);

			} else {
				// id not found
				$this->response([
                    'status' => false,
                    'message' => 'id dosen tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
		}
	}




	public function index_post()
	{
		$data = [
			'nip' => $this->post('nip'),
			'nama' => $this->post('nama')
		];


		if($this->dosen->createDosen($data) > 0){
		   $this->response([
                    'status' => true,
                    'message' => 'Data baru dosen berhasil ditambahkan.'
                ], REST_Controller::HTTP_CREATED);
		} else {
				// id not found
				$this->response([
                    'status' => false,
                    'message' => 'gagal memeperbarui data dosen'
                ], REST_Controller::HTTP_BAD_REQUEST);
			}
	}

	public function index_put()
	{
		$id_dosen = $this->put('id_dosen');
		$data = [
			'nip' => $this->put('nip'),
			'nama' => $this->put('nama')
		];


		if($this->dosen->updateDosen($data, $id_dosen) > 0){
		   $this->response([
                    'status' => true,
                    'message' => 'data dosen berhasil diperbarui.'
                ], REST_Controller::HTTP_NO_CONTENT);
		} else {
		
				$this->response([
                    'status' => false,
                    'message' => 'gagal memperbarui data dosen'
                ], REST_Controller::HTTP_BAD_REQUEST);
			}

	}
} 