<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absence_letter extends Model
{
    protected $table = 'absence_letter';
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id'); // khai báo khóa ngoại cho model ('đường dẫn model tên bảng cần trỏ','khóa ngoại kết nối 2 bảng','khóa chính của bảng csdl hiện hành')
        //belongsTo là lại liên kết 1:1 trong cơ sở dữ liệu vì 1 sản phẩm chỉ thuộc 1 loại sản phẩm
    }
}
