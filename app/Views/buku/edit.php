<style>
        #showcase img {
            width: 200px;
            margin: 10px;
            display: inline-block;
        }
    </style>
<?php $id = $data['BukuID'];?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?php echo base_url('/buku/edit'); ?>" method="post"  enctype="multipart/form-data">
<input type="hidden" name="bukuid" value="<?= $id ?>">

    Judul Buku : <input type="text" name="Judul" value="<?= $data['Judul'];?>">
    <label for="image">Pilih Gambar:</label>
    <input type="file" id="image" name="Gambar" accept="image/*" multiple>
    <div id="showcase"></div>
    Penulis : <input type="text" name="Penulis" value="<?= $data['Penulis'] ?>">
    Penerbit : <input type="text" name="Penerbit" value="<?= $data['Penerbit'] ?>">
    Tahun Terbit : <input type="text" name="TahunTerbit" value="<?= $data['TahunTerbit'] ?>">
    Kategori : <select name="Kategori">
    <?php foreach ($kategori as $item): ?>
        <option value="<?= $item['KategoriID']; ?>" <?= $item['KategoriID'] == $selected['KategoriID'] ? 'selected' : '' ?>><?= $item['NamaKategori']; ?></option>
    <?php endforeach; ?>
    </select>
    <button type="submit">Tambah Data</button>
</form>
</body>
<script>
            document.getElementById('image').addEventListener('change', function (e) {
            const showcase = document.getElementById('showcase');
            showcase.innerHTML = ''; // Hapus gambar sebelumnya

            const files = e.target.files; // Ambil semua file
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        const img = document.createElement('img');
                        img.src = event.target.result; // Data URL dari gambar
                        showcase.appendChild(img); // Tambahkan ke showcase
                    };
                    reader.readAsDataURL(file); // Baca file sebagai Data URL
                }
            }
        });
    </script>
</html>