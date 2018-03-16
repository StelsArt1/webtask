<?
$con_str=mysql_connect('localhost', 'root', '', 'db_payment');
	/*if(mysql_connect('localhost','root'))
		echo "Hello!!";*/
mysql_select_db('db_payment',$con_str);
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{   
    $query = mysql_query("SELECT * FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysql_fetch_assoc($query);

    if(($userdata['hash'] !== $_COOKIE['hash']) or ($userdata['id'] !== $_COOKIE['id']))
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        print "Вы авторизованы";
    }
    else
    {
        print "Привет, ".$userdata['login']."!";
		echo "<a href=http://test2.ru/app/#/list> Перейти в управление</a>";
    }
}
else
{
    print "Включите куки";
}
?>