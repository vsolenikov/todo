<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Task extends Model
{
    /**
     * ������� ������������� ��������.
     *
     * @var array
     */
    protected $fillable = ['name'];
    protected $casts = [
        'user_id' => 'int',
    ];
    /**
     * �������� ������������ - ��������� ������ ������
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}/*
$user = App\User::find(1);
*/
$user = App\User::find(1);

foreach ($user->tasks as $task) {
    echo $task->name;
}
