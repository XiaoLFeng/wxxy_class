<?PHP
function menu_color($menu_num) {
    global $menu_page;
    if ($menu_page == $menu_num) {
        echo 'text-primary';
    } else {
        echo 'text-black';
    }
}
?>
<div class="sticky-top py-3">
    <div class="card shadow rounded-3">
        <div class="card-body">
            <div class="row">
                <div class="col-12 my-2 px-4">
                    <a href="/admin/" class="text-decoration-none d-flex <?PHP menu_color(1) ?>"><i class="bi bi-house-door"></i>&nbsp;管理首页</a>
                </div>
                <div class="col-12 my-2 px-4">
                    <a href="/admin/" class="text-decoration-none d-flex <?PHP menu_color(2) ?>"><i class="bi bi-person"></i>&nbsp;用户管理</a>
                </div>
                <div class="col-12 my-2 px-4">
                    <a href="/admin/class_book.php" class="text-decoration-none d-flex <?PHP menu_color(3) ?>"><i class="bi bi-book"></i>&nbsp;作业管理</a>
                </div>
            </div>
        </div>
    </div>
</div>