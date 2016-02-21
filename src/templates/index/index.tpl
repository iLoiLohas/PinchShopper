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
<center>
	<form id="loginForm" action="/" class="form-horizontal" method="post">
		<div class="form-group mt10">
			<label for="inputEmail3" class="col-sm-3 control-label">Eメール</label>
			<div class="col-sm-3">
				<input type="text" name="email" value="{$indata.email|escape}" placeholder="Eメール"/>
			</div>
		</div>
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-3 control-label">パスワード</label>
			<div class="col-sm-3 mb10">
				<input type="password" name="password" value="{$indata.password|escape}" placeholder="パスワード"/><br>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<a id="loginBtn" class="btn btn-default ml10" href="javascript:void(0);">ログイン</a>
			</div>
		</div>
	</form>
</center>
{$default_js}
</body>
</html>