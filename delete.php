<?php
require __DIR__ . '/koneksi.php';
if(empty($_GET['nim'])){
  header('Location: index.php'); exit;
}
$stmt = $db->prepare('DELETE FROM mahasiswa WHERE nim = :nim');
$stmt->execute([':nim'=>$_GET['nim']]);
header('Location: index.php');
exit;
