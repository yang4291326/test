var ori_html = $('.select ul').html();

$(function(){
	$('.select').on('click', '.placeholder', function(e) {
		var parent = $(this).closest('.select');
		if (!parent.hasClass('is-open')) {
			$(this).css('background','#eee');
			parent.addClass('is-open');
			$('#search').show();
			$('#search input').focus();
			$('.select.is-open').not(parent).removeClass('is-open');
		} else {
			$(this).css('background','#fff');
			$("#search").hide();
			parent.removeClass('is-open');
		}
		e.stopPropagation();
	}).on('click', 'ul>li', function(event) {
		$('.placeholder').css('background','#fff');
		$("#search").hide();
		var parent = $(this).closest('.select');
		var data_index = $(this).attr('data-id');
		$(this).parents('.select-empty').find('.data-id').val(data_index);
		parent.removeClass('is-open').find('.placeholder').text($(this).text());
		event.stopPropagation();
	});

	$('#search').on('click',function(event){
		return false;
	})
	$('body').on('click', function(event) {
		$("#search").hide();
		$('.placeholder').css('background','#fff');
		$('.select.is-open').removeClass('is-open');
		event.stopPropagation();
	});



	$("#search").on('click',function(){
		$('.select').addClass('is-open');
		event.stopPropagation();
	})
	$("#search input").on('keyup',function(){
		var search_keys = $(this).val();
		if($.trim(search_keys) == ''){
			$('.select ul').html(ori_html);
			return;
		}
		var url = $(this).attr('data-url');
		$.ajax({
			url:  url + '/keywords/' + search_keys,
			type: 'get',
			dataType: 'json',
			success: function (data) {
				if (data.status) {
					var html = '';
					$(data.data).each(function (k, v) {
						html += '<li data-id="' + v.id + '">' + v.name + '</li>';
					})
					$('.select ul').html(html);
				}else{
					$('.select ul').html('<li>'+data.info+'</li>');
				}
			}
		})
	})
})
