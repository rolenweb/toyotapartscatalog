<?php

use yii\db\Migration;

/**
 * Handles the creation of table `parts`.
 */
class m161214_074014_create_parts_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%parts}}', [
            'id' => $this->primaryKey(),
            'parts_groups_id' => $this->integer(),
            'pnc' => $this->string(),
            'oem' => $this->string(),
            'required' => $this->string(),
            'period' => $this->string(),
            'name' => $this->string(),
            'applicability' => $this->text(),
            'price' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-parts-oem', '{{%parts}}', 'oem');
    }

    public function down()
    {
        $this->dropIndex('idx-parts-oem', '{{%parts}}');
        $this->dropTable('{{%parts}}');
    }
}
