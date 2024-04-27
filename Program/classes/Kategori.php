<?php

class Kategori extends DB
{
    
    function getKategori()
    { 
        $query = "SELECT * FROM kategori";
        return $this->execute($query);
    }

    function searchKategori($keyword)
    {
        $query = "SELECT * FROM kategori WHERE nama_kategori Like '%" . $keyword . "%'";
        return $this->execute($query);
    }

    function getDetailKategori($id_kategori)
    {
        $query = "SELECT * FROM kategori WHERE id_kategori='$id_kategori'";
        return $this->execute($query);
    }
    
    function addKategori($nama_kategori)
    {
        $query = "INSERT INTO kategori VALUES ('', '$nama_kategori')";
        return $this->executeAffected($query);
    }
    
    function updateKategori($id_kategori, $nama_kategori)
    {
        $query = "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id_kategori'";
        return $this->executeAffected($query);
    }
    
    function deleteKategori($id_kategori)
    {
        $query = "DELETE FROM kategori WHERE id_kategori='$id_kategori'";
        return $this->executeAffected($query);
    }
}

?>