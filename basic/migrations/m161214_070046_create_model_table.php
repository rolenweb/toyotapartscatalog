<?php

use yii\db\Migration;

/**
 * Handles the creation of table `model`.
 */
class m161214_070046_create_model_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%model}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-model-title', '{{%model}}', 'title');
    }

    public function down()
    {
        $this->dropIndex('idx-model-title', '{{%model}}');
        $this->dropTable('{{%model}}');
    }
}
