<?php
include __DIR__ . '/../config/db.php';
require __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../config/function.php';

use Hotel\ActiveRecord;
$db=conectarDB();
ActiveRecord::setDB($db);
