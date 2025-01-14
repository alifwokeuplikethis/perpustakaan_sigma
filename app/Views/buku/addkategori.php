<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?php echo base_url('/buku/addkategori'); ?>" method="post"  enctype="multipart/form-data">
    Kategori : <input type="text" name="kategori">
    <button type="submit">Tambah Data</button>
</form>
</body>
</html>