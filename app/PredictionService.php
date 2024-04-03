<?php

namespace App;

use App\Repository\GoodLoaderServiceInterface;
use App\Strategy\OrderIntervalStrategy;

class PredictionService
{
    public function __construct()
    {
    }

    /**
     * @param array $orders
     * assumption that array of orders is sorted by date
     * @param GoodLoaderServiceInterface $goodLoader
     * @param OrderIntervalStrategy $orderInterval
     *
     * @return array
     * @throws \Exception
     */
    public function predictNextOrder(
        array $orders,
        GoodLoaderServiceInterface $goodLoader,
        OrderIntervalStrategy $orderInterval
    ): array
    {
        $predictions = [];
        $lastOrderGoods = [];
        $orderIntervals = [];   // array of intervals between orders in days for one amount of good

        foreach ($orders as $date=>$order) {
            $curOrderGoods = [];
            foreach ($order as $orderItem) {
                $gid = $orderItem[0];
                $count = $orderItem[1] + ((isset($curOrderGoods[$gid])) ? $curOrderGoods[$gid]['count'] : 0);
                $description = ((isset($curOrderGoods[$gid])) ? $curOrderGoods[$gid]['description'].', ' : '') . sprintf("%dx%s",$orderItem[1],$orderItem[2]);

                $curOrderGoods[$gid] = [
                    'date' => $date,
                    'count' => $count,
                    'description' => $description
                ];
            }

            foreach ($curOrderGoods as $gid=>$orderItem) {
                if (isset($lastOrderGoods[$gid])) {
                    $lastOrderDate = new \DateTime($lastOrderGoods[$gid]['date']);
                    $curOrderDate = new \DateTime($orderItem['date']);
                    $interval = $lastOrderDate->diff($curOrderDate);
                    $orderIntervals[$gid][] = floor($interval->days/$lastOrderGoods[$gid]['count']);
                }
                $lastOrderGoods[$gid] = $orderItem;
            }
        }

        foreach ($lastOrderGoods as $gid=>$orderItem) {
            if (isset($orderIntervals[$gid])) {
                $days = $orderInterval->getInterval($orderIntervals[$gid]);
            } else {
                $days = $goodLoader->getGoodById($gid)->getDuration();
            }

            $days = $days * $orderItem['count'];
            $date = new \DateTime($orderItem['date']);
            $date->add(new \DateInterval('P' . $days . 'D'));

            $predictions[] = [
                'gid' => $gid,
                'date' => $date->format('Y-m-d'),
                'description' => $orderItem['description']
            ];
        }

        return $predictions;
    }
}