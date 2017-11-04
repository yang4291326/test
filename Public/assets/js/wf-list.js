$(document).ready(function() {
	$(".tw-list-top").each(function(){
		if($(this).find('.tw-tool-bar').length){
			$(this).addClass('tw-list-top-search-tool');
		}
	})
	
	if($(".tw-list-wrap").length){
		var _heightH = 0;
		var _heightT = 0;
		var _heightF = 0;
		if($(".tw-list-hd").length){
			_heightH = $(".tw-list-hd").outerHeight(true);
			$(".tw-list-hd").prepend('<i class="tw-icon-caret-right"></i>')
		}
		if($(".tw-list-top").length){
			_heightT = $(".tw-list-top").outerHeight(true);
		}
		if($(".tw-list-ft").length){
			_heightF = 45;
		}
		/*var _height = $(window).height() - _heightH - _heightT - _heightF - 10;
		$(".tw-list-wrap").height(_height);
		if($(".tw-list-wrap").hasClass("tw-edit-wrap")){
			$(".tw-list-wrap").height(_height - 50);
		}*/
	}

	if($('.tw-table-list').length){
	/*	$('.tw-table-list').cssTable();*/
	}
	$('.tw-search-clear-btn').click(function(){
    /*搜索重置*/
        $(".tw-search-bar input").val("");
        $(".tw-search-bar select").val("");
	})
	


});

