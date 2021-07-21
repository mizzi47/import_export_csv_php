<?php
//im using $port bcause my pc must use it (remove if not neccessary)
$port=8888;
$conn = mysqli_connect('localhost', 'root', '', 'selected_dbname', $port);

if ($conn -> connect_errno){
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
} else{
    if(isset($_POST["submit_file"])){
      $acceptable = 'text/csv';
      if($_FILES['file']['type'] != 'application/vnd.ms-excel' && (!empty($_FILES["file"]["type"])) ) {
        $errors[] = 'Please select only csv file';
      }
      else if(empty($_FILES["file"]["type"])){
        $errors[] = 'No file selected';
      }
      if(count($errors) === 0) {
          $file = $_FILES["file"]["tmp_name"];
          $file_open = fopen($file,"r");
          fgetcsv($file_open, 10000, ",");
          while(($csv = fgetcsv($file_open, 1000, ",")) !== false){
            $column= $csv[1];

            $sql = "INSERT INTO selected_db (table_column) VALUES ('$column')";

              if ($conn->query($sql) === TRUE) {
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
          }
          echo '<script>
                  alert("File uploaded successfully");
                  window.location.href = "index.php";
                </script>';
      } else{
          foreach($errors as $error) {
              echo '<script>
                      alert("'.$error.'");
                      window.location.href = "index.php";
                    </script>';
          }
      }   
    } 
}


?>