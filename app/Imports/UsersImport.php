<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            User::create([
                'name' =>$row['name'],
                'password' =>$row['password'],
                'nim'=>$row['nim'],
                'fakultas'=>$row['fakultas'],
                'prodi'=>$row['prodi'],
                'email'=>$row['email'],
                'no_hp'=>$row['no_hp'],
                'role'=>$row['role'],
            ]);  
        }
    }
}
