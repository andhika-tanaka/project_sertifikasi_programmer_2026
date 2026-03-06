<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Buku</title>
</head>
<body>
    <?php
    require  __DIR__ .'/vendor/autoload.php';

    use App\Models\Books;

    $books = new Books();
    $data = $books->getAll();
    ?>


    <h1>Tabel Buku</h1>

    <button><a href="pages/add.php">Tambah Buku</a></button>
    <table border="1">
    <tr>
        <th>Judul</th>
        <th>Penulis</th>
        <th>Penerbit</th>
        <th>Tahun</th>
        <th>Jumlah</th>
    </tr>

    <?php foreach($data as $row): ?>
    <tr>
        <td><?= $row['title']; ?></td>
        <td><?= $row['author']; ?></td>
        <td><?= $row['publisher']; ?></td>
        <td><?= $row['year']; ?></td>
        <td><?= $row['qty']; ?></td>
        <td>
            <a href="pages/edit.php?id=<?= $row['id']; ?>">Ubah</a>
        </td>
        <td>
            <a href="pages/delete.php?id=<?= $row['id']; ?>">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </table>
    <button><a href="pages/export.php?type=pdf">Cetak PDF</a></button>
    <button><a href="pages/export.php?type=csv">Cetak CSV</a></button>
</body>
</html>