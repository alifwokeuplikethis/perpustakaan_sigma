
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Tambahkan di dalam <head> -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/raty-js@3.1.0/lib/jquery.raty.css">
<script src="https://cdn.jsdelivr.net/npm/raty-js@3.1.0/lib/jquery.raty.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css"> 
  
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script> 
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Menambahkan Font Awesome dari CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Own CSS -->
    <link rel="stylesheet" href="style/index.css">

    <title>perpustakaan sigma</title>
</head>

<body>

<?php if (session()->get('user')){ 
        $data = session()->get('user'); 
 }?>

<?php if (session()->getFlashdata('berhasil')){ 
        ?>
    <script>
        alert('<?= session()->getFlashdata('berhasil'); ?>, <?= $data['Username'] ?>');
        </script>
        <?php }?>
        <a onclick="window.history.back()" class="btn btn-warning ms-1"><i class="bi bi-emoji-angry-fill"></i>&nbsp;Kembali ke halaman sebelumnya</a>
            
        <div id="rateYo"></div>

<input type="text" placeholder="Masukkan ulasan" id="ulasan">
<input type="hidden" placeholder="Masukkan ulasan" value="<?= $bukuid ?>" id="bukuid">
<button type="submit" id="submit-rating">Kirim</button>
    <!-- Bootstrap -->
<p>
    <?php foreach ($ulasan as $ulasan_item): ?>
            <div class="rating">
                <div id="rateYo-<?= $ulasan_item['UlasanID'] ?>"></div> <!-- ID unik untuk tiap elemen -->
                <input type="hidden" name="rating" value="<?= $ulasan_item['Rating'] ?>" id="rating-<?= $ulasan_item['UlasanID'] ?>">
            </div>
            <div>
                <label>Ulasan:</label>
                <p><?= $ulasan_item['Ulasan'] ?></p>
            </div>
            <hr>
        <?php endforeach; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Data Tables -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>

    <script>
     $(document).ready(function() {
    $("#rateYo").rateYo({
        rating: 0,  // Nilai awal
        fullStar: true
    });

    <?php foreach ($ulasan as $ulasan_item): ?>
                $("#rateYo-<?= $ulasan_item['UlasanID'] ?>").rateYo({
                    rating: <?= $ulasan_item['Rating'] ?>, // Menampilkan rating dari database
                    fullStar: true,
                    readOnly: true // Membuat RateYo hanya bisa melihat (bukan memilih)
                });
            <?php endforeach; ?>

    $('#submit-rating').on('click', function(e) {
        e.preventDefault();
        
        var rating = $("#rateYo").rateYo("rating");
        var ulasan = $('#ulasan').val();
        var bukuid = $('#bukuid').val();
        
        console.log("Rating:", rating);
        console.log("Ulasan:", ulasan);

        // Kirim data ke server
        $.ajax({
            url: '/masukan/add',  // Ganti dengan URL controller Anda
            type: 'POST',
            data: {
                rating: rating,
                ulasan: ulasan,
                bukuid: bukuid
            },
            success: function(response) {
                alert('Ulasan berhasil dikirim!');
                location.reload();
            },
            error: function() {
                alert('Gagal mengirim ulasan.');
            }
        });
    });
});

    </script>
</body>

</html>