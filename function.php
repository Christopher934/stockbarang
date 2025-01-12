<?php
session_start();

//Membuat koneksi ke data base
$conn = mysqli_connect("localhost","root","","stockbarang");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
// Fungsi registrasi
function register($email, $password, $passwordConfirm) {
    global $conn;

    // Validasi input kosong
    if (empty($email) || empty($password) || empty($passwordConfirm)) {
        return "All fields are required!";
    }

    // Validasi password dan konfirmasi password
    if ($password !== $passwordConfirm) {
        return "Passwords do not match!";
    }

    // Cek apakah email sudah terdaftar
    $cekEmail = mysqli_query($conn, "SELECT * FROM login WHERE email='$email'");
    if (mysqli_num_rows($cekEmail) > 0) {
        return "Email is already registered!";
    }

    // Simpan data ke database tanpa hashing password
    $query = "INSERT INTO login (email, password) VALUES ('$email', '$password')";
    if (mysqli_query($conn, $query)) {
        return "success";
    } else {
        return "Registration failed: " . mysqli_error($conn);
    }
}


// Menambah barang baru
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];
    $hargaperunit = $_POST['hargabarang'];
    $nomorseri = $_POST['nomorseri'];

    // Cek apakah nomor seri sudah ada di database
    $cekNomorSeri = mysqli_query($conn, "SELECT * FROM stock WHERE nomorseri = '$nomorseri'");
    if(mysqli_num_rows($cekNomorSeri) > 0) {
        // Jika nomor seri sudah ada
        echo "<script>alert('Nomor seri sudah ada.');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        // Jika nomor seri belum ada, tambahkan ke tabel
        $addtotable = mysqli_query($conn, "INSERT INTO stock (namabarang, nomorseri, deskripsi, stock, hargabarang) 
                                           VALUES('$namabarang', '$nomorseri', '$deskripsi', '$stock', '$hargaperunit')");
        if($addtotable){
            header('location:index.php');
        } else {
            echo 'Gagal menambahkan barang.';
            header('location:index.php');
        }
    }
}



//Menambah barang masuk 
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $qty = $_POST['qty'];
    $keterangan = $_POST['keterangan'];

    $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    
    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

    $addtomasuk = mysqli_query($conn,"insert into masuk (idbarang, qty, keterangan) values('$barangnya','$qty','$keterangan')");
    $updatestockmasuk = mysqli_query($conn,"update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        header('location:masuk.php');
    } else {
        echo 'Gagal: ' . mysqli_error($conn); // Tambahkan pesan error
        exit(); // Hentikan eksekusi
    }
}


//Menambah barang keluar
if(isset($_POST['addbarangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $qty = $_POST['qty'];
    $penerima = $_POST['penerima'];

    $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);
    
    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

    $addtokeluar = mysqli_query($conn,"insert into keluar (idbarang, qty, penerima) values('$barangnya','$qty','$penerima')");
    $updatestockmasuk = mysqli_query($conn,"update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
    if($addtokeluar&&$updatestockmasuk){
        header('location:keluar.php');
    } else {
        echo 'Gagal: ' . mysqli_error($conn); // Tambahkan pesan error
        exit(); // Hentikan eksekusi
    }
}

//update info stock barang
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $nomorseri = $_POST['nomorseri'];
    $deskripsi = $_POST['deskripsi'];
    $hargabarang = $_POST['hargabarang'];

    $update = mysqli_query($conn,"update stock set namabarang='$namabarang',nomorseri='$nomorseri', deskripsi='$deskripsi', hargabarang='$hargabarang' where idbarang='$idb'");
    if($update){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//Menghapus barang dari stock
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn,"delete from stock where idbarang='$idb'");
    if($hapus){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//update info barang masuk
if(isset($_POST['updatebarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $qty = $_POST['qty'];
    $keterangan = $_POST['keterangan'];
    
    
    $lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn,"select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn,"update masuk set qty='$qty', keterangan='$keterangan' where idmasuk='$idm'");
        if($kurangistocknya&&$updatenya){
            header('location:masuk.php');
        } else {
            echo 'Gagal';
            header('location:masuk.php');
        }
    }else{
        $selisih = $qtyskrg - $qty;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn,"update masuk set qty='$qty', keterangan='$keterangan' where idmasuk='$idm'");
        if($kurangistocknya&&$updatenya){
            header('location:masuk.php');
        } else {
            echo 'Gagal';
            header('location:masuk.php');
        }
    }

}

//Menghapus barang masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];
    
    $selisih = $stock - $qty;

    $update=mysqli_query($conn,"update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn,"delete from masuk where idmasuk='$idm'");

    if($update&&$hapusdata){
        header('location:masuk.php');
    } else {
        echo 'Gagal';
        header('location:masuk.php');
    }

}

// update info barang keluar
if(isset($_POST['updatebarangkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $qty = $_POST['qty'];
    $penerima = $_POST['penerima'];
    
    $lihatstock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrg = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn,"select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn,"update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
        if($kurangistocknya&&$updatenya){
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    }else{
        $selisih = $qtyskrg - $qty;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn,"update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
        if($kurangistocknya&&$updatenya){
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    }

}

//Menghapus barang krluar
if(isset($_POST['hapusbarangkeluar'])){
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk'];

    $getdatastock = mysqli_query($conn,"select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stock = $data['stock'];
    
    $selisih = $stock + $qty;

    $update=mysqli_query($conn,"update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn,"delete from keluar where idkeluar='$idk'");

    if($update&&$hapusdata){
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php');
    }

}




?>