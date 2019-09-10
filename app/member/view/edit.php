<?php $ID = isset($_GET['id']) ? $_GET['id'] : $ID; ?>
<script src="<?php echo $ASSETS_URL; ?>app/member/controller/memberController.js"></script>
<?php include "app/member/view/_menu.php"; ?>
<div class="page-inner mt--5" ng-controller="memberController" ng-init="memberShow('<?php echo $ID; ?>');">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">

				<div class="card-header">
					<div class="card-head-row card-tools-still-right">
						<h4 class="card-title">แก้ไขข้อมูลสมาชิก
						<small>
							<a href="<?php echo $LINK_URL; ?>member/show/{{memberInstance.id}}/" ng-attr-title="{{ 'กลับไปหน้า แสดงข้อมูล '+memberInstance.name }}">
								<i class="fas fa-hand-point-left"></i> 
								{{ "#"+memberInstance.id }}
							</a>
						</small>
					</h4>
					</div>
				</div>	

				<div class="card-body">
					<form name="memberEdit" method="post" ng-submit="memberUpdate();">
						<?php include("app/member/view/_form.php"); ?>		
						<button type="reset" class="btn btn-light float-right"><i class="fas fa-broom"></i> ล้างข้อมูล</button>
					</form>
				</div>
				
			</div>
		</div>
	</div>
</div>