<?php
require_once __DIR__ ."/../vendor/autoload.php";

use App\Models\Books;

$book = new Books();

if(isset($_POST['submit'])){

    $title  = $_POST['title'];
    $author  = $_POST['author'];
    $publisher = $_POST['publisher'];
    $year = $_POST['year'];
    $qty = $_POST ['qty'];

    $book->insert($title, $author, $publisher, $year, $qty);

    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
</head>
<body>

<h2>Tambah Data Buku</h2>

<form method="POST">

<table>

<tr>
<td>Judul Buku</td>
<td><input type="text" name="title" required></td>
</tr>

<tr>
<td>Penulis</td>
<td><input type="text" name="author" required></td>
</tr>

<tr>
<td>Penerbit</td>
<td><input type="text" name="publisher" required></td>
</tr>

<tr>
<td>Tahun</td>
<td><input type="number" name="year" required></td>
</tr>

<tr>
<td>Jumlah</td>
<td><input type="number" name="qty" required></td>
</tr>

<tr>
<td></td>
<td>
<button type="submit" name="submit">Simpan</button>
<a href="../index.php">Kembali</a>
</td>
</tr>

</table>

</form>

</body>
</html>