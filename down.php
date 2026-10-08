<?php

header('Content-Type: application/json; charset=utf-8');

if (!isset($_GET['url']) || empty(trim($_GET['url']))) {
    $errorOutput = [
        'author' => 's7devv',
        'error' => true,
        'message' => 'Iltimos, ?url=... orqali Instagram havolasini yuboring!'
    ];
    echo json_encode($errorOutput, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

$target_url = trim($_GET['url']);

$apiUrl = 'https://full-downloader-social-media.p.rapidapi.com/?url=' . urlencode($target_url);

$ch = curl_init($apiUrl);

$headers = [
    'Accept: */*',
    'Accept-Encoding: gzip, deflate, br',
    'Accept-Language: ru',
    'Connection: keep-alive',
    'Host: full-downloader-social-media.p.rapidapi.com',
    'User-Agent: Video%20Downloader/1 CFNetwork/3896.100.1.2.1 Darwin/27.0.0',
    'x-rapidapi-host: full-downloader-social-media.p.rapidapi.com',
    'x-rapidapi-key: 31ca14de34msh4c1b7fd1ca04191p1394f1jsnb923fffa3fa9'
];

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_ENCODING, '');

$response = curl_exec($ch);

if (curl_errno($ch)) {
    $output = [
        'author' => 's7devv',
        'error' => true,
        'message' => curl_error($ch)
    ];
} else {
    $data = json_decode($response, true);
    
    if (json_last_error() === JSON_ERROR_NONE) {
        $output = [
            'author' => 's7devv'
        ] + $data;
    } else {
        $output = [
            'author' => 's7devv',
            'error' => true,
            'message' => 'Invalid JSON response from API',
            'raw_response' => $response
        ];
    }
}

curl_close($ch);

echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

?>