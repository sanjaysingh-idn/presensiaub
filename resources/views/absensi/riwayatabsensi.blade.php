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
									<th>Dosen</th>
									<th>Hari / Jam</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								@php
									$no = 1;
								@endphp
								@foreach ($absensi as $item)
									<tr>
										<td>{{ $no++ }}</td>
										<td>
											{{ $item->r_qrcode->kode_makul }} - {{ $item->r_qrcode->nama_makul }}
										</td>
										<td>{{ $item->hari }} / {{ $item->jam }}</td>
										<td>{{ $item->status }}</td>
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
