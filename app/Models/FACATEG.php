<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FACATEG extends Model
{
    use HasFactory;

    protected $table = 'FA_CATEG';

    public $timestamps = false; 

    protected $fillable = [
        'FACATEG_CODE'
      ,'FACATEG_NAME'
      ,'ASSETACCT_CODE'
      ,'ACCUMACCT_CODE'
      ,'EXPACCT_CODE'
      ,'GAINACCT_CODE'
      ,'LOSSACCT_CODE'
      ,'ARACCT_CODE'
      ,'SALESACCT_CODE'
      ,'CLEARINGACCT_CODE'
      ,'REGISTERED_BY'
      ,'REGISTERED_DATE'
      ,'UPDATED_BY'
      ,'UPDATED_DATE'
    ];
}
