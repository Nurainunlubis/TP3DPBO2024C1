<?php

include("config/db.php");
include("classes/DB.php");
include("classes/Penulis.php");
include("classes/Template.php");

$penulis = new Penulis($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$penulis->open();

$dataNavbar = null;
$dataHeader = null;
$dataContent = null;
$dataForm = null;
$title = "Penulis";

if (!isset($_GET['id_update'], $_GET['id_delete']))
{
    $inputTitle = "Add Director";
    $dataForm = "
            <div class='mb-3'>
              <label for='nama_penulis' class='form-label'>Nama Penulis</label>
              <input type='text' class='form-control' id='nama_penulis' name='nama_penulis' placeholder='Masukan Nama Penulis' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-custom' name='btn-submit' id='btn-submit'>Submit</button>
            </div>
    ";

    if (isset($_POST['btn-submit']))
    {
        $nama_penulis = $_POST['nama_penulis'];

        if($penulis->addPenulis($nama_penulis)>0)
        {
            echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    document.location.href = 'penulis.php';
                </script>
                ";
        }
        else
        {
            echo "
                <script>
                    alert('Data Gagal ditambahkan!');
                    document.location.href = 'penulis.php';
                </script>
                ";
        }
        
    }
}

if (isset($_GET['id_update']))
{
    $id_update = $_GET['id_update'];

    $penulis->getDetailPenulis($id_update);
    $row = $penulis->getResult();

    $inputTitle = "Edit Director";
    $dataForm = "
            <div class='mb-3'>
              <input type='hidden' class='form-control' id='id_penulis' name='id_penulis' value='". $row['id_penulis'] ."' />
              <label for='nama_penulis' class='form-label'>Nama Penulis</label>
              <input type='text' class='form-control' id='nama_penulis' name='nama_penulis' value='". $row['nama_penulis'] ."' placeholder='Masukan Nama Penulis...' required />
            </div>
            <div class='float-end'>
                <button type='submit' class='btn btn-custom' name='btn-edit' id='btn-edit'>Submit</button>
                <button type='reset' class='btn btn-secondary' name='btn-reset' id='btn-reset'>Reset</button>
            </div>
    ";

    if (isset($_POST['btn-edit']))
    {
        $id_penulis = $_POST['id_penulis'];
        $nama_penulis = $_POST['nama_penulis'];

        if($penulis->updatePenulis($id_penulis, $nama_penulis)>0)
        {
            echo "
            <script>
            alert('Data berhasil diubah!');
            document.location.href = 'penulis.php';
            </script>
            ";
        }else 
        {
            echo "
            <script>
            alert('Data Gagal diubah!');
            document.location.href = 'penulis.php';
            </script>
            ";
        }
    }
}

if (isset($_GET['id_delete'])) 
{
    $id_penulis = $_GET['id_delete'];

    if($id_penulis > 0)
    {
        if($penulis->deletePenulis($id_penulis)>0)
        {
            echo 
            "
            <script>
                alert('Data berhasil dihapus!');
                document.location.href = 'penulis.php';
            </script>
            ";
        }else 
        {
            echo 
            "
            <script>
                alert('Data gagal dihapus!');
                document.location.href = 'penulis.php';
            </script>
            ";
        }
    }
}

$dataHeader .= "
            <th scope='col'>No</th>
            <th scope='col'>Nama Penulis</th>
            <th scope='col'>Action</th>
";

$penulis->getPenulis();
$no = 1;

while ($row = $penulis->getResult()) {
    // create table row
    $dataContent .= '
    <tr>
        <th scope="row">' . $no . '</th>
        <td>' . $row['nama_penulis'] . '</td>
        <td style="font-size: 22px;">
            <a href="penulis.php?id_update=' . $row['id_penulis'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
            <a href="penulis.php?id_delete=' .$row['id_penulis'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>
    ';
    $no++;
}

$dataNama="Penulis";
$penulis->close();

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