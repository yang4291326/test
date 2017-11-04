$(function(){    
    
    //右键菜单参数
    context.init({
        fadeSpeed: 100,
        filter: function ($obj){},
        above: 'auto',
        preventDoubleContext: true,
        compress: false
    });
    
    //加载layer拓展
    layer.config({
        extend: 'extend/layer.ext.js'
    });
    
    function createBox(data){           
        var dataId = parseInt(data.id) || '';
        var value = data.name || '';
        var color = data.map_color || '';
        var height = parseInt(data.map_height) || 0;
        var width = parseInt(data.map_width) || 0;
        var pageX = parseInt(data.position_x) || 0;
        var pageY = parseInt(data.position_y) || 0;

        //更新计数器并记录当前计数
        var curNum = num++;
        //创建区域块
        var pos = $("#canvas").position();
        var box = $('<div class="box" rel="'+curNum+'" dataId="'+dataId+'"><pre class="content">'+value+'</pre><div class="bg transparent" style="background-color:'+color+'"></div><div class="coor transparent"></div></div>').css({
                width : width,
                height : height,
                top : pageY > 0 ? pageY : (pos.top > 0 ? 0 : pos.top * -1 + 50),
                left : pageX > 0 ? pageX : (pos.left > 0 ? 0 : pos.left * -1 + 30)
        }).appendTo("#canvas");

        //计算文本位置
        box.find('.content').css({
            marginLeft : box.find('.content').width()/2*-1,
            marginTop : box.find('.content').height()/2*-1
        });

        //创建右键菜单
        context.attach('.box[rel='+curNum+']', [
            {header: '操作'},
            {text: '编辑导航信息', action: function(e){  
                var mapMainId = jQuery('[rel =' + curNum+ ']').attr('dataId');                      // 获取联盟商家详情表自增id
                var curColor  = jQuery('[rel =' + curNum+ ']').find('.bg').css('background-color'); // 获取选择区块的颜色值
                var curXpage  = jQuery('[rel =' + curNum+ ']').position().left;                     // 获取选择区块的X位置
                var curYpage  = jQuery('[rel =' + curNum+ ']').position().top;                      // 获取选择区块的Y位置
                var height    = jQuery('[rel =' + curNum+ ']').height();                            // 获取选择区块的高度
                var width     = jQuery('[rel =' + curNum+ ']').width();                             // 获取选择区块的宽度

                e.preventDefault();
                layer.open({
                    type: 2, 
                    shadeClose: true,
                    shade: 08,
                    area: ['800px', '500px'],
                    title:  ['联盟商家信息录入', 'color: #fff; background:#aaa;'],
                    content: "/index.php/Admin/Map/allianceMerchantMemberEdit?mapId="+curNum+"&mapColor="+curColor+"&curXpage="+curXpage+"&curYpage="+curYpage+"&height="+height+"&width="+width+"&mapMainId="+mapMainId+"&allianceMerchantMapId="+allianceMerchantMapId
                });
                }
            },
            {text: '更改区域尺寸', action: function(e){
                e.preventDefault();
                layer.prompt({
                    title: '请输入区域尺寸（宽,高），最小值：30',
                    formType: 0,
                    value: $('.box[rel='+curNum+']').width()+","+$('.box[rel='+curNum+']').height()
                }, function(value, index, elem){
                        var reg = /^[0-9]+,[0-9]+$/;
                        if(!reg.test(value)){
                            alert('输入格式不正确，例：100,200');
                            return;
                        }
                        var size = value.split(',');
                        var box = $('.box[rel='+curNum+']');
                        box.css({
                            width : size[0] < 30 ? 30 : size[0],
                            height : size[1] < 30 ? 30 : size[1]
                        });
                        layer.close(index);
                    });
                }
            },
            {text: '删除区域', action: function(e){
                    var mapMainId = jQuery('[rel =' + curNum+ ']').attr('dataId'); // 获取联盟商家详情表自增id
                    e.preventDefault();
                    recycle(mapMainId, '确认要删除吗！',true); // 删除数据库中的数据
                    $('.box[rel='+curNum+']').remove();
                }
            },
            {divider: true},
            {header: '更改颜色'},
            {text: '<font color="orange">橙色</font>', action: function(e){
                    e.preventDefault();
                    $('.box[rel='+curNum+'] .bg').css('background-color', 'orange');
                }
            },
            {text: '<font color="red">红色</font>', action: function(e){
                    e.preventDefault();
                    $('.box[rel='+curNum+'] .bg').css('background-color', 'red');
                }
            },
            {text: '<font color="blue">蓝色</font>', action: function(e){
                    e.preventDefault();
                    $('.box[rel='+curNum+'] .bg').css('background-color', 'blue');
                }
            },
            {text: '<font color="green">绿色</font>', action: function(e){
                    e.preventDefault();
                    $('.box[rel='+curNum+'] .bg').css('background-color', 'green');
                }
            },
            {text: '<font color="purple">紫色</font>', action: function(e){
                    e.preventDefault();
                    $('.box[rel='+curNum+'] .bg').css('background-color', 'purple');
                }
            },
            {text: '<font color="yellow">黄色</font>', action: function(e){
                    e.preventDefault();
                    $('.box[rel='+curNum+'] .bg').css('background-color', 'yellow');
                }
            }
        ]);
    }
    
    
    //调试输出方法
    function debug(msg){
        $("#debug").text(msg);
    }
    
    //添加区域
    $("#btn_add").click(function(){
        //弹出区域说明输入框
        createBox({
            map_width : 200,
            map_height : 100
        });
    });

    //锁定区域
    $('#btn_lock').click(function(){
        if(lock){
            $(this).val("锁定区域");
            lock = false;
            $('.box .coor').show();
        }else{
            $(this).val("解锁区域");
            lock = true;
            $('.box .coor').hide();
        }
    });
    
    //获取所有区块
    $('#btn_save').click(function(){
        var data = [];
        $('.box').each(function(){
            var box = {};
            box['id'] = $(this).attr('dataId');
            box['text'] = $(this).find('.content').text();
            box['color'] = $(this).find('.bg').css('background-color');
            box['height'] = $(this).height();
            box['width'] = $(this).width();
            box['pageX'] = $(this).position().left;
            box['pageY'] = $(this).position().top;
            console.dir(box);
            data.push(box);
        });
    });
    
    //创建拖拽方法
    $("#canvas").mousedown(function(e){
        var canvas = $(this);
        e.preventDefault();
        var pos = $(this).position();
        this.posix = {'x': e.pageX - pos.left, 'y': e.pageY - pos.top};
        $.extend(document, {'move': true, 'move_target': this, 'call_down' : function(e, posix){
            canvas.css({
                'cursor': 'move',
                'top': e.pageY - posix.y,
                'left': e.pageX - posix.x
            });
        }, 'call_up' : function(){
            canvas.css('cursor', 'default');
        }});
    }).on('mousedown', '.box', function(e) {
        if(lock) return;
        var pos = $(this).position();
        this.posix = {'x': e.pageX - pos.left, 'y': e.pageY - pos.top};
        $.extend(document, {'move': true, 'move_target': this});
        e.stopPropagation();
    }).on('mousedown', '.box .coor', function(e) {
        var $box = $(this).parent();
        var posix = {
            'w': $box.width(), 
            'h': $box.height(), 
            'x': e.pageX, 
            'y': e.pageY
        };
        $.extend(document, {'move': true, 'call_down': function(e) {
            $box.css({
                'width': Math.max(30, e.pageX - posix.x + posix.w),
                'height': Math.max(30, e.pageY - posix.y + posix.h)
            });
        }});
        e.stopPropagation();
    });    
    
    if (loadData != 0) {        
        $.each(loadData, function(i, row){
            createBox(row);
        });
    }
});
    
// 保存之后的回掉函数，把联盟商家的名称显示到显示块上
function getAllianceName(name, mapId){      
    var curCont = $('.box[rel='+mapId+'] .content');
    curCont.text(name).css({
        marginLeft : curCont.width()/2*-1,
        marginTop : curCont.height()/2*-1
    });
}