<?php

class TinyMCEWidget extends \dosamigos\tinymce\TinyMce
{
    public function run()
    {
        $module = Yii::$app->getModule('elfinder');
        if ($module) {
            // elfinder exists!
            \mihaildev\elfinder\Assets::noConflict($this->getView());
            $elfinderUrl = yii\helpers\Json::encode(yii\helpers\Url::to(['/elfinder/frame']));
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
      win.document.getElementById(field_name).value = url;
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