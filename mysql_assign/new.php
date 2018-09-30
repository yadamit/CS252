<html> 
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    Id: <input type="text" name="emp_no" >
    First Name: <input type="text" name="first_name">
    Department: <input type="text" name="dept_name"> 
    <input type="submit">

</form>

<form method="post" action="count.php">
    <input type="submit">
</form>

<form method="post" action="gender.php">
    For gender Ratio, click here:<br>
    Department_no. : <input type="text" name="dept_no">
    <input type="submit">
</form>

<form method="post" action="pay_ratio.php">
    For gender-pay Ratio, click here:<br>
    Department_no. : <input type="text" name="dept_no">
    <input type="submit">
</form>

    
 <?php
 if($_SERVER["REQUEST_METHOD"]=="POST"){
    $emp_no = $_REQUEST['emp_no'];
    $first_name = $_REQUEST['first_name'];
    $dept_name = $_REQUEST['dept_name'];
    if(empty($emp_no) && empty($first_name) && empty($dept_name)){
        echo "Query is empty";
    }
    
    else if(!empty($dept_name)){
        if(empty($emp_no) && empty($first_name)){
            $sql = "SELECT * FRom employees, current_dept_emp where employees.emp_no = current_dept_emp.emp_no and current_dept_emp.dept_no = '$dept_name' LIMIT 40";
        }
        else if(!empty($emp_no) && empty($first_name)){
            $sql = "SELECT * FRom employees, current_dept_emp where employees.emp_no = current_dept_emp.emp_no and current_dept_emp.dept_no = '$dept_name' and employees.emp_no='$emp_no' LIMIT 40";
        }
        else if(empty($emp_no) && !empty($first_name)){
            $sql = "SELECT * FRom employees, current_dept_emp where employees.emp_no = current_dept_emp.emp_no and current_dept_emp.dept_no = '$dept_name' and employees.first_name='$first_name' LIMIT 40";
        }
        else if(!empty($emp_no) && !empty($first_name) ){
            $sql = "SELECT * FRom employees, current_dept_emp where employees.emp_no = current_dept_emp.emp_no and employees.emp_no='$emp_no' and employees.first_name='$first_name' and current_dept_emp.dept_no = '$dept_name' LIMIT 40";
        }
        //$sql = "SELECT * FRom employees where emp_no='$emp_no'or first_name='$first_name' LIMIT 40";
    else if(empty($dept_name)){
        if(empty($emp_no) || empty($first_name)){
            $sql = "SELECT * FRom employees where emp_no='$emp_no'or first_name='$first_name' LIMIT 40";
        }
        else{
            $sql = "SELECT * FRom employees where emp_no='$emp_no' and first_name='$first_name' LIMIT 40";
        }
    }


    }
    else if(!empty($emp_no) && !empty($first_name) && !empty($dept_name)){
        $sql = "SELECT * FRom employees, current_dept_emp where employees.emp_no = current_dept_emp.emp_no and employees.emp_no='$emp_no' and employees.first_name='$first_name' and current_dept_emp.dept_no = '$dept_name' LIMIT 40";
    }
    
 }
 
$servername = "localhost";
$username = "root";
$password = "Garvit17";
$db = "employees";

echo "Welcome to employees database"."<br>";
// Create connection
$conn = new mysqli($servername, $username, $password,$db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 else
{
    echo "Connection sucessful"."<br>";
}

// Query execution
// $sql = "SELECT * FRom employees where emp_no='$emp_no'or first_name='$first_name' LIMIT 40";
if ($conn->query($sql)) {
    echo "Query executed!"."<br>";
    $result=$conn->query($sql);

    if($result->num_rows>0){
    	while($row=$result->fetch_assoc()){
    		echo " id: ".$row["emp_no"]." -Name: ".$row["first_name"]." -BithDate: ".$row["birth_date"]." -Hire_date: ".$row["hire_date"]."<br>";
    	}
        }
    else{
    	echo "0 results";
    }	
    
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
?> 

</body>

</html>