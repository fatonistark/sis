<!--This page plugins -->
<script src="<?= site_url('assets') ?>/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= site_url('assets') ?>/dist/js/pages/datatable/datatable-basic.init.js"></script>
<script src="<?= site_url('assets') ?>/assets/libs/jquery-number/jquery.number.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {

        get_parrents();
        $('.number').number(true);

        table = $('#table-santri').DataTable({
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
                "url": "<?= base_url('santri/store')?>",
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

        function get_parrents() {
            var option = '';
            var select = $('.select-parrents');
            $.getJSON('<?= base_url('parrents/get') ?>', function(data, textStatus) {

                option += '<option>Pilih Orang Tua</option>';
                for (var i = 0; i < data.length; i++) {
                    option += '<option value="'+data[i].id+'">'+data[i].nama_lengkap+'</option>';
                }

                select.html(option);
            });

            return false;
        }

        function send(formData, nameAction) {
            $.ajax({
                url: '<?= base_url("santri/") ?>'+nameAction+'',
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
                        if (response.nis) {
                            notification('error', response.nis);
                        }

                        if (response.nama_lengkap) {
                            notification('error', response.nama_lengkap);
                        }

                        if (response.tag_id) {
                            notification('error', response.tag_id);
                        }

                        if (response.walletamount) {
                            notification('error', response.walletamount);
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

        $('#table-santri').on('click', '.btn-update', function() {
            
            $('[name="nis_update"]').val($(this).attr('data-nis'));
            $('[name="nama_lengkap_update"]').val($(this).attr('data-nama'));
            $('[name="tag_id_update"]').val($(this).attr('data-tag'));
            $('[name="walletamount_update"]').val($(this).attr('data-walletamount'));
            $('[name="parrent_id_update"]').val($(this).attr('data-parrent'));

            $('#modal-update').modal('show');

        });

        $('#table-santri').on('click', '.btn-delete', function() {
            
            $('[name="nis_delete"]').val($(this).attr('data-nis'));
            $('#modal-delete').modal('show');

        });
    });


    
</script>