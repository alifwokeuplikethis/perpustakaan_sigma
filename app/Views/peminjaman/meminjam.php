<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

   <form action="<?php echo base_url('/peminjaman/minjam'); ?>" method="post"  enctype="multipart/form-data">
   Tanggal dikembalikan: <input type="date" name="dikembalikan">
   <input type="hidden" name="bukuid" value="<?= $bukuid ?>">
   <input type="hidden" name="userid" value="<?= session()->get('user')['UserID'] ?>">
    <button type="submit">Tambah Data</button>
</body>
</html>