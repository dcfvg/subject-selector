<?php
  include 'helpers.php';
  function sets_menu( $assets){
    $sets_path = glob("$assets/sets/*/");
    foreach ($sets_path as $id => $set_path) {
      $img_count = count(glob($set_path."/*.jpg"));
      $sets_list .=  '<a class="list-group-item" href="?set_name='.basename($set_path).'&mode=view"><span class="badge">'.$img_count.'</span>'.basename($set_path).'</a>';
    }
    return '<p class="lead">choose a set</p><div class="list-group">'.$sets_list.'</div>'; 
  }
?>