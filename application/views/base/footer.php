			<div id="show" class="modal" style="width:30%">
				<div class="modal-content">
				</div>
				<div class="modal-footer">
					<button onclick="resetdata()" id="ok" class="btn yellow waves-effect waves-light modal-action modal-close" style="margin-right:5%"><i class="mdi-action-done"></i> OK</button>
				</div>
			</div>

		</div>
	</div>
</div>



<script type="text/javascript" src="<?php echo asset_url()."js/jquery-1.11.1.min.js"; ?> "></script>
<script type="text/javascript" src="<?php echo asset_url()."js/materialize.min.js"; ?> "></script>
<script type="text/javascript" src="<?php echo asset_url()."js/offcanvas.js"; ?> "></script>
<?php
if (isset($scripts)) {
  foreach ($scripts as $index => $script) {
    ?>
    <script type="text/javascript" src="<?php echo asset_url()."js/".$script; ?>"></script>
    <?php
  }
}
?>