<?php

class penulis extends DB
{
    function getPenulis()
    {
        $query = "SELECT * FROM penulis";
        return $this->execute($query);
    }

    function getDetailpenulis($id_penulis)
    {
        $query = "SELECT * FROM penulis WHERE id_penulis='$id_penulis'";
        return $this->execute($query);
    }

    function addPenulis($nama_penulis) 
    {
        $query = "INSERT INTO penulis VALUES ('', '$nama_penulis')";
        return $this->executeAffected($query);
    }

    function updatePenulis($id_penulis, $nama_penulis) 
    {
        $query = "UPDATE penulis SET nama_penulis='$nama_penulis' WHERE id_penulis='$id_penulis'";
        return $this->executeAffected($query);
    }

    function deletePenulis($id_penulis) 
    {
        $query = "DELETE FROM penulis WHERE id_penulis='$id_penulis'";
        return $this->executeAffected($query);
    }
}
?>