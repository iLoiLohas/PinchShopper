{include file='common/default_css.tpl' assign=default_css}
{include file='common/default_js.tpl' assign=default_js}

<!DOCTYPE HTML>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>配達者選択</title>
{$default_css}
</head>
<body>
	配達者を選択してください。
	<table border="1">
		<tr>
			<td>
				名前
			</td>
			<td>
				性別
			</td>
			<td>
				状態
			</td>
			<td>
				評価/回数
			</td>
			<td>
				配達者候補にする
			</td>
		</tr>
{if $searchlist|@count == 0}
		<tr>
			<td colspan="5" align="middle">
				誰もいません
			</td>
		</tr>
{else}
{foreach from=$searchlist item=record name=search_loop}
		<form action="/customer/deliveryman" method="post">
			<tr>
				<td>
					{$t_customer[deliverer].name1}
				</td>
				<td>
					{$t_customer[deliverer].gender}
				</td>
				<td>
					{$t_customer[deliverer].status}
				</td>
				<td>
					{$t_customer[deliverer].rate}
					/{$t_customer[deliverer].rateNum}回
				</td>
				<td>
					<input type="checkbox" name="{$t_customer[deliverer].name1}" value="1" checked/>
				</td>
			</tr>
		</form>
{/foreach}
{/if}
		<tr>
			<td colspan="5" align="right">
				<input type="submit" value="依頼を送る">
			</td>
		</tr>
	</table>
{$default_js}
</body>
</html>