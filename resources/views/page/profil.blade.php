@extends('layouts.main')

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<form method="post" action="{{ route('profil.update', $profil->id) }}">
								@csrf
								@method('PUT')
								<div class="row">
									<div class="col-sm-12 mb-3">
										<label for="nim" class="form-label">NIM</label>
										<input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" id="nim"
											placeholder="NIM" value="{{ old('nim', $profil->nim) }}">
										@error('nim')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
									<div class="col-sm-12 mb-3">
										<label for="name" class="form-label">Nama</label>
										<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
											placeholder="name" value="{{ old('name', $profil->name) }}">
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
													{{ old('fakultas', $profil->fakultas) == $fak->nama_fakultas ? 'selected' : '' }}>
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
													{{ old('jurusan', $profil->jurusan) == $jur->nama_jurusan ? 'selected' : '' }}>{{ $jur->nama_jurusan }}
												</option>
											@endforeach
										</select>
									</div>
									<div class="col-sm-12 mb-3">
										<label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
										<select class="form-select @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
											id="jenis_kelamin">
											<option value="" hidden>--Pilih Jenis Kelamin--</option>
											<option value="Laki-laki"
												{{ old('jenis_kelamin', $profil->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
												Laki-laki</option>
											<option value="Wanita" {{ old('jenis_kelamin', $profil->jenis_kelamin) == 'Wanita' ? 'selected' : '' }}>
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
										<input type="text" class="form-control @error('tempat') is-invalid @enderror" name="tempat" id="tempat"
											placeholder="Tempat Lahir" value="{{ old('tempat', $profil->tempat) }}">
										@error('tempat')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
									<div class="col-sm-6 mb-3">
										<label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
										<input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir"
											id="tgl_lahir" value="{{ old('tgl_lahir', $profil->tgl_lahir) }}">
										@error('tgl_lahir')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
									<div class="col-sm-12 mb-3">
										<label for="kontak" class="form-label">Kontak</label>
										<input type="text" class="form-control @error('kontak') is-invalid @enderror" name="kontak" id="kontak"
											placeholder="Kontak" value="{{ old('kontak', $profil->kontak) }}">
										@error('kontak')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
									<div class="col-sm-12 mb-3">
										<label for="alamat" class="form-label">Alamat</label>
										<input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
											placeholder="Alamat" value="{{ old('alamat', $profil->alamat) }}">
										@error('alamat')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
									<div class="col-sm-12 mb-3">
										<label for="email" class="form-label">Email</label>
										<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
											placeholder="Email" value="{{ old('email', $profil->email) }}">
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
									<button type="submit" class="btn btn-success"><i class="bx bx-save"></i> Simpan Perubahan</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
