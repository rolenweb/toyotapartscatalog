<?php

use yii\db\Migration;

/**
 * Handles the creation of table `frame`.
 */
class m161214_070320_create_frame_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%frame}}', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer(),
            'title' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-frame-title', '{{%frame}}', 'title');
    }

    public function down()
    {
        $this->dropIndex('idx-frame-title', '{{%frame}}');
        $this->dropTable('{{%frame}}');
    }
}
