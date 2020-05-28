<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    protected $fillable = ['title', 'description', 'due_date'];


    public function getReadableDueDate() {
        $date = $this->due_date;
        $date = Carbon::create($date);
        return $date->toDayDateTimeString();
    }

    public function getInputDueDate() {
        $date = $this->due_date;
        $date = Carbon::create($date);
        return $date->format('Y-m-d\TH:i:s');
    }
}
