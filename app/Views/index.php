
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

<?php if (session()->get('user')){ 
        $data = session()->get('user'); 
        echo $data['Username'];
 }?>

<?php if (session()->getFlashdata('berhasil')){ 
        ?>
    <script>
        alert('<?= session()->getFlashdata('berhasil'); ?>, <?= $data['Username'] ?>');
        </script>
        <?php }?>

    <!-- Container -->
    <div class="container">
        <div class="row my-2">
            <div class="col-md">
                <h3 class="text-center fw-bold text-uppercase">Perpustakaan Sigma</h3>
                <hr>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md">
                <?php if($data['UserKey'] == '1' || $data['UserKey'] == '2'){ ?>
                                 <a href="/buku/kategori" class="btn btn-primary"><i class="bi bi-person-plus-fill"></i>&nbsp;Tambahkan kategori buku</a>  
                                 <a href="/peminjaman/detail" class="btn btn-primary"><i class="bi bi-person-plus-fill"></i>&nbsp;Detail Peminjaman</a>  
                                 <a href="/buku/data" class="btn btn-success ms-1"><i class="bi bi-file-earmark-spreadsheet-fill"></i>&nbsp;Data Buku</a> 
                    <?php } ?>

                <a href="/logout" class="btn btn-warning ms-1"><i class="bi bi-emoji-angry-fill"></i>&nbsp;Logout</a>
                <a href="/peminjaman/koleksi" class="btn btn-warning ms-1"><i class="bi bi-emoji-angry-fill"></i>&nbsp;Daftar Koleksi</a>

                <?php if($data['UserKey'] == '1'){ ?>
                <a href="/petugas/registerpage" class="btn btn-warning ms-1"><i class="bi bi-emoji-angry-fill"></i>&nbsp;Tambahkan user petugas</a>
                <?php } ?>

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
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>Genre</th>
                            <?= session()->get('user')['UserKey'] == '3' ? '<th>Pinjam</th>' : '' ?>
                            
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
                        <td><?= esc($row['Penerbit']); ?></td>
                        <td><?= esc($row['TahunTerbit']); ?></td>
                        <td><?= esc($row['NamaKategori']); ?></td>
                        <?php if(session()->get('user')['UserKey'] == '3'){ ?>
                            <td><button class="btn btn-success" data-id="" onclick="window.location.href='/peminjaman/meminjam/<?= esc($row['BukuID']); ?>'">Meminjam</button>
                            <?php if (!$row['inKoleksi']): ?>
                <button class="btn btn-success koleksi" data-id-buku="<?= esc($row['BukuID']); ?>">
                    Tambahkan Koleksi
                </button>
            <?php else: ?>
                <button class="btn btn-secondary" disabled>
                    Sudah di Koleksi
                </button>
            <?php endif; ?></td> 
                            <?php } ?>
                    </tr>
                <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Close Container -->

    <!-- Footer -->
    <div class="container-fluid">
        <div class="row bg-dark text-white">
            <div class="col-md-6 my-2" id="about">
                <h4 class="fw-bold text-uppercase">Kampoeng Batja</h4>
                <p>Taman baca memang selalu didorong untuk senantiasa berkegiatan dan selalu kreatif. Tidak melulu soal buku, tetapi kegiatan-kegiatan yang bermuara pada pengayaan literasi juga perlu.</p>
            </div>
    
        </div>
    </div>
    <footer class="bg-dark text-white text-center" style="padding: 5px;">
        <p><u style="color: #fff;">Kampoeng Batja</u></p>
    </footer>
    <!-- Close Footer -->

    <!-- Bootstrap -->
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
            // Fungsi Detail
            $('.koleksi').click(function() {
        var idbuku = $(this).data('id-buku'); // Mengambil ID dari data-id
        if (confirm('Yakin ingin menambahkan koleksi?')) {
            $.ajax({
                url: '/peminjaman/addkoleksi',    // URL ke controller method hapus
                type: 'POST',
                data: { idbuku: idbuku },            // Data yang dikirim
                success: function(response) {
                    if (response.success) {
                        alert('Buku berhasil disimpan!');
                        location.reload();
                    } else {
                        alert('Gagal menyimpan bbuku!');
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