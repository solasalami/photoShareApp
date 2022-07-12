<!DOCTYPE html>
<html>
<title>Admin - Upload Image</title>
<link rel="stylesheet" type="text/css" href="style.css">

<body>

    <div class="header">
        <h2>Admin - Upload a Photo </h2>
    </div>

    <form method="post" enctype="multipart/form-data">

        <?php

        include('img-upload-server.php');
        ?>
        <?php include('errors.php'); ?>

        <div class="input-group">
            <label>Title</label>
            <input type="text" name="title" required value="<?php echo $title; ?>">
        </div>


        <div class="input-group">
            <label>Location</label>
            <input type="text" name="location" required value="<?php echo $location; ?>">
        </div>
        <div class="input-group">
            <label>Caption</label>
            <textarea type="text" cols="58" rows="3" name="caption" required value="<?php echo $caption; ?>">
            </textarea>
        </div>

        <div class="input-group">
            <label>Select Image</label>
            <input type="file" name="image_gallery[]" multiple>
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="submit">Upload Image</button>
        </div>

    </form>

    <!--  <form method="post" enctype="multipart/form-data">

         <input type="file" name="image_gallery[]" multiple>
         <input type="submit" value="Upload Image" name="submit">



     </form>
-->

</body>

</html>