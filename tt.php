<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$amount=7.0;
$amount="0x".dechex($amount*1000000000000000000);

//$data='{"jsonrpc":"2.0","method":"eth_accounts","params":[],"id":1}';
//$data='{"jsonrpc":"2.0","method":"personal_newAccount","params":["testuser"],"id":1}';
$data='{"jsonrpc":"2.0","method":"eth_getBalance","params":["0xb62FE1Acc555d8cc6075C25dB8F33612791abD49", "latest"],"id":1}';
//$data='{"jsonrpc":"2.0","method":"eth_getTransactionReceipt","params":["0x9a4ee9d519632ffa4e4d2ac8c06c63506671b9814922393a89e67b654dd24ca4 "],"id":1}';
//$data='{"jsonrpc":"2.0","method":"eth_getTransactionByHash","params":["0x9a4ee9d519632ffa4e4d2ac8c06c63506671b9814922393a89e67b654dd24ca4"],"id":1}';

//$data='{"jsonrpc":"2.0","method":"eth_getTransactionByHash","params":["0x1a11eca58f1a0850c6136f929cd72ef45df88414035e9526e9b6d56710566d63"],"id":1}';

//$data='{"jsonrpc":"2.0","method":"eth_coinbase","params":[],"id":1}';

//$data='{"jsonrpc":"2.0","method":"eth_getTransactionCount","params":["0x6ab3ed9d2854ecb725d167a16c952b3ff4b96f48", "latest"],"id":1}';
//$data='{"jsonrpc":"2.0","method":"eth_getBalance","params":["0x6ab3ed9d2854ecb725d167a16c952b3ff4b96f48", "latest"],"id":1}';
//$data='{"jsonrpc":"2.0","method":"eth_getBalance","params":["0x517fb2be138d3f6bd68b190b036a2ddbba6813b2", "latest"],"id":1}';
//$data='{"jsonrpc":"2.0","method":"personal_listAccounts","params":[],"id":1}';

function json_rpc($data){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://59.10.169.91:8545");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	return curl_exec($ch);
}

function punlock($data){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://59.10.169.91:8545");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	return curl_exec($ch);
}



//$ok='{"jsonrpc":"2.0","method":"personal_unlockAccount","params":["0xb62FE1Acc555d8cc6075C25dB8F33612791abD49","testuser"],"id":1}';
//$ul=punlock($ok);
//print_r($ul);
//exit;
//$data='{"jsonrpc":"2.0","method":"eth_sendTransaction","params":[{"from": "0x6Ab3Ed9d2854eCb725d167a16C952B3ff4B96f48","to": "0xF74e1064E12c725Ab4c18764bEE5c5daCd3482Bd","value": "'.$amount.'"}],"id":1}';
//print_r($ul);
//echo "<br>--";


//$data='{"jsonrpc":"2.0","method":"eth_sendTransaction","params":[{"from": "0xb62FE1Acc555d8cc6075C25dB8F33612791abD49","to": "0xf74e1064e12c725ab4c18764bee5c5dacd3482bd","value": "0x10bb12bb16a7800"}],"id":1}';
$output=json_decode(json_rpc($data));
//echo "<br>";
echo "<pre>";
print_r($output);
$str=$output->result;
$eth_amt=hexdec($str)*1/1000000000000000000;
echo "eth:".$eth_amt;
//echo "<br>";
//$str=$output->result;
//$str=$output->result->gasUsed;
//echo hexdec($str);
//echo $str;
//echo "ch:".$output;

exit;
echo time();
echo "<br>";

	$data="module=account&action=txlist&address=0x6ab3ed9d2854ecb725d167a16c952b3ff4b96f48&startblock=0&endblock=99999999&page=1&offset=30&sort=desc&apikey=PU4J188DZWU72TAM9DGCC9K5VWHEXHKXQC";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://rinkeby.etherscan.io/api");
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$rs=curl_exec($ch);
	echo "<pre>";
	print_r(json_decode($rs));

?>