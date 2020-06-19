<?php

namespace NimiqCommunity\RpcClient\Models;

class VestingContract extends Account
{
    /**
     * @var string hex-encoded 20 byte address of the owner
     */
    public $owner;

    /**
     * @var string user friendly address (NQ-address) of the owner
     */
    public $ownerAddress;

    /**
     * @var float block number when vesting begins
     */
    public $vestingStart;

    /**
     * @var float number of blocks between each vesting step
     */
    public $vestingStepBlocks;

    /**
     * @var float amount of nim (in smallest unit) released for every step
     */
    public $vestingStepAmount;

    /**
     * @var float total amount (in smallest unit) to be vested
     */
    public $vestingTotalAmount;
}
