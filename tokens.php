<?php

$geth = new EthereumRPC('127.0.0.1', 8545);
$erc20 = new \ERC20\ERC20($geth);
$token = $erc20->token('0xd26114cd6EE289AccF82350c8d8487fedB8A0C07');

var_dump($token->name());
var_dump($token->symbol());
var_dump($token->decimals());

?>