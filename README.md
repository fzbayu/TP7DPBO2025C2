# TP7DPBO2025C2

# JANJI
Saya Faiz Bayu Erlangga dengan NIM 2311231 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## DESAIN PROGRAM
![Screenshot 2025-04-19 203602](https://github.com/user-attachments/assets/f224cbb5-14a4-4589-b1df-fc9433aea7a2)

Program ini merupakan penerapan OOP dalam pembuatan website untuk membangun aplikasi yang lebih terstruktur, modular, dan mudah dikelola. 

Bagian ## DESAIN PROGRAM dalam sebuah dokumen laporan (biasanya laporan tugas akhir, proyek, atau praktikum) bertujuan untuk menjelaskan bagaimana program yang dibuat dirancang sebelum diimplementasikan. Penjelasan dalam bagian ini biasanya meliputi:

1. Struktur Umum Program
   
Program ini dibagi menjadi beberapa komponen utama seperti koneksi database, class-class utama (kategori_menu, menu, pemesan, pesanan), dan tampilan (view).

2. Desain Antarmuka (User Interface)
   
Antarmuka terdiri dari halaman utama yang menampilkan navigasi ke empat menu utama yaitu: Kategori, Menu, Pemesan, dan Pesanan. 

3. Desain Kelas
   
kategori_menu: Menyimpan dan menampilkan data kategori makanan.
menu: Menyimpan dan menampilkan daftar menu makanan.
pemesan: Menyimpan data pemesan makanan.
pesanan: Menyimpan informasi pemesanan dari pemesan terhadap menu tertentu.
Masing-masing class memiliki metode untuk getAll, tambah, ubah, hapus, dan getbyId. Dalam menu menggunakan searchByName untuk searching

4. Alur Navigasi
   
Navigasi dilakukan dengan menggunakan parameter $_GET['page']. Parameter ini digunakan untuk memuat konten halaman yang sesuai melalui struktur switch-case. Contoh: ?page=menu akan menampilkan isi dari view/menu.php.

6. Struktur Folder dan File
   
/

├── config/          -> berisi konfigurasi seperti koneksi databas

├── class/           -> berisi class PHP untuk masing-masing entitas

├── database/        -> berisi file mysql (warung_makan.sql)

├── view/            -> berisi file tampilan masing-masing halaman

├── style.css        -> file CSS untuk styling

├── index.php        -> file utama yang menangani routing halaman


7. Desain ERD
   
Tabel yang digunakan:
kategori_menu: menyimpan ID dan nama kategori
menu: menyimpan ID, nama, harga, dan ID kategori
pemesan: menyimpan ID, nama, dan alamat pemesan
pesanan: menyimpan ID, ID pemesan, ID menu, tanggal_pesanan

a. Tabel kategori_menu

- Menyimpan informasi kategori dari menu makanan.
- id_kategori (PK): ID unik untuk tiap kategori menu.
- nama_kategori: Nama kategori, misalnya "Minuman", "Makanan Berat", dll.

b. Tabel menu

- Menyimpan daftar menu makanan/minuman yang tersedia
- id_menu (PK): ID unik untuk setiap menu.
- nama_menu: Nama dari menu, misalnya "Nasi Goreng", "Es Teh".
- harga: Harga dari menu.
- id_kategori (FK): Merujuk ke id_kategori di tabel kategori_menu.
- Relasi: menu.id_kategori → kategori_menu.id_kategori (Relasi many-to-one: banyak menu bisa termasuk dalam satu kategori)

c. Tabel pemesan

- Menyimpan informasi tentang pemesan.
- id_pemesan (PK): ID unik pemesan.
- nama_pemesan: Nama pelanggan.
- alamat: Alamat pelanggan.

d. Tabel pesanan

- Mewakili transaksi pemesanan makanan oleh pelanggan.
- id_pesanan (PK): ID unik pesanan.
- id_menu (FK): Merujuk ke menu.id_menu.
- id_pemesan (FK): Merujuk ke pemesan.id_pemesan.
- jumlah: Jumlah porsi yang dipesan.
- tanggal: Tanggal pesanan dilakukan.
- Relasi: pesanan.id_menu → menu.id_menu, pesanan.id_pemesan → pemesan.id_pemesan (Relasi many-to-one: satu pesanan hanya untuk satu menu dan satu pemesan, tapi satu pemesan/menu bisa memiliki banyak pesanan)

## PENJELASAN ALUR
Ini adalah website warung makan online sederhana yang menyediakan menu yang beranekaragam, di mana alur dalam program ini dimulai dengan menampilkan halaman utama atau index.php. Terdapat tulisan Warung Makan Online, selamat datang di warung makan online dan terdapat beberapa page yang bisa diklik oleh user yaitu kategori, menu, pemesan dan pesanan.

1. Halaman utama / pesanan
Dalam index.php ditampilkan daftar pesanan yaitu ada id_pesanan, nama_menu (data diambil dari tabel menu), pemesan (data diambil dari tabel pemesan), jumlah, tanggal_pesan dan aksi (edit atau hapus). Kita dapat menambah pesanan dengan mengisi data yang tersedia dengan mengisi menu (dropdown), pemesan (dropdown), jumlah pesanan, tanggal. Kemdian klik tambah maka data akan tercatat dalam tabel pesanan. Jika ingin mengedit tinggal klik edit, maka form tambah pesanan akan berubah menjadi form edit pesanan, lalu ubah data yang diinginkan lalu simpan perubahan, terdapat tombol batal jika tidak jadi update maka form berubah kembali ke form tambah pesanan. Jika ingin menghapus maka klik hapus dan ok, maka data akan terhapus dari tabel pesanan.

2. Kategori
Dalam page ini bisa dilihat tabel data kategori menu, terdapat id kategori, nama kategori dan aksi. Kategori dapat ditambahkan dengan mengisi form tambah kategori lalu klik tambah kategori, maka data akan tersimpan dalam tabel. Jika ingin edit tinggal klik edit, dan isi form kemudian simpan. Jika ingin delete, klik hapus maka data akan terhapus.

3. Pemesan
Dalam page ini bisa dilihat tabel data orang yang memesan, terdapat id pemesan, nama pemesan, alamat dan aksi. Data pemesan dapat ditambahkan dengan mengisi form tambah pemesan lalu klik tambah pemesan, maka data akan tersimpan dalam tabel. Jika ingin edit tinggal klik edit, dan isi form kemudian simpan. Jika ingin delete, klik hapus maka data akan terhapus.

4. Menu
Dalam page ini ditampilkan data menu yang terdiri dari id menu, nama menu, harga menu, kategori (diambil dari tabel kategori) dan aksi. Kita dapat menambah menu dengan mengisi data yang tersedia dengan mengisi nama menu, harga, dan kategori (dropdown). Kemdian klik tambah maka data akan tercatat dalam tabel menu. Jika ingin mengedit tinggal klik edit, maka form tambah menu akan berubah menjadi form edit menu, lalu ubah data yang diinginkan lalu simpan perubahan, terdapat tombol batal jika tidak jadi update maka form berubah kembali ke form tambah menu. Jika ingin menghapus maka klik hapus dan ok, maka data akan terhapus dari tabel menu.

5. Search
Tersedia juga fitur search dalam page menu, dimana bisa mencari nama menu yang diinginkan oleh user, dengan mengisi nama menu pada form, lalu klik cari, jika menu yang dicari ada pada tabel maka akan ditampilkan, jika tidak maka hasil pencarian akan kosong. Contoh : nasi, maka dalam tabel muncul nasi goreng, nasi kebuli, dll.


## DOKUMENTASI
https://github.com/user-attachments/assets/d30635c6-edf7-4863-b8ad-20d7f5cabdc1


