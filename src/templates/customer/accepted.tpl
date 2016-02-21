{include file='common/default_css.tpl' assign=default_css}
{include file='common/default_js.tpl' assign=default_js}

<!DOCTYPE HTML>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>受注完了</title>
{$default_css}
</head>
<body>
<center>
<h1>
	<p>受注が完了しました！</p>
</h1>
<h2>
	<p>受注した商品一覧<br>
</h2>
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
			</tr>
</thead>
{if $searchlist|@count == 0}
			<tr>
				<th colspan="2" align="middle">
					商品データが存在しません。
				</th>
			</tr>
{else}
<tbody>
{foreach from=$searchlist item=record name=search_loop}
			<tr>
				<td>
					{$record.name}
				</td>
				<td>
					{$record.price}
				</td>
			</tr>
{/foreach}
{/if}	
		</tbody>
	</table>
	</div>
	</div>
	</p>
    <p><h2>配達先情報</h2>
        <dl>
            <dt>配達先住所
                <dd>{$indata.address}
            <dt>配達先周辺地図
                <dd>
<iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyChpv33LAG3DrAb14xrxkK9NtfbKRskvpk&q={urlencode($indata.address)}">
</iframe>                    </iframe>
        </dl>
    </p>
<h2>
	<p>決済用バーコード
</h2>
		<div>
			レジでの決済の際と、商品のお引渡しの際に以下のQRコードをご提示ください。<br>
			<img src="/img/qr.png" border="1" src=$qr width="210" height="210" alt="QRコード" title="このQRコードをご提示ください">
		</div>
		<div>
			QRコードをご利用いただけないときは、以下の注文番号をお伝えください<br>
			注文番号：{$indata.requestID}
		</div>
	</p>
</center>
{$default_js}
</body>
</html>