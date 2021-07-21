<html>
<body>
<div id="wrapper">
 <form method="post" action="import_table.php" enctype="multipart/form-data">
  <input type="file" name="file"/>
  <input type="submit" name="submit_file" value="SUBMIT"/>
 </form>
</div>

<div class="table-responsive">
  <table class="table no-margin" id="tabletest">
    <thead>
        <tr>
        <th style="width: 1%">HEADER</th>
        </tr>
    </thead>

    <!--connection and reading from kpdn sql-->
    <!--im using $port bcause my pc must use it (remove if not neccessary)-->
    <?php
    $port=8888;
    $conn = mysqli_connect('localhost', 'root', '', 'selected_db', $port);
    $sql = "SELECT * FROM selected_db.selected_table";
    $result = $conn->query($sql);
    ?>
    <!--end-->

    <tbody>
      <?php
      if ($result->num_rows > 0) {
        // output each row
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["name"]. "</td>
                </tr>";
        }
      } else {
        echo "0 results";
      }
      ?>
    </tbody>
  </table>
</div>

<!-- export button -->
<div id="wrapper">
 <form method="post" action="export_table.php" enctype="multipart/form-data">
  <input type="submit" name="submit_file" value="EXPORT"/>
 </form>
</div>

</body>
</html>