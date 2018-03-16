<?php
session_start();
$data = $_POST;
$succses = false;
$form_key = 'sendmessage_form';

if ($_SESSION['crsf_' .$form_key] == $data['crsf'])
{

function defender_xss($arr){
    $filter = array("<", ">","="," (",")",";","/");  
     foreach($arr as $num=>$xss){
        $arr[$num]=str_replace ($filter, "|", $xss);
     }
       return $arr;
} 

function showReqPay()
{
	//echo print_r($_REQUEST);
	$con_str=mysql_connect('localhost', 'root', '', 'db_payment');
	/*if(mysql_connect('localhost','root'))
		echo "Hello!!";*/
	mysql_select_db('db_payment',$con_str);
	$query_str="SELECT * FROM `db_payment`.`request`";
	//echo $query_str;
	$sql = mysql_query($query_str);
	$result = array();
	while ($rows = mysql_fetch_assoc($sql))
	{
		array_push($result, $rows);
	}
	echo json_encode($result);
	
	/*foreach ($result as $val)
	{
		foreach($val as $vl)
			echo $vl;
		echo "!!!!!!!!!";
	}*/ 
	
	//echo $result;
	mysql_close();
	return json_encode($result);
}

function saveReqPay()
{
	$_REQUEST=defender_xss($_REQUEST);
	$con_str=mysql_connect('localhost', 'root', '', 'db_payment');
	//if(mysql_connect('localhost','root'))
		//echo "HHHHH!!";
	
	$regexpInn = "/([0-9]{12})|([0-9]{10})/";
	$regexpBik = "/[0-9]{9}/";
	$regexpCard = "/[0-9]{16}/";
	$regexpNds = "/0|18|10/";
	$regexpSum = "/([1-9][0-9]{3})|([1-7][1-5][0-9]{3})/";
	$regexpPhone = "/([1-9]{11})|([1-9]{5})|(+7[1-9]{10})/";
	
	mysql_select_db('db_payment',$con_str);

	$match = array();
	if (preg_match($regexpInn, $_POST["inn"], $match)) {
		$inn=$_POST["inn"]; 
	}
	$match = array();
	if (preg_match($regexpBik, $_POST["bik"], $match)) {
		$bik=$_POST["bik"];
	}
	$match = array();
	if (preg_match($regexpCard, $_POST["request-account-number"], $match)) {
		$card = $_POST ["request-account-number"];
	}
	$match = array();
	if (preg_match($regexpNds, $_POST["NDS"], $match)) {
		$nds = $_POST ["NDS"];
	}
	$match = array();
	if (preg_match($regexpSum, $_POST["how-many"], $match)) {
		$money = $_POST ["how-many"];
	}
	$match = array();
	if (preg_match($regexpSum, $_POST["phone-number"], $match)) {
		$phone= $_POST ["phone-number"];
	}

	$query_str="INSERT INTO `db_payment`.`request`(`id`, `inn`, `bik`, `card`, `nds`, `money`, `phone`, `email`) VALUES (NULL, '$inn', '$bik', '$card', '$nds', '$money', '$phone', '$email')";
	if(!mysql_query($query_str)) 
		die(mysql_error());
	mysql_query($query_str);
	mysql_close();
}
function savePay()
{
	$_REQUEST=defender_xss($_REQUEST);
	$con_str=mysql_connect('localhost', 'root', '', 'db_payment');
/*	if(mysql_connect('localhost','root'))
		echo "Hello!!"; */
	mysql_select_db('db_payment',$con_str);
	
	$regexpCard = "/[0-9]{16}/";
	$regexpMMGG = "/[01][1-9]/[1-2][0-9]/";
	$regexpCVC = "/[0-9]{3}/";
	$regexpSum = "/([1-9][0-9]{3})|([1-7][1-5][0-9]{3})/";
	$regexpComment = "/([1-9]{11})|([1-9]{5})|(+7[1-9]{10})/";
	
	$match = array();

	$inn=$_POST["inn"]; 
	
	$card=$_POST["card-number"];
	$mmgg=$_POST["mmgg"];
	$cvc = $_POST ["cvc"];
	$sum = $_POST ["amount"];
	$comm= $_POST ["comment"];
	$email= $_POST ["email"];
	$query_str="INSERT INTO `db_payment`.`payment` 
	(`id`, `Card Number`, `mmgg`, `CVC`, `Sum`, `Comment`, `email`) VALUES (NULL, '$card', '$mmgg', '$cvc', '$sum', '$comm', '$email')";
	//echo $query_str;
	mysql_query($query_str);
	mysql_close();
}

if ($_POST ["phone-number"] != '') {
	saveReqPay();
	echo 'Запрос платежа выполнен!';
} elseif ($_POST ["cvc"] != ''){
	savePay();
	echo 'Операция выполнена!';
} else {
	
}
}
else {
	echo 'Attack!';
}
?>
