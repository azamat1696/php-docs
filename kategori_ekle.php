<?php

if (isset($_POST['ad'])) {

    if (empty($_POST['ad'])) {
        echo 'lütfen Kategori alanını doldurun';
    } else {
  //echo $_POST['ad'];

        $sorgu = $db->prepare("INSERT INTO kategoriler SET ad = ?");

        $ekle = $sorgu ->execute([
            $_POST['ad']
        ]);

        if ($ekle) {
            header('location:index.php');
        } else {
            echo 'Kategoriler eklendi';
        }

    }
    
  
} 



?>


<form method="post" action>

Kategori adi:
<br>
<input type="text" name="ad" >

<button type="submit">Gönder</button>

</form>