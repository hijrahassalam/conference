	<?php $kegiatan =  $this->input->get('kegiatan'); ?>	
		<aside id="left-panel">
			<div class="login-info">
				<span>
					<a href="#">
						<img src="<?php echo base_url();?>asset/asset_admin/img/avatars/9.png" alt="me" class="online" />
						<span><?php echo strtoupper($this->session->userdata('user_name'))?>
						</span>
					</a>
				</span>
			</div>
			<nav>
				<ul>
				<?php
				if ($this->session->userdata('role')=='ADMIN')
				{
					?>
					<li <?php echo ($this->uri->segment(2) == 'dashboard' ? ' class="active"' : ''); ?>>
						<a href="<?php echo base_url('admin/dashboard');?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
					</li>
					<li>
						<a href="#"><i class="fa fa-lg fa-fw fa-wrench"></i> <span class="menu-item-parent">Konfigurasi</span></a>
						<ul>
							<li <?php if ($this->uri->segment(2) == 'setting' && $this->uri->segment(3) == 'web') { echo "class='active'"; } ?>>
								<a href="<?php echo base_url('admin/setting/web');?>">Detail Website</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-lg fa-fw fa-edit"></i> <span class="menu-item-parent">Verifikasi</span></a>
						<ul>
							<li  <?php if($this->uri->segment(2) == 'abstrak') echo "class='active'"; ?>>
								<a href="<?php echo base_url('admin/abstrak') ?>">Abstrak</a>
							</li>
							<li <?php
								if($this->uri->segment(2) == 'fullpaper') echo "class='active'";
							?>>
								<a href="<?php echo base_url('admin/fullpaper') ?>">Full Paper</a>
							</li>
							<li <?php
								if($this->uri->segment(2) == 'bukti') echo "class='active'";
							?>>
								<a href="<?php echo base_url('admin/bukti') ?>">Bukti Bayar</a>
							</li>
							<li <?php
								if($this->uri->segment(2) == 'hppbi') echo "class='active'";
							?>>
								<!-- <a href="<?php echo base_url('admin/hppbi') ?>">KTA HPPBI</a> -->
							</li>
						</ul>
					</li>
					<li <?php if($this->uri->segment(2) == 'pendaftar') echo "class='active'"; ?>>
						<a href="<?php echo base_url('admin/pendaftar')?>"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Data Pendaftar</span></a>
					</li>
					<li>
						<a href="<?php echo base_url('daftar')?>" target="_blank"><i class="fa fa-lg fa-fw fa-laptop"></i> <span class="menu-item-parent">Form Pendaftaran</span></a>
					</li>
					<li>
						<a href="<?php echo base_url('rekap')?>" target="_blank"><i class="fa fa-lg fa-fw fa-briefcase"></i> <span class="menu-item-parent">Rekap</span></a>
					</li>
					<li <?php if($this->uri->segment(1) == 'sms') echo "class='active'"; ?>>
						<a href="<?php echo base_url('sms')?>"><i class="fa fa-lg fa-fw fa-mobile-phone"></i> <span class="menu-item-parent">SMS</span></a>
					</li>
					<li <?php if($this->uri->segment(2) == 'cetak') echo "class='active'"; ?>>
						<a href="<?php echo base_url('admin/cetak')?>" title="Cetak"><i class="fa fa-lg fa-fw fa-print"></i> <span class="menu-item-parent">Cetak</span></a>
					</li>
					<li>
						<a href="#"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Sertifikat</span></a>
						<ul>
							<li  <?php if($this->uri->segment(2) == 'presensi') echo "class='active'"; ?>>
								<a href="<?php echo base_url('admin/presensi') ?>">Pemakalah</a>
							</li>
							<li <?php
								if($this->uri->segment(3) == 'nonpemakalah') echo "class='active'";
							?>>
								<a href="<?php echo base_url('admin/presensi/nonpemakalah') ?>">Peserta</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo base_url('logout')?>" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-lg fa-fw fa-sign-out"></i> <span class="menu-item-parent">Logout</span></a>
					</li>
				<?php
			}
			else if ($this->session->userdata('role')=='DOKUMEN')
			{
				?>
				<li <?php echo ($this->uri->segment(2) == 'dashboard' ? ' class="active"' : ''); ?>>
						<a href="<?php echo base_url('admin/dashboard');?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
					</li>
					<li>
						<a href="#"><i class="fa fa-lg fa-fw fa-edit"></i> <span class="menu-item-parent">Verifikasi</span></a>
						<ul>
							<li  <?php if($this->uri->segment(2) == 'abstrak') echo "class='active'"; ?>>
								<a href="<?php echo base_url('admin/abstrak') ?>">Abstrak</a>
							</li>
							<li <?php
								if($this->uri->segment(2) == 'fullpaper') echo "class='active'";
							?>>
								<a href="<?php echo base_url('admin/fullpaper') ?>">Full Paper</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo base_url('rekap')?>" target="_blank"><i class="fa fa-lg fa-fw fa-briefcase"></i> <span class="menu-item-parent">Rekap</span></a>
					</li>
					<li>
						<a href="<?php echo base_url('logout')?>" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-lg fa-fw fa-sign-out"></i> <span class="menu-item-parent">Logout</span></a>
					</li>
			<?php
			}

			else if ($this->session->userdata('role')=='KEUANGAN')
			{
				?>
				<li <?php echo ($this->uri->segment(2) == 'dashboard' ? ' class="active"' : ''); ?>>
						<a href="<?php echo base_url('admin/dashboard');?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
					</li>
					<li>
						<a href="#"><i class="fa fa-lg fa-fw fa-edit"></i> <span class="menu-item-parent">Verifikasi</span></a>
						<ul>
							<li <?php
								if($this->uri->segment(2) == 'bukti') echo "class='active'";
							?>>
								<a href="<?php echo base_url('admin/bukti') ?>">Bukti Bayar</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo base_url('rekap')?>" target="_blank"><i class="fa fa-lg fa-fw fa-briefcase"></i> <span class="menu-item-parent">Rekap</span></a>
					</li>
					<li>
						<a href="<?php echo base_url('logout')?>" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-lg fa-fw fa-sign-out"></i> <span class="menu-item-parent">Logout</span></a>
					</li>
			<?php
			}

			else if ($this->session->userdata('role')=='PRESENSI')
			{
				?>
				<li <?php echo ($this->uri->segment(2) == 'dashboard' ? ' class="active"' : ''); ?>>
						<a href="<?php echo base_url('admin/dashboard');?>" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
					</li>
					<li>
						<a href="#"><i class="fa fa-lg fa-fw fa-wrench"></i> <span class="menu-item-parent">Konfigurasi</span></a>
						<ul>
							<li <?php if ($this->uri->segment(2) == 'setting' && $this->uri->segment(3) == 'web') { echo "class='active'"; } ?>>
								<a href="<?php echo base_url('admin/setting/web');?>">Detail Website</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-lg fa-fw fa-edit"></i> <span class="menu-item-parent">Verifikasi</span></a>
						<ul>
							<li  <?php if($this->uri->segment(2) == 'abstrak') echo "class='active'"; ?>>
								<a href="<?php echo base_url('admin/abstrak') ?>">Abstrak</a>
							</li>
							<li <?php
								if($this->uri->segment(2) == 'fullpaper') echo "class='active'";
							?>>
								<a href="<?php echo base_url('admin/fullpaper') ?>">Full Paper</a>
							</li>
							<li <?php
								if($this->uri->segment(2) == 'bukti') echo "class='active'";
							?>>
								<a href="<?php echo base_url('admin/bukti') ?>">Bukti Bayar</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-lg fa-fw fa-file"></i> <span class="menu-item-parent">Sertifikat</span></a>
						<ul>
							<li  <?php if($this->uri->segment(2) == 'presensi') echo "class='active'"; ?>>
								<a href="<?php echo base_url('admin/presensi') ?>">Pemakalah</a>
							</li>
							<li <?php
								if($this->uri->segment(3) == 'nonpemakalah') echo "class='active'";
							?>>
								<a href="<?php echo base_url('admin/presensi/nonpemakalah') ?>">Peserta</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo base_url('logout')?>" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-lg fa-fw fa-sign-out"></i> <span class="menu-item-parent">Logout</span></a>
					</li>
			<?php
			}
			?>
				</ul>
			
			</nav>
		</aside>
		<!-- END NAVIGATION -->
