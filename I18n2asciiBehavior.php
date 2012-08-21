<?php
/**
 * @author alari
 * @since 8/21/12 3:51 PM
 */
class I18n2asciiBehavior extends CActiveRecordBehavior
{
    public $pathAttr = "attr";
    public $pathSourceAttr = "title";
    public $stringSuffix = "p";

    public function beforeSave($event) {
        $model = $this->owner;
        if (!$model->{$this->pathAttr}) {
            $model->{$this->pathAttr} = $this->convertToUrl($model->{$this->pathSourceAttr});

            if(is_numeric($model->{$this->pathAttr})) $this->{$this->pathAttr} .= $this->stringSuffix;

            while ($model->countByAttributes(array($this->pathAttr => $model->{$this->pathAttr}))) $model->{$this->pathAttr} .= rand(0, 9);
        }
    }

    private function convertToUrl($str) {
        Yii::app()->getModule("i18n2ascii")->convertToUrl($str);
    }
}
