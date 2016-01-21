/**
 * pinchshopper
 */
(function($) {
	$(function() {
		/***********************************************************************
		 * index action
		 **********************************************************************/
		$(document).on('click', '#addItemBtn', function() {
			console.log("商品を追加します．");
			$('#addItemForm').submit();
		});
		/***********************************************************************
		 * login action
		 **********************************************************************/
		/* login */
		$(document).on('click', '#loginBtn', function() {
			$('#loginForm').submit();
		});
		/***********************************************************************
		 * status action
		 **********************************************************************/
		$(document).on('click', '#customerStatusBtn', function() {
			console.log("入店情報を更新ボタン");
			$('#customerStatusForm').submit();
		});
	});
})(jQuery);