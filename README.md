# TP10DPBO2425C2

## JANJI
Saya Shakila Aulia dengan NIM 2403086 mengerjakan Tugas Praktikum 10 dalam mata kuliah Desain dan Pemograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

## Desain Program

Proyek ini adalah implementasi operasi CRUD (Create, Read, Update, Delete) serta transaksi sederhana untuk entitas Film, Studio, Jadwal, dan Tiket menggunakan PHP Native dengan pola arsitektur Model-View-ViewModel (MVVM).

### 1. Model
Bertanggung jawab penuh atas manajemen data, query database, dan representasi objek entitas. Lapisan ini tidak mengetahui apa pun tentang tampilan (UI).
* **Film.php.php** Kelas entitas yang menangani query SQL (SELECT, INSERT, UPDATE, DELETE) untuk tabel films.
* **Studio.php** Kelas entitas yang menangani manipulasi data untuk tabel studios.
* **Jadwal.php** Kelas entitas yang menangani relasi antara Film dan Studio, serta jadwal tayangnya.
* **Tiket.php** Kelas entitas yang menangani transaksi pembelian tiket dan relasi ke tabel Jadwal.

### 2. View
Bertanggung jawab untuk menyajikan data kepada pengguna (User Interface). Lapisan ini hanya menerima data yang sudah matang dari ViewModel dan menampilkannya.

* **index.php (di setiap folder view)** Menampilkan tabel daftar data (Read) dan tombol aksi.
* **create.php / add.php** Menampilkan form untuk input data baru (Create).
* **edit.php** Menampilkan form yang sudah terisi data lama untuk diubah (Update).

### 3. ViewModel
Bertindak sebagai "otak" atau perantara. ViewModel mengambil data mentah dari Model, memproses logika bisnis (jika ada), dan menyediakannya agar mudah diambil oleh View.

* **FilmViewModel.php** Mengambil data film dari Model dan menyerahkannya ke View Film.
* **StudioViewModel.php** Mengatur logika pengelolaan data studio.
* **JadwalViewModel.php** Menggabungkan data dari Model Film dan Model Studio untuk ditampilkan dalam dropdown saat pengaturan jadwal.
* **TiketViewModel.php** Menangani logika transaksi, menghitung total bayar, dan menghubungkan data jadwal ke form pembelian tiket.
---

## Alur Program
A. Tampilan Awal (Index / Read)
1. Pengguna mengakses halaman utama daftar data (misal: Data Film).
2. View memanggil FilmViewModel.
3. ViewModel memanggil method read() pada Model Film.
4. Model laku menjalankan query SELECT * FROM films dan mengembalikan hasilnya.
5. View akan menerima array data dari ViewModel dan me-render tabel HTML berisi daftar film.

B. Proses Tambah Data (Create)
1. Pengguna mengklik tombol "Tambah Film". Halaman add.php ditampilkan.
2. Pengguna mengisi formulir (Judul, Genre, dll) dan menekan tombol Simpan (POST).
3. ViewModel menerima data $_POST, lalu memanggil method create() pada Model.
4. Model melakukan sanitasi data dan menjalankan query INSERT INTO ke database.
5. Setelah sukses, sistem mengarahkan kembali ke halaman daftar utama (index.php).

C. Alur Pembaruan Data (Update / Edit)
Proses ini melibatkan pengambilan data lama untuk ditampilkan, lalu menyimpan perubahannya.
1. Permintaan Form Edit (GET) dimana pengguna mengklik "Edit" pada tabel (edit.php?id=1).
2. ViewModel lalu menerima ID, lalu meminta Model mengambil data spesifik tersebut (readOne / fetchById).
3. Form ditampilkan dengan nilai (value) yang otomatis terisi data lama.
4. Proses Update (POST) pengguna mengubah data dan menekan "Update".
5. ViewModel mengirim data baru ke Model untuk diperbarui.
6. Model menjalankan query UPDATE films SET ... WHERE id=....
7. Kembali ke halaman daftar utama.

D. Alur Penghapusan Data (Delete)
1. Pengguna mengklik tombol "Hapus" yang memicu link dengan parameter (index.php?action=delete&id=1).
2. Sistem mendeteksi parameter delete.
3. ViewModel memanggil method delete() pada Model.
4. Model menjalankan query DELETE FROM ... WHERE id=... di database.
5. Halaman di-refresh dan data tersebut hilang dari tabel.

---

## Dokumentasi

### Data Film (CRUD)
![TP10_Film-ezgif com-video-to-gif-converter](https://github.com/user-attachments/assets/1d2e5fb5-3c4d-4c57-963d-71ae46b8838d)


### Data Studio (CRUD)
![TP10_STUDIO-ezgif com-video-to-gif-converter](https://github.com/user-attachments/assets/4209e9f7-966c-41ab-8334-974a304bd940)


### Kelola Jadwal (Relasi Film & Studio & CRUD)
![TP10_JADWAL-ezgif com-video-to-gif-converter](https://github.com/user-attachments/assets/4c7208c4-06fd-4a9c-94d1-e3e4162756a3)


### Transaksi Tiket (Relasi ke Jadwal & CRUD)
![TP10_TIKET-ezgif com-video-to-gif-converter](https://github.com/user-attachments/assets/19b88104-e1b4-4744-8d06-c66785f07475)

