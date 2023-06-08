<?php

require_once('../vendor/autoload.php');

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

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
        $this->db = new SQLite3('../db/absenky.db');
    }

    private function _response($res)
    {
        echo json_encode($res);
        exit;
    }

    function _upload_foto($foto, $nama = 'foto')
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
                'messages' => 'Ekstensi foto tidak valid'
            ]);
        }

        // Validasi ukuran file foto
        if ($foto['size'] > 2000000) {
            $this->_response([
                'status' => 500,
                'messages' => 'Ukuran foto tidak boleh > 2MB'
            ]);
        }

        // Membuat nama file baru untuk foto
        $nama_foto_baru = md5($nama) . '.' . $foto_extension;

        // Memindahkan file yang diupload
        if (!move_uploaded_file($foto['tmp_name'], '../public/foto/' . $nama_foto_baru)) {
            $this->_response([
                'status' => 500,
                'messages' => 'Gagal upload foto'
            ]);
        }

        return $nama_foto_baru;

    }

    function add()
    {
        // Ambil data yang diambil melalui POST
        $id = uniqid(time());

        $nama = $_POST['nama'];
        $posisi = $_POST['posisi'];

        $foto = $this->_upload_foto($_FILES['foto'], $nama);

        $this->db->querySingle("INSERT INTO users_tb VALUES ('$id', '$nama', '$posisi', '$foto')");
        $this->_generate_qr($id);

    }
    
    private function _generate_qr($isi)
    {

        require_once('../libs/phpqrcode/qrlib.php');

        if (!is_dir('../public/qr')) {
            mkdir('../public/qr');
        }

        QRcode::png($isi, '../public/qr/' . $isi . '.png', QR_ECLEVEL_H, 24);

    }
}
