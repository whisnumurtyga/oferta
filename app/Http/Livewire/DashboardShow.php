<?php

namespace App\Http\Livewire;

use App\Models\Member;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashboardShow extends Component
{
    public $years, $totals, $transactions, $timerangeTransaction = '', $test;
    public $startDate = '', $endDate = '';
    public $startDatePieMajor = '', $endDatePieMajor = '';
    public $labels, $datasets;
    public $filterProfitByMember;

    // Lifecycle hook untuk menginisialisasi data pada saat komponen dimuat pertama kali
    public function mount()
    {
        $this->getTransactions();
        $this->profitByMember();
    }

    public function render()
    {

        return view('livewire.dashboard-show',[
            'interval' => $this->transactions->pluck('year'),
            'total' => $this->transactions->pluck('total_profit'),
            'labels' => $this->labels,
            'datasets' => $this->datasets,
        ]);
    }

    public function getTransactions()
    {
        $this->transactions =  DB::table('transactions')
            ->select(DB::raw('YEAR(date) as year'), DB::raw('SUM(total_profit) as total_profit'))
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();
    }

    public function transactionsByYear()
    {
        $this->getTransactions();
        // Kirim data yang diperbarui ke sisi klien menggunakan emit event 'chartUpdated'
        $this->emit('transactionLineChartUpdated', [
            'intervals' => $this->transactions->pluck('year'),
            'totals' => $this->transactions->pluck('total_profit'),
        ]);
    }

    public function transactions5YearAgo()
    {
        $thisYear = date('Y');
        $threeYearsAgo = $thisYear - 5;

        $this->transactions = DB::table('transactions')
            ->select(DB::raw('YEAR(date) as year'), DB::raw('SUM(total_profit) as total_profit'))
            ->whereYear('date', '>', $threeYearsAgo)
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();

        $this->emit('transactionLineChartUpdated', [
            'intervals' => $this->transactions->pluck('year'),
            'totals' => $this->transactions->pluck('total_profit'),
        ]);
    }

    public function transactions1Year()
    {
        $thisYear = date('Y');

        $this->transactions = DB::table('transactions')
            ->select(DB::raw('MONTH(date) as month'), DB::raw('SUM(total_profit) as total_profit'))
            ->whereYear('date', '=', $thisYear)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

            $months = $this->transactions->pluck('month')->map(function ($month) {
                return DateTime::createFromFormat('!m', $month)->format('F');
            });

            $this->emit('transactionLineChartUpdated', [
                'intervals' => $months,
                'totals' => $this->transactions->pluck('total_profit'),
            ]);
    }


    public function transactions3MonthAgo()
    {
        $thisYear = date('Y');
        $threeMonthsAgo = date('m') - 3;

        // Jika bulan saat ini kurang dari 3, maka kurangi 3 bulan dari tahun saat ini
        if ($threeMonthsAgo <= 0) {
            $threeMonthsAgo += 12;
            $thisYear--;
        }

        $this->transactions = DB::table('transactions')
            ->select(DB::raw('YEAR(date) as year'), DB::raw('MONTH(date) as month'), DB::raw('SUM(total_profit) as total_profit'))
            ->whereYear('date', '=', $thisYear)
            ->whereMonth('date', '>=', $threeMonthsAgo)
            ->whereMonth('date', '<=', $threeMonthsAgo+3)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $months = $this->transactions->map(function ($transaction) {
            $monthName = DateTime::createFromFormat('!m', $transaction->month)->format('F');
            $month3Digit = substr($monthName, 0, 3);
            $yearTwoDigit = substr($transaction->year, -2); // Mengambil 2 digit terakhir dari tahun
            return "$month3Digit $yearTwoDigit";
        });

        $this->emit('transactionLineChartUpdated', [
            'intervals' => $months,
            'totals' => $this->transactions->pluck('total_profit'),
        ]);
    }

    public function transactionsDailyThisMonth()
    {
        $thisYear = date('Y');
        $thisMonth = date('m');

        $this->transactions = DB::table('transactions')
            ->select(DB::raw('DATE(date) as date'), DB::raw('SUM(total_profit) as total_profit'))
            ->whereYear('date', '=', $thisYear)
            ->whereMonth('date', '=', $thisMonth)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $days = $this->transactions->groupBy(function ($transaction) {
            return DateTime::createFromFormat('Y-m-d', $transaction->date)->format('d');
        });

        $intervals = [];
        $totals = [];

        foreach ($days as $day => $transactions) {
            $totalProfit = $transactions->sum('total_profit');
            $intervals[] = $day;
            $totals[] = $totalProfit;
        }

        $this->emit('transactionLineChartUpdated', [
            'intervals' => $intervals,
            'totals' => $totals,
        ]);
    }

    public function transactionsLast7Days()
    {
        $endDate = Carbon::now(); // Tanggal saat ini
        $startDate = Carbon::now()->subDays(7); // Tanggal 7 hari yang lalu

        $this->transactions = DB::table('transactions')
            ->select(DB::raw('DATE(date) as date'), DB::raw('SUM(total_profit) as total_profit'))
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $days = $this->transactions->groupBy(function ($transaction) {
            return Carbon::createFromFormat('Y-m-d', $transaction->date)->format('d');
        });

        $intervals = [];
        $totals = [];

        foreach ($days as $day => $transactions) {
            $totalProfit = $transactions->sum('total_profit');
            $intervals[] = $day;
            $totals[] = $totalProfit;
        }

        $this->emit('transactionLineChartUpdated', [
            'intervals' => $intervals,
            'totals' => $totals,
        ]);
    }


    public function filterTransactions()
    {
        if (($this->timerangeTransaction == 'all' || $this->timerangeTransaction == '') && ($this->startDate == "" && $this->endDate == "")) {
            $this->transactionsByYear();
        } else if ($this->timerangeTransaction == '7days') {
            $this->transactionsLast7Days();
        } else if ($this->timerangeTransaction == '1month') {
            $this->transactionsDailyThisMonth();
        } else if ($this->timerangeTransaction == '3months') {
            $this->transactions3MonthAgo();
        } else if ($this->timerangeTransaction == '1year') {
            $this->transactions1Year();
        } else if ($this->timerangeTransaction == '5years') {
            $this->transactions5YearAgo();
        } else if ($this->startDate != "" && $this->endDate != "") {
            $this->customFilterTransactions();
        } else {
            $this->transactionsByYear();
        }
    }

    public function customFilterTransactions()
    {
        $query = DB::table('transactions')
        ->select(DB::raw('DATE(date) as date'), DB::raw('SUM(total_profit) as total_profit'));

        if ($this->startDate && $this->endDate) {
            // Jika start date dan end date sudah diisi, tambahkan kondisi whereBetween pada query
            $query->whereBetween('date', [$this->startDate, $this->endDate]);
        }

        $this->transactions = $query
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Inisialisasi array untuk menyimpan hasil akhir
        $results = [];

        foreach ($this->transactions as $transaction) {
            $date = $transaction->date;
            $totalProfit = $transaction->total_profit;

            // Jika tanggal sudah ada di hasil akhir, tambahkan total profitnya
            if (isset($results[$date])) {
                $results[$date] += $totalProfit;
            } else {
                $results[$date] = $totalProfit;
            }
        }

        // Ubah hasil akhir menjadi dua array terpisah untuk interval dan totals
        $intervals = array_keys($results);
        $totals = array_values($results);

        $this->emit('transactionLineChartUpdated', [
            'intervals' => $intervals,
            'totals' => $totals,
        ]);
    }


    public function profitByMember()
    {
        $data = Member::join('transactions', 'members.id', '=', 'transactions.member_id')
            ->select('members.major', DB::raw('SUM(transactions.total_profit) as total_profit'))
            ->groupBy('members.major')
            ->get();

        $this->labels = $data->pluck('major');
        $this->datasets = $data->pluck('total_profit');

        $this->emit('pieTransactionMajorChartUpdated', [
            'labels' => $data->pluck('major'),
             'datasets' => $data->pluck('total_profit'),
         ]);
    }

    public function filterPieTransactionByMajor()
    {
        // dd($this->filterProfitByMember);
        if(($this->filterProfitByMember == null) &&  ($this->startDatePieMajor == "" && $this->endDatePieMajor == "")) {
            $this->profitByMember();
            // dd('dasd');
        }else if($this->filterProfitByMember == '5years') {
            $this->PieMajor5YearsAgo();
        }else if($this->filterProfitByMember == '1year') {
            $this->PieMajor1YearAgo();
        }else if($this->filterProfitByMember == '3months') {
            $this->PieMajor3MonthsAgo();
        }else if($this->filterProfitByMember == '1month') {
            $this->PieMajor1MonthAgo();
        }else if($this->filterProfitByMember == '7days') {
            $this->PieMajor7DaysAgo();
        }else if($this->startDatePieMajor != '' && $this->endDatePieMajor != '' ) {
            $this->customFilterPieMajor();
            // dd("hehe");
        }else {
            $this->profitByMember();
        }
    }

    public function PieMajor5YearsAgo()
    {
        $thisYear = date('Y');
        $fiveYearAgo = $thisYear - 5;


        $data = Member::join('transactions', 'members.id', '=', 'transactions.member_id')
        ->select('members.major', DB::raw('SUM(transactions.total_profit) as total_profit'))
        ->whereYear('transactions.date', '>', $fiveYearAgo)
        ->whereYear('transactions.date', '<=', $fiveYearAgo+5)
        ->groupBy('members.major')
        ->get();

        $this->emit('pieTransactionMajorChartUpdated', [
           'labels' => $data->pluck('major'),
            'datasets' => $data->pluck('total_profit'),
        ]);
    }

    public function PieMajor1YearAgo()
    {
        $thisYear = date('Y');

        $data = Member::join('transactions', 'members.id', '=', 'transactions.member_id')
        ->select('members.major', DB::raw('SUM(transactions.total_profit) as total_profit'))
        ->whereYear('transactions.date', '=', $thisYear)
        ->groupBy('members.major')
        ->get();

        $this->emit('pieTransactionMajorChartUpdated', [
           'labels' => $data->pluck('major'),
            'datasets' => $data->pluck('total_profit'),
        ]);
    }
    public function PieMajor3MonthsAgo()
    {
        $thisYear = date('Y');
        $threeMonthsAgo = date('m') - 3;
        // Jika bulan saat ini kurang dari 3, maka kurangi 3 bulan dari tahun saat ini
        if ($threeMonthsAgo <= 0) {
            $threeMonthsAgo += 12;
            $thisYear--;
        }
        $data = Member::join('transactions', 'members.id', '=', 'transactions.member_id')
        ->select('members.major', DB::raw('SUM(transactions.total_profit) as total_profit'))
        ->whereYear('transactions.date', '=', $thisYear)
        ->whereMonth('transactions.date', '>=', $threeMonthsAgo)
        ->whereMonth('transactions.date', '<=', $threeMonthsAgo)
        ->groupBy('members.major')
        ->get();

        $this->emit('pieTransactionMajorChartUpdated', [
           'labels' => $data->pluck('major'),
            'datasets' => $data->pluck('total_profit'),
        ]);
    }

    public function PieMajor1MonthAgo()
    {
        $thisMonth = date('m');

        $data = Member::join('transactions', 'members.id', '=', 'transactions.member_id')
        ->select('members.major', DB::raw('SUM(transactions.total_profit) as total_profit'))
        ->whereMonth('transactions.date', '=', $thisMonth)
        ->groupBy('members.major')
        ->get();

        $this->emit('pieTransactionMajorChartUpdated', [
           'labels' => $data->pluck('major'),
            'datasets' => $data->pluck('total_profit'),
        ]);
    }

    public function PieMajor7DaysAgo()
    {
        $endDate = Carbon::now(); // Tanggal saat ini
        $startDate = Carbon::now()->subDays(7); // Tanggal 7 hari yang lalu

        $data = Member::join('transactions', 'members.id', '=', 'transactions.member_id')
        ->select('members.major', DB::raw('SUM(transactions.total_profit) as total_profit'))
        ->whereBetween('transactions.date', [$startDate, $endDate])
        ->groupBy('members.major')
        ->get();

        $this->emit('pieTransactionMajorChartUpdated', [
           'labels' => $data->pluck('major'),
            'datasets' => $data->pluck('total_profit'),
        ]);
    }

    public function customFilterPieMajor()
    {
        // dd($this->startDatePieMajor, $this->endDatePieMajor);
        $data = Member::join('transactions', 'members.id', '=', 'transactions.member_id')
        ->select('members.major', DB::raw('SUM(transactions.total_profit) as total_profit'))
        ->whereBetween('transactions.date', [$this->startDatePieMajor, $this->endDatePieMajor])
        ->groupBy('members.major')
        ->get();

        $this->emit('pieTransactionMajorChartUpdated', [
            'labels' => $data->pluck('major'),
            'datasets' => $data->pluck('total_profit'),
        ]);
    }
}
