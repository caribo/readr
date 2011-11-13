<?php
		$modules = $user->getModules();
?>
<div id="side">
	<h1 id="logo">Readr</h1>
	<ul id="nav" class="clearfix">
		<li><a href="<?php echo BASE_URL; ?>logout.php">Logout &raquo;</a></li>
		<li><a href="index.php">
			<span class="moduleCode"><?php echo $user->getName(); ?></span>
			<span class="moduleTitle">Course Overview</span>
		</a></li>
		<?php foreach($modules as $cmodule) { ?>
		<li><a href="index.php?action=module&id=<?php echo $cmodule->getID(); ?>">
			<span class="moduleCode"><?php echo $cmodule->getCode(); ?></span>
			<span class="moduleTitle"><?php echo $cmodule->getTitle(); ?></span>
		</a></li>
		<?php } ?>
	</ul>
</div>