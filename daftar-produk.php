<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<?php
require_once "koneksi.php";
if(!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['username']) || $_SESSION['status'] > 0){
    session_destroy();
    header('Location: login.php');
}
?>
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

    <!-- Bootstrap Data Table Plugin -->
    <link rel="stylesheet" href="css/components/bs-datatable.css" type="text/css" />

    <!-- Select-Boxes CSS -->
    <link rel="stylesheet" href="css/components/select-boxes.css" type="text/css" />

    <link rel="stylesheet" href="css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Document Title
    ============================================= -->
    <title>Daftar Produk | HijabStore</title>

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
            <h1>Daftar Produk</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Daftar Produk</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="table-responsive">
                    <table id="daftar-produk" name="daftar-produk" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>SKU</th>
                            <th>Stok</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Pilihan</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>No</th>
                            <th>SKU</th>
                            <th>Stok</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Pilihan</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        $no=0;
                        $sql_produk = mysqli_query($con, "SELECT a.*, b.nama_kategori FROM `produk` AS a INNER JOIN `kategori` AS b ON a.id_kategori=b.id_kategori");
                        while ($tampil = mysqli_fetch_array($sql_produk)){
                            $no++;
                            ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $tampil['sku']; ?></td>
                            <td><?php echo $tampil['stok']; ?></td>
                            <td><?php echo $tampil['nama_produk']; ?></td>
                            <td><?php echo $tampil['nama_kategori']; ?></td>
                            <td><?php echo "Rp. ". number_format($tampil['harga'],2,',','.'); ?></td>
                            <td>
                                <select style="width: 80pt;" id="action-produk" name="action-produk" class="select-hide form-control bottommargin-sm">
                                    <option value="" disabled="disabled" selected>-Pilih-</option>
                                    <option value="edit-stok" data-produk="<?php echo $tampil['sku']; ?>" data-nama="<?php echo $tampil['nama_produk']; ?>">Ubah Stok</option>
                                    <option value="edit-produk" data-produk="<?php echo $tampil['sku']; ?>" data-nama="<?php echo $tampil['nama_produk']; ?>">Ubah Produk</option>
                                    <option value="hapus-produk" data-produk="<?php echo $tampil['sku']; ?>" data-nama="<?php echo $tampil['nama_produk']; ?>">Hapus Produk</option>
                                </select>
                            </td>
                        </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>

                <!-- MODAL -->
                <div id="edit-stok" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-body">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Ubah Stok</h4>
                                </div>
                                <div class="modal-body">

                                    <form id="form-update-stok-produk" name="form-update-stok-produk" action="#" method="post">
                                        <div class="col_full">
                                            <label>Nama Produk :</label>
                                            <input type="hidden" name="sku-produk-stok" id="sku-produk-stok" value="">
                                            <input type="text" id="stok-nama-produk" name="stok-nama-produk" class="form-control" value="" disabled>
                                        </div>
                                        <div class="col_full">
                                            <label>Stok Produk :</label>
                                            <input type="number" id="stok-produk" name="stok-produk" class="form-control" placeholder="Masukan Stok Baru">
                                        </div>

                                        <button type="button" class="button button-3d button-rounded button-white button-light" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="button button-3d button-rounded button-green">Ubah</button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div id="konfirmasi-hapus-produk" name="konfirmasi-hapus-produk" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-body">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Hapus Produk</h4>
                                </div>
                                <div class="modal-body">
                                    <p class="nobottommargin">Ingin Menghapus Produk?</p>
                                </div>
                                <div class="modal-footer">

                                    <form id="form-hapus-produk" name="form-hapus-produk" action="#" method="post">
                                        <input id="sku-hapus-produk" name="sku-hapus-produk" type="hidden" value="">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

                <!-- Notifikasi Area -->
                <div id="notifikasi-gagal" data-notify-position="top-right" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Gagal mengubah!"></div>
                <div id="notifikasi-sukses" data-notify-position="top-right" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Berhasil diubah!"></div>

                <div id="notifikasi-hapus-gagal" data-notify-position="top-right" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Gagal Menghapus!"></div>
                <div id="notifikasi-hapus-sukses" data-notify-position="top-right" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Berhasil dihapus!"></div>

                <!-- End Notifikasi Area -->

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

<!-- Bootstrap Data Table Plugin -->
<script type="text/javascript" src="js/components/bs-datatable.js"></script>


<!-- Footer Scripts
============================================= -->
<script type="text/javascript" src="js/functions.js"></script>
<script>

    $(".select-hide").select2({
        minimumResultsForSearch: Infinity
    });
    $(document).ready(function() {
        $("#daftar-produk").dataTable();
    });

    $(".select-hide").change(function () {
        var value = $(this).find("option:selected").attr("value");
        var data_produk = $(this).find("option:selected").data("produk");
        var data_nama_produk = $(this).find("option:selected").data("nama");

        switch (value){
            case "edit-stok":
                $("#sku-produk-stok").val(data_produk);
                $("#stok-nama-produk").val(data_nama_produk);
                $("#edit-stok").modal("show");
                break;
            case "edit-produk":
                location.replace('tambah-produk.php?ubah='+data_produk);
                break;
            case "hapus-produk":
                $("#sku-hapus-produk").val(data_produk);
                $("#konfirmasi-hapus-produk").modal("show");
                break;
        }
    });


    $("#form-update-stok-produk").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "action.php?action=update-stok-produk",
            data: $(this).serialize(),
            success: function (response) {
                $("#edit-stok").modal("hide");

                if(response.error == true){
                    SEMICOLON.widget.notifications($("#notifikasi-gagal"));
                }else{
                    SEMICOLON.widget.notifications($("#notifikasi-sukses"));
                }
                setTimeout(location.reload.bind(location), 3000);
            },
            error: function (error) {

                $("#edit-stok").modal("hide");
                SEMICOLON.widget.notifications($("#notifikasi-gagal"));
            }
        });
    });

    $("#form-hapus-produk").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "action.php?action=hapus-produk",
            data: $(this).serialize(),
            success: function (response) {
                $("#konfirmasi-hapus-produk").modal("hide");

                if(response.error == true){
                    SEMICOLON.widget.notifications($("#notifikasi-hapus-gagal"));
                }else{
                    SEMICOLON.widget.notifications($("#notifikasi-hapus-sukses"));
                }
                setTimeout(location.reload.bind(location), 3000);
            },
            error: function (error) {

                $("#konfirmasi-hapus-produk").modal("hide");
                SEMICOLON.widget.notifications($("#notifikasi-hapus-gagal"));
            }
        });
    });

</script>

</body>
</html>