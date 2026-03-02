$(function () { //使用jquery將img插入到body中
    $("body").append("<img id = 'goTopButton' style= 'display:none; z-index:5; cursor:pointer;' title = '回到頂端'/>");
    var img = "./images/bttop.png",//x宣告變數圖檔名稱
        locate = 0.7, //按鈕出現熒幕的高度
        right = 80,
        opacity = 0.4,
        speed = 1500,  //返回TOP捲動速度
        $button = $("#goTopButton"); //定義JQUERY 呼叫圖片ID
    $button.attr("src", img); //將圖設定到goTopButton的src
    //建議儅網頁捲動時，呼叫自訂函數
    function goTopMove() {//從網頁取得與頂端的距離，75-165px之間
        var scrollH = $(document).scrollTop(),
            winH = $(window).height(),//從瀏覽器取得高度
            css = { "top": winH * locate + "px", "position": "fixed", "right": right};//將參數設定css
        if (scrollH > 20) {//如果捲動與網頁頂端超過20px時，則顯示圖片
            $button.css(css);
            $button.fadeIn("slow",()=>{$button.css({"opacity": opacity})});
        } else {
            css = { "transform": "none"};
            $button.css(css);
            $button.fadeOut("slow");
        }
    };
    //設定瀏覽器監聽兩個動作：scroll/resize
    $(window).on({
        scroll: function () { goTopMove(); },
        resize: function () { goTopMove(); }
    });
    //設定瀏覽器監聽圖片三個動作：滑鼠滑過去/滑鼠滑出去/按下滑鼠
    $button.on({
        mouseover: function () { $button.css("opacity", 1); },
        mouseout: function () { $button.css("opacity", opacity); },
        click: function () {
            css = {
                "transform": "scale(1.5, 0.5)", "transition": "transform 1s ease 0s"
            }; $button.css(css);
            $("html, body").animate({ scrollTop: 0 }, speed);
        }
    });
});