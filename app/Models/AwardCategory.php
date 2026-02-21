<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class AwardCategory extends Model {
    use AsSource;
    protected $fillable = ['name', 'description'];

    public function nominees() {
        return $this->hasMany(AwardNominee::class);
    }
}
