<?php
namespace Service_Management;

use Service_Management\Classes\{
    Misc,
    File_Cleanup
};
use Service_Management\Classes\Helpers\{
    Assets, 
    DB_Init
};

/*
 * Plugin Name:       Service Management
 * Plugin URI:        mailto:team.masswork@gmail.com
 * Description:       A handy plugin for managing to your service based business.
 * Version:           1.0.0
 * Author:            MassWork Creations
 * Author URI:        mailto:team.masswork@gmail.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       service-management
 * Domain Path:       /languages
 */

// Loading site's autoloader
require 'autoloader.php';

// Loading DOMPDF's library
require 'vendor/autoload.php';

// Loading Admin Menu
$menu_page = new Misc();

//Activating default DB tables and data on activation.
$create_new_db = new DB_Init(__FILE__);
$create_new_db->init();

// Loading Assets
$assets = new Assets(__FILE__);
$assets->init();

// File Cleanup
$file_cleanup = new File_Cleanup(__FILE__);
$file_cleanup->init();