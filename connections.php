<?php
ini_set('display_errors', 1);

define('ABSPATH', __DIR__);
define('API_PATH', ABSPATH.'/api');
define('API_PRICE_PATH', API_PATH.'/price');

require_once API_PATH . '/fruit_lists.php';
require_once API_PATH . '/veggie_lists.php';
require_once API_PRICE_PATH . '/requireCost.php';

