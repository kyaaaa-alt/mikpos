// QUANTITY CART INCREASE AND DECREASE

$(function () {
    'use strict'
	
	$('.counter-plus').on('click',function(){
		var $qty=$(this).closest('div').find('.qty');
		var currentVal = parseInt($qty.val());
		if (!isNaN(currentVal)) {
		$qty.val(currentVal + 1);
		}
	});
	$('.counter-minus').on('click',function(){
		var $qty=$(this).closest('div').find('.qty');
		var currentVal = parseInt($qty.val());
		if (!isNaN(currentVal) && currentVal > 0) {
		$qty.val(currentVal - 1);
		}
	});
});