@extends('layouts.app')
@section('content')

<ol class="breadcrumb page-breadcrumb">
  <li><a class="breadcrumb-item" href="{{PREFIX}}"><i class="mdi mdi-home"></i></a></li>
  @if(checkRole(getUserGrade(2)))
  <li><a class="breadcrumb-item" href="{{URL_USERS}}">{{ getPhrase('users')}}</a></li>
  <li class="breadcrumb-item active">{{isset($title) ? $title : ''}}</li>
  @else
  <li class="breadcrumb-item active">{{$title}}</li>
  @endif
  <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date">Wednesday, December 2,
      2020</span></li>
</ol>

<div class="fs-lg fw-300 p-5 bg-white border-faded rounded mb-g">
  <h2>{{$title}}</h2>
  @if (isset($errors) && count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif 
  {{-- <div class="panel-tag">
    Заполните пожалуйста все необходимые данные, такие как <code>email</code>, адрес,
    <code>номер whatsapp</code> и тд.
  </div> --}}

  @if ($record)
  @php
  $button_name = getPhrase('update');
  @endphp
  {{ Form::model($record, array('url' => URL_USERS_EDIT.$record->slug, 'method'=>'POST','novalidate'=>'','name'=>'formUsers ', 'files'=>'true' )) }}
  @else
  {!! Form::open(array('url' => URL_USERS_ADD, 'method' => 'POST', 'novalidate'=>'','name'=>'formUsers ',
  'files'=>'true')) !!}
  @endif
  <div class="form-group">
    <label class="form-label" for="name">Фамилия Имя Отчество</label>
    <span class="text-danger">*</span>
    {{ Form::text(
      'name', 
      $value = $record->name, 
      array(
        'class'=>'form-control', 
        'placeholder' => 'Иванов Иван Иванович', 
        'required' =>''
    )) }}
  </div>
  <div class="form-group">
    <label class="form-label" for="example-email-2">Email</label>
    {{ Form::email(
      'email', 
      $value = $record->email, 
      $attributes = array(
        'class'=>'form-control', 
        'placeholder' => 'jack@jarvis.com',
    )) }}
  </div>
  <div class="form-group">
    <label class="form-label" for="phone">{{getphrase('phone')}}</label> 
    @if(checkRole(getUserGrade(2)))
      {{ Form::text(
          'phone', 
          $value = $record->phone, 
          $attributes = array(
            'class'=>'form-control', 
            'placeholder' => getPhrase('phone'),
            'id'=>'phone',
        )) }}
      @else   
        {{ Form::text(
          'phone', 
          $value = '+996'.$record->phone, 
          $attributes = array(
            'class'=>'form-control', 
            'placeholder' => getPhrase('phone'),
            'id'=>'phone',
            'disabled'=>''
        )) }}      
      @endif
  </div>
  <div class="form-group">
    <label class="form-label" for="phone">Номер WhatsApp</label>
    <span class="text-danger">*</span>
    @if (!$record->whatsapp_phone)
        @php
            $wnum = '+996';
        @endphp
    @else
        @php
            $wnum = $record->whatsapp_phone;
        @endphp
    @endif
    {{ Form::text(
      'whatsapp_phone', 
      $value = $wnum, 
      $attributes = array(
        'class'=>'form-control', 
        'placeholder' => 'Номер WhatsApp',
        'id'=>'whatsapp_phone',
        'required' =>'',
    )) }}
  </div>
  <div class="form-group">
    <label class="form-label" for="role_id">Роль</label>
    @if(checkRole(getUserGrade(2)))
      {{Form::select(
        'role_id', 
        App\Role::pluck(
          'display_name', 
          'id')->all(), 
          $record->role_id, 
            [
              'placeholder' => getPhrase('select_role'),
              'class'=>'form-control', 
              ]
      )}}
      @else   
        {{ Form::text(
          'role_dname', 
          $value = App\Role::find($record->role_id)->display_name, 
          $attributes = array(
            'class'=>'form-control', 
            'disabled'=>'',
        )) }} 
        {{ Form::text(
          'role_id', 
          $value = $record->role_id, 
          $attributes = array(
            'class'=>'form-control', 
            'disabled'=>'',
            'hidden'=>''
        )) }}      
      @endif
    
  </div>
  @if(checkRole(getUserGrade(9)))
  <div class="form-group">
    <label class="form-label" for="college_place">Специальность</label>
    <span class="text-danger">*</span>
    {{ Form::text(
          'college_place', 
          $value = $record->college_place, 
          $attributes = array(
            'class'=>'form-control',
            'placeholder' => 'Ваша специальность', 
    )) }}   
  </div>
  @endif
  <div class="form-group">
    <label class="form-label" for="example-select">Регион</label>
    {{Form::select(
      'region', 
      $region, 
        $record->region, 
          [
            'placeholder' => 'Выберите регион',
            'class'=>'form-control', 
            ]
    )}}
  </div>
  <div class="form-group">
    <label class="form-label" for="example-select">Компания</label>
    @if(checkRole(getUserGrade(2)))
    {{ $record->company }}
    {{Form::select(
      'company', 
      $company, 
      $record->company, 
      [
        'placeholder' => 'Выберите Компания.',
        'class'=>'form-control', 
        ]
        )}}
    @else   
      <span class="text-danger">*</span>
      {{ Form::text(
        'company', 
        $value = $record->company, 
        $attributes = array(
          'class'=>'form-control', 
          'placeholder' => getPhrase('Впишите Компанию'),
          'required' =>'',
          'id'=>'company',
      )) }}      
    @endif
  </div>
  <div class="form-group">
    <label class="form-label" for="example-select">Аптека\Филиал</label>

    @if(checkRole(getUserGrade(2)))
      {{ $record->pharm }}
      {{Form::select(
        'pharm', 
        $pharm, 
          $record->pharm, 
            [
              'placeholder' => 'Выберите Аптеку',
              'class'=>'form-control select2', 
              ]
      )}}
      @else   
        @if ($record->pharm)
            @php
                $disabled = 'disabled';
            @endphp
            @else
            @php
                $disabled = '';
            @endphp
        @endif
        {{ Form::text(
          'pharm', 
          $value = $record->pharm, 
          $attributes = array(
            'class'=>'form-control', 
            'placeholder' => getPhrase('Впишите Аптеку'),
            $disabled,
            'id'=>'pharm',
        )) }}      
      @endif

								
 
  </div>
  <div class="form-group">
    <label class="form-label" for="created_at">Дата регистрации</label>
    {{ Form::text(
      'time', 
      $value = date('d/m/Y', strtotime($record->created_at)), 
      $attributes = array(
        'class'=>'form-control', 
        'placeholder' => getPhrase('time'),
        'id'=>'created_at',
        'disabled'=>''
    )) }}
  </div>
  <div class="form-group">
    <label class="form-label" for="parent">Руководитель</label>      
      {{ Form::text(
          'parent', 
          $value = $record->parent, 
          $attributes = array(
            'class'=>'form-control', 
            'placeholder' => getPhrase('parent'),
            'id'=>'parent',
            'disabled'=>''
        )) }}
        @php
          $second_parent = getUserRecord($record->second_parent);
        @endphp
        @if ($record->second_parent)
          {{ Form::text(
            'second_parent', 
            $value = $second_parent->name, 
            $attributes = array(
              'class'=>'form-control mt-3', 
              'placeholder' => getPhrase('parent'),
              'id'=>'second_parent',
              'disabled'=>''
          )) }}  
        @endif
  </div>
  <div class="form-group">
    <label class="image" for="image_input">Фото профиля</label>
    {!! Form::file('image', array(
    'id'=>'image_input',
    'class'=>'form-control-file',
    'accept'=>'.png,.jpg,.jpeg'))
    !!}
  </div>
  <div class="form-group">
    <label class="image" for="verify_images">Документы</label>
    @if(checkRole(getUserGrade(9)))
      <span class="text-danger">*</span>
      {!! Form::file('verify_images[]', array(
      'id'=>'verify_images',
      'class'=>'form-control-file',
      'multiple'=>'',
      'requred'=>'',
      'accept'=>'.png,.jpg,.jpeg'))
      !!}
    @else
    {!! Form::file('verify_images[]', array(
    'id'=>'verify_images',
    'class'=>'form-control-file',
    'multiple'=>'',
    'accept'=>'.png,.jpg,.jpeg'))
    !!}
    @endif
  </div>

  <div class="form-group">
    @php
    $docs = json_decode($record->field_of_interest, true);
    @endphp
    @if ($docs)
    <p>Загруженные документы</p>
    @foreach ($docs as $item)
    <a href="{{asset("public/uploads/users")}}/{{$item['filename']}}">{{$item['filename']}}</a><br>
    @endforeach
    @endif
  </div>

  <div class="row">
    <div class="col-md-6">
      <button type="submit" class="btn btn-primary btn-lg btn-block waves-effect waves-themed">Сохранить</button>
    </div>
    <div class="col-md-6">
      <span class="status status-warning d-inline-block">
        <img src="{{ getProfilePath($record->image) }}" class="profile-image rounded-circle" alt="...">
      </span>
    </div>
  </div>
  {!! Form::close() !!}

</div>


@endsection

@push('custom-scrips')
<script>
  
</script>
@endpush