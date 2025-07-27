<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user_question = $_POST['question'] ?? '';

$api_key = 'AIzaSyCCGyjLLZNZnSm0OZOMtxQWe--ZOnsfe_4';
$url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $api_key;


$data = [
    'contents' => [
        [
            'parts' => [
                ['text' => "Kamu adalah asisten kesehatan digital Nutrimate. ".
                           "Jawab hanya pertanyaan tentang kesehatan. ".
                           "Jika pertanyaan di luar topik, jawab: ".
                           "'Maaf, saya hanya bisa menjawab pertanyaan seputar kesehatan.'\n".
                           "Pertanyaan: $user_question"]
            ]
        ]
    ]
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);

if (curl_errno($ch)) {
  $error_msg = curl_error($ch);
}

curl_close($ch);

header('Content-Type: application/json');

if (isset($error_msg)) {
  echo json_encode(['error' => $error_msg]);
} else {
  echo $response;
}
