<?php
/**
 * Configuration overrides for WP_ENV === 'production'
 */

use Roots\WPConfig\Config;
// Enable plugin and theme updates and installation from the admin
Config::define('DISALLOW_FILE_MODS', true);

ini_set('memory_limit', '256M');

