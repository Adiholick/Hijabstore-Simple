<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<?php
require_once "koneksi.php";
if(!isset($_SESSION)) {
    session_start();
}

$order = mysqli_real_escape_string($con, $_GET['order']);

if (empty($_SESSION['username'])){
    session_destroy();
    header('Location: login.php');
}else{
    $id = $_SESSION['id'];
    $sql = mysqli_query($con, "SELECT a.id, a.id_user, a.sku, a.keterangan, SUM(`jumlah`)as `subjumlah`, b.nama_produk, b.merk, b.harga, b.link, b.berat FROM `detail_pemesanan` AS a INNER JOIN `produk` as b ON a.sku = b.sku WHERE `id_user`='$id' AND `id_pemesanan`='$order' GROUP BY `sku` ");
    $count = mysqli_num_rows($sql);

    if($count == 0){
        header('Location: index.php');
    }else{
        while($rs = mysqli_fetch_array($sql)){
            $jumlah = $rs['subjumlah'];
            $harga = $rs['harga'];
            $subtotal = $harga * $jumlah;

            if(!isset($total)){
                $total = $subtotal;
            }else{
                $total += $subtotal;
            }
        }

        $sql = mysqli_query($con, "SELECT * FROM `pemesanan` WHERE `id_user`='$id' AND `id_pemesanan`='$order'");
        while($rs_pemesanan = mysqli_fetch_assoc($sql)){
            $kode_unik = $rs_pemesanan['kode_unik'];
        }
        $grand_total = $total + $kode_unik;
    }
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

    <!-- Select-Boxes CSS -->
    <link rel="stylesheet" href="css/components/select-boxes.css" type="text/css" />

    <link rel="stylesheet" href="css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Document Title
    ============================================= -->
    <title>Pembayaran | HijabStore</title>

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
            <h1>Pembayaran Pesanan</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Pembayaran Pesanan</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="container center clearfix">

                    <div class="heading-block center">
                        <h1>Pembayaran : Transfer Bank</h1>
                        <span>Mohon melakukan pembayaran sesuai data yang tertera, jangan dibulatkan agar mempermudah kami dalam proses verifikasi pesanan.</span>
                    </div>
                </div>

                <div class="col_full">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>
                                <h4>Nominal yang harus dibayarkan :</h4>
                            </th>
                            <th>
                                <h4 style="color: darkblue;"><?php echo "Rp. ". number_format($grand_total,2,',','.');  ?></h4>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="2">
                                Detail Pembayaran :
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Bank BCA
                            </td>
                            <td>
                                Bank Mandiri
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong> 723 4901 113 a/n Adi Nugroho</strong>
                            </td>
                            <td>
                                <strong> 168 0201 92917 1234 a/n Adi Nugroho</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="container center">
                                    <form name="konfirmasi-pembayaran" id="konfirmasi-pembayaran" method="post">
                                        <input type="hidden" name="id-pemesanan" id="id-pemesanan" value="<?php echo $order; ?>">
                                        <button type="submit" class="centertopmargin-sm button button-3d button-rounded button-yellow button-light">Konfirmasi Pembayaran</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="clear"></div>

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

<!-- Footer Scripts
============================================= -->
<script type="text/javascript" src="js/functions.js"></script>
<script>
    $("#konfirmasi-pembayaran").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "action.php?action=konfirmasi-pembayaran",
            data: $(this).serialize(),
            success: function (response) {
                window.location.href = response.link;

            },
            error: function (error) {

            }
        });
    });
</script>

</body>
</html>