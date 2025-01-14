<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/perpus', 'Home::perpus');
$routes->get('/logout', 'Home::logout');


$routes->get('/administrator/login', 'Administrator::login');
$routes->post('/administrator/logon', 'Administrator::logon');
$routes->get('/administrator/registerpage', 'Administrator::register_page');
$routes->post('/administrator/register', 'Administrator::register');



$routes->get('/peminjam/login', 'Peminjam::login');
$routes->post('/peminjam/logon', 'Peminjam::logon');
$routes->get('/peminjam/registerpage', 'Peminjam::register_page');
$routes->post('/peminjam/register', 'Peminjam::register');



$routes->get('/petugas/login', 'Petugas::login');
$routes->get('/petugas/login', 'Petugas::login');
$routes->post('/petugas/logon', 'Petugas::logon');
$routes->get('/petugas/registerpage', 'Petugas::register_page');
$routes->post('/petugas/register', 'Petugas::register');



$routes->get('/buku/data', 'Buku::data');
$routes->get('/buku/addpage', 'Buku::addpage');
$routes->get('/buku/editpage/(:num)', 'Buku::editpage/$1');
$routes->get('/buku/kategori', 'Buku::kategori');
$routes->get('/buku/addkategoripage', 'Buku::addkategoripage');
$routes->post('/buku/addkategori', 'Buku::addkategori');
$routes->post('/buku/edit', 'Buku::edit');
$routes->post('/buku/add', 'Buku::add');
$routes->post('/buku/delete', 'Buku::delete');



$routes->get('/peminjaman/meminjam/(:num)', 'Peminjaman::meminjam/$1');
$routes->get('/peminjaman/detail', 'Peminjaman::detail');
$routes->post('/peminjaman/minjam', 'Peminjaman::minjam');
$routes->post('/peminjaman/konfirmasi', 'Peminjaman::konfirmasi');
$routes->post('/peminjaman/delete', 'Peminjaman::delete');
$routes->post('/peminjaman/addkoleksi', 'Peminjaman::addkoleksi');
$routes->get('/peminjaman/koleksi', 'Peminjaman::koleksi');
$routes->post('/peminjaman/deletekoleksi', 'Peminjaman::deletekoleksi');


$routes->get('/masukan/(:num)', 'Ulasan::ulasan/$1');
$routes->post('/masukan/add', 'Ulasan::add');