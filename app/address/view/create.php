<script src="<?php echo $ASSETS_URL; ?>app/address/controller/addressController.js"></script>
<?php include "app/address/view/_menu.php"; ?>
<div class="page-inner mt--5" ng-controller="addressController" >
	<div class="row">
		<div class="col-sm-12">
			<div class="card">

				<div class="card-header">
					<div class="card-head-row card-tools-still-right">
						<h4 class="card-title">เพิ่มข้อมูลที่อยู่สมาชิก</h4>
					</div>
				</div>	

				<div class="card-body">
					<form name="addressCreate" method="post" ng-submit="addressInsert();">
						<?php include("app/address/view/_form.php"); ?>		
						<button type="reset" class="btn btn-light float-right"><i class="fas fa-broom"></i> ล้างข้อมูล</button>
					</form>
				</div>
				
			</div>
		</div>
	</div>
</div>