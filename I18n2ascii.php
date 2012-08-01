<?php
/**
 * @author alari
 * @since 7/23/12 3:07 PM
 *
 * Usage:
 * <code>
 * public function beforeSave()
 * {
 *  if(Yii::app()->getComponent("i18n2ascii")) {
 *      Yii::app()->getComponent("i18n2ascii")->setModelUrlAlias($this, $this->title);
 *  }
 *  return true;
 * }
 * </code>
 *
 * <code>
 * 'i18n2ascii' => array(
 *      'class' => 'application.extensions.i18n2ascii.I18n2ascii'
 * )
 * </code>
 */
class I18n2ascii extends CComponent
{
    private $map = Array();
    private $mapsDir = "protected/messages/";

    public function init() {}

    public function setModelUrlAlias(CActiveRecord $model, $path, $attr="path", $stringSuffix = "p") {
        if (!$model->$attr) {
            $model->$attr = $this->convertToUrl($path);

            if(is_numeric($model->$attr)) $this->$attr .= $stringSuffix;

            while ($model->countByAttributes(array($attr => $model->$attr))) $model->$attr .= rand(0, 9);
        }
    }

    public function convertToUrl($string)
    {
        return preg_replace('/[^A-Za-z0-9_\-]/', '', $this->convertToAscii($string));
    }

    public function convertToAscii($string)
    {
        if (!count($this->map)) {
            self::loadMap();
        }
        if (!count($this->map)) {
            return $string;
        }
        return strtr(trim($string), $this->map);
    }

    private function loadMap()
    {
        $files = array_merge(glob(dirname(__FILE__) . "/*.txt"), glob($this->mapsDir . "*.txt"));
        if(!is_array($files) || !count($files)) return;

        foreach ($files as $fn) {
            $this->map = array_merge($this->map, parse_ini_file($fn));
        }
        $this->map[" "] = "-";
    }
}
