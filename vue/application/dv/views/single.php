<?php $this->load->view('includes/header'); ?>

<script type="text/javascript">
	$(document).ready(function() {
		var contentUrl = '<?php echo base_url().'contents/'; ?>';
		var disp_element = <?php echo $element; ?>;
		var elements = <?php echo $elements; ?>;

		var found = false;
		var imgTag = $('<img />');
		$.each(elements, function(i, element){
			if( disp_element == element.id_element ) {
				found = true;
				imgTag.attr('src', contentUrl+element.filename+'.'+element.ext);
			}
		});
		$('#single_img').append(imgTag);
				
		$('#single_side').empty();
		var ulTag = $('<ul></ul>');
		$.each(elements, function(i, element){
			ulTag.append('<li id="'+element.id_element+'"><img src="'+contentUrl+element.filename+'-thumb.'+element.ext+'" /></li>');
		});
		$('#single_side').append(ulTag);
	});
</script>

<div class="row">

<div id="single_main" class="eightcol">
	<div id="single_img"></div>
</div>
<div id="single_side" class="fourcol last"></div>

</div><!-- end of .row -->

<?php $this->load->view('includes/footer'); ?>