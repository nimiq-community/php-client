<?php

namespace Lunanimous\Rpc\Models;

class HashedTimeLockedContract extends Account
{
    /**
     * @var string hex-encoded 20 byte address of the sender
     */
    public $sender;

    /**
     * @var string user friendly address (NQ-address) of the sender
     */
    public $senderAddress;

    /**
     * @var string hex-encoded 20 byte address of the recipient
     */
    public $recipient;

    /**
     * @var string user friendly address (NQ-address) of the recipient
     */
    public $recipientAddress;

    /**
     * @var string hex-encoded 32 byte hash of pre-image
     */
    public $hashRoot;

    /**
     * @var int algorithm used to hash the proof, 1 (Blake2b) or 3 (SHA256)
     */
    public $hashAlgorithm;

    /**
     * @var int number of times the proof has been hashed
     */
    public $hashCount;

    /**
     * @var int block number after which the contract expires and funds can only be retrieved by sender
     */
    public $timeout;

    /**
     * @var float total amount (in smallest unit) locked in contract
     */
    public $totalAmount;
}
