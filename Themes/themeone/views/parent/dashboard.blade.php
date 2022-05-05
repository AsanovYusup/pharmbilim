@extends($layout)

@section('content')



    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12">

                    <ol class="breadcrumb">


                        <li>{{ $title}}</li>

                    </ol>

                </div>

            </div>
            <div class="row">

    <div class="col-md-12 col-sm-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped table-hover text-center"
                   style="background-color:#fff;">
                <caption>Видео</caption>
                <thead style="background-color: #438afe; color:#ffffff;">
                <tr>
                    <td>
                        #
                    </td>
                    <td>
                        Категория
                    </td>
                    <td>
                        Название
                    </td>
                    <td>
                        Дата начала
                    </td>
                    <td>
                        Дата окончания
                    </td>
                    <td>
                        Баллы
                    </td>
                    <td>
                        Действия
                    </td>
                </tr>
                </thead>
                <tbody>
                @if($user_settings['lms'] ?? null)
                    @foreach($user_settings['lms'] as $lms)
                        <tr>
                            <td>
                                <img src="/public/uploads/lms/series/{{ $lms['image'] }}" alt="" width="50px">
                            </td>
                            <td>
                                {{ $lms['category'] }}
                            </td>
                            <td>
                                {{ $lms['name'] }}
                            </td>
                            <td>
                                {{ $lms['start_date'] }}
                            </td>
                            <td>
                                {{ $lms['end_date'] }}
                            </td>
                            <td>
                                {{ $lms['points'] }}
                            </td>
                            <td>
                                <a href="/learning-management/series/{{ $lms['slug_series'] }}/{{ $lms['slug_content'] }}">Смотреть</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>Тут пока пусто</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped table-hover text-center"
                   style="background-color:#fff;">
                <caption>Опросники</caption>
                <thead style="background-color: #438afe; color:#ffffff;">
                <tr>
                    <td>
                        #
                    </td>
                    <td>
                        Категория
                    </td>
                    <td>
                        Название
                    </td>
                    <td>
                        Дата начала
                    </td>
                    <td>
                        Дата окончания
                    </td>
                    <td>
                        Баллы
                    </td>
                    <td>
                        Действия
                    </td>
                </tr>
                </thead>
                <tbody>
                @if($user_settings['quiz'] ?? null)
                    @foreach($user_settings['quiz'] as $key => $quiz)
                        <tr>
                            <td>
                                <img src="/public/uploads/exams/categories/{{ $quiz['image'] }}" alt="" width="50px">
                            </td>
                            @if($key == 2)
                                <td>
                                    {{ $quiz['category'] }}
                                </td>
                            @else
                                <td>
                                    {{ $quiz['category'] }}
                                </td>
                            @endif
                            <td>
                                {{ $quiz['name'] }}
                            </td>
                            <td>
                                {{ $quiz['start_date'] }}
                            </td>
                            <td>
                                {{ $quiz['end_date'] }}
                            </td>
                            <td>
                                {{ $quiz['points'] }}
                            </td>
                            <td>
                                <a href="/exams/student/quiz/take-exam/{{ $quiz['slug'] }}">Пройти</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>Тут пока пусто</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>


    </div>

    <!-- /#page-wrapper -->



@stop



@section('footer_scripts')



@stop