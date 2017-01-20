<?php

use yii\db\Migration;

/**
 * Handles the creation of table `parts_groups`.
 */
class m161214_072548_create_parts_groups_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%parts_groups}}', [
            'id' => $this->primaryKey(),
            'complectation_id' => $this->integer(),
            'type' => $this->smallInteger(),
            'title' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
        
    }

    public function down()
    {
        $this->dropTable('{{%parts_groups}}');
    }
}
