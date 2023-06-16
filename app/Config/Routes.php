<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Beranda::index');
$routes->group('/anggota', static function ($routes) {
    $routes->get('/', 'Anggota::index');
    $routes->get('(:num)', 'Anggota::detail/$1');
});

$routes->group('/kegiatan', static function ($routes) {
    $routes->get('/', 'Kegiatan::index');
    $routes->get('(:num)', 'Kegiatan::detail/$1');
});

$routes->group('/kerasulan', static function ($routes) {
    $routes->get('/', 'Kerasulan::index');
});

$routes->group('/pembinaan', static function ($routes) {
    $routes->get('/', 'Pembinaan::index');
});

$routes->get('/about', 'About::index');

$routes->group('/auth', static function ($routes) {
    $routes->get('/', 'Auth::index');
    $routes->post('login', 'Auth::login');
    $routes->get('logout', 'Auth::logout');
});

// kepala komunitas
$routes->group('/admin', ['filter' => 'authFilter'], static function ($routes) {
    $routes->group('beranda', static function ($routes) {
        $routes->get('/', 'Admin\Beranda::index');
        $routes->get('(:num)', 'Admin\Beranda::detail/$1');
    });

    $routes->group('arsip', static function ($routes) {
        $routes->get('/', 'Admin\Arsip::index');
        $routes->post('/', 'Admin\Arsip::save/$1');
        $routes->put('(:num)', 'Admin\Arsip::update/$1');
        $routes->delete('(:num)', 'Admin\Arsip::delete/$1');
    });

    $routes->group('kegiatan', static function ($routes) {
        $routes->get('/', 'Admin\Kegiatan::index');
        $routes->post('/', 'Admin\Kegiatan::save');
        $routes->get('edit/(:num)', 'Admin\Kegiatan::editPage/$1');
        $routes->put('edit/(:num)', 'Admin\Kegiatan::update/$1');
        $routes->delete('(:num)', 'Admin\Kegiatan::delete/$1');
    });

    $routes->group('galeri', static function ($routes) {
        $routes->get('(:num)', 'Admin\Kegiatan::galeriPage/$1');
        $routes->post('(:num)', 'Admin\Kegiatan::saveGaleri/$1');
        $routes->delete('(:any)', 'Admin\Kegiatan::deleteGaleri/$1');
    });

    $routes->group('anggota', static function ($routes) {
        $routes->group('penugasan', static function ($routes) {
            $routes->post('(:num)', 'Admin\Anggota::savePenugasan/$1');
            $routes->delete('(:num)', 'Admin\Anggota::deletePenugasan/$1');
        });

        $routes->group('pembinaan', static function ($routes) {
            $routes->post('(:num)', 'Admin\Anggota::savePembinaan/$1');
            $routes->delete('(:num)', 'Admin\Anggota::deletePembinaan/$1');
        });

        $routes->get('/', 'Admin\Anggota::index');
        $routes->post('/', 'Admin\Anggota::save');
        $routes->put('(:num)', 'Admin\Anggota::update/$1');
        $routes->delete('(:num)', 'Admin\Anggota::delete/$1');
        $routes->get('detail/(:num)', 'Admin\Anggota::detail/$1');

        $routes->group('belajar', static function ($routes) {
            $routes->get('(:num)', 'Admin\Anggota::student/$1');
            $routes->post('(:num)', 'Admin\Anggota::studentSave/$1');
            $routes->delete('(:num)', 'Admin\Anggota::studentDelete/$1');
        });

        $routes->group('profil', static function ($routes) {
            $routes->get('/', 'Admin\Anggota::profil');
            $routes->put('/', 'Admin\Anggota::updateProfil');
            $routes->put('image', 'Admin\Anggota::updateProfilImage');
        });
    });

    $routes->group('kerasulan', static function ($routes) {
        $routes->get('/', 'Admin\Kerasulan::index');
        $routes->post('/', 'Admin\Kerasulan::save');
        $routes->get('edit/(:num)', 'Admin\Kerasulan::edit/$1');
        $routes->put('edit/(:num)', 'Admin\Kerasulan::update/$1');
        $routes->delete('(:num)', 'Admin\Kerasulan::delete/$1');
    });

    $routes->group('surat', static function ($routes) {
        $routes->group('masuk', static function ($routes) {
            $routes->get('/', 'Admin\Surat::suratMasuk');
            $routes->post('/', 'Admin\Surat::suratMasukSave');
            $routes->get('edit/(:num)', 'Admin\Surat::suratMasukEdit/$1');
            $routes->put('edit/(:num)', 'Admin\Surat::suratMasukUpdate/$1');
            $routes->delete('(:num)', 'Admin\Surat::suratMasukDelete/$1');
        });

        $routes->group('keluar', static function ($routes) {
            $routes->get('/', 'Admin\Surat::suratKeluar');
            $routes->post('/', 'Admin\Surat::suratKeluarSave');
            $routes->get('edit/(:num)', 'Admin\Surat::suratKeluarEdit/$1');
            $routes->put('edit/(:num)', 'Admin\Surat::suratKeluarUpdate/$1');
            $routes->delete('(:num)', 'Admin\Surat::suratKeluarDelete/$1');
        });
    });

    $routes->group('laporan', static function ($routes) {
        $routes->get('/', 'Admin\Laporan::index');
        $routes->group('data', static function ($routes) {
            $routes->post('suster', 'Admin\Laporan::dataSuster');
            $routes->post('komunitas', 'Admin\Laporan::dataKomunitas');
            $routes->post('kegiatan', 'Admin\Laporan::dataKegiatan');
            // $routes->post('penunjang', 'Admin\Laporan::dataPenunjang');
        });
    });
});

// pimpinan
$routes->group('/sa', ['filter' => 'authFilter'], static function ($routes) {
    $routes->group('beranda', static function ($routes) {
        $routes->get('/', 'SuperAdmin\Beranda::index');
        $routes->get('(:num)', 'SuperAdmin\Beranda::detail/$1');
    });

    $routes->group('about', static function ($routes) {
        $routes->get('/', 'SuperAdmin\About::index');
        $routes->put('(:num)', 'SuperAdmin\About::update/$1');
    });

    $routes->group('arsip', static function ($routes) {
        $routes->get('/', 'SuperAdmin\Arsip::index');
        $routes->post('/', 'SuperAdmin\Arsip::save/$1');
        $routes->put('(:num)', 'SuperAdmin\Arsip::update/$1');
        $routes->delete('(:num)', 'SuperAdmin\Arsip::delete/$1');
    });

    $routes->group('anggota', static function ($routes) {
        $routes->group('penugasan', static function ($routes) {
            $routes->post('(:num)', 'SuperAdmin\Anggota::savePenugasan/$1');
            $routes->put('(:num)', 'SuperAdmin\Anggota::updatePenugasan/$1');
            $routes->delete('(:num)', 'SuperAdmin\Anggota::deletePenugasan/$1');
        });

        $routes->group('pembinaan', static function ($routes) {
            $routes->post('(:num)', 'SuperAdmin\Anggota::savePembinaan/$1');
            $routes->put('(:num)', 'SuperAdmin\Anggota::updatePembinaan/$1');
            $routes->delete('(:num)', 'SuperAdmin\Anggota::deletePembinaan/$1');
        });

        $routes->get('/', 'SuperAdmin\Anggota::index');
        $routes->post('/', 'SuperAdmin\Anggota::save');
        $routes->put('(:num)', 'SuperAdmin\Anggota::update/$1');
        $routes->delete('(:num)', 'SuperAdmin\Anggota::delete/$1');
        $routes->get('detail/(:num)', 'SuperAdmin\Anggota::detail/$1');

        $routes->group('belajar', static function ($routes) {
            $routes->get('(:num)', 'SuperAdmin\Anggota::student/$1');
            $routes->post('(:num)', 'SuperAdmin\Anggota::studentSave/$1');
            $routes->delete('(:num)', 'SuperAdmin\Anggota::studentDelete/$1');
        });

        $routes->group('profil', static function ($routes) {
            $routes->get('/', 'SuperAdmin\Anggota::profil');
            $routes->put('/', 'SuperAdmin\Anggota::updateProfil');
            $routes->put('image', 'SuperAdmin\Anggota::updateProfilImage');
        });
    });

    $routes->group('kegiatan', static function ($routes) {
        $routes->get('/', 'SuperAdmin\Kegiatan::index');
        $routes->post('/', 'SuperAdmin\Kegiatan::save');
        $routes->get('edit/(:num)', 'SuperAdmin\Kegiatan::editPage/$1');
        $routes->put('edit/(:num)', 'SuperAdmin\Kegiatan::update/$1');
        $routes->delete('(:num)', 'SuperAdmin\Kegiatan::delete/$1');
    });

    $routes->group('galeri', static function ($routes) {
        $routes->get('(:num)', 'SuperAdmin\Kegiatan::galeriPage/$1');
        $routes->post('(:num)', 'SuperAdmin\Kegiatan::saveGaleri/$1');
        $routes->delete('(:any)', 'SuperAdmin\Kegiatan::deleteGaleri/$1');
    });

    $routes->group('komunitas', static function ($routes) {
        $routes->get('/', 'SuperAdmin\Komunitas::index');
        $routes->post('/', 'SuperAdmin\Komunitas::save');
        $routes->get('edit/(:num)', 'SuperAdmin\Komunitas::editPage/$1');
        $routes->put('edit/(:num)', 'SuperAdmin\Komunitas::update/$1');
        $routes->delete('(:num)', 'SuperAdmin\Komunitas::delete/$1');
    });

    $routes->group('jenisKerasulan', static function ($routes) {
        $routes->get('/', 'SuperAdmin\JenisKerasulan::index');
        $routes->get('edit/(:num)', 'SuperAdmin\JenisKerasulan::editPage/$1');
        $routes->put('edit/(:num)', 'SuperAdmin\JenisKerasulan::update/$1');
    });

    $routes->group('tahapPembinaan', static function ($routes) {
        $routes->get('/', 'SuperAdmin\TahapPembinaan::index');
        $routes->get('edit/(:num)', 'SuperAdmin\TahapPembinaan::editPage/$1');
        $routes->put('edit/(:num)', 'SuperAdmin\TahapPembinaan::update/$1');
    });

    $routes->group('kerasulan', static function ($routes) {
        $routes->get('/', 'SuperAdmin\Kerasulan::index');
        $routes->post('/', 'SuperAdmin\Kerasulan::save');
        $routes->get('edit/(:num)', 'SuperAdmin\Kerasulan::edit/$1');
        $routes->put('edit/(:num)', 'SuperAdmin\Kerasulan::update/$1');
        $routes->delete('(:num)', 'SuperAdmin\Kerasulan::delete/$1');
    });

    $routes->group('provinsi', static function ($routes) {
        $routes->get('/', 'SuperAdmin\Provinsi::index');
        $routes->post('/', 'SuperAdmin\Provinsi::save');
        $routes->get('edit/(:num)', 'SuperAdmin\Provinsi::edit/$1');
        $routes->put('edit/(:num)', 'SuperAdmin\Provinsi::update/$1');
        $routes->delete('(:num)', 'SuperAdmin\Provinsi::delete/$1');
    });

    $routes->group('laporan', static function ($routes) {
        $routes->get('/', 'SuperAdmin\Laporan::index');
        $routes->group('data', static function ($routes) {
            $routes->post('suster', 'SuperAdmin\Laporan::dataSuster');
            $routes->post('komunitas', 'SuperAdmin\Laporan::dataKomunitas');
            $routes->post('belajar', 'SuperAdmin\Laporan::dataHasilBelajar');
            $routes->post('penunjang', 'SuperAdmin\Laporan::dataPenunjang');
        });
    });
});

// group anggota

$routes->group('user', ['filter' => 'authFilter'], static function ($routes) {
    $routes->group('beranda', static function ($routes) {
        $routes->get('/', 'User\Beranda::index');
        $routes->get('(:num)', 'User\Beranda::detail/$1');
    });

    $routes->group('kegiatan', static function ($routes) {
        $routes->get('/', 'User\Kegiatan::index');
        $routes->post('/', 'User\Kegiatan::save');
        $routes->get('edit/(:num)', 'User\Kegiatan::editPage/$1');
        $routes->put('edit/(:num)', 'User\Kegiatan::update/$1');
        $routes->delete('(:num)', 'User\Kegiatan::delete/$1');
    });
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
