<?php

namespace DotPlant\TinyMCE;

use Yii;
use yii\helpers\Json;
use yii\helpers\Url;

class TinyMCEWidget extends \dosamigos\tinymce\TinyMce
{
    public function run()
    {
        $module = Yii::$app->getModule('elfinder');
        if ($module) {
            // elfinder exists!
            \mihaildev\elfinder\Assets::noConflict($this->getView());
            $elfinderUrl = Json::encode(Url::to(['/elfinder/frame']));
            $this->clientOptions['file_browser_callback'] = new \yii\web\JsExpression(
                <<<JS
function (field_name, url, type, win) {
  tinymce.activeEditor.windowManager.open({
    file: $elfinderUrl,// use an absolute path!
    title: 'elFinder',
    width: 900,
    height: 450,
    resizable: 'yes'
  }, {
    setUrl: function (url) {

      win.document.getElementById(field_name).value = url.url;
      var evt = document.createEvent("HTMLEvents");
      evt.initEvent("change", false, true);
      win.document.getElementById(field_name).dispatchEvent(evt);
    }
  });
  return false;
}
JS
);
        }
        return parent::run();
    }
}