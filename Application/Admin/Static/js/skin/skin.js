/**
 * 上传附件 
 * btnUpload: 上传按钮的ID
 * inputImg: 附件的路径的input ID
 * savePath: 指定存放在服务器上的路径
 * item: 一个页面上传多个图片时的标识
 **/
function ajaxSkinUploadField(btnUpload, inputImg, savePath, item){
    var filename = ""; // 旧文件的文件名
    var oldImg = $(inputImg).val();
    if($.trim(oldImg) != "" && oldImg.indexOf('/') != -1){
        var arr = oldImg.split('/');
        var file = arr[arr.length - 1];
        filename = file.split('.')[0];
    }

    if(!savePath) savePath = "";  // 要存放的路径
    
    new AjaxUpload($(btnUpload), {
        action: UPLOAD_FIELD_URL,  
        name: 'photo',   //这相当于<input type = "file" name = "photo"/> 
        data:{},  //附加参数值
        dataType : 'text',
        onSubmit : function(file, ext){
            if(!(ext && /^(ZIP|zip)$/.test(ext.toLowerCase()))){
                toastr.error('上传附件格式不支持');  
                return false;
            }
            this.setData({'oldImg':filename, 'savePath':savePath});
            this.disable();
        },
        onComplete: function(file, response){
            $('.tw-act-btn-confirm').attr("disabled",true);
            json = $.parseJSON($(response).text());
            console.log(json);
            if(json['status'] == true || json['status'] == 1 || json['status'].toString() == '1'){
                $("#img_file_").show();
                $.ajax({
                    type: 'POST',
                    url: "/index.php/Admin/Skin/startUnzip",
                    data: {tmpName:json['src'], zipUnpath:'/Uploads/Picture/skin'},
                    success: function (msg){
                        $("#enclosure" + item).val(msg);
                    }
                });  
                $('#btn_file_delete_' + item).show();
                $('.tw-act-btn-confirm').attr("disabled",false);
            }else{
                toastr.error(json['msg'])
            }
            this.enable(); 
        }  
    }); 
}

/**
 * 删除附件
**/
function delFileField(file, item, message){
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
            $('#img_file_').hide();
            $('#enclosure' + item).val('').hide();
            $('#btn_file_delete_' + item).hide();
            toastr.success(data.msg);
        }else{
            toastr.error(data.msg)
        }
    })
}