@foreach($bitcoinStatData as $bitcoinStat)
<tr>
  <td>{{ $bitcoinStat->coin_name }}</td>
    @if ($bitcoinStat->coin_stat_price > $bitcoinStat->old_stat_price)
    <td class="success">{{ $bitcoinStat->coin_stat_price }}</td>
    @elseif ($bitcoinStat->coin_stat_price < $bitcoinStat->old_stat_price)
    <td class="danger">{{ $bitcoinStat->coin_stat_price }}</td>
    @else
    <td>{{ $bitcoinStat->coin_stat_price }}</td>
    @endif
    @if ($bitcoinStat->coin_stat_perc > $bitcoinStat->old_stat_perc)
    <td class="success">{{ $bitcoinStat->coin_stat_perc }}</td>
    @elseif ($bitcoinStat->coin_stat_perc < $bitcoinStat->old_stat_perc)
    <td class="danger">{{ $bitcoinStat->coin_stat_perc }}</td>
    @else
    <td>{{ $bitcoinStat->coin_stat_perc }}</td>
    @endif
</tr>
@endforeach