<?php
namespace App\Models\Traits;


use Carbon\Carbon;
use DateTimeInterface;

trait ModelTimeTrait
{
    /**
     * 将时间格式化为Y-m-d H:i:s 输出
     * @param DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    /*
     * 将创建时间格式化为 中文描述
     */
    public function getCreatedAtZhAttribute()
    {
        $now = Carbon::now();
        if ($this->created_at) {
            return $this->created_at->diffForHumans($now);
        } else {
            return '时间未知';
        }
    }
    /*
     * 将创建时间格式化为 中文描述
     */
    public function getUpdatedAtZhAttribute()
    {
        $now = Carbon::now();
        if ($this->updated_at) {
            return $this->updated_at->diffForHumans($now);
        } else {
            return '时间未知';
        }
    }
}
