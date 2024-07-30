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

		@if (session('message'))
			<div class="alert alert-success">
				{{ session('message') }}
			</div>
		@endif

		@if (session('error'))
			<div class="alert alert-danger">
				{{ session('error') }}
			</div>
		@endif
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<div class="text-start">
						<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
								class="bx bx-plus-circle"></i> Tambah Mahasiswa</button>
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
									<th>Nim</th>
									<th>Nama</th>
									<th>Fakultas</th>
									<th>Prodi</th>
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
										<td>{{ $item->nim }}</td>
										<td><b>{{ $item->name }}</b></td>
										<td>{{ $item->fakultas }}</td>
										<td>{{ $item->prodi }}</td>
										<td>{{ $item->email }}</td>
										<td>
											<button class="btn btn-info btn-sm" data-bs-toggle="modal"
												data-bs-target="#modalDetail{{ $item->id }}"><i class="bx bx-card me-1"></i> Detail</button>
											<button class="btn btn-warning btn-sm" data-bs-toggle="modal"
												data-bs-target="#modalEdit{{ $item->id }}"><i class="bx bx-edit me-1"></i> Edit</button>
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
					<h5 class="modal-title text-white" id="modalAddTitle">Tambah Mahasiswa</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="post" action="{{ route('mahasiswa.store') }}">
					@csrf
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12 mb-3">
								<label for="nim" class="form-label">NIM</label>
								<input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim"
									placeholder="NIM" value="{{ old('nim') }}">
								@error('nim')
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
								<label for="" class="form-label">Fakultas</label>
								<select class="form-select form-select-lg" name="fakultas" id="" required>
									<option value="" hidden>--Pilih Fakultas--</option>
									@foreach ($fakultas as $fak)
										<option value="{{ $fak->nama_fakultas }}">{{ $fak->nama_fakultas }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-12 mb-3">
								<label for="" class="form-label">jurusan</label>
								<select class="form-select form-select-lg" name="jurusan" id="" required>
									<option value="" hidden>--Pilih jurusan--</option>
									@foreach ($jurusan as $fak)
										<option value="{{ $fak->nama_jurusan }}">{{ $fak->nama_jurusan }}</option>
									@endforeach
								</select>
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
						<button type="submit" class="btn btn-success"><i class="bx bx-save"></i> Tambah Mahasiswa</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- Modal Edit --}}
	@foreach ($user as $item)
		<div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-warning pb-3">
						<h5 class="modal-title text-white" id="modalAddTitle">Edit User</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" action="{{ route('mahasiswa.update', $item->id) }}">
						@csrf
						@method('PUT')
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12 mb-3">
									<label for="nim" class="form-label">NIM</label>
									<input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim"
										placeholder="NIM" value="{{ old('nim', $item->nim) }}">
									@error('nim')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-12 mb-3">
									<label for="name" class="form-label">Nama</label>
									<input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
										id="name" placeholder="name" value="{{ old('name', $item->name) }}">
									@error('name')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-12 mb-3">
									<label for="" class="form-label">Fakultas</label>
									<select class="form-select form-select-lg" name="fakultas" id="" required>
										<option value="" hidden>--Pilih Fakultas--</option>
										@foreach ($fakultas as $fak)
											<option value="{{ $fak->nama_fakultas }}"
												{{ old('fakultas', $item->fakultas) == $fak->nama_fakultas ? 'selected' : '' }}>
												{{ $fak->nama_fakultas }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-sm-12 mb-3">
									<label for="" class="form-label">Jurusan</label>
									<select class="form-select form-select-lg" name="jurusan" id="" required>
										<option value="" hidden>--Pilih Jurusan--</option>
										@foreach ($jurusan as $jur)
											<option value="{{ $jur->nama_jurusan }}"
												{{ old('jurusan', $item->jurusan) == $jur->nama_jurusan ? 'selected' : '' }}>{{ $jur->nama_jurusan }}
											</option>
										@endforeach
									</select>
								</div>
								<div class="col-sm-12 mb-3">
									<label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
									<select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
										id="jenis_kelamin">
										<option value="" hidden>--Pilih Jenis Kelamin--</option>
										<option value="Laki-laki" {{ old('jenis_kelamin', $item->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
											Laki-laki</option>
										<option value="Wanita" {{ old('jenis_kelamin', $item->jenis_kelamin) == 'Wanita' ? 'selected' : '' }}>
											Wanita</option>
									</select>
									@error('jenis_kelamin')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-6 mb-3">
									<label for="tempat" class="form-label">Tempat</label>
									<input type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat"
										id="tempat" placeholder="Tempat Lahir" value="{{ old('tempat', $item->tempat) }}">
									@error('tempat')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-6 mb-3">
									<label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
									<input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir"
										id="tgl_lahir" value="{{ old('tgl_lahir', $item->tgl_lahir) }}">
									@error('tgl_lahir')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-12 mb-3">
									<label for="kontak" class="form-label">Kontak</label>
									<input type="text" class="form-control @error('kontak') is-invalid @enderror" name="kontak"
										id="kontak" placeholder="Kontak" value="{{ old('kontak', $item->kontak) }}">
									@error('kontak')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-12 mb-3">
									<label for="alamat" class="form-label">Alamat</label>
									<input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
										id="alamat" placeholder="Alamat" value="{{ old('alamat', $item->alamat) }}">
									@error('alamat')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-12 mb-3">
									<label for="email" class="form-label">Email</label>
									<input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
										id="email" placeholder="Email" value="{{ old('email', $item->email) }}">
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
									<small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
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
							<button type="submit" class="btn btn-success"><i class="bx bx-save"></i> Simpan Perubahan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endforeach

	{{-- Modal Detail --}}
	@foreach ($user as $item)
		<div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-warning pb-3">
						<h5 class="modal-title text-white" id="modalAddTitle">Detail Mahasiswa</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="card p-2">
							<div class="row">
								<div class="col-4">
									Nama Mahasiswa
								</div>
								<div class="col-8">
									<strong>
										{{ $item->name }}
									</strong>
								</div>
							</div>
							<div class="row">
								<div class="col-4">
									Nim
								</div>
								<div class="col-8">
									{{ $item->nim }}
								</div>
							</div>
							<div class="row">
								<div class="col-4">
									Fakultas
								</div>
								<div class="col-8">
									{{ $item->fakultas }}
								</div>
							</div>
							<div class="row">
								<div class="col-4">
									Prodi
								</div>
								<div class="col-8">
									{{ $item->prodi }}
								</div>
							</div>
							<div class="row">
								<div class="col-4">
									<span class="text-capitalize">
										Tempat, Tgl Lahir
									</span>
								</div>
								<div class="col-8">
									{{ $item->tempat }}, {{ Carbon::parse($item->tgl_lahir)->format('d F Y') }}
								</div>
							</div>
							<div class="row">
								<div class="col-4">
									<span class="text-capitalize">
										alamat
									</span>
								</div>
								<div class="col-8">
									{{ $item->alamat }}
								</div>
							</div>
							<div class="row">
								<div class="col-4">
									<span class="text-capitalize">
										email
									</span>
								</div>
								<div class="col-8">
									{{ $item->email }}
								</div>
							</div>
							<div class="row">
								<div class="col-4">
									<p class="text-capitalize">
										kontak
									</p>
								</div>
								<div class="col-8">
									{{ $item->kontak }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach

	{{-- Modal Delete --}}
	@foreach ($user as $item)
		<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-danger">
						<h5 class="modal-title text-white pb-3" id="modalDeleteTitle">Hapus Mahasiswa</h5>
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
