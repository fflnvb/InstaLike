<?php
date_default_timezone_set('America/North_Dakota/Center');
$tokens = Array(
    "token1", //add your 5 instagram tokens here
    "token2",
    "token3",
    "token4",
    "token5",
);
$tag = Array(
    "hashtag1", //add your 5 hashtags here
    "hashtag2",
    "hashtag3",
    "hashtag4",
    "hashtag5",
    
    );
$i = 0;
foreach ($tokens as $token){
$data = file_get_contents('https://api.instagram.com/v1/tags/'.$tag[$i].'/media/recent?access_token=1364533593.e109100.5afb45f2df8f4d1cb0c463240a183780');
$images = json_decode($data, true);
$lastImage = $images['data'][0]['id'];
//set POST variables
$url = 'https://api.instagram.com/v1/media/'.$lastImage.'/likes';

//url-ify the data for the POST
$fields_string = 'access_token='.$token.'&';
rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);
echo "[".date('m/d/y H:i:s')."]".$images['data'][0]['link']." (@".$images['data'][0]['user']['username'].") Liked!\n ";
$i++;
}
