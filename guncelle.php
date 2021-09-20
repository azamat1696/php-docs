<?php
require_once 'header.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location:index.php');
    exit();
}
$kategoriler = $db->query('SELECT * FROM kategoriler ORDER BY ad ASC')->fetchAll();

$sorgu = $db->prepare("SELECT * FROM dersler WHERE id=?");

$sorgu -> execute([
    $_GET['id']
]);

$ders = $sorgu->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['submit'])) {
    
$baslik = isset($_POST['baslik']) ? $_POST['baslik'] : $ders['baslik'];
$icerik = isset($_POST['icerik']) ? $_POST['icerik'] : $ders['icerik'];
$onay = isset($_POST['onay']) ? $_POST['onay'] : 0;
$kategori_id = isset($_POST['kategori_id']) ? $_POST['kategori_id'] : $ders['kategori_id'];


if (!$baslik) {
    echo 'Başlık ekleyin!';
} elseif (!$icerik) {
    echo 'içerik ekleyin';
} else {
   // UPDATE tablo_adi SET kopl1=değer1 WHERE kol=değ
 $sorgu = $db -> prepare("UPDATE dersler SET 
baslik = ?,
icerik = ?,
onay = ?,
kategori_id = ?
WHERE id = ?
");

$guncelle = $sorgu -> execute([
  $baslik, $icerik, $onay, $kategori_id,  $ders['id']
]);

if ($guncelle){
    header('location:index.php?sayfa=oku&id='.$ders['id']);
} else {
    echo 'tablo güncellenemedi';
}
 //$guncelle = $sorgu->fetch(PDO::FETCH_ASSOC);
}


}


// UPDATE tablo_adi SET kopl1=değer1 WHERE kol=değ
/* $sorgu = $db -> prepare("UPDATE dersler SET 
baslik = ?,
icerik = ?,
onay = ?
WHERE id = ?
");

$guncelle = $sorgu -> execute([
  'yeni baslik', 'yeni içerik', 1, 5
]);

if ($guncelle){
    echo 'tablo güncellendi';
} else {
    echo 'tablo güncellenemedi';
}
 */

//$guncelle = $sorgu->fetch(PDO::FETCH_ASSOC);
?>
<br /><br /><br /><br /><br>
<form method="post" >
 Başlık:
 <input value="<?php echo isset($_POST['baslik']) ? $_POST['baslik'] : $ders['baslik'] ?>" type="text" name="baslik"><br />
 <br />
 İçerik:
 <textarea name="icerik"><?php echo isset($_POST['icerik']) ? $_POST['icerik'] : $ders['icerik'] ?></textarea>  
 <br>
 <br>
 <br>

 Kategori <br />
 <select name="kategori_id">
     <option value="">-----kategori seçin----</option>
<?php foreach ($kategoriler as $kategori):?>
    <option <?php echo $kategori['id'] == $ders['kategori_id'] ? 'selected' : ''?> value="<?php echo $kategori['id'] ?>"><?php echo $kategori['ad']?></option>
<?php endforeach; ?>
</select>
<br>
 <br>
 <br>
 <br />
 Onay:
<select name="onay">
    <option <?php echo $ders['id'] == 1 ? 'selected' : '' ?> value="1">onay</option>
    <option <?php echo $ders['id'] == 0 ? 'selected' : '' ?> value="0">onaylı değil</option>
</select>
<br>

<input type="hidden" name="submit">
<br>
<br>
<br>

<button type="submit">Submit</button>

</form>