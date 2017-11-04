/**
 * 上传图片
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
            this.setData({'oldImg':filename, 'saveTruePath':saveTruePath});
            this.disable();
        },
        onComplete: function(file, response){
            json = $.parseJSON($(response).text());
            if(json['status'] == true || json['status'] == 1 || json['status'].toString() == '1'){
                $("#img_" + item).attr('src', json['src']).show();
                $("#img" + item).val(json['src']);
                $('#btn_delete_' + item).show();
                $('#btnUpload' + item).hide();

                // if (flag) {
                //     layer.open({
                //         type: 2,
                //         title: '图片剪切弹出框',
                //         shadeClose: true,
                //         shade: 0.8,
                //         area: ['800px', '500px'],
                //         content: "/index.php/Admin/Public/uploadImgCut?src="+json['src']+"&item="+item+"&savePath="+saveTruePath+"" //iframe的url
                //     }); 
                // };

            }else{
                toastr.error(json['msg'])
            }
            this.enable(); 
        }  
    }); 
}


/**
 * 删除商品、商品详情图片
 **/
function delFile(file, item, message, showpic){
    if(! message) message = "确认删除吗? 此步骤无法恢复!"
    if(! confirm(message)) return false;
    var url;
    if (DELETE_FILE_URL.indexOf('?') > -1) {
        url = DELETE_FILE_URL + "&file="+ file;
    } else {
        url = DELETE_FILE_URL + "?file="+ file;
    }
    if (item != '') {
        var strs = new Array();
        strs = item.split('_');
    }
    $.get(url, function(data){
        if(data.status == 1){
            if (item != '') {
                if (showpic == false) {
                    $('#img_' + item).attr('src', '').hide();
                } else {
                    if (strs[1] == undefined) {
                        $('#img_' + item).attr('src', '/Public/image/default-goods-detail-pic.jpg');
                    } else {
                        $('#img_' + item).attr('src', '/Public/image/color-img-'+ strs[1] +'.jpg');
                    }
                }
            } else {
                $('#img_').attr('src', '').hide();
            }
            $('#img' + item).val('').hide();
            $('#btn_delete_' + item).hide();
            $('#btnUpload' + item).show();
            toastr.success(data.msg);
        }else{
            toastr.error(data.msg)
        }
    })
}

/**
 * 删除商品整行数据
 **/
function delLineFile(obj, k){
    message = "确认删除吗? 此步骤无法恢复!"
    if(! confirm(message)) return false;
    for(var i = 1; i <= 3; i++){
        var item = k + '_' + i;
        var file = $('#img'+ item).val();
        if (file != '') {
            var url;
            if (DELETE_FILE_URL.indexOf('?') > -1) {
                url = DELETE_FILE_URL + "&file="+ file;
            } else {
                url = DELETE_FILE_URL + "?file="+ file;
            }
            var strs = new Array();
            strs = item.split('_');
            $.get(url, function(data){

            });
        }
    }
    $(obj).parents('tr').remove();
}

/**
 * 删除商品详情整行数据
 **/
function delDetailLine(obj, k){
    message = "确认删除吗? 此步骤无法恢复!"
    if(! confirm(message)) return false;
    var file = $('#img'+ k).val();
    if (file != '') {
        var url;
        if (DELETE_FILE_URL.indexOf('?') > -1) {
            url = DELETE_FILE_URL + "&file="+ file;
        } else {
            url = DELETE_FILE_URL + "?file="+ file;
        }
        $.get(url, function(data){

        });
    }
    $(obj).parents('tr').remove();
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
        aspectRatio: NaN,
        minCropBoxWidth: minWidth,
        minCropBoxHeight: minHeight,
        cropBoxResizable: false,
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
