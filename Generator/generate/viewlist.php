<?php
function viewlist($conn, $tableIns, $fileIns){
	
	$i = 1;
	$colIndex = array();
	$id = array();
	$table = $tableIns['TABLE_NAME'];
	$tableSql = "SELECT * FROM information_schema.TABLES WHERE TABLE_NAME='".$table."' AND TABLE_SCHEMA='".$tableIns['database']."'";
	$tableexcute = mysqli_query($conn, $tableSql);
	$tableInstanc = mysqli_fetch_object($tableexcute);

	$sqlS = "SHOW INDEX  FROM ".$table."";
	$excuteS = mysqli_query($conn, $sqlS);
	while ($instancS = mysqli_fetch_object($excuteS)){
		//print_r($instancS);
		if (isset($instancS->Column_name)){$colIndex[] = $instancS->Column_name;}
		if ($instancS->Key_name=='PRIMARY' && !$id){$id = $instancS;}
	}

	$listCol = array();
	$sql = "SHOW FULL COLUMNS FROM ".$table." WHERE Extra!='auto_increment' ";
	$excute = mysqli_query($conn, $sql);
	while ($instanc = mysqli_fetch_object($excute)){
		$instanc->Column_name = $instanc->Field;
		$listCol[] = $instanc;
	}

	$id = $id ? $id : $listCol[0];

	$txt = '';
	$init = 'ng-init="'.$table.'List();"';

	$title = "รายการข้อมูล".($tableInstanc->TABLE_COMMENT ? $tableInstanc->TABLE_COMMENT : $tableInstanc->TABLE_NAME);
	include '_herder.php';


	$sql = "SHOW FULL COLUMNS FROM ".$table." WHERE Extra!='auto_increment' ";

	$txt .= '

				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-head-bg-primary table-hover">
							<thead>
								<tr>
									<th>#</th>';
									$i=1;
									$excute = mysqli_query($conn, $sql);
									while ($instanc = mysqli_fetch_object($excute)){
										$txt .= '
									<th>'.($instanc->Comment ? $instanc->Comment : $instanc->Field).'</th>';
										if ($i>=5) break;
										$i++;
									}
								$txt .= '
									<th class="text-center"><i class="fas fa-bars"></i></th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="'.$table.' in '.$table.'InstanceList">
									<td>{{ '.$table.'.'.$id->Column_name.' }}</td>
									';
									$i=1;
									$excute = mysqli_query($conn, $sql);
									while ($instanc = mysqli_fetch_object($excute)){

										$td = '{{ '.$table.'.'.$instanc->Field.' }}';
										if (strpos($instanc->Comment, "@{")){
											$dataSpri = explode("@{", $instanc->Comment);
											$label = $dataSpri[0];
											$td = '{{ '.$table.ucfirst($instanc->Field).'['.$table.'.'.$instanc->Field.'] }}';
										}
										$txt .= '
									<td>'.$td.'</td>';
										if ($i>=5) break;
										$i++;
									}
								$txt .= '

									<td class="text-center">
										<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
											<a href="<?php echo $LINK_URL; ?>'.$table.'/show/{{'.$table.'.'.$id->Column_name.'}}/" data-toggle="tooltip" data-placement="bottom" title="แสดงข้อมูล" class="btn btn-info">
												<i class="fas fa-info-circle"></i> 
												
											</a>
											<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" ng-confirm-click="คุณแน่ใจว่าต้องการลบข้อมูล ใช่หรือไม่?" title="ลบข้อมูล" confirmed-click="'.$table.'Delete('.$table.'.'.$id->Column_name.');">
												<i class="fas fa-trash-alt"></i> 
												
											</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div class="card-footer">
					<div class="row">

						<div class="col-sm-8 form-inline" ng-show="pagination.perPage < pagination.total">
							<div ng-show="pagination.perPage < pagination.total">
								<button class="btn btn-sm btn-light" ng-click="pagination.page=1;'.$table.'List();" ng-disabled="pagination.page<=1"> 
									<i class="fas fa-angle-double-left"></i>
								</button> &nbsp;

								<button class="btn btn-sm btn-light" ng-click="pagination.page=pagination.page-1;'.$table.'List();" ng-disabled="pagination.page<=1"> 
									<i class="fas fa-angle-left"></i>
								</button>  &nbsp;

								<input class="form-control form-control-sm" type="number" ng-model="pagination.page" min="1" max="{{ pagination.total/pagination.perPage | roundup }}" ng-change="'.$table.'List();" style="text-align: center;">  &nbsp;

								<button class="btn btn-sm btn-light" ng-click="pagination.page=pagination.page+1;'.$table.'List();" ng-disabled="pagination.page>=(pagination.total/pagination.perPage | roundup)"> 
									<i class="fas fa-angle-right"></i>
								</button>  &nbsp;

								<button class="btn btn-sm btn-light" ng-click="pagination.page=(pagination.total/pagination.perPage | roundup);'.$table.'List();" 
									ng-disabled="pagination.page>=(pagination.total/pagination.perPage | roundup)"> 
									<i class="fas fa-angle-double-right"></i>
								</button>  &nbsp;
							</div>
						</div>

						<div class="col-sm-4 form-inline ml-auto">
							<div class="input-group input-group-sm input-group-flat pull-right">
								<span class="input-group-btn">
									<button class="btn btn-light btn-sm" type="button">แสดงผล</button>
								</span>
								<input type="number" class="form-control form-control-sm" type="number" id="perPage" ng-model="pagination.perPage" ng-change="'.$table.'List();" min="1" style="text-align: center;">
								<span class="input-group-btn">
									<button class="btn btn-light btn-sm" type="button">/ ผลลัพธ์ {{ pagination.total }} รายการ</button>
								</span>
							</div>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
';

	return $txt;
}
?>

