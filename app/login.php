<?
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];  
    }
    return $code;
}
function defender_xss($arr){
    $filter = array("<", ">","="," (",")",";","/");  
     foreach($arr as $num=>$xss){
        $arr[$num]=str_replace ($filter, "|", $xss);
     }
       return $arr;
} 
$_REQUEST=defender_xss($_REQUEST);
$con_str=mysql_connect('localhost', 'root', '', 'db_payment');
	/*if(mysql_connect('localhost','root'))
		echo "Hello!!";*/
mysql_select_db('db_payment',$con_str);
if(isset($_POST['submit']))
{
    $query = mysql_query("SELECT id, password FROM users WHERE login='".mysql_real_escape_string($_POST['login'])."' LIMIT 1");
    $data = mysql_fetch_assoc($query);
    if($data['password'] === md5(md5($_POST['password'])))
    {
	    $hash = md5(generateCode(10));
        mysql_query("UPDATE users SET hash='".$hash." WHERE id='".$data['id']."'");
        setcookie("id", $data['id'], time()+60*10, $httponly=TRUE);
        setcookie("hash", $hash, time()+60*10, $httponly=TRUE);
        header("Location: check.php"); exit();
    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
?>
