 <?php

  require_once('database.php');

  $db = $conn; // Enter your Connection variable;
  $tableName = 'gallery'; // Enter your table Name;

  $getImage = fetch_image($tableName);

  // fetching padination data
  function fetch_image($tableName)
  {
    global $db;
    $tableName = trim($tableName);
    if (!empty($tableName)) {
      $query = "SELECT * FROM " . $tableName . " ORDER BY id DESC";
      $result = $db->query($query);

      if ($result->num_rows > 0) {
        $row = $result->fetch_all(MYSQLI_ASSOC);
        return $row;
      } else {

        echo "Images not found in Database";
      }
    } else {
      echo "Database must be";
    }
  }

  ?>