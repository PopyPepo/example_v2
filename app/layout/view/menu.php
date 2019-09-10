<ul class="navbar-nav" ng-init="getFolder();">
	<li class="nav-item">
		<a class="nav-link" href="<?php echo $LINK_URL; ?>">{{ massages.default.home }}</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?php echo $LINK_URL; ?>member/">
			<i class="fas fa-book"></i>
			member
		</a>
	</li>
	
	<li class="nav-item">
		<a class="nav-link" href="<?php echo $LINK_URL; ?>address/">
			<i class="fas fa-book"></i>
			address
		</a>
	</li>
	<li class="nav-item" ng-repeat="folderIns in folderInstanceList">
		<a class="nav-link" href="<?php echo $LINK_URL; ?>{{folderIns.TABLE_NAME}}/list/">
			{{ folderIns.TABLE_COMMENT ? folderIns.TABLE_COMMENT : folderIns.TABLE_NAME }}
		</a>
	</li>

	<li class="nav-item dropdown text-uppercase">
		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		{{LANG}}
		</a>
		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<a class="dropdown-item" href="javascript:;" ng-repeat="la in languageList | filter: '!'+LANG " ng-click="setLang(la);">{{la}}</a>
		</div>
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