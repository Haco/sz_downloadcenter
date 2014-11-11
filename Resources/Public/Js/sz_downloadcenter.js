jQuery(document).ready(function() {


	if (jQuery('#approvals').length ) {

		var owl = jQuery('#approvals');

		owl.owlCarousel({
			items: 4,
			itemsDesktop : [1199,4],
			itemsDesktopSmall : [980,2],
			itemsTablet: [768,3],
			itemsTabletSmall: false,
			itemsMobile : [479,1],
			navigation: true
		});

		checkApprovalsW(owl);
		jQuery("#approvalList .next").click(function(){
			owl.trigger('owl.next');
		});
		jQuery("#approvalList .prev").click(function(){
			owl.trigger('owl.prev');
		});


		window.onresize = function() {
			checkApprovalsW(owl);
		};


		jQuery('.item', owl).click(function() {
			var rel = '#' + jQuery(this).attr('rel');
			console.log(rel);
			jQuery('html, body').animate({
				scrollTop: jQuery(rel).offset().top - 100
			}, 500);
		});


	}


	jQuery('#divisionSel').on('change',function() {
		initAjaxLoader('#categorySel', 'add');
		var val = this.value;
		resetDownloadCenter('#categorySel, #productSel', false);
		if (val != 0) {
			jQuery.ajax({
				dataType: "json",
				data: 'tx_szdownloadcenter_pi96[divisionId]=' + val + '&type=89657201',
				success: function(result) {
					if (result['success'] === true) {
						initAjaxLoader('#categorySel', 'remove');
						jQuery('#categorySel').html(result['content']).removeAttr('disabled');
					} else {
						console.log('just nope');
					}
				}
			});
		}
	});

	jQuery('#categorySel').on('change',function() {
		initAjaxLoader('#productSel', 'add');
		var val = this.value;
		if(jQuery('#discontinued').is(':checked')) {
			var disc = 1;
		} else {
			var disc = 0;
		}
		resetDownloadCenter('#productSel', false);
		if (val != 0) {
			jQuery.ajax({
				dataType: "json",
				data: 'tx_szdownloadcenter_pi96[categoryId]=' + val + '&tx_szdownloadcenter_pi96[action]=getProductList&tx_szdownloadcenter_pi96[discontinued]=' + disc + '&type=89657201',
				success: function(result) {
					if (result['success'] === true) {
						initAjaxLoader('#productSel', 'remove');
						jQuery('#productSel').html(result['content']).removeAttr('disabled');
						jQuery('#discontinued').removeAttr('disabled');
						jQuery('.discontinuedBox').removeClass('disabled');
					} else {
						console.log('just nope');
					}
				}
			});
		}
	});

	jQuery('#discontinued').on('change',function() {
		if(!this.hasAttribute('disabled')) {
			initAjaxLoader('#productSel', 'add');
			resetDownloadCenter('#productSel', false);
			var val = jQuery('#categorySel').val();
			if(jQuery('#discontinued').is(':checked')) {
				var disc = 1;
			} else {
				var disc = 0;
			}

			jQuery.ajax({
				dataType: "json",
				data: 'tx_szdownloadcenter_pi96[categoryId]=' + val + '&tx_szdownloadcenter_pi96[action]=getProductList&tx_szdownloadcenter_pi96[discontinued]=' + disc + '&type=89657201',
				success: function(result) {
					if (result['success'] === true) {
						initAjaxLoader('#productSel', 'remove');
						jQuery('#productSel').html(result['content']).removeAttr('disabled');
						jQuery('#discontinued').removeAttr('disabled');
					} else {
						console.log('just nope');
					}
				}
			});

		}
	});

	jQuery('#productSel').on('change',function() {
		var val = this.value;
		if (val != 0) {
			jQuery.ajax({
				dataType: "json",
				data: 'tx_szdownloadcenter_pi97[productId]=' + val + '&type=89657202',
				success: function(result) {
					jQuery('#productSelectInfo').addClass('hide');
					if (result['success'] === true) {
						jQuery('#productData').html(result['content']);
						jQuery('#accordion').accordion({
							heightStyle: "content",
							autoHeight: false,
							clearStyle: true
						});
					} else {
						console.log('just nope');
					}
				}
			});
		}
	});
});

function checkApprovalsW(owl) {
	var outerWrapW = jQuery('#approvalList .approvalWrap').outerWidth();
	var itemsW = 0;
	owl.find('.item').each(function() {
		itemsW = itemsW + jQuery(this).outerWidth();
	});
	if(outerWrapW <= itemsW -2) {
		owl.removeClass('fit');
	} else {
		owl.addClass('fit');
	}
}



function initAjaxLoader( element, action) {
	if (action == 'add') {
		jQuery(element).addClass('ajaxloader');
	} else {
		jQuery(element).removeClass('ajaxloader');
	}

}

function resetDownloadCenter(ids, checkbox) {
	jQuery(ids).attr('disabled', 'disabled');
	jQuery(ids).find('option:not(:eq(0))').remove();
	jQuery('#productSelectInfo').removeClass('hide');
	if(checkbox == true) {
		jQuery('#discontinued').attr('disabled','disabled').attr('checked', false);
		jQuery('.discontinuedBox').addClass('disabled');
	}
	jQuery('#productData').html('');
}
