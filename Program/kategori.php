<?php

include("config/db.php");
include("classes/DB.php");
include("classes/Kategori.php");
include("classes/Template.php");

$kategori = new Kategori($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$kategori->open();

$dataNavbar = null;
$dataHeader = null;
$dataContent = null;
$dataForm = null;
$title = "Kategori";

if (!isset($_GET['id_update'], $_GET['id_delete']))
{
    $inputTitle = "Add Kategori";
    $dataForm = "
            <div class='mb-3'>
              <label for='nama_kategori' class='form-label'>Kategori Buku</label>
              <input type='text' class='form-control' id='nama_kategori' name='nama_kategori' placeholder='Masukan Kategori' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-custom' name='btn-submit' id='btn-submit'>Submit</button>
            </div>
    ";

    if (isset($_POST['btn-submit']))
    {
        $nama_kategori = $_POST['nama_kategori'];
        if($kategori->addKategori($nama_kategori)>0)
        {
            echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'kategori.php';
                </script>
                ";
        } else
        {
            echo "
                <script>
                    alert('Data Gagal ditambahkan!');
                    document.location.href = 'kategori.php';
                </script>
                ";
        }
    }
}

if (isset($_GET['id_update']))
{
    $id_update = $_GET['id_update'];

    $kategori->getDetailKategori($id_update);
    $row = $kategori->getResult();

    $inputTitle = "Edit Kategori";
    $dataForm = "
    
            <div class='mb-3'>
              <input type='hidden' class='form-control' id='id_kategori' name='id_kategori' value='". $row['id_kategori'] ."' />
              <label for='nama_kategori' class='form-label'>Kategori Buku</label>
              <input type='text' class='form-control' id='nama_kategori' name='nama_kategori' value='". $row['nama_kategori'] ."' placeholder='Masukan Nama Kategori...' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-custom' name='btn-edit' id='btn-edit'>Submit</button>
            </div>
    ";

    if (isset($_POST['btn-edit']))
    {
        $id_kategori = $_POST['id_kategori'];
        $nama_kategori = $_POST['nama_kategori'];

        if($kategori->updateKategori($id_kategori, $nama_kategori)>0){
            echo "
            <script>
            alert('Data berhasil diubah!');
            document.location.href = 'kategori.php';
            </script>
            ";
        }else {
            echo "
            <script>
            alert('Data Gagal diubah!');
            document.location.href = 'kategori.php';
            </script>
            ";
        }
    }
}

if (isset($_GET['id_delete']))
{
    $id_kategori = $_GET['id_delete'];

    if($id_kategori > 0)
    {
        if($kategori->deleteKategori($id_kategori)>0)
        {
            echo 
            "
            <script>
                alert('Data berhasil dihapus!');
                document.location.href = 'kategori.php';
            </script>
            ";
        }else 
        {
            echo 
            "
            <script>
                alert('Data gagal dihapus!');
                document.location.href = 'kategori.php';
            </script>
            ";
        }
    }
}

$dataHeader .= "
            <th scope='col'>No</th>
            <th scope='col'>Kategori Buku</th>
            <th scope='col'>Action</th>
";

$kategori->getKategori();
$no = 1;

while ($row = $kategori->getResult())
{
    $dataContent .= '
    <tr>
        <th scope="row">' . $no . '</th>
        <td>' . $row['nama_kategori'] . '</td>
        <td style="font-size: 22px;">
            <a href="kategori.php?id_update=' . $row['id_kategori'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
            <a href="kategori.php?id_delete=' .$row['id_kategori'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>
    ';
    $no++;
}

$kategori->close();
$dataNama = "Kategori";

$view = new Template("templates/skintable.html");
$view->replace("DATA_NAVBAR", $dataNavbar);
$view->replace("DATA_TITLE", $title);
$view->replace("DATA_INPUT_TITLE", $inputTitle);
$view->replace("DATA_INPUT_FORM", $dataForm);
$view->replace("DATA_HEADER", $dataHeader);
$view->replace("DATA_CONTENT", $dataContent);
$view->replace("DATA_NAMA", $dataNama);
$view->write();

?>