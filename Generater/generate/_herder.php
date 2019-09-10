<?php 
$txt .= '<script src="<?php echo $ASSETS_URL; ?>app/'.$table.'/controller/'.$table.'Controller.js"></script>
<div ng-controller="'.$table.'Controller" '.$init.'>
	<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">'.$title.'</h1>
		<div class="btn-toolbar mb-2 mb-0 d-sm-block" role="toolbar">
			<div class="btn-group mr-2" role="group">
				<?php include "app/'.$table.'/view/_menu.php"; ?>
			</div>
		</div>
	</div>'; 


$boxL = '		
		<button type="reset" class="btn btn-light float-right"><i class="fas fa-broom"></i> ล้างข้อมูล</button>
	</form>
</div>'
?>