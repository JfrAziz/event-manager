<nav id="navbar" class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
	<div class="container-fluid d-flex flex-column p-0">

		<a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
			<div class="sidebar-brand-icon">
				<img class="logo" src="https://dummyimage.com/300x100">
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

			<?php if (!is_admin()) : ?>
				<hr class="sidebar-divider">
				<div class="sidebar-heading">
					<p class="mb-0">EVENTS</p>
				</div>
				<li class="nav-item" role="presentation">
					<a class="nav-link" href="<?= base_url("/member/certificate") ?>">
						<i class="fab fa-wpforms"></i><span class="ml-md-1">All Events</span>
					</a>
					<a class="nav-link" href="<?= base_url("/member/mail") ?>">
						<i class="fas fa-medal"></i><span class="ml-md-1">My Certificate</span>
					</a>
				</li>
			<?php endif; ?>

			<?php if (is_admin()) : ?>
				<hr class="sidebar-divider">

				<div class="sidebar-heading">
					<p class="mb-0">MEDIA & MARKETING</p>
				</div>
				<li class="nav-item" role="presentation">
					<a class="nav-link" href="<?= base_url("/member/certificate") ?>">
						<i class="fas fa-medal"></i><span class="ml-md-1">Certificate Generator</span>
					</a>
					<a class="nav-link" href="<?= base_url("/member/mail") ?>">
						<i class="fas fa-mail-bulk"></i><span class="ml-md-1">Bulk Mailer</span>
					</a>
					<a class="nav-link" href="<?= base_url("/member/mail/list") ?>">
						<i class="fas fa-list"></i><span class="ml-md-1">Update Mailing List</span>
					</a>
				</li>

				<hr class="sidebar-divider">

				<div class="sidebar-heading">
					<p class="mb-0">Events</p>
				</div>
				<li class="nav-item" role="presentation">
					<a class="nav-link" href="<?= base_url("/member/form") ?>">
						<i class="fab fa-wpforms"></i><span class="ml-md-1">Form Generator</span>
					</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" href="<?= base_url("/member/form/reg") ?>">
						<i class="fa fa-eye"></i><span class="ml-md-1">View Registration</span>
					</a>
				</li>
		</ul>
	<?php endif; ?>

	<div class="text-center d-none d-md-inline">
		<button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
	</div>
	</div>
</nav>