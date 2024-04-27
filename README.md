# TP3DPBO2024C1
## JANJI 
```bash
Saya Nur Ainun 2202046 mengerjakan LATIHAN PRAKTIKUM 5 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek 
untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin. 


## Deskripsi Program

Program ini adalah sebuah aplikasi berbasis PHP dengan antarmuka grafis (GUI) untuk manajemen data buku. Tujuan utama dari program ini adalah memudahkan pengguna dalam melakukan operasi CRUD (Create, Read, Update, Delete) terhadap data buku. Program ini memungkinkan pengguna untuk menambah, mengubah, menghapus, dan melihat data buku yang tersimpan dalam database.

## Desain Database

### Tabel Buku
- Kolom id_buku: Primary key untuk identifikasi unik buku.
- Kolom judul: Menyimpan judul buku.
- Kolom id_kategori: Foreign key yang merujuk ke tabel Kategori, menunjukkan kategori buku.
- Kolom tahun_terbit: Menyimpan tahun terbit buku.

### Tabel Kategori
- Kolom id_kategori: Primary key untuk identifikasi unik kategori.
- Kolom nama_kategori: Menyimpan nama kategori.

### Tabel Penulis
- Kolom id_penulis: Primary key untuk identifikasi unik penulis.
- Kolom nama_penulis: Menyimpan nama penulis.

### Tabel Penerbit
- Kolom id_penerbit: Primary key untuk identifikasi unik penerbit.
- Kolom nama_penerbit: Menyimpan nama penerbit.

## Alur Program CRUD dengan Database

1. **Koneksi Database**:
   - Saat program dimulai, koneksi dengan database MySQL dibuat menggunakan PDO (PHP Data Objects).
   - Informasi koneksi seperti host, nama pengguna, kata sandi, dan nama database disimpan dalam file konfigurasi.

2. **Create/Insert (Tambah Data)**:
   - Pengguna dapat menambahkan buku baru dengan mengisi formulir yang mencakup judul, kategori, tahun terbit, penulis, dan penerbit.
   - Data yang diisi akan disimpan ke dalam tabel Buku di database.

3. **Read (Baca Data)**:
   - Saat program dimulai atau ketika pengguna memilih untuk melihat daftar buku, program akan melakukan query SELECT untuk mendapatkan data buku dari tabel Buku.
   - Hasil query tersebut akan ditampilkan dalam tabel pada antarmuka pengguna.

4. **Update (Ubah Data)**:
   - Pengguna dapat mengubah informasi buku dengan memilih buku yang ingin diubah dari daftar buku yang ditampilkan.
   - Data buku yang dipilih akan ditampilkan kembali dalam formulir, memungkinkan pengguna untuk melakukan perubahan.
   - Setelah pengguna menyimpan perubahan, program akan mengirimkan query UPDATE untuk memperbarui data buku di database.

5. **Delete (Hapus Data)**:
   - Pengguna dapat menghapus buku dengan memilih buku yang ingin dihapus dari daftar buku yang ditampilkan.
   - Program akan mengirimkan query DELETE untuk menghapus buku dari database.

## Keterangan Tambahan
  - Program menampilkan daftar buku, penulis, kategorinya
  - Setiap tabel dapat melakukan Create, Read, Delete, dan Update
  - Tabel Kategori dan Penulis ditampilkan dengan view berbentuk tabel
  - Tabel Buku ditampilkan dengan tampilan berbentuk card yang bisa di klik untuk melihat detailnya
  - Terdapat fungsi searching berdasarkan judul Buku
