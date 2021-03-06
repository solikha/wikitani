<div class="row">
    <script src="<?php echo base_url(); ?>themes/aceadmin/js/jquery.js" type="text/javascript"></script>
    <link href="<?php echo base_url(); ?>themes/aceadmin/css/c3-b03125fa.css" media="screen" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url(); ?>themes/aceadmin/js/d3-3.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>themes/aceadmin/js/c3.js" type="text/javascript"></script>
    <div class="col-sm-12" style="height: 500px;">
        <div class="page-header">
            <h4>
                Data Semua Layanan
                <small>
                    BAR Chart
                </small>
            </h4>
        </div>
        Option Jenis Layanan : <select id="list">
            <option value="">-- Pilih Layanan --</option>
            <option value="all">Semua Layanan</option>
            <?php
            foreach ($layanan_name as $key => $value) {
                echo '<option value="' . $value['id'] . '">' . $value['nama'] . '</option>';
            }
            ?>
        </select>
        Tahun : <select id="starttahun">
            <option value="">pilih tahun</option>
            <?php
            for ($i = 1999; $i <= date("Y"); $i++) {
                echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>
        </select>
        <button id="getdatalayanan" class="btn-group btn btn-sm btn-info">Tampilkan</button>
        <br/>
        <h4><div id="namaLayanan"></div></h4>
        <div class="chart">
            <div style="max-height: 280px; position: relative;" class="c3" id="layanan_all"></div>
        </div>
    </div>
</div>
<script>
    var chart = c3.generate({
        bindto: '#layanan_all',
        data: {
            x: 'x',
            columns: <?php echo $layanan_all; ?>,
            type: 'bar'
        },
        axis: {
            x: {
                type: 'categorized',
            }
        }
    });

    $("#getdatalayanan").click(function () {
        var layanan = $('#list option:selected').val();
        var tahun = $('#starttahun option:selected').val();
        if (layanan.length === 0) {
            console.log(layanan);
            alert('layanan harus di pilih');
        } else if (tahun.length === 0) {
            console.log(tahun);
            alert('tahun harus di pilih');
        } else {
            var layanans = $('#list option:selected').text();
            $.post('<?php echo base_url() . "index.php/chart/getdatalayanan/"; ?>' + layanan + '/' + tahun, function (datas) {
                var ardata = jQuery.parseJSON(datas);

                c3js(ardata);
                $('#namaLayanan').html(layanans);
            });
        }
    });

    function c3js(datas) {
        c3.generate({
            bindto: '#layanan_all',
            data: {
                x: 'x',
                columns: datas,
                type: 'bar'
            },
            axis: {
                x: {
                    type: 'categorized',
                }
            }
        });
    }
</script>