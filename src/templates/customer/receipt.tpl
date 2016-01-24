{include file='common/default_css.tpl' assign=default_css}
{include file='common/default_js.tpl' assign=default_js}

<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>受け取り確認</title>
{$default_css}
</head>
<body>
	<center>
		<h2>注文番号とパスワードを入力してください</h2>
		<form class="form-horizontal" action="/customer/evaluate" method="post">
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">注文番号</label>
				<div class="col-sm-10">
					<input type="text" name="requestID" value="{$indata.requestID|escape}" placeholder="注文番号"/><br>
				</div>
			</div>
<br>
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">パスワード</label>
				<div class="col-sm-10">
					<input type="password" name="password" value="{$indata.password|escape}" placeholder="パスワード"/><br>
				</div>
			</div>
<br>
			<div class="form-group">
				<div class="col-sm-offset-2 col-md-10">
					<button type="submit" class="btn btn-default">決済・評価画面へ</button>
				</div>
			</div>
		</form>
	</center>
{$default_js}
</body>
</html>