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
			$('#customerStatusForm').submit();
		});
		/***********************************************************************
		 * deliveryman action
		 **********************************************************************/
		$(document).on('click', '#customerDeliverymanBtn', function() {
			$('#customerDeliverymanForm').submit();
		});
		/***********************************************************************
		 * deliver action
		 **********************************************************************/
		$(document).on('click', '#customerDeliverBtn', function() {
			$('#customerDeliverForm').submit();
		});
	});
})(jQuery);