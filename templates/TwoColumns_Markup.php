<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<?php $this->renderHead(); ?>

<body>

	<div id="innerbody">

		<div id="sitelogo">
			<?php echo $this->siteLogo; ?>
		</div>

		<div id="topbar">
			<?php $this->topBarController->renderView(); ?>
		</div>

		<div id="breadcrumbs">
			<?php echo $this->breadcrumbs; ?>
		</div>
	
		<div id="heading">
			<h1><?php echo $this->pageHeading; ?></h1>
		</div>
	
		<div id="content">
			<?php $this->contentColumnController->renderView(); ?>
		</div>
	
		<div id="footer">
			<?php echo $this->footer; ?>
		</div>

		<div id="navbar">
			<?php $this->navbarColumnController->renderView(); ?>
		</div>
	
	</div>

</body>

</html>
