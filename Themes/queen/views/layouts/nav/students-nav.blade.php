<ul id="js-nav-menu" class="nav-menu">
  <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
    <a href="{{PREFIX}}" title="{{ getPhrase('dashboard') }} "
      data-filter-tags="{{ getPhrase('dashboard') }}  dashboard">
      <i class="fal fa-dharmachakra"></i>
      <span class="nav-link-text"
        data-i18n="nav.application_intel_analytics_dashboard">{{ getPhrase('dashboard') }} </span>
    </a>
  </li>

  <li class="nav-title">Школа</li>

  <li class="{{ Request::url() == url(URL_STUDENT_ANALYSIS_BY_EXAM.Auth::user()->slug) ? 'active' : '' }}">
    <a href="{{URL_STUDENT_ANALYSIS_BY_EXAM.Auth::user()->slug }}" title="Опросники" data-filter-tags="Опросники">
      <i class="fal fa-window"></i>
      <span class="nav-link-text" data-i18n="nav.ui_components">Опросники</span>
    </a>
  </li>
  <li class="{{ Request::url() == url('/analysis/lms-points/'.Auth::user()->slug) ? 'active' : '' }}">
    <a href="/analysis/lms-points/{{Auth::user()->slug}}" title="Видео" data-filter-tags="Видео">
      <i class="fal fa-video"></i>
      <span class="nav-link-text" data-i18n="nav.ui_components">Видео</span>
    </a>
  </li>
  <li class="{{ Request::url() == url('/analysis/all-points/'.Auth::user()->slug) ? 'active' : '' }}">
    <a href="/analysis/all-points/{{Auth::user()->slug}}" title="Кредит-часы" data-filter-tags="Кредит-часы">
      <i class="fal fa-clock"></i>
      <span class="nav-link-text" data-i18n="nav.ui_components">Кредит-часы</span>
    </a>
  </li>	

  @if(!checkRole(getUserGrade(5)))
  <li class="{{ Request::url() == url(URL_PARENT_CHILDREN) ? 'active' : '' }}">
    <a href="{{URL_PARENT_CHILDREN}}" title="{{getPhrase('children')}}" data-filter-tags="{{getPhrase('children')}}">
      <i class="fal fa-user"></i>
      <span class="nav-link-text" data-i18n="nav.ui_components">{{getPhrase('children')}}</span>
    </a>
  </li>	
	@endif
  				
</ul>