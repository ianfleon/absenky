<?php

// Jalankan sesuai endpoint (fungsi)
if (isset($_GET['ep'])) {

    $api = new AbsenkyAPI();

    $params = [];
    $method = $_GET['ep'];

    call_user_func_array([$api, $method], $params);

}

class AbsenkyAPI
{
    private $db;

    function __construct()
    {
        $this->db = new SQLite3('absenky.db');
    }

    public function test()
    {
        echo "AbsenkyAPI: test()";
    }

    // Menampilkan JSON
    private function _response($res)
    {
        echo json_encode($res);
        exit;
    }

    // Membuat QR Code
    private function _generate_qr($isi)
    {

        require_once('libs/phpqrcode/qrlib.php');

        if (!is_dir('public/qr')) {
            mkdir('public/qr');
        }

        QRcode::png($isi, 'public/qr/' . $isi . '.png', QR_ECLEVEL_H, 24);

        // Cek apakah QR berhasil dibuat atau tidak
        // if (!file_exists('../public/qr/' . $isi . '.png')) {
        //     return false;
        // }

        // return true;

    }

    // Upload Foto
    function _upload_foto($foto, $nama = 'foto', $location = "")
    {

        // Ekstensi foto yang boleh diinput
        $valid_extensions = ['jpg', 'jpeg', 'JPG', 'JPEG', 'PNG', 'png', 'webp', 'svg'];

        // Mengambil ekstensi dari nama file
        $foto_extension = explode('.', $foto['name']);
        $foto_extension = end($foto_extension);

        // Validasi Ekstensi
        if (!in_array($foto_extension, $valid_extensions)) {
            $this->_response([
                'status' => 500,
                'message' => 'Ekstensi foto tidak valid'
            ]);
        }

        // Validasi ukuran file foto
        if ($foto['size'] > 2000000) {
            $this->_response([
                'status' => 500,
                'message' => 'Ukuran foto tidak boleh > 2MB'
            ]);
        }

        // Membuat nama file baru untuk foto
        $nama_foto_baru = md5($nama) . '.' . $foto_extension;

        // Memindahkan file yang diupload
        if (!move_uploaded_file($foto['tmp_name'], 'public/' . $location . '/' . $nama_foto_baru)) {
            $this->_response([
                'status' => 500,
                'message' => 'Gagal upload foto'
            ]);
        }

        return $nama_foto_baru;

    }

    function add_staff()
    {
        // Ambil data yang diambil melalui POST
        $id = uniqid(time());

        $nama = $_POST['nama_staff'];
        $posisi = $_POST['posisi_staff'];

        $foto = $this->_upload_foto($_FILES['foto_staff'], $nama, 'foto');

        $result = $this->db->querySingle("INSERT INTO staffs_tb VALUES ('$id', '$nama', '$posisi', '$foto')");
        $this->_generate_qr($id);

        $this->_response([
            'status' => 200,
            'message' => 'Tambah Data Staff'
        ]);

    }

    function gantipw()
    {
        $pw = $_POST['pw'];
        $result = $this->db->exec("UPDATE admin_tb SET pw = '$pw'");

        if ($this->db->changes() > 0) {            
            $this->_response([
                'status' => 200,
                'message' => 'Ganti Password'
            ]);
        }

        $this->_response([
            'status' => 500,
            'message' => 'ERROR'
        ]);
    }

    function izin()
    {
        
        $idStaff = $_POST['idx_staff'];
        $keterangan = $_POST['keterangan_absen'];
        $bukti = $this->_upload_foto($_FILES['bukti_absen'], 'bukti-' . $idStaff . '-' . time(), 'absen');
        $waktu_tsmp = time();
        $status = 0;
        
        $this->db->exec("INSERT INTO absen_tb VALUES(null, '$idStaff', '$waktu_tsmp', '$status', '$bukti', '$keterangan')");

        if ($this->db->changes() > 0) {
            $this->_response([
                'status' => 200,
                'message' => 'Data Izin Absen berhasil disubmit'
            ]);
        } else {
            $this->_response([
                'status' => 500,
                'message' => 'Data Izin Absen gagal disubmit'
            ]);
        }

    }

    public function getDataById($table, $id) {
        $result = $this->db->query("SELECT * FROM $table WHERE id_staff = '$id'")->fetchArray();
        return $result;
    }

    public function edit_staff()
    {
        $id = $_POST['id_staff'];
        $nama = $_POST['nama_staff'];
        $posisi = $_POST['posisi_staff'];
        $foto = null;

        if ($_FILES['foto_staff']['size'] < 1) {
            $foto = $_POST['foto_staff'];
        } else {
            $foto = $this->_upload_foto($_FILES['foto_staff'], uniqid(), 'foto');
        }

        $result = $this->db->exec("UPDATE staffs_tb SET nama_staff = '$nama', posisi_staff = '$posisi', foto_staff = '$foto' WHERE id_staff = '$id'");

        if ($this->db->changes() > 0) {
            $this->_response([
                'status' => 200,
                'message' => 'Edit Data Staff'
            ]);
        }

    }

    public function delete_staff()
    {
        $id = $_POST['id_staff'];
        $this->db->exec("DELETE FROM staffs_tb WHERE id_staff = '$id'");
        if ($this->db->changes() > 0) {
            $this->_response([
                'status' => 200,
                'message' => 'Hapus Data Staff'
            ]);
        }
    }

    public function login() {

        $pw = $_POST['pw'];

        $result = $this->db->querySingle("SELECT pw FROM admin_tb WHERE pw = '$pw'");

        if ($result != null) {
            session_start();
            $_SESSION['ADMIN_LOGINED'] = 'YES';
            $this->_response([
                'status' => 200,
                'message' => 'Login berhasil'
            ]);
        }

        $this->_response([
            'status' => 500,
            'message' => 'Login gagal'
        ]);
    }

    public function get_staff_by_id()
    {

        $id = $_GET['id_staff'];
        $result = $this->db->query("SELECT * FROM staffs_tb WHERE id_staff = '$id'")->fetchArray();

        if (!$result) {
            $this->_response([
                'status' => 404,
                'message' => 'Tidak ada data staff'
            ]);
        }
        
        $this->_response([
            'status' => 200,
            'data' => $result
        ]);
    }

    public function add_absen()
    {
        $idUser = $_POST['id_user'];
        $waktuTimestamp = time();
        $statusAbsen = 1;
        $buktiAbsen = null;
        $keteranganAbsen = null;
        
        $query = "INSERT INTO absen_tb VALUES (null, '$idUser', '$waktuTimestamp', '$statusAbsen', '$buktiAbsen', '$keteranganAbsen)";

        $this->db->exec($query);
    }

}