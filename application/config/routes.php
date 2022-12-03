<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "halaman_depan";
$route['404_override'] = '';
$route['auth']	= 'halaman_depan/auth';
$route['petunjuk'] =  'halaman_depan/petunjuk';
$route['tentang'] = 'halaman_depan/tentang';

$route['administrasi/dashboard']	= 'administrasi';
$route['administrasi/logout']	= 'administrasi/logout';

$route['administrasi/data_kebun']	= 'administrasi/data_kebun_view';
$route['administrasi/data_kebun/add'] = 'administrasi/data_kebun_add';
$route['administrasi/data_kebun/save'] = 'administrasi/data_kebun_save';
$route['administrasi/data_kebun/edit/(:num)'] = 'administrasi/data_kebun_edit/$1';
$route['administrasi/data_kebun/del/(:num)'] = 'administrasi/data_kebun_del/$1';

$route['administrasi/data_hasilpanen']	= 'administrasi/data_hasilpanen_view';
$route['administrasi/data_hasilpanen/add'] = 'administrasi/data_hasilpanen_add';
$route['administrasi/data_hasilpanen/save'] = 'administrasi/data_hasilpanen_save';
$route['administrasi/data_hasilpanen/edit/(:num)'] = 'administrasi/data_hasilpanen_edit/$1';
$route['administrasi/data_hasilpanen/del/(:num)'] = 'administrasi/data_hasilpanen_del/$1';

$route['pimpinan/dashboard']	= 'pimpinan';
$route['pimpinan/logout']	= 'pimpinan/logout';

$route['pimpinan/cetak_kebun']	= 'pimpinan/cetak_kebun';
$route['pimpinan/cetak_kebun/view']	= 'pimpinan/cetak_kebun_view';
$route['pimpinan/cetak_hasilpanen']	= 'pimpinan/cetak_hasilpanen';
$route['pimpinan/cetak_hasilpanen/view']	= 'pimpinan/cetak_hasilpanen_view';

$route['supplier/dashboard']	= 'supplier';
$route['supplier/generate_awal']	= 'supplier/generate_awal';
$route['supplier/generate_rata']	= 'supplier/generate_rata';
$route['supplier/generate_centroid']	= 'supplier/generate_centroid';
$route['supplier/iterasi_kmeans']	= 'supplier/iterasi_kmeans';
$route['supplier/iterasi_kmeans_lanjut']	= 'supplier/iterasi_kmeans_lanjut';
$route['supplier/iterasi_kmeans_hasil']	= 'supplier/iterasi_kmeans_hasil';

$route['supplier/logout']	= 'supplier/logout';


/* End of file routes.php */
/* Location: ./application/config/routes.php */