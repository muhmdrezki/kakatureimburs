<?php

	function getSaltKey(){
		//Tidak Boleh Diubah
		$key = "#k@KaTu_1nT3rNEt_$3H@t";
		//$key2 = "#k@KaTu_1nT3rNEt_$3H@t";
		return $key;
	}
	function encodeData($data){
		echo "MasukEncode<br>";
		$encoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(getSaltKey()), $data, MCRYPT_MODE_CBC, md5(md5(getSaltKey()))));
		return $encoded;
	}
	function decodeData($data){
		echo "MasukDecode<br>";
		$decoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(getSaltKey()), base64_decode($data), MCRYPT_MODE_CBC, md5(md5(getSaltKey()))), "\0");
		return $decoded;
	}
	$pass = "makanan13";
	$encodedPass = encodeData($pass);
	echo $encodedPass."<br>";
	$decodedPass = decodeData($encodedPass);
	echo $decodedPass."<br>";
?>