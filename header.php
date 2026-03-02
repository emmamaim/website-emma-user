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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo $currentPage == 'member.php' ? 'active' : ''; ?>" href="member.php" data-bs-toggle="dropdown">個人專區
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">登入 / 註冊</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">會員資料</a></li>
                        <li><a class="dropdown-item" href="#">我的訂單</a></li>
                        <li><a class="dropdown-item" href="#">管理地址</a></li>
                        <li><a class="dropdown-item" href="#">我的收藏</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
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