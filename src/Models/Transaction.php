<?php

namespace NimiqCommunity\RpcClient\Models;

use NimiqCommunity\RpcClient\Constants\AccountType;

class Transaction extends Model
{
    /**
     * @var string hex-encoded hash of the transaction
     */
    public $hash;

    /**
     * @var null|string hex-encoded hash of the block containing the transaction
     */
    public $blockHash;

    /**
     * @var null|int height of the block containing the transaction
     */
    public $blockNumber;

    /**
     * @var null|int UNIX timestamp of the block containing the transaction
     */
    public $timestamp;

    /**
     * @var null|int number of confirmations of the block containing the transaction
     */
    public $confirmations;

    /**
     * @var null|int index of the transaction in the block (null when getting transaction from hash)
     */
    public $transactionIndex;

    /**
     * @var string address the transaction is sent from
     */
    public $from;

    /**
     * @var string user friendly address the transaction is sent from
     */
    public $fromAddress;

    /**
     * @var string address the transaction is directed to
     */
    public $to;

    /**
     * @var string use friendly address the transaction is directed to
     */
    public $toAddress;

    /**
     * @var int value (in smallest unit) sent with this transaction
     */
    public $value;

    /**
     * @var int fee (in smallest unit) for this transaction
     */
    public $fee;

    /**
     * @var null|string hex-encoded contract parameters or a message
     */
    public $data;

    /**
     * @var int flags for this transaction, 0 (basic transaction) or 1 (contract creation)
     */
    public $flags;
}
