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
						<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
								class="bx bx-plus-circle"></i> Tambah Mata Kuliah</button>
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
									<th>Kode Makul</th>
									<th>Nama Makul</th>
									<th>Prodi</th>
									<th>KLS</th>
									<th>Nama Dosen</th>
									<th>Ruang</th>
									<th>Jam</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@php
									$no = 1;
								@endphp
								@foreach ($makul as $mak)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $mak->kode_makul }}</td>
										<td><b>{{ $mak->nama_makul }}</b></td>
										<td>{{ $mak->prodi }}</td>
										<td>{{ $mak->kelas }}</td>
										<td>{{ $mak->nama_dosen }}</td>
										<td>{{ $mak->ruangan }}</td>
										<td>{{ $mak->jam }}</td>
										<td>
											{{-- <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $mak->id }}"><i
													class="bx bx-card me-1"></i> Detail</button> --}}
											<button class="btn btn-warning btn-sm" data-bs-toggle="modal"
												data-bs-target="#modalEdit{{ $mak->id }}"><i class="bx bx-edit me-1"></i> Edit</button>
											<button class="btn btn-danger btn-sm" data-bs-toggle="modal"
												data-bs-target="#modalDelete{{ $mak->id }}"><i class="bx bx-trash me-1"></i> Hapus</button>
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
					<h5 class="modal-title text-white" id="modalAddTitle">Tambah Mata Kuliah</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form method="post" action="{{ route('makul.store') }}">
					@csrf
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12 mb-3">
								<label for="kode_makul" class="form-label">Kode Mata Kuliah</label>
								<input type="text" class="form-control @error('kode_makul') is-invalid @enderror" name="kode_makul"
									id="kode_makul" placeholder="Kode Mata Kuliah" value="{{ old('kode_makul') }}">
								@error('kode_makul')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="nama_makul" class="form-label">Nama Mata Kuliah</label>
								<input type="text" class="form-control @error('nama_makul') is-invalid @enderror" name="nama_makul"
									id="nama_makul" placeholder="Nama Mata Kuliah" value="{{ old('nama_makul') }}">
								@error('nama_makul')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="" class="form-label">Prodi</label>
								<select class="form-select form-select-lg" name="prodi" id="" required>
									<option value="" hidden>--Pilih Prodi--</option>
									@foreach ($jurusan as $jur)
										<option value="{{ $jur->nama_jurusan }}">{{ $jur->nama_jurusan }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-12 mb-3">
								<label for="kelas" class="form-label">Kelas</label>
								<input type="text" class="form-control @error('kelas') is-invalid @enderror" name="kelas" id="kelas"
									placeholder="Kelas" value="{{ old('kelas') }}">
								@error('kelas')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="" class="form-label">Dosen</label>
								<select class="form-select form-select-lg" name="nama_dosen" id="" required>
									<option value="" hidden>--Pilih Dosen--</option>
									@foreach ($dosen as $dos)
										<option value="{{ $dos->name }}">{{ $dos->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-12 mb-3">
								<label for="ruangan" class="form-label">Ruangan</label>
								<input type="text" class="form-control @error('ruangan') is-invalid @enderror" name="ruangan" id="ruangan"
									placeholder="ruangan" value="{{ old('ruangan') }}">
								@error('ruangan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-12 mb-3">
								<label for="jam" class="form-label">Jam</label>
								<input type="time" class="form-control @error('jam') is-invalid @enderror" name="jam" id="jam"
									value="{{ old('jam') }}">
								@error('jam')
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
						<button type="submit" class="btn btn-success"><i class="bx bx-save"></i> Tambah Mata Kuliah</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- Modal Edit --}}
	@foreach ($makul as $mak)
		<div class="modal fade" id="modalEdit{{ $mak->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-warning pb-3">
						<h5 class="modal-title text-white" id="modalAddTitle">Edit User</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form method="post" action="{{ route('makul.update', $mak->id) }}">
						@csrf
						@method('put')
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12 mb-3">
									<label for="kode_makul" class="form-label">Kode Mata Kuliah</label>
									<input type="text" class="form-control @error('kode_makul') is-invalid @enderror" name="kode_makul"
										id="kode_makul" placeholder="Kode Mata Kuliah" value="{{ old('kode_makul', $mak->kode_makul) }}">
									@error('kode_makul')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-12 mb-3">
									<label for="nama_makul" class="form-label">Nama Mata Kuliah</label>
									<input type="text" class="form-control @error('nama_makul') is-invalid @enderror" name="nama_makul"
										id="nama_makul" placeholder="Nama Mata Kuliah" value="{{ old('nama_makul', $mak->nama_makul) }}">
									@error('nama_makul')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-12 mb-3">
									<label for="" class="form-label">Prodi</label>
									<select class="form-select form-select-lg" name="prodi" id="" required>
										<option value="" hidden>--Pilih Prodi--</option>
										@foreach ($jurusan as $jur)
											<option value="{{ $jur->nama_jurusan }}" {{ $jur->nama_jurusan == $mak->prodi ? 'selected' : '' }}>
												{{ $jur->nama_jurusan }}
											</option>
										@endforeach
									</select>
								</div>
								<div class="col-sm-12 mb-3">
									<label for="kelas" class="form-label">Kelas</label>
									<input type="text" class="form-control @error('kelas') is-invalid @enderror" name="kelas"
										id="kelas" placeholder="Kelas" value="{{ old('kelas', $mak->kelas) }}">
									@error('kelas')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-12 mb-3">
									<label for="" class="form-label">Dosen</label>
									<select class="form-select form-select-lg" name="nama_dosen" id="" required>
										<option value="" hidden>--Pilih Dosen--</option>
										@foreach ($dosen as $dos)
											<option value="{{ $dos->name }}" {{ $dos->name == $mak->nama_dosen ? 'selected' : '' }}>
												{{ $dos->name }}
											</option>
										@endforeach
									</select>
								</div>
								<div class="col-sm-12 mb-3">
									<label for="ruangan" class="form-label">Ruangan</label>
									<input type="text" class="form-control @error('ruangan') is-invalid @enderror" name="ruangan"
										id="ruangan" placeholder="ruangan" value="{{ old('ruangan', $mak->ruangan) }}">
									@error('ruangan')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-12 mb-3">
									<label for="jam" class="form-label">Jam</label>
									<input type="time" class="form-control @error('jam') is-invalid @enderror" name="jam" id="jam"
										value="{{ old('jam', $mak->jam) }}">
									@error('jam')
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
							<button type="submit" class="btn btn-success"><i class="bx bx-save"></i> Update Mata Kuliah</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	@endforeach

	{{-- Modal Delete --}}
	@foreach ($makul as $mak)
		<div class="modal fade" id="modalDelete{{ $mak->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header bg-danger">
						<h5 class="modal-title text-white pb-3" id="modalDeleteTitle">Hapus Mata Kuliah</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('makul.destroy', $mak->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									Apakah anda yakin ingin menghapus Makul : <strong>{{ $mak->nama_makul }}</strong> ?
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
