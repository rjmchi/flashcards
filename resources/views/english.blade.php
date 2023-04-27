@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Words</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(count($userlist) > 0)
                        @foreach($userlist as $word)
                        @if(!$word->learned_english)
                            <p class="word">{{$word->group_id}} &mdash; {!!$word->definition!!}
                                <span class="def"> &mdash; {!!$word->word!!}</span>
                                <button class="yes btn btn-success btn-sm"><span>yes</span></button>
                                <button class="no btn btn-danger btn-sm"><span>no</span></button>
                                <input type="hidden" name="wordid" value="{{$word->id}}">
                            </p>
                            @endif
                        @endforeach

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $(".word span.def").hide();
        $(".word").click(function() {
            $(this).children("span.def").show();
        });
        $(".yes").click(function(event){
            console.log($(this).parent().children('input').val());
            $(this).parent().addClass('learned');
            $.ajax({
                type: "POST",
                url: "/learned/"+$(this).parent().children('input').val(),
                data: {'userlist':$(this).parent().children('input').val(),'_token':'{{csrf_token()}}', '_method':'put'},
                success: function (response) {
                    console.log(response);
                },
                error: function(data, status, error) {
                    console.log('error');
                }
            });


        });
    });



</script>
@endsection

