<?php
require 'functions/function.php';

$foto_id = $_GET["foto"];
$user_id = $_GET["user"];

if( hapus($foto_id) > 0 ){
    echo "
        <script>
            alert('Data Berhasil di hapus !');
            document.location.href = 'index.php?user_id=$user_id';
        </script>
        ";
}else {
        echo "
        <script>
            alert('Data Gagal di hapus !');
            document.location.href = 'index.php?user_id=$user_id';
        </script>
        ";
}


?>