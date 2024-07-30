@extends('layouts.main')

@section('content')
	<div class="row">
		<h2 class="fw-bold"><span class="text-muted fw-light py-5"></span> {{ $title }}</h2>
		<div class="col-md-4 mb-3">
			<div class="card">
				<div class="card-header">
					<div class="text-start">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
								class="bx bx-plus-circle"></i> Tambah Fakultas</button>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						@foreach ($fakultas as $fak)
							<h3>
								<span class="badge bg-dark px-3">{{ $fak->nama_fakultas }}</span>
								<button type="button" class="btn btn-danger" data-bs-toggle="modal"
									data-bs-target="#modalDelete{{ $fak->id }}" data-id="{{ $fak->id }}"
									data-nama="{{ $fak->nama_fakultas }}">
									<i class="bx bx-trash"></i>
								</button>
							</h3>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="card">
				<div class="card-header">
					<div class="text-start">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddJurusan"><i
								class="bx bx-plus-circle"></i> Tambah Jurusan</button>
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
									<th>Fakultas</th>
									<th>Jurusan</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@php
									$no = 1;
								@endphp
								@foreach ($jurusan as $item)
									<tr>
										<td>{{ $no++ }}</td>
										<td><strong>{{ $item->nama_fakultas }}</strong></td>
										<td>{{ $item->nama_jurusan }}</td>
										<td>
											{{-- <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
												data-bs-target="#modalEdit{{ $item->id }}"><i class="bx bx-edit me-1"></i> Edit</button> --}}
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
				<div class="modal-header bg-primary pb-3">
					<h5 class="modal-title text-white" id="modalAddTitle">Tambah Fakultas</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="post" action="{{ route('fakultas.store') }}">
					@csrf
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12 mb-3">
								<label for="nama_fakultas" class="form-label">Nama Fakultas</label>
								<input type="text" class="form-control @error('nama_fakultas') is-invalid @enderror" name="nama_fakultas"
									id="name" placeholder="Nama Fakultas" value="{{ old('nama_fakultas') }}">
								@error('nama_fakultas')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
							Close
						</button>
						<button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Tambah Fakultas</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- Modal Tambah Jurusan --}}
	<div class="modal fade" id="modalAddJurusan" tabindex="-1" aria-modal="true">
		<div class="modal-dialog modal-xs modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-primary pb-3">
					<h5 class="modal-title text-white" id="modalAddTitle">Tambah Jurusan</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="post" action="{{ route('fakultas.storejurusan') }}">
					@csrf
					<div class="modal-body">
						<div class="row">

							<div class="col-sm-12 mb-3">
								<label for="" class="form-label">Fakultas</label>
								<select class="form-select form-select-lg" name="nama_fakultas" id="" required>
									<option value="" hidden>--Pilih Fakultas--</option>
									@foreach ($fakultas as $fak)
										<option value="{{ $fak->nama_fakultas }}">{{ $fak->nama_fakultas }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-12 mb-3">
								<label for="nama_jurusan" class="form-label">Nama Jurusan</label>
								<input type="text" class="form-control @error('nama_jurusan') is-invalid @enderror" name="nama_jurusan"
									id="name" placeholder="Nama Fakultas" value="{{ old('nama_jurusan') }}">
								@error('nama_jurusan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
							Close
						</button>
						<button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Tambah Fakultas</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- Modal Edit --}}
	{{-- @foreach ($jurusan as $item)
		<div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-warning pb-3">
						<h5 class="modal-title text-white" id="modalAddTitle">Edit User</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" action="{{ route('admin.fakultas.update', $item->id) }}">
						@csrf
						@method('put')
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12 mb-3">
									<label for="name" class="form-label">Nama</label>
									<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
										placeholder="Nama" value="{{ $item->name }}">
									@error('name')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-12 mb-3">
									<label for="email" class="form-label">Email</label>
									<input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
										id="email" placeholder="Email" value="{{ $item->email }}">
									@error('email')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-12 mb-3">
									<label for="password" class="form-label">Password</label>
									<input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
										id="password" placeholder="*******" value="{{ $item->password }}">
									@error('password')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
								Close
							</button>
							<button type="submit" class="btn btn-warning"><i class="bx bx-save"></i> Edit Data</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endforeach --}}

	{{-- Modal Delete --}}
	@foreach ($fakultas as $item)
		<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-danger">
						<h5 class="modal-title text-white pb-3" id="modalDeleteTitle">Hapus Fakultas</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('fakultas.destroy', $item->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									Apakah anda yakin ingin menghapus Fakultas <strong>{{ $item->nama_fakultas }}</strong> ?
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

@endpush
