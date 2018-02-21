<header id="header" class="transparent-header full-header" data-sticky-class="not-dark">

    <div id="header-wrap">

        <div class="container clearfix">

            <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

            <!-- Logo
            ============================================= -->
            <div id="logo">
                <a href="index.php" class="standard-logo" data-dark-logo="images/"><img src="images/" alt="HijabStore Logo"></a>
                <a href="index.php" class="retina-logo" data-dark-logo="images/"><img src="images/" alt="HijabStore Logo"></a>
            </div><!-- #logo end -->

            <!-- Primary Navigation
            ============================================= -->
            <nav id="primary-menu">

                <ul>
                    <?php
                    if (!empty($_SESSION['username'])){
                        $status = $_SESSION['status'];
                        $sql_nav = mysqli_query($con, "SELECT * FROM `menu` WHERE `status`='$status'");
                        while($rs_nav = mysqli_fetch_array($sql_nav)){
                            ?>
                            <li><a href="<?php echo $rs_nav['link']; ?>"><?php echo $rs_nav['nama'] ?></a></li>
                            <?php
                        }
                    }
                    ?>
                    <li><a href="index.html"><div>Kategori</div></a>
                        <ul>
                            <?php
                            $sql_menu_kat = mysqli_query($con, "SELECT * FROM `kategori`");
                            while($tampil_menu_kat = mysqli_fetch_array($sql_menu_kat)){
                            ?>
                            <li><a href="index.php?kategori=<?php echo $tampil_menu_kat['id_kategori']; ?>"><div><?php echo $tampil_menu_kat['nama_kategori']; ?></div></a></li>
                            <?php }?>
                        </ul>
                    </li>
                    <?php
                    if(empty($_SESSION['username'])){
                        echo "<li class=\"mega-menu\"><a href=\"login.php\"><div>Masuk</div></a></li>";
                    }
                    ?>

                </ul>

                <!-- Top Cart
                ============================================= -->
                <?php
                if (!empty($_SESSION['username'])){
                    include "top-chart.php";
                }
                ?>
                <!-- #top-cart end -->

            </nav><!-- #primary-menu end -->

        </div>

    </div>

</header>