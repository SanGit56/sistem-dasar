<!DOCTYPE html>
<html>
<head>
    <title>{{ $data['subyek'] }}</title>
</head>
<body>
    <p>Halo {{ $data['nama_penerima'] }},</p>
    <p>Anda mendapat email ini karena kami menerima permintaan pendaftaran akun baru dari alamat email ini di mKlinik.</p>
    <p>Jika anda tidak merasa melakukan pendaftaran, mungkin ada orang lain yang mencoba menyalahgunakan email anda, harap segera abaikan dan hapus email ini.</p>
    <p>Jika anda memang sengaja melakukan pendaftaran, silakan klik tautan berikut...</p>
    {{-- <p><a href="' . site_url() . '/Otorisasi/verifikasi?email=' . $this->request->getPost('surel') . '&token=' . urlencode($token) . '&apl=' . urlencode($kode_org) . '">Klik untuk verifikasi</a></p> --}}
</body>
</html>