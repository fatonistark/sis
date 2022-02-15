
<div class="row mb-2">
    <div class="col-md-12">
        <button class="btn btn-success" id="btn-tambah" data-toggle="modal" data-target="#modal-create"><i class="fa fa-plus"></i> Tambah</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Santri</h4>
                <h6 class="card-subtitle">Dibawah ini adalah daftar Santri yang ada pada sistem ini.</h6>
                
                <div class="table-responsive">
                    <table class="table table-stripped" id="table-santri">
                        <thead>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Kode RFID</th>
                            <th>Nama Lengkap</th>
                            <th>Saldo</th>
                            <th>Orang Tua</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-create" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="success-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-success">
                <h4 class="modal-title" id="success-header-modalLabel">Tambah Santri
                </h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="form-create" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="text" name="nis" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Kode RFID</label>
                        <input type="text" name="tag_id" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Saldo</label>
                        <input type="text" name="walletamount" class="form-control number">
                    </div>

                    <div class="form-group">
                        <label>Orang Tua</label>
                        <select class="form-control select-parrents" name="parrent_id">
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" form="form-create" class="btn btn-success">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="modal-update" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="warning-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-warning">
                <h4 class="modal-title" id="warning-header-modalLabel">Update Santri
                </h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="form-update" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="text" name="nis_update" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap_update" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Kode RFID</label>
                        <input type="text" name="tag_id_update" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Saldo</label>
                        <input type="text" name="walletamount_update" class="form-control number">
                    </div>

                    <div class="form-group">
                        <label>Orang Tua</label>
                        <select class="form-control select-parrents" name="parrent_id_update">
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" form="form-update" class="btn btn-success">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="warning-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-danger">
                <h4 class="modal-title" id="warning-header-modalLabel">Delete Santri
                </h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus data ini ?
                <form id="form-delete" enctype="multipart/form-data">
                    <input type="hidden" name="nis_delete">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-dismiss="modal">Close</button>
                <button type="submit" form="form-delete" class="btn btn-danger">Hapus</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>