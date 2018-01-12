<?php


use backend\widgets\ActiveForm;
use yii\helpers\Url;
use common\widgets\JsBlock;
// use backend\assets\ArtTemplateAsset;
// ArtTemplateAsset::register($this);
$model->parent_id = 0;
$this->title = yii::t('app', 'Areas Config');
$this->description = yii::t('app', 'Areas Config');
$this->params['breadcrumbs'][] = $this->title;
?>
<table class="table table-striped table-bordered table-hover" width="100%"><thead>
<tr>
<th style="text-align:center; border-bottom: 1px solid #ddd" width="180px">名称</th>
<th style="text-align:center; border-bottom: 1px solid #ddd" width="60px">排序</th>
<th style="text-align:center; border-bottom: 1px solid #ddd" width="160px">操作</th></tr>
</thead>
<tbody id="area_box"></tbody>
</table>
<?php JsBlock::begin() ?>


<script>
$(document).ready(function () {
    	var firstData = <?php echo json_encode($provincelist);?>;
    	for(var item in firstData)
    	{
    		$('#area_box').append(getHtml(firstData[item],0));
    	}
    	$("#addForm").append('<input type="hidden" id="areas-level" value="0">');
    });
function getHtml(item,level){
	var str = '';
	str += '<tr id="area_'+ item.area_id+'" name="parent_'+item.parent_id+'">';
	
	str += '<td height="40" ';
	if(level > 0){
			str += 'style="padding-left:'+(level*60)+'px"';
		}
	str += '>';
	
	str += '<a style="float:left;line-height: 33px;" href="javascript:toggleArea('+item.area_id+','+(level+1)+');"><img id="ctrl_'+item.area_id+'" name="box_'+item.parent_id+'" src="/static/images/open.gif" is_open="no" is_cache="no" /></a>';
	str += '<input type="text"  value="'+item.area_name+'" name="area_name" class="form-control" style="width:150px" onblur="updateArea('+item.area_id+',this);" />';
	str += '</td>';
	str += '<td><input type="text" value="'+item.sort+'" name="area_sort" class="form-control" style="width:80px" onblur="updateArea('+item.area_id+',this);" /></td>';
	str += '<td align="center">';
	str += '<a href="javascript:addArea('+item.area_id+','+(level+1)+');"><img class="operator" src="/static/images/icon_add.gif" alt="添加" /></a>&nbsp;&nbsp;&nbsp;&nbsp;';
	str += '<a href="javascript:delArea('+item.area_id+');"><img class="operator" src="/static/images/icon_del.gif"  alt="删除" /></a>';
	str += '</td>';
	str += '</tr>'
	return str;
}
//切换地区
function toggleArea(area_id,level)
{
	var is_cache = $('#ctrl_'+area_id).attr('is_cache');
	var is_open  = $('#ctrl_'+area_id).attr('is_open');

	//缓存存在
	if(is_cache == 'yes')
	{
		$('[name="parent_'+area_id+'"]').toggle();
	}
	else
	{
		$.ajax({
            url: '<?=Url::to('/tools/areachild')?>',
            type: 'POST',
            dataType: 'json',
            data: {aid: area_id},
            success: function (data) {
            	for(var item in data)
    			{
    				$('#area_'+area_id).after(getHtml(data[item],level));
    			}
            }
        });
        
		$('#ctrl_'+area_id).attr('is_cache','yes');
	}

	//是否已经展开
	if(is_open == 'yes')
	{
		$('#ctrl_'+area_id).attr('src','/static/images/open.gif');
		$('#ctrl_'+area_id).attr('is_open','no');

		//递归子分类
		$("img[name='box_"+area_id+"'][is_open='yes']").each(function()
		{
			var idValue = $(this).attr('id').replace("ctrl_","");
			toggleArea(idValue);
		});
	}
	else
	{
		$('#ctrl_'+area_id).attr('src','/static/images/close.gif');
		$('#ctrl_'+area_id).attr('is_open','yes');
	}
}

//添加地区
function addArea(area_id,level)
{
	$("#areas-parent_id").val(area_id);
	$("#areas-level").val(level);
	layer.open({
        type: 1,
        title: '<?=yii::t('app', 'Add Area')?>',
        maxmin: true,
        shadeClose: true, //点击遮罩关闭层
        area: ['70%', '80%'],
        content: $("#addForm").html(),
    });
}

function checkArea(){

	 var area_name = $(".layui-layer #areas-area_name").val();
	 var parent_id = $("#areas-parent_id").val();
	 var level = $("#areas-level").val();
		if(area_name == '')
		{
			alert('请填写地域名称');
			return false;
		}
		$.ajax({
            url: '<?=Url::to('/areas/area-update')?>',
            type: 'POST',
            dataType: 'json',
            data: {parent_id: parent_id,area_name:area_name},
            success: function (data) {
            	if(parent_id == 0)
				{
					window.location.reload();
					return false;
				}

				var is_open  = $('#ctrl_'+parent_id).attr('is_open');
				if(is_open == 'yes')
				{
					$('#area_'+parent_id).after(getHtml(data.data,level));
				}
				else
				{
					toggleArea(parent_id,level);
				}
				layer.closeAll();
            }
        });
        return false;
}


//删除地区
function delArea(area_id)
{
	if(confirm("确定要删除么？"))
	 {
		$.getJSON('<?=Url::to('/areas/area-del')?>',{'area_id':area_id},function(result){$('#area_'+area_id).remove();})
	 }
}

//更新地域数据
function updateArea(area_id,obj)
{
	if($.trim(obj.value) == '')
	{
		alert('地域信息不能为空');
		return;
	}

	var sendData = {"area_id":area_id};
	switch(obj.name)
	{
		case "area_sort":
		{
			sendData.area_sort = obj.value;
		}
		break;

		default:
		{
			sendData.area_name = obj.value;
		}
		break;
	}
	$.ajax({
        url: '<?=Url::to('/areas/area-update')?>',
        type: 'POST',
        dataType: 'json',
        data: sendData,
        success: function (data) {
        	
        }
    });
}
</script>
<?php JsBlock::end() ?>
<div class="hide" id="addForm">
    <div class="ibox-content">
        <?php
        $model->area_name = '';
                $form = ActiveForm::begin(['action' => Url::to(['/areas/area-create']),'options' => ["onsubmit"=>"return checkArea();"]]);
                echo $form->field($model, 'area_name')->textInput();
                echo $form->field($model,'parent_id')->label('')->hiddenInput();
//                 echo $form->field($model, 'level')->hiddenInput();
                echo $form->defaultButtons();
                ActiveForm::end();
        ?>
    </div>
</div>
