<!DOCTYPE html>
<?php
require_once "koneksi.php";
if(!isset($_SESSION)) {
    session_start();
}
if (empty($_SESSION['username']) || $_SESSION['status'] > 0){
    session_destroy();
    header('Location: login.php');
}
if(isset($_GET['ubah'])){
    $sku= mysqli_real_escape_string($con, $_GET['ubah']);
    $selected_default = "";
    $selected = "selected=\"selected\"";
    $sql_cari = mysqli_query($con, "SELECT * FROM `produk` WHERE `sku`='$sku'");
    if(mysqli_num_rows($sql_cari) > 0){
        if($tampil_ubah = mysqli_fetch_assoc($sql_cari)){
            $nama = $tampil_ubah['nama_produk'];
            $merk = $tampil_ubah['merk'];
            $id_kategori = $tampil_ubah['id_kategori'];
            $harga = $tampil_ubah['harga'];
            $deskripsi = $tampil_ubah['deskripsi'];
            $deskripsi_singkat = $tampil_ubah['deskripsi_singkat'];
            $link = $tampil_ubah['link'];
            $berat = $tampil_ubah['berat'];
            $lock_start = "/*";
            $lock_end = "*/";
            $url = "action.php?action=edit-produk";
            $judul = "Edit Produk";
        }
    }
}else{
    $selected_default = "selected=\"selected\"";
    $nama = "";
    $merk = "";
    $id_kategori = "";
    $harga = "";
    $deskripsi = "";
    $deskripsi_singkat = "";
    $link = "";
    $berat = "";
    $lock_start = "";
    $lock_end = "";
    $url= "action.php?action=tambah-produk";
    $judul = "Tambah Produk";

}
?>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Adiholick" />

    <!-- Stylesheets
    ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="css/dark.css" type="text/css" />
    <link rel="stylesheet" href="css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="css/animate.css" type="text/css" />
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

    <!-- Select-Boxes CSS -->
    <link rel="stylesheet" href="css/components/select-boxes.css" type="text/css" />

    <!-- Bootstrap File Upload CSS -->
    <link rel="stylesheet" href="css/components/bs-filestyle.css" type="text/css" />

    <link rel="stylesheet" href="css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Document Title
    ============================================= -->
    <title><?php echo $judul; ?> | Admin</title>

</head>

<body class="stretched">

<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Header
    ============================================= -->
    <?php include "header.php"; ?>
    <!-- #header end -->

    <!-- Page Title
    ============================================= -->
    <section id="page-title">

        <div class="container clearfix">
            <h1><?php echo $judul; ?></h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active"><?php echo $judul; ?></li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="tabs tabs-alt tabs-tb clearfix" id="tab-produk">
                    <ul class="tab-nav clearfix">
                        <li><a href="#detail-produk">Detail Produk</a></li>
                        <li><a href="#foto-produk-tab">Foto Produk</a></li>
                    </ul>

                    <div class="tab-container">
                        <div class="tab-content clearfix" id="detail-produk">
                            <form id="form-detail-produk" name="form-detail-produk" action="#" method="post">
                                <div class="col_full">
                                    <label>Nama Produk :</label>
                                    <input id="nama-produk" name="nama-produk" class="form-control" placeholder="Masukan Nama Produk" value="<?php echo $nama; ?>">
                                    <input type="hidden" name="link-produk" id="link-produk" value="<?php echo $link; ?>">
                                </div>
                                <div class="col_full">
                                    <label>Merk :</label>
                                    <input type="text" id="merk-produk" name="merk-produk" class="form-control" placeholder="Masukan Merk Produk" value="<?php echo $merk; ?>">
                                </div>
                                <div class="col_full">
                                    <label>Kategori</label>
                                    <select id="kategori-produk" name="kategori-produk" class="select-hide form-control bottommargin-sm">
                                        <option value="" disabled="disabled" <?php echo $selected_default; ?>>-Pilih Kategori-</option>
                                        <?php
                                        $query_kategori = mysqli_query($con, "SELECT * FROM `kategori`");
                                        while($tampil_kategori = mysqli_fetch_array($query_kategori)){
                                        ?>
                                        <option value="<?php echo $tampil_kategori['id_kategori']; ?>"<?php if($id_kategori==$tampil_kategori['id_kategori']){echo $selected;} ?>><?php echo $tampil_kategori['nama_kategori']; ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                                <div class="col_full">
                                    <label>Harga :</label>
                                    <input type="hidden" name="sku-produk1" id="sku-produk1" value="<?php echo $sku; ?>">
                                    <input type="number" id="harga-produk" name="harga-produk" class="form-control" placeholder="Masukan Harga Dalam Rupiah" value="<?php echo $harga; ?>">
                                </div>
                                <div class="col_full">
                                    <label>Berat Produk :</label>
                                    <input type="number" id="berat-produk" name="berat-produk" class="form-control" placeholder="Masukan Berat Produk (gram)" value="<?php echo $berat; ?>">
                                </div>
                                <div class="col_full">
                                    <label>Deskripsi :</label>
                                    <textarea id="deskripsi-produk" name="deskripsi-produk" class="form-control" placeholder="Masukan Deskripsi Produk"><?php echo $deskripsi; ?></textarea>
                                </div>
                                <div class="col_full">
                                    <label>Deskripsi Singkat :</label>
                                    <textarea id="deskripsi-singkat" name="deskripsi-singkat" class="form-control" placeholder="Masukan Deksripsi Singkat"><?php echo $deskripsi_singkat; ?></textarea>
                                </div>
                                <div class="coll_full nobottommargin">
                                    <button id="submit" name="submit" class="button button-3d button-black nomargin" value="submit">Submit</button>
                                </div>
                            </form>

                            <!-- Notifikasi Area -->
                            <div id="notifikasi-gagal" data-notify-position="top-right" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Gagal menambahkan!"></div>
                            <div id="notifikasi-sukses" data-notify-position="top-right" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Berhasil ditambahkan!"></div>

                            <div id="notifikasi-hapus-gagal" data-notify-position="top-right" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Gagal Menghapus!"></div>
                            <div id="notifikasi-hapus-sukses" data-notify-position="top-right" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Berhasil dihapus!"></div>
                            <!-- End -->
                        </div>
                        <div class="tab-content clearfix" id="foto-produk-tab">
                            <form id="form-foto-produk" name="form-foto-produk" action="#" method="POST" enctype="multipart/form-data">
                                <div class="col_half">
                                    <label>Pilih Gambar :</label>
                                    <input type="hidden" name="sku-produk2" id="sku-produk2" value="<?php echo $sku; ?>">
                                    <div id="foto-div">
                                        <input id="foto_produk" name="foto_produk" type="file" class="file" accept="image/*">
                                    </div>
                                </div>
                            </form>
                            <div id="table-foto" name="table-foto">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clear"></div>
                <!-- MODAL -->
                <div id="konfirmasi-hapus" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-body">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Hapus Foto</h4>
                                </div>
                                <div class="modal-body">
                                    <p class="nobottommargin">Ingin Menghapus Foto Produk?</p>
                                </div>
                                <div class="modal-footer">

                                    <form id="form-foto-hapus" name="form-foto-hapus" action="#" method="post">
                                        <input id="nama-foto-hapus" name="nama-foto-hapus" type="hidden" value="">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

            </div>

        </div>

    </section><!-- #content end -->

    <!-- Footer
    ============================================= -->
    <?php include "footer.php"; ?>
    <!-- #footer end -->

</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- External JavaScripts
============================================= -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>

<!-- Select-Boxes Plugin -->
<script type="text/javascript" src="js/components/select-boxes.js"></script>

<!-- Bootstrap File Upload Plugin -->
<script type="text/javascript" src="js/components/bs-filestyle.js"></script>

<!-- Footer Scripts
============================================= -->
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" language="JavaScript">

    $(".select-hide").select2({
        minimumResultsForSearch: Infinity
    });

    $(document).ready(function() {
        loadTableFoto();
    });

    function loadTableFoto() {
        $.ajax({
            type : "POST",
            dataType : "HTML",
            url : "action.php?action=load-table-foto",
            data: $("#form-foto-produk").serialize(),
            success:function (response) {
                $("#table-foto").html(response);
            }
        });
    }

    function konfirmasiHapus(file) {
        $("#konfirmasi-hapus").modal("show");
        var foto = file.getAttribute("data-foto");
        $("#nama-foto-hapus").val(foto);
    }

    $("#form-foto-hapus").submit(function (event) {
        event.preventDefault();
        $("#konfirmasi-hapus").modal("hide");
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "action.php?action=hapus-foto",
            data: $(this).serialize(),
            success: function (response) {

                if(response.error == true){
                    SEMICOLON.widget.notifications($("#notifikasi-hapus-gagal"));
                }else{
                    SEMICOLON.widget.notifications($("#notifikasi-hapus-sukses"));
                }

                loadTableFoto();
            },
            error: function (error) {
                SEMICOLON.widget.notifications($("#notifikasi-hapus-gagal"));
                loadTableFoto();
            }
        });
    });

    $("#form-detail-produk").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "<?php echo $url; ?>",
            data: $(this).serialize(),
            success: function (response) {

                if(response.error == true){
                    SEMICOLON.widget.notifications($("#notifikasi-gagal"));
                }else{
                    SEMICOLON.widget.notifications($("#notifikasi-sukses"));
                }
            },
            error: function (error) {
                SEMICOLON.widget.notifications($("#notifikasi-gagal"));
            }
        });
    });

    $("#form-foto-produk").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "action.php?action=upload-foto-produk",
            data : new FormData(this),
            contentType :false,
            cache : false,
            processData : false,
            success:function (response) {
                if(response.error == true){
                    SEMICOLON.widget.notifications($("#notifikasi-gagal"));
                }else{
                    SEMICOLON.widget.notifications($("#notifikasi-sukses"));
                }
                document.getElementById("form-foto-produk").reset();
                loadTableFoto();
            },
            error: function (error) {
                SEMICOLON.widget.notifications($("#notifikasi-gagal"));
            }
        });
    });

    <?php echo $lock_start; ?>
    $("#kategori-produk").change(function (event) {
        var nama_produk = $("#nama-produk").val();
        var kategori_produk = $("#kategori-produk").val();
        var merk_produk = $("#merk-produk").val();
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url : "action.php?action=sku-generator",
            data: {
                "nama-produk":nama_produk,
                "kategori-produk":kategori_produk,
                "merk-produk":merk_produk
            },
            success: function (response) {
                //alert(response);
                $("#sku-produk1").val(response);
                $("#sku-produk2").val(response);
            },
            error: function (error) {

            }
        });
    });
    <?php echo $lock_end; ?>

    $("#nama-produk").focusout(function () {
        var nama_produk = $("#nama-produk").val();
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url : "action.php?action=link-generator",
            data: {
                "nama-produk":nama_produk
            },
            success: function (response) {
                $("#link-produk").val(response);
            },
            error: function (error) {

            }
        });
    });
</script>
</body>
</html>