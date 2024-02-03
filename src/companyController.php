<?php



class CompanyController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function create($inputData)
    {
        $company_name = $inputData['company_name'];
        $emp_name = $inputData['emp_name'];
        $email = $inputData['email'];
        $salary = $inputData['salary'];

        $dataQuery = "INSERT INTO company (COMPANY_NAME,EMP_NAME,EMAIL,SALARY) VALUES ('$company_name','$emp_name','$email','$salary')";
       
        $result = $this->conn->query($dataQuery);

     echo $result;
        if($result){
            return  $result;
        }else{
            return  $result;
        }
    }

	public function display()
    {
        $selectQuery = "SELECT @row:=IFNULL(@row,0)+1 as COUNT_ROW,c.COMPANY_NAME,c.SALARY,c.EMP_NAME,c.EMAIL,c.ID,
						(SELECT ROUND(AVG(cp.SALARY),2) FROM company cp WHERE cp.COMPANY_NAME = c.COMPANY_NAME) as AVG_SALARY
		                FROM company c";
		                
        $result = $this->conn->query($selectQuery);
		return $result;
        // if($result){
        //     return true;
        // }else{
        //     return false;
        // }
    }

	public function updateEmail($email, $userId)
    {
		$dataQuery = "UPDATE company SET EMAIL = '$email' WHERE id=$userId";
    	$result = $this->conn->query($dataQuery);
		return $result;
        // if($result){
        //     return true;
        //  }else{
        //      return false;
        //  }
    }





}
?>