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

    case '/aboutme':
      $response="Hi " . $username . ", I am Denny!👋\nI'm an Italian programmer and my dream is to work for Google\n";
      $response.="\nIf you want to contact me, you can find my email here: /email📮";
      $response.="\nIf you want watch my apps, tap here: /projects📱";
      break;

    case '/email':
        $response="📮Here you are my emails:📮\n✉️acciarogennaro@gmail.com\n✉️work@gdacciaro.com";
        break;

    case '/projects':
        $response="💀CREEPYPASTA💀";
        $response.="\nA Creepypasta is a short story that was designed to terrorize the reader
\nThis application is a database of scary stories in 3 languages (English,Italian and Español).
\nIt includes over 3500 stories, which will not let you sleep at night\n\n\nDownload here:\nhttps://play.google.com/store/apps/details?id=com.acciarogennaro.creepypasta";

    /*    $response.="🚘AUTOSCUOLA KRISTALL🚘";
        $response.="\nWith this app you can view a complete video course to get a driving license.
\nThis includes quizzes and all the tools dedicated for each young driver\n\n\nDownload here:\nhttps://play.google.com/store/apps/details?id=autoscuolakristall.android";
*/
    break;

    default:
      $response="I can not recognize the command, please use the commands list";
      break;
  }
  header("Content-Type: application/json");
  $parameters = array('chat_id' => $chatId, "text" => $response);
  $parameters["method"] = "sendMessage";
  //$parameters = array('chat_id' => $chatId, "sticker" => $arrayName = array('file_id' =>"BQADBAADgAIAAmbFbQYjv4eHMUpKPQI"));
  //$parameters["method"] = "sendMessage";
  echo json_encode($parameters);

}else{
  header("Content-Type: application/json");
  $parameters = array('chat_id' => $chatId, "text" => "I can not recognize the command, please use the commands list");
  $parameters["method"] = "sendMessage";
  echo json_encode($parameters);
}
