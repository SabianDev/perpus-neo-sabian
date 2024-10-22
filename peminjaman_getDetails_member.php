<?php
// Assuming you have a database connection established already

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the bookID from the POST data
    $memberID = $_POST['memberID'];

    // Perform a query to get the corresponding book_name from the database
    // Adjust the database connection details accordingly
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_progweb_perpus";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM tb_member WHERE mbr_npm = '$memberID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response = array(
            // 'value disimpen disini' => $row['value hasil fetch dari table']
            'member_nama' => $row['mbr_nama'],
            'member_angkatan' => $row['mbr_angkatan']
        );
        echo json_encode($response);
    } else {
        echo "Member not found";
    }

    $conn->close();
}
?>
