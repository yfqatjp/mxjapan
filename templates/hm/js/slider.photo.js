$(function() {
    function i(e) {
		$("#originalpic img").hide(),
        $("#originalpic img").eq(e).stop(!0, !0).fadeIn(800),
        $(".thumbpic li").eq(e).addClass("hover").siblings().removeClass("hover"),
        $("#aPrev,#aNext").css("height", $("#originalpic img").eq(e).height() + "px")
    }
    function s() {
        e >= 0 && e < n - 1 ? (++e, i(e)) : '';
        if (r < 0 || r > n - t) return ! 1;
        $("#piclist ul").animate({
            left: "-=130px"
        },
        200),
        r++
    }
    function o() {
        !1;
        e >= 1 && (--e, i(e));
        if (r < 2 || r > n + t) return ! 1;
        $("#piclist ul").animate({
            left: "+=130px"
        },
        200),
        r--
    }
    var e = 0,
    t = 4,
    n = $("#originalpic img").length,
    r = 1;
    $("#originalpic img").eq(0).show(),
    $("#aPrev,#aNext").css("height", $("#originalpic img").eq(0).height() + "px"),
    $(".thumbpic li").eq(0).addClass("hover"),
    $(".bntnext,#aNext").click(function() {
        s()
    }),
    $(".bntprev,#aPrev").click(function() {
        o()
    }),
    $(".thumbpic li").click(function() {
        e = $(".thumbpic li").index(this),
        i(e)
    })
})