<?php $ID = isset($_GET['id_address']) ? $_GET['id_address'] : $ID; ?>
<script src="<?php echo $ASSETS_URL; ?>app/address/controller/addressController.js"></script>
<?php include "app/address/view/_menu.php"; ?>
<div class="page-inner mt--5" ng-controller="addressController" ng-init="addressShow('<?php echo $ID; ?>');">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">

				<div class="card-header">
					<div class="card-head-row card-tools-still-right">
						<h4 class="card-title">แสดงข้อมูลที่อยู่สมาชิก : {{ "#"+addressInstance.id_address }}</h4>
					</div>
				</div>

				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-show">
							<tbody>
								<tr>
									<th width="auto">อาคาร/ห้อง</th>
									<td>{{ addressInstance.build }}</td>
								</tr>
										
								<tr>
									<th width="auto">บ้านเลขที่</th>
									<td>{{ addressInstance.home_number }}</td>
								</tr>
										
								<tr>
									<th width="auto">หมู่ที่</th>
									<td>{{ addressInstance.village }}</td>
								</tr>
										
								<tr>
									<th width="auto">ถนน</th>
									<td>{{ addressInstance.road }}</td>
								</tr>
										
								<tr>
									<th width="auto">ตำบล</th>
									<td>{{ addressInstance.district }}</td>
								</tr>
										
								<tr>
									<th width="auto">อำเภอ</th>
									<td>{{ addressInstance.amphur }}</td>
								</tr>
										
								<tr>
									<th width="auto">จังหวัด</th>
									<td>{{ addressInstance.province }}</td>
								</tr>
										
								<tr>
									<th width="auto">รหัสไปรษณีย์</th>
									<td>{{ addressInstance.zipcode }}</td>
								</tr>
										
								<tr>
									<th width="auto">member_id</th>
									<td>{{ addressInstance.member_id }}</td>
								</tr>
										
							</tbody>
						</table>
					</div>

					<hr>
					<a class="btn btn-warning float-right" href="<?php echo $LINK_URL; ?>address/edit/{{ addressInstance.id_address }}/"> 
						<i class="fas fa-edit"></i>
						แก้ไขข้อมูล
					</a> 

					<button type="button" class="btn btn-danger float-right" ng-confirm-click="คุณแน่ใจว่าต้องการลบข้อมูล ใช่หรือไม่?" confirmed-click="addressDelete(addressInstance.id_address);"> 
						<i class="fas fa-trash-alt"></i> ลบข้อมูล 
					</button>
				</div>

			</div>
		</div>
	</div>
</div>