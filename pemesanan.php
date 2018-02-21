<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<?php
require_once "koneksi.php";
if(!isset($_SESSION)) {
    session_start();
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
    <title>Pemesanan | HijabStore</title>

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
            <h1>Pemesanan</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Pemesanan</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">
                <div class="col_full">
                    <h4>Daftar Pemesanan</h4>
                </div>
                <div class="col_full">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pemesanan</th>
                            <th>Nama Penerima</th>
                            <th>Provinsi</th>
                            <th>Tipe</th>
                            <th>Kota</th>
                            <th>Expedisi</th>
                            <th>Total Pembayaran</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                            <th>Lihat</th>
                        </tr>
                        </thead>
                        <tbod>
                            <?php
                            $no=0;
                            $id_user = $_SESSION['id'];
                            $sql_produk = mysqli_query($con, "SELECT a.*, b.province, c.city_name, c.type FROM `pemesanan` AS a INNER JOIN `province` AS b ON a.provinsi = b.province_id INNER JOIN `city` AS c ON a.kota = c.city_id WHERE `id_user`='$id_user'");
                            while ($tampil = mysqli_fetch_array($sql_produk)){
                                $no++;
                                $order = $tampil['id_pemesanan'];
                                $kode_unik = $tampil['kode_unik'];

                                $sql_detail = mysqli_query($con, "SELECT a.id, a.id_user, a.sku, a.keterangan, SUM(`jumlah`)as `subjumlah`, b.nama_produk, b.merk, b.harga, b.link, b.berat FROM `detail_pemesanan` AS a INNER JOIN `produk` as b ON a.sku = b.sku WHERE `id_pemesanan`='$order' GROUP BY `sku` ");
                                while($rs_detail = mysqli_fetch_array($sql_detail)){
                                    $jumlah = $rs_detail['subjumlah'];
                                    $harga = $rs_detail['harga'];
                                    $subtotal = $harga * $jumlah;
                                    if(!isset($total)){
                                        $total = $subtotal;
                                    }else{
                                        $total += $subtotal;
                                    }

                                }
                                $grand_total = $total + $kode_unik;
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $tampil['id_pemesanan']; ?></td>
                                    <td><?php echo $tampil['nama_penerima']; ?></td>
                                    <td><?php echo $tampil['province']; ?></td>
                                    <td><?php echo $tampil['type']; ?></td>
                                    <td><?php echo $tampil['city_name']; ?></td>
                                    <td><?php echo $tampil['kurir']; ?></td>
                                    <td><?php echo "Rp. ". number_format($grand_total,2,',','.');  ?></td>
                                    <td><?php echo $tampil['metode_pembayaran']; ?></td>
                                    <td>
                                        <?php if($tampil['konfirmasi'] == 0){
                                            echo "Belum dibayar";
                                        }elseif($tampil['konfirmasi'] == 1){
                                            echo "Sudah dibayar";
                                        }elseif($tampil['konfirmasi']== 2){
                                            echo "Sudah dikirim";
                                        } ?>
                                    </td>
                                    <td><a class="button button-3d button-mini button-rounded button-aqua" href="invoice.php?order=<?php echo $tampil['id_pemesanan']; ?>">Lihat</a></td>
                                </tr>
                            <?php }?>
                        </tbod>
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

</body>
</html>