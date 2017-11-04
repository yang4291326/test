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
                    toastr.error('文件格式不支持, 请上传jpg, png, gif, jpeg, mp401格式文件');  
                    return false;
                }        
                if (ext === 'mp4') {
                    goSavePath = 'Article'; // 如果是视频的话就直接上传到定义好的目录下                    
                } else {
                    goSavePath = 'Article';
                }
            } else if( (type == 1) || (type == 3) || (type == 4) ){

                if(!(ext && /^(jpg|gif|jpeg|png)$/.test(ext.toLowerCase()))){
                    toastr.error('图片格式不支持, 请上传jpg, png, gif, jpeg格式图片');
                    return false;
                }
                goSavePath = 'Article';
            }
            this.setData({'oldImg':filename, 'savePath':goSavePath});
            this.disable();
        },
        onComplete: function(file, response){
            //console.log(file);
            fileExt = (/[.]/.exec(file)) ? /[^.]+$/.exec(file.toLowerCase()) : '';
            //console.log(fileExt);  
            var suffix = fileExt[0]; // 根据文件的后缀名来改变前台的样式和权限控制
            //console.log(suffix);
            json = $.parseJSON($(response).text());
            if(json['status'] == true || json['status'] == 1 || json['status'].toString() == '1'){
                if (suffix == 'mp4') {
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
                    if ( pathSuffix == 'mp4') {
                        fileCount++;
                    } else {
                        imgCount++;
                    }
                });    
                if ( (photoAccessInfo !== false) && (vidioAccessInfo !== false)) { // 如果查询到有结果就进行下一步的判断
                    if ( imgCount > photoAccessInfo ) {
                        toastr.error('图片数量超过了限制！');
                        $("#img_" + item).hide();
                        $("#img" + item).val('');
                        this.enable();
                        return;
                    }
                    if ( fileCount > vidioAccessInfo ) {
                        toastr.error('视频数量超过了限制！');    
                        $("#file_" + item).hide();
                        $("#img" + item).val('');
                        this.enable();
                        return;
                    }   
                }
                
                if (suffix !== 'mp4') {
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
                }
            }else{
                toastr.error(json['msg'])
            }
            this.enable(); 
        }  
    }); 
}