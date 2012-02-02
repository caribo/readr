<?php
require_once("objects/main.php");
	$error = "";
	if(isset($_GET["error"])) {
		if($_GET["error"] == "loginfailed") {
			$error = "Incorrect username/password";
		} 
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Readr</title>
<link href="res/css/login.css" rel="stylesheet" type="text/css" />
<?php
  
    // Detect Mobile Device
    $mobile_browser = '0';
	 
	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
	    $mobile_browser++;
	}
	 
	if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
	    $mobile_browser++;
	}    
	 
	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
	$mobile_agents = array(
	    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
	    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
	    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
	    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
	    'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
	    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
	    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
	    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
	    'wapr','webc','winw','winw','xda ','xda-');
	 
	if (in_array($mobile_ua,$mobile_agents)) {
	    $mobile_browser++;
	}
	 
	/*
	if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini') > 0) {
	    $mobile_browser++;
	}*/
	 
	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
	    $mobile_browser = 0;
	}
	 
	if ($mobile_browser > 0) {
	   echo '<link rel="stylesheet" href="'.BASE_URL.'res/css/handheld.css">';
	}else{
	}  
  
  ?>
<meta name="Keywords" content="" />
<meta name="description" content="" />
<meta name="author" content="" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
</head>

<body>
<div id="container" class="loginPage">

<div id="form">
<div id="header">
<h1 class="logo">Readr</h1>
</div>
<p class="login_error clearfix"><?php echo $error; ?></p>
<br /><br />
<form action="endpoints/login.php" method="post">
<input type="text" name="username" class="default" title="Username" style="margin-left:0;" /><br />
<div>
        <input type="text" id="password-clear" class="default" style="display: none; margin-left: 6px;" value="Password">
        <input type="password" name="password" id="password-password" class="default" style="" title=""><br><br>
</div>
<input type="submit" class="submit" value="Login" />
</form>
</div>

</div>

        <script type="text/javascript">
         $(document).ready(function(){
          $('.default').each(function(){
            var defaultVal = $(this).attr('title');
            $(this).focus(function(){
              if ($(this).val() == defaultVal){
                $(this).removeClass('active').val('');
              }
            })
            .blur(function(){
              if ($(this).val() == ''){
                $(this).addClass('active').val(defaultVal);
              }
            })
            .blur().addClass('active');
          });
          $('form').submit(function(){
            $('.default').each(function(){
              var defaultVal = $(this).attr('title');
              if ($(this).val() == defaultVal){
                $(this).val('');
              }
            });
          });
        });
        
        $('#password-clear').show();
            $('#password-password').hide();
            
            $('#password-clear').focus(function() {
                $('#password-clear').hide();
                $('#password-password').show();
                $('#password-password').focus();
            });
            $('#password-password').blur(function() {
                if($('#password-password').val() == '') {
                    $('#password-clear').show();
                    $('#password-password').hide();
                }
            });
        </script>
</body>

</html>
