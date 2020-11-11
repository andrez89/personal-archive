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

function expiredSession()
{
    $url = str_replace(BASE_PATH, "", $_SERVER['REQUEST_URI']);
    $pos = strpos($url, "/");
    if ($pos !== false && $pos <= 1) {
        $url = substr_replace($url, "", 0, 1);
    }
    header("Location: /" . BASE_PATH . "?url=" . urlencode($url));
    die();
}

/**
 * Return JSON response.
 *
 * @param  mixed $object
 */
function json($object)
{
    header('Content-Type: application/json');
    echo json_encode(utf8ize($object));
    if (json_last_error() != JSON_ERROR_NONE) {
        echo "{'JSON Error' : '" . json_last_error_msg() . "'}";
    }
    die();
}

/* Use it for json_encode some corrupt UTF-8 chars
 * useful for = malformed utf-8 characters possibly incorrectly encoded by json_encode
 */
function utf8ize($mixed)
{
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } elseif (is_string($mixed)) {
        return mb_convert_encoding($mixed, "UTF-8", "UTF-8");
    }
    return $mixed;
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

function ifNull($variable, $result = "")
{
    return isset($variable) ? $variable : $result;
}

function ifNoElement($array, $key, $result = "")
{
    return isset($array[$key]) ? $array[$key] : $result;
}
