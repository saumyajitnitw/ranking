<link href="<?php echo asset_url()."css/materialize.min.css" ?>" rel="stylesheet">

<?php
if (isset($css)) {
	foreach ($css as $index => $c) {
		?>
		<link href="<?php echo asset_url()."css/".$c; ?>" rel="stylesheet">
		<?php
	}
}
?>


<div class="container">
	<div class="row">
		<div class="col center-align z-depth-2 s6 offset-s3 grid-example">
			<h4>RANKINGS</h4>