<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//https://api-rinkeby.etherscan.io/api?module=account&action=tokenbalance&contractaddress=0x999312ca356d8997815876216e1971e2c47e4a4f&address=0xf74e1064e12c725ab4c18764bee5c5dacd3482bd&tag=latest&apikey=PU4J188DZWU72TAM9DGCC9K5VWHEXHKXQC

//5279457.595963670760558593



$number=2000000;
$number = $number.'000000000000000000';
//$number16=base_convert($number, 10, 16);
$number=gmp_init($number,10);
$number16=gmp_strval($number, 16);

$data='{"jsonrpc":"2.0","method":"eth_accounts","params":[],"id":1}';
//$data='{"jsonrpc":"2.0","method":"personal_newAccount","params":["testuser"],"id":1}';
$data='{"jsonrpc":"2.0","method":"eth_getBalance","params":["0xb62fe1acc555d8cc6075c25db8f33612791abd49", "latest"],"id":1}';//6.2985
//$data='{"jsonrpc":"2.0","method":"eth_getBalance","params":["0xf204ac425a05dc209c281cb6f7be297086a14a0d", "latest"],"id":1}';//0.05
//$data='{"jsonrpc":"2.0","method":"eth_getBalance","params":["0xabffc38f8a65e7eebe43bb4116726dc6f96f906a", "latest"],"id":1}';//0.053
//$data='{"jsonrpc":"2.0","method":"eth_getBalance","params":["0x3598e92180a013cdd4bd0ec5ec2fdf01d2784df1", "latest"],"id":1}';//0.05
//$data='{"jsonrpc":"2.0","method":"eth_getTransactionReceipt","params":["0x9a4ee9d519632ffa4e4d2ac8c06c63506671b9814922393a89e67b654dd24ca4 "],"id":1}';
//$data='{"jsonrpc":"2.0","method":"eth_getTransactionByHash","params":["0x9a4ee9d519632ffa4e4d2ac8c06c63506671b9814922393a89e67b654dd24ca4"],"id":1}';

//$data='{"jsonrpc":"2.0","method":"eth_getTransactionByHash","params":["0x1a11eca58f1a0850c6136f929cd72ef45df88414035e9526e9b6d56710566d63"],"id":1}';

//$data='{"jsonrpc":"2.0","method":"eth_coinbase","params":[],"id":1}';

//$data='{"jsonrpc":"2.0","method":"eth_blockNumber","params":["latest", false],"id":1}';
//$data='{"jsonrpc":"2.0","method":"eth_getBlockByNumber","params":["latest", false],"id":1}';

//$data='{"jsonrpc":"2.0","method":"eth_getTransactionCount","params":["0x6ab3ed9d2854ecb725d167a16c952b3ff4b96f48", "latest"],"id":1}';
//$data='{"jsonrpc":"2.0","method":"eth_getBalance","params":["0x6ab3ed9d2854ecb725d167a16c952b3ff4b96f48", "latest"],"id":1}';
//$data='{"jsonrpc":"2.0","method":"eth_getBalance","params":["0x517fb2be138d3f6bd68b190b036a2ddbba6813b2", "latest"],"id":1}';
//$data='{"jsonrpc":"2.0","method":"personal_listAccounts","params":[],"id":1}';

function json_rpc($data){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://59.10.169.91:8545");
//	curl_setopt($ch, CURLOPT_URL, "https://ropsten.infura.io");
//	curl_setopt($ch, CURLOPT_URL, "https://rinkeby.infura.io");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	return curl_exec($ch);
}

function punlock($data){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://59.10.169.91:8545");
//	curl_setopt($ch, CURLOPT_URL, "https://rinkeby.infura.io");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	return curl_exec($ch);
}

//'{"jsonrpc":"2.0","method":"eth_call","params":[{"from": "0x8aff0a12f3e8d55cc718d36f84e002c335df2f4a", "to": "0x5c7687810ce3eae6cda44d0e6c896245cd4f97c6", "data": "0x6740d36c0000000000000000000000000000000000000000000000000000000000000005"}, "latest"],"id":1}'
$Addr="F74e1064E12c725Ab4c18764bEE5c5daCd3482Bd";
$contractAddr="0x999312ca356d8997815876216e1971e2c47e4a4f";
$dt="0x70a08231000000000000000000000000".$Addr;
$data='{"jsonrpc":"2.0","method":"eth_call","params":[{"from":"0x'.$Addr.'", "to": "'.$contractAddr.'", "data": "'.$dt.'"}, "latest"],"id":1}';//6.2985

$output=json_decode(json_rpc($data));
//echo "<br>";
echo "<pre>";
print_r($output);
$str=$output->result;
//$str=$output->result->number;
$eth_amt=hexdec($str)*1/1000000000000000000;
//$eth_amt=hexdec($str);
echo "eth:".$eth_amt;
//echo "<br>";
//$str=$output->result;
//$str=$output->result->gasUsed;
//echo hexdec($str);
//echo $str;
//echo "ch:".$output;
echo "<br>localhost";
exit;
//echo time();
echo "<br>";

	$data="module=account&action=txlist&address=0xb62fe1acc555d8cc6075c25db8f33612791abd49&startblock=0&endblock=9999999999999999&sort=desc&apikey=PU4J188DZWU72TAM9DGCC9K5VWHEXHKXQC";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://rinkeby.etherscan.io/api");
//	curl_setopt($ch, CURLOPT_URL, "https://api-ropsten.etherscan.io/api");
	curl_setopt($ch, CURLOPT_POST, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$rs=curl_exec($ch);
	echo "<pre>";
	print_r(json_decode($rs));


//http://api-rinkeby.etherscan.io/api?module=account&action=txlist&address=0xddbd2b932c763ba5b1b7ae3b362eac3e8d40121a&startblock=0&endblock=99999999&sort=asc&apikey=YourApiKeyToken
?>
