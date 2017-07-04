<?php 
header("Content-type:text/html;charset=utf8");
session_start();//创建新会话
    if(isset($_POST['username'])) {
            $username = addslashes($_POST['username']);
            //给字符串添加反斜杠，防止输入的value带有特殊符号
            $password = addslashes($_POST['password']);
            $link=mysql_connect("localhost","root","root") or die("连接数据库失败".mysql_errno());
            mysql_select_db("blong");
            mysql_set_charset("utf8");

            $sql = "select * from blong_admin where username = '".$username."' limit 1";
            $result = mysql_query($sql);
            $row = mysql_fetch_array($result);
            if($row) {
                $sql1 = "select a.*,b.nickname from blong_admin a left join blong_person b on a.information = b.person_id where a.id = {$row['id']} limit 1";
                $result1 = mysql_query($sql1);
                $row1 = mysql_fetch_array($result1);
                if($row1) {
                    if($row1['password'] == $password){
                        $_SESSION['id'] = $row1['id'];
                        $_SESSION['username'] = $row1['$username'];         
                        $_SESSION['nickname'] = $row1['nickname'];          
                        header("location:main.html");
                    } else {
                        echo '<script>alert("密码错误");history.back();</script>';
                    }
                } 
            } else {
                echo '<script>alert("用户名错误");history.back();</script>';
            }
        mysql_close($link);//关闭数据
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/skin_/login.css" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.select.js"></script>
<title>办公后台管理_用户登录</title>
</head>

<body>
<div id="container">
    <div id="bd">
    	<div id="main">
        	<div class="login-box">
                <div id="logo"></div>
                <h1></h1>
                <form action="" method="post">
                <div class="input username" id="username">
                    <label for="userName">用户名</label>
                    <span></span>
                    <input type="text" id="userName" name="username" />
                </div>
                <div class="input psw" id="psw">
                    <label for="password">密&nbsp;&nbsp;&nbsp;&nbsp;码</label>
                    <span></span>
                    <input type="password" id="password" name="password" />
                </div>
                <div class="input validate" id="validate">
                    <label for="valiDate">验证码</label>
                    <input type="text" id="valiDate" />
                    <div class="value">X3D5</div>
                </div>
                <div class="styleArea">
                    <div class="styleWrap">
                        <select name="style">
                            <option value="默认风格">默认风格</option>
                            <option value="红色风格">红色风格</option>
                            <option value="绿色风格">绿色风格</option>
                        </select>
                    </div>
                </div>
                <div id="btn" class="loginButton">
                    <input type="submit" class="button" value="登录"  />
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
<script type="text/javascript">
	var height = $(window).height() > 445 ? $(window).height() : 445;
	$("#container").height(height);
	var bdheight = ($(window).height() - $('#bd').height()) / 2 - 20;
	$('#bd').css('padding-top', bdheight);
	$(window).resize(function(e) {
        var height = $(window).height() > 445 ? $(window).height() : 445;
		$("#container").height(height);
		var bdheight = ($(window).height() - $('#bd').height()) / 2 - 20;
		$('#bd').css('padding-top', bdheight);
    });
	$('select').select();
	
	// $('.loginButton').click(function(e) {
 //        document.location.href = "main.html";
 //    });
</script>

</html>
