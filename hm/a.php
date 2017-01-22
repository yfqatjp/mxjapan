<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Google 地图 JavaScript API 示例: 简单的地图</title>
    <style type="text/css">
        html {
            height: 100%
        }

        body {
            height: 100%;
            margin: 0px;
            padding: 0px
        }

        #map {
            height: 100%
        }
    </style>

    <script type="text/javascript"
            src="https://www.google.com/maps/api/js?key=AIzaSyDTRl1x8xftFpAmxhl76bzStKmA8aNGCYY&sensor=false"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>


    <script type="text/javascript">
        var map = null;
        function initialize() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 17,
            center: new google.maps.LatLng(35.132117, 35.132117),

                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            addSite(map, 35.132117, 136.9055059, '/medias/hotel/medium//', '东京酒店', 'Luxury hotel overlooking the sea', '<img src="images/10_10.png"><img src="images/10_10.png"><img src="images/10_10.png">');
                addSite(map, 35.1680487, 136.8940904, '/medias/hotel/medium//', '速8', '描述', '');

        }


        var contentString = '<div id="content">' +
            '<div id="siteNotice">' +
            '</div>' +
            '<h1 id="firstHeading" class="firstHeading">Uluru</h1>' +
            '<div id="bodyContent">' +
            '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
            'sandstone rock formation in the southern part of the ' +
            'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) ' +
            'south west of the nearest large town, Alice Springs; 450&#160;km ' +
            '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major ' +
            'features of the Uluru - Kata Tjuta National Park. Uluru is ' +
            'sacred to the Pitjantjatjara and Yankunytjatjara, the ' +
            'Aboriginal people of the area. It has many springs, waterholes, ' +
            'rock caves and ancient paintings. Uluru is listed as a World ' +
            'Heritage Site.</p>' +
            '<p>Attribution: Uluru, <a href="http://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">' +
            'http://en.wikipedia.org/w/index.php?title=Uluru</a> ' +
            '(last visited June 22, 2009).</p>' +
            '</div>' +
            '</div>';


        var prev_infowindow = null;
        function addSite(map, lat, lng, img, title, sub, num) {
            var pt = new google.maps.LatLng(lat, lng);
            var marker = new google.maps.Marker({
                map: map,
                position: pt,
                title: title
        });
        var infowindow = new google.maps.InfoWindow({
            content: "<img width='250' src='" + img + "'><br><b style='font-size:15px;margin-top:10px;display:block'>" + title + "</b>" + sub + num
        });

            google.maps.event.addListener(marker, 'click', function () {
                if (prev_infowindow != null) prev_infowindow.close();
                prev_infowindow = infowindow;
                infowindow.open(map, marker);
            });


            var LatLngList = new Array(new google.maps.LatLng(35.132117, 136.9055059), new google.maps.LatLng(35.1680487, 136.8940904));

            var bounds = new google.maps.LatLngBounds();

            for (var i = 0, LtLgLen = LatLngList.length; i < LtLgLen; i++) {

                bounds.extend(LatLngList[i]);
            }

            map.fitBounds(bounds);

        }

        $(document).ready(function () {
            initialize();
        });


    </script>


</head>
<body onload="initialize()">
<div id="map"></div>
</body>
</html>