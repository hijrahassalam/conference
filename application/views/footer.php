<?php
    $query=$this->db->get_where('sembio_web', array('idkhusus =' => '22'))->row_array();
  ?>
  <!-- .subfooter start -->
        <!-- ================ -->
        <div class="subfooter">
          <div class="container">
            <div class="subfooter-inner">
              <div class="row">
                <div class="col-md-12">
                  <p class="text-center">Copyright © 2021 <?php echo $query['web_judul']?> </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- .subfooter end -->