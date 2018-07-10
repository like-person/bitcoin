<!doctype html>
<html>
    <head>
        <title>Bitcoin Stat</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
  <body>
      <div class="container">
        <h1>Bitcoin Stat</h1>
        <form action="" method="get" id="coinForm">
        <div class="row">
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Coin Name</label>
                    <input type="text" name="coin_symbol" class="form-control">
                </div>                
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label style="width: 100%">&nbsp;</label>
                    <input type="submit" name="coin_submit" class="btn btn-default" value="Filter">
                    <input type="button" name="coin_reset" class="btn btn-default" value="Reset">
                </div>                
            </div>
        </div>
        </form>
        <table id="bitcoinStat" class="table">
            <thead>
                <tr>
                  <th>Name</th>
                  <th>Avg. Price</th>
                  <th>% Change(24h) <i class="glyphicon glyphicon-sort-by-attributes-alt"></i></th>
                </tr>                    
            </thead>
            <tbody>
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
            </tbody>
        </table>
        <br><br>
        <a href="/public/">Return</a>
      </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>

$(function() {

    $('#coinForm').on('submit',function(event){
        event = event || window.event;
        var symbol = $('input[name=coin_symbol]').val();
        $.ajax({
            url: '/public/bitcoinStatOne/'+symbol,
            success: function (data) {
                $('#bitcoinStat tbody').html(data);
            },
            error: function (msg) {
                alert('Ошибка: '+msg);
            }
        });
        event.preventDefault ? event.preventDefault() : (event.returnValue=false);
    });
    $('input[name=coin_reset]').on('click',function(event){
        event = event || window.event;
        $('input[name=coin_symbol]').val('');
        $('#coinForm').trigger('submit');
        event.preventDefault ? event.preventDefault() : (event.returnValue=false);
    })
});
</script>
  </body>
</html>