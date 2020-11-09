<?php

/**
 * Require a view.
 *
 * @param  string $name
 * @param  array  $data
 */
function view($name, $data = [])
{
    extract($data);

    return require "app/views/{$name}.view.php";
}

/**
 * Redirect to a new page.
 *
 * @param  string $path
 */
function redirect($path)
{
    header("Location: /" . BASE_PATH . "{$path}");
}

/**
 * Return JSON response.
 *
 * @param  mixed $object
 */
function json($object)
{
    header('Content-Type: application/json');
    echo json_encode($object);
    die();
}

/**
 * Return User Login State.
 */
function logged()
{
    return isset($_SESSION["user_id"]);
}

/**
 * Send a POST requst using cURL
 * @param string $url to request
 * @param array $post values to send
 * @param array $options for cURL
 * @return string
 */
function curl_post($url, array $headers, $post = "", array $options = array())
{
    $defaults = array(
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_URL => $url,
        CURLOPT_FRESH_CONNECT => 1,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FORBID_REUSE => 1,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_SSL_VERIFYPEER => 0, // On dev server only!
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_POSTFIELDS => $post
    );

    $ch = curl_init();
    curl_setopt_array($ch, ($options + $defaults));
    if (!$result = curl_exec($ch)) {
        trigger_error(curl_error($ch));
    }
    curl_close($ch);
    return $result;
}

/**
 * Send a GET requst using cURL
 * @param string $url to request
 * @param array $get values to send
 * @param array $options for cURL
 * @return string
 */
function curl_get($url, array $headers = null, array $get = array(), array $options = array())
{
    $defaults = array(
        CURLOPT_URL => $url . (strpos($url, '?') === false ? '?' : '') . http_build_query($get),
        CURLOPT_HEADER => 0,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FRESH_CONNECT => 1,
        CURLOPT_SSL_VERIFYPEER => 0, // On dev server only!
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_TIMEOUT => 0
    );

    $ch = curl_init();
    curl_setopt_array($ch, ($options + $defaults));
    if (!$result = curl_exec($ch)) {
        trigger_error(curl_error($ch));
    }
    curl_close($ch);
    return $result;
}

use PHPMailer\PHPMailer\PHPMailer;

function sendMail($email, $subject, $html)
{
    $mail = new PHPMailer();
    // configure an SMTP
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->CharSet = 'UTF-8';
    $mail->Username = SMTP_MAIL;
    $mail->Password = SMTP_PASSWORD;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->isHTML(true);

    $mail->setFrom(SMTP_MAIL, 'PHP Framework');
    $mail->addAddress($email);
    $mail->Body = $html;
    $mail->Subject = $subject;

    if (!$mail->send()) {
        echo 'Message could not be sent.<br>';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        //echo 'Message has been sent';
    }
}
