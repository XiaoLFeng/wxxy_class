<nav class="navbar navbar-expand-lg navbar-light ticky-top" style="background-color:#e3f2fd;">
  <div class="container py-1">
    <a class="navbar-brand" href="https://ourwxxy.x-lf.com/"><i class="bi bi-caret-right-fill"></i> 软件工程 - 二班 <i class="bi bi-caret-left-fill"></i></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/index.php"><i class="bi bi-house"></i> 主页</a>
        </li>
        <?PHP
        if (empty($_COOKIE['studentID'])) {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="/auth.php"><i class="bi bi-key"></i> 登录</a>
        </li>
        <?PHP
        } else {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="/plugins/loginout.php"><i class="bi bi-key"></i> 登出</a>
        </li>
        <?PHP
        }
        ?>
      </ul>
    </div>
  </div>
</nav>