# sistem-dasar
Sistem yang dilengkapi dengan fitur-fitur dasar yang diperlukan di tiap aplikasi/sistem secara umum

## Fitur
1. **Registrasi** disertai **validasi** formulir dan **verifikasi** menggunakan **surel**
2. **Masuk** juga dengan **validasi** formulir, sistem **autentikasi**, menggunakan **sesi**, dan menyimpan **kuki**
3. [x] ~~Sistem untuk mengakomodasi jika pengguna mengakses laman tertentu: **beranda** dan **galat**~~
4. Sistem untuk **mengubah** sandi jika **lupa** dengan **verifikasi surel**
5. **Otorisasi pengguna** sesuai **peran** dan **menu**
6. Manajemen **profil pengguna**, **peran**, dan **menu**
7. **Enkripsi** data
8. Sistem **pencatatan**
9. Sistem yang memungkinkan agar bisa dijalankan secara **luring**
10. Penggunaan **js**
11. **Dokumentasi** lengkap

## Masalah
1. Formulir login tidak menjalankan validasi js terlebih dahulu. Poin2 yang berbeda dengan formulir2 lain adalah:<br>
    a. Memiliki method chaining `name()` pada route untuk view (kecurigaan: tinggi)<br>
    b. Jenis proses adalah autentikasi, bukan validasi dan proses basisdata biasa (kecurigaan: sedang)<br>
    c. Route proses tidak membentuk pola *route_view/route_proses* tapi hanya */route_proses* (kecurigaan: rendah)<br>