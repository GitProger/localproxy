<?php
if (isset($_GET["url"]))
    header("Location: http://127.0.0.1:3333?" . $_SERVER['QUERY_STRING']);
else
    header("Location: main.html");
