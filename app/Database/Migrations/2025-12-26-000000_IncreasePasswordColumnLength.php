<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IncreasePasswordColumnLength extends Migration
{
    public function up()
    {
        // Ubah kolom password menjadi VARCHAR(255)
        $this->forge->modifyColumn('tbl_user', [
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
        ]);
    }

    public function down()
    {
        // Kembalikan ke ukuran semula (jika perlu)
        $this->forge->modifyColumn('tbl_user', [
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
        ]);
    }
}
