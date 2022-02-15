<script type="text/javascript">
	$(document).ready(function() {
		// console.log('tes');

		$(document).on('submit', '#form-login', function() {
			var data = $(this).serialize();
			$.ajax({
				url: '<?= base_url('login/process') ?>',
				type: 'POST',
				dataType: 'JSON',
				data:data,
				success:function (response) {
					notification(response.type, response.message);
					setTimeout(function() {
						window.location.href = response.redirect;
					}, 1000);
				}
			});
			
			return false;
		});

		// notification('error', 'Data Berhasil Disimpan');
	});
</script>