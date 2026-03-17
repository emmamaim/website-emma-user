<?php
(!isset($_SESSION)) ? session_start() : "";
?>
<?php
require_once('Connections/conn_db.php');
?>
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

    <!-- ================= products ================= -->
    <section id="products" class="py-5 bg-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <!-- 引入側邊導航 -->
                    <?php require_once("sidebar.php"); ?>
                </div>
                <!-- 產品列表 -->
                <div class="col-md-10">
<h3>會員結賬作業</h3>
<div class="row">
    <div class="card col">
        <div class="card-header" style="color:#007bff;">
            <i class="fas fa-truck fa-flip-horizontal me-1"></i>
            配送資訊
        </div>
        <div class="card-body">
            <h4 class="card-title">收件人資訊：</h4>
            <h5 class="card-title">姓名：EMMA</h5>
            <p class="card-text">電話：0912345678</p>
            <p class="card-text">郵遞區號：407臺中市西屯區</p>
            <p class="card-text">地址：中正路1號</p>
            <a href="#" class="btn btn-outline-primary">選擇其他收件人</a>
        </div>
    </div>
    <div class="card col ms-3">
        <div class="card-header" style="color:#000;">
            <i class="fas fa-credit-card me-1"></i>
            付款方式
        </div>
        <div class="card-body">
            <h4 class="card-title">收件人資訊：</h4>
            <h5 class="card-title">姓名：李小明</h5>
            <p class="card-text">電話：0912345678</p>
            <p class="card-text">郵遞區號：407臺中市西屯區</p>
            <p class="card-text">地址：中正路1號</p>
            <a href="#" class="btn btn-outline-primary">選擇其他收件人</a>
        </div>
    </div>
</div>      
<div class="table-responsive-md">
    <table class="table table-hover mt-3">
        <thead>
            <tr class="text-bg-primary">
                <td width="10%">產品編號</td>
                <td width="10%">圖片</td>
                <td width="30%">名稱</td>
                <td width="15%">價格</td>
                <td width="15%">數量</td>
                <td width="20%">小計</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>
                    <img src="product_img/zoom-front-174388.webp" alt="Maybelline 媚比琳純淨礦物極效幻膚BB凝露 升級版 SPF 50/PA++++ 01白皙色" class="img-fluid">
                </td>
                <td>Maybelline 媚比琳純淨礦物極效幻膚BB凝露 升級版 SPF 50/PA++++ 01白皙色</td>
                <td>10</td>
                <td>
                    <h4 class="color_e600a0 pt-1">$999</h4>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7">纍計：123456</td>
            </tr>
            <tr>
                <td colspan="7">運費：100</td>
            </tr>
            <tr>
                <td colspan="7" class="color_red">總計：123456</td>
            </tr>
            <tr>
                <td colspan="7">
                    <button type="button" id="btn04" name="btn04" class="btn btn-danger">
                        <i class="fas fa-cart-arrow-down pr-2"></i>
                        確認結賬
                    </button>
                </td>
            </tr>
        </tfoot>
    </table>        
</div>



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
    <?php require_once('jsfile.php'); ?>
</body>

</html>