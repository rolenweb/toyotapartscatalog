<?php

use yii\db\Migration;

/**
 * Handles the creation of table `link`.
 */
class m161213_153338_create_link_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%link}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),//->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->integer(),//->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('idx-link-url', '{{%link}}', 'url');
    }

    public function down()
    {
        $this->dropIndex('idx-link-url', '{{%link}}');
        $this->dropTable('{{%link}}');
    }
}
