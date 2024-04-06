<?php

use Bref\Context\Context;

require __DIR__.'/vendor/autoload.php';

return function($event, Context $context){
  echo json_encode(["info"=>"This is going to cloudwatch"]);
  return json_encode(["message"=>sprintf('Hello, %s!',$event['name'] ?? "uknown")]);
}

?>