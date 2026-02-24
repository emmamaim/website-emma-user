$(document).ready(function() {
  Fancybox.bind("[data-fancybox]", {
    Carousel: {
      infinite: true, // 燈箱內是否循環播放
    },
    Images: {
      Panzoom: {
        maxScale: 2, // 最大放大倍率
      },
    },

    l10n: {
      CLOSE: "關閉",
      NEXT: "下一張",
      PREV: "上一張",
      MODAL: "按 ESC 鍵可關閉",
      ERROR: "載入失敗，請稍後再試",
      IMAGE_NOT_FOUND: "找不到圖片",
    }
  });
});
