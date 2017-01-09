// search
//获得Cookie解码后的值
function GetCookieVal(offset) {
    var endstr = document.cookie.indexOf(";", offset);
    if (endstr == -1) endstr = document.cookie.length;
    return unescape(document.cookie.substring(offset, endstr));
}
//设定Cookie值-将值保存在Cookie中
function SetCookie(name, value) {
    var expdate = new Date(); //获取当前日期
    var argv = SetCookie.arguments; //获取cookie的参数
    var argc = SetCookie.arguments.length; //cookie的长度
    var expires = (argc > 2) ? argv[2] : null; //cookie有效期
    var path = (argc > 3) ? argv[3] : null; //cookie路径
    var domain = (argc > 4) ? argv[4] : null; //cookie所在的应用程序域
    var secure = (argc > 5) ? argv[5] : false; //cookie的加密安全设置
    if (expires != null) expdate.setTime(expdate.getTime() + (expires * 1000));
    document.cookie = name + "=" + escape(value) + ((expires == null) ? "": ("; expires=" + expdate.toGMTString())) + ((path == null) ? "": ("; path=" + path)) + ((domain == null) ? "": ("; domain=" + domain)) + ((secure == true) ? "; secure": "");
}
//删除指定的Cookie
function DelCookie(name) {
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = GetCookie(name); //获取当前cookie的值
    document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString(); //将日期设置为过期时间
}
//获得Cookie的值-name用来搜索Cookie的名字
function GetCookie(name) {
    var arg = name + "=";
    var argLen = arg.length; //指定Cookie名的长度
    var cookieLen = document.cookie.length; //获取cookie的长度
    var i = 0;
    while (i < cookieLen) {
        var j = i + argLen;
        if (document.cookie.substring(i, j) == arg) //依次查找对应cookie名的值
        return GetCookieVal(j);
        i = document.cookie.indexOf(" ", i) + 1;
        if (i == 0) break;
    }
    return null;
}

function $$(id) {
    if (document.getElementById) {
        return document.getElementById(id);
    } else if (document.layers) {
        return document.layers[id];
    } else {
        return false;
    }
} (function() {
    function initHead() {
        setTimeout(showSubSearch, 0)
    };
		function showSubSearch() {
        $$("s0").onclick = function() {
            $$("pt2").style.display = "block";
            $$("pt1").className = "select"
        };
		 $$("pt2").onclick = function() {
            $$("pt2").style.display = "none";
            $$("pt1").className = "select select_hover"
        };
        $$("s1").onclick = function() {
            selSubSearch(1);
            $$("q").focus()
        };
        $$("s2").onclick = function() {
            selSubSearch(2);
            $$("q").focus()
        };
        $$("s3").onclick = function() {
            selSubSearch(3);
            $$("q").focus()
        };
        $$("s4").onclick = function() {
            selSubSearch(4);
            $$("q").focus()
        };
        $$("s5").onclick = function() {
            selSubSearch(5);
            $$("q").focus()
        };
        $$("s6").onclick = function() {
            selSubSearch(6);
            $$("q").focus()
        };
        $$("s7").onclick = function() {
            selSubSearch(7);
            $$("q").focus()
        };
        $$("s8").onclick = function() {
            selSubSearch(8);
            $$("q").focus()
        };
        $$("s9").onclick = function() {
            selSubSearch(9);
            $$("q").focus()
        };
        $$("s10").onclick = function() {
            selSubSearch(10);
            $$("q").focus()
        };
        $$("s11").onclick = function() {
            selSubSearch(11);
            $$("q").focus()
        };
        $$("s12").onclick = function() {
            selSubSearch(12);
            $$("q").focus()
        };
		$$("s13").onclick = function() {
            selSubSearch(13);
            $$("q").focus()
        };
        $$("s14").onclick = function() {
            selSubSearch(14);
            $$("q").focus()
        };
        $$("s15").onclick = function() {
            selSubSearch(15);
            $$("q").focus()
        };
        $$("s16").onclick = function() {
            selSubSearch(16);
            $$("q").focus()
        };
        $$("s17").onclick = function() {
            selSubSearch(17);
            $$("q").focus()
        };
        $$("s18").onclick = function() {
            selSubSearch(18);
            $$("q").focus()
        };
        $$("s19").onclick = function() {
            selSubSearch(19);
            $$("q").focus()
        };
        $$("s20").onclick = function() {
            selSubSearch(20);
            $$("q").focus()
        };
        $$("s21").onclick = function() {
            selSubSearch(21);
            $$("q").focus()
        };
        $$("s22").onclick = function() {
            selSubSearch(22);
            $$("q").focus()
        };
    };

    function selSubSearch(iType) {
        hbb = [];
        hbb = {
				1 : ["全部", "5"],
				2 : ["东京", "8"],
				3 : ["大板", "9"],
				4 : ["京都", "9"],
				5 : ["神户", "12"],
				6 : ["札幌", "13"],
				7 : ["名古屋", "7"],
				8 : ["福冈", "10"],
				9 : ["横滨", "10"],
				10 : ["神奈川县", "10"],
				11 : ["奈良", "10"],
				12 : ["那霸", "10"],
				13 : ["名古屋", "10"],
				14 : ["福冈", "10"],
				15 : ["横滨", "10"],
				16 : ["神奈川县", "10"],
				17 : ["奈良", "10"],
				18 : ["那霸", "10"],
				19 : ["横滨", "10"],
				20 : ["神奈川县", "10"],
				21 : ["奈良", "10"],
				22 : ["那霸", "10"]
        };
        $$("s0").innerHTML = hbb[iType][0];
        $$("pt2").style.display = "none";
        SetCookie('sousuosss', iType);
        $$("catid").value = hbb[iType][1];
    };
    initHead();
})();

hbb = [];
hbb = {
				1 : ["全部", "5"],
				2 : ["东京", "8"],
				3 : ["大板", "9"],
				4 : ["京都", "9"],
				5 : ["神户", "5"],
				6 : ["札幌", "13"],
				7 : ["名古屋", "7"],
				8 : ["福冈", "10"],
				9 : ["横滨", "10"],
				10 : ["神奈川县", "10"],
				11 : ["奈良", "10"],
				12 : ["那霸", "10"],
				13 : ["名古屋", "10"],
				14 : ["福冈", "10"],
				15 : ["横滨", "10"],
				16 : ["神奈川县", "10"],
				17 : ["奈良", "10"],
				18 : ["那霸", "10"],
				19 : ["横滨", "10"],
				20 : ["神奈川县", "10"],
				21 : ["奈良", "10"],
				22 : ["那霸", "10"]
};
if (GetCookie('sousuosss')) {
    var sss = GetCookie('sousuosss');
    $$("s0").innerHTML = hbb[sss][0];
    $$("catid").value = hbb[sss][1];
}

function bottomForm(search_form) {
    if (search_form.catid.value == 4) {
        search_form.action = "http://www.17sucai.com/search/s?q=" + encodeURI(search_form.infos.value) + "&modelid=4";
        document.search_form.submit();
        return false;
    } else if (search_form.catid.value == 5) {
        search_form.action = "http://www.17sucai.com/search/s?q=" + encodeURI(search_form.infos.value) + "&modelid=5";
        document.search_form.submit();
        return false;
    } else {
        search_form.action = "http://www.17sucai.com/search/s?q=" + encodeURI(search_form.infos.value) + "&modelid=" + search_form.catid.value;
        document.search_form.submit();
        return false;
    }
}