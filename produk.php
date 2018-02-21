<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<?php
require_once "koneksi.php";
if(!isset($_SESSION)) {
    session_start();
}

if(isset($_GET['lihat'])){
    $link = mysqli_real_escape_string($con, $_GET['lihat']);
}else{
    header('Location: index.php');
}

$sql = mysqli_query($con, "SELECT a.*, b.nama_kategori FROM `produk` AS a INNER JOIN `kategori` AS b ON a.id_kategori=b.id_kategori WHERE `link`='$link'");
$count_data = mysqli_num_rows($sql);
if($count_data > 0 ){
    if($tampil = mysqli_fetch_assoc($sql)){
        $id = $tampil['id'];
        $sku = $tampil['sku'];
        $nama_produk = $tampil['nama_produk'];
        $merk = $tampil['merk'];
        $berat = $tampil['berat'];
        $id_kategori = $tampil['id_kategori'];
        $harga = $tampil['harga'];
        $deskripsi = $tampil['deskripsi'];
        $deskripsi_singkat = $tampil['deskripsi_singkat'];
        $nama_kategori = $tampil['nama_kategori'];
    }
}else{
    header('Location: index.php');
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
    <title><?php echo $nama_produk; ?> | Hijabstore </title>

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
            <h1><?php echo $nama_produk; ?></h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Produk</a></li>
                <li class="active"><?php echo $nama_produk; ?></li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
		============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="single-product">

                    <div class="product">

                        <div class="col_two_fifth">

                            <!-- Product Single - Gallery
                            ============================================= -->
                            <div class="product-image">
                                <div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
                                    <div class="flexslider">
                                        <div class="slider-wrap" data-lightbox="gallery">
                                            <?php
                                            $sql_foto = mysqli_query($con, "SELECT * FROM `foto` WHERE `sku`='$sku'");
                                            while($foto = mysqli_fetch_array($sql_foto)){
                                            ?>
                                            <div class="slide" data-thumb="images/<?php echo $foto['file']; ?>"><a href="images/<?php echo $foto['file']; ?>" data-lightbox="gallery-item"><img src="images/<?php echo $foto['file']; ?>"></a></div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Product Single - Gallery End -->

                        </div>

                        <div class="col_two_fifth product-desc">

                            <!-- Product Single - Price
                            ============================================= -->
                            <div class="product-price"><?php echo "Rp. ". number_format($harga,2,',','.'); ?></div><!-- Product Single - Price End -->

                            <div class="clear"></div>
                            <div class="line"></div>

                            <!-- Product Single - Quantity & Cart Button
                            ============================================= -->
                            <button type="button" id="btn-add-cart" name="btn-add-cart" class="add-to-cart button nomargin">Beli</button>
                            <!-- Product Single - Quantity & Cart Button End -->

                            <!-- Modal Cart
                                            ============================================= -->
                            <div class="modal fade" id="add-cart-modal" name="add-cart-modal" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Tambah Keranjang Belanja</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form class="nobottommargin" id="form-add-cart" name="form-add-cart" action="#" method="post">

                                                <div class="col_full col_last">
                                                    <label>Jumlah Produk <small>*</small></label>
                                                    <input type="hidden" id="sku-produk" name="sku-produk" value="<?php echo $sku; ?>">
                                                    <input type="number" id="jumlah-produk" name="jumlah-produk" class="required form-control">
                                                </div>

                                                <div class="clear"></div>

                                                <div class="col_full">
                                                    <label>Keterangan <small>*</small></label>
                                                    <textarea class="required form-control" id="keterangan-produk" name="keterangan-produk" rows="6" cols="30"></textarea>
                                                </div>

                                                <div class="col_full nobottommargin">
                                                    <button class="button button-3d nomargin" type="submit" id="btn-submit-add-cart" name="btn-submit-add-cart" value="submit">Beli Produk Ini</button>
                                                </div>

                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            <!-- Modal Cart End -->

                            <div class="clear"></div>
                            <div class="line"></div>

                            <!-- Product Single - Short Description
                            ============================================= -->
                            <p><?php echo $deskripsi_singkat; ?></p>

                            <!-- Product Single - Meta
                            ============================================= -->
                            <div class="panel panel-default product-meta">
                                <div class="panel-body">
                                    <span itemprop="productID" class="sku_wrapper">SKU: <span class="sku"><?php echo $sku; ?></span></span>
                                    <span class="posted_in">Kategori: <a href="index.php?kategori=<?php echo $id_kategori; ?>" rel="tag"><?php echo $nama_kategori; ?></a>.</span>
                                    <span class="merk_wrapper">Merk: <span class="merk"><?php echo $merk; ?></span></span>
                                    <span class="berat_wrapper">Berat Pengiriman: <span class="merk"><?php echo $berat; ?> gram</span></span>
                                </div>
                            </div><!-- Product Single - Meta End -->


                        </div>

                        <div class="col_one_fifth col_last">

                            <div class="divider divider-center"><i class="icon-circle-blank"></i></div>

                            <div class="feature-box fbox-plain fbox-dark fbox-small">
                                <div class="fbox-icon">
                                    <i class="icon-thumbs-up2"></i>
                                </div>
                                <h3>100% Asli</h3>
                                <p class="notopmargin">Kami menjamin produk yang kami jual 100% asli.</p>
                            </div>

                            <div class="feature-box fbox-plain fbox-dark fbox-small">
                                <div class="fbox-icon">
                                    <i class="icon-credit-cards"></i>
                                </div>
                                <h3>Pembayaran Mudah</h3>
                                <p class="notopmargin">Kami menerima berbagai metode pembayaran.</p>
                            </div>

                            <div class="feature-box fbox-plain fbox-dark fbox-small">
                                <div class="fbox-icon">
                                    <i class="icon-truck2"></i>
                                </div>
                                <h3>Pengiriman Dijamin</h3>
                                <p class="notopmargin">Kami melakukan pengiriman untuk seluruh wilayah Indonesia.</p>
                            </div>


                        </div>

                        <div class="col_full nobottommargin">

                            <div class="tabs clearfix nobottommargin" id="tab-1">

                                <ul class="tab-nav clearfix">
                                    <li><a href="#tabs-1"><i class="icon-align-justify2"></i><span class="hidden-xs"> Description</span></a></li>
                                </ul>

                                <div class="tab-container">

                                    <div class="tab-content clearfix" id="tabs-1">
                                        <p><?php echo $deskripsi; ?></p>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- Notifikasi Area -->
                    <div id="notifikasi-gagal" data-notify-position="top-right" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Gagal menambahkan!"></div>
                    <div id="notifikasi-sukses" data-notify-position="top-right" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Berhasil ditambahkan!"></div>


                </div>

                <div class="clear"></div><div class="line"></div>


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
<script type="text/javascript" language="JavaScript">
    $("#btn-add-cart").click(function (e) {
        e.preventDefault();
        <?php
        if (empty($_SESSION['username'])){
            ?>
        location.replace('login.php');
        <?php
        }
        ?>
        $("#add-cart-modal").modal("show");
    });

    $("#form-add-cart").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "action.php?action=add-cart",
            data: $(this).serialize(),
            success: function (response) {
                $("#add-cart-modal").modal("hide");
                if(response.error == true){
                    SEMICOLON.widget.notifications($("#notifikasi-gagal"));
                }else{
                    SEMICOLON.widget.notifications($("#notifikasi-sukses"));
                    setTimeout(location.reload.bind(location), 3000);
                }
            },
            error: function (error) {

                $("#add-cart-modal").modal("hide");
                SEMICOLON.widget.notifications($("#notifikasi-gagal"));
            }
        });
    });
</script>

</body>
</html>