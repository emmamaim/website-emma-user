<?php
(!isset($_SESSION)) ? session_start() : "";
?>
<!-- 鏈接資料庫 -->
<?php
require_once('Connections/conn_db.php');
?>
<!-- 載入共用php函數庫 -->
<?php require_once("php_lib.php"); ?>
<!doctype html>
<html lang="zh-TW">

<head>
    <!-- 導入head鏈接 -->
    <?php require_once('headfile.php'); ?>
</head>

<body>
    <!-- ================= header ================= -->
    <section id="header">
        <!-- 導入導航條 -->
        <?php require_once('header.php'); ?>
    </section>

    <!-- ================= introduction ================= -->
    <section id="introduction" class="pt-5 mt-5">
        <div class="container">
            <div class="row text-center intro-row">

                <div class="col-md-4">
                    <a class="intro-card" href="#">
                        <figure class="intro-media">
                            <img src="images/1.png" class="img-fluid" alt="LOVE">
                            <figcaption class="intro-caption">
                                <span class="intro_text animate__animated animate__jackInTheBox animate__delay-1s">LOVE</span>
                            </figcaption>
                        </figure>
                    </a>
                </div>

                <div class="col-md-4">
                    <a class="intro-card" href="#">
                        <figure class="intro-media">
                            <img src="images/2.png" class="img-fluid" alt="WARM">
                            <figcaption class="intro-caption">
                                <span class="intro_text animate__animated animate__jackInTheBox animate__delay-1s">WARM</span>
                            </figcaption>
                        </figure>
                    </a>
                </div>

                <div class="col-md-4">
                    <a class="intro-card" href="#">
                        <figure class="intro-media">
                            <img src="images/3.png" class="img-fluid" alt="FITNESS">
                            <figcaption class="intro-caption">
                                <span class="intro_text animate__animated animate__jackInTheBox animate__delay-1s">FITNESS</span>
                            </figcaption>
                        </figure>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- ================= news ================= -->
    <section id="news" class="py-5">
        <div class="container">
            <div class="news-list d-flex align-items-center justify-content-start flex-wrap">
                <img src="images/news.png" alt="" class="img-fluid" style="width: 110px;border-radius: 40%;">

                <a href="#" class="news-item text-decoration-none px-3">
                    <small class="text-muted">2026.01.20</small><br>
                    <p>EMMA 媽媽社群正式啟動</p>
                </a>

                <a href="#" class="news-item text-decoration-none px-3">
                    <small class="text-muted">2026.01.12</small><br>
                    <p>官網全新改版上線</p>
                </a>

                <a href="#" class="news-item text-decoration-none px-3">
                    <small class="text-muted">2026.01.05</small><br>
                    <p>春季育兒講座：早教啟蒙報名中</p>
                </a>

                <!-- 查看更多會靠右 -->
                <a href="#" class="text-decoration-none text-center ms-auto">
                    <p class="m-0">view all</p>
                    <i class="fa-solid fa-eye" style="color: #B197FC;"></i>
                </a>

            </div>
        </div>
    </section>

    <!-- ================= products ================= -->
    <section id="products" class="py-5 bg-light">
        <div class="container">
            <!-- 標題-->
            <div class="row mb-4">
                <div class="col text-center">
                    <h2 class="fw-bold">精選商品</h2>
                    <p class="text-muted">為媽媽與寶寶嚴選</p>
                </div>
            </div>
            <!-- 商品輪播 -->
            <div class="row mb-5">
                <div class="col-12">
                    <?php require_once('carousel.php'); ?>
                </div>
            </div>
            <!-- 商品列表 -->
            <div class="row" id="product-list">
                <div class="col-12">
                    <?php require_once('product_list.php'); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ================= links ================= -->
    <section id="divs" class="py-5">
        <!-- 導入links相關鏈接 -->
        <?php require_once('links.php'); ?>
    </section>

    <!-- ================= footer ================= -->
    <section id="footer" class="py-4 text-center bg-dark text-white">
        <!-- 導入底部 -->
        <?php require_once('footer.php'); ?>
    </section>

    <!-- 導入JS文檔 -->
    <!-- <?php require_once('jsfile.php'); ?> -->
</body>

</html>