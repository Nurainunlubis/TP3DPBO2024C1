<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Buku.php');
include('classes/Kategori.php');
include('classes/Penulis.php');
include('classes/Template.php');


$Buku = new Buku($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$Buku->open();

$data = null;

if (isset($_GET['id'])){
    $id = $_GET['id'];
    if ($id > 0)
    {
        $Buku->getBukuById($id);
        $row = $Buku->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail Buku ' . $row['judul'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/' . $row['gambar'] . '" class="img-thumbnail" alt="' . $row['gambar'] . '" width="100">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Judul Buku</td>
                                    <td>:</td>
                                    <td>' . $row['judul'] . '</td>
                                </tr>
                                <tr>
                                    <td>Tahun Terbit</td>
                                    <td>:</td>
                                    <td>' . $row['tahun_terbit'] . '</td>
                                </tr>
                                <tr>
                                <td>Penulis</td>
                                <td>:</td>
                                <td>' . $row['nama_penulis'] . '</td>
                                </tr>
                                <tr>
                                    <td>Kategori</td>
                                    <td>:</td>
                                    <td>' . $row['nama_kategori'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="addMovie.php?edit=' . $row['id_buku'] . '"><button type="button" class="btn btn-color text-white">Ubah Data</button></a>
                <a href="detail.php?hapus=' . $row['id_buku'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

if (isset($_GET['hapus']))
{
    $id = $_GET['hapus'];
    if ($id > 0) 
    {
        if ($Buku->deleteData($id) > 0) 
        {
            echo 
            "
            <script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>
            ";
        } else 
        {
            echo 
            "
            <script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>
            ";
        }
    }
}

$Buku->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_BUKU', $data);
$detail->write();

