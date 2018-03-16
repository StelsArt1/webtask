<?php 
showReqPay();
function showReqPay()
{
	//echo print_r($_REQUEST);
	$con_str=mysql_connect('localhost', 'root', '', 'db_payment');
	/*if(mysql_connect('localhost','root'))
		echo "Hello!!";*/
	mysql_select_db('db_payment',$con_str);
	$query_str="SELECT * FROM `db_payment`.`payment`";
	//echo $query_str;
	$sql = mysql_query($query_str);
	$result = array();
	while ($rows = mysql_fetch_assoc($sql))
	{
		array_push($result, $rows);
	}
	
	/*foreach ($result as $val)
	{
		foreach($val as $vl)
			echo $vl;
		echo "!!!!!!!!!";
	} */
	if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{   
    $query = mysql_query("SELECT * FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysql_fetch_assoc($query);
    if(($userdata['hash'] == $_COOKIE['hash']) or ($userdata['id'] == $_COOKIE['id']))
    {
        echo json_encode($result);
    }
}
	mysql_close();
}
?>