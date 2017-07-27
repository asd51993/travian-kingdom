<!doctype html>
<html>
    <head>
        <title></title>
        <meta http-equiv="CACHE-CONTROL" content="PUBLIC"/>
        <meta http-equiv="EXPIRES" content="Sat, 01 Jan 2050 00:00:00 GMT"/>
    </head>
    <body>
        <script type="text/javascript">

            function sendMessage(message, url) {
                window.setTimeout(function () {
                    window.name = message;
                    location.href = url + "," + encodeURIComponent(location.protocol + "//" + location.host + location.pathname);
                }, 0);
            }

            if (location.hash) {
                if (location.hash.substring(1, 2) === "_") {
                    var channel, url, hash = location.href.substring(location.href.indexOf("#") + 3), indexOf = hash.indexOf(",");
                    if (indexOf == -1) {
                        channel = hash;
                    } else {
                        channel = hash.substring(0, indexOf);
                        url = decodeURIComponent(hash.substring(indexOf + 1));
                        if (url && !/^https?:\/\//.test(url)) {
                            throw new Error('Invalid url');
                        }
                    }
                    switch (location.hash.substring(2, 3)) {
                        case "2":
                            // NameTransport local
                            window.parent.parent.easyXDM.Fn.get(channel)(window.name);
                            location.href = url + "#_4" + channel + ",";
                            break;
                        case "3":
                            // NameTransport remote
                            var guest = window.parent.frames["easyXDM_" + channel + "_provider"];
                            if (!guest) {
                                throw new Error("unable to reference window");
                            }
                            guest.easyXDM.Fn.get(channel)(window.name);
                            location.href = url + "#_4" + channel + ",";
                            break;
                        case "4":
                            // NameTransport idle
                            var fn = window.parent.easyXDM.Fn.get(channel + "_load");
                            if (fn) {
                                fn();
                            }
                            break;
                    }
                }
            }
        </script>
    </body>
</html>
