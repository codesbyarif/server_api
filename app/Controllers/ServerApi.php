<?php
namespace App\Controllers;
use CodeIgniter\Controller;

class ServerApi extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type');
    }

    // 1. CREATE (Update)
    public function addStaff()
    {
        $name = $this->request->getPost('name');
        $hp = $this->request->getPost('hp');
        $alamat = $this->request->getPost('alamat');
        // Tambahan
        $pekerjaan = $this->request->getPost('pekerjaan');
        $hobi = $this->request->getPost('hobi');

        $data = [
            'staff_name' => $name,
            'staff_hp' => $hp,
            'staff_alamat' => $alamat,
            'staff_pekerjaan' => $pekerjaan, // Masuk DB
            'staff_hobi' => $hobi           // Masuk DB
        ];

        $q = $this->db->table('tb_staff')->insert($data);

        if ($q) {
            $response = ['pesan' => 'insert berhasil', 'status' => 200];
        } else {
            $response = ['pesan' => 'insert error', 'status' => 404];
        }
        return $this->response->setJSON($response);
    }

    // 2. READ (Update)
    public function getDataStaff()
    {
        $query = $this->db->table('tb_staff')->get();

        if ($query->getNumRows() > 0) {
            $staff = [];
            foreach ($query->getResult() as $row) {
                $staff[] = [
                    'staff_id' => (string) $row->staff_id,
                    'staff_name' => $row->staff_name,
                    'staff_hp' => $row->staff_hp,
                    'staff_alamat' => $row->staff_alamat,
                    // Tambahkan output JSON
                    'staff_pekerjaan' => $row->staff_pekerjaan,
                    'staff_hobi' => $row->staff_hobi
                ];
            }
            $response = ['pesan' => 'data ada', 'status' => 200, 'staff' => $staff];
        } else {
            $response = ['pesan' => 'data tidak ada', 'status' => 200, 'staff' => []];
        }
        return $this->response->setJSON($response);
    }

    // 3. UPDATE (Update)
    public function updateStaff()
    {
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $hp = $this->request->getPost('hp');
        $alamat = $this->request->getPost('alamat');
        // Tambahan
        $pekerjaan = $this->request->getPost('pekerjaan');
        $hobi = $this->request->getPost('hobi');

        $data = [
            'staff_name' => $name,
            'staff_hp' => $hp,
            'staff_alamat' => $alamat,
            'staff_pekerjaan' => $pekerjaan, // Update DB
            'staff_hobi' => $hobi           // Update DB
        ];

        $q = $this->db->table('tb_staff')->where('staff_id', $id)->update($data);

        if ($q) {
            $response = ['pesan' => 'update berhasil', 'status' => 200];
        } else {
            $response = ['pesan' => 'update error', 'status' => 404];
        }
        return $this->response->setJSON($response);
    }

    // Function Delete tetap sama, tidak perlu diubah
    public function deleteStaff()
    {
        $id = $this->request->getPost('id');
        $status = $this->db->table('tb_staff')->where('staff_id', $id)->delete();
        $response = $status ? ['pesan' => 'hapus berhasil', 'status' => 200] : ['pesan' => 'hapus error', 'status' => 404];
        return $this->response->setJSON($response);
    }
}