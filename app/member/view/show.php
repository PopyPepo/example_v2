<?php $ID = isset($_GET['id']) ? $_GET['id'] : $ID; ?>
<script src="<?php echo $ASSETS_URL; ?>app/member/controller/memberController.js"></script>
<?php include "app/member/view/_menu.php"; ?>
<div class="page-inner mt--5" ng-controller="memberController" ng-init="memberShow('<?php echo $ID; ?>');">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">

				<div class="card-header">
					<div class="card-head-row card-tools-still-right">
						<h4 class="card-title">แสดงข้อมูลสมาชิก : {{ "#"+memberInstance.id }}</h4>
					</div>
				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-show">
							<tbody>
								<tr>
									<th width="auto">ชื่อจริง</th>
									<td>{{ memberInstance.name }}</td>
								</tr>
										
								<tr>
									<th width="auto">นามสกุล</th>
									<td>{{ memberInstance.lastname }}</td>
								</tr>
										
								<tr>
									<th width="auto">เบอร์โทรศัพท์</th>
									<td>{{ memberInstance.phone }}</td>
								</tr>
										
								<tr>
									<th width="auto">อีเมล</th>
									<td>{{ memberInstance.email }}</td>
								</tr>
										
								<tr>
									<th width="auto">เพศ </th>
									<td>{{ memberGender[memberInstance.gender] }}</td>
								</tr>
										
								<tr>
									<th width="auto">วันเกิด</th>
									<td>{{ memberInstance.birthday }}</td>
								</tr>
										
							</tbody>
						</table>
					</div>

					<hr>
					<a class="btn btn-warning float-right" href="<?php echo $LINK_URL; ?>member/edit/{{ memberInstance.id }}/"> 
						<i class="fas fa-edit"></i>
						แก้ไขข้อมูล
					</a> 

					<button type="button" class="btn btn-danger float-right" ng-confirm-click="คุณแน่ใจว่าต้องการลบข้อมูล ใช่หรือไม่?" confirmed-click="memberDelete(memberInstance.id);"> 
						<i class="fas fa-trash-alt"></i> ลบข้อมูล 
					</button>
				</div>

			</div>
		</div>
	</div>
</div>