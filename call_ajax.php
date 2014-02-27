<?php 

  $rep = array("hello");

  if(isset($_POST["img"]) && isset($_POST["selection"])){    
    
    $selection = serialize($_POST["selection"]);
    file_put_contents($_POST["img"].".md", $selection);
    
    $res["ok"] = ".md";
    $res["sel"] = unserialize($selection);
  }

  header('Content-Type: application/json');
  echo json_encode($res);
?>