<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#addProdakForm').submit(function(e) {
            e.preventDefault();
            let name = $('#name').val();
            let price = $('#price').val();
            let nama_proses = $('#nama_proses').val();
            let klasifikasi_perubahan = $('input[name="klasifikasi_perubahan"]:checked').val();
            let pelaksanaan2ndQA = $('input[name="pelaksanaan2ndQA"]:checked').val();
            let item_perubahan = $('#item_perubahan').val();
            let no_lembar_instruksi = $('#no_lembar_instruksi').val();
            let tanggal_produksi_saat_perubahan = $('#tanggal_produksi_saat_perubahan').val();
            let shiftt = $('input[name="shiftt"]:checked').val();
            let part_number_finish_good = $('#part_number_finish_good').val();
            let kualitas = $('input[name="kualitas"]:checked').val();
            let fakta_ng = $('#fakta_ng').val();
            let pcdt = $('input[name="pcdt"]:checked').val();
            let tanggal_perubahan_pcdt = $('#tanggal_perubahan_pcdt').val();
            let instruksi_kerja = $('input[name="instruksi_kerja"]:checked').val();
            let tanggal_perubahan_instruksi_kerja = $('#tanggal_perubahan_instruksi_kerja').val();
            let isir = $('input[name="isir"]:checked').val();
            let tanggal_perubahan_isir = $('#tanggal_perubahan_isir').val();
            let pemahaman = $('#pemahaman').val();
            let ulasan = $('#ulasan').val();

            $.ajax({
                url: "{{ route('add.prodak') }}",
                method: 'post',
                data: {
                    name: name,
                    price: price,
                    nama_proses: nama_proses,
                    klasifikasi_perubahan: klasifikasi_perubahan,
                    pelaksanaan2ndQA: pelaksanaan2ndQA,
                    item_perubahan: item_perubahan,
                    no_lembar_instruksi: no_lembar_instruksi,
                    tanggal_produksi_saat_perubahan: tanggal_produksi_saat_perubahan,
                    shiftt: shiftt,
                    part_number_finish_good: part_number_finish_good,
                    kualitas: kualitas,
                    fakta_ng: fakta_ng,
                    pcdt: pcdt,
                    tanggal_perubahan_pcdt: tanggal_perubahan_pcdt,
                    instruksi_kerja: instruksi_kerja,
                    tanggal_perubahan_instruksi_kerja: tanggal_perubahan_instruksi_kerja,
                    isir: isir,
                    tanggal_perubahan_isir: tanggal_perubahan_isir,
                    pemahaman: pemahaman,
                    ulasan: ulasan
                    // Add other data fields as needed
                },

                success: function(res) {
                    if (res.status == 'success') {
                        $('#addModal').modal('hide');
                        $('#addProdakForm')[0].reset();
                        $('.table').load(location.href + ' .table');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data berhasil ditambahkan',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('prodaks') }}";
                            }
                        });

                    }
                },
                error: function(err) {
                    let errors = err.responseJSON.errors;
                    $.each(errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' + value + '</span>' + '<br>');
                    });
                }

            });
        });

        $(document).on('click', '.delete_prodak', function(e) {
            e.preventDefault();
            let prodak_id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this product!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('delete.prodak') }}",
                        method: 'post',
                        data: {
                            prodak_id: prodak_id
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                $('.table').load(location.href + ' .table');
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                );
                            }
                        },
                        error: function(err) {
                            $('.errMsgContainer').html('');
                            let errors = err.responseJSON.errors;
                            $.each(errors, function(index, value) {
                                $('.errMsgContainer').append('<span class="text-danger">' + value + '</span>' + '<br>');
                            });
                        }
                    });
                }
            });
        });


        // menampilkan modal update data
        $(document).on('click', '.updateProdakForm', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');
            let nama_proses = $(this).data('nama_proses');
            let klasifikasi_perubahan = $(this).data('klasifikasi_perubahan');
            let pelaksanaan2ndQA = $(this).data('pelaksanaan2ndQA');
            let item_perubahan = $(this).data('item_perubahan');
            let no_lembar_instruksi = $(this).data('no_lembar_instruksi');
            let tanggal_produksi_saat_perubahan = $(this).data('tanggal_produksi_saat_perubahan');
            let shiftt = $(this).data('shiftt');
            let part_number_finish_good = $(this).data('part_number_finish_good');
            let kualitas = $(this).data('kualitas');
            let fakta_ng = $(this).data('fakta_ng');
            let pcdt = $(this).data('pcdt');
            let tanggal_perubahan_pcdt = $(this).data('tanggal_perubahan_pcdt');
            let instruksi_kerja = $(this).data('instruksi_kerja');
            let tanggal_perubahan_instruksi_kerja = $(this).data('tanggal_perubahan_instruksi_kerja');
            let isir = $(this).data('isir');
            let tanggal_perubahan_isir = $(this).data('tanggal_perubahan_isir');
            let pemahaman = $(this).data('pemahaman');

            $('#up_id').val(id);
            $('#up_name').val(name);
            $('#up_price').val(price);
            $('#up_nama_proses').val(nama_proses);
            $('#up_klasifikasi_perubahan').val(klasifikasi_perubahan);
            $('#up_pelaksanaan2ndQA').val(pelaksanaan2ndQA);
            $('#up_item_perubahan').val(item_perubahan);
            $('#up_no_lembar_instruksi').val(no_lembar_instruksi);
            $('#up_tanggal_produksi_saat_perubahan').val(tanggal_produksi_saat_perubahan);
            $('#up_shiftt').val(shiftt);
            $('#up_part_number_finish_good').val(part_number_finish_good);
            $('#up_kualitas').val(kualitas);
            $('#up_fakta_ng').val(fakta_ng);
            $('#up_pcdt').val(pcdt);
            $('#up_tanggal_perubahan_pcdt').val(tanggal_perubahan_pcdt);
            $('#up_instruksi_kerja').val(instruksi_kerja);
            $('#up_tanggal_perubahan_instruksi_kerja').val(tanggal_perubahan_instruksi_kerja);
            $('#up_isir').val(isir);
            $('#up_tanggal_perubahan_isir').val(tanggal_perubahan_isir);
            $('#up_pemahaman').val(pemahaman);

        });
        // update prodak 
        $(document).on('click', '.update_prodak', function(e) {
            e.preventDefault();
            let up_id = $('#up_id').val();
            let up_name = $('#up_name').val();
            let up_price = $('#up_price').val();
            let up_nama_proses = $('#up_nama_proses').val();
            let up_klasifikasi_perubahan = $('#up_klasifikasi_perubahan').val();
            let up_pelaksanaan2ndQA = $('#up_pelaksanaan2ndQA').val();
            let up_item_perubahan = $('#up_item_perubahan').val();
            let up_no_lembar_instruksi = $('#up_no_lembar_instruksi').val();
            let up_tanggal_produksi_saat_perubahan = $('#up_tanggal_produksi_saat_perubahan').val();
            let up_shiftt = $('#up_shiftt').val();
            let up_part_number_finish_good = $('#up_part_number_finish_good').val();
            let up_kualitas = $('#up_kualitas').val();
            let up_fakta_ng = $('#up_fakta_ng').val();
            let up_pcdt = $('#up_pcdt').val();
            let up_tanggal_perubahan_pcdt = $('#up_tanggal_perubahan_pcdt').val();
            let up_instruksi_kerja = $('#up_instruksi_kerja').val();
            let up_tanggal_perubahan_instruksi_kerja = $('#up_tanggal_perubahan_instruksi_kerja').val();
            let up_isir = $('#up_isir').val();
            let up_tanggal_perubahan_isir = $('#up_tanggal_perubahan_isir').val();
            let up_pemahaman = $('#up_pemahaman').val();

            $.ajax({
                url: "{{route('update.prodak')}}",
                method: 'post',
                data: {
                    up_id: up_id,
                    up_name: up_name,
                    up_price: up_price,
                    up_nama_proses: up_nama_proses,
                    up_klasifikasi_perubahan: up_klasifikasi_perubahan,
                    up_pelaksanaan2ndQA: up_pelaksanaan2ndQA,
                    up_item_perubahan: up_item_perubahan,
                    up_no_lembar_instruksi: up_no_lembar_instruksi,
                    up_tanggal_produksi_saat_perubahan: up_tanggal_produksi_saat_perubahan,
                    up_shiftt: up_shiftt,
                    up_part_number_finish_good: up_part_number_finish_good,
                    up_kualitas: up_kualitas,
                    up_fakta_ng: up_fakta_ng,
                    up_pcdt: up_pcdt,
                    up_tanggal_perubahan_pcdt: up_tanggal_perubahan_pcdt,
                    up_instruksi_kerja: up_instruksi_kerja,
                    up_tanggal_perubahan_instruksi_kerja: up_tanggal_perubahan_instruksi_kerja,
                    up_isir: up_isir,
                    up_tanggal_perubahan_isir: up_tanggal_perubahan_isir,
                    up_pemahaman: up_pemahaman
                    // Tambahkan data lainnya sesuai dengan kebutuhan
                },

                success: function(res) {
                    if (res.status == 'success') {
                        $('#updateModal').modal('hide');
                        $('#updateProdakForm')[0].reset();
                        $('.table').load(location.href + ' .table');
                        Swal.fire('Success!', 'Data berhasil diupdate', 'success');
                    }
                },
                error: function(err) {
                    $('.errMsgContainer').html('');
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' + value + '</span>' + '<br>');
                    });
                }

            });
        })

        // delete prodak 

    });
</script>