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
	<center>
		<h2>配達を行いますか？<br></h2>
		    <form id="customerDeliverForm" action="/customer/accepted" method="post">
			<input type="hidden" name="requestID" value="{$indata.requestID}">
		<label>
			<input type="radio" name="report" value="0"> 行う
	    </label>
		<label>
			<input type="radio" name="report" value="1"> 行わない
	    </label>
		<div>
		    <a href="javascript:void(0);" id="customerDeliverBtn" class="btn btn-default">送信</a>
		</div>
    </form>
	</center>
{$default_js}
</body>
</html>