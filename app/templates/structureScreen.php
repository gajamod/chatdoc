<?php 
  ob_start(); 
?><!doctype html>
<html lang="es">
  <head>
    <base href="<?php echo BASE_URL ?>">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/flatybootswatch.min.css">
    <link rel="stylesheet" href="css/chat.css">
    <title><?php echo $this->title; ?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <?php echo $this->extendHead; ?>  
  </head>
  <body <?php echo $this->onBody; ?> >
    <?php  require_once(PATH_TEMPLATES.'headerPartial.php'); ?>
    <div class="row" style="height: 100%; min-height: 90%;">
      <div class="col-md-1">
        <?php  require_once(PATH_TEMPLATES.'leftPartial.php'); ?>
      </div>
      <?php 
        /**<?php 
      **/
      ?>
      <div class="col-md-11" id="content">
        <?php echo $this->content; ?>
      </div>
      
    </div>
    <?php  require_once(PATH_TEMPLATES.'footerPartial.php'); ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
  </body>
</html>