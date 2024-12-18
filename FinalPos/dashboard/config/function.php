<?php


function uploadimg($url = null){
    $namafile = $_FILES['image']['name'];
    $ukuran   = $_FILES['image']['size'];
    $tmp      = $_FILES['image']['tmp_name'];

    //validasi file gambar yang boleh di upload

    $ekstensiGambarValid = ['jpg','jpeg','png','gif'];
    $ekstensiGambar =explode('.',$namafile);
    $ekstensiGambar =strtolower(end($ekstensiGambar));

    if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
        if ($url != null){
            echo "  <script>
                        alert('data gagal di Update!');
                        document.location.href;
                    </script>";
            die();
        }else {
            echo '<script>
                        alert("file yang anda upload bukan gambar, data gagal ditambahkan!");
                    </script>';
            return false;
        }
    }

    //validasi ukuran gambar max 1MB

    if($ukuran>1000000){
        if ($url != null){
            echo "  <script>
                        alert('Ukuran Gambar Melebihi 1 MB!, Data Gagal Di Update');
                        document.location.href;
                    </script>";
            die();
        }else{
        echo '<script>
        alert("Ukuran Gambar Tidak Boleh Melebihi 1 MB");
            </script>';
            return false;
        }
    }

    $namaFileBaru=rand(10,1000) . '-' . $namafile;

    move_uploaded_file($tmp,'../../images/public/' . $namaFileBaru);

    return $namaFileBaru;
}

//untuk menambahkan ke database

function getData($sql){
    global $conn;

    //menampilkan hasil
    $result = mysqli_query($conn, $sql);
    $rows   =[];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function userLogin(){
    $userActive = $_SESSION['ssUserPOS'];
    $dataUser   = getData("SELECT * FROM tbl_user WHERE username = '$userActive'")[0];
    return $dataUser;
}

function memberLogin(){
    $memberActive = $_SESSION['ssMemberPOS'];
    $dataMember   = getData("SELECT * FROM member WHERE username = '$memberActive'");

    return $dataMember;
}

function telerLogin(){
    $telerActive = $_SESSION[''];
}

function userMenu(){
    $uri_path     = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    $uri_segments = explode('/',$uri_path);
    $menu         = $uri_segments[4];
    return $menu;
}

function menuHome(){
    if(userMenu() == 'dashboard.php' ){
        $result = 'active';
    }else {
        $result =  null;
    }
    return $result;
}

function menuSetting(){
    if(userMenu() == 'users'){
        $result = 'menu-is-open menu-open';
    }else {
        $result = null;
    }
    return $result;
}

function menuUser(){
    if(userMenu() == 'users' ){
        $result = 'active';
    }else {
        $result =  null;
    }
    return $result;
}

function menuSupplier(){
    if(userMenu() == 'supplier' ){
        $result = 'active';
    }else {
        $result =  null;
    }
    return $result;
}

function menuMaster(){
    if(userMenu() == 'supplier'){
        $result = 'menu-is-open menu-open';
    }else {
        $result = null;
    }
    return $result;
}