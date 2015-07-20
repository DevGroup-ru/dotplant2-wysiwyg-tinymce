<?php

use yii\db\Schema;
use yii\db\Migration;

class m150720_094657_initial extends Migration
{
    public function up()
    {
        $this->insert('{{%wysiwyg}}', [
            'name' => 'TinyMCE',
            'class_name' => 'DotPlant\TinyMCE\TinyMCEWidget',
            'params' => \yii\helpers\Json::encode([
                'options' => ['rows' => 22],
                'clientOptions' => [
                    'menubar' => false,
                    'toolbar_items_size' => 'small',
                    'plugins' => [
                        "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern",
                        "imagetools"

                    ],
                    'toolbar1' => "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
                    'toolbar2' => "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
                    'toolbar3' => "table | hr removeformat | subscript superscript | charmap | fullscreen | ltr rtl | spellchecker | nonbreaking template pagebreak",
                    'relative_urls' => false,
                    'remove_script_host' => true,
                ],
            ]),
            'configuration_model' => 'DotPlant\TinyMCE\components\ConfigurationModel',
            'configuration_view' => '@ckeditor/views/tinymce-config.php',
        ]);

        $this->insert(
            '{{%configurable}}',
            [
                'module' => 'WysiwygTinyMCE',
                'sort_order' => 99,
                'section_name' => 'TinyMCE WYSIWYG',
                'display_in_config' => 0,
            ]
        );
    }

    public function down()
    {
        $this->delete('{{%wysiwyg}}', ['name' => 'TinyMCE']);
        $this->delete('{{%configurable}}', ['module' => 'WysiwygTinyMCE']);
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
