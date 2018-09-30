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
		echo "hi";
		$sql = "select dept_no,count(*) as c from current_dept_emp Group by dept_no Order by c DESC;";
		if($conn->query($sql))
		{
			echo "Query executed!"."<br>";
			$result=$conn->query($sql);
					if($result->num_rows>0){
				    	while($row=$result->fetch_assoc()){
				    		echo " dept: ".$row["dept_no"]." count: ".$row["c"]."<br>";
				    	}
			        }
				    else{
				    	echo "0 results";
					}

	}
}
	$conn->close();
?>