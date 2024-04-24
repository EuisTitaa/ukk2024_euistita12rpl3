<?php
require 'functions/function.php';

$user = $_GET["user"];

if( hapusAkun($user) > 0 ){
    echo "
        <script>
            alert('User Berhasil di hapus !');
            document.location.href = 'logout.php';
        </script>
        ";
}else {
        echo "
        <script>
            alert('User Gagal di hapus !');
            document.location.href = 'index.php?user_id=$user';
        </script>
        ";
}


?>