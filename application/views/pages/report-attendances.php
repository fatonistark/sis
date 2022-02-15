<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form id="form-filter" enctype="multipart/form-data">
                    <div class="row">
                        <!-- <div class="col-md">
                             <div class="form-group">
                                <label>Santri</label>
                                <select name="santri_nis" class="form-control select-santri"></select>
                            </div>
                        </div> -->

                        <div class="col-md">
                            <div class="form-group">
                                <label>Tanggal Awal</label>
                                <input type="date" name="tanggal_awal" class="form-control">
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md text-right">
                            <button class="btn btn-info">Filter</button>
                        </div> 
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

<div class="row" id="row-report">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm no-wrap" id="table-report-attendances">

                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md">
                        <span class="badge badge-danger">TH</span> = Tidak Hadir
                    </div>

                    <div class="col-md">
                        <span class="badge badge-success">H</span> = Hadir
                    </div>

                    <div class="col-md">
                        <span class="badge badge-info">L</span> = Hari Libur
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
