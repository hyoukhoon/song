<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



function json_rpc($data){

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://mainnet.infura.io/v3/da7cb217862d42d696666fefecef348c");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	return curl_exec($ch);
}

//0xf545111f268da07439550344d668ab272986778f
$Addr="d668086ec408a20c3285596e786ae03cb9bf410c";
$contractAddr="0xd26114cd6EE289AccF82350c8d8487fedB8A0C07";
$dt="0x70a08231000000000000000000000000".$Addr;
$data='{"jsonrpc":"2.0","method":"eth_call","params":[{"from":"0x'.$Addr.'", "to": "'.$contractAddr.'", "data": "'.$dt.'"}, "latest"],"id":1}';

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

// https://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress=0xd26114cd6EE289AccF82350c8d8487fedB8A0C07&address=0xd668086ec408a20c3285596e786ae03cb9bf410c&tag=latest&apikey=PU4J188DZWU72TAM9DGCC9K5VWHEXHKXQC



?>
