<?php

namespace DotPlant\TinyMCE;

use app;
use app\components\ExtensionModule;
use Yii;

class Module extends ExtensionModule
{
    public static $moduleId = 'WysiwygTinyMCE';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'configurableModule' => [
                'class' => 'app\modules\config\behaviors\ConfigurableModuleBehavior',
                'configurationView' => '@tinymce/views/configurable/_config',
                'configurableModel' => 'DotPlant\TinyMCE\components\ConfigurationModel',
            ]
        ];
    }
}
