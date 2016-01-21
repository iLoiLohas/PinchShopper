{include file='common/default_css.tpl' assign=default_css}
{include file='common/default_js.tpl' assign=default_js}

<!DOCTYPE HTML>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品選択</title>
{$default_css}
</head>
<body>
{if isset($indata.name1)}
	ようこそ、{$indata.name1}さん。<br>
{else}
	ようこそ。
	<a href="/customer/login">ログイン</a><br>
{/if}
	商品一覧
	<table border="1" width="400">
{if $searchlist|@count == 0}
			<tr>
				<th>
					商品データが存在しません。
				</th>
			</tr>
{else}
{foreach from=$searchlist item=record name=search_loop}
		<form action="/item/add" method="post">
			<tr>
				<td width="80%">
					{$record.name}
					<input type="hidden" name="itemID" value="{$record.itemID}">
				</td>
				<td rowspan="2">
					<input type="text" name="numItem" value="" placeholder="個数を入力">
				</td>
				<td rowspan="2">
					<input type="submit" id="addItemBtn" class="btn btn-large btn-primary" value="カートに追加">
				</td>
			</tr>
			<tr>
				<td width="80%">
					{$record.description}
				</td>
			</tr>
		</form>
{/foreach}
{/if}
		<tr>
			<th colspan="3" align="right">
				<a href="/item/purchase">レジに進む</a>
			</th>
		</tr>
	</table>
{$default_js}
</body>
</html>