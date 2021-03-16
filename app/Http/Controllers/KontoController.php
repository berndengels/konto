<?php
namespace App\Http\Controllers;

use App\Lib\CSVReader;
use App\Models\Konto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\KontoResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class KontoController extends Controller
{
    use CSVReader;

    protected $uniq;
    protected $minDate;
    protected $maxDate;

    public function __construct()
    {
        $this->uniq = Konto::query()->distinct('wer')->orderBy('wer')->get()->keyBy('wer')->map->wer->toArray();
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
        $columns = ['buchungstagFormated','wer','buchungstext','betrag'];
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
        } else {
            $query->orderBy('buchungstag','desc');
        }
        $count  = $query->count();
        $data   = $query->paginate(100);
        $sql    = $query->toSql();
        $uniq   = $this->uniq;
        $data   = KontoResource::collection($data);

        return view('public.konto.index', compact('data','columns','uniq', 'wer', 'group', 'start', 'end', 'count','sql'));
    }

    public function seed(Request $request) {

    }

    /**
     * Display the specified resource.
     *
     * @param Konto $konto
     * @return Response
     */
    public function show(Konto $konto)
    {
        $str = '"Umsatz get�tigt von";"Belegdatum";"Buchungsdatum";"Originalbetrag";"Originalw�hrung";"Umrechnungskurs";"Buchungsbetrag";"Buchungsw�hrung";"Transaktionsbeschreibung";"Transaktionsbeschreibung Zusatz";"Buchungsreferenz";"Geb�hrenschl�ssel";"L�nderkennzeichen";"BAR-Entgelt+Buchungsreferenz";"AEE+Buchungsreferenz";"Abrechnungskennzeichen"';
        return response()->view('public.konto.show-ajax', compact('konto','str'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('public.konto.create');
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
        $data = $this->csv_to_array($csvFile);
        try {
            Konto::insertOrIgnore($data);
            @unlink($csvFile);
        } catch(\Exception $e) {
            @unlink($csvFile);
            throw new \Exception($e->getMessage());
        }
        return redirect()->route('konto');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Konto $konto
     * @return Response
     */
    public function edit(Konto $konto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Konto $konto
     * @return Response
     */
    public function update(Request $request, Konto $konto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Konto $konto
     * @return Response
     */
    public function destroy(Konto $konto)
    {
        //
    }
}
