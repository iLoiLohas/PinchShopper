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
		 * index action
		 **********************************************************************/
		/* login */
		$(document).on('click', '#loginBtn', function() {
			$('#loginForm').submit();
		});
	});
})(jQuery);