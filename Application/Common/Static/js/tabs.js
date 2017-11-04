$(document).ready(function() {
if($('.tw-tabs').length){
	//处理宽度width
	var $elements = $('.tw-nav-item');
	var eachwidth = 100/$elements.length;
	$('.tw-nav-item').width(eachwidth+'%');
    $('.tw-tabs').tab();
    //处理切换时样式
    $('.title-tab').on('click', function(){
		$('.title-tab').removeClass("title-tab-current");
        $('.title-tab').removeClass("title-tab-current");
        $(this).addClass("title-tab-current");
    });
}
});

function randomWord(randomFlag, min, max){
	var str = "",
	    range = min,
	    arr = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
	// 随机产生
	if(randomFlag){
	    range = Math.round(Math.random() * (max-min)) + min;
	}
	for(var i=0; i<range; i++){
	    pos = Math.round(Math.random() * (arr.length-1));
	    str += arr[pos];
	}
	return str;
}

(function($){
$.fn.extend({
    tab: function(options){
        var op = $.extend({
            eventType: "click",
            currentIndex: 0,
            tabNav: '.tw-tabs-nav',
            tabNavItem : '.tw-nav-item',
            tabCnt: '.tw-tabs-bd',
            tabPanel: '.tw-tab-panel',
            activeClass: 'tw-active'
        }, options);
        return this.each(function(){
            initTab($(this));
        });
        function initTab(twT){
            var twSelector = twT.add($("> *", twT));
            var twTabNav = $('>' + op.tabNav, twSelector);
            var twTabs = $('>' + op.tabNavItem, twTabNav);
            var twGroups = $('>' + op.tabPanel, twSelector);
            var activeClass = op.activeClass;

            twTabs.each(function(tabIndex) {
                var tabIdx = randomWord(false, 10);
                if (typeof($(this).attr('data-tab-idx')) == 'undefined'){

                    $(this).attr('data-tab-idx',tabIdx);
                    twGroups.eq(tabIndex).attr('data-tab-idx',tabIdx);
                }
            });
            var startTab = twTabs.eq(op.currentIndex).attr('data-tab-idx');
            switchTab(twT, startTab)

            if (op.eventType == "hover") {
                twTabNav.on('mouseover', op.tabNavItem, function(event){
                    var tabIndex = $(this).attr('data-tab-idx');
                    switchTab(twT, tabIndex)
                })
            }
            else {
                twTabNav.on('click', op.tabNavItem, function(event){
                    var tabIndex = $(this).attr('data-tab-idx');
                    event.cancelBubble = true;
                    if (event.stopPropagation) event.stopPropagation();
                    if ($(event.target).hasClass('tw-tab-del')) {
                        destroyTab(twT, tabIndex)
                    } else if($(event.target).hasClass('tw-tab-insert')){

                    } else{
                        switchTab(twT, tabIndex)
                    }
                })
            }
        }

        function switchTab(twT, tabIndex){
            var twSelector = twT.add($("> *", twT));
            var twTabNav = $('>' + op.tabNav, twSelector);
            var twTabs = $('>' + op.tabNavItem, twTabNav);
            var twGroups = $('>' + op.tabPanel, twSelector);
            var activeClass = op.activeClass;
            var twTab = twTabs.eq(tabIndex);
            var twGroup = twGroups.eq(tabIndex);
            twTabs.each(function() {
                if($(this).attr('data-tab-idx') == tabIndex){
                    twTab = $(this);
                }
            })
            twGroups.each(function() {
                if($(this).attr('data-tab-idx') == tabIndex){
                    twGroup = $(this);
                }
            })
            if (op.reverse && (twTab.hasClass(activeClass) )) {
                twTabs.removeClass(activeClass);
                twGroups.hide();
            } else {
                // op.currentIndex = tabIndex;
                twTabs.removeClass(activeClass);
                twTab.addClass(activeClass);
                twGroups.hide();
                twGroup.show();
            }
        }


        function destroyTab(twT, tabIndex){
            if (confirm('确定要删除此选项卡？')){
                var twSelector = twT.add($("> *", twT));
                var twTabNav = $('>' + op.tabNav, twSelector);
                var twTabs = $('>' + op.tabNavItem, twTabNav);
                var twGroups = $('>' + op.tabPanel, twSelector);
                var activeClass = op.activeClass;

                twTabs.each(function() {
                    if($(this).attr('data-tab-idx') == tabIndex){
                        twTab = $(this);
                    }
                })
                twGroups.each(function() {
                    if($(this).attr('data-tab-idx') == tabIndex){
                        twGroup = $(this);
                    }
                })
                twTab.remove();
                twGroup.remove();
                twTabs = $('>' + op.tabNavItem, twTabNav);
                if(twTabs.length == 1){
                    twTabs.find(".tw-tab-del").hide();
                }
                if (twTab.hasClass(activeClass)) {
                    var _eq = tabIndex-1 >= 0 ? tabIndex-1 : 0;
                    twTabs.eq(_eq).trigger('click');
                }
            }

        }

    }
});
})(jQuery);