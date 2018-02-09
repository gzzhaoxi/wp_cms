<?php
/**
 * Author: gzzhaoxi@gmail.com
 */

namespace backend\widgets;

use Yii;
use yii\helpers\Html;

class ActiveField extends \yii\widgets\ActiveField
{

    public $options = [
        'class' => 'form-group'
    ];

    public $labelOptions = [
        //'class' => 'col-sm-2 control-label',
        'class' => 'control-label col-xs-12 col-sm-2',
    ];

    public $size = '8';
    //public $xs_size = '12';
    //col-xs-12 col-sm-8
    //"{label}\n<div class=\"col-sm-{size} col-xs-12\">{input}\n{error}</div>\n{hint}";原始模板
    //{hint}值修改位置 /vendor/yiisoft/yii2/message/ZH-CN/yii.php
    public $template = "{label}\n<div class='col-sm-{size} col-xs-12'>{input}{hint}</div>\n{error}";

    public $errorOptions = [
        'class' => 'help-block m-b-none'
    ];


    public function init()
    {
        parent::init();

        if( !isset($this->options['class']) ){
            $this->options['class'] = 'form-group';
        }

        if(!isset($this->labelOptions['class'])){
            $this->labelOptions['class'] = 'col-sm-2 control-label';
        }

        if(!isset($this->errorOptions['class'])){
            $this->errorOptions['class'] = 'help-block m-b-none';
        }
    }


    public function render($content = null)
    {
        if ($content === null) {
            /*
            if (! isset($this->parts['{input}'])) {
                $this->parts['{input}'] = Html::activeTextInput($this->model, $this->attribute, $this->inputOptions);
            }
            if (! isset($this->parts['{label}'])) {
                $this->parts['{label}'] = Html::activeLabel($this->model, $this->attribute, $this->labelOptions);
            }
            if (! isset($this->parts['{error}'])) {
                $this->parts['{error}'] = Html::error($this->model, $this->attribute, $this->errorOptions);
            }
            if (! isset($this->parts['{hint}'])) {
                $this->parts['{hint}'] = '';
            }

            $this->parts['{size}'] = $this->size;
            $content = strtr($this->template, $this->parts);
            */

            if (! isset($this->parts['{input}'])) {
                $this->parts['{input}'] = Html::activeTextInput($this->model, $this->attribute, $this->inputOptions);
            }
            if (! isset($this->parts['{label}'])) {
                if( $this->model->isAttributeRequired($this->attribute) && ( !isset( $this->labelOptions['requiredSign'] ) || $this->labelOptions['requiredSign'] ) ){
                    $requiredSign = !isset( $this->labelOptions['requiredSign'] ) ? "<span style='color:red'>*</span> " : $this->labelOptions['requiredSign'];
                    $this->labelOptions['label'] = $requiredSign . ( isset( $this->labelOptions['label'] ) ? $this->labelOptions['label'] : $this->model->getAttributeLabel($this->attribute) );
                }
                $this->parts['{label}'] = Html::activeLabel($this->model, $this->attribute, $this->labelOptions);
            }
            if (! isset($this->parts['{error}'])) {
                $this->parts['{error}'] = Html::error($this->model, $this->attribute, $this->errorOptions);
            }
            if (! isset($this->parts['{hint}'])) {
                $this->parts['{hint}'] = '';
            }

            $this->parts['{size}'] = $this->size;
            $content = strtr($this->template, $this->parts);

        } elseif (! is_string($content)) {
            $content = call_user_func($content, $this);
        }

        return $this->begin() . "\n" . $content . "\n" . $this->end();
    }

    public function checkbox($options = [], $enclosedByLabel = true)
    {
        $options = array_merge($this->inputOptions, $options);
        return parent::checkbox($options, $enclosedByLabel);
    }

    public function dropDownList($items, $options = [], $generateDefault = true)
    {
        if ($generateDefault === true && ! isset($options['prompt'])) {
            $options['prompt'] = yii::t('app', 'pub_please_select');
        }
        return parent::dropDownList($items, $options);
    }

    public function reayOnly($value = null, $options = [])
    {
        $options = array_merge($this->inputOptions, $options);

        $this->adjustLabelFor($options);
        $value = $value === null ? Html::getAttributeValue($this->model, $this->attribute) : $value;
        $options['class'] = 'da-style';
        $options['style'] = 'display: inline-block;';
        $this->parts['{input}'] = Html::activeHiddenInput($this->model, $this->attribute) . Html::tag('span', $value, $options);

        return $this;
    }

    public function radioList($items, $options = [])
    {
        $options['tag'] = 'div';

        $inputId = Html::getInputId($this->model, $this->attribute);
        $this->selectors = ['input' => "#$inputId input"];

        $options['class'] = 'radio';
        $encode = ! isset($options['encode']) || $options['encode'];
        $itemOptions = isset($options['itemOptions']) ? $options['itemOptions'] : [];

        $options['item'] = function ($index, $label, $name, $checked, $value) use ($encode, $itemOptions) {
            static $i = 1;
            $radio = Html::radio($name, $checked, array_merge($itemOptions, [
                'value' => $value,
                'id' => $name . $i,
                //'label' => $encode ? Html::encode($label) : $label,
            ]));
            $radio .= "<label for=\"$name$i\"> $label </label>";
            $radio = "<div class='radio radio-info radio-inline'>{$radio}</div>";
            //var_dump($radio);die;
            $i++;
            return $radio;
        };
        return parent::radioList($items, $options);
    }

    public function checkboxList($items, $options = [])
    {

        $options['tag'] = 'ul';

        $inputId = Html::getInputId($this->model, $this->attribute);
        $this->selectors = ['input' => "#$inputId input"];

        $options['class'] = 'da-form-list inline';
        $encode = ! isset($options['encode']) || $options['encode'];
        $itemOptions = isset($options['itemOptions']) ? $options['itemOptions'] : [];

        $options['item'] = function ($index, $label, $name, $checked, $value) use ($encode, $itemOptions) {
            $checkbox = Html::checkbox($name, $checked, array_merge($itemOptions, [
                'value' => $value,
                'label' => $encode ? Html::encode($label) : $label,
            ]));

            return '<li>' . $checkbox . '</li>';
        };
        return parent::checkboxList($items, $options);
    }

    public function textarea($options = [])
    {
        if (! isset($options['rows'])) {
            $options['rows'] = 5;
        }
        return parent::textarea($options);
    }

    public function imgInput($options = [])
    {
        $this->template = "{label}\n<div class=\"col-sm-{size} image\">{input}{img}\n{error}</div>\n{hint}";
        $pic = $this->attribute;
        $src = yii::$app->params['site']['url'] . '/static/images/none.jpg';
        if ($this->model->$pic != '') {
            $src = $this->model->$pic;
            $temp = parse_url($src);
            $src = isset($temp['host']) ? $src : yii::$app->params['site']['url'] . $src;
        }
        $this->parts['{img}'] = Html::img($src, $options);
        return parent::fileInput($options); // TODO: Change the autogenerated stub
    }

    public function ueditor($options = [])
    {
        if (! isset($options['rows'])) {
            $options['rows'] = 5;
        }
        $options = array_merge($this->inputOptions, $options);
        $this->adjustLabelFor($options);
        $name = isset($options['name']) ? $options['name'] : Html::getInputName($this->model, $this->attribute);
        if (isset($options['value'])) {
            $value = $options['value'];
            unset($options['value']);
        } else {
            $value = Html::getAttributeValue($this->model, $this->attribute);
        }
        if (! array_key_exists('id', $options)) {
            $options['id'] = Html::getInputId($this->model, $this->attribute);
        }
        //self::normalizeMaxLength($model, $attribute, $options);
        $this->parts['{input}'] = Ueditor::widget(['content' => $value, 'name' => $name, 'id' => $this->attribute]);

        return $this;
    }

    public function ueUpload($options = [],$img_option = []){
        $this->template = "{upload-script}{label}\n<div class=\"col-sm-{size} upload-image\">{input}{a}<div id='image-list'>{img}</div>\n{error}</div>\n{hint}";
        $pic = $this->attribute;
        //$src = 'http://'.$_SERVER['HTTP_HOST']. '/static/images/none.jpg';

        $photo = json_decode($this->model->$pic,true);

        $str_html = '';
        if (!empty($photo) || !empty($this->model->$pic)) {
            if(!empty($options['filed'])){

                $str_html = '';
                if(strrpos($this->model->$pic,'http')!==false){
                    $src =   $this->model->$pic;
                }else{
                    $src =  yii::$app->params['admin']['url'] .'/'. $this->model->$pic;
                }


                //是否存在主图选项
                $str_html.= "<div style='display:inline-block;margin-top:10px'>";
                $str_html.= Html::img($src, $img_option);
                $str_html.=Html::hiddenInput($options['filed'],$this->model->$pic);
               // $str_html.= "<p style='margin-top:8px;text-align:center;cursor:pointer;color:red'><i onclick='deleteImg(this)' class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></i></p>";
                $str_html.= "</div>";
            }else{

                if(empty($photo)){
                    $photo = explode(',', $this->model->$pic);
                }
                $str_html = '';
                foreach($photo as $k=>$v){
                    if(strrpos($v,'http')===false) {
                        $src = yii::$app->params['admin']['url'] . '/' . $v;
                    }else{
                        $src  = $v;
                    }

                    //是否存在主图选项
                    $ext_option = [];

                    $str_html.= "<div style='display:inline-block;margin-top:10px'>";
                    $str_html.= Html::img($src, $img_option);
                    $str_html.=Html::hiddenInput('photo[]',$v);
                    $str_html.= "<p style='margin-top:8px;text-align:center;cursor:pointer;'>
                    <i onclick='moveLeft(this)' style='font-size:20px;color:green' class=\"fa fa-arrow-circle-left\" aria-hidden=\"true\"></i>
                    &nbsp;&nbsp;
                    <i style='font-size:15px;color:red' onclick='deleteImg(this)' class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></i>
                      &nbsp;&nbsp;
                     <i onclick='moveRight(this)' style='font-size:20px;color:green' class=\"fa fa-arrow-circle-right\" aria-hidden=\"true\"></i>
                    </p>";
                    $str_html.= "</div>";
                }
            }

        }
        if(isset($options['id'])){
            $id = $options['id'];
        }else{
            $id = 'upload_ue';
        }

        if(isset($options['ext'])){
            $ext = $options['ext'];
        }else{
            $ext = '';
        }

        $this->parts['{upload-script}'] = '<script type="text/plain" id="'.$id.'"></script>';
        $this->parts['{a}'] = Html::a('<i class="fa fa-upload"></i> 图片上传','javascript:void(0);',
            ['onclick'=>'upImage'.$ext.'()','title' => Yii::t('app', 'btn_bar_create'),
                'class' => 'btn btn-primary btn-add label-button',]);

        $this->parts['{img}'] = $str_html;
        $is_multiple = isset($options['multiple'])?1:0;
        $options = array_merge($options,[]);
        return static::hiddenInput($options); // TODO: Change the autogenerated stub
    }
}