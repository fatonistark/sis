
<div class="row mb-2">
    <div class="col-md-12">
        <button class="btn btn-success" id="btn-tambah" data-toggle="modal" data-target="#modal-create"><i class="fa fa-plus"></i> Tambah</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="d-flex flex-wrap" id="list-category">
            
        </div>
    </div>
</div>


<div id="modal-create" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="success-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-success">
                <h4 class="modal-title" id="success-header-modalLabel">Tambah Kategori
                </h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="form-create" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-dismiss="modal">Close</button>
                <button type="submit" form="form-create" class="btn btn-success">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="modal-update" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="warning-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-warning">
                <h4 class="modal-title" id="warning-header-modalLabel">Update Kategori
                </h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="form-update" enctype="multipart/form-data">
                    <input type="hidden" name="id_update">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title_update" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-dismiss="modal">Close</button>
                <button type="submit" form="form-update" class="btn btn-warning">Update</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="warning-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-danger">
                <h4 class="modal-title" id="warning-header-modalLabel">Delete Kategori
                </h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus data ini ?
                <form id="form-delete" enctype="multipart/form-data">
                    <input type="hidden" name="id_delete">
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