<!DOCTYPE HTML>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品選択</title>
</head>
<body>
{if $name1 == 'guest'}
	ようこそ。
	<a href="/customer/login">ログイン</a><br>
{else}
	ようこそ、{$name1}さん。<br>
{/if}
	商品一覧
	<table border="1" width="400">
		<form action="/ite/add" method="post">
{section name=num loop=$items}
			<tr>
			<td width="80%">
				{$items[num].name}
			</td>
			<td rowspan="2">
				<input type="submit" name="{$items[num].itemID}" value="カートに追加"/>
			</td>
			</tr>
			<tr>
			<td width="80%">
				{$items[num].description}
			</td>
			</tr>
{sectionelse}
			<tr>
			<th>
				該当なし
			</th>
			</tr>
{/section}
		</form>
		<tr>
		<th colspan="2" align="right">
			<a href="/item/purchase">レジに進む</a>
		</th>
		</tr>
	</table>
</body>
</html>