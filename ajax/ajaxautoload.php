<?php
defined('BASEPATH') or exit('No se permite acceso directo');
spl_autoload_register(function ($class) {
  if(is_file("../".CORE . "$class.php"))
    return require "../".CORE . "$class.php";
  if(is_file("../".HELPER_PATH . "$class.php"))
    return require "../".HELPER_PATH . "$class.php";
  if(is_file("../".LIBS_ROUTE . "$class.php"))
    return require "../".LIBS_ROUTE . "$class.php";
  if(is_file("../".PATH_MODELS . "$class.php"))
    return require "../".PATH_MODELS . "$class.php";

});