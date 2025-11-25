<?php
namespace App\Controllers;
use CodeIgniter\Controller;
class ServerApi extends Controller
{
    protected $db;
    public function __construct()
    {
        // koneksi database
        $this->db = db_connect();
    }
    // CREATE
    public function addStaff()
    {
        $name = $this->request->getPost('name');
        $hp = $this->request->getPost('hp');
        $alamat = $this->request->getPost('alamat');
        $data = [
            'staff_name' => $name,
            'staff_hp' => $hp,
            'staff_alamat' => $alamat
        ];
        $q = $this->db->table('tb_staff')->insert($data);
        if ($q) {
            $response = [
                'pesan' => 'insert berhasil',
                'status' => 200
            ];
        } else {
            $response = [
                'pesan' => 'insert error',
                'status' => 404
            ];
        }
        return $this->response->setJSON($response);
    }
    // READ
    public function getDataStaff()
    {
        $query = $this->db->table('tb_staff')->get();
        if ($query->getNumRows() > 0) {
            $response = [
                'pesan' => 'data ada',
                'status' => 200,
                'staff' => $query->getResult()
            ];
        } else {
            $response = [
                'pesan' => 'data tidak ada',
                'status' => 404
            ];
        }
        return $this->response->setJSON($response);
    }
    // DELETE
    public function deleteStaff()
    {
        $id = $this->request->getPost('id');

        $status = $this->db->table('tb_staff')
            ->where('staff_id', $id)

            ->delete();

        if ($status) {
            $response = [
                'pesan' => 'hapus berhasil',
                'status' => 200
            ];
        } else {
            $response = [
                'pesan' => 'hapus error',
                'status' => 404
            ];
        }
        return $this->response->setJSON($response);
    }
    // UPDATE
    public function updateStaff()
    {
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $hp = $this->request->getPost('hp');
        $alamat = $this->request->getPost('alamat');
        $data = [
            'staff_name' => $name,
            'staff_hp' => $hp,
            'staff_alamat' => $alamat
        ];
        $q = $this->db->table('tb_staff')
            ->where('staff_id', $id)

            ->update($data);

        if ($q) {
            $response = [
                'pesan' => 'update berhasil',
                'status' => 200
            ];
        } else {
            $response = [
                'pesan' => 'update error',
                'status' => 404
            ];
        }
        return $this->response->setJSON($response);
    }
}