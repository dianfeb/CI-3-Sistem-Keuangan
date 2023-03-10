<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        $('.cashflow').show();
        $('.nasabah').hide();

        $.ajax({
            url: '<?= base_url() ?>Cashflow/getKeuangan',
            type: 'POST',
            data: {

                status: 'Aktif',
            },
            success: function(response) {
                response = JSON.parse(response);

                $('#ttlsaldo').html(response.total_saldo);
                $('#ttltransaksi').html(response.nilai_transaksi);
                $('#setor_tunai').html(response.jmldepo);
                $('#jmlsetor_tunai').html(response.totaldepo);
                $('#transfer').html(response.jmltf);
                $('#jmltransfer').html(response.totaldepotf);
                $('#tarik_tunai').html(response.jmltarik);
                $('#jmltarik_tunai').html(response.totaltarik);
                $('#penarikan_pembayaran').html(response.jmlpembayaran);
                $('#jmlpenarikan_pembayaran').html(response.totaltariktf);


            }
        })
    })

    function filter() {
        // showTable();

        var tahun = $('#tahun').val();
        // alert(tahun);
        // console.log(id);
        $.ajax({
            url: '<?= base_url() ?>Cashflow/getKeuangan',
            type: 'POST',
            data: {
                tahun: tahun,

                status: 'Aktif',
            },
            success: function(response) {
                response = JSON.parse(response);

                // $('#ttlsaldo').html(response.total_saldo);
                $('#ttltransaksi').html(response.nilai_transaksi);
                $('#setor_tunai').html(response.jmldepo);
                $('#jmlsetor_tunai').html(response.totaldepo);
                $('#transfer').html(response.jmltf);
                $('#jmltransfer').html(response.totaldepotf);
                $('#tarik_tunai').html(response.jmltarik);
                $('#jmltarik_tunai').html(response.totaltarik);
                $('#penarikan_pembayaran').html(response.jmlpembayaran);
                $('#jmlpenarikan_pembayaran').html(response.totaltariktf);


            }
        })

    }

    function filter2() {
        // showTable();

        var dusun = $('#dusun').val();
        var kelurahan = $('#kelurahan').val();
        var kecamatan = $('#kecamatan').val();
        // alert(tahun);
        // console.log(id);
        $.ajax({
            url: '<?= base_url() ?>Cashflow/getKeuanganNasabah',
            type: 'POST',
            data: {
                dusun: dusun,
                kelurahan: kelurahan,
                kecamatan: kecamatan,

                status: 'Aktif',
            },
            success: function(response) {
                response = JSON.parse(response);
                $('#total_nasabah').html(response.total_nasabah);
                $('#total_transaksi_nasabah').html(response.nilai_transaksi);
                // $('#ttlsaldo').html(response.total_saldo);



            }
        })

    }

    function filter7() {
        // showTable();

        // $('#myChart').destroy();
        var bulannasabah = $('#bulannasabah').val();
        // alert(bulannasabah);
        // console.log(id);
        $.ajax({
            url: '<?= base_url() ?>Cashflow/getKeuanganChart2',
            type: 'POST',
            data: {
                bulannasabah: bulannasabah,


                status: 'Aktif',
            },
            success: function(response) {
                // Chart.update();     
                // $('#myChart').show();

                // console.log(data);
                data = JSON.parse(response);
                var xValues = [];
                var yValues = [];
                var totaldepo = 0;
                var totaltarik = 0;
                var totaldepotf = 0;
                var totaltariktf = 0;

                var jmldepo = 0;
                var jmltf = 0;
                var jmltarik = 0;
                var jmlpembayaran = 0;
                for (var i in data) {


                    // console.log(data.depo[i].j   umlah);
                    // console.log(depo[i].jumlah);
                    // totaldepo = totaldepo + response[i].depo;
                    // totaldepo++;
                    // jmldepo++;


                    // totaldepotf = totaldepotf + data[i].depotf.jumlah;
                    // // totaldepo++;
                    // jmltf++;


                    // totaltarik = totaltarik + data[i].tarik.jumlah;
                    // // totaltarik++;
                    // jmltarik++;


                    // totaltariktf = totaltariktf + data[i].tariktf.jumlah;
                    // // totaldepo++;
                    // jmlpembayaran++;
                }
                // var total_nasabah = jmldepo + jmltf + jmltarik + jmlpembayaran;
                // var nilai_transaksi = (totaldepo + totaldepotf) + (totaltarik + totaltariktf);
                // console.log(totaldepo);


                // yValues.push(data[i].icumsa);
                // xValues.push(withoutsecond[0] + ":" + withoutsecond[1]);

                var barColors = ["#00b5e9"];


                // $totalsaldo = ($totaldepo + $totaldepotf) - ($totaltarik + $totaltariktf);



                const ctx = document.getElementById('myChart');


                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Total Nasabah'],
                        datasets: [{
                            label: [data.total_nasabah],
                            data: [data.total_nasabah],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
                //   Chart.destroy();
                // $('#ttlsaldo').html(response.total_saldo);



            }
        })

    }

    $('#bulan').change(function() {
        var bulan = $('#bulan').val();
        // console.log(id);
        $.ajax({
            url: '<?= base_url() ?>Cashflow/getKeuanganBulan',
            type: 'POST',
            data: {
                bulan: bulan,

                status: 'Aktif',
            },
            success: function(response) {
                response = JSON.parse(response);

                // $('#ttlsaldo').html(response.total_saldo);

                $('#ttlbulan').html(response.ttlbulan);


            }
        })
    })

    function jenis(id) {


        if (id == "cashflow") {
            $('.cashflow').show();
            $('.nasabah').hide();
        } else {
            $('.cashflow').hide();
            $('.nasabah').show();

            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
                .then((response) => response.json())
                .then((provinces) => {
                    var data = provinces;
                    var pelanggan = `<option>Pilih</option>`;
                    data.forEach((element) => {
                        pelanggan += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                    });
                    document.getElementById("provinsi").innerHTML = pelanggan;
                });
            const selectProvinsi = document.getElementById('provinsi');
            const selectKabupaten = document.getElementById('kabupaten');
            const selectKecamatan = document.getElementById('kecamatan');
            const selectKelurahan = document.getElementById('kelurahan');

            selectProvinsi.addEventListener('change', (e) => {
                var provinsi = e.target.options[e.target.selectedIndex].dataset.prov;
                fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
                    .then((response) => response.json())
                    .then((regencies) => {
                        var data = regencies;
                        var pelanggan = `<option>Pilih</option>`;
                        document.getElementById('kabupaten').innerHTML = '<option>Pilih</option>';
                        document.getElementById('kecamatan').innerHTML = '<option>Pilih</option>';
                        document.getElementById('kelurahan').innerHTML = '<option>Pilih</option>';
                        data.forEach((element) => {
                            pelanggan += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                        });
                        document.getElementById("kabupaten").innerHTML = pelanggan;
                    });
            });

            selectKabupaten.addEventListener('change', (e) => {
                var kabupaten = e.target.options[e.target.selectedIndex].dataset.prov;
                fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kabupaten}.json`)
                    .then((response) => response.json())
                    .then((districts) => {
                        var data = districts;
                        var pelanggan = `<option>Pilih</option>`;
                        document.getElementById('kecamatan').innerHTML = '<option>Pilih</option>';
                        document.getElementById('kelurahan').innerHTML = '<option>Pilih</option>';
                        data.forEach((element) => {
                            pelanggan += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                        });
                        document.getElementById("kecamatan").innerHTML = pelanggan;
                    });
            });
            selectKecamatan.addEventListener('change', (e) => {
                var kecamatan = e.target.options[e.target.selectedIndex].dataset.prov;
                fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatan}.json`)
                    .then((response) => response.json())
                    .then((villages) => {
                        var data = villages;
                        var pelanggan = `<option>Pilih</option>`;
                        document.getElementById('kelurahan').innerHTML = '<option>Pilih</option>';
                        data.forEach((element) => {
                            pelanggan += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                        });
                        document.getElementById("kelurahan").innerHTML = pelanggan;
                    });
            });



        }
    }
</script>