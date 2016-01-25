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
	<form id="loginForm" action="/" class="form-horizontal" method="post">
		<div class="form-group mt10">
			<label for="inputEmail3" class="col-sm-1 control-label">Eメール</label>
			<div class="col-sm-10">
				<input type="text" name="email" value="{$indata.email|escape}" placeholder="ID"/>
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-1 control-label">パスワード</label>
			<div class="col-sm-10 mb10">
				<input type="password" name="password" value="{$indata.password|escape}" placeholder="パスワード"/><br>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-md-10">
				<a id="loginBtn" class="btn btn-default ml10" href="javascript:void(0);">ログイン</a>
			</div>
		</div>
	</form>
{$default_js}
</body>
</html>