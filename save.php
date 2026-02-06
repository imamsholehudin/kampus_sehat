<?php
require __DIR__ . '/koneksi.php';
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
  header('Location: index.php'); exit;
}
$action = $_POST['action'] ?? '';
if($action === 'create'){
  $stmt = $db->prepare('INSERT INTO mahasiswa(nim,nama,kelamin,no_telp) VALUES(:nim,:nama,:kelamin,:no_telp)');
  $stmt->execute([
    ':nim'=>$_POST['nim'] ?? '',
    ':nama'=>$_POST['nama'] ?? '',
    ':kelamin'=>$_POST['kelamin'] ?? '',
    ':no_telp'=>$_POST['no_telp'] ?? '',
  ]);
} elseif($action === 'update'){
  $stmt = $db->prepare('UPDATE mahasiswa SET nama=:nama, kelamin=:kelamin, no_telp=:no_telp WHERE nim=:nim_old');
  $stmt->execute([
    ':nama'=>$_POST['nama'] ?? '',
    ':kelamin'=>$_POST['kelamin'] ?? '',
    ':no_telp'=>$_POST['no_telp'] ?? '',
    ':nim_old'=>$_POST['nim_old'] ?? '',
  ]);
}
header('Location: index.php');
exit;
