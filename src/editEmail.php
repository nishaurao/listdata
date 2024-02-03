<?php
include 'db_connect.php';
include 'companyController.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     
    // Get form data
    $email = $_POST['email'];
    $userId = $_POST['id'];
    $companydata = new CompanyController;
    $result = $companydata->updateEmail($email, $userId);
    //$result = updateEmail($email, $userId);
    if($result)
        {
            echo "true";
        }
        else
        {
            echo "false";
        }
}
?>