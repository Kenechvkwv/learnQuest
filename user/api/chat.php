<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the user input from the request
    $data = json_decode(file_get_contents("php://input"), true);
    $userInput = $data["message"];

    // Initialize OpenAI API parameters
    $openaiApiKey = getenv("OPENAI_API_KEY");
    $openaiApiUrl = "https://api.openai.com/v1/chat/completions";

    // Prepare the request data for OpenAI API
    $requestData = [
        "prompt" => "You are a helpful education assistant who knows a lot about Physics, Chemistry, Biology and other relevant courses offered in colleges. Give answers that are understandable and clear. However, while answering questions, ensure that you use: {$userInput} and keep to the context unless the answer to the question could not be found in {$userInput}",
        "max_tokens" => 150,
        "temperature" => 0.7,
        "n" => 1,
        "stop" => ["\n"]
    ];

    // Send request to OpenAI API
    $ch = curl_init($openaiApiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer {$openaiApiKey}"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));

    $response = curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
        echo json_encode(["error" => "Curl error: " . curl_error($ch)]);
    } else {
        error_log(print_r($response, true)); // Log API response for debugging

        if ($statusCode == 200) {
            $responseData = json_decode($response, true);
            if (isset($responseData["choices"][0]["text"])) {
                $botResponse = $responseData["choices"][0]["text"];
                echo json_encode(["response" => $botResponse, "debug" => "Success"]);
            } else {
                echo json_encode(["error" => "Unexpected response format from OpenAI"]);
            }
        } else {
            echo json_encode(["error" => "Failed to get response from OpenAI", "statusCode" => $statusCode]);
        }
    }

    curl_close($ch);
}
