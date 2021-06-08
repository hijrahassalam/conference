	<?php $kegiatan =  $this->input->get('kegiatan'); ?>	
		<aside id="left-panel">
			<div class="login-info">
				<span>
					<a href="#">
						<img src="<?php echo base_url();?>asset/asset_admin/img/avatars/9.png" alt="me" class="online" />
						<span>Calon Peserta
						</span>
					</a>
				</span>
			</div>
			<nav>
				<ul>
					<li>
						<a href="<?php echo base_url('');?>" title="Home"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Home</span></a>
					</li>
					<li>
						<a href="<?php echo base_url('daftar');?>" title="Daftar"><i class="fa fa-lg fa-fw fa-keyboard-o"></i> <span class="menu-item-parent">Daftar</span></a>
					</li>
					<li>
						<a href="<?php echo base_url('rekap');?>" title="Rekap" target="_blank"><i class="fa fa-lg fa-fw fa-book"></i> <span class="menu-item-parent">Rekap</span></a>
					</li>
					<li>
						<a href="http://sembio.fkip.uns.ac.id" title="Portal"  target="_blank"><i class="fa fa-lg fa-fw fa-laptop"></i> <span class="menu-item-parent">Portal</span></a>
					</li>
					
				</ul>
			</nav>
		</aside>
		<!-- END NAVIGATION -->
