<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(!$update)
{
  exit;
}

$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$senderId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

$text = trim($text);
$text = strtolower($text);

$response=""; // I know that in PHP i cannot initialize variables but I did it 'couse I am rebel.
if(substr($text, 0,1)=="/"){
  switch ($text) {

    case '/whoareyou':
      $response="Hi " . $username . ", I am Denny!";
      break;

    default:
  $response="Non riconosco il comando";
      break;
  }
  header("Content-Type: application/json");
  $parameters = array('chat_id' => $chatId, "text" => $response);
  $parameters["method"] = "sendMessage";
  echo json_encode($parameters);

}else{
  header("Content-Type: application/json");
  $parameters = array('chat_id' => $chatId, "text" => "Non riconosco il comando");
  $parameters["method"] = "sendMessage";
  echo json_encode($parameters);
}
