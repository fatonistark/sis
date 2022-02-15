<script src="<?= site_url('assets') ?>/assets/libs/jquery-number/jquery.number.min.js"></script>

<script type="text/javascript">
	$('#card-santri').hide();
	$('#card-checkout').hide();

	$(document).ready(function() {
		$(document).on('submit', '#form-search', function() {
			$.ajax({
				url: '<?= base_url('santri/get') ?>',
				type: 'POST',
				dataType: 'JSON',
				data: $(this).serialize(),
				success:function (data) {

					if (data != null) {
						$('.nama_lengkap').html(data.nama_lengkap);
						$('.nis').html(data.nis);
						$('.walletamount').number(data.walletamount);

						$('[name="nis"]').val(data.nis);
						$('[name="walletamount"]').val(data.walletamount);

						$('#card-santri').fadeIn(400);
						$('#card-checkout').fadeIn(500);

						$('[name="barcode"]').focus();
					}
				}
			});
			
			return false;
		});

		function addItem(id, title, price) {
			var jumlahRow = parseInt($('#total-item').val());
            jumlahRow = isNaN(jumlahRow) ? 0 : jumlahRow;
            var nextData = jumlahRow + 1;
			var row = '';
			var amount = price * 1;
			row = '<div class="card mb-1 p-0 card-item-data data-'+nextData+'">'+
						'<div class="card-body p-1">'+
							'<div class="row h-100">'+
								'<div class="col-2">'+
			                    	'<button data-ke="'+nextData+'" class="btn-delete-item btn btn-md btn-danger btn-rounded" type="button"><i class="fas fa-trash-alt"></i></button>'+
								'</div>'+

								'<div class="col-4 my-auto">'+
									'<span>'+title+'</span>'+
								'</div>'+

								'<div class="col-3 my-auto">'+
			                        'Rp. <span class="number">'+price+'</span>'+
								'</div>'+

								'<div class="col-3 my-auto">'+
			                        '<input type="hidden" name="retail_sub_item_id[]" class="form-control" value="'+id+'">'+ 
			                        '<input type="hidden" class="form-control price" value="'+price+'">'+
			                        '<input type="number" min="1" name="total_item[]" class="form-control total_item" data-ke="'+nextData+'" value="1">'+ // input jumlah
								'</div>'+

								'<input type="hidden" name="amount-item" value="'+amount+'">'
							'</div>'+
						'</div>'+
					'</div>';

			$('#total-item').val(nextData);
			$('#card-item-checkout').append(row);
            
            // $('[name="amount-item"]').val(amount);

            total_amount();
		}

		$('#card-item-checkout').on('click', '.btn-delete-item', function(event) {
			event.preventDefault();
			var row = $(this).attr('data-ke');
			$('.data-'+row).remove();

			total_amount();
		});

		$('#card-item-checkout').on('change', '.total_item', function(event) {
			event.preventDefault();
			var price = parseInt($('.card-item-data .price').val());
			var total_item = parseInt($(this).val());

			var ke = $(this).attr('data-ke');
			$('.data-'+ke+' [name="amount-item"]').val(price*total_item);
			// console.log(price*total_item);

			total_amount();
		});

		function total_amount() {
			var sum = 0;
			$('[name="amount-item"]').each(function () {
				sum += Number($(this).val());
			});

			$('.total-amount').html(sum);
			$('[name="amount"]').val(sum);
			$('.number').number(true);
		}

		$('#card-checkout').on('submit', '#form-search-item', function(event) {
			event.preventDefault();
			$.ajax({
				url: '<?= base_url('sub-item/getAll') ?>',
				type: 'POST',
				dataType: 'JSON',
				data: $(this).serialize(),
				success:function (data) {
					if (data != null) {
						addItem(data.id, data.title, data.price);
					}

					$('#form-search-item')[0].reset();
				}
			});
			
		});

		$(document).on('submit', '#form-bills', function(event) {
			event.preventDefault();
			var total = $('.total-amount').html().replace(',', '');
			
			if (Number(total) != 0) {
				$.ajax({
					url: '<?= base_url('transaction/create') ?>',
					type: 'POST',
					dataType: 'JSON',
					data: $(this).serialize(),
					success:function (response) {
						// console.log(response);
						notification(response.type, response.message);
						window.location.reload();
					}
				});
			}else{
				notification('error', 'Tidak ada barang yang di chekout, Silahkan scan barcode !');
				$('[name="barcode"]').focus();
			}

			return false;
		});

	});

</script>