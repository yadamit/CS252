<?php



	$servername = "localhost";
	$username = "root";
	$password = "Garvit17";
	$db = "employees";
	$conn = new mysqli($servername, $username, $password,$db);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		echo "Connection sucessful"."<br>";
	}


	if($_SERVER["REQUEST_METHOD"]=="POST"){
		// echo "hi";
		$dept_no = $_REQUEST['dept_no'];
		$sql = "select (select count(*) from employees,current_dept_emp where employees.emp_no=current_dept_emp.emp_no and employees.gender='M' and current_dept_emp.dept_no='$dept_no')/(select count(*) from employees,current_dept_emp where employees.emp_no=current_dept_emp.emp_no and employees.gender='F' and current_dept_emp.dept_no='$dept_no') as ratio;";
		if($conn->query($sql))
		{
			echo "Query executed!"."<br>";
			$result=$conn->query($sql);
					if($result->num_rows>0){
				    	while($row=$result->fetch_assoc()){
				    		echo " dept: ".$dept_no." gender_ratio: ".$row["ratio"]."<br>";
				    	}
			        }
				    else{
				    	echo "0 results";
					}

	}
}
	$conn->close();
?>




