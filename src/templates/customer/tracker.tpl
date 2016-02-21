{include file='common/default_css.tpl' assign=default_css}
{include file='common/default_js.tpl' assign=default_js}

<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>配達者の現在位置</title>
</head>
<body>
<center>
    <p><h2>配達者の現在位置</h2>
    </p>
    <p>
        <img src="{$deliverer}" border="1">
    </p>
    <p>
        <a href="/customer/receipt">受け取り確認画面へ</a>
    </p>
</center>
</body>
</html>