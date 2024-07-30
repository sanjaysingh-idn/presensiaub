<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="/dashboard" class="app-brand-link">
			<span class="app-brand-logo demo">
				<div class="logo">
					<img src="{{ asset('img') }}/logo.png" alt="Logo AUB" class="img-thumbnail" width="60">
				</div>
			</span>
		</a>

		<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1 mt-4">
		<!-- Dashboard -->
		<li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
			<a href="/dashboard" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div>Dashboard</div>
			</a>
		</li>

		@if (Auth::user()->role == 'mahasiswa')
			<li class="menu-header small text-uppercase">
				<span class="menu-header-text">Scan qr code</span>
			</li>

			<li class="menu-item {{ request()->is('scanpage*') ? 'active' : '' }}">
				<a href="{{ url('scanpage') }}" class="menu-link">
					<i class='menu-icon tf-icons bx bx-qr-scan'></i>
					<div>Scan QR Code</div>
				</a>
			</li>
		@endif

		@if (Auth::user()->role == 'dosen')
			<li class="menu-header small text-uppercase">
				<span class="menu-header-text">Generate qr code</span>
			</li>

			<li class="menu-item {{ request()->is('qrcode*') ? 'active' : '' }}">
				<a href="{{ url('qrcode') }}" class="menu-link">
					<i class='menu-icon tf-icons bx bx-qr'></i>
					<div>Generate QR Code</div>
				</a>
			</li>
		@endif

		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">Absensi</span>
		</li>

		@if (in_array(Auth::user()->role, ['mahasiswa', 'admin']))
			<li class="menu-item {{ request()->is('riwayatabsensi*') ? 'active' : '' }}">
				<a href="{{ url('/riwayatabsensi') }}" class="menu-link">
					<i class='menu-icon tf-icons bx bx-history'></i>
					<div>Riwayat Absensi</div>
				</a>
			</li>
		@endif

		@if (in_array(Auth::user()->role, ['dosen', 'admin']))
			<li class="menu-item {{ request()->is('daftarabsensi*') ? 'active' : '' }}">
				<a href="{{ url('/daftarabsensi') }}" class="menu-link">
					<i class='menu-icon tf-icons bx bx-cabinet'></i>
					<div>Daftar Absensi</div>
				</a>
			</li>
		@endif

		@if (Auth::user()->role == 'admin')
			<li class="menu-header small text-uppercase">
				<span class="menu-header-text">MASTER</span>
			</li>

			<li class="menu-item {{ request()->is('qrcode*') ? 'active' : '' }}">
				<a href="{{ url('qrcode') }}" class="menu-link">
					<i class='menu-icon tf-icons bx bx-qr'></i>
					<div>Generate QR Code</div>
				</a>
			</li>
			{{-- <li class="menu-item {{ request()->is('qrcode*') ? 'active' : '' }}">
				<a href="{{ url('qrcode') }}" class="menu-link">
					<i class='menu-icon tf-icons bx bx-qr-scan'></i>
					<div>Scan QR Code</div>
				</a>
			</li> --}}
			<li class="menu-item {{ request()->is('makul*') ? 'active' : '' }}">
				<a href="{{ url('makul') }}" class="menu-link">
					<i class='menu-icon tf-icons bx bx-book'></i>
					<div>Mata Kuliah</div>
				</a>
			</li>
			<li class="menu-item {{ request()->is('fakultas*') ? 'active' : '' }}">
				<a href="{{ url('fakultas') }}" class="menu-link">
					<i class='menu-icon tf-icons bx bxl-slack-old'></i>
					<div>Fakultas & Jurusan</div>
				</a>
			</li>
			<li class="menu-item {{ request()->is('data-mahasiswa*') ? 'active' : '' }}">
				<a href="{{ url('data-mahasiswa') }}" class="menu-link">
					<i class='menu-icon tf-icons bx bx-user-circle'></i>
					<div>Data Mahasiswa</div>
				</a>
			</li>
			<li class="menu-item {{ request()->is('data-dosen*') ? 'active' : '' }}">
				<a href="{{ url('data-dosen') }}" class="menu-link">
					<i class='menu-icon tf-icons bx bxs-user-circle'></i>
					<div>Data Dosen</div>
				</a>
			</li>
		@endif
	</ul>
</aside>
<!-- / Menu -->
