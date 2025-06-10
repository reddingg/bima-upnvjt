<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api {

	function sendMail($email,$subjek,$pesan){
		require_once(APPPATH.'libraries/classes/class.phpmailer.php');

		$mail = new PHPMailer; 

		$mail->IsSMTP(); //aktifkan SMTP
		$mail->SMTPSecure = 'ssl'; //transfer aman diaktifkan
		$mail->Host = "smtp.gmail.com"; //host masing-masing provider email
		$mail->SMTPDebug = 2; //debugging: 1 = errors and pesan, 2 = hanya pesan
		$mail->Port = 465; //set port yang digunakan (465 atau 587)
		$mail->SMTPAuth = true; //auth diaktifkan

		$mail->Username = "bima.informatika@gmail.com"; //user email
		$mail->Password = "Informatika20"; //password email 

		$mail->SetFrom("bima.informatika@gmail.com","Bimbingan mahasiswa"); //email pengirim
		$mail->AddAddress($email,"");  //email tujuan

		$mail->Subject = $subjek; //subyek email
		$mail->MsgHTML($pesan); //pesan email

		if ($mail->Send()){
			return 'oke'; //sukses, email terkirim
		} 
		else {
			return 'err'; //gagal, email tidak terkirim
		}
	}

	function sendTelegram($chatID, $pesan){
		$token = '933935767:AAGvNTCA34lIhD8FFLP7p25UR_5k49B29LE';

	    $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
	    $url = $url . "&text=" . urlencode($pesan);
	    $ch = curl_init();
	    $optArray = array(
	            CURLOPT_URL => $url,
	            CURLOPT_RETURNTRANSFER => true
	    );
	    curl_setopt_array($ch, $optArray);
	    $result = curl_exec($ch);
	    curl_close($ch);
	    return $result;

	}
}
