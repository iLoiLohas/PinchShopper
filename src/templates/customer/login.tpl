{include file='common/default_css.tpl' assign=default_css}
{include file='common/default_js.tpl' assign=default_js}

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
					Eメール
				</th>
				<th>
					<input type="text" name="email" value="{$indata.email|escape}" placeholder="ID"/><br>
				</th>
			</tr>
			<tr>
				<th>
					パスワード
				</th>
				<th>
					<input type="password" name="password" value="{$indata.password|escape}" placeholder="パスワード"/><br>
				</th>
			</tr>
			<tr>
				<th colspan="2" align="right">
					<input type="submit" value="ログイン"/>
				</th>
			</tr>
		</table>
	</form>
</body>
</html>