<?php

namespace NimiqCommunity\RpcClient;

if (!function_exists('toNim')) {
    /**
     * Converts from luna to nim.
     *
     * @param int $luna the value in luna (smallest unit)
     *
     * @return float the value in nim (max 5 decimals)
     */
    function toNim($luna)
    {
        return round($luna / 100000, 5);
    }
}

if (!function_exists('toLuna')) {
    /**
     * Converts from nim to luna.
     *
     * @param float $nim the value in nim
     *
     * @return int the value in luna (smallest unit)
     */
    function toLuna($nim)
    {
        return round($nim * 100000, 0);
    }
}
