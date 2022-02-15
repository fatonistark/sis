<script type="text/javascript">
	$(document).ready(function() {
		store();
		function store() {
			$.ajax({
				url: '<?= base_url('category-items/store') ?>',
				type: 'GET',
				dataType: 'JSON',
				success:function (data) {
					var html = '';
					console.log(data.length);
					for (var i = 0; i < data.length; i++) {

						html += '<div class="col-lg-6 col-xl-4 col-12"><div class="card"><div class="card-body"><div class="d-flex d-md-flex d-block align-items-center"><div><div class="d-inline-flex align-items-center"><h3 class="text-dark mb-1 font-weight-medium">'+ data[i].count +' item</h3><span class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-md-block d-none"><a class="text-white" href="">Lihat</a></span></div><h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">'+data[i].title+'</h6></div><div class="ml-auto mt-md-3 mt-lg-0"><button class="btn btn-warning text-white btn-update" data-id="'+data[i].id+'" data-title="'+data[i].title+'"><i class="fas fa-edit"></i></button><button data-id="'+data[i].id+'" class="btn btn-danger btn-delete"><i class="fas fa-trash-alt"></i></button></div></div></div></div></div>';

					}

					$('#list-category').html(html);
				}
			});
			
			return false;
		}

		function send(formData, nameAction) {
            $.ajax({
                url: '<?= base_url("category-items/") ?>'+nameAction+'',
                type: 'POST',
                dataType: 'JSON',
                data: formData,
                processData: false,
                contentType: false,
                // beforeSend: function()
                // { 
                //     // $("#btn-"+nameAction).prop('disabled', true);
                // },
                success:function (response) {
                    if (response.type == 'val_error') {
                        if (response.title) {
                            notification('error', response.title);
                        }

                        if (response.title_update) {
                            notification('error', response.title_update);
                        }
                        
                    } else {
                        notification(response.type, response.message)

                        $('#modal-'+nameAction).modal('hide');
                        $('#form-'+nameAction)[0].reset();

                        store();
                    }

                    // $("#btn-"+nameAction).prop('disabled', false);
                }
            });
        }

        $(document).on('submit', '#form-create', function() {
        	var formData = new FormData(this);
            send(formData, 'create');

            return false;
        });

        $(document).on('submit', '#form-update', function() {
        	var formData = new FormData(this);
            send(formData, 'update');

            return false;
        });

        $(document).on('submit', '#form-delete', function() {
        	var formData = new FormData(this);
            send(formData, 'delete');

            return false;
        });

        $('#list-category').on('click', '.btn-update', function() {
        	
        	$('[name="id_update"]').val($(this).attr('data-id'));
        	$('[name="title_update"]').val($(this).attr('data-title'));

        	$('#modal-update').modal('show');

        });

        $('#list-category').on('click', '.btn-delete', function() {
        	
        	$('[name="id_delete"]').val($(this).attr('data-id'));
        	$('#modal-delete').modal('show');

        });
	});
</script>