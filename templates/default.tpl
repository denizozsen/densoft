<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

<?php echo $this->headElement ?>

<body>

	<div id="innerbody">

		<div id="sitelogo">
			<?php $this->logo->render() ?>
		</div>

		<div id="topbar">
			<?php $this->topBar->render() ?>
		</div>

		<div id="breadcrumbs">
			<?php $this->breadCrumbs->render() ?>
		</div>

		<div id="heading">
			<h1><?php $this->heading->render() ?></h1>
		</div>

		<div id="content">
			<?php $this->content->render() ?>
		</div>

		<div id="footer">
			<?php $this->footer->render() ?>
		</div>

		<div id="navbar">
			<?php $this->mainNav->render() ?>
		</div>

	</div>

</body>

</html>
