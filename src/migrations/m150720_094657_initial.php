<?php

use yii\db\Schema;
use yii\db\Migration;

class m150720_094657_initial extends Migration
{
    public function up()
    {
        $this->insert('{{%wysiwyg}}', [
            'name' => 'TinyMCE',
            'class_name' => 'dosamigos\tinymce\TinyMce',
            'params' => \yii\helpers\Json::encode([
                'options' => ['rows' => 6],
                'clientOptions' => [
                    'plugins' => [
                        "advlist autolink lists link charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table contextmenu paste"
                    ],
                    'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
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
