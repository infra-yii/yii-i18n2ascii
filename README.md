yii-i18n2ascii
==============

Yii extension to handle transliteration and some kind of internationalization.

=Usage=

Add submodule:

`git add submodule git://github.com/alari/yii-i18n2ascii.git protected/extensions/i18n2ascii`

Register the component:

```
'i18n2ascii' => array(
       'class' => 'application.extensions.i18n2ascii.I18n2ascii'
)
```

Use it in your modeles or directly:

```
public function beforeSave()
  {
   if(Yii::app()->getComponent("i18n2ascii")) {
       Yii::app()->getComponent("i18n2ascii")->setModelUrlAlias($this, $this->title);
   }
   return true;
  }
```

You can use Drupal i18n2ascii files to extend transliteration rules. Place additional files into your `messages` folder.