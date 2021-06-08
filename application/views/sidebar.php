<div class="col-md-3">
              <aside class="sidebar">

                
                <div class="toogle">
                <section class="toggle active"><label>Produk Terbaru</label>
                <ul class="simple-post-list">
                <?php
                $this->db->order_by('tgl_add','desc');
                $this->db->limit(3,0);
                $p=$this->db->get('umkm_produk');

                foreach($p->result_array() as $produk)
                {
                  ?>
                  <li>
                    <div class="post-image">
                      <div class="img-thumbnail">
                        <a href="<?php echo base_url('produk/'.$produk['produk_kode'].'')?>">
                          <img alt="<?php echo $produk['produk_nama']?>" width="60" height="60" class="img-responsive" src="<?php echo base_url('uploads/produk/'.$produk['produk_gambar'].'')?>">
                        </a>
                      </div>
                    </div>
                    <div class="post-info">
                      <a href="<?php echo base_url('produk/'.$produk['produk_kode'].'')?>"><?php echo $produk['produk_nama']?></a>
                      <br/>
                      <div class="post-meta">
                      <?php echo strip_tags(substr($produk['produk_deskripsi'],0,30))?>...<br/>
                        <b>Rp. <?php echo number_format($produk['produk_harga'],2,",",".")?></b>
                      </div>
                    </div>
                  </li>
                <?php
                  }
                  ?>
                </ul>
                </section>
                </div>

                <div class="toogle" data-plugin-toggle>
                <section class="toggle active">
                  <label>Daftar Industri Terbaru</label>
                  <div class="toggle-content">
                    <table class="table table-bordered">
                    <?php
                    $this->db->order_by('toko_nama','desc');
                    $t=$this->db->get('umkm_toko',5,0);
                    foreach($t->result_array() as $toko)
                    {
                      echo "<tr><td><a href='".base_url('toko/'.$toko['user_id'].'')."'>".$toko['toko_nama']."</a></td></tr>";
                    }
                    ?>
                    </table>
                  </div>
                </section>
                </div>
				<div class="toogle">
					<section class="toggle active"><label>Fanspage</label>
					<br/>
						<div class="fb-page" data-href="https://www.facebook.com/sukoharjokab" data-width="300px" data-height="450px" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/sukoharjokab"><a href="https://www.facebook.com/sukoharjokab">KABUPATEN SUKOHARJO</a></blockquote></div></div>
					</section>
				</div>
			  </aside>
            </div>