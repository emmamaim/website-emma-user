<?php
(!isset($_SESSION)) ? session_start() : "";
?>
<?php
require_once('Connections/conn_db.php');
?>
<?php require_once("php_lib.php"); ?>
<!-- 注冊 -->
<?php
if (isset($_POST['formctl']) && $_POST['formctl'] == 'reg') {
    $email = $_POST['email'];
    $pw1 = md5($_POST['pw1']);
    $cname = $_POST['cname'];
    $tssn = $_POST['tssn'];
    $birthday = $_POST['birthday'];
    $mobile = $_POST['mobile'];
    $myzip = $_POST['myZip'] == "" ? NULL : $_POST['myzip'];
    $address = $_POST['address'] == "" ? NULL : $_POST['address'];
    $imgname = $_POST['uploadname'] == "" ? 'avatar.svg' : $_POST['uploadname'];

    $insertsql = "INSERT INTO member (email,pw1,cname,tssn,birthday,imgname) VALUES ('" . $email . "','" . $pw1 . "','" . $cname . "','" . $tssn . "','" . $birthday . "','" . $imgname . "')";
    $Result = $link->query($insertsql);

    if ($Result) {
        $emailid = $link->lastInsertId();
        $insertsql = "INSERT INTO addbook (emailid,setdefault,cname,mobile,myZip,address) VALUES ('" . $emailid . "','1','" . $cname . "','" . $mobile . "','" . $myzip . "','" . $address . "')";
        $Result = $link->query($insertsql);

        $_SESSION['login'] = true;
        $_SESSION['emailid'] = $emailid;
        $_SESSION['email'] = $email;
        $_SESSION['cname'] = $cname;
        $_SESSION['imgname'] = $imgname;

        echo "<script language='javascript'>alert('謝謝您，會員資料已完成註冊');location.href='index.php';</script>";
    } else {
        echo "<script language='javascript'>alert('註冊失敗，請重新註冊，並連絡管理員。');location.href='register.php';</script>";
    }
}
?>

<!doctype html>
<html lang="zh-TW">

<head>
    <!-- 導入head鏈接 -->
    <?php require_once('headfile.php'); ?>
    <style type="text/css">
        .input-group>.form-control {
            width: 100%;
        }

        span.error-tips,
        span.error-tips::before {
            font-family: "Font Awesome 5 Free";
            color: red;
            font-weight: 900;
            content: "\f0c4";
        }

        span.valid-tips,
        span.valid-tips::before {
            font-family: "Font Awesome 5 Free";
            color: greenyellow;
            font-weight: 900;
            content: "\f00c";
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
                <div class="col-md-10">
                    <!-- 會員註冊頁面 -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1>會員註冊頁面</h1>
                            <p>請輸入相關資料，*為必須輸入欄位</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8 offset-2 text-left">
                            <form id="reg" name="reg" action="register.php" method="POST">
                                <div class="input-group mb-3">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="*請輸入email賬號" autocomplete="off">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" name="pw1" id="pw1" class="form-control" placeholder="*請輸入密碼">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" name="pw2" id="pw2" class="form-control" placeholder="*請再次確認密碼">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" name="cname" id="cname" class="form-control" placeholder="*請輸入姓名">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" name="tssn" id="tssn" class="form-control" placeholder="請輸入身份證字號">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" name="birthday" id="birthday" onfocus="(this.type='date')" class="form-control" placeholder="*請選擇生日">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="請輸入手機號碼">
                                </div>
                                <div class="input-group mb-3">
                                    <select type="text" name="myCity" id="myCity" class="form-control">
                                        <option value="">請選擇市區</option>
                                        <?php $city = "SELECT * FROM city WHERE State=0";
                                        $city_rs = $link->query($city);
                                        while ($city_rows = $city_rs->fetch()) { ?>
                                            <option value="<?php echo $city_rows["AutoNo"]; ?>"><?php echo $city_rows["Name"]; ?></option>
                                        <?php } ?>
                                    </select>
                                    <br>
                                    <select type="text" name="myTown" id="myTown" class="form-control">
                                        <option value="">請選擇地區</option>
                                    </select>
                                </div>
                                <label for="address" class="form-label" id="zipcode" name="zipcode">郵遞區號：地址</label>
                                <div class="input-group mb-3">
                                    <input type="hidden" name="myZip" id="myZip" value="">
                                    <input type="text" name="address" id="address" class="form-control" placeholder="*請輸入後續地址">
                                </div>
                                <label for="fileToUpload" class="form-label">上傳相片：</label>
                                <div class="input-group mb-3">
                                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" title="請上傳相片圖示" accept="image/x-png,image/jpeg,image/gif,image/jpg">
                                    <p>
                                        <button type="button" class="btn btn-danger" name="uploadForm" id="uploadForm">開始上傳</button>
                                    </p>
                                    <div class="progress" id="progress-div01" style="width: 100%;display:none;">
                                        <div id="progress-bar01" class="progresas-bar progress-bar-striped" role="progressbar" style="width: 0%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                            0%
                                        </div>
                                    </div>
                                    <input type="hidden" name="uploadname" id="uploadname" value="">
                                    <img src="" alt="photo" id="showing" name="showing" style="display: none;" class="img-fluid">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="hidden" name="captcha" id="captcha" value="">
                                    <a href="javascript:void(0);" title="按我更新認證" onclick="getCaptcha();">
                                        <canvas id="can"></canvas>
                                    </a>
                                    <input type="text" name="recaptcha" id="recaptcha" class="form-control" placeholder="請輸入認證碼">
                                </div>
                                <input type="hidden" name="formctl" id="formctl" value="reg">
                                <div class="input-group mb-3">
                                    <button type="submit" class="btn btn-success btn-lg">送出</button>
                                </div>
                            </form>
                        </div>
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
    <script type="text/javascript" src="js/commlib.js
    "></script>
    <script type="text/javascript" src="jquery.validate.js"></script>
    <script type="text/javascript">
        // 自訂驗證功能：身份證/手機/郵遞區號
        jQuery.validator.addMethod("tssn", function(value, element, param) {
            var tssn = /^[a-zA-Z]{1}[1-2]{1}[0-9]{8}$/;
            return this.optional(element) || (tssn.test(value));
        });
        jQuery.validator.addMethod("checkphone", function(value, element, param) {
            var checkphone = /^[0]{1}[9]{1}[0-9]{8}$/;
            return this.optional(element) || (checkphone.test(value));
        });
        jQuery.validator.addMethod("checkMyTown", function(value, element, param) {
            return (value !== "");
        });
        // 表單驗證
        $("#reg").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    // 後端即時驗證
                    remote: 'checkemail.php'
                },
                pw1: {
                    required: true,
                    maxlength: 20,
                    minlength: 4,
                },
                pw2: {
                    required: true,
                    equalTo: '#pw1',
                },
                cname: {
                    required: true,
                },
                tssn: {
                    required: true,
                    tssn: true,
                },
                birthday: {
                    required: true,
                },
                mobile: {
                    required: true,
                    checkphone: true,
                },
                address: {
                    required: true,
                },
                myTown: {
                    checkMyTown: true,
                },
                recaptcha: {
                    required: true,
                    equalTo: '#captcha',
                },
            },
            messages: {
                email: {
                    required: 'email信箱不得為空白',
                    email: 'email信箱格式有誤',
                    remote: 'email信箱已經註冊'
                },
                pw1: {
                    required: '密碼不得為空白',
                    maxlength: '密碼最大長度為20位(4-20位英文字母與數字的組合)',
                    minlength: '密碼最小長度為4位(4-20位英文字母與數字的組合)',
                },
                pw2: {
                    required: '確認密碼不得為空白',
                    equalTo: '兩次輸入的密碼必須一致！',
                },
                cname: {
                    required: '使用者名稱不得為空白',
                },
                tssn: {
                    required: '身份證ID不得為空白',
                    tssn: '身份證ID格式有誤',
                },
                birthday: {
                    required: '生日不得為空白',
                },
                mobile: {
                    required: '手機號碼不得為空白',
                    checkphone: '手機號碼格式有誤',
                },
                address: {
                    required: '地址不得為空白',
                },
                myTown: {
                    checkMyTown: '需選擇郵遞區號',
                },
                recaptcha: {
                    required: '驗證碼不得為空白！',
                    equalTo: '驗證碼不正確',
                }
            },
        });
        // 取得元素ID
        function getId(el) {
            return document.getElementById(el);
        }
        // 圖示上傳處理
        $("#uploadForm").click(function(e) {
            var fileName = $('#fileToUpload').val();
            var idxDot = fileName.lastIndexOf(".") + 1;
            let extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png" || extFile == "gif") {
                $("#progress-div01").css("display", "flex");
                let file1 = getId("fileToUpload").files[0];
                let formdata = new FormData();
                formdata.append("file1", file1);
                let ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandler, false);
                ajax.addEventListener("load", completeHandler, false);
                ajax.addEventListener("error", errorHandler, false);
                ajax.addEventListener("abort", abortHandler, false);
                ajax.open("POST", "file_upload_parser.php");
                ajax.send(formdata);
                return false;
            } else {
                alert("目前只支援jpg,jpeg,png,gif檔案格式上傳！");
            }
        });
        // 上傳進度條
        function progressHandler(event) {
            let percent = Math.round((event.loaded / event.total) * 100);
            $("#progress-bar01").css("width", percent + "%");
            $("#progress-bar01").html(percent + "%");
        }
        // 上傳完成處理顯示圖片
        function completeHandler(event) {
            let data = JSON.parse(event.target.responseText);
            if (data.success == 'true') {
                $("#uploadname").val(data.fileName);
                $("#showing").attr({
                    'src': 'uploads/' + data.fileName,
                    'style': 'display:block;'
                });
                $('button.btn.btn-danger').attr({
                    'style': 'display:none;'
                })
            } else {
                alert("data.error");
            }
        }
        // 上傳發生錯誤處理
        function errorHandler(event) {
            alert("Upload Failed:上傳發生錯誤");
        }
        // 上傳作業取消處理
        function abortHandler(event) {
            alert("Upload Aborted:上傳作業取消");
        }

        function getCaptcha() {
            var inputTxt = document.getElementById("captcha");
            inputTxt.value = captchaCode("can", 150, 50, "blue", "white", "28px", 5);
        }
        $(function() {
            // 啟動驗證碼功能
            getCaptcha();
            // 選縣市後查詢鄕鎮市
            $("#myCity").change(function() {
                var CNo = $('#myCity').val();
                if (CNo == "") {
                    return false;
                }
                $.ajax({
                    url: 'Town_ajax.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        CNo: CNo,
                    },
                    success: function(data) {
                        if (data.c == true) {
                            $('#myTown').html(data.m);
                            $('#myZip').val("");
                        } else {
                            alert(data.m);
                        }
                    },
                    error: function(data) {
                        alert("系統目前無法連接到資料庫");
                    }
                })
            });
            // 選鄕鎮市查詢郵遞區號放入zipcode
            $("#myTown").change(function() {
                var AutoNo = $('#myTown').val();
                if (AutoNo == "") {
                    return false;
                }
                $.ajax({
                    url: 'Zip_ajax.php',
                    type: 'get',
                    dataType: 'json',
                    data: {
                        AutoNo: AutoNo,
                    },
                    success: function(data) {
                        if (data.c == true) {
                            $('#myZip').val(data.Post);
                            $('#zipcode').html(data.Post + data.Cityname + data.Name);
                        } else {
                            alert(data.m);
                        }
                    },
                    error: function(data) {
                        alert("系統目前無法連接到資料庫");
                    }
                })
            });
        });
    </script>
</body>

</html>