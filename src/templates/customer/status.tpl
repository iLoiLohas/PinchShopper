{include file='common/default_css.tpl' assign=default_css}
{include file='common/default_js.tpl' assign=default_js}

<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>入店情報</title>
{$default_css}
</head>
<body>
	入店情報を更新してください．<br>
    <form id="customerStatusForm" action="/customer/status" method="post">
		<label>
			<input type="radio" name="status" value="0"> 店舗にいる
	    </label>
		<label>
			<input type="radio" name="status" value="1"> 店舗にいない
	    </label>
		<label>
			<input type="radio" name="status" value="2"> 店舗に向かっている
	    </label>
		<div>
		    <a href="javascript:void(0);" id="customerStatusBtn" class="btn btn-primary">送信</a>
		</div>
    </form>
{$default_js}
</body>
</html>