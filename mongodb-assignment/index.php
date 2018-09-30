<?php
	
	require_once('./mongodbdatabase.php');

	$db = new MongodbDatabase;

	
	echo '<div>'."The District with max cases is ".$db->max_district_cases().'</div>';
    echo '<div>'."The Police Station with max Pending cases is ".$db->find_most_inefficient_ps().'</div>';
    echo '<div>'."The law which has been applied most no. of times is ".$db->most_crime_laws_applied().'</div>';
    echo '<div>'."The law which has been applied least number of times is ".$db->least_crime_laws_applied().'</div>';

	
	
 	exit();

?>

<!DOCTYPE html>
<html>
<body>

<?php
echo "My first PHP script!";
?>

</body>
</html>
