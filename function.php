<?php

session_start();

$conn = mysqli_connect("localhost","root","","outstanding");

//add data
if(isset($_POST['submitdata'])){
    $tanggal = $_POST['tanggal'];
    $airlines = $_POST['airlines'];
    $pembukuan = $_POST['pembukuan'];
    $tipe = $_POST['type'];
    $tagihan = $_POST['tagihan'];
    $ppn = $_POST['ppn'];
    $konsesi = $_POST['konsesi'];
    $pph = $_POST['pph'];
    $cicilan = $_POST['cicilan'];

    $addtotable = mysqli_query($conn, "insert into outstand(tanggal, airline, pembukuan, tipe, tagihan, ppn, konsesi, pph, cicilan) 
    values('$tanggal', '$airlines', '$pembukuan', '$tipe', '$tagihan', '$ppn', '$konsesi', '$pph', '$cicilan')");

    if($addtotable){
        header('location:index.php');
    }else{
        echo 'Gagal';
        header('location:index.php');
    }
}

//update data
if(isset($_POST['updatedata'])){

    $idinput = $_POST['idb'];
    $tanggal = $_POST['tanggal'];
    $airlines = $_POST['airline'];
    $pembukuan = $_POST['pembukuan'];
    $tipe = $_POST['tipe'];
    $tagihan = $_POST['tagihan'];
    $ppn = $_POST['ppn'];
    $konsesi = $_POST['konsesi'];
    $pph = $_POST['pph'];
    $cicilan = $_POST['cicilan'];

    $updatetotable = mysqli_query($conn, "update outstand set tanggal = '$tanggal', airline = '$airlines', pembukuan = '$pembukuan', 
    tipe = '$tipe', tagihan = '$tagihan', ppn = '$ppn', konsesi = '$konsesi', pph = '$pph', cicilan = '$cicilan' where idinput='$idinput'");

    if($updatetotable){
        header('location:tables.php');
    }else{
        echo 'Gagal';
        header('location:tables.php');
    }
}

//delete data
if(isset($_POST['deletedata'])){
    $idinput = $_POST['idb'];

    $deletetable = mysqli_query($conn, "delete from outstand where idinput = '$idinput'");

    if($deletetable){
        header('location:tables.php');
    }else{
        echo 'Gagal';
        header('location:tables.php');
    }
}

//finish data
if(isset($_POST['finishdata'])){
    $idinput = $_POST['idb'];

    $fintable = mysqli_query($conn, "update outstand set status = true where idinput = '$idinput'");

    if($fintable){
        header('location:tablesfin.php');
    }else{
        echo 'Gagal';
        header('location:tables.php');
    }
}

//unfinish data
if(isset($_POST['unfinishdata'])){
    $idinput = $_POST['idb'];

    $unfintable = mysqli_query($conn, "update outstand set status = false where idinput = '$idinput'");

    if($unfintable){
        header('location:tables.php');
    }else{
        echo 'Gagal';
        header('location:tables.php');
    }
}

//add user
if(isset($_POST['newuserdata'])){
    $username = $_POST['username'];
    $password = $_POST['passwd'];

    $addtotable = mysqli_query($conn, "insert into login (userName, password) values('$username', '$password')");

    if($addtotable){
        header('location:settings.php');
    }else{
        echo 'Gagal';
        header('location:settings.php');
    }
}

//update user
if(isset($_POST['updateuser'])){

    $iduser = $_POST['idu'];
    $user = $_POST['newuser'];
    $pass = $_POST['newpass'];

    $updateuser = mysqli_query($conn, "update login set userName = '$user', password = '$pass' where iduser='$iduser'");

    if($updateuser){
        header('location:settings.php');
    }else{
        echo 'Gagal';
        header('location:settings.php');
    }
}

//delete user
if(isset($_POST['deleteuser'])){
    $idu = $_POST['idu'];

    $deletetable = mysqli_query($conn, "delete from login where iduser = '$idu'");

    if($deletetable){
        header('location:settings.php');
    }else{
        echo 'Gagal';
        header('location:settings.php');
    }
}

?>