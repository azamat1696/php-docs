
<?php
// DELETE FROM table_name WHERE id= 5

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('location:index.php');
    exit();
} else {

    $sorgu = $db->prepare("DELETE FROM dersler WHERE id = ?");

    $sorgu->execute([
        $_GET['id']
    ]);
    
    header('location:index.php');
}


?>