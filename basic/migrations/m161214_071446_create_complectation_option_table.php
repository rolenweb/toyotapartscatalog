<?php

use yii\db\Migration;

/**
 * Handles the creation of table `complectation_option`.
 */
class m161214_071446_create_complectation_option_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%complectation_option}}', [
            'id' => $this->primaryKey(),
            'complectation_id' => $this->integer(),
            'title' => $this->string(),
            'description' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%complectation_option}}');
    }
}
