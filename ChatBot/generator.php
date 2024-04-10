<?php
// This is a simplified example of bot.php for demonstration purposes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $userMessage = $data['message'];

    // Save user message in a PHP variable (you can perform additional processing here)
    $userQuestion = $userMessage;

    // Include response.php and call the response function with user's question
    include('../gemini/response.php');
    $botResponse = response($userQuestion);

    // Return the bot's response as JSON
    echo json_encode(['response' => $botResponse]);
}
?>
