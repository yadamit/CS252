<?php
 

 	require_once('./vendor/autoload.php');


 	class mongodbDatabase{

 			function __construct()
 			{
 				$this->db = ( new MongoDB\Client )->cases->police_cases;
 			
 			// public function insertNewItem( $itemInfo = [])
 			// {
 			// // 	if(empty( $itemInfo)){
 			// // 		return false;

 			// // 	}
 			// // 	$insertable = $this->db->insertOne([
 			// // 	'videoTitle' => $itemInfo['videoTitle'],
 			// // 	'videoLink' => $itemInfo['videoLink'],
 			// // 	'videoID'  => $itemInfo['videoID'],
 			// // 	'videoArtist' => $itemInfo['videoArtist']
 			// // ]
 			// // );
 			// return $insertable->getinsertedId();	
 			}

 			public function max_district_cases(){
 				$result = $this->db->distinct("DISTRICT");
 				$max = 0;
 				$ps = '';
 				foreach ($result as $entry)
 				{
 					$dt = $this->db->count(array('DISTRICT' => $entry));

 					if($dt > $max)
 					{
 						$max = $dt;
 						$ps = $entry;
 					}
 				}
 				//$X;
 				// $x->D = $PS;
 				return $ps;

 				// return $this->db->find();
 			}


 			public function find_most_inefficient_ps(){
 				$result1 = $this->db->distinct("PS");
 				

 				//$result2 = $this->db->distinct("PS",array('Status' => "Pending"));
 			 	$max2 = 0;
 			 	$ps2 = '';
 			 	foreach($result1 as $entry2){
 			 		$dt1 = $this->db->count(array('PS' => $entry2));

 			 		$dt2 = $this->db->count(array('PS' => $entry2 , 'Status' => "Pending"));


 					if( $dt2/$dt1 > $max2){
 			 			$max2 = $dt2/$dt1;
 			 			$ps2 = $entry2;
 			 		}
 			 		
 			 	}
 			 	return $ps2;
 				 
 			}
 			public function most_crime_laws_applied(){
 				$result = $this->db->distinct("Act_Section");
 				$max=0;
 				$law='';

 				foreach($result as $entry){
 					$dt = $this->db->count(array('Act_Section' => $entry));
 					if($dt > $max)
 					{
 						$max = $dt;
 						$law = $entry;
 					}

 				}
 				return $law;
 			}
 			public function least_crime_laws_applied(){
 				$result = $this->db->distinct("Act_Section");
 				$min=11111;
 				$law='';

 				foreach($result as $entry){
 					$dt = $this->db->count(array('Act_Section' => $entry));
 					if($dt < $min)
 					{
 						$max = $dt;
 						$law = $entry;
 					}

 				}
 				return $law;
 			}
 			
 			// db.police_cases.group({key:{PS:1},cond:{Status:"Pending"}, reduce: function(curr, result){result.count++;}, initial:{count:0}, finalize:function(result){}})

 	}
