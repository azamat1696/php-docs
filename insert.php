<?php 

/* $sorgu = $db ->prepare('INSERT INTO dersler SET 
baslik = ?,
icerik = ?,
onay = ?
');

$ekle = $sorgu->execute([
    'deneme başlık', 'içerik', 1
]);

if ($ekle) {
    echo 'verileriniz eklendi';
} else {
    print_r($sorgu->errorInfo());
}
 */


 // forumdan gelen verileri mysql'e kayıt
// Form gönderilmiş
$kategoriler = $db->query('SELECT * FROM kategoriler ORDER BY ad ASC')->fetchAll();




if (isset($_POST['submit'])){

$baslik = isset($_POST['baslik']) ? $_POST['baslik'] : null;
$icerik = isset($_POST['icerik']) ? $_POST['icerik'] : null;
$onay = isset($_POST['onay']) ? $_POST['onay'] : null;
$kategori_id = isset($_POST['kategori_id']) ? $_POST['kategori_id'] : null;



if (!$baslik) {
    echo 'Başlık ekleyin!';
} elseif (!$kategori_id) {
    echo 'kategori ekleyin';
} elseif (!$icerik) {

    echo 'içerik ekleyin';
} else {
    $sorgu = $db ->prepare('INSERT INTO dersler SET 
    baslik = ?,
    icerik = ?,
    onay = ?,
    kategori_id=?
    ');
    
    $ekle = $sorgu->execute([
        $baslik, $icerik, $onay, $kategori_id
    ]);
    $sonId = $db ->lastInsertId();

    if (isset($ekle)) {
        header('location:index.php?sayfa=oku&id='.$sonId);
        echo 'yönlendir';
    } else {
        $hata = $sorgu->errorInfo();
        echo 'Mysqlde şu hata oluştu =>'. $hata[2];
    }
}




}




?>

<form method="post" >
 Başlık:
 <input value="<?php echo isset($_POST['baslik']) ? $_POST['baslik'] : null ?>" type="text" name="baslik"><br />
 <br />
 İçerik:
 <textarea name="icerik"></textarea>  
 <br>
 <br>

 Kategori <br />
 <select name="kategori_id">
     <option value="">-----kategori seçin----</option>
<?php foreach ($kategoriler as $kategori):?>
    <option value="<?php echo $kategori['id'] ?>"><?php echo $kategori['ad']?></option>
<?php endforeach; ?>
</select>
<br>
 <br>
 <br>
 Onay:
<select name="onay">
    <option value="1">onay</option>
    <option value="0">onaylı değil</option>
</select>
<br>
<br>
 <br>
<input type="hidden" name="submit">
<button type="submit">Submit</button>

</form>