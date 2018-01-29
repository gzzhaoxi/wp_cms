<?php
use common\models\Article;
use common\models\Plan;
use common\models\Ads;
/* @var $this yii\web\View */

$this->title = 'FAQ';
?>
<link id="layuicss-layer" rel="stylesheet" href="/layui/css/layui.css" media="all">
<div id="pricing" class="pricing-section">
  <div class="container">
    <div class="row">
        <div class="layui-collapse" lay-accordion="">
        <?php if ($list):?>
        <?php foreach ($list as $l):?>
  <div class="layui-colla-item">
    <h2 class="layui-colla-title"><?=$l['title']?></h2>
    <div class="layui-colla-content layui-show">
      <p><?=$l['content']?></p>
    </div>
  </div>
  <?php endforeach;?>
  <?php endif;?>
</div>
    </div>
  </div>
</div>
<script src="/layui/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
layui.use(['element', 'layer'], function(){
  var element = layui.element;
  var layer = layui.layer;
  
  //监听折叠
  element.on('collapse(test)', function(data){
    layer.msg('展开状态：'+ data.show);
  });
});
</script>