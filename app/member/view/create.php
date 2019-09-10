<script src="<?php echo $ASSETS_URL; ?>app/member/controller/memberController.js"></script>
<?php include "app/member/view/_menu.php"; ?>
<div class="page-inner mt--5" ng-controller="memberController" >
	<div class="row">
		<div class="col-sm-12">
			<div class="card">

				<div class="card-header">
					<div class="card-head-row card-tools-still-right">
						<h4 class="card-title">เพิ่มข้อมูลสมาชิก</h4>
					</div>
				</div>	

				<div class="card-body">
					<form name="memberCreate" method="post" ng-submit="memberInsert();">
						<?php include("app/member/view/_form.php"); ?>		
						<button type="reset" class="btn btn-light float-right"><i class="fas fa-broom"></i> ล้างข้อมูล</button>
					</form>
				</div>
				
			</div>
		</div>
	</div>
</div>