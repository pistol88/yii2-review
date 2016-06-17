<?php

use yii\db\Schema;
use yii\db\Migration;

class m160617_115412_Mass extends Migration {

    public function safeUp() {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        else {
            $tableOptions = null;
        }
        $connection = Yii::$app->db;
        try {
            $this->createTable('{{%review}}', [
                'id' => Schema::TYPE_PK . "",
                'user_id' => Schema::TYPE_INTEGER . "(11)",
                'name' => Schema::TYPE_STRING . "(255)",
                'text' => Schema::TYPE_TEXT . " NOT NULL",
                'date' => Schema::TYPE_DATETIME . "",
                'active' => "enum('yes','no')" . " NOT NULL DEFAULT 'no'",
                'item_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
                'pluses' => Schema::TYPE_TEXT . " NOT NULL",
                'minuses' => Schema::TYPE_TEXT . " NOT NULL",
                'vote' => Schema::TYPE_SMALLINT . "(3)",
                ], $tableOptions);

        } catch (Exception $e) {
            echo 'Catch Exception ' . $e->getMessage() . ' ';
        }
    }

    public function safeDown() {
        $connection = Yii::$app->db;
        try {
            $this->dropTable('{{%review}}');
        } catch (Exception $e) {
            echo 'Catch Exception ' . $e->getMessage() . ' ';
        }
    }

}
