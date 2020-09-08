<?php
echo	"\n•••••••••••••••••••••••
•    NUYUL S-EARN     •
•  Script By Ghodan   •
•••••••••••••••••••••••";


echo "\n\nNUYUL S-EARN";
echo "\n1. REGISTER";
echo "\n2. LOGIN";
echo "\n3. EXIT";
echo "\nPilihan Menu : ";
$nuyul = trim(fgets(STDIN));

switch ($nuyul){
	case 1:
		register();
		break;
	case 2:
		login();
		break;
	case 3:
		exit;
}




function register() {

echo "\n\nMAAF SAAT INI FITUR REGISTRASI MASIH EROR\n";
sleep(2);
exit;

//register
$ua = array(
'user-agent: Redmi 4X(Android/9) (com.spsd.st/1.0.4) Weex/0.26.0 720x1280',
'Content-Type: application/json; charset=utf-8',
);

echo "REGISTER S-EARN";
echo "\nUsername      : ";
$u = trim(fgets(STDIN));
echo "\nPassword      : ";
$p = trim(fgets(STDIN));
echo "\nNomor HP (+62): ";
$hp = trim(fgets(STDIN));

//OTP

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.x898xe.fun/api/account/get_code");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
$no = 'tel=$hp';
$nohp = json_encode($no);
curl_setopt($ch, CURLOPT_POSTFIELDS, $nohp);
$result = curl_exec($ch);
var_dump($result);
//OTP

echo "\nKode SMS : ";
$c = trim(fgets(STDIN));
echo "\nKode Invite : ";
$i = trim(fgets(STDIN));


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.x898xe.fun/api/login/register");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
$dat = 'username=$u&pwd=$p&tel=$hp&code=$c&agentid=$i';
$data = json_encode($dat);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($ch);
var_dump($result);
}






function login(){
//login

$ua = array(
'user-agent: Redmi 4X(Android/9) (com.spsd.st/1.0.4) Weex/0.26.0 720x1280',
'Content-Type: application/json; charset=utf-8',
);

echo "Masukkan Username Anda: ";
$username = trim(fgets(STDIN));

echo "Masukkan Password Anda: ";
$pass = trim(fgets(STDIN));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.x898xe.fun/api/login/login");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $ua);
$data = array();
$data["username"] = $username;
$data["password"] = $pass;
$data["devicetype"] = "android";
$data["version"] = "100";
$dat = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $dat);
$result = curl_exec($ch);
$res = json_decode($result, true);
$code = $res["code"];
$pesan = $res["msg"];
$token = $res["data"]["token"];
echo "\nLOGIN";
sleep(1);
echo " .";
sleep(1);
echo " .";
sleep(1);
echo " .";
sleep(2);

if($pesan=="SUCCESS"){
echo "\n$pesan LOGIN !!!";

//info akun

$head = array(
'token: '.$token,
'user-agent: Redmi 4X(Android/9) (com.spsd.st/1.0.4) Weex/0.26.0 720x1280',
'Content-Type: application/json; charset=utf-8',
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.x898xe.fun/api/account/getUserInfo");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
curl_setopt($ch, CURLOPT_POSTFIELDS, "");
$resul = curl_exec($ch);
$result = json_decode($resul, true);
$msg = $result["msg"];
$user = $result["data"]["username"];
$coin = $result["data"]["balance"];
$ksmpt = $result["data"]["ordernum_today"];
echo "\n\nMENDAPATKAN INFO AKUN";
sleep(1);
echo " .";
sleep(1);
echo " .";
sleep(1);
echo " .";
sleep(2);
echo "\nUSERNAME 	    : ".$user;
echo "\nBALANCE  	    : ".$coin;
echo "\nKESEMPATAN MEMESAN  : ".$ksmpt;
echo "\nSTATUS $msg";


//Make Order

$x = 0;
while($x < 20){
$x++;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.x898xe.fun/api/order/mkorder");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
curl_setopt($ch, CURLOPT_POSTFIELDS, "");
$resul = curl_exec($ch);
$result= json_decode($resul, true);
$orderid = $result["data"]["orderid"];
echo "\n";
echo "\nOrderid : $orderid";


//Konfirmasi Order

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.x898xe.fun/api/order/confirm");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
$njay = array();
$njay["orderid"]= $orderid;
$njay["status"]= "1";
$he = json_encode($njay);
curl_setopt($ch, CURLOPT_POSTFIELDS, $he);
$result = curl_exec($ch);
$njir = json_decode($result, true);
$pesen = $njir["msg"];
echo "\nMEMULAI NUYUL S-EARN";
sleep(1);
echo " .";
sleep(1);
echo " .";
sleep(1);
echo " .";
sleep(2);

if($pesen=="SUCCESS"){

echo "\n$pesen NUYUL S-EARN !!!";
sleep(2);

}else {
echo "\nGAGAL NUYUL S-EARN !!!";
}

}

//Cek ulang balance

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.x898xe.fun/api/account/getUserInfo");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$resul = curl_exec($ch);
$result = json_decode($resul, true);
$msg = $result["msg"];
$user = $result["data"]["username"];
$coin = $result["data"]["balance"];
$ksmpt = $result["data"]["ordernum_today"];
echo "\n\nMENDAPATKAN INFO TERBARU AKUN";
sleep(1);
echo " .";
sleep(1);
echo " .";
sleep(1);
echo " .";
sleep(2);
echo "\nUSERNAME            : ".$user;
echo "\nBALANCE             : ".$coin;
echo "\nKESEMPATAN MEMESAN  : ".$ksmpt;
echo "\nSTATUS $msg NUYUL S-EARN\n";
} else {
echo "\nGAGAL LOGIN, USERNAME ATAU KATA SANDI SALAH !!!\n";
sleep(2);
}
}
?>
