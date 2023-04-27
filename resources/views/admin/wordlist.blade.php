@extends('layouts.app')

@section ('content')
<div class="container">


<form name="newword" action="/wordlist" method="post">
    {{csrf_field()}}
    <label for="word">Word: </label>
        <input type="text" name="word" id="word">
    <label for="def">Definition: </label>
        <input type="text" name="def">
        <button class="btn btn-primary" type="submit">Submit</button>
</form>
<p>
<button class="btn btn-small btn-success accent">&aacute;</button>
<button class="btn btn-small btn-success accent">&eacute;</button>
<button class="btn btn-small btn-success accent">&iacute;</button>
<button class="btn btn-small btn-success accent">&oacute;</button>
<button class="btn btn-small btn-success accent">&uacute;</button>
<button class="btn btn-small btn-success accent">&ntilde;</button>
</p>

@foreach($words as $word)
    <p>{!!$word->word!!} &mdash; {{$word->definition}}</p>
@endforeach


</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $(".accent").click(function() {
            alert("accent");
        });
    });

</script>
@endsection