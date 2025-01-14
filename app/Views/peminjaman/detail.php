
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="style/index.css">

    <title>perpustakaan sigma</title>
</head>

<body>

<?php if (session()->getFlashdata('success')){ 
        ?>
    <script>
        alert('<?= session()->getFlashdata('success'); ?>');
        </script>
        <?php }?>

<?php if (session()->getFlashdata('error')){ 
        ?>
    <script>
        alert('<?= session()->getFlashdata('error'); ?>');
        </script>
        <?php }?>

    <!-- Container -->
    <div class="container">
        <div class="row my-2">
            <div class="col-md">
                <h3 class="text-center fw-bold text-uppercase">data peminjaman</h3>
                <hr>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md">
                <a href="peminjam.php" class="btn btn-warning ms-1"><i class="bi bi-emoji-angry-fill"></i>&nbsp;Kembali ke halaman sebelumnya</a>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-md">
                <table id="data" class="table table-striped table-responsive table-hover text-center" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th>Judul Buku</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status Peminjaman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($peminjaman as $row) : ?>
                    <tr>
                        <td><?= esc($row['Judul']); ?></td>
                        <td><?= esc($row['TanggalPeminjaman']); ?></td>
                        <td><?= esc($row['TanggalPengembalian']); ?></td>
                        <?php if($row['StatusPeminjaman'] == 'Disetujui'){  ?>
                            <td><span style="color:green"><?= esc($row['StatusPeminjaman']) ?></span></td>
                            <td><button class="btn btn-danger hapuspinjaman" data-id-peminjaman="<?= esc($row['PeminjamanID']) ?>">Hapus peminjaman</button></td>
                        <?php } elseif($row['StatusPeminjaman'] == 'Menunggu konfirmasi petugas'){ ?>
                          <td> <?=    esc($row['StatusPeminjaman']); ?> </td> 
                          <td><button class="btn btn-success konfirmasi" data-id-peminjaman="<?= esc($row['PeminjamanID']) ?>">konfirmasi</button>
                          <button class="btn btn-danger hapuspinjaman" data-id-peminjaman="<?= esc($row['PeminjamanID']) ?>">Hapus peminjaman</button></td><?php
                        } ?> 
                    </tr>
                <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Close Container -->

    <!-- Bootstrap -->
     <!-- jQuery Library -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Data Tables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>


    <script>
        $(document).ready(function() {
            // Fungsi Table
            $('#data').DataTable();
            // Fungsi Table

            // Fungsi Detail
            $('.detail').click(function() {
                var dataBuku = $(this).attr("data-id");
                $.ajax({
                    url: "detail.php",
                    method: "post",
                    data: {
                        dataBuku,
                        dataBuku
                    },
                    success: function(data) {
                        $('#detail-buku').html(data);
                        $('#detail').modal("show");
                    }
                });
            });

            // Fungsi Detail
        $('.konfirmasi').click(function() {
        var idpeminjaman = $(this).data('id-peminjaman'); // Mengambil ID dari data-id
        if (confirm('Yakin ingin mengkonfirmasi peminjaman?')) {
            $.ajax({
                url: '/peminjaman/konfirmasi',    // URL ke controller method hapus
                type: 'POST',
                data: { idpeminjaman: idpeminjaman },            // Data yang dikirim
                success: function(response) {
                    if (response.success) {
                        alert('Data berhasil dikonfirmasi!');
                        location.reload();
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan!');
                }
            });
        }
    });


    $('.hapuspinjaman').click(function() {
        var idpeminjaman = $(this).data('id-peminjaman'); // Mengambil ID dari data-id
        if (confirm('Yakin ingin menghapus peminjaman?')) {
            $.ajax({
                url: '/peminjaman/delete',    // URL ke controller method hapus
                type: 'POST',
                data: { idpeminjaman: idpeminjaman },            // Data yang dikirim
                success: function(response) {
                    if (response.success) {
                        alert('Data berhasil dikonfirmasi!');
                        location.reload();
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan!');
                }
            });
        }
    });

        });
    </script>
</body>

</html>