<?php

require('img-script.php');
?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Photo Gallery</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?logout='1'">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!--======Show Image Gallery ========-->
  <br>
  <div class="row">
    <br>
    <?php

    if (!empty($getImage)) {
      $sn = 1;
      foreach ($getImage as $img) {

    ?>

        <div class="">

          <h2>Location: <?php
                        echo $img['location'];

                        ?></h2>
          <br>
          <img src="uploads/
<?php
        echo $img['image_name'];

?>
" style="width:50%" onclick="openModal(); currentSlide(
<?php
        echo $sn;
?>
)" class="hover-shadow cursor">

          <h4><?php
              echo $img['caption'];

              ?></h4>
          <hr>
          <br>
        </div>

    <?php

        $sn++;
      }
    } else {
      echo "";
    }
    ?>

  </div>


</body>

</html>