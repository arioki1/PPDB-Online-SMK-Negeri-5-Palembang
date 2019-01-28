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
            <div class="table-responsive">
                <table id="datatables" class="table table-striped" width="100%">
                    <form id="myform" action="" method="post">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Reg</th>
                            <th>NISN</th>
                            <th>Nama Lengkap</th>
                            <th>Asal Sekolah</th>
                            <th>Jurusan</th>
                            <th>Nilai UN</th>
                            <th>Nilai Minat Bakat</th>
                            <th>Total</th>
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
        var no = 0;
        table = $('#datatables').DataTable({
            responsive: true,
            dom: 'lBfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ],
            ajax: {
                url: '<?php echo(base_url() . 'ajax/ambil_data_hasil')?>',
                method: "POST"
            },
            columns: [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null
            ]
        });
    };

    function reload_table(string) {
        table.ajax.reload();
    }
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