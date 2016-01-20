/**
 * pinchshopper
 */
(function($) {
	$(function() {
		/***********************************************************************
		 * index action
		 **********************************************************************/
		/* login */
		$(document).on('click', '#addItemBtn', function() {
			console.log("商品を追加します．");
			$('#addItemForm').submit();
		});
	});
})(jQuery);