		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{asset('static/img/profile.jpg')}}" alt="" class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									Muhammad Rizki
									<span class="user-level">Admin</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>
							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
                    <ul class="nav nav-primary">
                        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                            <a href="{{ url('/') }}">
                                <i class="fa-solid fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>     
						<li class="nav-item {{ request()->is('typedocument*') ? 'active' : '' }}">
							<a href="{{ url('/typedocument') }}">
								<i class="fas fa-paperclip"></i>
								<p>Jenis Dokumen</p>
							</a>
						</li>
						<li class="nav-item {{ request()->is('arsip*') ? 'active' : '' }}">
                            <a href="{{ url('/arsip') }}">
                                <i class="fas fa-file"></i>
                                <p>Buat Arsip</p>
                            </a>
                        </li>   
						<li class="nav-item">
							<a data-toggle="collapse" href="#sidebarLayouts" class="collapsed" aria-expanded="false">
								<i class="fas fa-coins"></i>
								<p>Arsip</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="sidebarLayouts" style="">
								<ul class="nav nav-collapse">
									<li class="nav-item {{ request()->is('personal-arsip*') ? 'active' : '' }}">
										<a href="{{ url('/personal-arsip') }}">
											<span class="sub-item">Personal Arsip</span>
										</a>
									</li>
									<li class="nav-item {{ request()->is('all/arsip*') ? 'active' : '' }}">
										<a href="{{ url('/all/arsip') }}">
											<span class="sub-item">Seluruh Arsip</span>
										</a>
									</li>
								</ul>
							</div>
						</li> 
						<li class="nav-item {{ request()->is('usermanagement*') ? 'active' : '' }}">
                            <a href="{{ url('/usermanagement') }}">
                                <i class="fas fa-user"></i>
                                <p>User Manajemen</p>
                            </a>
                        </li>                 
                    </ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->