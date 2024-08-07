<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SpiPo extends Model
{
    use SoftDeletes;
    //
    public $timestamps = true;
    protected $connection = 'mysql';
    protected $table = 'spi_po';

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_name');
    }
}
