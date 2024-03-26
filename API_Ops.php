<?php
$month = date('m');
$day = date('d');

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://imdb8.p.rapidapi.com/actors/list-born-today?month=$month&day=$day",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: imdb8.p.rapidapi.com",
        "X-RapidAPI-Key: bdba4bdb56msha04eeebc47909a4p1d9804jsn7e34d688d018"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
?>
