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
<div class="accordion sticky-top" id="acd">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#c-One" aria-expanded="true" aria-controls="collapseOne"><i class="bi bi-clipboard"></i>&nbsp;面板</button>
        </h2>
        <div id="c-One" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#acd">
            <div class="accordion-body">
                <div class="row px-4">
                    <div class="col-12 mb-1"><a href="/index.php" class="text-decoration-none <?PHP menu_color(1) ?>"><i class="bi bi-house-door"></i> 主页</a></div>
                    <div class="col-12 mb-1"><a href="/nucleic_acid.php" class="text-decoration-none <?PHP menu_color(3) ?>"><i class="bi bi-bandaid"></i> 核酸信息提交</a></div>
                    <div class="col-12 mb-1"><a href="/pan.php" class="text-decoration-none <?PHP menu_color(4) ?>"><i class="bi bi-device-hdd"></i> 班级网盘</a></div>
                    <div class="col-12 mb-1"><a href="/non-member-fty.php" class="text-decoration-none <?PHP menu_color(5) ?>"><i class="bi bi-chat"></i> 青年大学习（全员）</a></div>
                    <!-- <div class="col-12 mb-1"><a href="/member-ty.php" class="text-decoration-none <?PHP menu_color(6) ?>"><i class="bi bi-chat-dots"></i> 青年大学习（团员）</a></div> -->
                    <div class="col-12 mb-1"><a href="/get_book.php" class="text-decoration-none <?PHP menu_color(7) ?>"><i class="bi bi-journal-bookmark"></i> 书本领取登记</a></div>
                    <div class="col-12 mb-1"><a href="/signin/" class="text-decoration-none <?PHP menu_color(8) ?>"><i class="bi bi-box-arrow-in-right"></i> 事务签到表</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c-Four" aria-expanded="false" aria-controls="collapseFour"><i class="bi bi-share"></i>&nbsp;外链</button>
        </h2>
        <div id="c-Four" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#acd">
            <div class="accordion-body">
                <div class="row px-4">
                    <div class="col-12 mb-1"><a href="http://jwgl.cwxu.edu.cn/jwglxt/xtgl/login_slogin.html" target="_blank" class="text-decoration-none text-black"><i class="bi bi-box-arrow-right"></i> 无锡教务（课表）</a></div>
                    <div class="col-12"><a href="http://jwc.cwxu.edu.cn/index.jsp" target="_blank" class="text-decoration-none text-black"><i class="bi bi-box-arrow-right"></i> 无锡学院教务处</a></div>
                    <div class="col-12"><a href="http://10.1.99.100/" target="_blank" class="text-decoration-none text-black"><i class="bi bi-box-arrow-right"></i> 校园网登录</a></div>
                    <div class="col-12"><a href="http://10.1.80.200:8080/Self/login/?302=LI" target="_blank" class="text-decoration-none text-black"><i class="bi bi-box-arrow-right"></i> 校园网管理</a></div>
                </div>
            </div>
        </div>
    </div>
</div>