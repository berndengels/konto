<?php
namespace App\Http\Controllers;

use App\Lib\CSVReader;
use App\Models\Konto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\KontoResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use App\Exceptions\WrongUploadException;

class KontoController extends Controller
{
    use CSVReader;

    protected $uniq;
    protected $minDate;
    protected $maxDate;

    public function __construct()
    {
        $this->uniq = Konto::query()
            ->distinct('wer')
            ->orderBy('wer')
            ->get()
            ->keyBy('wer')
            ->map->wer->toArray();

        $dates = Konto::query()
            ->selectRaw('MIN(buchungstag) start, MAX(buchungstag) end')
            ->get()
            ->first()
        ;
        $this->minDate = $dates->start;
        $this->maxDate = $dates->end;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $wer    = $request->post('wer');
        $group  = $request->post('group');
        $start  = $request->post('start');
        $end    = $request->post('end');
        $modus  = $request->input('modus');

        $columns = ['buchungstag','wer','buchungstext','betrag'];
        /**
         * @var $query Builder
         */
        $query = Konto::sortable();
        if(count($request->post()) > 0) {
            if($group) {
                $columns = ['wer','betrag'];
                $query->groupBy('wer')
                    ->selectRaw('wer,SUM(betrag) AS betrag')
                    ->orderBy('betrag', 'desc')
                ;
            }
            if($start) {
                $query->whereDate('buchungstag','>=', $start);
            }
            if($end) {
                $query->whereDate('buchungstag','<=', $end);
            }
            if($wer) {
                $query->whereWer($wer);
            }
            if($modus) {
                if('plus' === $modus) {
                    $query->where('betrag','>',0);
                } else {
                    $query->where('betrag','<',0);
                }
            }
        } else {
            $query->orderBy('buchungstag','desc');
        }
        $all    = $query->get();

        $sumRevenue = $all->filter(fn($item) => $item['betrag'] > 0)
            ->sum(fn($item) => $item['betrag'])
        ;
        $sumExpenses = $all->filter(fn($item) => $item['betrag'] < 0)
            ->sum(fn($item) => $item['betrag'])
        ;

        $count  = $all->count();
        $data   = $query->paginate(100);
        $sql    = $query->toSql();
        $uniq   = $this->uniq;
        $data   = KontoResource::collection($data);

        return view('admin.konto.index', compact('data','columns','uniq', 'wer', 'group', 'start', 'end', 'count','sumRevenue','sumExpenses','sql'));
    }

    /**
     * Display the specified resource.
     *
     * @param Konto $konto
     * @return Response
     */
    public function show(Konto $konto)
    {
        $str = '"Umsatz getätigt von";"Belegdatum";"Buchungsdatum";"Originalbetrag";"Originalwährung";"Umrechnungskurs";"Buchungsbetrag";"Buchungswährung";"Transaktionsbeschreibung";"Transaktionsbeschreibung Zusatz";"Buchungsreferenz";"Gebührenschlüssel";"Länderkennzeichen";"BAR-Entgelt+Buchungsreferenz";"AEE+Buchungsreferenz";"Abrechnungskennzeichen"';
        return response()->view('admin.konto.show-ajax', compact('konto','str'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.konto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $fileName = date('ymdHi').'-'.strtolower($file->getClientOriginalName());
        $path = Storage::disk('database')->putFileAs('', $file, $fileName);
        $csvFile = storage_path('app/database/uploads') . "/$path";
        $this->except = ['auftragskonto'];
        $this->convertToDate = ['buchungstag','valutadatum'];
        $this->convertToDecimal = ['betrag'];

        try {
            $data = $this->csv2Array($csvFile);
            if($data) {
                Konto::insertOrIgnore($data);
                @unlink($csvFile);
            }
        }
        catch(WrongUploadException $e) {
            return view('admin.konto.create', ['error' => $e->getMessage()]);
        }
        catch(Exception $e) {
            @unlink($csvFile);
            throw new Exception($e->getMessage());
        }

        return redirect()->route('konto');
    }
}
