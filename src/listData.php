<?php
//phpinfo();=
include 'db_connect.php';

function get_all_records(){
    $con = getdb();
    $Sql = "SELECT * FROM company";
    $result = mysqli_query($con, $Sql);  


    if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead><tr><th>ID</th>
                          <th>Company Name</th>
                          <th>Employee Name</th>
                          <th>Email Address</th>
                          <th>Salary</th>
                        </tr></thead><tbody>";

     while($row = mysqli_fetch_assoc($result)) {
         echo "<tr><td>" . $row['ID']."</td>
                   <td>" . $row['COMPANY_NAME']."</td>
                   <td>" . $row['EMP_NAME']."</td>
                   <td>" . $row['EMAIL']."</td>
                   <td>" . $row['SALARY']."</td></tr>";        
     }
    
     echo "</tbody></table></div>";
     
} else {
     echo "you have no records";
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- First include jquery js -->
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
</head>


<body>
    <div id="wrap">
        <div class="container">
            <div class="row" style="margin-top:55px !important;">
                <div class="card">
                    <div class="card-body ">
                <form class="form-horizontal"  action="functions.php" method="post" name="upload_excel" 
                enctype="multipart/form-data">
                    <fieldset>
                        <!-- Form Name -->
                        <legend>List Data</legend>



                        <div class="card">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>


                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                            <div class="col-md-4">
                                <button type="submit" id="submit" name="Import"  class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            </div></div>
            <?php
               get_all_records();
            ?>
        </div>
    </div>
</body>
</html>