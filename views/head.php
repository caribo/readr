<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php if (isset( $title )): ?>
  	<?php echo $title ?> | Readr
  <?php else: ?>
  	Readr
  <?php endif; ?>
  </title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <!-- CSS: implied media=all -->
  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>res/css/style.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>res/css/south-street/jquery-ui-1.8.16.custom.css" />
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
	   echo '<a href="#mobileNav" id="mobileJump">Jump To Navigation</a>';
	}else{
	}  
  
  ?>

  <!-- end CSS-->
  <script src="<?php echo BASE_URL ?>res/js/jquery-1.6.2.min.js"></script>
  <script src="<?php echo BASE_URL ?>res/js/jquery-ui-1.8.16.custom.min.js"></script>
  <script src="<?php echo BASE_URL ?>res/js/jquery-ui-timepicker-addon.js"></script>
</head>

<body>
  <a name="top"></a>	
  <div id="container" class="clearfix">
    <header>
		
    </header>
    <?php if (!$mobile_browser > 0): ?>
    	<?php require_once('side.php'); ?>	
    <?php endif ?>
    
    <div id="main" role="main" class="clearfix">   	
    	