@echo off

REM Tentukan path ke direktori CodeIgniter 4
set codeigniter_path="C:\xampp\htdocs\si-biara"

REM Masuk ke direktori CodeIgniter 4
cd %codeigniter_path%

REM Jalankan server PHP built-in dengan mengatur folder proyek menjadi "si-biara"
php spark serve --folder=si-biara