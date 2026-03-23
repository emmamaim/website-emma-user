<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="./images/logo.png" alt="logo" class="img-fluid rounded-circle" width="80px">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php
        // 讀取後臺購物車内產品數量
        $SQLstring = "SELECT * FROM cart WHERE orderid is NULL AND ip='" . $_SERVER['REMOTE_ADDR'] . "'";
        $cart_rs = $link->query($SQLstring);
        ?>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mt-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="#">最新消息</a></li>
                <?php multiList01(); ?>
                <li class="nav-item"><a class="nav-link" href="#">品牌故事</a></li>
                <li class="nav-item"><a class="nav-link" href="#">門市查詢</a></li>
                <li class="nav-item"><a class="nav-link" href="#">合作專區</a></li>
                <li class="nav-item"><a class="nav-link" href="#">客服</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">會員注冊</a>
                </li>
                <?php
                if (isset($_SESSION['login'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" onclick="btn_confirmLink('是否確定登出？','logout.php')">會員登出</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">會員登入</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">
                        購物車
                        <span class="badge text-bg-info">
                            <?php echo ($cart_rs) ? $cart_rs->rowCount() : ''; ?>
                        </span>
                    </a>
                </li>
            </ul>
            <?php if (isset($_SESSION['login'])) { ?>
                <ul class="navbar-nav ms-auto me-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="uploads/<?php echo ($_SESSION['imgname'] != '') ? $_SESSION['imgname'] : 'avatar.svg'; ?>" width="40" height="40" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-dark">
                            <a class="dropdown-item" href="orderlist.php">Order List</a>
                            <a class="dropdown-item" href="profile.php">Edit Profile</a>
                            <a class="dropdown-item" href="#" onclick="btn_confirmLink('請確定是否要登出', 'logout.php');">Log Out</a>
                        </div>
                    </li>
                </ul>
            <?php } ?>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-warning" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<?php
function multiList01()
{
    global $link;
    $SQLstring = "SELECT * FROM pyclass WHERE level=1 ORDER BY sort";
    $pyclass01 = $link->query($SQLstring);
?>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">產品</a>
        <ul class="dropdown-menu">
            <?php while ($pyclass01_Rows = $pyclass01->fetch()) { ?>
                <li class="nav-item dropend">
                    <a class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas <?php echo $pyclass01_Rows['fonticon']; ?> "></i>
                        <?php echo $pyclass01_Rows['cname']; ?>
                    </a>
                    <?php
                    $SQLstring = sprintf("SELECT * FROM pyclass WHERE level=2 AND uplink=%d ORDER BY sort", $pyclass01_Rows['classid']);
                    $pyclass02 = $link->query($SQLstring);
                    // 用來判斷是否有子分類
                    $first = $pyclass02->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <?php if ($first) { ?>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item">
                                    <em class="fas <?php echo $first['fonticon']; ?> fa-fw"></em>
                                    <?php echo $first['cname']; ?>
                                </a>
                            </li>
                            <?php while ($pyclass02_Rows = $pyclass02->fetch()) { ?>
                                <li>
                                    <a href="#" class="dropdown-item">
                                        <em class="fas <?php echo $pyclass02_Rows['fonticon']; ?> fa-fw"></em>
                                        <?php echo $pyclass02_Rows['cname'] ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
            <?php } ?>
        </ul>
    </li>
<?php } ?>