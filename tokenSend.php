<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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



$ok='{"jsonrpc":"2.0","method":"personal_unlockAccount","params":["0xb62fe1acc555d8cc6075c25db8f33612791abd49","testuser"],"id":1}';
$ul=punlock($ok);
print_r($ul);
//exit;
//$data='{"jsonrpc":"2.0","method":"eth_sendTransaction","params":[{"from": "0xb62fe1acc555d8cc6075c25db8f33612791abd49","to": "0xF74e1064E12c725Ab4c18764bEE5c5daCd3482Bd","value": "'.$amount.'"}],"id":1}';
//print_r($ul);
//echo "<br>--";


//$data='{"jsonrpc":"2.0","method":"eth_sendTransaction","params":[{"from": "0xb62fe1acc555d8cc6075c25db8f33612791abd49","to": "0xF74e1064E12c725Ab4c18764bEE5c5daCd3482Bd","value": "'.$amount.'"}],"id":1}';
//echo "rpc:".json_rpc($data)."<br>";

$numLen=strlen($number16);
$zeroCnt=64-$numLen;
$zero=str_repeat("0",$zeroCnt);
$sendAmount=$zero.$number16;

$toAddr="F74e1064E12c725Ab4c18764bEE5c5daCd3482Bd";
$sendData = "0xa9059cbb000000000000000000000000".$toAddr.$sendAmount;
$contractAddr="0x999312ca356d8997815876216e1971e2c47e4a4f";

$data='{"jsonrpc": "2.0", "id": 1, "method": "eth_sendTransaction", "params": [{"from":"0xb62fe1acc555d8cc6075c25db8f33612791abd49", "to":"'.$contractAddr.'", "gas": "0x11170", "value":"0x0", 
"data":"'.$sendData.'"}]}';


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
