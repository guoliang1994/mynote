<?php
namespace App\Models;

use App\Models\Traits\ModelTimeTrait;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    use ModelTimeTrait;
    function getTable(): string
    {
        return $this->table ?: class_basename($this);
    }
}
