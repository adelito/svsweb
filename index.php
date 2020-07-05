<?php

//phpinfo();
require 'core' . DIRECTORY_SEPARATOR . 'Autoload.php';
use config\SystemConfig;
header('Location:' . SystemConfig::SYSTEM_ROOT . '/login');
?>