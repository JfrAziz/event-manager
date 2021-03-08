<?php

use Apps\Lib\Database;

$displayCircles = [
	'normal'  => '<div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>',
	'success' => '<div class="bg-success icon-circle"><i class="fas fa-crosshairs text-white"></i></div>',
	'info'    => '<div class="bg-success icon-circle"><i class="fas fa-info-circle text-white"></i></div>',
	'warning' => '<div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>'
];

$alertCount = 0;
$readReamining = "";

$navConn = (new Database())->connect();
$retAlertsSQL = $navConn->prepare('select notification.timestamp, notification.user, notification.message, notification.type, notification.clickURL, login.imgsrc from notification, login where notification.user=login.LoginName order by notification.id desc limit 3;');
$retAlertsSQL->execute();
$alertSQLResults  = $retAlertsSQL->fetchAll(PDO::FETCH_ASSOC);

foreach ($alertSQLResults as $rowAlert) {
	$alertArray[$alertCount]["timestamp"] = $rowAlert["timestamp"];
	$alertArray[$alertCount]["user"]      = $rowAlert["user"];
	$alertArray[$alertCount]["message"]   = $rowAlert["message"];
	$alertArray[$alertCount]["type"]      = $rowAlert["type"];
	$alertArray[$alertCount]["clickURL"]  = $rowAlert["clickURL"];
	$alertArray[$alertCount]["imgsrc"]    = $rowAlert["imgsrc"];
	$alertCount++;
}

$navConn = null;
$retAlertsSQL = null;

?>

<nav id="navbar" class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
	<div class="container-fluid d-flex flex-column p-0">

		<a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
			<div class="sidebar-brand-icon">
				<img class="logo" src="https://dummyimage.com/1035x365">
			</div>
			<div class="sidebar-brand-text mx-3"></div>
		</a>

		<hr class="sidebar-divider my-0">

		<ul class="nav navbar-nav text-light" id="accordionSidebar">
			<li class="nav-item" role="presentation">
				<a class="nav-link" href="<?= base_url("/member/dashboard") ?>">
					<i class="fas fa-tachometer-alt"></i><span>Dashboard</span>
				</a>
			</li>

			<hr class="sidebar-divider">

			<div class="sidebar-heading">
				<p class="mb-0">Media &amp; marketing</p>
			</div>
			<li class="nav-item" role="presentation">
				<a class="nav-link" href="<?= base_url("/member/certificate") ?>">
					<i class="fas fa-medal"></i><span>Certificate Generator</span>
				</a>
				<a class="nav-link" href="<?= base_url("/member/mail") ?>">
					<i class="fas fa-mail-bulk"></i><span>Bulk Mailer</span>
				</a>
				<a class="nav-link" href="<?= base_url("/member/mail/list") ?>">
					<i class="fas fa-list"></i><span>Update Mailing List</span>
				</a>
			</li>

			<hr class="sidebar-divider">

			<div class="sidebar-heading">
				<p class="mb-0">Events</p>
			</div>
			<li class="nav-item" role="presentation">
				<a class="nav-link" href="<?= base_url("/member/form") ?>">
					<i class="fab fa-wpforms"></i><span>Form Generator</span>
				</a>
			</li>
			<!-- <li class="nav-item" role="presentation">
				<a class="nav-link" href="<?= base_url("/member/link-short") ?>">
					<i class="fas fa-link"></i><span>Link Shortner</span>
				</a>
			</li> -->
			<li class="nav-item" role="presentation">
				<a class="nav-link" href="<?= base_url("/member/form/reg") ?>">
					<i class="fa fa-eye"></i><span>View Registration</span>
				</a>
			</li>

			<hr class="sidebar-divider">

			<!-- <div class="sidebar-heading">
				<p class="mb-0">Admin Stuff</p>
			</div>
			<li class="nav-item" role="presentation">
				<a class="nav-link" href="/members/db-manage.php">
					<i class="fas fa-database"></i><span>Maintenance</span>
				</a>
			</li>
			<hr class="sidebar-divider"> -->
		</ul>

		<div class="text-center d-none d-md-inline">
			<button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
		</div>
	</div>
</nav>
