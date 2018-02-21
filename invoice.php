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
    <title>Invoice | HijabStore</title>

</head>

<body>

<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">


    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">
                <?php
                $order = mysqli_real_escape_string($con, $_GET['order']);
                $sql_pemesanan = mysqli_query($con, "SELECT a.*, b.province, c.city_name, c.type FROM `pemesanan` AS a INNER JOIN `province` AS b ON a.provinsi = b.province_id INNER JOIN `city` AS c ON a.kota = c.city_id WHERE `id_pemesanan`='$order'");
                if($rs_pemesanan = mysqli_fetch_assoc($sql_pemesanan)){
                    $nama_penerima = $rs_pemesanan['nama_penerima'];
                    $kurir = $rs_pemesanan['kurir'];
                    $alamat_lengkap = $rs_pemesanan['alamat_lengkap'];
                    $ongkir = $rs_pemesanan['ongkir'];
                    $berat = $rs_pemesanan['berat'];
                    $metode_pembayaran = $rs_pemesanan['metode_pembayaran'];
                    $provinsi = $rs_pemesanan['province'];
                    $kota = $rs_pemesanan['city_name'];
                    $type = $rs_pemesanan['type'];
                    $kode_unik = $rs_pemesanan['kode_unik'];

                }
                ?>
                <div class="col_full center">
                    <div class="feature-box fbox-center fbox-bg fbox-light fbox-effect">
                        <div class="fbox-icon">
                            <a href="#"><i class="icon-truck2"></i></a>
                        </div>
                        <h3>INVOICE-<?php echo $order; ?></h3>
                    </div>
                </div>
                <div class="col_one_third">
                    <label>Nama :</label> <br><?php echo $nama_penerima; ?>
                    <br>
                    <label>Metode Pembayaran :</label> <br><?php echo $metode_pembayaran; ?>
                    <br>
                    <label>Kode Unik :</label> <br><?php echo $kode_unik; ?>
                </div>
                <div class="col_one_third">
                    <label>Ongkir :</label> <br><?php echo $ongkir; ?>
                    <br>
                    <label>Kurir :</label> <br><?php echo $kurir; ?>
                    <br>
                    <label>Berat :</label> <br><?php echo $berat; ?> gram
                </div>
                <div class="col_one_third col_last">
                    <label>Alamat :</label> <br><?php echo $alamat_lengkap; ?>
                    <br>
                    <label>Provinsi :</label> <br><?php echo $provinsi; ?>
                    <br>
                    <label>Kota :</label> <br><?php echo $type; ?> , <?php echo $kota; ?>
                    <br>
                </div>
                <div class="col_full">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>SKU</th>
                            <th>Produk</th>
                            <th>Merk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Keterangan</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 0;
                        $sql_detail = mysqli_query($con, "SELECT a.id, a.id_user, a.sku, a.keterangan, SUM(`jumlah`)as `subjumlah`, b.nama_produk, b.merk, b.harga, b.link, b.berat FROM `detail_pemesanan` AS a INNER JOIN `produk` as b ON a.sku = b.sku WHERE `id_pemesanan`='$order' GROUP BY `sku`");
                        while($rs_detail = mysqli_fetch_array($sql_detail)){
                            $no++;
                            $sku= $rs_detail['sku'];
                            $keterangan= $rs_detail['keterangan'];
                            $subjumlah= $rs_detail['subjumlah'];
                            $nama_produk= $rs_detail['nama_produk'];
                            $merk= $rs_detail['merk'];
                            $harga= $rs_detail['harga'];

                            $subtotal = $harga * $subjumlah;
                            if(!isset($total)){
                                $total = $subtotal;
                            }else{
                                $total += $subtotal;
                            }

                            $grand_total = $total + $kode_unik;
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $sku; ?></td>
                            <td><?php echo $nama_produk; ?></td>
                            <td><?php echo $merk; ?></td>
                            <td><?php echo "Rp. ". number_format($harga,2,',','.'); ?></td>
                            <td><?php echo $subjumlah; ?></td>
                            <td><?php echo "Rp. ". number_format($subtotal,2,',','.'); ?></td>
                            <td><?php echo $keterangan; ?></td>

                        </tr>
                        <?php } ?>
                        <tr>
                            <td><strong>Grand Total :</strong></td>
                            <td colspan="8">
                                <div class="title-right"><h4><?php echo "Rp. ". number_format($grand_total,2,',','.'); ?></h4></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </section><!-- #content end -->



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