<?php

include("config/db.php");
include("classes/DB.php");
include("classes/Buku.php");
include("classes/Kategori.php");
include("classes/Penulis.php");
include("classes/Template.php");

// buat instance buku
$Buku = new Buku($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$Buku->open(); // buka koneksi

// buku instance update img buku
$updateImg = new Buku($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$updateImg->open(); // buka koneksi

// buat instance penulis
$penulis = new Penulis($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$penulis->open(); // buka koneksi

// buat instance kategori
$kategori = new Kategori($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$kategori->open(); // buka koneksi

$kategori->getKategori();
$penulis->getpenulis();

$dataPenulis = null;
$dataKategori = null;
$gambarUpdate = "";
$judulUpdate = "";
$tahunUpdate = "";
$penulisUpdate = "";
$kategoriUpdate = "";

$view = new Template("templates/skinForm.html");

if (!isset($_GET['edit']))
{
    if (isset($_POST['btn-submit']))
    {
        if($Buku->addDataBuku($_POST, $_FILES)>0)
        {
            echo "
                <script>
                    alert('Data Berhasil ditambahkan!');
                    document.location.href = 'index.php';
                </script>
                ";
        }
        else
        {
            echo "
                <script>
                    alert('Data Gagal ditambahkan!');
                    document.location.href = 'formBuku.php';
                </script>
                ";
        }
    }
    
    while ($row =  $penulis->getResult())
    {
        $dataPenulis .= "
            <option value='". $row['id_penulis'] ."'>". $row['nama_penulis']."</option>
        ";
    }

    while ($row = $kategori->getResult())
    {
        $dataKategori .= "
            <option value='". $row['id_kategori'] ."'>". $row['nama_kategori'] ."</option>
        ";
    }
    $title = "Add Buku";
    $view->replace("DATA_TITLE", $title);

}
else if (isset($_GET['edit']))
{
    $idPrev = $_GET['edit'];
    $updateImg->getBuku();
    $updateImg->getBukuById($idPrev);
    $updtImg = $updateImg->getResult();
    $imgNew = $updtImg['gambar'];
    
    if (isset($_POST['btn-submit']))
    {
        if($buku->updateData($idPrev, $_POST, $_FILES, $imgNew)>0)
        {
            echo "
            <script>
            alert('Data Berhasil diubah!');
            document.location.href = 'index.php';
            </script>
            ";
        }
        else
        {
            echo "
            <script>
            alert('Data Gagal diubah!');
            document.location.href = 'formBuku.php';
            </script>
            ";
        }
    }
    $Buku->getBukuById($idPrev);
    $row = $buku->getResult();
    $gambarUpdate = $row['gambar'];
    $judulUpdate = $row['judul'];
    $tahunUpdate = $row['tahun_terbit'];
    $penulisUpdate = $row['id_penulis'];
    $kategoriUpdate = $row['id_kategori'];

    $penulis->getPenulis();
    while ($row = $penulis->getResult())
    {
        $selected = ($row['id_penulis'] == $penulisUpdate) ? 'selected' : '';
        $datapenulis .= "<option value='". $row['id_penulis'] ."' $selected>". $row['nama_penulis']."</option>";
    }


    $kategori->getKategori();
    while ($row = $kategori->getResult())
    {
        $selected = ($row['id_kategori'] == $kategoriUpdate) ? 'selected' : '';
        $datakategori .= "<option value='". $row['id_kategori'] ."' $selected>". $row['kategori_buku'] ."</option>";
    }

    $title = "Update Buku";
    $view->replace("DATA_TITLE", $title);

}

// tutup koneksi 
$Buku->close();
$kategori->close();
$penulis->close();

// simpan data ke template
$view->replace("DATA_JUDUL", $judulUpdate);
$view->replace("DATA_TAHUN", $tahunUpdate);
$view->replace("DATA_GAMBAR", $gambarUpdate);
$view->replace("DATA_PENULIS", $dataPenulis);
$view->replace("DATA_KATEGORI", $dataKategori);
$view->write();

?>