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
				<table class="table table-bordered">
{if $searchlist|@count == 0}
					<tr>
						<th colspan="2" align="middle">
							商品データが存在しません。
						</th>
					</tr>
{else}
{foreach from=$searchlist item=record name=search_loop}
					<form action="/item/add" method="post">
						<tr>
							<td>
								{$record.name}
							<input type="hidden" name="itemID" value="{$record.itemID}">
							</td>
							<td>
								<input type="text" name="numItem" value="" placeholder="個数を入力">
							</td>
							<td>
								<input type="submit" id="addItemBtn" class="btn btn-large btn-primary" value="カートに追加">
							</td>
						</tr>
						<tr>
							<td colspan="3">
								{$record.description}
							</td>
						</tr>
					</form>
{/foreach}
{/if}
					<tr>
						<th colspan="3" class="tar">
							<a class="btn btn-default" href="/item/purchase">レジに進む</a>
						</th>
					</tr>
				</table>
			</div>
		</div>
{$default_js}
</center>
</body>
</html>