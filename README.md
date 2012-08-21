yii-i18n2ascii
==============

Yii extension to handle transliteration and some kind of internationalization.

Usage
====

Add submodule:

`git submodule add git://github.com/alari/yii-i18n2ascii.git protected/extensions/i18n2ascii`

Or download it and place to `protected/extensions/i18n2ascii` folder.

Register the component:

```php
<?
'i18n2ascii' => array(
       'class' => 'application.extensions.i18n2ascii.I18n2ascii'
)
```

Use it in your modeles or directly:

```php
<?
public function beforeSave()
  {
   if(Yii::app()->getComponent("i18n2ascii")) {
       Yii::app()->getComponent("i18n2ascii")->setModelUrlAlias($this, $this->title);
   }
   return true;
  }
```

Or you may use it as a behaviour:

```php
<?
        public function behaviors()
        {
            $behaviors = parent::behaviors();
            $behaviors['imagesHolder'] = array(
                'class' => 'ext.i18n2ascii.I18n2asciiBehavior',
                //'pathSourceAttr' => 'title'
            );
            return $behaviors;
        }
```

You can use Drupal i18n2ascii files to extend transliteration rules. Place additional files into your `messages` folder.