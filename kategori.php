<?php
require_once 'header.php';

if (!isset($_GET['id']) || empty($_GET['id'])){
    header('location:index.php?sayfa=kategoriler');
    exit();
}



$sorgu = $db ->prepare('SELECT * FROM kategoriler WHERE id = ?');
$sorgu->execute([
    $_GET['id']
]);

$kategori = $sorgu->fetch(PDO::FETCH_ASSOC);

if (!$kategori) {
    header('location:index.php?sayfa=kategoriler');
    exit();
}

// kategoriye ayit dersleri çekelim

$sorgu = $db ->prepare('SELECT * FROM dersler WHERE kategori_id = ? ORDER BY id DESC');

$sorgu->execute([
    $kategori['id']
]);


$dersler = $sorgu ->fetchAll(PDO::FETCH_ASSOC);




?>

<h3><?php echo $kategori['ad'] ?> Kategorisi</h3>
<ul>
    <?php foreach ($dersler as $ders): ?>
        <li>
            <?php echo $ders['baslik']?>
    <div>
        <a href="index.php?sayfa=guncelle&id=<?php echo $ders['id'];?>">DÜZENLİ</a>
        <a href="index.php?sayfa=sil&id=<?php echo $ders['id'];?>">SİL</a>
        <?php  if ($ders['onay'] == 1): ?>
            <a href="index.php?sayfa=oku&id=<?php echo $ders['id'];?>">OKU</a>
        <?php endif; ?>
    </div>
        </li>
    <?php endforeach; ?>
</ul>