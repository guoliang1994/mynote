<?php
namespace App\Models;

interface UniqueCheck
{
    /**
     * 唯一性检查，如果存在则返回具体的对象，不存在则返回false
     * @return mixed
     */
    function exists();
}
