<?php $this->load->view('head.php'); ?>

			<div role="main" class="main shop">

				<div class="container">

					<hr class="tall">

					<div class="row">
						<div class="col-md-9">

							<div class="row">
								<div class="col-md-6">

									<div class="owl-carousel" data-plugin-options='{"items": 1}'>
										<div>
											<div class="thumbnail">
												<img alt="<?php echo $produk['produk_nama']?>" class="img-responsive img-rounded" src="<?php echo base_url('uploads/produk/'.$produk['produk_gambar'].'')?>">
											</div>
										</div>
									</div>

								</div>

								<div class="col-md-6">

									<div class="summary entry-summary">

										<h1 class="shorter"><strong><?php echo $produk['produk_nama']?></strong></h1>

										<p class="price">
											<span class="amount">Rp. <?php echo number_format($produk['produk_harga'],2,",",".")?></span>
										</p>

										<p class="taller"><?php echo strip_tags(substr($produk['produk_deskripsi'],0,100))?></p>

										<form enctype="multipart/form-data" method="post" class="cart">
											<!-- <div class="quantity">
												<input type="button" class="minus" value="-">
												<input type="text" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
												<input type="button" class="plus" value="+">
											</div> -->
											<button href="#" class="btn btn-primary btn-icon">Beli</button>
										</form>

										<div class="product_meta">
											<span class="posted_in">Kategori: <a rel="tag" href="<?php echo base_url('kategori/'.$this->toko_model->idtoko_to_kategori_id($produk['id_toko']).'')?>"><?php echo $this->toko_model->idtoko_to_kategori($produk['id_toko'])?></a></span><br/>
											<span class="posted_in">Kata Kunci: <?php echo $produk['produk_tag']?></span>
										</div>

									</div>


								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="tabs tabs-product">
										<ul class="nav nav-tabs">
											<li class="active"><a href="#productDescription" data-toggle="tab">Deskripsi Produk</a></li>
											<li><a href="#productInfo" data-toggle="tab">Informasi Tambahan</a></li>
											<li><a href="#tokoInfo" data-toggle="tab">Informasi Toko</a></li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane active" id="productDescription">
												<?php echo $produk['produk_deskripsi']?>
											</div>
											<div class="tab-pane" id="productInfo">
												<table class="table table-striped push-top">
													<tbody>
														<tr>
															<th width="20%">
																Kode Produk
															</th>
															<td width="3%">:</td>
															<td>
																<?php echo $produk['produk_kode']?>
															</td>
														</tr>
														<tr>
															<th>
																Nama Produk
															</th>
															<td>:</td>
															<td>
																<?php echo $produk['produk_nama']?>
															</td>
														</tr>
														<tr>
															<th>
																Ukuran Produk
															</th>
															<td>:</td>
															<td>
																<?php echo $produk['produk_ukuran']?> cm
															</td>
														</tr>
														<tr>
															<th>
																Berat Produk
															</th>
															<td>:</td>
															<td>
																<?php echo $produk['produk_berat']?> kg
															</td>
														</tr>
														<tr>
															<th>
																Warna Produk
															</th>
															<td>:</td>
															<td>
																<?php echo $this->produk_model->get_warna($produk['produk_warna'])?>
															</td>
														</tr>
														<tr>
															<th>
																Harga Produk
															</th>
															<td>:</td>
															<td>
																Rp. <?php echo number_format($produk['produk_harga'],2,",",".")?>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="tab-pane" id="tokoInfo">
												<table class="table table-striped push-top">
													<tbody>
														<tr>
															<th width="20%">
																Nama Toko
															</th>
															<td width="3%">:</td>
															<td>
																<?php echo $toko['toko_nama']?>
															</td>
														</tr>
														<tr>
															<th>
																Alamat Toko
															</th>
															<td>:</td>
															<td>
																<?php echo $toko['toko_alamat']?>
															</td>
														</tr>
														<tr>
															<th>
																Kecamatan
															</th>
															<td>:</td>
															<td>
																<?php echo $this->toko_model->toko_kecamatan($toko['toko_kecamatan'])?>
															</td>
														</tr>
														<tr>
															<th>
																Deskripsi Toko
															</th>
															<td>:</td>
															<td>
																<?php echo $toko['toko_deskripsi']?> kg
															</td>
														</tr>
														<tr>
															<th>
																Nama Pemilik
															</th>
															<td>:</td>
															<td>
																<?php echo $this->toko_model->toko_pemilik($toko['toko_pemilik'])?>
															</td>
														</tr>
														<tr>
															<th>
																Email
															</th>
															<td>:</td>
															<td>
																<?php echo $akun['akun_email']?>
															</td>
														</tr>
														<tr>
															<th>
																No Handphone
															</th>
															<td>:</td>
															<td>
																<?php echo $akun['akun_hp']?>
															</td>
														</tr>
														<tr>
															<th>
																Pin BBM
															</th>
															<td>:</td>
															<td>
																<?php echo $akun['akun_bb']?>
															</td>
														</tr>
														<tr>
															<th>
																WhatsApp
															</th>
															<td>:</td>
															<td>
																<?php echo $akun['akun_wa']?>
															</td>
														</tr>
														<tr>
															<th>
																Line
															</th>
															<td>:</td>
															<td>
																<?php echo $akun['akun_line']?>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>

							<hr class="tall" />

							<div class="row">

								<div class="col-md-12">
									<h2><strong>Produk</strong> Sejenis</h2>
								</div>

								<ul class="products product-thumb-info-list">
									<li class="col-sm-3 col-xs-12 product">
										<a href="shop-product-sidebar.html">
											<span class="onsale">Sale!</span>
										</a>
										<span class="product-thumb-info">
											<a href="shop-cart.html" class="add-to-cart-product">
												<span><i class="fa fa-shopping-cart"></i> Tambah ke keranjang</span>
											</a>
											<a href="shop-product-sidebar.html">
												<span class="product-thumb-info-image">
													<span class="product-thumb-info-act">
														<span class="product-thumb-info-act-left"><em>View</em></span>
														<span class="product-thumb-info-act-right"><em><i class="fa fa-plus"></i> Details</em></span>
													</span>
													<img alt="" class="img-responsive" src="img/products/product-1.jpg">
												</span>
											</a>
											<span class="product-thumb-info-content">
												<a href="shop-product-sidebar.html">
													<h4>Batik</h4>
													<span class="price">
														<del><span class="amount">Rp. 325,000</span></del>
														<ins><span class="amount">Rp. 300,000</span></ins>
													</span>
												</a>
											</span>
										</span>
									</li>
									<li class="col-sm-3 col-xs-12 product">
										<span class="product-thumb-info">
											<a href="shop-cart.html" class="add-to-cart-product">
												<span><i class="fa fa-shopping-cart"></i> Add to Cart</span>
											</a>
											<a href="shop-product-sidebar.html">
												<span class="product-thumb-info-image">
													<span class="product-thumb-info-act">
														<span class="product-thumb-info-act-left"><em>View</em></span>
														<span class="product-thumb-info-act-right"><em><i class="fa fa-plus"></i> Details</em></span>
													</span>
													<img alt="" class="img-responsive" src="img/products/product-2.jpg">
												</span>
											</a>
											<span class="product-thumb-info-content">
												<a href="shop-product-sidebar.html">
													<h4>Golf Bag</h4>
													<span class="price">
														<span class="amount">$72</span>
													</span>
												</a>
											</span>
										</span>
									</li>
									<li class="col-sm-3 col-xs-12 product">
										<span class="product-thumb-info">
											<a href="shop-cart.html" class="add-to-cart-product">
												<span><i class="fa fa-shopping-cart"></i> Add to Cart</span>
											</a>
											<a href="shop-product-sidebar.html">
												<span class="product-thumb-info-image">
													<span class="product-thumb-info-act">
														<span class="product-thumb-info-act-left"><em>View</em></span>
														<span class="product-thumb-info-act-right"><em><i class="fa fa-plus"></i> Details</em></span>
													</span>
													<img alt="" class="img-responsive" src="img/products/product-3.jpg">
												</span>
											</a>
											<span class="product-thumb-info-content">
												<a href="shop-product-sidebar.html">
													<h4>Workout</h4>
													<span class="price">
														<span class="amount">$60</span>
													</span>
												</a>
											</span>
										</span>
									</li>
									<li class="col-sm-3 col-xs-12 product">
										<span class="product-thumb-info">
											<a href="shop-cart.html" class="add-to-cart-product">
												<span><i class="fa fa-shopping-cart"></i> Add to Cart</span>
											</a>
											<a href="shop-product-sidebar.html">
												<span class="product-thumb-info-image">
													<span class="product-thumb-info-act">
														<span class="product-thumb-info-act-left"><em>View</em></span>
														<span class="product-thumb-info-act-right"><em><i class="fa fa-plus"></i> Details</em></span>
													</span>
													<img alt="" class="img-responsive" src="img/products/product-4.jpg">
												</span>
											</a>
											<span class="product-thumb-info-content">
												<a href="shop-product-sidebar.html">
													<h4>Luxury bag</h4>
													<span class="price">
														<span class="amount">$199</span>
													</span>
												</a>
											</span>
										</span>
									</li>
								</ul>

							</div>

						</div>
						
							<aside class="sidebar">
							<?php $this->load->view('sidebar.php'); ?>
							</aside>
						
					</div>
				</div>

			</div>
<?php $this->load->view('foot.php'); ?>
