<?php

session_start();

require_once 'vendor/autoload.php';



use App\Counter;
use App\Visitor;

$counter = new Counter();

if (!Visitor::isCounted()) {
    $counter->incrementCount();
}

echo "Unique visits: " . $counter->getCount();

?>