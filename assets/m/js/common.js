


/*侧拉导航*/
$(function () {
    //点击出现
    $('.cl_nav').click(function () {
        $('.bk_gray').fadeIn();
        $('.allnav_left').stop(true, false).animate({ 'right': 0 }, 300);
        return false;
    });
    //点击消失
    $('.theclose').click(function () {
        $('.bk_gray').fadeOut();
        $('.allnav_left').stop(true, false).animate({ 'right': -960 }, 300)
        return false;
    });
    $('.bk_gray').click(function () {
        $('.bk_gray').fadeOut();
        $('.allnav_left').stop(true, false).animate({ 'right': -960 }, 300)
        return false;
    });
    $('html,body').click(function () {
        $('.bk_gray').fadeOut();
        $('.allnav_left').stop(true, false).animate({ 'right': -960 }, 300);
        $('.wx_show').fadeOut();
    });
    //出现时不给滑动
    $('.bk_gray').on('touchmove', function (e) {
        e.stopPropagation();
        e.preventDefault()
    });
    $('.allnav_left').on('touchmove', function (e) {
        e.stopPropagation();
        e.preventDefault()
    });
});

$(function () {
    //点击出现
    $('.cl_search').click(function () {
        $('.bk_gray').fadeIn();
        $('.allsearch').stop(true, false).animate({ 'right': 0 }, 300);
        return false;
    });
    //点击消失
    $('.sea_close').click(function () {
        $('.bk_gray').fadeOut();
        $('.allsearch').stop(true, false).animate({ 'right': -960 }, 300)
        return false;
    });
    //出现时不给滑动
    $('.bk_gray').on('touchmove', function (e) {
        e.stopPropagation();
        e.preventDefault()
    });
    $('.allsearch').on('touchmove', function (e) {
        e.stopPropagation();
        e.preventDefault()
    });
});
/*温馨公告消失*/
$(function () {
    //点击消失
    $('.wx_show-close').click(function () {
        $('.bk_gray').fadeOut();
        $('.wx_show').fadeOut();
    });
});



$(function () {
    //点击出现
    $('.cl_sort').click(function () {
        $('.bk_gray').fadeIn();
        $('.sort_nav').stop(true, false).animate({ 'right': 0 }, 300);
        return false;
    });
    //点击消失
    $('.pro_close').click(function () {
        $('.bk_gray').fadeOut();
        $('.sort_nav').stop(true, false).animate({ 'right': -960 }, 300)
        return false;
    });
    //出现时不给滑动
    $('.bk_gray').on('touchmove', function (e) {
        e.stopPropagation();
        e.preventDefault()
    });
    $('.sort_nav').on('touchmove', function (e) {
        e.stopPropagation();
        e.preventDefault()
    });
});
/*温馨公告消失*/
$(function () {
    //点击消失
    $('.wx_show-close').click(function () {
        $('.bk_gray').fadeOut();
        $('.wx_show').fadeOut();
    });
});



//select 链接跳转
function s_click(obj) {
    var num = 0;
    for (var i = 0; i < obj.options.length; i++) {
        if (obj.options[i].selected == true) {
            num++;
        }
    }
    if (num == 1) {
        var url = obj.options[obj.selectedIndex].value;
        window.open(url,'_self'); //打开连接方式
    }
}



/*侧导航下拉*/
$(document).ready(function () {
    $(".allnav_left dd").hide();
    $(".allnav_left dt i").click(function () {
        $(this).parent().next().slideToggle();
        $(this).parent().prevAll("dd").slideUp("slow");
        $(this).parent().next().nextAll("dd").slideUp("slow");

        if ($(this).hasClass('icon-xiala')) {
            $(this).removeClass('icon-xiala');
            $(this).addClass('icon-you');
        } else {
            $(this).addClass('icon-xiala');
            $(this).removeClass('icon-you');
            $(this).parent().siblings().children(".icon-xiala").addClass('icon-you');
            $(this).parent().siblings().children(".icon-xiala").removeClass('icon-xiala');
        }
        return false;
    });
});



/*返回顶部*/
$(document).ready(function () {
    var $toTop = $("#toTop");
    $toTop.hide();
    $(window).scroll(function () {
        if ($(window).scrollTop() > 100) {
                if($toTop.is(":hidden")) {
                $toTop.stop().fadeIn(600);
            }
        }else {
            if($toTop.is(":visible")) {
                $toTop.stop().fadeOut(600);
            }
        }
     });
    $toTop.click(function () {
        $('body,html').stop().animate({scrollTop: 0}, 900);
        return false;
    });
});


window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];