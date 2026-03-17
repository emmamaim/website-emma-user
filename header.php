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

        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo $currentPage == 'news.php' ? 'active' : ''; ?>"
                        href="news.php">最新消息</a>
                </li>
                <?php multiList01(); ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo $currentPage == 'brand.php' ? 'active' : ''; ?>"
                        href="brand.php">品牌故事</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $currentPage == 'store-location.php' ? 'active' : ''; ?>"
                        href="store-location.php">門市查詢</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $currentPage == 'cooperation.php' ? 'active' : ''; ?>"
                        href="cooperation.php">合作專區</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $currentPage == 'service.php' ? 'active' : ''; ?>"
                        href="service.php">客服</a>
                </li>
                <?php
                if (isset($_SESSION['login'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" onclick="btn_confirmLink('是否確定登出？','logout.php')">登出</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">登入</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">註冊</a>
                </li>
                <?php if (isset($_SESSION['login'])) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="uploads/<?php echo ($_SESSION['imgname'] != '') ? $_SESSION['imgname'] : 'avatar.svg'; ?>" width="40" height="40" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-dark">
                            <a class="dropdown-item" href="orderlist.php">我的訂單</a>
                            <a class="dropdown-item" href="profile.php">編輯資料</a>
                            <a class="dropdown-item" href="#" onclick="btn_confirmLink('請確定是否要登出', 'logout.php');">登出</a>
                        </div>
                    </li>
                <?php } ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">
                        購物車
                        <span class="badge text-bg-info">
                            <?php echo ($cart_rs) ? $cart_rs->rowCount() : ''; ?>
                        </span>
                    </a>
                </li>
            </ul>
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
                <li class="nav-item dropend dropdown">
                    <!-- 左邊：跳轉 -->
                    <a class="dropdown-item flex-grow-1"
                        href="store.php?classid=<?php echo $pyclass01_Rows['classid']; ?>&level=1">
                        <i class="fas <?php echo $pyclass01_Rows['fonticon']; ?> me-2"></i>
                        <?php echo $pyclass01_Rows['cname']; ?>
                    </a>

                    <!-- 右邊：展開（自訂icon，不用dropdown-toggle就不會出現預設箭頭） -->
                    <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="展開子分類">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <?php
                    $SQLstring = sprintf(
                        "SELECT * FROM pyclass WHERE level=2 AND uplink=%d ORDER BY sort",
                        $pyclass01_Rows['classid']
                    );
                    $pyclass02 = $link->query($SQLstring);
                    $first = $pyclass02->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <?php if ($first) { ?>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="store.php?classid=<?php echo $first['classid']; ?>" class="dropdown-item">
                                    <em class="fas <?php echo $first['fonticon']; ?> fa-fw"></em>
                                    <?php echo $first['cname']; ?>
                                </a>
                            </li>
                            <?php while ($pyclass02_Rows = $pyclass02->fetch()) { ?>
                                <li>
                                    <a href="store.php?classid=<?php echo $pyclass02_Rows['classid']; ?>" class="dropdown-item">
                                        <em class="fas <?php echo $pyclass02_Rows['fonticon']; ?> fa-fw"></em>
                                        <?php echo $pyclass02_Rows['cname']; ?>
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