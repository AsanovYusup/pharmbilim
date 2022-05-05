<div class="row mb-5">  
@php
    $options = json_decode($question->answers); 
    $correct_answers = $question->correct_answers;
    $index = 1;

@endphp
@foreach ($options as $option)
    @php
        $submitted_value = '';                                            
        if($user_answers && count($user_answers))  {                                                    
            if($user_answers[0] == $index)
                $submitted_value = 'checked';
        }

    @endphp
        <div class="col-md-3">
            <div class="custom-control custom-checkbox">
                @if (isset($user_answers[0]) && $correct_answers == $index && $correct_answers == $user_answers[0])
                    <input type="checkbox" class="custom-control-input is-valid" id="{{ $question_number }}-{{ $index }}" {{$submitted_value}} disabled>
                    <label class="custom-control-label text-success" for="{{ $question_number }}-{{ $index }}">{!! $option->option_value !!}</label>
                @elseif(isset($user_answers[0]) && $correct_answers !== $index && $user_answers[0] == $index)
                    <input type="checkbox" class="custom-control-input is-invalid" id="{{ $question_number }}-{{ $index }}" {{$submitted_value}} disabled>
                    <label class="custom-control-label text-danger" for="{{ $question_number }}-{{ $index }}">{!! $option->option_value !!}</label>
                @else
                    <input type="checkbox" class="custom-control-input" id="{{ $question_number }}-{{ $index }}" disabled>
                    <label class="custom-control-label" for="{{ $question_number }}-{{ $index }}">{!! $option->option_value !!}</label>
                @endif
            </div>
        </div>
    @php
        $index++;
    @endphp
@endforeach

</div>