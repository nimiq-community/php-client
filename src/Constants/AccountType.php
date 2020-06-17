<?php

namespace NimiqCommunity\RpcClient\Constants;

class AccountType
{
    /**
     * @var int basic account
     */
    const Basic = 0;

    /**
     * @var int vesting account
     */
    const Vesting = 1;

    /**
     * @var int htlc account
     */
    const Htlc = 2;
}
