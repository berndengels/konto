<?php
namespace App\Models;

use Eloquent;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Konto
 *
 * @property int $id
 * @property string $buchungstag
 * @property string $valutadatum
 * @property string|null $buchungstext
 * @property string|null $verwendungszweck
 * @property string|null $beguenstigter-zahlungspflichtiger
 * @property string|null $kontonummer
 * @property string|null $blz
 * @property string|null $betrag
 * @property string|null $waehrung
 * @property string|null $info
 * @method static Builder|Konto newModelQuery()
 * @method static Builder|Konto newQuery()
 * @method static Builder|Konto query()
 * @method static Builder|Konto whereBeguenstigterZahlungspflichtiger($value)
 * @method static Builder|Konto whereBetrag($value)
 * @method static Builder|Konto whereBlz($value)
 * @method static Builder|Konto whereBuchungstag($value)
 * @method static Builder|Konto whereBuchungstext($value)
 * @method static Builder|Konto whereId($value)
 * @method static Builder|Konto whereInfo($value)
 * @method static Builder|Konto whereKontonummer($value)
 * @method static Builder|Konto whereValutadatum($value)
 * @method static Builder|Konto whereVerwendungszweck($value)
 * @method static Builder|Konto whereWaehrung($value)
 * @mixin Eloquent
 * @property string|null $wer
 * @method static Builder|Konto sortable($defaultParameters = null)
 * @method static Builder|Konto whereWer($value)
 */
class Konto extends Model
{
    use Sortable;

    protected $table='konto';
    protected $dateFormat = 'd.m.Y';
    protected $dates = ['buchungstag'];
    protected $casts = [
        'buchungstag'   => 'date:Y-m-d',
        'betrag'    => 'float',
    ];
    protected $guarded = ['id'];
    public $sortable = ['wer', 'betrag', 'buchungstag'];
}
