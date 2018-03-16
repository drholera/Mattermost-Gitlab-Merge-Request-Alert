<?php

// Only cli allowed.
if (php_sapi_name() !== 'cli') {
  exit;
}

require_once __DIR__.'/vendor/autoload.php';

use MGBot\Config\Config;
use MGBot\Mattermost\MergeChecker;

$config = Config::getMattermostConfig();

$checker = new MergeChecker();

echo $checker->getMergeRequestsCount();

echo $config;
