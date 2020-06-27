<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    protected $table = "overtime";
    public $fillable = ['user_id','date_ot','start_time','end_time','place_ot','task_name','note'];
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id'); // khai báo khóa ngoại cho model ('đường dẫn model tên bảng cần trỏ','khóa ngoại kết nối 2 bảng','khóa chính của bảng csdl hiện hành')
        //belongsTo là lại liên kết 1:1 trong cơ sở dữ liệu vì 1 sản phẩm chỉ thuộc 1 loại sản phẩm
    }
}
