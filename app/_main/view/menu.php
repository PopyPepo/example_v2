<ul class="navbar-nav" ng-init="getFolder();">
	<li class="nav-item">
		<a class="nav-link" href="<?php echo $LINK_URL; ?>">หน้าแรก</a>
	</li>
	<li class="nav-item" ng-repeat="folderIns in folderInstanceList">
		<a class="nav-link" href="<?php echo $LINK_URL; ?>{{folderIns.TABLE_NAME}}/list/">
			{{ folderIns.TABLE_COMMENT ? folderIns.TABLE_COMMENT : folderIns.TABLE_NAME }}
		</a>
	</li>
</ul>

<!-- <ul class="navbar-nav">
	<li class="nav-item">
		<a class="nav-link" href="<?php // echo $LINK_URL; ?>">หน้าแรก</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php // echo $LINK_URL; ?>member/list/">จัดการข้อมูลสมาชิค</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php // echo $LINK_URL; ?>address/list/">จัดการข้อมูลที่อยู่สมาชิก</a>
	</li>
</ul> -->