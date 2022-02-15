<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.4/b-2.2.2/b-html5-2.2.2/b-print-2.2.2/datatables.min.js"></script>

<script type="text/javascript">
    $('#row-report').hide();
    $(document).ready(function() {
        function reload_table() {
            var table = $('#table-report-attendances').DataTable({
                // "pageLength": 25,
                "dom": 'B',
                "paging": false,
                "searching": false,
                "retrieve": true,
                "destroy": true,
                "orientation": 'landscape',
                "buttons": [{
                        extend: 'copy'
                    },{
                        extend: 'csv'
                    },{
                        extend: 'excel'
                    },{
                        extend: 'pdf'
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
            });
        }

        $(document).on('submit', '#form-filter', function(event) {
            event.preventDefault();
            var startDate = new Date($('[name="tanggal_awal"]').val());
            var endDate = new Date($('[name="tanggal_akhir"]').val());

            var Difference_In_Time = endDate.getTime() - startDate.getTime();
  
            // hitung jml hari antara dua tanggal
            var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

            // console.log(Difference_In_Days)
            if (startDate > endDate) {
                notification('warning', 'Tanggal awal harus lebih kecil');
            }else if(Difference_In_Days > 58){
                notification('error', 'Maksimal range filter 58 hari');
            }else{
                $.ajax({
                    url: '<?= base_url('report-attendances/get') ?>',
                    type: 'POST',
                    dataType: 'HTML',
                    data: $(this).serialize(),
                    beforeSend:function () {
                        $('#table-report-attendances thead').empty();
                        $('#table-report-attendances tbody').empty();
                        // table.clear().destroy();
                    },
                    success:function (html) {
                        $('#row-report').fadeIn(400);
                        $('#table-report-attendances').html(html);
                        reload_table();
                        // $('#table-report-attendances').html(html);
                    }
                });
            }

            return false;
            
        });
    });
</script>