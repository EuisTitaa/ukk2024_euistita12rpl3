<?php
//koneksi ke database
$conn = mysqli_connect ("localhost", "root", "", "galerifoto");
// function query($query) {
//     global $conn;
//     $result = mysqli_query($conn, $query);
//     $rows = [];
//     while($row = mysqli_fetch_assoc($result)) {
//         $rows[] = $row;
//     }
//     return $rows;
// }

function cari($keyword) {
    $keyword = $_POST["keyword"];
    $cari = "SELECT * FROM foto
                WHERE
            judul_foto LIKE '%$keyword%' OR
            deskripsi_foto LIKE '%$keyword%'
    ";
    return ($cari);
}

function ubah($dataForm) {
    global $conn;

    $foto_id = $dataForm["foto_id"];
    $judul_foto = htmlspecialchars($dataForm["judul_foto"]);
    $deskripsi_foto = htmlspecialchars($dataForm["deskripsi_foto"]);
    $lokasi_fileLama = htmlspecialchars($dataForm["lokasi_fileLama"]);
    
    // cek apakah user pilih gambar gambarbaru atau tidak
    if($_FILES['lokasi_file']['error'] === 4){
        $lokasi_file = $lokasi_fileLama;
    } else {
        $lokasi_file = upload();
    }

    //query
    $query = "UPDATE foto SET
        judul_foto = '$judul_foto',
        deskripsi_foto = '$deskripsi_foto',
        lokasi_file = '$lokasi_file'
        WHERE foto_id = '$foto_id'
    ";

mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function hapus($foto_id){
    global $conn;

    mysqli_query($conn, "DELETE FROM foto WHERE foto_id = $foto_id");

    return mysqli_affected_rows($conn);
}

function hapusAkun($user){
    global $conn;
    mysqli_query($conn, "DELETE FROM user WHERE user_id = $user");

    return mysqli_affected_rows($conn);
}

function hapuskom($komentar_id){
    global $conn;
    mysqli_query($conn, "DELETE FROM komentar_foto WHERE  komentar_id = $komentar_id");

    return mysqli_affected_rows($conn);
}


function ubahkom($dataForm){
    global $conn;

    $komentar_id = $dataForm["komentar_id"];
    $isi_komentar = htmlspecialchars($dataForm["isi_komentar"]);

    //query
    $query = "UPDATE komentar_foto SET
        isi_komentar = '$isi_komentar'
        WHERE komentar_id = '$komentar_id'
    ";

mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function ubahPass($dataForm){
    global $conn;
    $user_id = htmlspecialchars($_POST["user_id"]);
    $password = htmlspecialchars($_POST["password"]);

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE user SET
        password = '$passwordHash'
        WHERE user_id = '$user_id'
    ";

mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

function ubahFoto($dataForm){
    global $conn;
    $user_id = $dataForm["user_id"];
    // $foto_user = htmlspecialchars($_POST["foto_user"]);
    $lokasi_fileLama = htmlspecialchars($dataForm["lokasi_fileLama"]);
    
    // cek apakah user pilih gambar gambarbaru atau tidak
    if($_FILES['lokasi_file']['error'] === 4){
        $lokasi_file = $lokasi_fileLama;
    } else {
        $lokasi_file = upload();
    }

    $query = "UPDATE user SET
        foto_user = '$lokasi_file'
        WHERE user_id = '$user_id'
    ";


mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}


function tambah($dataForm){
    global $conn;

    //ambil data dai url
    $user_id = $_GET["user"];

    $judul_foto = htmlspecialchars($dataForm["judul_foto"]);
    $deskripsi_foto = htmlspecialchars($dataForm["deskripsi_foto"]);
    $tanggal_unggah = date("Y-m-d");

    // upload gambar
    $lokasi_file =  upload();
    if ( !$lokasi_file ) {
        return false;
    }

    $query = "INSERT INTO foto VALUES(
        '', '$judul_foto', '$deskripsi_foto', '$tanggal_unggah', '$lokasi_file', '$user_id'
    );";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);

}

function upload() {
    $namaFile = $_FILES['lokasi_file']['name'];
    $ukuranFile = $_FILES['lokasi_file']['size'];
    $error = $_FILES['lokasi_file']['error'];
    $tmpName = $_FILES['lokasi_file']['tmp_name'];

    // cek apakah tidak ada gambar yang di aplod
    if( $error === 4 ){
        echo "
        <script>
            alert('Pilih gambar terlebih dahulu');
        </script>
        ";
        return false;
    }
    // cek apakah upload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ){
        echo "
        <script>
            alert('Yang anda upload bukan gambar! ');
        </script>
        ";
        return false;
    }

    // cek jika ukurannya terlalu besar
    // if($ukuranFile > 1000000) {
    //     echo "
    //     <script>
    //         alert('Ukuran gambar terlalu besar! ');
    //     </script>
    //     ";
    //     return false;
    // }

    // lolos pengecekan, gambar siap di aplod
    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' .$namaFileBaru);

    return $namaFileBaru;
}


function kom($dataForm) {
    global $conn;

    //ambil data dari url
    $fotoGet = $_GET["foto"];
    $userGet = $_GET["user"];

    $tanggallike=date("Y-m-d");
    $komentar = htmlspecialchars($dataForm["isi_komentar"]);

    $query = "INSERT INTO komentar_foto 
    VALUES
    ('', '$fotoGet', '$userGet', '$komentar', '$tanggallike')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
} 

function userLogin() {
    global $conn;

    $username = $_POST["username"];
    $password = $_POST["password"];
    $id = mysqli_query ($conn, "SELECT user_id FROM user WHERE username = '$username'");
    $user_id_login = mysqli_fetch_array($id);
    return $user_id_login;
}

function userSession() {
    global $conn;
    $username = $_POST["username"];
    
    $id = mysqli_query ($conn, "SELECT user_id FROM user WHERE username = '$username'");
    $user_id_login = mysqli_fetch_array($id);
    return $user_id_login;
}

function user() {
    global $conn;

    $user_id = $_GET["user"];

    return $user_id;
}

function foto() {
    global $conn;

    $foto_id = $_GET["foto"];

    return $foto_id;
}


function register($dataForm) {
    global $conn;

    //ambil data dari form
    $username = htmlspecialchars($dataForm["username"]);
    $password = htmlspecialchars($dataForm["password"]);
    $password2 = htmlspecialchars($dataForm["password2"]);
    $email = htmlspecialchars($dataForm["email"]);
    $namaL = htmlspecialchars($dataForm["namaL"]);
    $alamat = htmlspecialchars($dataForm["alamat"]);
    // upload gambar

    $lokasi_file =  upload();
    if ( !$lokasi_file ) {
        return false;
    }


    //cek username
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)){
        echo "
        <script>
        alert('Username Sudah terdaftar!');
        </script>
        ";
        return false;
    }
    
    // cek konfirmasi password
    if($password !== $password2) {
        echo "
        <script>
        alert('Konfirmasi Password Tidak Sesuai!')
        </script>
        ";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambah user baru
    $query = "INSERT INTO user VALUES('', '$username', '$password', '$email', '$namaL', '$alamat', '$lokasi_file')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
?>