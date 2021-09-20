

<?php 

$dersler = $db->query("SELECT  dersler.id, dersler.baslik, kategoriler.ad AS kategori_adi, dersler.onay FROM  dersler INNER JOIN kategoriler ON kategoriler.id = dersler.kategori_id order by dersler.id DESC
") ->fetchAll(PDO::FETCH_ASSOC);


// dosyaya ulaşama yötemi
/* $sorgu = $db -> prepare("SELECT * FROM dersler") ;
$sorgu->execute();

$dersler = $sorgu->fetchAll(); */
//print_r($dersler);


?>

<h2>Dersler</h2>
<?php if ($dersler):?>
<ul>
<?php  foreach($dersler as $ders): ?>
    <li>
    
     <?php echo $ders['id']; ?>
        <?php echo $ders['baslik'];?>
        (<?php echo $ders['kategori_adi'];?>)

 <div>
        <a href="index.php?sayfa=guncelle&id=<?php echo $ders['id'];?>">DÜZENLİ</a>
        <a href="index.php?sayfa=sil&id=<?php echo $ders['id'];?>">SİL</a>
        <?php  if ($ders['onay'] == 1): ?>
            <a href="index.php?sayfa=oku&id=<?php echo $ders['id'];?>">OKU</a>
        <?php endif; ?>
</div>

    </li>
    <?php endforeach;?>

<?php else: ?>
    <div>Henüz Eklenmiş bi ders bulunamıyor</div>
<?php endif; ?>



</ul>