<!doctype html>
<html>
  <body>
      <h1>Bitcoins</h1>
    <table border='1' style='border-collapse: collapse;'>
      <tr>
        <th>BitcoinName</th>
        <th>Symbol</th>
        <th>Params</th>
      </tr>
      @foreach($bitcoinData as $bitcoin)
      <tr>
        <td>{{ $bitcoin->coin_symbol }}</td>
        <td>{{ $bitcoin->coin_name }}</td>
        <td>{{ $bitcoin->coin_params }}</td>
      </tr>
      @endforeach      
    </table>
      <br><br>
      <a href="/public/">Return</a>
  </body>
</html>