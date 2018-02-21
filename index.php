<!DOCTYPE html>
<?php
require_once "koneksi.php";
if(!isset($_SESSION)) {
    session_start();
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
    <link rel="stylesheet" href="css/swiper.css" type="text/css" />
    <link rel="stylesheet" href="css/dark.css" type="text/css" />
    <link rel="stylesheet" href="css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="css/animate.css" type="text/css" />
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

    <link rel="stylesheet" href="css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Document Title
    ============================================= -->
    <title>Home | Hijabstore - Hijab Terbaru - Terlengkap</title>

</head>

<body class="stretched">

<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Header
    ============================================= -->
    <?php include "header.php"; ?>
    <!-- #header end -->

    <section id="slider" class="slider-parallax swiper_wrapper full-screen clearfix" data-effect="fade" data-loop="true" data-speed="1000" data-progress="true">

        <div class="slider-parallax-inner">

            <div class="swiper-container swiper-parent">
                <div class="swiper-wrapper">
                    <div class="swiper-slide dark" style="background-image: url('images/slider/swiper/1.jpg');">
                        <div class="container clearfix">
                            <div class="slider-caption slider-caption-center">
                                <h2 data-caption-animate="fadeInUp">Yuk Berhijab!</h2>
                                <p data-caption-animate="fadeInUp" data-caption-delay="200">Berhijab bukanlah tanda sudah taat, justru langkah awal belajar taat:)</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide dark">
                        <div class="container clearfix">
                            <div class="slider-caption slider-caption-center">
                                <h2 data-caption-animate="fadeInUp">Modis</h2>
                                <p data-caption-animate="fadeInUp" data-caption-delay="200">Takut dibilang tidak modis? Tenang, kita punya banyak produk hijab yang akan bikin kamu tambah cantik.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide dark" style="background-image: url('images/slider-1.jpg'); background-position: center top;">
                        <div class="container clearfix">
                            <div class="slider-caption">
                                <h2 data-caption-animate="fadeInUp">Hijab Terbaru & Terlengkap</h2>
                                <p data-caption-animate="fadeInUp" data-caption-delay="200">Ingin tahu trend berhijab yang sedang <i>Booming</i>? Jangan khawatir, kita selalu update produk hijab terbaru dari penjuru dunia. Jadi, jangan sampai produk hijab yang kamu mau kehabisan ya!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="slider-arrow-left"><i class="icon-angle-left"></i></div>
                <div id="slider-arrow-right"><i class="icon-angle-right"></i></div>
            </div>

        </div>

    </section>

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <!-- Post Content
                ============================================= -->
                <div class="postcontent nobottommargin col_last">

                    <!-- Shop
                    ============================================= -->
                    <div id="shop" class="shop product-3 clearfix">

                        <?php
                        $batas = 9;
                        $halaman = isset($_GET['halaman'])?$_GET['halaman']:"";
                        if(empty($halaman)){
                            $posisi = 0;
                            $halaman = 1;
                        }else{
                            $posisi = ($halaman-1)*$batas;
                        }


                        if(isset($_GET['kategori'])){
                            $kategori = mysqli_real_escape_string($con, $_GET['kategori']);
                            $sql = mysqli_query($con, "SELECT * FROM `produk` WHERE `id_kategori`='$kategori' ORDER BY `id` DESC LIMIT $posisi,$batas");
                        }else{
                            $sql = mysqli_query($con, "SELECT * FROM `produk` ORDER BY `id` DESC LIMIT $posisi,$batas");
                        }

                        while ($tampil = mysqli_fetch_array($sql)){
                            $sku = $tampil['sku'];
                        ?>
                        <div class="product clearfix">
                            <div class="product-image">
                                <?php
                                $sql_foto = mysqli_query($con, "SELECT * FROM `foto` WHERE `sku`='$sku'");
                                while($foto = mysqli_fetch_array($sql_foto)){
                                ?>
                                <a href="produk.php?lihat=<?php echo $tampil['link']; ?>"><img src="images/<?php echo $foto['file']; ?>" alt="<?php echo $tampil['nama_produk']; ?>"></a>
                                <?php }?>
                            </div>
                            <div class="product-desc center">
                                <div class="product-title"><h3><a href="produk.php?lihat=<?php echo $tampil['link']; ?>"><?php echo $tampil['nama_produk']; ?></a></h3></div>
                                <div class="product-price"><?php echo "Rp. ". number_format($tampil['harga'],2,',','.'); ?></div>
                            </div>
                        </div>

                        <?php }

                        //Count data
                        if(isset($_GET['kategori'])){
                            $kategori = mysqli_real_escape_string($con, $_GET['kategori']);
                            $hitung_data = mysqli_query($con, "SELECT * FROM `produk` WHERE `id_kategori`='$kategori'");
                            $link_kategori = "kategori=".$kategori."&";
                        }else{
                            $hitung_data = mysqli_query($con, "SELECT * FROM `produk`");
                            $link_kategori = "";
                        }
                        $jumlah_data = mysqli_num_rows($hitung_data);
                        $jumlah_halaman = ceil($jumlah_data/$batas);

                        ?>
                        <div class="col_full bottom">
                            <ul class="pagination">
                                <?php
                                if($halaman > 1 ){
                                    $link = $halaman - 1 ;
                                    ?>
                                    <li><a href="index.php?<?php echo $link_kategori; ?>halaman=<?php echo $link; ?>">&laquo;</a></li>
                                    <?php
                                }else{

                                }

                                for($i = 1; $i <= $jumlah_halaman; $i++){
                                    if($i == $halaman){
                                        ?>
                                        <li class="active"><a href="index.php?<?php echo $link_kategori; ?>halaman=<?php echo $i; ?>"><?php echo $i; ?> <span class="sr-only">(current)</span></a></li>
                                        <?php
                                    }else{
                                        ?>
                                        <li><a href="index.php?<?php echo $link_kategori; ?>halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>

                                        <?php
                                    }
                                }

                                if($halaman < $jumlah_halaman){
                                    $link = $halaman + 1;
                                    ?>
                                    <li><a href="index.php?<?php echo $link_kategori; ?>halaman=<?php echo $link; ?>">&raquo;</a></li>
                                <?php
                                }

                                ?>
                            </ul>
                        </div>

                    </div><!-- #shop end -->

                </div><!-- .postcontent end -->

                <!-- Sidebar
                ============================================= -->
                <div class="sidebar nobottommargin">
                    <div class="sidebar-widgets-wrap">

                        <div class="widget widget_links clearfix">

                            <h4>Kategori</h4>
                            <ul>
                                <?php
                                $sql_kategori = mysqli_query($con, "SELECT * FROM `kategori`");
                                while($tampil_kategori = mysqli_fetch_array($sql_kategori)){
                                ?>
                                <li><a href="index.php?kategori=<?php echo $tampil_kategori['id_kategori']; ?>"><?php echo $tampil_kategori['nama_kategori']; ?></a></li>
                                <?php }?>
                            </ul>

                        </div>

                    </div>
                </div><!-- .sidebar end -->

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

<!-- Footer Scripts
============================================= -->
<script type="text/javascript" src="js/functions.js"></script>

</body>
</html>