<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoices;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\counters;
use App\locations;
use App\counter_types;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_all = invoices::count();
        $count_invoices1 = invoices::where('Value_Status', 1)->count();
        $count_invoices2 = invoices::where('Value_Status', 2)->count();
        $count_invoices3 = invoices::where('Value_Status', 3)->count();
    
        if ($count_invoices2 == 0) {
            $nspainvoices2 = 0;
        } else {
            $nspainvoices2 = $count_invoices2 / $count_all * 100;
        }
    
        if ($count_invoices1 == 0) {
            $nspainvoices1 = 0;
        } else {
            $nspainvoices1 = $count_invoices1 / $count_all * 100;
        }
    
        if ($count_invoices3 == 0) {
            $nspainvoices3 = 0;
        } else {
            $nspainvoices3 = $count_invoices3 / $count_all * 100;
        }
    
        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 350, 'height' => 200])
            ->labels(['Unpaid', 'Paid', 'Other'])
            ->datasets([
                [
                    "label" => "Unpaid",
                    'backgroundColor' => ['#ec5858'],
                    'data' => [$nspainvoices2]
                ],
                [
                    "label" => "Paid",
                    'backgroundColor' => ['#81b214'],
                    'data' => [$nspainvoices1]
                ],
                [
                    "label" => "Other",
                    'backgroundColor' => ['#ff9642'],
                    'data' => [$nspainvoices3]
                ],
            ])
            ->options([]);
    
        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['Unpaid', 'Paid', 'Other'])
            ->datasets([
                [
                    'backgroundColor' => ['#ec5858', '#81b214', '#ff9642'],
                    'data' => [$nspainvoices2, $nspainvoices1, $nspainvoices3]
                ]
            ])
            ->options([]);

                $locations = locations::pluck('LocalLabel')->toArray();;
                $counterTypes = counter_types::pluck('CounterType')->toArray();;
                
                $datasets = [];
    foreach ($counterTypes as $counterType) {
        $data = [];
        foreach ($locations as $location) {
            // Calculate the total price for each counter type in each location
            $totalPrice = Invoices::whereHas('counter', function ($query) use ($counterType, $location) {
                $query->whereHas('counterType', function ($query) use ($counterType) {
                    $query->where('CounterType', $counterType);
                })
                ->whereHas('locations', function ($query) use ($location) {
                    $query->where('LocalLabel', $location);
                });
            })->sum('Total');

            $data[] = $totalPrice;
        }

        $datasets[] = [
            'label' => $counterType,
            'backgroundColor' => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT), // Generate random colors
            'data' => $data,
        ];
    }

    $chartjs1 = app()->chartjs
        ->name('counterConsumptionChart')
        ->type('bar')
        ->size(['width' => 350, 'height' => 200])
        ->labels($locations)
        ->datasets($datasets)
        ->options([]);

                return view('home', compact('chartjs1','chartjs', 'chartjs_2'));
    }

    function generate(Request $request){
        // Replace the input() function calls with request() method calls
        
        $startDate = Carbon::createFromFormat('d-m-Y', request('start_date'))->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d-m-Y', request('end_date'))->format('Y-m-d');
  
        $counterTypes = counter_types::pluck('CounterType')->toArray();
        $locations = Locations::pluck('LocalLabel')->toArray();

        $datasets = [];
        foreach ($counterTypes as $counterType) {
            $data = [];
            foreach ($locations as $location) {
                // Calculate the total price for each counter type in each location
                $totalPrice = Invoices::whereHas('counter', function ($query) use ($counterType, $location) {
                    $query->whereHas('counterType', function ($query) use ($counterType) {
                        $query->where('CounterType', $counterType);
                    })
                    ->whereHas('locations', function ($query) use ($location) {
                        $query->where('LocalLabel', $location);
                    });
                })
                ->whereBetween('invoice_Date', [$startDate, $endDate]) // Filter invoices within the selected date range
                ->sum('Total');

                $data[] = $totalPrice;
            }

            $datasets[] = [
                'label' => $counterType,
                'backgroundColor' => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT), // Generate random colors
                'data' => $data,
            ];
        }

        $chartjs4 = app()->chartjs
            ->name('counterConsumptionChart')
            ->type('line')
            ->size(['width' => 600, 'height' => 400])
            ->labels($locations)
            ->datasets($datasets)
            ->options([]);

            return response()->json($chartjs4);

    }
   
}    