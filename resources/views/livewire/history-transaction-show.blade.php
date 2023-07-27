@php
    use Carbon\Carbon;
@endphp

<div>
    <div >
        <a href="{{ route('transactions') }}">
            <button type="button" class="btn btn-primary">
                Add Transaction
            </button>
        </a>
        <div class="">
            <div class="mt-2 py-3">
                <div class="row">
                    <div class="col-lg-4 mb-2">
                        <input  wire:model="search" type="text" class="form-control" placeholder="Search">
                    </div>
                    <div class="col-lg-2">
                        <div class="">
                            <select id="user_id_filter" name="user_id_filter" class="form-select custom-select" wire:model="user_id_filter" >
                                <option value="0" selected>Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="">
                            <select id="user_id_filter" name="user_id_filter" class="form-select custom-select" wire:model="user_id_filter" >
                                <option value="0" selected>Select Member</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="">
                            <select id="year_filter" name="year_filter" class="form-select custom-select" wire:model="year_filter" >
                                <option value="0" selected>Select Year</option>
                                @for ($i = 2010; $i <= Carbon::now()->year; $i++)
                                <option value="{{ $i }}" selected>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="">
                            <select id="month_filter" name="month_filter" class="form-select custom-select" wire:model="month_filter" >
                                <option value="0" selected>Month</option>
                                @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" selected>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="">
                            <select id="day_filter" name="day_filter" class="form-select custom-select" wire:model="day_filter" >
                                <option value="0" selected>Day</option>
                                @for ($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}" selected>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="table-user">
                    <table class="table table-hover mx-auto mt-2">
                        <thead class="sticky-top">
                            <tr class="text-center" style="background-color: #625757;">
                                <th scope="col" class="text-white">Order ID</th>
                                <th scope="col" class="text-white">Date</th>
                                <th scope="col" class="text-white">Handled By</th>
                                <th scope="col" class="text-white">Member</th>
                                <th scope="col" class="text-white">Total Pay (Rp)</th>
                                <th scope="col" class="text-white">Payment</th>
                                <th scope="col" class="text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                    <tr>
                                        <th scope="row">{{ $transaction->order_id }}</th>
                                        <td>{{ $transaction->date }}</td>
                                        <td>{{ $transaction->users->name }}</td>
                                        <td>{{ $transaction->members->name }}</td>
                                        <td>{{ $transaction->total_pay }}</td>
                                        {{-- <td>{{ $transaction->payments }}</td> --}}
                                        <td>{{ $transaction->payments->name }}</td>
                                        <td colspan="1" class="text-white text-center">
                                            <button wire:click="clickDetail({{ $transaction->id }})" type="button" class="btn btn-sm  btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailTransactionsModal">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

        </div>
    </div>

@if ($detailModalClicked)
    <div wire:ignore.self class="modal fade" id="detailTransactionsModal" tabindex="-1" aria-labelledby="detailTransactionsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailTransactionsModallABEL">Detail Transaction</h1>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">

                                <div class="col-lg-4"><h1 class="fw-bold" style="font-weight: 700">{{ $hist_transactions->order_id }}</h1></div>
                                <div class="col-lg-4 ">
                                    <h3 class="text-end m-0">{{ $hist_transactions->date }}</h3>
                                </div>
                                <div class="col-lg-4">
                                    <h1 class="text-end">
                                      <span class="badge {{ $hist_transactions->status->name === 'Success' ? 'bg-success' : 'bg-danger' }} text-white float-end">{{ $hist_transactions->status->name }}</span>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <table class="table">
                                    <thead>
                                        <tr style="font-weight:600">
                                            <td>Product Info</td>
                                            <td>Quantity</td>
                                            <td>Unit Price</td>
                                            <td>Total Price</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total=0 ?>
                                        @foreach ($hist_detailTransactions as $dt)
                                        <tr>
                                            <td>{{ $dt->goods->name }}</td>
                                            <td>{{ $dt->qty }}</td>
                                            <td>{{ ($dt->pay/$dt->qty) }}</td>
                                            <td>{{ $dt->pay }}</td>
                                            <?php $total += $dt->pay ?>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="1" style="font-weight:600; font-size:16px;">Total</td>
                                            <td colspan="1"></td>
                                            <td colspan="1"></td>
                                            <td colspan="1" style="font-weight:600; font-size:16px;">{{ $total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row" style="font-weight:600; font-size:16px">
                                <div class="col-lg-4"><h1>Handled By: {{ $hist_transactions->users->name }}</h1></div>
                                <div class="col-lg-4"><h1>Member Name: {{ $hist_transactions->members->name }}</h1></div>
                                <div class="col-lg-4"><h1>Payment Via: {{ $hist_transactions->payments->name }}</h1></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

