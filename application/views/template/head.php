<div class="sticky-top">
	<header class="navbar navbar-expand-md sticky-top navbar-light d-print-none">
		<div class="container-xl">
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
				<span class="navbar-toggler-icon"></span>
			</button>
			<h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
				<a href="<?= base_url() ?>">
					<img src="<?= base_url() ?>public/logo/<?= logo() ?>" width="110" height="32" alt="Logo" class="navbar-brand-image">
				</a>
				<span class="text-primary fw-bold">&nbsp Sistem Keuangan</spanc>
			</h1>
			<div class="navbar-nav flex-row order-md-last">
				
				<div class="nav-item dropdown">
					<a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
						<span class="avatar avatar-sm" style="background-image: url(<?= base_url() ?>public/logo/<?= logo() ?>)"><img src="<?= base_url() ?>public/logo/<?= logo() ?>" alt=""></span>
						<div class="d-none d-xl-block ps-2">
							<div><?= $this->session->userdata('nama_lengkap') ?></div>
							<div class="mt-1 small text-muted"><?= $this->session->userdata('email') ?></div>
						</div>
					</a>
					<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
					<a href="<?= base_url() ?>pengaturan" class="dropdown-item">Pengaturan</a>
					<a href="<?= base_url() ?>users" class="dropdown-item">Managemen User</a>
						<a href="<?= base_url() ?>auth/signout" class="dropdown-item">Logout</a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="navbar-expand-md">
		<div class="collapse navbar-collapse" id="navbar-menu">
			<div class="navbar navbar-light">
				<div class="container-xl">
					<ul class="navbar-nav">
						<li class="nav-item <?= $menu == 'dashboard' ? 'active' : '' ?>">
							<a class="nav-link" href="<?= base_url() ?>dashboard">
								<span class="nav-link-icon d-md-none d-lg-inline-block">
									<!-- Download SVG icon from http://tabler-icons.io/i/home -->
									<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none" />
										<polyline points="5 12 3 12 12 3 21 12 19 12" />
										<path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
										<path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
									</svg>
								</span>
								<span class="nav-link-title">
									Dashboard
								</span>
							</a>
						</li>
						<li class="nav-item <?= $menu == 'nasabah' ? 'active' : '' ?>">
							<a class="nav-link" href="<?= base_url() ?>nasabah">
								<span class="nav-link-icon d-md-none d-lg-inline-block">
									<!-- Download SVG icon from http://tabler-icons.io/i/users -->
									<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none" />
										<circle cx="9" cy="7" r="4" />
										<path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
										<path d="M16 3.13a4 4 0 0 1 0 7.75" />
										<path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
									</svg>
								</span>
								<span class="nav-link-title">
									Nasabah
								</span>
							</a>
						</li>
			
						<li class="nav-item <?= $menu == 'keuangan' ? 'active' : '' ?>">
							<a class="nav-link" href="<?= base_url() ?>keuangan">
								<span class="nav-link-icon d-md-none d-lg-inline-block">
									<!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
									<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none" />
										<path d="M14 3v4a1 1 0 0 0 1 1h4" />
										<path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
										<line x1="9" y1="9" x2="10" y2="9" />
										<line x1="9" y1="13" x2="15" y2="13" />
										<line x1="9" y1="17" x2="15" y2="17" />
									</svg>
								</span>
								<span class="nav-link-title">
									Transaksi
								</span>
							</a>
						</li>
						<li class="nav-item <?= $menu == 'rekap' ? 'active' : '' ?>">
							<a class="nav-link" href="<?= base_url() ?>keuangan/rekap">
								<span class="nav-link-icon d-md-none d-lg-inline-block">
									<!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
									<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-news" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11"></path>
										<line x1="8" y1="8" x2="12" y2="8"></line>
										<line x1="8" y1="12" x2="12" y2="12"></line>
										<line x1="8" y1="16" x2="12" y2="16"></line>
									</svg>
								</span>
								<span class="nav-link-title">
									Riwayat Transaksi
								</span>
							</a>
						</li>
						<li class="nav-item <?= $menu == 'Informasi' ? 'active' : '' ?>">
							<a class="nav-link" href="<?= base_url() ?>Cashflow">
								<span class="nav-link-icon d-md-none d-lg-inline-block">
									<!-- Download SVG icon from http://tabler-icons.io/i/file-text -->
									<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-news" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11"></path>
										<line x1="8" y1="8" x2="12" y2="8"></line>
										<line x1="8" y1="12" x2="12" y2="12"></line>
										<line x1="8" y1="16" x2="12" y2="16"></line>
									</svg>
								</span>
								<span class="nav-link-title">
									Informasi
								</span>
							</a>
						</li>

						
						
						
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>