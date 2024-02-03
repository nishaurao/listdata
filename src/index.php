<?php
//phpinfo();
error_reporting(E_ALL ^ E_WARNING); 

include 'db_connect.php';
include 'companyController.php';

$companydata = new CompanyController;
$result = $companydata->display();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- First include jquery js -->
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.2/dist/bootstrap-table.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.2/dist/bootstrap-table.min.js"></script>




<script>
function importData() {
        var fileInput = document.getElementById("file");
        var file = fileInput.files[0];
        var isValid = true;

        // Check if a file is selected
        if (!file) {
            alert("Please select a file.");
            event.preventDefault();
            isValid = false;
            return false;
        }

        // Specify allowed file types 
        var allowedTypes = ["text/plain"];

        // Check file type
        if (!allowedTypes.includes(file.type)) {
            alert("Invalid file type. Please upload a csv file");
            isValid = false;
            event.preventDefault();
            return false;
        }
        // If all validations pass, submit the form
        if(isValid == true)
        {
            document.getElementById("upload_csv").submit();
        }
    }


function getEmailVal(val) 
    {
        var emailAddressValue =document.getElementById(val).innerHTML;
        $("#email_address").val(emailAddressValue); 
        $("#hiddenID").val(val); 
        document.getElementById('emailError').innerHTML = '';
        document.getElementById('successMessage').innerHTML = '';
        $('#edit-emp').modal('show');
    }

function modalSubmit()
    {
        var emailInput = document.getElementById('email_address').value;
        var hiddenIDInput = document.getElementById('hiddenID').value;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailRegex.test(emailInput)) {
            document.getElementById('emailError').innerHTML = '';
            submitForm(emailInput,hiddenIDInput);
            $('#edit-emp').modal('hide');
        } else {
            document.getElementById('emailError').innerHTML = 'Invalid email address';
        }
    }

function submitForm(val,hiddenIDInput)
    {

    // Ajax request to submit the form
        $.ajax({
            type: 'POST',
            url: 'editEmail.php', // Replace with the actual PHP script file for processing
            data: { email: val, id:hiddenIDInput},
            success: function(response) {
                console.log(response); // Handle the response from the PHP script
                if(response != "false")
                {
                    console.log("testing nisha");
                    document.getElementById(hiddenIDInput).innerHTML = val;
                    document.getElementById('successMessage').innerHTML = 'Email address updated successfully';
                    console.log(document.getElementById(hiddenIDInput).innerHTML);
                    $('#submitModal').modal('hide'); // Close the modal
                }
                else
                {
                    document.getElementById('emailError').innerText = response;
                }
                
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }
</script>

    
   
<body>
    <div id="wrap">
        <div class="container">
            <div class="page-header mt-3 text-center"> 
                <h1 style="color: green">EMPLOYEE LIST</h1> 
            </div> 
            <div class="row">
            <div class="col-sm-12">
                <div class="card">
                <div class="card-header font-weight-bold"><h4>Import csv file</h4></div>
                <div class="card-body">
                        <form class="form-horizontal"  action="functions.php" method="post" name="upload_csv" 
                            enctype="multipart/form-data">
                            <div class="form-group row">
                                <label for="file" class="col-sm-2 col-form-label">File</label>
                                <div class="col-sm-10">
                                <input type="file" name="file" id="file" class="input-large">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Import" class="col-sm-2 col-form-label">Import data</label>
                                <div class="col-sm-10">
                                <button type="submit" id="submit" name="Import"  onclick="importData()"; class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
            </div>
                
            <?php
              //get_all_records();
              //$con = getdb();
              //$Sql = "SELECT * FROM company";
              //$result = mysqli_query($con, $Sql); 

            ?>
            <div class="row w-100">
            <div class="col-sm-12">
            <div id="successMessage" class="text-success text-center font-weight-bold mt-3" ></div>

            <table data-toggle="table" data-search="true" data-show-columns="true"  >
                <thead>
                    <tr class="tr-class-1">
                    <th data-field="id" data-custom-attribute="id">#</th>
                    <th data-field="company_name" data-custom-attribute="company_name">Company Name</th>
                    <th data-field="employee_name" data-custom-attribute="employee_name">Employee Name</th>
                    <th data-field="email" data-custom-attribute="email">Email Address</th>
                    <th data-field="salary" data-custom-attribute="salary">Salary</th>
                    <th data-field="avg_salary" data-custom-attribute="avg_salary">AVG Salary </th>
                    <th data-field="edit" data-custom-attribute="salary">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php  if (mysqli_num_rows($result) > 0) { 
                            $arr = array();
                             while($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['COUNT_ROW']; ?></td>
                            <td><?php echo $row['COMPANY_NAME']; ?></td>
                            <td ><?php echo $row['EMP_NAME']; ?></td>
                            <td id=<?php echo $row['ID']; ?>><?php echo $row['EMAIL']; ?></td>
                            <td><?php echo $row['SALARY']; ?></td>

                            <td>
                                <?php
                                //  if (!in_array($row['COMPANY_NAME'], $arr)) { 
                                //  $expValue = explode('-',$row['AVG_SALARY']);
                                //  echo $expValue[0] ;
                                //  array_push($arr,$row['COMPANY_NAME']);

                                 //}
                                 echo $row['AVG_SALARY'];
                                 ?>
                                
                            </td>
                            <td>   
                                 <button type="button" class="btn  btn-success edit-btn " onclick="getEmailVal('<?= $row['ID']; ?>')" data-id="<?= $row['ID']; ?>">
                                 Edit
                                </button>
                            </td>
                       
                        </tr>
                    <?php } } 
                    if (mysqli_num_rows($result) == 0)
                    {
                    ?>
                        <tr  data-title="bootstrap table" >
                            <td colspan="7">No records found</td>
                    <?php } ?>
    
                </tbody>
            </table>
                    </div></div>

            <div class="modal fade" id="edit-emp" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                       
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Email</h4>
                            <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                            </button>
                        </div>
                            <div class="modal-body">
                                <div class="col-md-12">
                                <div id="emailError" class="text-danger"></div>

                                    <div class="form-group row align-items-center">
                                        <div class="col-lg-2 col-3">
                                            <label class="col-form-label" for="email_address">Email Address</label>
                                        </div>
                                        <div class="col-lg-10 col-9">
                                            <input type="text" id="email_address" class="form-control" name="email_address" value="" />
                                            <input type="hidden" id="hiddenID" class="form-control" name="hiddenID" value=""  />

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                <button type="submit" onclick="modalSubmit()";  class="btn btn-success ms-1">
                                    save
                                </button>
                            </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="mt-5"></div>
</body>
</html>
