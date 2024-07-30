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
					<div class="text-start">
						<button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
								class="bx bx-plus-circle"></i> Buat QR Code</button>
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
									<th>Makul</th>
									<th>Kelas</th>
									<th>Dosen</th>
									<th>Ruang</th>
									<th>Hari / Jam</th>
									<th>QR</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@php
									$no = 1;
								@endphp
								@foreach ($qr as $item)
									<tr>
										<td>{{ $no++ }}</td>
										<td>
											<p>Kode : {{ $item->kode_makul }}</p>
											<p>Makul : {{ $item->nama_makul }}</p>
											<p>Prodi : {{ $item->prodi }}</p>
										</td>
										<td>{{ $item->kelas }}</td>
										<td>{{ $item->dosen }}</td>
										<td>{{ $item->ruangan }}</td>
										<td>{{ $item->hari }} / {{ $item->jam }}</td>
										<td>
											{!! $item->qrcode !!}
										</td>
										<td>
											<button class="btn btn-info btn-sm" data-bs-toggle="modal"
												data-bs-target="#modalDetail{{ $item->id }}"><i class="bx bx-card me-1"></i> Detail</button>
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

	{{-- Modal Tambah --}}
	<div class="modal fade" id="modalAdd" tabindex="-1" aria-modal="true">
		<div class="modal-dialog modal-xs modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-success pb-3">
					<h5 class="modal-title text-white" id="modalAddTitle">Buat QR Code</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="post" action="{{ route('qrcode.generate') }}">
					@csrf
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12 mb-3">
								<label for="" class="form-label">Makul</label>
								<select class="form-select form-select-lg" name="id_makul" id="" required>
									<option value="" hidden>--Pilih Makul--</option>
									@foreach ($makul as $kelas)
										<option value="{{ $kelas->id }}">{{ $kelas->kode_makul }} - {{ $kelas->nama_makul }} -
											{{ $kelas->ruangan }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-12 mb-3">
								<label for="day" class="form-label">Hari</label>
								<input type="date" class="form-control" name="day" id="day" required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
							Close
						</button>
						<button type="submit" class="btn btn-success"><i class="bx bx-qr"></i> Buat QR Code</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- Modal Delete --}}
	@foreach ($qr as $item)
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
	@foreach ($qr as $qrdata)
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
