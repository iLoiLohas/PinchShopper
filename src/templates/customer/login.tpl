{include file='common/default_css.tpl' assign=default_css}
{include file='common/default_js.tpl' assign=default_js}

<!DOCTYPE HTML>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ログイン</title>
{$default_css}
</head>
<body>
	IDとパスワードを入力してください<br>
	<form id="loginForm" action="/customer/login" method="post">
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
					<a id="loginBtn" class="btn btn-large btn-primary" href="javascript:void(0);">ログイン</a>
				</th>
			</tr>
		</table>
	</form>
{$default_js}
</body>
</html>