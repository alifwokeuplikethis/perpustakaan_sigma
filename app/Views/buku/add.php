<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?php echo base_url('/buku/add'); ?>" method="post"  enctype="multipart/form-data">
    Judul Buku : <input type="text" name="Judul">
    Gambar :<input type="file" name="Gambar">
    Penulis : <input type="text" name="Penulis">
    Penerbit : <input type="text" name="Penerbit">
    Tahun Terbit : <input type="text" name="TahunTerbit">
    Genre : <select name="Kategori">
    <?php foreach ($kategori as $item): ?>
        <option value="<?= $item['KategoriID']; ?>"><?= $item['NamaKategori']; ?></option>
    <?php endforeach; ?>
    </select>
    <button type="submit">Tambah Data</button>
</form>
</body>
</html>