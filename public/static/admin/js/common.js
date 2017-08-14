/**
 * Created by Administrator on 2017/8/9.
 */
/*页面统一添加*/
function o2o_edit(title,url) {
    var index =layer.open({
        type:2,
        title:title,
        content :url
    });
    layer.full(index);
}

function o2o_s_edit(title,url,w,h) {
    layer_show(title,url,w,h);
}

/*删除*/
function o2o_del(url){

    layer.confirm('确认要删除吗?',function(index){

       window.location.href=url;
    });
}
//排序
$('.listorder input').blur(function () {
    //编写我们的抛送的逻辑
    //获取主键id
    var id =$(this).attr('attr-id');
    var listorder =$(this).val();
    var postData ={
        'id':id,
        'listorder':listorder,
    };
    var url = SCOPE.listorder_url;
    //抛送http
    $.post(url,postData,function (result) {
        //判断
        if(result.code==1){
            location.href=result.data;
        }else {
            alert(result.msg);
        }
    })
})