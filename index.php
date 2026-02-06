<?php
require __DIR__ . '/koneksi.php';
$stmt = $db->query('SELECT * FROM mahasiswa ORDER BY nama');
$rows = $stmt->fetchAll();
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Data Mahasiswa</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Data Mahasiswa</h1>
    <p><a class="btn" href="form.php">Tambah Mahasiswa</a></p>
    <table>
      <thead>
        <tr><th>NIM</th><th>Nama</th><th>Kelamin</th><th>No. Telp</th><th>Aksi</th></tr>
      </thead>
      <tbody>
      <?php if($rows): foreach($rows as $r): ?>
        <tr>
          <td><?php echo e($r['nim']); ?></td>
          <td><?php echo e($r['nama']); ?></td>
          <td><?php echo e($r['kelamin']); ?></td>
          <td><?php echo e($r['no_telp']); ?></td>
          <td>
            <a href="form.php?nim=<?php echo urlencode($r['nim']); ?>">Edit</a>
            |
            <a href="delete.php?nim=<?php echo urlencode($r['nim']); ?>" onclick="return confirm('Hapus data?')">Hapus</a>
          </td>
        </tr>
      <?php endforeach; else: ?>
        <tr><td colspan="5">Belum ada data.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
