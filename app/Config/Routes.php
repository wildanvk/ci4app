<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::index');
$routes->post('/auth', 'Auth::auth');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');

$routes->group('gudang', ['filter' => 'RoleFilter:Gudang,Superadmin'], function ($routes) {
    $routes->get('supplier', 'Supplier::index');
    $routes->get('barangmentah', 'Barangmentah::index');
    $routes->get('barangjadi', 'Barangjadi::index');
    $routes->get('stokbarangmentah', 'Stokbarangmentah::index');
    $routes->get('stokbarangjadi', 'Stokbarangjadi::index');
    $routes->get('barangmasukmentah', 'Barangmasukmentah::index');
    $routes->get('barangkeluarjadi', 'Barangkeluarjadi::index');
    $routes->get('laporan/barangmasuk', 'Laporan::barangmasuk');
    $routes->post('laporan/barangmasuk/cetak', 'Laporan::cetakLaporanBarangMasuk');
    $routes->get('laporan/barangkeluar', 'Laporan::barangkeluar');
    $routes->post('laporan/barangkeluar/cetak', 'Laporan::cetakLaporanBarangKeluar');
});

$routes->group('produksi', ['filter' => 'RoleFilter:Produksi,Superadmin'], function ($routes) {
    $routes->get('datakaryawan', 'Datakaryawan::index');
    $routes->get('datakaryawan/input', 'Datakaryawan::input');
    $routes->post('datakaryawan/store', 'Datakaryawan::store');
    $routes->get('datakaryawan/edit/(:any)', 'Datakaryawan::edit/$1');
    $routes->post('datakaryawan/update', 'Datakaryawan::update');
    $routes->get('datakaryawan/delete/(:any)', 'Datakaryawan::delete/$1');
    $routes->get('divisi', 'Divisi::index');
    $routes->get('divisi/input', 'Divisi::input');
    $routes->post('divisi/store', 'Divisi::store');
    $routes->get('divisi/edit/(:any)', 'Divisi::edit/$1');
    $routes->post('divisi/update', 'Divisi::update');
    $routes->get('divisi/delete/(:any)', 'Divisi::delete/$1');
    $routes->get('permintaanproduksi', 'PermintaanProduksi::index');
    $routes->get('permintaanproduksi/input', 'PermintaanProduksi::input');
    $routes->post('permintaanproduksi/store', 'PermintaanProduksi::store');
    $routes->get('permintaanproduksi/edit/(:any)', 'PermintaanProduksi::edit/$1');
    $routes->post('permintaanproduksi/update', 'PermintaanProduksi::update');
    $routes->get('permintaanproduksi/delete/(:any)', 'PermintaanProduksi::delete/$1');
    $routes->get('progresproduksi', 'ProgresProduksi::index');
    $routes->get('progresproduksi/input', 'ProgresProduksi::input');
    $routes->post('progresproduksi/store', 'ProgresProduksi::store');
    $routes->get('progresproduksi/edit/(:any)', 'ProgresProduksi::edit/$1');
    $routes->post('progresproduksi/update', 'ProgresProduksi::update');
    $routes->get('progresproduksi/delete/(:any)', 'ProgresProduksi::delete/$1');
    $routes->get('riwayatproduksi', 'Laporan::riwayatProduksi');
    $routes->post('riwayatproduksi/cetak', 'Laporan::cetakLaporanRiwayatProduksi');
});

$routes->group('penggajian', ['filter' => 'RoleFilter:Penggajian,Superadmin'], function ($routes) {
    $routes->get('datakaryawan', 'Datakaryawan::index');
    $routes->get('datakaryawan/input', 'Datakaryawan::input');
    $routes->post('datakaryawan/store', 'Datakaryawan::store');
    $routes->get('datakaryawan/edit/(:any)', 'Datakaryawan::edit/$1');
    $routes->post('datakaryawan/update', 'Datakaryawan::update');
    $routes->get('datakaryawan/delete/(:any)', 'Datakaryawan::delete/$1');
    $routes->get('penggajian', 'Penggajian::index');
    $routes->get('penggajian/input', 'Penggajian::input');
    $routes->post('penggajian/store', 'Penggajian::store');
    $routes->get('penggajian/edit/(:any)', 'Penggajian::edit/$1');
    $routes->post('penggajian/update', 'Penggajian::update');
    $routes->get('penggajian/delete/(:any)', 'Penggajian::delete/$1');
    $routes->get('laporan', 'Laporan::penggajian');
    $routes->post('laporan/detail', 'Laporan::detailLaporanPenggajian');
    $routes->post('laporan/cetak', 'Laporan::cetakLaporanPenggajian');
});

$routes->group('penjualan', ['filter' => 'RoleFilter:Penjualan,Superadmin'], function ($routes) {
    $routes->get('pengiriman', 'Pengiriman::index');
    $routes->get('pengiriman/input', 'Pengiriman::input');
    $routes->post('pengiriman/store', 'Pengiriman::store');
    $routes->get('pengiriman/edit/(:any)', 'Pengiriman::edit/$1');
    $routes->post('pengiriman/update', 'Pengiriman::update');
    $routes->get('pengiriman/delete/(:any)', 'Pengiriman::delete/$1');
    $routes->get('transaksi', 'Transaksi::index');
    $routes->get('transaksi/input', 'Transaksi::input');
    $routes->post('transaksi/store', 'Transaksi::store');
    $routes->get('transaksi/edit/(:any)', 'Transaksi::edit/$1');
    $routes->post('transaksi/update', 'Transaksi::update');
    $routes->get('transaksi/delete/(:any)', 'Transaksi::delete/$1');
    $routes->get('request', 'Request::index');
    $routes->get('request/input', 'Request::input');
    $routes->post('request/store', 'Request::store');
    $routes->get('request/edit/(:any)', 'Request::edit/$1');
    $routes->post('request/update', 'Request::update');
    $routes->get('request/delete/(:any)', 'Request::delete/$1');
    $routes->get('laporan', 'Laporan::pengiriman');
    $routes->post('laporan/cetak', 'Laporan::cetakLaporanPengiriman');
});

$routes->group('api/gudang', ['filter' => 'RoleFilter:Gudang,Superadmin'], function ($routes) {
    // Dashboard
    $routes->get('dashboard/charttransaksi', 'Dashboard::chartTransaksi');
    $routes->get('dashboard/chartbarang', 'Dashboard::chartBarang');
    $routes->get('dashboard/chartpengeluaran', 'Dashboard::chartPengeluaran');
    $routes->get('dashboard/chartstok', 'Dashboard::chartStok');
    // Supplier
    $routes->get('supplier/getalldata', 'SupplierAPI::getAllData');
    $routes->get('supplier/getnewidsupplier', 'SupplierAPI::getNewIdSupplier');
    $routes->post('supplier/inputdata', 'SupplierAPI::inputData');
    $routes->put('supplier/updatedata', 'SupplierAPI::updateData');
    $routes->delete('supplier/deletedata', 'SupplierAPI::deleteData');
    // Barang Mentah
    $routes->get('barangmentah/getalldata', 'BarangmentahAPI::getAllData');
    $routes->get('barangmentah/getnewidbarangmentah', 'BarangmentahAPI::getNewIdBarangMentah');
    $routes->post('barangmentah/inputdata', 'BarangmentahAPI::inputData');
    $routes->put('barangmentah/updatedata', 'BarangmentahAPI::updateData');
    $routes->delete('barangmentah/deletedata', 'BarangmentahAPI::deleteData');
    // Barang Jadi
    $routes->get('barangjadi/getalldata', 'BarangjadiAPI::getAllData');
    $routes->get('barangjadi/getnewidbarangjadi', 'BarangjadiAPI::getNewIdBarangJadi');
    $routes->post('barangjadi/inputdata', 'BarangjadiAPI::inputData');
    $routes->put('barangjadi/updatedata', 'BarangjadiAPI::updateData');
    $routes->delete('barangjadi/deletedata', 'BarangjadiAPI::deleteData');
    // Stok Barang Mentah
    $routes->get('stokbarangmentah/getalldata', 'StokbarangmentahAPI::getAllData');
    $routes->get('stokbarangmentah/getavailablebarangmentah', 'StokbarangmentahAPI::getAvailableBarangMentah');
    $routes->get('stokbarangmentah/getnewidstokbarangmentah', 'StokbarangmentahAPI::getNewIdStokBarangMentah');
    $routes->post('stokbarangmentah/inputdata', 'StokbarangmentahAPI::inputData');
    $routes->put('stokbarangmentah/updatedata', 'StokbarangmentahAPI::updateData');
    $routes->delete('stokbarangmentah/deletedata', 'StokbarangmentahAPI::deleteData');
    // Stok Barang Jadi
    $routes->get('stokbarangjadi/getalldata', 'StokbarangjadiAPI::getAllData');
    $routes->get('stokbarangjadi/getavailablebarangjadi', 'StokbarangjadiAPI::getAvailableBarangJadi');
    $routes->get('stokbarangjadi/getnewidstokbarangjadi', 'StokbarangjadiAPI::getNewIdStokBarangJadi');
    $routes->post('stokbarangjadi/inputdata', 'StokbarangjadiAPI::inputData');
    $routes->put('stokbarangjadi/updatedata', 'StokbarangjadiAPI::updateData');
    $routes->delete('stokbarangjadi/deletedata', 'StokbarangjadiAPI::deleteData');
    // Barang Masuk Mentah
    $routes->get('barangmasukmentah/getalldata', 'BarangmasukmentahAPI::getAllData');
    $routes->get('barangmasukmentah/getdatabydate', 'BarangmasukmentahAPI::getDataByDate');
    $routes->get('barangmasukmentah/getnewidtransaksi', 'BarangmasukmentahAPI::getNewIdTransaksi');
    $routes->post('barangmasukmentah/inputdata', 'BarangmasukmentahAPI::inputData');
    $routes->put('barangmasukmentah/updatedata', 'BarangmasukmentahAPI::updateData');
    $routes->delete('barangmasukmentah/deletedata', 'BarangmasukmentahAPI::deleteData');
    // Barang Keluar Jadi
    $routes->get('barangkeluarjadi/getalldata', 'BarangkeluarjadiAPI::getAllData');
    $routes->get('barangkeluarjadi/getdatabydate', 'BarangkeluarjadiAPI::getDataByDate');
    $routes->get('barangkeluarjadi/getnewidtransaksi', 'BarangkeluarjadiAPI::getNewIdTransaksi');
    $routes->post('barangkeluarjadi/inputdata', 'BarangkeluarjadiAPI::inputData');
    $routes->put('barangkeluarjadi/updatedata', 'BarangkeluarjadiAPI::updateData');
    $routes->delete('barangkeluarjadi/deletedata', 'BarangkeluarjadiAPI::deleteData');
});

$routes->group('api/produksi', ['filter' => 'RoleFilter:Produksi,Superadmin'], function ($routes) {
    $routes->get('riwayatproduksi/getalldata', 'RiwayatProduksiAPI::getAllData');
    $routes->get('riwayatproduksi/getdatabydate', 'RiwayatProduksiAPI::getDataByDate');
});

$routes->group('api/penggajian', ['filter' => 'RoleFilter:Penggajian,Superadmin'], function ($routes) {
    $routes->get('penggajian/getalldata', 'PenggajianAPI::getAllData');
    $routes->get('penggajian/getdatabydate', 'PenggajianAPI::getDataByDate');
});

$routes->group('api/penjualan', ['filter' => 'RoleFilter:Penjualan,Superadmin'], function ($routes) {
    $routes->get('pengiriman/getalldata', 'PengirimanAPI::getAllData');
    $routes->get('pengiriman/getdatabydate', 'PengirimanAPI::getDataByDate');
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
