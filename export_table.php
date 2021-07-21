<?php
//im using $port bcause my pc must use it (remove if not neccessary)

$port=8888;
$conn = mysqli_connect('localhost', 'root', '', 'selected_dbname', $port);

$query = "SELECT * FROM selected_dbname.selected_db";
if (!$result = mysqli_query($conn, $query)) {
    exit(mysqli_error($conn));
}

$fr_data = array();
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $fr_data[] = $row;
    }
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=any_name.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('header1, header2'));

if (count($fr_data) > 0) {
    foreach ($fr_data as $row) {
        fputcsv($output, $row);
    }
}
?>