{include file='common/default_css.tpl' assign=default_css}
{include file='common/default_js.tpl' assign=default_js}


<!DOCTYPE HTML>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>決済完了</title>
{$default_css}
</head>
<body>
<center>
{if $param==null}
	<p><h2>お受け取り手続きが完了しました！ご利用ありがとうございます！</h2>
	</p>
	<p><h2>ご注文総額：{$total}円</h2>
	</p>
	<form action="./evaluate" method="post">
	<p><h2>よろしければ、配達者を5段階で評価してください</h2><br>
{else}
	<p><h2>お引渡し手続きが完了しました！ご利用ありがとうございます！<h2>
	</p>
	<p><h2>獲得ポイント：{$point}ポイント</h2>
	</p>
	<form action="./evaluate" method="post">
	<p><h2>よろしければ、注文者を5段階で評価してください<h2><br>
{/if}
	<h2>評価</h2>
	<h3>
	<label class="radio-inline"><input type="radio" name="rate" value="1">1</label>
	<label class="radio-inline"><input type="radio" name="rate" value="2">2</label>
	<label class="radio-inline"><input type="radio" name="rate" value="3">3</label>
	<label class="radio-inline"><input type="radio" name="rate" value="4">4</label>
	<label class="radio-inline"><input type="radio" name="rate" value="5">5</label>
	<br>
	悪い＜―――――＞良い
	</h3>
	</p>
	<p><h2>備考欄</h2><br>
	<input type="text" name="note">
	</p>
	<input type="submit" value="送信">
	</form>
</center>
{$default_js}
</body>
</html>