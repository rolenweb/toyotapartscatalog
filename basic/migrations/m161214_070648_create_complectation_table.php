<?php

use yii\db\Migration;

/**
 * Handles the creation of table `complectation`.
 */
class m161214_070648_create_complectation_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%complectation}}', [
            'id' => $this->primaryKey(),
            'frame_id' => $this->integer(),
            'complectation' => $this->string(),
            'engine' => $this->string(),
            'engine_title' => $this->string(),
            'period' => $this->string(),
            'body' => $this->string(),
            'body_title' => $this->string(),
            'grade' => $this->string(),
            'grade_title' => $this->string(),
            'transm' => $this->string(),
            'transm_title' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        //$this->createIndex('idx-complectation-url', '{{%complectation}}', 'url');
    }

    public function down()
    {
        //$this->dropIndex('idx-complectation-url', '{{%complectation}}');
        $this->dropTable('{{%complectation}}');
    }
}
