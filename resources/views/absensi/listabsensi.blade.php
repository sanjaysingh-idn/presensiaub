@extends('layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> {{ $title }}</h2>
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-6">
							<a href="/daftarabsensi">Kembali</a>
							{{-- Kode Makul : {{ $qrcode->kode_makul }}
							Nama Makul : {{ $qrcode->nama_makul }}
							Prodi : {{ $qrcode->prodi }} --}}
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive text-nowrap">
						<table id="table" class="table table-hover">
							<caption class="ms-4">

							</caption>
							<thead>
								<tr>
									<th>No</th>
									<th>Jam</th>
									<th>Nama</th>
									<th>Nim</th>
									<th>Email</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@php
									$no = 1;
								@endphp
								@foreach ($absensi as $item)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $item->jam }}</td>
										<td>{{ $item->r_mahasiswa->name }}</td>
										<td>{{ $item->r_mahasiswa->nim }}</td>
										<td>{{ $item->r_mahasiswa->email }}</td>
										<td>
											<a class="btn btn-primary btn-sm" href="/listabsen/{{ $item->id }}">
												<i class="bx bx-list-check"></i> Daftar Absen
											</a>
											<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $item->id }}"><i
													class="bx bx-card me-1"></i> Detail</button>
											<button class="btn btn-danger btn-sm" data-bs-toggle="modal"
												data-bs-target="#modalDelete{{ $item->id }}"><i class="bx bx-trash me-1"></i> Hapus</button>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('modals')

	{{-- Modal Delete --}}
	@foreach ($qrcode as $item)
		<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-danger">
						<h5 class="modal-title text-white pb-3" id="modalDeleteTitle">Hapus QR Code</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('qrcode.destroy', $item->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									Apakah anda yakin ingin menghapus QR Code ini <strong>{{ $item->id }}</strong> ?
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
								Close
							</button>
							<button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i> Hapus data</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endforeach

	{{-- Modal Detail --}}
	@foreach ($qrcode as $qrdata)
		<div class="modal fade" id="modalDetail{{ $qrdata->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-xl modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-warning pb-3">
						<h5 class="modal-title text-white" id="modalAddTitle">DETAIL QR CODE</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<!-- Tombol Scan Barcode -->

									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-4">
												<h2 class="fw-bold">{{ $qrdata->kode_makul }} - {{ $qrdata->nama_makul }}</h2>
												<p>Prodi: {{ $qrdata->prodi }}</p>
												<p>Kelas: {{ $qrdata->kelas }}</p>
												<p>Dosen: {{ $qrdata->nama_dosen }}</p>
												<p>Ruangan: {{ $qrdata->ruangan }}</p>
												<p>Hari: {{ $qrdata->hari }}</p>
												<p>Jam: {{ $qrdata->jam }}</p>
											</div>
											<div class="col-8">
												<div>
													{!! $item->qrcode !!}
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
					</div>
				</div>
			</div>
		</div>
	@endforeach
@endpush
