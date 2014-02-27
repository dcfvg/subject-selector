<?php 

  $rep = array("hello");

  if(isset($_POST["img"]) && isset($_POST["selection"])){    
    
    $selection = serialize($_POST["selection"]);
    file_put_contents($_POST["img"].".md", $selection);
    
    $res["ok"] = ".md";
    // $res["sel"] = unserialize($selection);
  }else if (isset($_POST["img"]) && isset($_POST["askParam"])){
    
    $img = $_POST["img"];
    $img_selectionFile = $img.".md";
    
    if(file_exists($img_selectionFile)){
      $img_selection = unserialize (file_get_contents($img_selectionFile));
      $res["sel"] = $img_selection;
      $res["hasData"] = true;
    }else {
      $res["hasData"] = false;
    }
    

    
    
  }

  header('Content-Type: application/json');
  echo json_encode($res);
?>