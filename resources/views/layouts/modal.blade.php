<div class="modal fade" role="dialog" id="profileModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Profil</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-widget widget-user-2">
							<div class="widget-user-header bg-blue">
								<div class="widget-user-image">
									<img class="img-circle" src="{{ $profile->avatar }}" alt="User Avatar">
								</div>
								<h3 class="widget-user-username">{{ $profile->name }}</h3>
								<h5 class="widget-user-desc">{{ $profile->level }}</h5>
							</div>
							<div class="box-footer no-padding">
								<ul class="nav nav-stacked">
									<li><a href="#">Nama<span class="pull-right">{{ $profile->name }}</span></a></li>
									<li><a href="#">Jenis Kelamin <span class="pull-right">{{ $profile->gender }}</span></a></li>
									<li><a href="#">Tempat, Tanggal Lahir <span class="pull-right">{{ $profile->city.', '.$profile->birthdate }}</span></a></li>
									<li><a href="#">Alamat <span class="pull-right">{{ $profile->address }}</span></a></li>
									<li><a href="#">Username <span class="pull-right">{{ Auth::user()->username }}</span></a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /.widget-user -->
				</div>
			</div>
			<div class="modal-footer">
				<div class="pull-left btn-group">
					<button type="button" class="btn btn-warning dropdown-toggle btn-sm btn-flat" data-toggle="dropdown">
						Aksi
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li><a href="{{ route('profile.edit') }}">Ubah</a></li>
						<li><a href="#" onclick="avatar()">Ubah Avatar</a></li>
						<li><a href="#" onclick="pass()">Ubah Password</a></li>
						<li><a href="#" onclick="reset2()">Reset Password</a></li>
						<form id="reset2" action="{{ route('password.reset') }}" method="post">
						    {{ csrf_field() }}
						    <input type="hidden" name="_method" value="PUT">
						</form>
					</ul>
				</div>
			</div>
		</div>
			<!-- /.modal-content -->
	</div>
		<!-- /.modal-dialog -->
</div>
<div class="modal fade" role="dialog" id="avatarModal">
	<div class="modal-dialog">
		<form action="{{ route('avatar.update') }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="hidden" name="_method" value="PUT">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Ubah Avatar</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="avatar">Avatar</label>
						<input type="file" name="avatar" id="avatar" onchange="checkimage(this.value)" required>
						<p class="help-block">Avatar max 512x512 pixel. Tidak lebih dari 300kb. Ekstensi PNG dan JPG.</p>
					</div>
				</div>
				<div class="modal-footer">
					<div class="pull-left btn-group">
						<button class="btn btn-primary btn-sm btn-flat">Simpan</button>
					</div>
				</div>
			</div>
		</form>
			<!-- /.modal-content -->
		<!-- /.modal-dialog -->
	</div>
</div>
<div class="modal fade" role="dialog" id="passwordModal">
	<div class="modal-dialog">
		<form action="{{ route('password.update') }}" method="post">
			{{ csrf_field() }}
			<input type="hidden" name="_method" value="PUT">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Ubah Password</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" min="6" name="password" id="password" placeholder="Masukkan password" required class="form-control">
					</div>
					<div class="form-group">
						<label for="password_confirmation">Konfirmasi Password</label>
						<input type="password" min="6" name="password_confirmation" id="password_confirmation" placeholder="Masukkan konfirmasi password" required class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<div class="pull-left btn-group">
						<button class="btn btn-primary btn-sm btn-flat">Simpan</button>
					</div>
				</div>
			</div>
		</form>
			<!-- /.modal-content -->
		<!-- /.modal-dialog -->
	</div>
</div>