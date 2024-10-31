jQuery(function($){
	var el = $('a[href=edit.php?post_type=page&page=quickfind]');
	var li = el.parent();
	$.ajax({
		url: ajaxurl,
		data: {
			action: 'quickfind_get_pages'
		},
		success: function(html){
			el.addClass('quickfind-active').prepend('<span class="active" />');
			html = $(html).appendTo(li).hide();
			html.find('li').each(function(){
				var l = $(this);
				if ( l.find('ul').length > 0 )
					l.addClass('filled');
			});
		}
	});
	el.click(function(e){
		e.preventDefault();
		el.toggleClass('quickfind-open');
		li.find('.quickfind').slideToggle();
	});
	$('.quickfind .toggle').live( 'click', function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).toggleClass('toggle-open').parents('li').eq(0).children('ul').eq(0).slideToggle();
	});
});