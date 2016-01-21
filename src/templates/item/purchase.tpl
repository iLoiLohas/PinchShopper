{include file='common/default_css.tpl' assign=default_css}
{include file='common/default_js.tpl' assign=default_js}

<!DOCTYPE HTML>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品選択確認</title>
{$default_css}
</head>
<body>
	<form action="./deliveryman" method="post">
		<table border="1">
			<tr>
				<th>
					商品名
				</th>
				<th>
					価格（ポイント）
				</th>
				<th>
					数量
				</th>
			</tr>
{if $searchlist|@count == 0}
			<tr>
				<th colspan="3">
					まだ何も入っていません
				</th>
			</tr>
{else}
{foreach from=$searchlist item=record name=search_loop}
			<tr>
				<th>
					{$record.name}
				</th>
				<th>
					{$record.price}
				</th>
				<th>
					<input type="number" name="{$record.itemID}" value="">
				</th>
			</tr>
{/foreach}
{/if}
			<tr>
				<th colspan="3" align="right">
					<input type="submit" value="配達者を選ぶ">
			</tr>
		</table>
	</form>
{$default_js}
</body>
</html>