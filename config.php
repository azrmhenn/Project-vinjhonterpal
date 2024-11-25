<?php
// config.php
define('BASE_URL_', 'http://localhost/MPSI/Project-vinjhonterpal/');
define('BASE_URL_BOWER_COMPONENT', BASE_URL_ . 'assets/bower_components/');
define('BASE_URL_DIST', BASE_URL_ . 'assets/dist/');
define('BASE_URL_PLUGIN', BASE_URL_ . 'assets/plugins/');
define('BASE_URL_ADM', value: BASE_URL_ . 'admin/');
define('BASE_URL_PGW', value: BASE_URL_ . 'pegawai/');
define('BASE_URL_OWN', value: BASE_URL_ . 'owner/');
define('BASE_URL_IMG', value: BASE_URL_ . 'gambar/');
define('BASE_URL_IMG_USR', value: BASE_URL_IMG . 'user/');
define('BASE_URL_IMG_SYS', value: BASE_URL_IMG . 'sistem/');
define('BASE_URL_ADM_MENU', value: BASE_URL_ADM . 'menu_sidebar/');
define('BASE_URL_PGW_MENU', value: BASE_URL_PGW . 'menu_sidebar/');
define('BASE_URL_OWN_MENU', value: BASE_URL_OWN . 'menu_sidebar/');
function redirect($url)
{
    header("Location: " . BASE_URL . $url);
    exit();
}
?>
