<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '/var/www/html/PHPMailer/src/Exception.php';
require '/var/www/html/PHPMailer/src/PHPMailer.php';
require '/var/www/html/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch $mail->IsSMTP(); // telling the class to use SMTP
$mail->IsSMTP(); // telling the class to use SMTP
try {
$mail->CharSet = "utf-8"; //�ѱ��� �ȱ����� CharSet ����
$mail->Encoding = "base64";
$mail->Host = "smtp.gmail.com"; // email ������ ����� ������ ����
$mail->SMTPAuth = true; // SMTP ������ �����
$mail->Port = 465; // email ������ ����� ��Ʈ�� ����
$mail->SMTPSecure = "ssl"; // SSL�� �����
$mail->Username = "escritoyane@gmail.com"; // Gmail ����
$mail->Password = "soon06051007?!"; // �н�����
$mail->SetFrom('escritoyane@gmail.com', '������'); // ������ ��� email �ּҿ� ǥ�õ� �̸� (ǥ�õ� �̸��� ��������)
$mail->AddAddress('hyoukhoon@gmail.com'); // ���� ��� email �ּҿ� ǥ�õ� �̸� (ǥ�õ� �̸��� ��������)
$mail->Subject = '������ ���� Ȯ�� ����'; // ���� ����
$mail->Body =
"�ȳ��ϼ���. �������Դϴ�."; // ����
$mail->Send(); // �߼�

echo "Message Sent OK //�߼� Ȯ��
\n";
}
catch (phpmailerException $e) {
echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
echo $e->getMessage(); //Boring error messages from anything else!
}
?>