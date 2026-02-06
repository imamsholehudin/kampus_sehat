<?php
require __DIR__ . '/koneksi.php';
$isEdit = false;
$data = ['nim'=>'','nama'=>'','kelamin'=>'','no_telp'=>''];
if(!empty($_GET['nim'])){
  $isEdit = true;
  $stmt = $db->prepare('SELECT * FROM mahasiswa WHERE nim = :nim');
  $stmt->execute([':nim'=>$_GET['nim']]);
  $data = $stmt->fetch() ?: $data;
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo $isEdit? 'Edit' : 'Tambah'; ?> Mahasiswa</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1><?php echo $isEdit? 'Edit' : 'Tambah'; ?> Mahasiswa</h1>
    <form method="post" action="save.php">
      <?php if($isEdit): ?>
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="nim_old" value="<?php echo e($data['nim']); ?>">
      <?php else: ?>
        <input type="hidden" name="action" value="create">
      <?php endif; ?>

      <label>NIM</label>
      <?php if($isEdit): ?>
        <input type="text" name="nim" value="<?php echo e($data['nim']); ?>" readonly>
      <?php else: ?>
        <input type="text" name="nim" value="">
      <?php endif; ?>

      <label>Nama</label>
      <input type="text" name="nama" value="<?php echo e($data['nama']); ?>" required>

      <label>Kelamin</label>
      <select name="kelamin">
        <option value="L" <?php echo ($data['kelamin']==='L')? 'selected':''; ?>>Laki-laki</option>
        <option value="P" <?php echo ($data['kelamin']==='P')? 'selected':''; ?>>Perempuan</option>
      </select>

      <label>No. Telp</label>
      <input type="text" name="no_telp" value="<?php echo e($data['no_telp']); ?>">

      <p>
        <button type="submit" class="btn">Simpan</button>
        <a class="btn" href="index.php">Batal</a>
      </p>
    </form>
  </div>
</body>
</html>
