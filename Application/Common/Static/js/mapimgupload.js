/**
 * 上传文件（附件） 
 * 注意：该上传仅用于模板的图片和文件上传
 * btnUpload: 上传按钮的ID
 * inputImg: 保存图片路径的input ID
 * savePath: 指定存放在服务器上的路径
 * item: 一个页面上传多个图片时的标识
 * flag: 回调函数表示，true表示需要出现裁剪
 * saveTruePath: 服务器保存图片的真实路径
 **/
function ajaxUpload(btnUpload, inputImg, savePath, item, flag, saveTruePath){
    var filename = ""; // 旧文件的文件名
    var oldImg = $(inputImg).val();
    if($.trim(oldImg) != "" && oldImg.indexOf('/') != -1){
        var arr = oldImg.split('/');
        var file = arr[arr.length - 1];
        filename = file.split('.')[0];
    }

    if(!saveTruePath) saveTruePath = "";  // 要存放的路径
    
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
            this.setData({'oldImg':filename, 'savePath':saveTruePath});
            this.disable();
        },
        onComplete: function(file, response){
            json = $.parseJSON($(response).text());
            if(json['status'] == true || json['status'] == 1 || json['status'].toString() == '1'){
                $("#img_" + item).attr('src', json['src'] + "?" + Math.random()).show();
                $("#img" + item).val(json['src']);
                $('#btn_delete_' + item).show();

                if (flag) {
                    //img_success(json['src'], item);

                    // layer.open({
                    //     type: 2,
                    //     title: '图片剪切弹出框',
                    //     shadeClose: true,
                    //     shade: 0.8,
                    //     area: ['800px', '500px'],
                    //     content: "/index.php/Admin/Public/uploadImgCut?src="+json['src']+"&item="+item+"&savePath="+saveTruePath+"" //iframe的url
                    // }); 
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
function delFile(file, item, message){
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
            toastr.success(data.msg);
        }else{
            toastr.error(data.msg)
        }
    })
}
//定义默认的item值
default_img_item = '';
function setImgValue(src, item){
    if(item == undefined) item = default_img_item;    
    parent.$("#img" + item).val(src);
    parent.$('#img_' + item).attr('src', src + "?r=" + new Date().getTime());
    parent.layer.close(parent.layer.getFrameIndex(window.name));
}

// 上传成功回调, 开始剪切
function img_success(src, item){
    $('.img-container').empty();
    $("<img />").attr("src", src + "?r=" + new Date().getTime()).appendTo('.img-container').load(function() {
        imgWidth = this.width;
        imgHeight = this.height;
        if(imgHeight > 60 || imgWidth > 640){
            cropper();
            default_img_item = item;
            $('.btns, .img-container').show();
        }else{
            setImgValue(src, item);
        }
    }).css('width', '100%');
}
function initCrop(path){
    // 取消截图
    $('#btnCropCancle').click(function(){
        $('.btns, .img-container').hide();
        $('.img-container>img').attr('src', '###');
        parent.layer.close(parent.layer.getFrameIndex(window.name));
    })

    // 开始载图
    $('#btnCropOK').click(function(){
        $('#btnCropOK').attr('disabled', 'disabled').html('剪切中...')
        imgCrop = $('.img-container>img');

        // 剪切大小
        var cropLeft = imgCrop.cropper('getCropBoxData')['left'];
        var cropTop = imgCrop.cropper('getCropBoxData')['top'];
        var cropWidth = imgCrop.cropper('getCropBoxData')['width'];
        var cropHeight = imgCrop.cropper('getCropBoxData')['height'];
        // 图片大小
        var canvasLeft = imgCrop.cropper('getCanvasData')['left'];
        var canvasTop = imgCrop.cropper('getCanvasData')['top'];
        var canvasWidth = imgCrop.cropper('getCanvasData')['width'];
        var canvasHeight = imgCrop.cropper('getCanvasData')['height'];
        // console.log(imgCrop.cropper('getCropBoxData'));
        // console.log(imgCrop.cropper('getCanvasData'));
        var url = CROPPER_IMG_URL;
            url += '?file=' + imgCrop.attr('src');
            url += '&cropLeft=' + cropLeft;
            url += '&cropTop=' + cropTop;
            url += '&cropWidth=' + cropWidth;
            url += '&cropHeight=' + cropHeight;

            url += '&canvasLeft=' + canvasLeft;
            url += '&canvasTop=' + canvasTop;
            url += '&canvasWidth=' + canvasWidth;
            url += '&canvasHeight=' + canvasHeight;
            url += '&path=' + path;

        $.get(url, function(data){
            if(data.status == 0){
                toastr.error(data.msg);
            }else{
                $('#btnCropOK').removeAttr('disabled').html('剪切');
                setImgValue(data.src);
                $('#btnCropCancle').click();
            }
        });
    })
    $('.btns, .img-container').hide();
}

function cropper(){
    minWidth = 320;
    minHeight = 80;
    maxWidth = 640;
    maxHeight = 640;
    defaultWidth = 480;
    defaultHeight = 320;
    imgCrop = $('.img-container>img');
    imgCrop.cropper({
        aspectRatio: 1.7/1,
        minCropBoxWidth: minWidth,
        minCropBoxHeight: minHeight,
        cropBoxResizable: true,
        data: {"left": 0,"top": 0,"width": defaultWidth,"height": defaultHeight},
        cropend: function(e){
            // 超出大小时, 重新修定大小
            var currentWidth = imgCrop.cropper('getCropBoxData')['width'];
            var currentHeight = imgCrop.cropper('getCropBoxData')['height'];
            if(currentWidth > maxWidth){
                imgCrop.cropper('setCropBoxData', {"width":maxWidth});
            }
            if(currentHeight > maxHeight){
                imgCrop.cropper('setCropBoxData', {"height":maxHeight});
            }
        },
    });
}

/**
 * 上传文件（附件） 
 * 注意：该上传仅用于模板的图片和文件上传
 * btnUpload: 上传按钮的ID
 * inputImg: 保存图片路径的input ID
 * savePath: 指定存放在服务器上的路径
 * item: 一个页面上传多个图片时的标识
 * type:表示模板的类型
 */
function ajaxUploadAll(btnUpload, inputImg, savePath, item, type, photoAccessInfo, vidioAccessInfo, flag, saveTruePath){
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
            if ( (type == 0) || (type == 2) || (type == 5) ) { // 文章分类 0 背景介绍 1 二维码模板 2 实例分享模板 3 收藏夹模板 4 首页模板 5 解决方案模板
                if(!(ext && /^(jpg|png|gif|jpeg|mp4)$/.test(ext.toLowerCase()))){
                    toastr.error('文件格式不支持, 请上传jpg, png, gif, jpeg, mp4格式文件');  
                    return false;
                }                
            } else if( (type == 1) || (type == 3) || (type == 4) ){
                if(!(ext && /^(jpg|gif|jpeg)$/.test(ext.toLowerCase()))){
                    toastr.error('图片格式不支持, 请上传jpg, png, gif, jpeg格式图片');  
                    return false;
                }
            }
            this.setData({'oldImg':filename, 'savePath':savePath});
            this.disable();
        },
        onComplete: function(file, response){
            fileExt = (/[.]/.exec(file)) ? /[^.]+$/.exec(file.toLowerCase()) : '';  
            var suffix = fileExt[0]; // 根据文件的后缀名来改变前台的样式和权限控制
//            console.log(suffix);
            json = $.parseJSON($(response).text());
            if(json['status'] == true || json['status'] == 1 || json['status'].toString() == '1'){
                if (suffix == 'png') {
                    $("#file_" + item).show();
                    $("#img" + item).val(json['src']);                    
                    $("#img_" + item).attr('src', json['src']).hide();
                } else {
                    $("#img_" + item).attr('src', json['src']).show();
                    $("#img" + item).val(json['src']);                    
                    $("#file_" + item).hide();
                }
                
                // 获取附件的数量和图片的数量
                var fileCount = 0;
                var imgCount = 0;
                $(".count-suffix").each(function () {
                    var path= $(this).val();
                    suffixExt = (/[.]/.exec(path)) ? /[^.]+$/.exec(path.toLowerCase()) : '';  
                    var pathSuffix = suffixExt[0]; 
                    if ( pathSuffix == 'png') {
                        fileCount++;
                    } else {
                        imgCount++;
                    }
                });    
                if ( (photoAccessInfo !== false) && (vidioAccessInfo !== false)) { // 如果查询到有结果就进行下一步的判断
                    if ( imgCount > photoAccessInfo ) {
                        toastr.error('图片数量超过了限制！');
                        $("#img_" + item).hide();
                    }
                    if ( fileCount > vidioAccessInfo ) {
                        toastr.error('视频数量超过了限制！');    
                        $("#file_" + item).hide();
                    }   
                }
                
                if (suffix !== 'png') {
                    if (flag) {
                        layer.open({
                            type: 2,
                            title: '图片剪切弹出框',
                            shadeClose: true,
                            shade: 0.8,
                            area: ['800px', '500px'],
                            content: "/index.php/Admin/Public/uploadImgCut?src="+json['src']+"&item="+item+"&savePath="+saveTruePath+"" //iframe的url
                        }); 
                    };                    
                }
            }else{
                toastr.error(json['msg'])
            }
            this.enable(); 
        }  
    }); 
}