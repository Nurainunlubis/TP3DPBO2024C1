<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Buku.php');
include('classes/Kategori.php');
include('classes/Penulis.php');
include('classes/Template.php');

//bua instance buku
$listBuku = new Buku($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listBuku->open();
// tampilkan data buku
$listBuku->getBukuJoin();

// cari buku
if (isset($_POST['btn-cari'])) {
  // methode mencari data buku
  $listBuku->searchBuku($_POST['cari']);
} else {
  // methode menampilkan data buku
  $listBuku->getBukuJoin();
}

$data = null;

// ambil data buku
// gabungan dengan tag html
// untuk di passing ke skin/template
while ($row = $listBuku->getResult())
{
  $data .= '<div class="col-md-3 mb-4 d-flex justify-content-center">' .
  '<div class="card pt-4 px-2 buku-thumbnail">
  <a href="detail.php?id=' . $row['id_buku'] . '">
      <div class="row justify-content-center">
          <img src="assets/' . $row['gambar'] . '" class="card-img-top" alt="' . $row['gambar'] . '">
      </div>
      <div class="card-body">
          <p class="card-text buku-nama fw-bold my-0" style="font-size: 1.1em;">' . $row['judul'] . '</p>
          <p class="card-text kategori-nama " style="font-size: 1em; color: rgb(20, 51, 79);">' . $row['nama_kategori'] . '</p>
          <p class="card-text penulis-nama " style="font-size: 1em; color: rgb(43, 20, 145);">' . $row['nama_penulis'] . '</p>
      </div>
  </a>
</div>    
</div>';
}

// tutup koneksi
$listBuku->close();

// membuat instance template
$home = new Template('templates/index.html');

// simpan data ke template
$home->replace('DATA_TABLE', $data);
$home->write();
