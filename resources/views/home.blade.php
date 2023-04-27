@extends('layouts.app')
@section('content')

    <home-component :wordlist=" {{json_encode($userlist)}}"/>

</div>

@endsection