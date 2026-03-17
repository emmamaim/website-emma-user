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
    <style type="text/css">
        table input:invalid {
            border: solid red 3px;
        }
    </style>
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
                    <!-- 引入購物車内容 -->
                    <?php require_once("cart_content.php"); ?>
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

    <script type="text/javascript">
        $("input").change(function() {
            var qty = $(this).val();
            const cartid = $(this).attr("cartid");
            if (qty <= 0 || qty >= 50) {
                alert("更改數量需大於0以上，以及小於50以下");
                return false;
            }
            $.ajax({
                url: 'change_qty.php',
                type: 'post',
                dateType: 'json',
                data: {
                    cartid: cartid,
                    qty: qty,
                },
                success: function(data) {
                    if (data.c == true) {
                        window.location.reload();
                    } else {
                        alert("data.m");
                    }
                },
                error: function(data) {
                    alert("系統目前無法連接到後台資料庫");
                }
            });
        });
    </script>
</body>

</html>