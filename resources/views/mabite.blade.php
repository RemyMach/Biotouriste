<html>

<div>MA BITEEEE </div>
<p>EN 2D :)</p>
@foreach($mabites as $mabite)
    <p>{{ $mabite->announce_comment }}</p>
    <p>{{ $mabite->announce_price }}</p>
    <p>{{ $mabite->announce_title }}</p>
@endforeach
</html>