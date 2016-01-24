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
	<center>
		<h2>配達者を選択してください。</h2>
		<div class="container">
			<div class="table-responsive">
	<table class="table table-bordered">
		<tbody>
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
		<form id="customerDeliverymanForm" action="/customer/deliveryman" method="post">
{if $searchlist|@count == 0}
		<tr>
			<td colspan="5" align="middle">
				誰もいません
			</td>
		</tr>
{else}
{foreach from=$searchlist item=record name=search_loop}
			<tr>
				<td align="middle">
					{$record.name1}
				</td>
				<td align="middle">
					{if $record.gender == 0}男性{elseif $record.gender == 1}女性{/if}
				</td>
				<td align="middle">
					{if $record.status == 0}店舗にいる{elseif $record.status == 1}店舗にいない{elseif $record.status == 2}店舗に向かっている{/if}
				</td>
				<td align="middle">
					{$record.rate}/{$record.rateNum}回
				</td>
				<td align="middle">
					<input type="checkbox" name="customerID[]" value="{$record.customerID}" checked/>
				</td>
			</tr>
{/foreach}
{/if}
		</form>
		<tr>
			<td colspan="5" align="right">
				<a href="javascript:void(0);" id="customerDeliverymanBtn" class="btn btn-primary">依頼を送る</a>
			</td>
		</tr>
</tbody>
	</table>
			</div>
		</div>
</center>
{$default_js}
</body>
</html>