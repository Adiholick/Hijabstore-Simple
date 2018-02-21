<?php
require_once "koneksi.php";
if(!isset($_SESSION)) {
    session_start();
}
$action = mysqli_real_escape_string($con, $_GET['action']);

if($action == "tambah-produk"){
    $nama_produk = mysqli_real_escape_string($con, $_POST['nama-produk']);
    $merk = mysqli_real_escape_string($con, $_POST['merk-produk']);
    $kategori = mysqli_real_escape_string($con, $_POST['kategori-produk']);
    $harga = mysqli_real_escape_string($con, $_POST['harga-produk']);
    $deskripsi_produk = mysqli_real_escape_string($con, $_POST['deskripsi-produk']);
    $deskripsi_singkat =mysqli_real_escape_string($con, $_POST['deskripsi-singkat']);
    $sku = mysqli_real_escape_string($con, $_POST['sku-produk1']);
    $link_produk = mysqli_real_escape_string($con, $_POST['link-produk']);
    $berat = mysqli_real_escape_string($con, $_POST['berat-produk']);
    $stok = 0;

    $sql_insert = mysqli_query($con, "INSERT INTO `produk`(`sku`, `nama_produk`,`merk`, `id_kategori`, `harga`, `deskripsi`, `deskripsi_singkat`, `stok`, `link`,`berat`) VALUES ('$sku','$nama_produk','$merk','$kategori','$harga','$deskripsi_produk','$deskripsi_singkat','$stok','$link_produk','$berat')");
    if($sql_insert){
        $return = array(
            "error" => false,
            "pesan"=> "sukses"
        );
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }

    echo json_encode($return);
}elseif($action== "sku-generator"){
    $nama = mysqli_real_escape_string($con, $_POST['nama-produk']);
    $kategori = mysqli_real_escape_string($con, $_POST['kategori-produk']);
    $merk = mysqli_real_escape_string($con, $_POST['merk-produk']);
    $kata = preg_split("/[\s,_-]+/", $nama, 2);
    $huruf = "";
    foreach ($kata as $value){
        $huruf .= substr($value, 0, 1);
    }
    $huruf_caps = strtoupper($huruf);
    $kategori_caps= strtoupper($kategori);
    $merk_caps = strtoupper(substr($merk,0,1));
    $nilaikode = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
    $sku = $kategori_caps .$merk_caps. $nilaikode. $huruf_caps;

    echo json_encode($sku);
}elseif($action == "link-generator"){
    $string = mysqli_real_escape_string($con, $_POST['nama-produk']);
    $separator = "-";
    $accents_regex = "~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i";
    $special_cases = array( "&" => "and", "'" => "");
    $string = mb_strtolower( trim( $string ), "UTF-8" );
    $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
    $string = preg_replace( $accents_regex, "$1", htmlentities( $string, ENT_QUOTES, "UTF-8" ) );
    $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
    $string = preg_replace("/[$separator]+/u", "$separator", $string);

    echo json_encode($string);
}elseif($action == "upload-foto-produk"){
    $sku = mysqli_real_escape_string($con, $_POST['sku-produk2']);
    $nama_file = $_FILES['foto_produk']['name'];
    $type_file = $_FILES['foto_produk']['type'];
    $size_file = $_FILES['foto_produk']['size'];
    $tmp_file = $_FILES['foto_produk']['tmp_name'];
    $error_file = $_FILES['foto_produk']['error'];
    $content_file = file_get_contents($tmp_file);
    $upload_file = "images/";
    $ext_file = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
    $ext_validate = array("jpeg", "jpg", "png", "gif");
    $random = mt_rand(1, 999999);
    $nama_foto = $sku . "_" . $random . ".".$ext_file;

    if($error_file == UPLOAD_ERR_OK){
        if(in_array($ext_file, $ext_validate)){
            move_uploaded_file($tmp_file, $upload_file . $nama_foto);
            $insert_foto = mysqli_query($con, "INSERT INTO `foto`(`sku`, `file`) VALUES ('$sku','$nama_foto')");
            if($insert_foto){
                $return = array(
                    "error" => false,
                    "pesan"=> "sukses"
                );
            }else{
                $return = array(
                    "error" => true,
                    "pesan"=> mysqli_error($con)
                );
            }
            echo json_encode($return);
        }else{
            $return = array(
                "error" => true,
                "pesan"=> mysqli_error($con)
            );
            echo json_encode($return);
        }
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );

        echo json_encode($return);
    }
}elseif($action == "load-table-foto"){
    $sku = mysqli_real_escape_string($con, $_POST['sku-produk2']);
    $query_load_table = mysqli_query($con, "SELECT * FROM `foto` WHERE `sku`='$sku'");
    $count_foto = mysqli_num_rows($query_load_table);
    if($count_foto > 0){
        ?>
        <table class="table">
        <thead>
        <tr>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while($tampil = mysqli_fetch_array($query_load_table)){
            ?>

                <tr>
                    <td>
                        <img width="64" height="64" class="image_fade" src="images/<?php echo $tampil['file']; ?>">
                    </td>

                    <td><button id="btn-delete-foto" name="btn-delete-foto" class="button button-3d button-small nomargin fright" data-foto="<?php echo $tampil['file']; ?>" onclick="konfirmasiHapus(this);">Hapus</button></td>
                </tr>
        <?php }?>
        </tbody>
        </table>
        <?php
    }
}elseif($action == "hapus-foto"){
    $upload_file = "images/";
    $nama_foto = mysqli_real_escape_string($con, $_POST['nama-foto-hapus']);
    $sql_hapus_foto = mysqli_query($con, "DELETE FROM `foto` WHERE `file`='$nama_foto'");
    if($sql_hapus_foto){
        unlink($upload_file.$nama_foto);
        $return = array(
            "error" => false,
            "pesan"=> "sukses"
        );
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }
    echo json_encode($return);
}elseif($action == "update-stok-produk"){
    $stok = mysqli_real_escape_string($con, $_POST['stok-produk']);
    $sku = mysqli_real_escape_string($con, $_POST['sku-produk-stok']);
    $query_update_stok = mysqli_query($con, "UPDATE `produk` SET `stok`='$stok' WHERE `sku`='$sku'");
    if($query_update_stok){
        $return = array(
            "error" => false,
            "pesan"=> "sukses"
        );
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }
    echo json_encode($return);

}elseif($action == "edit-produk"){
    $nama_produk = mysqli_real_escape_string($con, $_POST['nama-produk']);
    $merk = mysqli_real_escape_string($con, $_POST['merk-produk']);
    $kategori = mysqli_real_escape_string($con, $_POST['kategori-produk']);
    $harga = mysqli_real_escape_string($con, $_POST['harga-produk']);
    $deskripsi_produk = mysqli_real_escape_string($con, $_POST['deskripsi-produk']);
    $deskripsi_singkat =mysqli_real_escape_string($con, $_POST['deskripsi-singkat']);
    $sku = mysqli_real_escape_string($con, $_POST['sku-produk1']);
    $link_produk = mysqli_real_escape_string($con, $_POST['link-produk']);
    $berat = mysqli_real_escape_string($con, $_POST['berat-produk']);

    $sql_edit_produk = mysqli_query($con, "UPDATE `produk` SET `nama_produk`='$nama_produk',`merk`='$merk',`id_kategori`='$kategori',`harga`='$harga',`deskripsi`='$deskripsi_produk',`deskripsi_singkat`='$deskripsi_singkat', `link`='$link_produk',`berat`='$berat' WHERE `sku`='$sku'");
    if($sql_edit_produk){
        $return = array(
            "error" => false,
            "pesan"=> "sukses"
        );
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }
    echo json_encode($return);
}elseif($action == "hapus-produk"){
    $upload_file = "images/";
    $sku_hapus_produk = mysqli_real_escape_string($con, $_POST['sku-hapus-produk']);
    $query_hapus_produk = mysqli_query($con, "DELETE FROM `produk` WHERE `sku`='$sku_hapus_produk'");

    if($query_hapus_produk){
        $foto_hapus = mysqli_query($con, "SELECT * FROM `foto` WHERE `sku`='$sku_hapus_produk'");
        while($rs_hapus = mysqli_fetch_array($foto_hapus)){
            unlink($upload_file.$rs_hapus['file']);
        }
        $hapus_foto = mysqli_query($con, "DELETE FROM `foto` WHERE `sku`='$sku_hapus_produk' ");
        if($hapus_foto){
            $return = array(
                "error" => false,
                "pesan"=> "sukses"
            );
        }
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }
    echo json_encode($return);

}elseif($action == "login"){
    $username = mysqli_real_escape_string($con, $_POST['login-form-username']);
    $password = mysqli_real_escape_string($con, $_POST['login-form-password']);


    if(!empty($username) && !empty($password)){
        $password_md5 = md5($password);
        $query_login = mysqli_query($con, "SELECT * FROM `user` WHERE `username`='$username' AND `password`='$password_md5'");
        $count_login = mysqli_num_rows($query_login);
        if($count_login == 1){
            if($result_login = mysqli_fetch_assoc($query_login)){
                $status = $result_login['status'];
                $uid = $result_login['id'];
                $uname = $result_login['username'];
                if(!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION['id']= $uid;
                $_SESSION['username'] = $uname;
                $_SESSION['status'] = $status;

                $return = array(
                    "error" => false,
                    "pesan"=> "sukses"
                );
            }
        }else{
            $return = array(
                "error" => true,
                "pesan"=> mysqli_error($con)
            );
        }

    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }
    echo json_encode($return);

}elseif($action == "register"){
    $username = mysqli_real_escape_string($con, $_POST['register-form-username']);
    $nama_lengkap = mysqli_real_escape_string($con, $_POST['register-form-name']);
    $email = mysqli_real_escape_string($con, $_POST['register-form-email']);
    $password = mysqli_real_escape_string($con, $_POST['register-form-password']);
    $status = '1';

    if(!empty($username) && !empty($nama_lengkap) && !empty($email) && !empty($password)){
        $password_md5 = md5($password);
        $query_register = mysqli_query($con, "INSERT INTO `user`(`username`, `nama_lengkap`, `email`, `password`, `status`) VALUES ('$username','$nama_lengkap','$email','$password_md5','$status')");
        if($query_register){
            $return = array(
                "error" => false,
                "pesan"=> "sukses"
            );
        }else{
            $return = array(
                "error" => true,
                "pesan"=> mysqli_error($con)
            );
        }
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }
    echo json_encode($return);
}elseif($action == "add-cart"){
    $id_user = $_SESSION['id'];
    $sku_cart = mysqli_real_escape_string($con, $_POST['sku-produk']);
    $qty = mysqli_real_escape_string($con, $_POST['jumlah-produk']);
    $keterangan = mysqli_real_escape_string($con, $_POST['keterangan-produk']);

    $cari_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE `id_user`='$id_user' AND `sku`='$sku_cart'");
    $count_rs = mysqli_num_rows($cari_cart);
    if($count_rs ==1){
        while($get_jumlah = mysqli_fetch_assoc($cari_cart)){
            $jumlah_sebelumnya = $get_jumlah['jumlah'];
        }
        $jumlah_new = $jumlah_sebelumnya + $qty;
        $query_cart = mysqli_query($con, "UPDATE `cart` SET `jumlah`='$jumlah_new',`keterangan`='$keterangan' WHERE `id_user`='$id_user' AND `sku`='$sku_cart'");
    }else{
        $query_cart = mysqli_query($con, "INSERT INTO `cart`(`id_user`, `sku`, `jumlah`, `keterangan`) VALUES ('$id_user','$sku_cart','$qty','$keterangan')");

    }

    if($query_cart){
        $return = array(
            "error" => false,
            "pesan"=> "sukses"
        );
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }
    echo json_encode($return);
}elseif($action == "update-cart"){
    $sku_cart = mysqli_real_escape_string($con, $_POST['sku-produk-qty']);
    $qty = mysqli_real_escape_string($con, $_POST['qty-produk']);
    $keterangan = mysqli_real_escape_string($con, $_POST['keterangan-produk']);
    $id_user = $_SESSION['id'];
    $query_update = mysqli_query($con, "UPDATE `cart` SET `jumlah`='$qty',`keterangan`='$keterangan' WHERE `id_user`='$id_user' AND `sku`='$sku_cart'");
    if($query_update){
        $return = array(
            "error" => false,
            "pesan"=> "sukses"
        );
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }
    echo json_encode($return);
}elseif($action == "hapus-produk-cart"){
    $id_user = $_SESSION['id'];
    $sku_hapus_produk = mysqli_real_escape_string($con, $_POST['sku-hapus-produk']);
    $query_hapus_produk = mysqli_query($con, "DELETE FROM `cart` WHERE `id_user`='$id_user' AND `sku`='$sku_hapus_produk'");

    if($query_hapus_produk){
        $return = array(
            "error" => false,
            "pesan"=> "sukses"
        );
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }
    echo json_encode($return);

}elseif($action == "kota-search"){
    $provinsi = mysqli_real_escape_string($con, $_POST['provinsi']);
    $query_kota = mysqli_query($con, "SELECT * FROM `city` WHERE `province_id`='$provinsi'");
    $hitung_data = mysqli_num_rows($query_kota);
    if($hitung_data > 0){
        echo "<option value=\"\">Silahkan Pilih Provinsi</option>";
        while($rs_kota = mysqli_fetch_array($query_kota)){
            echo "<option value=\"".$rs_kota['city_id']."\">".$rs_kota['type'].", " . $rs_kota['city_name']."</option>";
        }
    }else{
        echo "<option value=\"\">Silahkan Pilih Provinsi</option>";
    }
}elseif($action == "checkout-pemesanan"){
    $kode_depan = "ORD";
    $tanggal = date("d");
    $menit = date("i");
    $id_user = $_SESSION['id'];
    $nilaikode = str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);

    $kode = $kode_depan . $tanggal . $menit . $id_user. $nilaikode;

    $sku_tmp = $_POST['sku_checkout'];
    foreach($sku_tmp as $key=> $tmp){
        $sku= mysqli_real_escape_string($con, $_POST['sku_checkout'][$key]);
        $qty = mysqli_real_escape_string($con, $_POST['qty_checkout'][$key]);
        $ket = mysqli_real_escape_string($con, $_POST['keterangan_checkout'][$key]);

        $sql = mysqli_query($con, "INSERT INTO `detail_pemesanan`(`id_user`, `id_pemesanan`, `sku`, `jumlah`, `keterangan`) VALUES ('$id_user','$kode','$sku','$qty','$ket')");

        if($sql){
            $return = array(
                "error" => false,
                "pesan"=> "sukses"
            );
        }else{
            $return = array(
                "error" => true,
                "pesan"=> mysqli_error($con)
            );
        }

    }
    /** Pembayaran **/
    $nama_penerima = mysqli_real_escape_string($con, $_POST['nama-penerima']);
    $provinsi = mysqli_real_escape_string($con, $_POST['provinsi-pengiriman']);
    $kota = mysqli_real_escape_string($con, $_POST['kota-pengiriman']);
    $kurir = mysqli_real_escape_string($con, $_POST['kurir-pengiriman']);
    $alamat = mysqli_real_escape_string($con, $_POST['alamat-lengkap']);
    $ongkir = mysqli_real_escape_string($con, $_POST['biaya-ongkir']);
    $berat = mysqli_real_escape_string($con, $_POST['berat-ongkir']);
    $metode_pembayaran = mysqli_real_escape_string($con, $_POST['metode-pembayaran']);
    $konfirmasi = 0;

    $sql_pemesanan = mysqli_query($con, "INSERT INTO `pemesanan`(`id_user`, `id_pemesanan`, `nama_penerima`, `provinsi`, `kota`, `kurir`, `alamat_lengkap`, `ongkir`, `berat`, `metode_pembayaran`, `konfirmasi`, `kode_unik`) VALUES ('$id_user','$kode','$nama_penerima','$provinsi','$kota','$kurir','$alamat','$ongkir','$berat','$metode_pembayaran','$konfirmasi','$nilaikode')");
    if($sql_pemesanan){
        $sql_delete_cart = mysqli_query($con, "DELETE FROM `cart` WHERE `id_user`='$id_user'");
        if($sql_delete_cart){
            $return = array(
                "error" => false,
                "pesan"=> "sukses",
                "id"=> $kode,
                "link"=> "pembayaran.php?order=".$kode
            );
        }else{
            $return = array(
                "error" => true,
                "pesan"=> mysqli_error($con)
            );
        }
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }

    echo json_encode($return);
}elseif($action=="logout"){
    if(!isset($_SESSION)) {
        session_start();
    }
    session_destroy();
    echo "<script>alert('Logout Berhasil!'); window.location ='index.php' </script>";
}elseif($action == "konfirmasi-pembayaran"){
    $id_user = $_SESSION['id'];
    $konfirmasi = 1;
    $id_pemesanan = mysqli_real_escape_string($con, $_POST['id-pemesanan']);
    $sql_konfirmasi = mysqli_query($con, "UPDATE `pemesanan` SET `konfirmasi`='$konfirmasi' WHERE `id_pemesanan`='$id_pemesanan' AND `id_user`='$id_user'");
    if($sql_konfirmasi){
        $return = array(
            "error" => false,
            "pesan"=> "sukses",
            "link"=> "terimakasih.php"
        );
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }
    echo json_encode($return);
}elseif($action == "edit-konfirmasi"){
    $id_user = mysqli_real_escape_string($con, $_POST['id-user']);
    $konfirmasi = mysqli_real_escape_string($con, $_POST['status-pemesanan']);
    $id_pemesanan = mysqli_real_escape_string($con, $_POST['no-pemesanan']);

    $sql_konfirmasi = mysqli_query($con, "UPDATE `pemesanan` SET `konfirmasi`='$konfirmasi' WHERE `id_pemesanan`='$id_pemesanan' AND `id_user`='$id_user'");
    if($sql_konfirmasi){
        $return = array(
            "error" => false,
            "pesan"=> "sukses"
        );
    }else{
        $return = array(
            "error" => true,
            "pesan"=> mysqli_error($con)
        );
    }
    echo json_encode($_POST);
}
?>