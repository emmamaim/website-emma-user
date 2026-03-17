<style type="text/css">
    .mycard.mycard-container {
        max-width: 420px;
        width: 100%;
    }

    .mycard {
        background-color: #ffffff;
        padding: 30px 35px 35px;
        margin: 0 auto;
        border-radius: 18px;
        border: 1px solid #e5ded6;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
    }

    .profile-img-card {
        margin: 0 auto 15px auto;
        display: block;
        width: 110px;
    }

    .profile-name-card {
        font-size: 22px;
        text-align: center;
        font-weight: 600;
        color: #4a4642;
        margin-bottom: 20px;
    }

    .form-signin input[type="email"],
    .form-signin input[type="password"] {
        width: 100%;
        height: 46px;
        font-size: 15px;
        margin-bottom: 16px;
        border-radius: 10px;
        border: 1px solid #e5ded6;
        padding-left: 12px;
    }

    .form-signin input:focus {
        border-color: #c9b8a6;
        box-shadow: none;
    }

    .btn.btn-signin {
        font-weight: 600;
        background-color: #a67c52;
        color: white;
        height: 44px;
        border-radius: 12px;
        border: none;
        transition: all 0.25s ease;
    }

    .btn.btn-signin:hover {
        background-color: #8f6a46;
    }

    .other a {
        color: #8f6a46;
        margin: 0 8px;
        font-weight: 500;
    }

    .other a:hover {
        color: #4a4642;
    }
</style>

<!-- 會員登入頁面 -->
<div class="mycard mycard-container">
    <img src="images/logo03.svg" alt="logo" class="profile-img-card" id="profile-img">
    <p id="profile-name" class="profile-name-card">會員登入</p>
    <form action="" method="POST" class="form-signin" id="form1">
        <input type="email" id="inputAccount" name="inputAccount" class="form-control" placeholder="賬號" required autofocus />
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="密碼" required />
        <div class="text-center">
            <button type="submit" class="btn btn-signin mt-4">登入</button>
        </div>
    </form>
    <div class="other mt-5 text-center">
        <a href="register.php">新會員</a>
        <a href="#">忘記密碼</a>
    </div>
</div>