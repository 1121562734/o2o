/**
 * Created by Administrator on 2017/8/16. 图片的
 *     //https://www.kancloud.cn/shuiyueju/uploadifycn/79419 学习网址

 */

$(function() {
    //缩略图
    $("#file_upload").uploadify({

        'swf'             : SCOPE.uploadify_swf,
        'uploader'        : SCOPE.image_upload,
        'buttonText'      : '图片上传',
        'fileTypeDesc'    : 'Image files',
        'fileObjName'     : 'file',
        'fileTypeExts'    : '*.gif;*.jpg;*.png',//文件上传格式
        'onUploadSuccess' : function(file, data, response) {
            if(response){
                var obj = JSON.parse(data);
                $("#upload_org_code_img").attr("src",obj.data);
                $("#file_upload_image").attr("src",obj.data);
                $("#upload_org_code_img").show();
            }
        }
    });

//营业执照
    $("#file_upload_other").uploadify({

        'swf'             : SCOPE.uploadify_swf,
        'uploader'        : SCOPE.image_upload,
        'buttonText'      : '图片上传',
        'fileTypeDesc'    : 'Image files',
        'fileObjName'     : 'file',
        'fileTypeExts'    : '*.gif;*.jpg;*.png',//文件上传格式
        'onUploadSuccess' : function(file, data, response) {
            if(response){
                var obj = JSON.parse(data);
                $("#file_upload_image_other").attr("src",obj.data);
                $("#upload_org_code_img_other").attr("src",obj.data);
                $("#file_upload_image_other").show();
            }
        }
    });
});