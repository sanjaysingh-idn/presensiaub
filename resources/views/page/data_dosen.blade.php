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
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
								class="bx bx-plus-circle"></i> Tambah Dosen</button>
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
									<th>Nip</th>
									<th>Nama</th>
									<th>Jabatan</th>
									<th>Gender</th>
									<th>TTL</th>
									<th>Kontak</th>
									<th>Alamat</th>
									<th>Email</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@php
									$no = 1;
									use Carbon\Carbon;

								@endphp
								@foreach ($user as $item)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $item->nip }}</td>
										<td><b>{{ $item->name }}</b></td>
										<td>{{ $item->jabatan }}</td>
										<td>{{ $item->jenis_kelamin }}</td>
										<td>{{ $item->tempat }}, {{ Carbon::parse($item->tgl_lahir)->format('d F Y') }}</td>
										<td>{{ $item->kontak }}</td>
										<td>{{ $item->alamat }}</td>
										<td>{{ $item->email }}</td>
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
					<h5 class="modal-title text-white" id="modalAddTitle">Tambah Dosen</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="post" action="{{ route('dosen.store') }}">
					@csrf
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12 mb-3">
								<label for="nip" class="form-label">NIP</label>
								<input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" id="nip"
									placeholder="NIP" value="{{ old('nip') }}">
								@error('nip')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="jabatan" class="form-label">Jabatan</label>
								<input type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" id="jabatan"
									placeholder="Jabatan" value="{{ old('jabatan') }}">
								@error('jabatan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="name" class="form-label">Nama</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
									placeholder="name" value="{{ old('name') }}">
								@error('name')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
								<select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin">
									<option value="" hidden>--Pilih Jenis Kelamin--</option>
									<option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
									<option value="Wanita" {{ old('jenis_kelamin') == 'Wanita' ? 'selected' : '' }}>Wanita</option>
								</select>
								@error('jenis_kelamin')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="tempat" class="form-label">Tempat</label>
								<input type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat" id="tempat"
									placeholder="Tempat Lahir" value="{{ old('tempat') }}">
								@error('tempat')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
								<input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir"
									id="tgl_lahir" value="{{ old('tgl_lahir') }}">
								@error('tgl_lahir')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="kontak" class="form-label">Kontak</label>
								<input type="text" class="form-control @error('kontak') is-invalid @enderror" name="kontak"
									id="kontak" placeholder="Kontak" value="{{ old('kontak') }}">
								@error('kontak')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="alamat" class="form-label">Alamat</label>
								<input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
									id="alamat" placeholder="Alamat" value="{{ old('alamat') }}">
								@error('alamat')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="email" class="form-label">Email</label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
									placeholder="Email" value="{{ old('email') }}">
								@error('email')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="password" class="form-label">Password</label>
								<input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
									id="password" placeholder="Password">
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
						<button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Tambah Dosen</button>
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
	@foreach ($user as $item)
		<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-danger">
						<h5 class="modal-title text-white pb-3" id="modalDeleteTitle">Hapus Dosen</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('user.destroy', $item->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									Apakah anda yakin ingin menghapus Dosen <strong>{{ $item->name }}</strong> ?
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
