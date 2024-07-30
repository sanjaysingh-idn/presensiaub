@extends('layouts.main')

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<!-- Tombol Scan Barcode -->
					{{-- <button class="btn btn-primary" id="scanButton">
						<i class="bx bx-qr-scan"></i>
						Scan QR Code
					</button> --}}
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-4">
							<h2 class="fw-bold">{{ $makul->kode_makul }} - {{ $makul->nama_makul }}</h2>
							<p>Prodi: {{ $makul->prodi }}</p>
							<p>Kelas: {{ $makul->kelas }}</p>
							<p>Dosen: {{ $makul->nama_dosen }}</p>
							<p>Ruangan: {{ $makul->ruangan }}</p>
							<p>Hari: {{ $day }}</p>
							<p>Jam: {{ $hour }}</p>
						</div>
						<div class="col-8">
							<div>
								{!! $qrcode !!}
							</div>
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
@endsection
