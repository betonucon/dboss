				<ul class="nav"><li class="nav-header">Navigation</li>
					
						<li class="lilinya">
							<a href="{{url('/')}}">
								<i class="fas fa-home"></i>
								<span>Home</span> 
							</a>
						</li>
						@if(Auth::user()->role_id==4)
							<li class="lilinya">
								<a href="{{url('/Karyawan')}}">
									<i class="fas fa-users"></i>
									<span>Karyawan</span> 
								</a>
							</li>
							<li class="lilinya">
								<a href="{{url('/Vaksin')}}">
									<i class="fas fa-briefcase"></i>
									<span>List Vaksin</span> 
								</a>
							</li>
							<li class="lilinya">
								<a href="{{url('/Covid')}}">
									<i class="fas fa-briefcase"></i>
									<span>Riwayat Covid</span> 
								</a>
							</li>


						@endif

						@if(Auth::user()->role_id==1)
							<li class="lilinya">
								<a href="{{url('/Vendor')}}">
									<i class="fas fa-handshake"></i>
									<span>Vendor</span> 
								</a>
							</li>
							
							<li class="has-sub lilinya">
								<a href="javascript:;">
									<b class="caret"></b>
									<i class="fa fa-users"></i>
									<span>Karyawan OSS {!!app_get_karyawan()!!}</span>
								</a>
								<ul class="sub-menu">
									<li><a href="{{url('/VerifikasiKaryawan')}}">Proses Verifikasi {!!app_get_karyawan()!!}</a></li>
									<li><a href="{{url('/ListKaryawan')}}">Terverifikasi</a></li>
									
								</ul>
							</li>

						@endif
						
					
					
					<!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
					<!-- end sidebar minify button -->
				</ul>