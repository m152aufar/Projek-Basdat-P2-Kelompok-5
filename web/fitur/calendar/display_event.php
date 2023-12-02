<?php           
session_start();     
require 'database_connection.php'; 
$username_now = $_SESSION['session_username'];
$display_query = "select id,nama_mata_kuliah,judul_tugas,detail_penugasan,judul_status,deadline,username from task_list WHERE username = '$username_now'";             
$results = mysqli_query($con,$display_query);   
$count = mysqli_num_rows($results); 
if($count>0) 
{
	$data_arr=array();
    $i=1;
	while($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	{	
	$data_arr[$i]['id'] = $data_row['id'];
	$data_arr[$i]['title'] = $data_row['judul_tugas'];
	$data_arr[$i]['start'] = date("Y-m-d", strtotime($data_row['deadline']));
	$data_arr[$i]['end'] = date("Y-m-d", strtotime($data_row['deadline']));
	$data_arr[$i]['color'] = '#'.substr(uniqid(),-6); // 'green'; pass colour name
	$i++;
	}
	
	$data = array(
                'status' => true,
                'msg' => 'successfully!',
				'data' => $data_arr
            );
}
else
{
	$data = array(
                'status' => false,
                'msg' => 'Error!'				
            );
}
echo json_encode($data);
?>