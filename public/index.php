<?php
require '../vendor/autoload.php';

use App\PredictionService;
use App\Repository\GoodLoaderFromArray;
use App\Strategy\MinOrderInterval;
use App\Strategy\MaxOrderInterval;
use App\Strategy\AvgOrderInterval;

/*$orders = [
    '2015-04-01' => [
        [1, 2, '-2.00'],
        [1, 2, '-3.00'],
    ],
];*/

$orders = [
    '2014-10-01' => [
        [3, 2, '-1.50'],
        [3, 2, '-3.50'],
        //[2, 1, '+0.50'],  // in one order could be more than one good
    ],
    '2015-01-01' => [
        [3, 2, '-1.50'],
        [3, 2, '-3.50'],
    ],
    '2015-04-15' => [
        [3, 1, '-1.50'],
        [3, 1, '-3.50'],
    ],
];

/*$orders = [
    '2014-08-01' => [
        [2, 2, '+0.50'],
    ],
];*/

try {
    $predictions = (new PredictionService())->predictNextOrder(
        $orders,
        new GoodLoaderFromArray,
        new MinOrderInterval    // MinOrderInterval - min days between orders, MaxOrderInterval - max days between orders, AvgOrderInterval - avg days between orders
    );

    print_r('$predictions<pre>');
    print_r($predictions);
    print_r('</pre>');

} catch (\Exception $e) {
    echo $e->getMessage();
}
