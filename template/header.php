<?php
  $pages = array("frequency"=>"Frequency");
  $active = array();
  foreach($pages as $name=>$short)
  {
    $active[$name] = preg_match("/".$name.".php"."/i",$_SERVER['REQUEST_URI']);
  }
?>
<html>
  <head>
    <meta charset="utf8">
    <title>EarthQuake</title>
    <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css"/>
    <script src="asset/jquery-1.11.1.min.js"></script>
    <script src="asset/bootstrap/js/bootstrap.min.js"></script>
    <script src="asset/d3/d3.min.js"></script>
  </head>
  <body>
    <div class="container">
      <ul class="nav nav-tabs nav-justified">
        <h3>EarthQuake</h3>
      </ul>
      <ul class="nav nav-pills nav-justified">
        <? foreach($pages as $name=>$short){  ?>
          <li role="presentation" <? if($active[$name]) { ?>  class="active"  <? } ?>>
            <a href="<?=$name?>.php"><?=$short?></a></li>
            <? } ?>
      </ul>
    </div>
