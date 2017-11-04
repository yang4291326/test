
/**
 * 上传图片
 * btnUpload: 上传按钮的ID
 * inputImg: 保存图片路径的input ID
 * savePath: 指定存放在服务器上的路径
 * item: 一个页面上传多个图片时的标识
 * flag: 回调函数表示，true表示需要出现裁剪
 * saveTruePath: 服务器保存图片的真实路径
 **/
function ajaxMapUpload(btnUpload, inputImg, savePath, item, flag, saveTruePath, mapId){
//function ajaxUpload(btnUpload, inputImg, savePath, item, flag, saveTruePath){
    var filename = ""; // 旧文件的文件名
    var oldImg = $(inputImg).val();
    if($.trim(oldImg) != "" && oldImg.indexOf('/') != -1){
        var arr = oldImg.split('/');
        var file = arr[arr.length - 1];
        filename = file.split('.')[0];
    }

    if(!savePath) savePath = "";  // 要存放的路径
    
    new AjaxUpload($(btnUpload), {
        action: UPLOAD_IMG_URL,  
        name: 'photo',   //这相当于<input type = "file" name = "photo"/> 
        data:{},  //附加参数值
        dataType : 'text',
        onSubmit : function(file, ext){
            if(!(ext && /^(jpg|png|gif|jpeg)$/.test(ext.toLowerCase()))){
                toastr.error('图片格式不支持, 请上传jpg, png, gif, jpeg格式图片');  
                return false;
            }
            this.setData({'oldImg':filename, 'savePath':savePath});
            this.disable();
        },
        onComplete: function(file, response){
            json = $.parseJSON($(response).text());
            if(json['status'] == true || json['status'] == 1 || json['status'].toString() == '1'){
                $.ajax({
                  type: 'POST',
                  url: "/index.php/Admin/Map/mapDetailDel",
                  data: {mapId:mapId},
                  success: function (msg){
                      $('.box').remove();
                  }
                });             
                $("#img_" + item).attr('src', json['src'] + "?" + Math.random()).show();
                $("#img" + item).val(json['src']);
                $('#btn_delete_' + item).show();
                $('#canvas').show(); // 地图图片
                if ( mapId != 0 ) {
                    $('#btn_add').show(); // 地图图片显示
                    $('#btn_lock').show(); // 地图图片显示
                    $('#btn_save').show(); // 地图图片显示                    
                }

                if (flag) {
                    //img_success(json['src'], item);
                    layer.open({
                        type: 2,
                        title: '图片剪切弹出框',
                        shadeClose: true,
                        shade: 0.8,
                        area: ['800px', '500px'],
                        content: "/index.php/Admin/Public/mapuploadImgCut?src="+json['src']+"&item="+item+"&savePath="+saveTruePath+"" //iframe的url
                    }); 
                };
            }else{
                toastr.error(json['msg'])
            }
            this.enable(); 
        }  
    }); 
}

/**
 * 删除文件
 **/
function delMapFile(file, item, message, mapId){
    if(! message) message = "确认删除吗? 此步骤无法恢复!"
    if(! confirm(message)) return false;
    var url;
    if (DELETE_FILE_URL.indexOf('?') > -1) {
        url = DELETE_FILE_URL + "&file="+ file;
    } else {
        url = DELETE_FILE_URL + "?file="+ file;
    }
    
    $.get(url, function(data){
        if(data.status == 1){
            $('#img_' + item).attr('src', '').hide();
            $('#img' + item).val('').hide();
            $('#btn_delete_' + item).hide();
            $('#canvas').hide(); // 地图图片
            $('#btn_add').hide(); // 地图图片显示
            $('#btn_lock').hide(); // 地图图片显示
            $('#btn_save').hide(); // 地图图片显示
            
            $.ajax({
                type: 'POST',
                url: "/index.php/Admin/Map/mapDetailDel",
                data: {mapId:mapId},
                success: function (msg){
                    $('.box').remove();
                }
            });
            toastr.success(data.msg);
        }else{
            toastr.error(data.msg)
        }
    })
}
