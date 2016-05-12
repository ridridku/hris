<?php

  require_once (SMARTY_DIR."Smarty.class.php");
  
  // Buat objek $smarty dari class bernama Smarty
  $smarty = new Smarty;
  
  // Deklarasi variabel
  $smarty->compile_dir = COMPILE_DIR;
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->cache_dir = CACHE_DIR;
  
  $smarty->left_delimiter = "<!--{";
  $smarty->right_delimiter = "}-->";
  
  // Status : true/ false
  $smarty->compile_check = true;
  $smarty->caching = false;
  $smarty->use_sub_dirs = true;
?> 