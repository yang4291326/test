//dom加载完成后执行的js
$(function(){

	//全选的实现
	$(".check-all").click(function(){
		$(".ids").prop("checked", this.checked);
	});
	$(".ids").click(function(){
		var option = $(".ids");
		option.each(function(i){
			if(!this.checked){
				$(".check-all").prop("checked", false);
				return false;
			}else{
				$(".check-all").prop("checked", true);
			}
		});
	});


    //按钮组(鼠标悬浮显示)
    $(".btn-group").mouseenter(function(){
        var userMenu = $(this).children(".dropdown ");
        var icon = $(this).find(".btn i");
        icon.addClass("btn-arrowup").removeClass("btn-arrowdown");
        userMenu.show();
        clearTimeout(userMenu.data("timeout"));
    }).mouseleave(function(){
        var userMenu = $(this).children(".dropdown");
        var icon = $(this).find(".btn i");
        icon.removeClass("btn-arrowup").addClass("btn-arrowdown");
        userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
        userMenu.data("timeout", setTimeout(function(){userMenu.hide()}, 100));
    });

    //按钮组(鼠标点击显示)
    // $(".btn-group-click .btn").click(function(){
    //     var userMenu = $(this).next(".dropdown ");
    //     var icon = $(this).find("i");
    //     icon.toggleClass("btn-arrowup");
    //     userMenu.toggleClass("block");
    // });
    $(".btn-group-click .btn").click(function(e){
        if ($(this).next(".dropdown").is(":hidden")) {
            $(this).next(".dropdown").show();
            $(this).find("i").addClass("btn-arrowup");
            e.stopPropagation();
        }else{
            $(this).find("i").removeClass("btn-arrowup");
        }
    })
    $(".dropdown").click(function(e) {
        e.stopPropagation();
    });
    $(document).click(function() {
        $(".dropdown").hide();
        $(".btn-group-click .btn").find("i").removeClass("btn-arrowup");
    });

    // 独立域表单获取焦点样式
    $(".text").focus(function(){
        $(this).addClass("focus");
    }).blur(function(){
        $(this).removeClass('focus');
    });
    $("textarea").focus(function(){
        $(this).closest(".textarea").addClass("focus");
    }).blur(function(){
        $(this).closest(".textarea").removeClass("focus");
    });
});


//标签页切换(无下一步)
function showTab() {
    $(".tab-nav li").click(function(){
        var self = $(this), target = self.data("tab");
        self.addClass("current").siblings(".current").removeClass("current");
        window.location.hash = "#" + target.substr(3);
        $(".tab-pane.in").removeClass("in");
        $("." + target).addClass("in");
    }).filter("[data-tab=tab" + window.location.hash.substr(1) + "]").click();
}

//标签页切换(有下一步)
function nextTab() {
     $(".tab-nav li").click(function(){
        var self = $(this), target = self.data("tab");
        self.addClass("current").siblings(".current").removeClass("current");
        window.location.hash = "#" + target.substr(3);
        $(".tab-pane.in").removeClass("in");
        $("." + target).addClass("in");
        showBtn();
    }).filter("[data-tab=tab" + window.location.hash.substr(1) + "]").click();

    $("#submit-next").click(function(){
        $(".tab-nav li.current").next().click();
        showBtn();
    });
}

// 下一步按钮切换
function showBtn() {
    var lastTabItem = $(".tab-nav li:last");
    if( lastTabItem.hasClass("current") ) {
        $("#submit").removeClass("hidden");
        $("#submit-next").addClass("hidden");
    } else {
        $("#submit").addClass("hidden");
        $("#submit-next").removeClass("hidden");
    }
}

(function($){
    $.fn.extend({
        hoverClass: function(className, speed){
            var _className = className || "hover";
            return this.each(function(){
                var $this = $(this), mouseOutTimer;
                $this.hover(function(){
                    if (mouseOutTimer) clearTimeout(mouseOutTimer);
                    $this.addClass(_className);
                },function(){
                    mouseOutTimer = setTimeout(function(){$this.removeClass(_className);}, speed||10);
                });
            });
        },
        cssTable: function(options){
            return this.each(function(){
                var $this = $(this);
                var $trs = $this.find('tbody>tr');
                //增加兼容IE8隔行变色
                $this.find('tbody>tr:even').addClass('oddrow');
                $this.find('tbody>tr:odd').addClass('evenrow');
                $trs.hoverClass("hover").each(function(index){
                    var $tr = $(this);
                    $tr.click(function(){
                        $trs.filter(".selected").removeClass("selected");
                        $tr.addClass("selected");
                    });
                });

            });
        },
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
                        // console.log($(this).attr('data-tab-idx'))
                    }
                    // if (op.currentIndex == tabIndex){
                    //  // console.log(tabIdx)
                    //  // var tabIdx = $(this).attr('data-tab-idx');
                    //  // switchTab(twT, tabIdx)
                    // }else{
                    //  $(this).removeClass(activeClass);
                    // }
                    // var title = $.trim($(this).find('a').text());;
                    // var cTitle = title.length > 10 ? title.substring(0,7) + '...' : title;
                    // $(this).find("a").text(cTitle).attr('title',title);
                });

                // if (op.currentIndex == tabIndex){
                //      console.log(tabIdx)
                //      switchTab(twT, tabIdx)
                //  }else{
                //      $(this).removeClass(activeClass);
                //  }
                var startTab = twTabs.eq(op.currentIndex).attr('data-tab-idx');
                // console.log(startTab)
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


