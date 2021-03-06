<script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

<div class="col-md-12">
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col-sm-4 col-xs-12"></div>
                <div class="col-sm-4 col-xs-12 table-bordered">
                    <div class="form-group">
                        <select name="filter_jurusan" id="filter_jurusan" class="form-control" required>
                            <option value="" <?php if (isset($filter) && $filter == "") echo "selected" ?>>Semua
                                Jurusan
                            </option>
                            <option value="akuntansi" <?php if (isset($filter) && $filter == "akuntansi") echo "selected" ?>>
                                Akuntansi
                            </option>
                            <option value="administrasiperkantoran" <?php if (isset($filter) && $filter == "administrasiperkantoran") echo "selected" ?>>
                                Administrasi Perkantoran
                            </option>
                            <option value="pemasaran" <?php if (isset($filter) && $filter == "pemasaran") echo "selected" ?>>
                                Pemasaran
                            </option>
                            <option value="animasi" <?php if (isset($filter) && $filter == "animasi") echo "selected" ?>>
                                Animasi
                            </option>
                            <option value="multimedia" <?php if (isset($filter) && $filter == "multimedia") echo "selected" ?>>
                                Multimedia
                            </option>
                            <option value="tp4" <?php if (isset($filter) && $filter == "tp4") echo "selected" ?>>Teknik
                                Produksi dan Penyiaran Program Pertelevisian
                        </select>
                    </div>
                    <div class="form-group" align="center">
                        <button type="button" name="filter" id="filter" class="btn btn-<?php rubah_warna() ?>">Filter
                        </button>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12 text-right">
                    <button class="btn btn-<?php rubah_warna() ?>"
                            onclick="window.location.href='<?php echo(base_url() . 'admin/tambahdata_siswa') ?>'">
                                        <span class="btn-label">
                                            <i class="material-icons">control_point</i>
                                        </span>
                        Tambah Data
                    </button>
                    <button class="btn btn-<?php rubah_warna2() ?>"
                            onclick="deletemultiple()">
                                        <span class="btn-label">
                                            <i class="material-icons">control_point</i>
                                        </span>
                        Hapus Data
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table id="datatables" class="table table-striped" width="100%">
                    <form id="myform" action="#" method="post">
                        <thead>
                        <tr>
                            <th><input name="select_all" value="1" id="example-select-all" type="checkbox"></th>
                            <th>No. Reg</th>
                            <th>NISN</th>
                            <th>Nama Lengkap</th>
                            <th>Asal Sekolah</th>
                            <th>Kopetensi Keahlian</th>
                            <th>Nilai UN</th>
                            <th>Nilai USBN</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </form>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var table;
    window.onload = function () {
        table = $('#datatables').DataTable({
            "bProcessing": true,
            "bServerSide": true,
            responsive: true,
            dom: 'lBfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ],
            ajax: {
                url: "<?php echo base_url('ajax/ambil_data_pendaftaran') ?>",
                type: 'POST',
            },
            "columnDefs": [
                {"orderable": false, "targets": 0}
            ],
            "aoColumns": [
                {
                    "mData": "0",
                    "mRender": function (data, type, full) {
                        return '<input type="checkbox" class="select-row" data-id="' + full[2] + '" />'
                    }
                },
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {
                    "mData": "0",
                    "mRender": function (data, type, full) {
                        if (full[1] == "" || full[1] == null) {
                            return '<a href="#" onclick=delete_id("' + full[2] + '")><span class="label label-<?php rubah_warna2() ?>">Hapus<span></a>' +
                                '<a href="<?php echo(base_url())?>admin/ubahdata_siswa?nisn=' + full[2] + '" onclick=""><span class="label label-<?php rubah_warna() ?>">Edit<span></a>' +
                                '<a href="#" onclick=verifikasi("' + full[2] + '")><span class="label label-<?php rubah_warna3() ?>">Verifikasi<span></a>';
                        } else {
                            return '<a href="#" onclick=delete_id("' + full[2] + '")><span class="label label-<?php rubah_warna2() ?>">Hapus<span></a>' +
                                '<a href="<?php echo(base_url())?>admin/ubahdata_siswa?nisn=' + full[2] + '" onclick=""><span class="label label-<?php rubah_warna() ?>">Edit<span></a>';
                        }
                    }
                }
            ]
        });
        $('#datatables').DataTable().column(1).visible(false);
    };

    function delete_id(id) {
        swal({
            title: 'Hapus Data!!',
            text: "Apakah Anda yakin untuk menghapus data ini?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Iya, Hapus!',
            buttonsStyling: false
        }).then(function () {
            $.ajax({
                url: "<?php echo(base_url() . 'ajax/hapus_siswa')?>",
                type: "POST",
                data: {nisn: id},
                dataType: "html",
                success: function () {
                    swal({
                        title: 'Deleted!',
                        text: 'Jurusan Berhasil Di Hapus.',
                        type: 'success',
                        confirmButtonClass: "btn btn-success",
                        buttonsStyling: false
                    });
                    table.ajax.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error!", "Please try again", "error");
                }
            });
        });
    }

    function verifikasi(id) {
        swal({
            title: 'Verifikasi Data',
            text: "Apakah Anda yakin untuk Verifikasi data ini?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Iya!',
            buttonsStyling: false
        }).then(function () {
            $.ajax({
                url: "<?php echo(base_url() . 'ajax/verifikasi/')?>" + id,
                type: "GET",
                dataType: "html",
                success: function () {
                    swal({
                        title: 'Verifikasi Data',
                        text: 'Verifikasi Data Berhasil',
                        type: 'success',
                        confirmButtonClass: "btn btn-success",
                        buttonsStyling: false
                    });
                    table.ajax.reload();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal("Error!", "Please try again", "error");
                }
            });
        });
    }

    $('#example-select-all').on('click', function () {
        var rows = table.rows({'search': 'applied'}).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
    });

    function deletemultiple() {
        swal({
            title: 'Hapus Data!!',
            text: "Apakah Anda yakin untuk menghapus semua data yang di pilih?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Iya, Hapus!',
            buttonsStyling: false
        }).then(function () {
            var delete_selected = [];
            $(".select-row:checked").map(function () {
                delete_selected.push($(this).data('id'));
            });
            data_to_send = {
                nisn: delete_selected
            };
            $.ajax({
                data: data_to_send,
                method: 'post',
                dataType: 'json',
                url: 'http://arioki.web/ajax/multi_delete',
                success: function (output) {
                    if (output.success) {
                        alert("berhasil");
                        location.reload();
                    }
                }
            });
            table.ajax.reload();
        })
    };
    $('#filter').click(function () {
        var filter = $('#filter_jurusan').val();
        $.ajax({
            url: '<?php echo(base_url() . 'admin/filter/')?>' + filter,
            type: "GET",
            success: function (data) {
                table.ajax.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal("Error!", "Please try again", "error");
            }
        });
    });
</script>

<style>
    button.dt-button, div.dt-button, a.dt-button {
        position: relative;
        display: inline-block;
        box-sizing: border-box;
        margin-right: 0.333em;
        margin-bottom: 0.333em;
        padding: 0.5em 1em;
        border: 1px solid #999;
        border-radius: 2px;
        cursor: pointer;
        font-size: 0.88em;
        line-height: 1.6em;
        color: black;
        white-space: nowrap;
        overflow: hidden;
        background-color: #e9e9e9;
        background-image: -webkit-linear-gradient(top, #fff 0%, #e9e9e9 100%);
        background-image: -moz-linear-gradient(top, #fff 0%, #e9e9e9 100%);
        background-image: -ms-linear-gradient(top, #fff 0%, #e9e9e9 100%);
        background-image: -o-linear-gradient(top, #fff 0%, #e9e9e9 100%);
        background-image: linear-gradient(to bottom, #fff 0%, #e9e9e9 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0, StartColorStr='white', EndColorStr='#e9e9e9');
    }
</style>