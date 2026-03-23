<?php
// 跨網頁的變數儲存
(!isset($_SESSION)) ? session_start() : "";
?>

<?php
// require 遇到錯誤會停止 inclue則會繼續執行
// require_oner 只載入一次（資料庫）
require_once('Connections/conn_db.php');
?>
<!-- 載入共用php函數庫 -->
<?php require_once("php_lib.php"); ?>


<!doctype html>
<html lang="zh-TW">

<head>
    <!-- 引入網頁head -->
    <?php require_once("headfile.php"); ?>
    <style type="text/css">
        table input:invalid {
            border: solid red 3px;
        }
    </style>
</head>

<body>
    <section id="header">
        <!-- 引入nav導航 -->
        <?php require_once("header.php"); ?>
    </section>
    <section id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <!-- 引入側邊導航 -->
                    <?php require_once("sidebar.php"); ?>
                </div>
                <div class="col-md-10">
                    <!-- 引入購物車内容 -->
                    <?php require_once("cart_content.php"); ?>

                </div>
            </div>
        </div>
    </section>
    <hr>
    <section id="scontent">
        <!-- 引入scontent -->
        <?php require_once("scontent.php"); ?>
    </section>
    <section id="footer">
        <!-- 引入footer -->
        <?php require_once("footer.php"); ?>
    </section>

    <!-- 引入jsfile -->
    <?php require_once("jsfile.php"); ?>

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