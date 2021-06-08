<script>
$('#bahasa').on('change', function() {
	var url = $(location).attr('href');
	var bhs = this.value;

  	$.post('<?php echo base_url('core/set_bahasa/')?>/'+bhs+"",
                    {id:bhs},
                    function(html){
                        window.location.replace(url);
                    }   
                );
});
</script>