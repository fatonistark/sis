<!--This page plugins -->
<script src="<?= site_url('assets') ?>/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= site_url('assets') ?>/dist/js/pages/datatable/datatable-basic.init.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        get_category_retail();
            
        table = $('#table-items').DataTable({
            "pageLength": 25,
            "dom": 'lTfgtp',
            "buttons": [{
                extend: 'copy'
            },{
                extend: 'csv'
            },{
                extend: 'excel', title: 'ExampleFile'
            },{
                extend: 'pdf', title: 'ExampleFile'
            },{
                extend: 'print', 
                customize: function (win)
                {
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');
                    $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit');
                }
            }
            ],
            "processing": true, 
            "serverSide": true,
            // "responsive": true,
            "order": [],
            "autoWidth" : true,
            // "scrollX": true,
            // "scrollY": "300px",
            
            "ajax": {
                "url": "<?= base_url('items/store')?>",
                "type": "POST"
            },

            "language": {
                "search": "",
                "searchPlaceholder": "Search . . .",
                "lengthMenu":"_MENU_",
                "emptyTable":"Tidak ada data",
                "zeroRecords":"Tidak ada data yang sesuai"
            }
        });

        function reload_table() {
            table.ajax.reload(null, false);
        }

        function get_category_retail() {
            var option = '';
            var select = $('.select-category');
            $.getJSON('<?= base_url('category-items/store') ?>', function(data, textStatus) {
                for (var i = 0; i < data.length; i++) {
                    option += '<option value="'+data[i].id+'">'+data[i].title+'</option>';
                }

                select.html(option);
            });

            return false;
        }

        function send(formData, nameAction) {
            $.ajax({
                url: '<?= base_url("items/") ?>'+nameAction+'',
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

                        if (response.price) {
                            notification('error', response.price);
                        }

                        if (response.retail_category_id) {
                            notification('error', response.retail_category_id);
                        }

                    } else {
                        notification(response.type, response.message)

                        $('#modal-'+nameAction).modal('hide');
                        $('#form-'+nameAction)[0].reset();

                        reload_table();
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

        $('#table-items').on('click', '.btn-update', function() {
            
            $('[name="id_update"]').val($(this).attr('data-id'));
            $('[name="title_update"]').val($(this).attr('data-title'));
            $('[name="price_update"]').val($(this).attr('data-price'));
            $('[name="retail_category_id_update"]').val($(this).attr('data-category'));

            $('#modal-update').modal('show');

        });

        $('#table-items').on('click', '.btn-delete', function() {
            
            $('[name="id_delete"]').val($(this).attr('data-id'));
            $('#modal-delete').modal('show');

        });
    });


    
</script>