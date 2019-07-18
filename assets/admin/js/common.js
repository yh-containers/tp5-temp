layui.use(['layer'])
$.common={
    //表单提交
    submitForm:function(obj){
        var select_query = typeof obj==='object' ? obj : $("#form")
        sendAjax(select_query.attr('action'),select_query.serialize(),'post',()=>{
            //返回上一个页面
            history.back();
        })
    },
}

//发送请求
function sendAjax(url,data,type,func){
    type = typeof type==='undefined'?'get':type
    type = type.toLowerCase()==='get'?'get':'post'
    var layer_load
    $.ajax({
        url:url,
        type:type,
        data:data,
        beforeSend:function(res){
            layer_load = layui.layer.load()
            // console.log(res)
            // console.log('beforeSend')
        },
        success:function(res){
            // console.log(res)
            // console.log('success')
            layui.layer.msg(res.msg)
            if(res.code===1){
                //成功
                typeof func ==='function' && setTimeout(func,1000)
            }else{
                //失败

            }
        },
        error:function(res){
            // console.log(res)
            console.log('error')
        },
        complete:function(res,ts){
            layui.layer.close(layer_load)
            // console.log(res)
            // console.log(ts)
            console.log('complete')
        }
    })
}