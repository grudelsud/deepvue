<?php $this->load->view('includes/header'); ?>
<script type="text/javascript">
	$(document).ready(function() {
		var contentUrl = '<?php echo base_url().'contents/'; ?>';
		var elementCtrl = '<?php echo site_url('element/read').'/'; ?>';
		$.ajax({
			url: '<?php echo site_url('element/page/0'); ?>',
			dataType: 'json',
			type: 'GET',
			success: function(data) {
				$('#elems_horizthumbs').empty();
				var ulTag = $('<ul></ul>');
				$.each(data, function(i, item){
					ulTag.append('<li><a href="'+elementCtrl+item.id_element+'"><img src="'+contentUrl+item.filename+'-thumb.jpeg" /></a></li>');
				});
				$('#elems_horizthumbs').append(ulTag);
			}
		});
	});
</script>

<div class="row">

<div id="splash" class="twelvecol last"></div>

</div><!-- end of .row -->

<div class="row">

<div id="elems_horizthumbs" class="twelvecol last"></div>

</div><!-- end of .row -->

<?php $this->load->view('includes/footer'); ?>