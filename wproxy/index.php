<?php
$host = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"];
$proxy = "https://www.google.com/search?q=cache:";
$url = "";
$purl = "";

function javascript() {
    global $host, $url;
    preg_match("/(https?:\/\/|^)(\w+\.\w+)($|\/)/", $url, $m);
    $base = $m[2];
?>
<script type="text/javascript">
//    window.onload = function () {
        for (var e of document.body.getElementsByTagName("a")) {
            var href = e.getAttribute("href");
            if (href.match(/^https?:\/\//) === null) {
                var t = "<?=$host?>/?view=1&url=<?=$base?>" + (href[0] == '/' ? href : "/" + href);
                e.setAttribute("href", t);
            }
        }
//    };
</script>
<?php
}

if (isset($_GET["url"])) {
    $url = $_GET['url'];
    $purl = $proxy . urldecode($url);
    if ($_COOKIE["htmlview"] == "true") $purl .= "&strip=1";

    if (isset($_GET["view"])) {
        $html = file_get_contents($purl);
        echo $html;
        javascript();
        die;
    }
}
?>
<html lang="en">
    <head>
        <title> Blocked </title>
        <style>
            body {
                font-family: arial;
                background: #eee;
            }
            p { 
                width: 90%; 
            }
            l {
                color: #056600;
                font-family: monospace;
                background: #ccc;
                padding: 2px;
                border-radius: 2px;
            }
        </style>
    </head>
    <body>
        <h1> <center> The resource is blocked. </center> </h1>
<?php if (!empty($url)) { 
          $ch = ""; 
          if ($_COOKIE["htmlview"] == "true") $ch = " checked"; 
?>
        <em> Resource &quot;<?=$url?>&quot; is banned. </em>
        <hr>

        [<a href="<?=$purl?>">open</a>]
        [<a href="?view=1&amp;url=<?=$url?>">view here</a><sup><a href="#star">*</a></sup>]     
        <br>

        <input type="checkbox" onclick="document.cookie='htmlview='+String(this.checked); location.reload();" id="htmlview"<?=$ch?>>
        <label for="htmlview">Text version (loads faster)</label>

        <p id="star">
            <b>*</b> If you have connected to this webpage via HTTP some options could not work on the banned site 
                if it has an SSL-certificate. But some links like <l>/article/1</l> will be converted to <l>https://127.0.0.1:3333/?view=1&amp;url=https://banned.com/article/1</l>, 
                so you will not leave the proxy if you click on a link on the website.
        </p>
<?php } ?>
    </body>
</html>
