<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<?php
require_once "koneksi.php";
if(!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['username'])){
    session_destroy();
    header('Location: login.php');
}
$cek_user = $_SESSION['id'];
$sql_count_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE `id_user`='$cek_user'");
$count = mysqli_num_rows($sql_count_cart);
if($count==0){
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

    <!-- Radio Checkbox Plugin -->
    <link rel="stylesheet" href="css/components/radio-checkbox.css" type="text/css" />


    <link rel="stylesheet" href="css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Document Title
    ============================================= -->
    <title>Keranjang Belanja | HijabStore</title>

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
            <h1>Keranjang Belanja</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Keranjang Belanja</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="table-responsive bottommargin">

                    <table class="table cart">
                        <thead>
                        <tr>
                            <th class="cart-product-thumbnail">&nbsp;</th>
                            <th class="cart-product-name">Product</th>
                            <th class="cart-product-price">Unit Price</th>
                            <th class="cart-product-quantity">Quantity</th>
                            <th class="cart-product-subtotal">Total</th>
                            <th>Keterangan</th>
                            <th>Pilihan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <form class="nobottommargin" id="form-checkout" name="form-checkout" action="#" method="post">
                        <?php
                        $id_user =$_SESSION['id'];
                        $sql_cart = mysqli_query($con, "SELECT a.id, a.id_user, a.sku, a.keterangan, SUM(`jumlah`)as `subjumlah`, b.nama_produk, b.merk, b.harga, b.link, b.berat FROM `cart` AS a INNER JOIN `produk` as b ON a.sku = b.sku WHERE `id_user`='$id_user' GROUP BY `sku` ");
                        while($cart = mysqli_fetch_array($sql_cart)){
                        ?>
                        <tr class="cart_item">
                            <?php
                            $sku_pic = $cart['sku'];
                            $pic = mysqli_query($con, "SELECT * FROM `foto` WHERE `sku`='$sku_pic'");
                            if($rs_pic = mysqli_fetch_assoc($pic)){

                            }
                            ?>
                            <td class="cart-product-thumbnail">
                                <a href="#"><img width="64" height="64" src="images/<?php echo $rs_pic['file']; ?>" alt="<?php echo $rs_pic['nama_produk']; ?>"></a>
                            </td>

                            <td class="cart-product-name">
                                <a href="#"><?php echo $cart['nama_produk']; ?></a>
                                <?php
                                if(!isset($berat)){
                                    $berat= $cart['berat'] * $cart['subjumlah'];
                                }else{
                                    $berat += $cart['berat'] * $cart['subjumlah'];
                                }
                                ?>
                            </td>

                            <td class="cart-product-price">
                                <span class="amount"><?php echo "Rp. ". number_format($cart['harga'],2,',','.'); ?></span>
                            </td>

                            <td class="cart-product-quantity">
                                <span class="amount"><?php echo $cart['subjumlah']; ?></span>
                            </td>

                            <td class="cart-product-subtotal">
                                <span class="amount"><?php
                                    $subtotal= $cart['harga']*$cart['subjumlah'];
                                    if(!isset($grandtotal)){
                                        $grandtotal = $subtotal;
                                    }else{
                                        $grandtotal +=$subtotal;
                                    }
                                    echo "Rp. ". number_format($subtotal,2,',','.');
                                ?></span>
                            </td>
                            <td>
                                <span clas="amount"><?php echo $cart['keterangan']; ?></span>
                            </td>
                            <td>
                                <select style="width: 80pt;" id="action-produk" name="action-produk" class="select-hide form-control bottommargin-sm select-produk">
                                    <option value="" disabled="disabled" selected>-Pilih-</option>
                                    <option value="edit-qty" data-produk="<?php echo $cart['sku']; ?>" data-nama="<?php echo $cart['nama_produk']; ?>" data-keterangan="<?php echo $cart['keterangan']; ?>">Ubah Jumlah</option>
                                    <option value="hapus-produk" data-produk="<?php echo $cart['sku']; ?>" data-nama="<?php echo $cart['nama_produk']; ?>">Hapus Produk</option>
                                </select>
                            </td>

                                <input type="hidden" name="sku_checkout[]" id="sku_checkout[]" value="<?php echo $cart['sku']; ?>">
                                <input type="hidden" name="qty_checkout[]" id="qty_checkout[]" value="<?php echo $cart['subjumlah']; ?>">
                                <input type="hidden" name="keterangan_checkout[]" id="keterangan_checkout[]" value="<?php echo $cart['keterangan']; ?>">

                        </tr>
                        <?php }?>
                        </form>
                        </tbody>

                    </table>

                </div>



                <div class="row clearfix">
                    <div class="col-md-6 clearfix">
                        <h4>Alamat Pengiriman</h4>
                        <form id="form-alamat-pengiriman" name="form-alamat-pengiriman" action="#" method="post">
                            <div class="col_full">
                                <input name="nama-penerima" id="nama-penerima" placeholder="Nama Penerima" class="form-control">
                            </div>
                            <div class="col_full">
                                <label>Provinsi</label>
                                <select class="select-hide form-control bottommargin-sm select-provinsi" id="provinsi-pengiriman" name="provinsi-pengiriman">
                                    <option value="" disabled="disabled" selected>Silahkan Pilih Provinsi</option>
                                    <?php
                                    $query_provinsi = mysqli_query($con, "SELECT * FROM `province`");
                                    while($rs_provinsi  = mysqli_fetch_array($query_provinsi)){
                                    ?>
                                    <option value="<?php echo $rs_provinsi['province_id']; ?>"><?php echo $rs_provinsi['province']; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col_half">
                                <label>Kota</label>
                                <select class="select-hide form-control bottommargin-sm select-kota" id="kota-pengiriman" name="kota-pengiriman">
                                    <option value="" disabled="disabled" selected>Silahkan Pilih Provinsi</option>
                                </select>
                            </div>

                            <div class="col_half col_last">
                                <label>Expedisi Pengiriman</label>
                                <select class="select-hide form-control bottommargin-sm select-kurir" id="kurir-pengiriman" name="kurir-pengiriman">
                                    <option value="" disabled="disabled" selected>Silahkan Pilih Pengiriman</option>
                                    <option value="jne">JNE</option>
                                </select>
                            </div>
                            <div class="col_full">
                                <label>Alamat Lengkap</label>
                                <textarea id="alamat-lengkap" name="alamat-lengkap" class="form-control" placeholder="Masukan Alamat Lengkap"></textarea>
                                <input type="hidden" name="biaya-ongkir" id="biaya-ongkir" value="0">
                                <input type="hidden" name="berat-ongkir" id="berat-ongkir" value="<?php echo $berat ?>">
                            </div>
                            <div class="col_full">
                                <h5>Metode Pembayaran</h5>

                                <input id="metode-pembayaran-1" class="radio-style" name="metode-pembayaran" type="radio" value="transfer" checked>
                                <label for="metode-pembayaran-1" class="radio-style-2-label">Bank Transfer</label>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6 clearfix">
                        <div class="table-responsive">
                            <h4>Cart Totals</h4>

                            <table class="table cart">
                                <tbody>
                                <tr class="cart_item">
                                    <td class="cart-product-name">
                                        <strong>Cart Subtotal</strong>
                                    </td>

                                    <td class="cart-product-name">
                                        <span class="amount"><?php echo "Rp. ". number_format($grandtotal,2,',','.'); ?></span>
                                    </td>
                                </tr>
                                <tr class="cart_item">
                                    <td class="cart-product-name">
                                        <strong>Berat Pengiriman</strong>
                                    </td>

                                    <td class="cart-product-name">
                                        <span class="amount"><?php echo $berat." gram"; ?></span>
                                    </td>
                                </tr>
                                <tr class="cart_item">
                                    <td class="cart-product-name">
                                        <strong>Pengiriman</strong>
                                    </td>

                                    <td class="cart-product-name">
                                        <span class="amount">Free Delivery</span>
                                    </td>
                                </tr>
                                <tr class="cart_item">
                                    <td class="cart-product-name">
                                        <strong>Total</strong>
                                    </td>

                                    <td class="cart-product-name">
                                        <span class="amount color lead"><strong><?php echo "Rp. ". number_format($grandtotal,2,',','.'); ?></strong></span>
                                    </td>
                                </tr>
                                </tbody>

                            </table>

                        </div>
                    </div>

                    <div class="col_full">
                        <button id="btn-checkout" class="button button-xlarge button-circle button-3d button-dirtygreen fright">Lakukan Pemesanan</button>
                    </div>

                </div>


            </div>

            <!-- MOdal -->
            <div id="edit-qty-modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-body">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Ubah Stok</h4>
                            </div>
                            <div class="modal-body">

                                <form id="form-update-qty-produk" name="form-update-qty-produk" action="#" method="post">
                                    <div class="col_full">
                                        <label>Nama Produk :</label>
                                        <input type="hidden" name="sku-produk-qty" id="sku-produk-qty" value="">
                                        <input type="text" id="stok-nama-produk" name="stok-nama-produk" class="form-control" value="" disabled>
                                    </div>
                                    <div class="col_full">
                                        <label>Jumlah:</label>
                                        <input type="number" id="qty-produk" name="qty-produk" class="form-control" placeholder="Masukan Jumlah Baru">
                                    </div>
                                    <div class="col_full">
                                        <label>Keterangan <small>*</small></label>
                                        <textarea class="required form-control" id="keterangan-produk" name="keterangan-produk" rows="6" cols="30"></textarea>
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

                                <form id="form-hapus-produk-cart" name="form-hapus-produk-cart" action="#" method="post">
                                    <input id="sku-hapus-produk" name="sku-hapus-produk" type="hidden" value="">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL -- >

            <!-- Notifikasi Area -->
            <div id="notifikasi-gagal" data-notify-position="top-right" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Gagal mengubah!"></div>
            <div id="notifikasi-sukses" data-notify-position="top-right" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Berhasil diubah!"></div>


            <div id="notifikasi-hapus-gagal" data-notify-position="top-right" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Gagal Menghapus!"></div>
            <div id="notifikasi-hapus-sukses" data-notify-position="top-right" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Berhasil dihapus!"></div>


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
    $(".select-hide").select2({
        minimumResultsForSearch: Infinity
    });

    $(".select-produk").change(function () {
        var value = $(this).find("option:selected").attr("value");
        var data_produk = $(this).find("option:selected").data("produk");
        var data_nama_produk = $(this).find("option:selected").data("nama");
        var data_keterangan = $(this).find("option:selected").data("keterangan");

        switch (value){
            case "edit-qty":
                $("#sku-produk-qty").val(data_produk);
                $("#stok-nama-produk").val(data_nama_produk);
                $("textarea#keterangan-produk").val(data_keterangan);
                $("#edit-qty-modal").modal("show");
                break;
            case "hapus-produk":
                $("#sku-hapus-produk").val(data_produk);
                $("#konfirmasi-hapus-produk").modal("show");
                break;
        }
    });
    $(".select-provinsi").change(function () {
        var provinsi = $(this).find("option:selected").attr("value");
        if(provinsi){
            $.ajax({
                type: "POST",
                url : "action.php?action=kota-search",
                data : {
                    "provinsi":provinsi
                },success: function (response) {
                    $("#kota-pengiriman").html(response);
                }

            });
        }else{
            $("#kota").html('<option value="">Silahkan Pilih Provinsi</option>');
        }
    });

    $("#kurir-pengiriman").change(function () {
        var kurir = $(this).find("option:selected").attr("value");
        var kota = $('#kota-pengiriman').find("option:selected").attr("value");

        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "ongkir.php",
            data : {
                "destination":kota,
                "weight": <?php echo $berat; ?>,
                "courier": kurir
            },
            success: function (response) {
                console.log(response.rajaongkir.results);
            },
            error: function (error) {
            }
        });

    });

    $("#form-update-qty-produk").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "action.php?action=update-cart",
            data: $(this).serialize(),
            success: function (response) {
                $("#edit-qty-modal").modal("hide");

                if(response.error == true){
                    SEMICOLON.widget.notifications($("#notifikasi-gagal"));
                }else{
                    SEMICOLON.widget.notifications($("#notifikasi-sukses"));
                }
                setTimeout(location.reload.bind(location), 3000);
            },
            error: function (error) {

                $("#edit-qty-modal").modal("hide");
                SEMICOLON.widget.notifications($("#notifikasi-gagal"));
            }
        });
    });

    $("#form-hapus-produk-cart").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "action.php?action=hapus-produk-cart",
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

    $("#btn-checkout").click(function () {
        $("#form-checkout").submit();
    });
    $("#form-checkout").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "action.php?action=checkout-pemesanan",
            data: $(this).serialize() + "&" + $("#form-alamat-pengiriman").serialize(),
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