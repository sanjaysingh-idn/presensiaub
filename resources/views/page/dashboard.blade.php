@extends('layouts.main')

@section('content')
	<div class="row">
		<div class="col-12 mb-4 order-0">
			<div class="card">
				<div class="d-flex align-items-end row">
					<div class="col-sm-7">
						<div class="card-body">
							<h5 class="card-title text-primary">Selamat Datang</h5>
							<p>
								<small><i class="bx bx-user"></i> {{ Auth::user()->name }} - {{ Auth::user()->role }}</small>
							</p>
							<p class="mb-4">
								Ini adalah halaman dashboard <strong>Sistem Informasi Presensi Mahasiswa</strong> Universitas Dharma AUB
							</p>
						</div>
					</div>
					<div class="col-sm-5 text-center text-sm-left">
						<div class="card-body pb-0 px-0 px-md-4">
							<img src="{{ asset('template') }}/assets/img/illustrations/man-with-laptop-light.png" height="140"
								alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
								data-app-light-img="illustrations/man-with-laptop-light.png" />
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				{{-- QR Code Scanner --}}
				<div id="qr-reader" style="width:300px;"></div>
				<div id="qr-reader-results"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			@if (Auth::user()->role == 'admin')
				<div class="row">
					<div class="col-sm-6 col-md-3 mb-4">
						<div class="card rounded">
							<div class="card-body bg-primary text-white">
								<span class="fw-semibold d-block mb-1">
									<i class='bx bx-user'></i> Jumlah Dosen
								</span>
								<h2 class="card-title mb-2 fw-bold text-white my-4">
									{{ $dosen }}
								</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3 mb-4">
						<div class="card rounded">
							<div class="card-body bg-success text-white">
								<span class="fw-semibold d-block mb-1">
									<i class='bx bx-group'></i> Jumlah Mahasiswa
								</span>
								<h2 class="card-title mb-2 fw-bold text-white my-4">
									{{ $mahasiswa }}
								</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3 mb-4">
						<div class="card rounded">
							<div class="card-body bg-light ">
								<span class="fw-semibold d-block mb-1">
									<i class='bx bx-group'></i> Jumlah Fakultas
								</span>
								<h2 class="card-title mb-2 fw-bold  my-4">{{ $fakultas }}</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3 mb-4">
						<div class="card rounded">
							<div class="card-body bg-dark text-white">
								<span class="fw-semibold d-block mb-1">
									<i class='bx bx-group'></i> Jumlah Jurusan
								</span>
								<h2 class="card-title mb-2 fw-bold text-white my-4">{{ $jurusan }}</h2>
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
@endsection
