<nav id="navbar" class="navbar align-items-start sidebar sidebar-dark navigation p-0">
	<div class="container-fluid d-flex flex-column p-0">

		<a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0 px-0" href="#">
			<div class="sidebar-brand-text">Manajemen Acara</div>
		</a>

		<hr class="sidebar-divider my-0">

		<ul class="nav navbar-nav text-light" id="accordionSidebar">
			<li class="nav-item" role="presentation">
				<a class="nav-link" href="<?= base_url("/member/dashboard") ?>">
					<div class="<?= ($dashboard) ? 'active-sideBar' : ''; ?>">
						<i class="fas mr-2 fa-tachometer-alt"></i><span>Dasbor</span>
					</div>
				</a>
			</li>

			<hr class="sidebar-divider">
			<div class="sidebar-heading">
				<p class="mb-0">ACARA</p>
			</div>
			<li class="nav-item" role="presentation">
				<a class="nav-link" href="<?= base_url("/member/event") ?>">
					<div class="<?= ($allEvent) ? 'active-sideBar' : ''; ?>">
						<i class="fab fa-wpforms"></i><span class="ml-md-1">Semua Acara</span>
					</div>
				</a>
				<a class="nav-link" href="<?= base_url("/member/certificate") ?>">
					<div class="<?= ($myEvent) ? 'active-sideBar' : ''; ?>">
						<i class="fas fa-medal"></i><span class="ml-md-1">Acara Saya</span>
					</div>
				</a>
			</li>
			<hr class="sidebar-divider">

			<div class="sidebar-heading">
				<p class="mb-0">MEDIA</p>
			</div>
			<li class="nav-item" role="presentation">
				<a class="nav-link" href="<?= base_url("/member/mail") ?>">
					<div class="<?= ($bulkMailer) ? 'active-sideBar' : ''; ?>">
						<i class="fas fa-mail-bulk"></i><span class="ml-md-1">Email Massal</span>
					</div>
				</a>
			</li>

			<hr class="sidebar-divider">

			<div class="sidebar-heading">
				<p class="mb-0">pengolahan acara</p>
			</div>
			<li class="nav-item" role="presentation">
				<a class="nav-link" href="<?= base_url("/member/form") ?>">
					<div class="<?= ($eventMaker) ? 'active-sideBar' : ''; ?>">
						<i class="fab fa-wpforms"></i><span class="ml-md-1">Pembuatan Acara</span>
					</div>
				</a>
			</li>
			<li class="nav-item" role="presentation">
				<a class="nav-link" href="<?= base_url("/member/form/reg") ?>">
					<div class="<?= ($reg) ? 'active-sideBar' : ''; ?>">
						<i class="fa fa-eye"></i><span class="ml-md-1">Lihat Pendaftar</span>
					</div>
				</a>
			</li>
		</ul>

		<div class="text-center d-none d-md-inline">
			<button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
		</div>
	</div>
</nav>