<?php
include 'db_connect.php';
include 'companyController.php';

$db = new DatabaseConnection;


 if(isset($_POST["Import"])){
		$filename=$_FILES["file"]["tmp_name"];	
		 if($_FILES["file"]["size"] > 0)
		 {
            //$con = getdb();
			
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
                $inputData = [
                    'company_name' => mysqli_real_escape_string($db->conn,$getData[0]),
                    'emp_name' => mysqli_real_escape_string($db->conn,$getData[1]),
                    'email' => mysqli_real_escape_string($db->conn,$getData[2]),
                    'salary' => mysqli_real_escape_string($db->conn,$getData[3]),
                ];

				
                $companydata = new CompanyController;
                $result = $companydata->create($inputData);

				print_r ($result);
				 if($result == '')
				 {
				 	echo "<script type=\"text/javascript\">
				 			alert(\"Database Transaction Error.\");
				 			window.location = \"index.php\"
					  </script>";		
				 }
				 else {
				 	  echo "<script type=\"text/javascript\">
				 		alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
				 	</script>";
				 }
	         }
	         fclose($file);	
		 }
         else{
            echo "<script type=\"text/javascript\">
				 			alert(\"Invalid File:Please Upload CSV File.\");
				 			window.location = \"index.php\"
					  </script>";	
         }
	}	
    
    


 ?>