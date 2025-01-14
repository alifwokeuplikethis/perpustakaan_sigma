
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
                <h3 class="text-center fw-bold text-uppercase">koleksi anda</h3>
                <hr>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md">
                <a onclick="window.history.back()" class="btn btn-warning ms-1"><i class="bi bi-emoji-angry-fill"></i>&nbsp;Kembali ke halaman sebelumnya</a>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-md">
                <table id="data" class="table table-striped table-responsive table-hover text-center" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th>Judul Buku</th>
                            <th>Gambar Cover</th>
                            <th>Penulis Buku</th>
                            <th>Kategori</th>
                            <th>Status peminjaman</th>
                            <th>Ulasan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($buku as $row) : ?>
                    <tr>
                        <td><?= esc($row['Judul']); ?></td>
                        <td>
                           <img src="/<?= esc($row['gambar_path']); ?>" style="width:300px;">
                        </td>
                        <td><?= esc($row['Penulis']); ?></td>
                        <td><?= esc($row['NamaKategori']); ?></td>

                        <?php if($row['StatusPeminjaman'] == 'Disetujui'){  ?>
                            <td><span style="color:green"><?= esc($row['StatusPeminjaman']) ?></span></td>
                        <?php } elseif($row['StatusPeminjaman'] == 'Menunggu konfirmasi petugas'){ ?>
                          <td> <?=    esc($row['StatusPeminjaman']); ?> </td> <?php
                        } ?> 

                        <td>
                            <?php if($row['StatusPeminjaman'] == 'Disetujui'){ ?> 
                                <button class="btn btn-danger" onclick="window.location.href='/masukan/<?= $row['BukuID'] ?>'">Beri masukan</button>
                                <?php } ?>
                        </td>
                        <td><button class="btn btn-danger hapus-koleksi" data-koleksi-id ="<?= esc($row['KoleksiID']); ?>">Hapus koleksi</button>      <button class="btn btn-success" data-id="" onclick="window.location.href='/peminjaman/meminjam/<?= esc($row['BukuID']); ?>'">Meminjam</button></td>
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
        $('.hapus-koleksi').click(function() {
        var idkoleksi = $(this).data('koleksi-id'); // Mengambil ID dari data-id

        if (confirm('Yakin ingin menghapus koleksi ini?')) {
            $.ajax({
                url: '/peminjaman/deletekoleksi',    // URL ke controller method hapus
                type: 'POST',
                data: { idkoleksi: idkoleksi, },            // Data yang dikirim
                success: function(response) {
                    if (response.success) {
                        alert('Data berhasil dihapus!');
                        location.reload();
                    } else {
                        alert('Gagal menghapus data!');
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