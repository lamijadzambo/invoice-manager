<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'id'; // or null

    public $incrementing = false;

    public static $message_man = 'Sehr geehrter Herr';

    public static $message_woman = 'Sehr geehrte Frau';

    public static $thx_message = 'Herzlichen Dank für Ihre Bestellung. Gerne liefern wir Ihnen die bestellten und bezahlten Artikel wie folgt:';

    public static $questions = 'Für weitere Auskünfte stehe ich Ihnen gerne zur Verfügung.';

    public static $piece = 'Stk. ';

    public static function currentDate(){
<<<<<<< HEAD
        return Carbon::now()->formatLocalized('%d. %B. %Y');
    }
=======
        $dt = Carbon::now();
        return $dt->formatLocalized('%d. %B. %Y');
    }

>>>>>>> 68d150a41682dd86cbfdd6735cb83c75ee9ee3f5

    public function projects(){
        return $this->belongsTo(Project::class);
    }
}
