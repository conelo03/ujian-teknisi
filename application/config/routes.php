<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//login
$route['default_controller'] = 'Login';
$route['login.html'] = 'Login/login';


//admin
$route['admin/dashboard.html'] = 'Admin/Dashboard';
$route['admin/data-pengguna.html'] = 'Admin/Data_user';

//admin-data soal
$route['admin/soal-pilihan-ganda.html'] = 'Admin/Bank_soal/soal_pg';
$route['admin/soal-essai.html'] = 'Admin/Bank_soal/soal_essai';
$route['admin/materi-ujian-praktek.html'] = 'Admin/Bank_soal/materi_uprak';
$route['admin/kategori-soal.html'] = 'Admin/Bank_soal/kategori_soal';

//admin-data ujian
$route['admin/data-ujian.html'] = 'Admin/Data_ujian/ujian';

//admin-data nilai
$route['admin/data-hasil-ujian-pg.html'] = 'Admin/Data_nilai/hasil_ujian_pg';
$route['admin/data-hasil-ujian-essai.html'] = 'Admin/Data_nilai/hasil_ujian_essai';
$route['admin/data-hasil-ujian-praktek.html'] = 'Admin/Data_nilai/hasil_ujian_praktek';
$route['admin/(.+)/(.+)/data-akumulasi-ujian-pg.html'] = 'Admin/Data_nilai/nilai_pg/$1/$2';
$route['admin/(.+)/(.+)/data-akumulasi-ujian-essai.html'] = 'Admin/Data_nilai/nilai_essai/$1/$2';
$route['admin/(.+)/(.+)/data-akumulasi-ujian-praktek.html'] = 'Admin/Data_nilai/nilai_uprak/$1/$2';
$route['admin/nilai-akumulasi.html'] = 'Admin/Data_nilai/nilai_akumulasi';
$route['admin/(.+)/(.+)/data-akumulasi-ujian.html'] = 'Admin/Data_nilai/nilai_akumulasi_ujian/$1/$2';

//admin-data indikator
$route['admin/indikator-jabatan.html'] = 'Admin/Data_indikator/indikator';

//teknisi
$route['teknisi/dashboard.html'] = 'Teknisi/Dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
