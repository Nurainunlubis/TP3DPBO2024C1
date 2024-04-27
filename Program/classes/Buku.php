<?php

class Buku extends DB
{
    function getBukujoin()
    {
        $query = "SELECT * FROM buku JOIN  kategori ON buku.id_kategori = kategori.id_kategori JOIN penulis ON buku.id_penulis = penulis.id_penulis ORDER BY buku.id_buku";
        return $this->execute($query);
    }

    function getBuku()
    {
        $query = "SELECT * FROM buku";
        return $this->execute($query);
    }

    function getBukuById($id)        
    {
        $query = "SELECT * FROM buku JOIN kategori ON buku.id_kategori=kategori.id_kategori JOIN penulis ON buku.id_penulis = penulis.id_penulis WHERE id_buku=$id";
        return $this->execute($query);
    }

    function searchBuku($keyword)
    {
        $query = "SELECT * FROM buku JOIN kategori ON buku.id_kategori=kategori.id_kategori JOIN penulis ON buku.id_penulis=penulis.id_penulis WHERE judul Like '%" . $keyword . "%'";
        return $this->execute($query);
    }

    function filterAsc()
    {
        $query = "SELECT * FROM buku JOIN kategori ON buku.id_kategori=kategori.id_kategori JOIN penulis ON buku.id_penulis=penulis.id_penulis ORDER BY judul ASC";
        return $this->execute($query);
    }

    function filterDesc()
    {
        $query = "SELECT * FROM buku JOIN kategori ON buku.id_kategori=kategori.id_kategori JOIN penulis ON buku.id_penulis=penulis.id_penulis ORDER BY judul DESC";
        return $this->execute($query);
    }

    function addDataBuku($data, $file)    
    {
        $judul = $data['judul'];
        $tahun = $data['tahun_terbit'];

        $gambar = rand(1000, 1000) . "-" . $_FILES['gambar']['name'];
        $tmpImage = $_FILES['gambar']['tmp_name'];
        $uploads_dir = './assets/';

        move_uploaded_file($tmpImage, $uploads_dir . '/' . $gambar);
        
        $id_penulis = $data['id_penulis'];
        $id_kategori = $data['id_kategori'];

        $query = "INSERT INTO buku VALUES ('', '$judul', '$tahun', '$gambar', '$id_penulis', '$id_kategori')";
        
        return $this->executeAffected($query);
    }

    function updateDataBuku($idPrev, $data, $file, $image)
    {
        $judul= $data['judul'];
        $tahun = $data['tahun_terbit'];


        $gambar = rand(1000, 1000) . "-" . $_FILES['gambar']['name'];
        $tmpImage = $_FILES['gambar']['tmp_name'];
        $uploads_dir = './assets/';

        move_uploaded_file($tmpImage, $uploads_dir . '/' . $gambar);

        $id_penulis = $data['id_penulis'];
        $id_kategori = $data['id_kategori'];
 
        $query = "UPDATE buku SET judul ='$judul', tahun_terbit ='$tahun', gambar='$gambar', id_penulis='$id_penulis', id_kategori='$id_kategori' WHERE id_buku='$idPrev'";
         
        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM buku WHERE id_buku='$id'";
        return $this->executeAffected($query);
    }

}