<?php
  $pages = array("frequency"=>"Frequency","sunami"=>"Tsunami");
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
    <style>
      .nav-justified{
        background-color:#2c3e50;
        text-transform:uppercase;
        text-align:justify;
        border-radius:5;
        overflow:hidden;
      }
      .nav-justified > li > a{
        color:white;
      }
    </style>


  </head>
  <body>
    <div class="container">
      <div class="page-header">
        <h1>ProjectName</h1>
      </div>
      <ul class="nav nav-tabs nav-justified">
        <? foreach($pages as $name=>$short){  ?>
          <li <? if($active[$name]) { ?>  class="active"  <? } ?>>
            <a href="<?=$name?>.php"><?=$short?></a></li>
            <? } ?>
      </ul>
      </div>
    </div>
