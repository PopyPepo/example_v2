<div class="form-group row">
	<label for="name" class="col-sm-2 col-form-label">ชื่อจริง <span class="text-danger">*</span> : </label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="name" name="name" ng-model="memberInstance.name" required="required">
	</div>
</div>

<div class="form-group row">
	<label for="lastname" class="col-sm-2 col-form-label">นามสกุล <span class="text-danger">*</span> : </label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="lastname" name="lastname" ng-model="memberInstance.lastname" required="required">
	</div>
</div>

<div class="form-group row">
	<label for="phone" class="col-sm-2 col-form-label">เบอร์โทรศัพท์ <span class="text-danger">*</span> : </label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="phone" name="phone" ng-model="memberInstance.phone" required="required">
	</div>
</div>

<div class="form-group row">
	<label for="email" class="col-sm-2 col-form-label">อีเมล  : </label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="email" name="email" ng-model="memberInstance.email">
	</div>
</div>

<div class="form-group row">
	<label for="gender" class="col-sm-2 col-form-label">เพศ   : </label>
	<div class="col-sm-10">
		<div class="form-check form-check-inline">
		
			<input class="form-check-input" type="radio" name="gender" ng-model="memberInstance.gender" ng-value="'1'" id="gender1">
			<label class="form-check-label" for="gender1"> : ชาย</label> &nbsp;
		
		
			<input class="form-check-input" type="radio" name="gender" ng-model="memberInstance.gender" ng-value="'2'" id="gender2">
			<label class="form-check-label" for="gender2"> : หญิง</label> &nbsp;
		
		</div>
	</div>
</div>

<div class="form-group row">
	<label for="birthday" class="col-sm-2 col-form-label">วันเกิด  : </label>
	<div class="col-sm-10">
		<input type="text" class="form-control" id="birthday" name="birthday" ng-model="memberInstance.birthday">
	</div>
</div>

<hr>
<button class="btn btn-success float-right" type="submit"><i class="fas fa-save"></i> บันทึกข้อมูล</button>