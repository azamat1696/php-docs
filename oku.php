
<?php 

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location:index.php');
    exit();
}
$sorgu = $db -> prepare('SELECT * FROM dersler WHERE id= ? && onay=1 ');

$sorgu ->execute([
    $_GET['id']
]);

$ders = $sorgu ->fetch(PDO::FETCH_ASSOC);
// || ($ders['onay'] == 0
if (!$ders) {
   header('location:index.php');
   exit();
}

?>

<h3><?php echo $ders['baslik'] ?></h3> 
<hr>
<h3><?php echo $ders['kategori_id'] ?></h3> 

<p><?php echo nl2br($ders['icerik']) ?></p> 
<small><?php echo $ders['tarih'] ?></small> <br>




