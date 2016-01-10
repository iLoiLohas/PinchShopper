<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
</head>
<body>
    IDとパスワードを入力してください<br>
    <form action="/customer/login" method="post">
    <table>
    <tr>
    <th align='left'>
        ID
    </th>
    <th>
        <input type="text" name="customerID" value="" placeholder="ID"/><br>
    </th>
    </tr>
    <tr>
    <th>
        パスワード
    </th>
    <th>
        <input type="password" name="password" value="" placeholder="パスワード"/><br>
    </th>
    </tr>
    <tr>
    <th colspan="2" align="right">
    <input type="submit" value="ログイン"/>
    </th>
    </table>
    </form>
</body>
</html>