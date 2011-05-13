<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<?php echo $headElement ?>

<body>

	<div id="innerbody">

		<div id="sitelogo">
			<?php echo $siteLogo; ?>
		</div>

		<div id="topbar">
			<?php $topBar->render(); ?>
		</div>

		<div id="breadcrumbs">
			<?php echo $breadcrumbs; ?>
		</div>

		<div id="heading">
			<h1><?php echo $mainHeading ?></h1>
		</div>

		<div id="content">
			<?php $content->render(); ?>
		</div>

		<div id="footer">
			<?php $footer->render(); ?>
		</div>

		<div id="navbar">
			<?php $mainNav->render(); ?>
		</div>

	</div>

</body>

</html>
