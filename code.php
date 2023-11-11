<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "revision";

// Create a connection to the database
$db = new mysqli($servername, $username, $password, $database);
if (isset($_POST['action'])&& $_POST['action'] == "create") {
    // Get the form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];

   
    // $response = "Data received successfully. Name: $name, Phone: $phone";
    $sql = "INSERT INTO `person`( `Name`, `Contact`) VALUES ('$name','$phone')";
      
    // echo $sql;
    $res = mysqli_query($db,$sql);

} 

//
if (isset($_POST['action'])&& $_POST['action'] == "show") {
$sql = "SELECT * FROM `person`";
$res = mysqli_query($db,$sql);
$count=1;
if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
  
        $output = "<tr>
                        
        <td>{$count}</td>
        <td>{$row['Name']}</td>
        <td>{$row['Contact']}</td>
        <td><button style='margin-right: 20px;' class='btn btn-success edit-button' data-id='{$row['ID']}'>Edit</button><button class='btn btn-danger delete-button' data-id='{$row['ID']}'>Delete</button></td>

        </tr>";
        echo $output;
        $count++;
    }
}
}
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Perform the deletion
    $sql = "DELETE FROM person WHERE ID = $id ";
    $res = mysqli_query($db,$sql);
}
if (isset($_POST['uid'])) {
    $id = $_POST['uid'];

    // Perform the updation
    $sql = "SELECT * FROM `person` WHERE ID = $id ";
    $res = mysqli_query($db,$sql);
    $result  = mysqli_fetch_assoc($res);
    // print_r($result);
     echo json_encode($result);
        
    }
    if (isset($_POST['editid'])) {
        $id = $_POST['editid'];
    
        // Perform the updation
        $name = $_POST['name'];
        $phone = $_POST['phone'];
    
       
        // $response = "Data received successfully. Name: $name, Phone: $phone";
        $sql = "UPDATE `person` SET `Name`='$name',`Contact`='$phone' WHERE `ID`=$id ";
          
        // echo $sql;
        $res = mysqli_query($db,$sql);
            
        }

?>
