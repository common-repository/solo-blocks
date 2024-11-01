<?php

defined('ABSPATH') or exit;

use \SoloBlocks\CSS_Vars;
use \SoloBlocks\Rest;
use \SoloBlocks\Fonts;
use \SoloBlocks\Icons;
use \SoloBlocks\Blocks;
use \SoloBlocks\Placeholder;

Blocks::instance();
CSS_Vars::instance();
Rest::instance();
Fonts::instance();
Icons::instance();
Placeholder::instance();

require_once __DIR__.'/support/init.php';


add_filter('upload_mimes', function($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
});