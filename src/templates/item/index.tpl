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
	<center>
	{if isset($indata.name1)}
		<h1>ようこそ、{$indata.name1}さん。<br></h1>
	{else}
		<h1>ようこそ。<a href="/customer/login">ログイン</a><br></h1>
	{/if}
		<h2>商品一覧</h2>
		<div class="container">
			<div class="table-responsive">
				<table class="table">
<thead>
						<tr>
							<td>
								商品名
							</td>
							<td>
								価格
							</td>
							<td>
								商品説明
							</td>
							<td >
								購入個数
							</td>
							<td>
								カートに追加
							</td>
						</tr>
</thead>
{if $searchlist|@count == 0}
					<tr>
						<th colspan="4" align="middle">
							商品データが存在しません。
						</th>
					</tr>
{else}
</tbody>
{foreach from=$searchlist item=record name=search_loop}
					<form action="/item/add" method="post">
						<tr>
							<td>
								{$record.name}
							<input type="hidden" name="itemID" value="{$record.itemID}">
							</td>
							<td>
								{$record.price}円
							</td>
							<td>
								{$record.description}
							</td>
							<td >
								<input type="text" name="numItem" value="" placeholder="個数を入力">
							</td>
							<td>
								<input type="submit" id="addItemBtn" class="btn btn-large btn-default" value="追加">
							</td>
						</tr>
					</form>
{/foreach}
</tbody>
{/if}
				</table>
			</div>
							<a class="btn btn-primary" href="/item/purchase">レジに進む</a>
		</div>
{$default_js}
</center>
</body>
</html>