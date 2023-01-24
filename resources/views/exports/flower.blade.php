<!DOCTYPE html>
<html>
<head>
    <title>{{ $strain->name }}</title>
</head>
<body>
    <table>
        <tbody>
            <tr>
                <td colspan="{{ 4+count($dates) }}" style="text-align: center; font-weight: bold; background: #fdd835;">{{ $strain->name }}</td>
            </tr>
            <tr>
                <td></td>
                @foreach($dates as $date)
                <td style="text-align: center; font-weight: bold;">{{ $date }}</td>
                @endforeach
                <td style="text-align: center; font-weight: bold;">Total</td>
                <td style="text-align: center; font-weight: bold;">Avrg x pp (g)</td>
                <td style="text-align: center; font-weight: bold;">Avrg x pp (lb)</td>
            </tr>
            @php
            $total=0;
            @endphp
            @foreach($employees as $employee)
            @php
            $days=0;
            $subtotal=0;
            $stages=$employee['stages']->map(function ($stage) {
                $stage->date=$stage->created_at->format('Y-m-d');
                return collect($stage)->only("flower", "date");
            })->unique()->values();
            @endphp
            <tr>
                <td>{{ $employee->name.' '.$employee->lastname }}</td>
                @foreach($dates as $date)
                @php
                $flower=$stages->where('date', date('Y-m-d', strtotime($date)))->sum('flower');
                $subtotal+=$flower;
                if ($flower>0) {
                    $days++;
                }
                @endphp
                <td>{{ number_format($flower, 2, '.', '') }}</td>
                @endforeach
                <td>{{ number_format($subtotal, 2, '.', '') }}</td>
                <td>@if($days>0){{ number_format($subtotal/$days, 2, '.', '') }}@else{{ number_format(0, 2, '.', '') }}@endif</td>
                <td>@if($days>0){{ number_format(($subtotal/$days)*0.00220462, 8, '.', '') }}@else{{ number_format(0, 2, '.', '') }}@endif</td>
            </tr>
            @php
            $total+=$subtotal;
            @endphp
            @endforeach
            <tr>
                <td colspan="{{ 1+count($dates) }}"></td>
                <td style="text-align: center; font-weight: bold;">Total (g)</td>
                <td>{{ number_format($total, 2, '.', '') }}</td>
            </tr>
            <tr>
                <td colspan="{{ 1+count($dates) }}"></td>
                <td style="text-align: center; font-weight: bold;">Total (lb)</td>
                <td>{{ number_format($total*0.00220462, 8, '.', '') }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>