
<script src="<?= site_url('assets') ?>/assets/extra-libs/c3/d3.min.js"></script>
<script src="<?= site_url('assets') ?>/assets/extra-libs/c3/c3.min.js"></script>
<script src="<?= site_url('assets') ?>/assets/libs/chartist/dist/chartist.min.js"></script>
<script src="<?= site_url('assets') ?>/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="<?= site_url('assets') ?>/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
<script src="<?= site_url('assets') ?>/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= site_url('assets') ?>/dist/js/pages/dashboards/dashboard1.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		get();
		function get() {
			$.ajax({
				url: '<?= base_url('Dashboard/get') ?>',
				type: 'GET',
				dataType: 'JSON',
				success:function (data) {
					var html = '';
					// console.log(data);

					$.each(data, function(name, data) {
						html += '<div class="card border-right">'+
							        '<div class="card-body">'+
							            '<div class="d-flex d-lg-flex d-md-block align-items-center">'+
							                '<div>'+
							                    '<div class="d-inline-flex align-items-center">'+
							                        '<h2 class="text-dark mb-1 font-weight-medium">'+data.total+'</h2>'+
							                    '</div>'+
							                    '<h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">'+data.title+'</h6>'+
							                '</div>'+
							                '<div class="ml-auto mt-md-3 mt-lg-0">'+
							                    '<span class="opacity-7 text-muted"><i class="'+data.icon+' fa-2x"></i></span>'+
							                '</div>'+
							            '</div>'+
							        '</div>'+
							    '</div>';
					});

					$('#card-group').html(html);
				}
			});

			return false;
		}
	});
</script>