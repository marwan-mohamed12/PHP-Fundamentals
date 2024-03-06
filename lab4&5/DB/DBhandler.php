<?php

use Illuminate\Database\Capsule\Manager as DbConnection;

$dbConnector = new DbConnection();
try {
    $dbConnector->addConnection([
        "driver" => __DRIVER__,
        "host" => __HOST__,
        "database" => __DATABASE__,
        "username" => __USERNAME__,
        "password" => __PASSWORD__
    ]);
    $dbConnector->setAsGlobal();
    $dbConnector->bootEloquent();
    return true;
} catch (\Exception $err) {
    echo "Error(in connect): " . $err->getMessage();
    return false;
}



