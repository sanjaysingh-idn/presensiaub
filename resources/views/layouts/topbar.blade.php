<!-- Navbar -->

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
	id="layout-navbar">
	<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
		<a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
			<i class="bx bx-menu bx-sm"></i>
		</a>
	</div>

	<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
		<!-- Search -->
		{{-- <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class='bx bx-buildings fs-4 lh-0 me-2'></i>
                Sistem Perjalanan Dinas Kemendagri
            </div>
        </div> --}}
		<!-- /Search -->

		<ul class="navbar-nav flex-row align-items-center ms-auto">
			<!-- Place this tag where you want the button to render. -->
			<li class="nav-item lh-1 me-3 text-capitalize">
				{{ Auth::user()->name }}
			</li>

			<!-- User -->
			<li class="nav-item navbar-dropdown dropdown-user dropdown">
				<a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
					<div class="">
						<i class="bx bxs-caret-down-circle"></i>
						{{-- @if (Auth::user()->image)
							<img src="{{ asset('storage/' . Auth::user()->image) }}" alt="user-avatar"
								class="w-px-40 h-auto rounded-circle" />
						@else
							<img src="{{ asset('img/default-image.png') }}" alt="user-avatar" class="w-px-40 h-auto rounded-circle" />
						@endif --}}
					</div>
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					<li>
						<a class="dropdown-item" href="#">
							<div class="d-flex">
								<div class="flex-shrink-0 me-3">
									<div class="avatar avatar-online">
										{{-- @if (Auth::user()->image)
											<img src="{{ asset('storage/' . Auth::user()->image) }}" alt="user-avatar"
												class="w-px-40 h-auto rounded-circle" />
										@else
											<img src="{{ asset('img/default-image.png') }}" alt="user-avatar" class="w-px-40 h-auto rounded-circle" />
										@endif --}}
									</div>
								</div>
								<div class="flex-grow-1">
									<span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
									<small class="text-muted text-capitalize">{{ Auth::user()->role }}</small>
								</div>
							</div>
						</a>
					</li>
					<li>
						<div class="dropdown-divider"></div>
					</li>
					<li>
						<a class="dropdown-item" href="/profil/{{ Auth()->user()->id }}">
							<i class="bx bx-user me-2"></i>
							<span class="align-middle">My Profile</span>
						</a>
					</li>
					<li>
						<div class="dropdown-divider"></div>
					</li>
					<li>
						<form action="{{ route('logout') }}" method="POST">
							@csrf
							<button type="submit" class="dropdown-item">
								<i class="bx bx-power-off me-2"></i>
								<span class="align-middle">Log Out</span>
							</button>
						</form>
					</li>
				</ul>
			</li>
			<!--/ User -->
		</ul>
	</div>
</nav>

<!-- / Navbar -->
