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
		<div class="col blue lighten-5 center-align z-depth-2 s12 grid-example false-click">
			<h4>RATINGS</h4>
			<div class="row">
				<div class="input-field col s10 offset-s1">
					<input id="username" type="text" class="validate">
					<label for="username">Username</label>
				</div>
			</div>