layui.use(['layer'])
$.common={
    //表单提交
    submitForm:function(obj,is_reload){
        var select_query = typeof obj==='object' ? obj : $("#form");
        is_reload =  is_reload!==undefined;
        sendAjax(select_query.attr('action'),select_query.serialize(),'post',()=>{
            if(is_reload){
                window.location.reload()
            }else{
                //返回上一个页面
                var redirect_url = redirectMode();
                if(redirect_url.length>0){
                    window.location.href=redirect_url
                }else{
                    window.location.reload()
                }
            }

        })
    },
    //待确定请求动作
    waitConfirm:function(tip_msg,url,data,type,func){
        //默认请求成功指定动作
        func = typeof func ==='function' ? func:()=>{
            //默认刷新页面
            window.location.reload()
        }
        layer.confirm(tip_msg,function(){

            sendAjax(url,data,type,func)
        })
    },
    //文件上传
    fileUpload:function(upload,elem,func){
        //执行实例
        var uploadInst =  upload.render({
            elem: elem //绑定元素
            ,done: function(res){
                //上传完毕回调
                var item = this.item;
                if(res.code===1){
                    //上传成功
                    if(func!==false){
                        //默认请求成功指定动作
                        func = typeof func ==='function' ? func:(res,query_select)=>{
                            //默认
                            // console.log(res)
                            // console.log(query_select.parents().html())

                            //保存图片路径
                            query_select.prev().val(res.path)
                            query_select.parent().find('img').attr('src',res.path)
                        }
                        //执行函数
                        func(res,$(item))
                    }

                }else{
                    layui.layer.msg(res.msg)
                }
            }
            ,error: function(){
                //请求异常回调
                layui.layer.msg('上传异常!  ')
            }
        });
        return uploadInst
    }
}

//发送请求
function sendAjax(url,data,type,func){
    type = (typeof type===undefined)||(typeof type==='undefined')?'get':type
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

//获取上一个页面
function redirectMode(){
    //获取当前域名  window.location.host
    var referrer = '';
    if(document.referrer.length>0 && document.referrer.indexOf(window.location.host)>-1){
        //说明在当前域名下操作
        referrer  = document.referrer;
    }

    return referrer
}
