<?php
// config.php
// config.php
define('BASE_URL_', 'https://localhost/MPSI/Project-vinjhonterpal/');
define('BASE_URL_BOWER_COMPONENT', BASE_URL_ . 'assets/bower_components/');
define('BASE_URL_DIST', BASE_URL_ . 'assets/dist/');
define('BASE_URL_PLUGIN', BASE_URL_ . 'assets/plugins/');
define('BASE_URL_ADM', BASE_URL_ . 'admin/');
define('BASE_URL_PGW', BASE_URL_ . 'pegawai/');
define('BASE_URL_OWN', BASE_URL_ . 'owner/');
define('BASE_URL_IMG', BASE_URL_ . 'gambar/');
define('BASE_URL_IMG_USR', BASE_URL_IMG . 'user/');
define('BASE_URL_IMG_SYS', BASE_URL_IMG . 'sistem/');
define('BASE_URL_ADM_MENU', BASE_URL_ADM . 'menu_sidebar/');
define('BASE_URL_PGW_MENU', BASE_URL_PGW . 'menu_sidebar/');
define('BASE_URL_OWN_MENU', BASE_URL_OWN . 'menu_sidebar/');
function admin($url)
{
    header("Location: " . BASE_URL_ADM_MENU . $url);
    exit();
}
function pegawai($url)
{
    header("Location: " . BASE_URL_PGW_MENU . $url);
    exit();
}

function owner($url)
{
    header("Location: " . BASE_URL_OWN_MENU . $url);
    exit();
}
?>


