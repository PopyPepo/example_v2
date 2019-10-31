<?php 
$txt .= '<script src="<?php echo $ASSETS_URL; ?>app/'.$table.'/controller/'.$table.'Controller.js"></script>
<?php include "app/'.$table.'/view/_menu.php"; ?>
<div class="page-inner mt--5" ng-controller="'.$table.'Controller" '.$init.'>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">

				<div class="card-header">
					<div class="card-head-row card-tools-still-right">
						<h4 class="card-title">'.$title.'</h4>
					</div>
				</div>'; 

			$boxL = '		
						<button type="reset" class="btn btn-light float-right"><i class="fas fa-broom"></i> ล้างข้อมูล</button>
					</form>
				</div>
				
			</div>
		</div>
	</div>
</div>';
?>