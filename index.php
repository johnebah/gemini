<?php

// Replace with your actual Gemini API key
$api_key = "AIzaSyA83sBR4RYnpL1VMVmJS4AIFi2JCejW_h4"; 

// Correct API endpoint (check if gemini-1.5-pro is available)
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-pro:generateContent?key=" . $api_key;

// Set up the request payload
$data = [
    "contents" => [
        [
            "parts" => [
                ["text" => "Who is Donald Trump?"]
            ]
        ]
    ]
];

// Convert the payload to JSON
$jsonData = json_encode($data);

// Initialize cURL
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

// Execute cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
    curl_close($ch);
    exit();
}

curl_close($ch);

// Decode the JSON response
$responseData = json_decode($response, true);

// Debugging: Print full response in case of errors
if (!$responseData || isset($responseData['error'])) {
    echo "API Response Error: " . json_encode($responseData, JSON_PRETTY_PRINT);
    exit();
}

// Extract and print the response text
echo $responseData['candidates'][0]['content']['parts'][0]['text'];

?>
