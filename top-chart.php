<div id="top-cart">
    <?php

    if (empty($_SESSION['username'])){
        header('Location: login.php');
    }
    $id_user =$_SESSION['id'];
    $sql_top = mysqli_query($con, "SELECT a.id, a.id_user, a.sku, a.keterangan, SUM(`jumlah`)as `subjumlah`, b.nama_produk, b.merk, b.harga, b.link, b.berat FROM `cart` AS a INNER JOIN `produk` as b ON a.sku = b.sku WHERE `id_user`='$id_user' GROUP BY `sku` ");
    $count_cart = mysqli_num_rows($sql_top);
    ?>
    <a href="#" id="top-cart-trigger"><i class="icon-shopping-cart"></i><span><?php echo $count_cart; ?></span></a>
    <div class="top-cart-content">
        <div class="top-cart-title">
            <h4>Shopping Cart</h4>
        </div>
        <div class="top-cart-items">
            <?php
            while($cart_top = mysqli_fetch_array($sql_top)){
            ?>
            <div class="top-cart-item clearfix">
                <div class="top-cart-item-image">
                    <?php
                    $sku_pic = $cart_top['sku'];
                    $pic = mysqli_query($con, "SELECT * FROM `foto` WHERE `sku`='$sku_pic'");
                    if($rs_pic = mysqli_fetch_assoc($pic)){

                    }
                    ?>
                    <a href="#"><img src="images/<?php echo $rs_pic['file']; ?>"/></a>
                </div>
                <div class="top-cart-item-desc">
                    <a href="#"><?php echo $cart_top['nama_produk']; ?></a>
                    <span class="top-cart-item-price"><?php echo "Rp. ". number_format($cart_top['harga'],2,',','.'); ?></span>
                    <span class="top-cart-item-quantity">x <?php echo $cart_top['subjumlah']; ?></span>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="top-cart-action clearfix">
            <a href="cart.php">
                <button class="button button-3d button-small nomargin fright">View Cart</button>
            </a>
        </div>
    </div>
</div>