<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAdmin extends Model
{
//    public function TotalBuku()
//     {
//         return $this->db->table('tbl_buku')
//             ->countAllResults();
//     }

    public function TotalUser()
    {
        return $this->db->table('tbl_user')
            ->countAllResults();
    }
    // public function TotalEBook()
    // {
    //     return $this->db->table('tbl_ebook')
    //         ->countAllResults();
    // }
}
