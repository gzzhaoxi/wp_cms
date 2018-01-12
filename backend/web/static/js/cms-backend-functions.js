

function onCreate (obj, res_url) {
    if(res_url) url_c = res_url;
    $.ajax({
        url: url_c,
        success: function (data) {
            var index = layer.open({
                type: 1,
                title: obj.attr('title'),
                maxmin: true,
                shadeClose: true,
                skin: 'layui-layer-molv',
                area: ['70%', '80%'],
                content: data,
            });
            $("form#w0").bind('submit', function () {

                var $form = $(this);
                $.ajax({
                    url: $form.attr('action'),
                    type: "post",
                    data: $form.serialize(),
                    success: function (data) {
                        layer.msg(data.err_msg);
                    }
                }).always(function () {
                    //clearTimeout(index);
                });
                return false;
            });
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("请求发生（Ajax）错误:" + textStatus + ' : ' + errorThrown);
        },
        complete: function (XMLHttpRequest, textStatus) {
        }
    });
}

function submitForm(){
    //先得到当前iframe层的索引
    var index = parent.layer.getFrameIndex(window.name);
    //alert(parent.$('#pjax'));

    var $form = $("form#w0");
    $.ajax({
        url: $form.attr('action'),
        type: "post",
        data: $form.serialize(),
        success: function (data) {
            if(data.err_msg){
                layer.msg(data.err_msg);
            }else{
                parent.layer.close(index);
                parent.reload();
            }

        }
    }).always(function () {
        //clearTimeout(index);
    });
    return false;


}

//
function onUpdate (id, obj) {

    $.ajax({
        url: url_u + id,
        success: function (data) {
            layer.open({
                type: 1,
                title: obj.attr('title'),
                maxmin: true,
                shadeClose: true,
                skin: 'layui-layer-molv',
                area: ['70%', '80%'],
                content: data,
            });//[name=edit]
            $("form#w0").bind('submit', function () {
                /*
                 var index = parent.layer.load(1, {
                 shade: [0.1,'red'] //0.1透明度的白色背景
                 });*/
                var $form = $(this);
                $.ajax({
                    url: $form.attr('action'),
                    type: "post",
                    data: $form.serialize(),
                    success: function (data) {
                        layer.msg(data.err_msg);
                    }
                }).always(function () {
                    //clearTimeout(index);
                });
                return false;
            });
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("请求发生（Ajax）错误:" + textStatus + ' : ' + errorThrown);
        },
        complete: function (XMLHttpRequest, textStatus) {
        }
    });
}

//
function onDetail(url, obj){
    $.ajax({
        url: url,
        success: function (data) {
            layer.open({
                type: 1,
                title: obj.attr('title'),
                maxmin: true,
                shadeClose: true,
                skin: 'layui-layer-molv',
                area: ['70%', '80%'],
                content: data,//$("#addForm").html(),
            });
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("请求发生（Ajax）错误:" + textStatus + ' : ' + errorThrown);
        },
        complete: function (XMLHttpRequest, textStatus) {
        }
    });
}

//
function onAssign(id, obj){
    //alert(obj.attr('title')+ obj.attr('name')+'-form');


    /*  */
    $.ajax({
        url: pms_url + id,
        success: function (data) {
            layer.open({
                type: 1,
                title: obj.attr('title'),
                maxmin: true,
                shadeClose: true,
                skin: 'layui-layer-molv',
                area: ['70%', '80%'],
                content: data,
            });
            $("form[name=edit]").bind('submit', function () {
                var $form = $(this);
                $.ajax({
                    url: $form.attr('action'),
                    type: "post",
                    data: $form.serialize(),
                    success: function (data) {
                        layer.msg(data.err_msg);
                    }
                }).always(function () {
                    //clearTimeout(index);
                });
                return false;
            });

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("请求发生（Ajax）错误:" + textStatus + ' : ' + errorThrown);
        },
        complete: function (XMLHttpRequest, textStatus) {
        }
    });

}



//
function onChange(obj, id){
    swal({
        title: '信息提示:',
        text: '您确定要改变当前记录的状态吗?',
        type: "warning",//“warning”，“error”，“success”和“info”, question
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: '取消',
        confirmButtonText: '确定',
        closeOnConfirm: false
    });
    alert(obj.val());
}