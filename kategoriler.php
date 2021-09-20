<a href="index.php?sayfa=kategori_ekle">[Kategori ekle]</a>

<?php

$kategoriler = $db ->query("SELECT kategoriler.*, COUNT(dersler.id) AS toplamDers FROM kategoriler LEFT JOIN dersler ON dersler.kategori_id = kategoriler.id
group by  kategoriler.id ASC")->fetchAll(PDO::FETCH_ASSOC);

?>


<ul>
<?php foreach ($kategoriler as $kategori): ?>
    <li>
             <?php echo $kategori['id'].'.' ?> 
        <a href="index.php?sayfa=kategori&id=<?php echo $kategori['id']?>"> 
              <?php echo $kategori['ad'] ?>
       </a> 
   
           (<?php echo $kategori['toplamDers'] ?>)

    </li>

<?php endforeach; ?>
</ul>