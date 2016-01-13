<!DOCTYPE HTML>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品選択</title>
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
		<form action="/item/add" method="post">
{if $searchlist|@count == 0}
			<tr>
				<th>
					商品データが存在しません。
				</th>
			</tr>
{else}
{foreach from=$searchlist item=record name=search_loop}
			<tr>
				<td width="80%">
					{$record.name}
				</td>
				<td rowspan="2">
					<button type="button" onclick='location.href="/item/add?itemid={$record.itemID}"'>カートに追加</button>
				</td>
			</tr>
			<tr>
				<td width="80%">
					{$record.description}
				</td>
			</tr>
{/foreach}
{/if}
		</form>
		<tr>
			<th colspan="2" align="right">
				<a href="/item/purchase">レジに進む</a>
			</th>
		</tr>
	</table>
</body>
</html>