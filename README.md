# Sistem Informasi Akademik Perguruan Tinggi

**Sistem Informasi Akademik Perguruan Tinggi** / **SIAKAD - PT** adalah aplikasi pengolahan data akademik perguruan tinggi berbasis web dimana data yang dikelolah mulai dari data kemahasiswaan, data tenaga pedidik dan data akademik lainnya. Aplikasi ini menggunakan framework [codeigniter](https://codeigniter.com) dan beberapa template untuk bagian frontend nya.

![SIAKAD - PT](public/assets/templates/adminlte/dist/img/default_set.png)

# DEMO
Demo aplikasi **SIAKAD - PT** dapat dilihat di [Demo](http://web-project-beta.000webhostapp.com/siakad-uncp/). Untuk saat ini demo yang ada menggunakan versi pertama, demo akan di usahakan menggunakan versi yang sesuai dengan status release terakhir repository ini. Demo itu menampilkan aplikasi sistem informasi akademik salah satu perguruan tinggi di indonesia.

**SIAKAD - PT** dapat diakses dengan akses level sebagai admin dengan memasukkan **Username** = **admin** dan **Password** = **admin**. Untuk akses sebagai mahasiswa dan tenaga pendidik/dosen bisa melihat username dan password di data pengguna saat sudah login sebagai admin

# Server Requirements

**PHP version 7.0** atau direkomendasikan menggunakan yang paling terbaru. Server
disesuaikan dengan spesifikasi codeigniter untuk bisa berjalan dengan baik.

# Contribution

Dev By: Muhammad Dicky Hidayat Latif

# Template

Aplikasi ini dapat menggunakan lebih dari satu template dan kedapannya akan bertambah. Diantara template yang sudah ada yaitu:

No. | Template | Version | Status
--- | -------- | ------- | ------
1\. | [AdminLTE](https://github.com/almasaeed2010/AdminLTE) | 2.4.3 | Production
2\. | [CoreUI](https://github.com/mrholek/CoreUI-Free-Bootstrap-Admin-Template) | 1.0.10 | In Development

# Instalasi

Untuk menggunakan aplikasi dapat dimulai dengan menyesuaikan konfigurasi di file **configuration.php**. Untuk lebih lengkapnya contact **muh.dickyhidayat@gmail.com**.
1. Pertama - tama siapkan database **SIAKAD**
2. Buka file **configuration.php** lalu lakukan beberapa pengaturan seperti ini:
    * Masukkan base url ```var $_site_url = 'http://contoh-url/'```
	* Jika aplikasi dalam sub folder seperti **localhost/siakad-pt/** maka property ini diisi sesuai dengan nama sub folder, jika tidak dalam sub folder makan kosong kan saja ```var $_sub_domain = 'siakad-pt'```
    * Masukkan host database ```var $_hostname = ''```
    * Masukkan username database ```var $_database_user = ''```
	* Masukkan password database ```var $_database_password = ''```
	* Masukkan nama database ```var $_database_name = ''```
    * Masukkan nama perguruan tinggi ```var $_pt_name = 'Nama PT'```
3. Install semua package require yang sudah ada dalam file **composer.json**. Ini memerlukan composer untuk melakukan penginstalan.
4. Setelah package yang dibutuhkan sudah terinstall maka aplikasi sudah siap digunakan.

Jika menemukan kendala dalam penginstalan silahkan kontak email **muh.dickyhidayat@gmail.com** untuk lebih detailnya.