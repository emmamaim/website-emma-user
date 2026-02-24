<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="./images/logo.png" alt="logo" class="img-fluid rounded-circle" width="80px">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mt-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="#">最新消息</a></li>
                <?php multiList01(); ?>
                <li class="nav-item"><a class="nav-link" href="#">品牌故事</a></li>
                <li class="nav-item"><a class="nav-link" href="#">門市查詢</a></li>
                <li class="nav-item"><a class="nav-link" href="#">合作專區</a></li>
                <li class="nav-item"><a class="nav-link" href="#">客服</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">個人專區</a>
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
                    <?php if($first) { ?>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item">
                                    <em class="fas <?php echo $first['fonticon']; ?> fa-fw"></em>
                                    <?php echo $first['cname']; ?>
                                </a>
                            </li>
                            <?php while ($pyclass02_Rows = $pyclass02->fetch()) { ?>
                                <li>
                                    <a href="store.php?classid=<?php echo $pyclass02_Rows['classid']; ?>" class="dropdown-item">
                                        <em class="fas <?php echo $pyclass02_Rows['fonticon']; ?> fa-fw"></em>
                                        <?php echo $pyclass02_Rows['cname'] ?>
                                    </a>~
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
            <?php } ?>
        </ul>
    </li>
<?php } ?>