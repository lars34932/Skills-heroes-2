<?php
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://api.scryfall.com/sets");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

$headers = [
  'User-Agent: Content-type: text/javascript',
  'Accept: */*'
];

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($curl);

curl_close($curl);

$data = json_decode($response, true);
$data = $data['data'];

$file = fopen('sets.csv', 'w');

foreach ($data as $key) {
  $array = [];
  array_push($array, $key['code'], $key['name'], $key['scryfall_uri'], $key['released_at'], $key['icon_svg_uri']);
  fputcsv($file, $array);
}

fclose($file);