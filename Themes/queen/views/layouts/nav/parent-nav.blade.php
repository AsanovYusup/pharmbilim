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

  <li>
      <a href="#" title="{{ getPhrase('children') }}" data-filter-tags="{{ getPhrase('children') }}">
          <i class="fal fa-users"></i>
          <span class="nav-link-text" data-i18n="nav.theme_settings">{{ getPhrase('children') }}</span>
      </a>
      <ul>
          <li>
              <a href="{{URL_USERS_ADD}}" title="{{ getPhrase('add') }}" data-filter-tags="{{ getPhrase('add') }}">
                  <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">{{ getPhrase('add') }}</span>
              </a>
          </li>
          <li>
              <a href="{{URL_PARENT_CHILDREN}}" title="{{ getPhrase('list') }}" data-filter-tags="{{ getPhrase('list') }}">
                  <span class="nav-link-text" data-i18n="nav.theme_settings_layout_options">{{ getPhrase('list') }}</span>
              </a>
          </li>
      </ul>
  </li>

  <li>
      <a href="#" title="{{ getPhrase('exams') }}" data-filter-tags="{{ getPhrase('exams') }}">
          <i class="fal fa-users"></i>
          <span class="nav-link-text" data-i18n="nav.theme_settings">{{ getPhrase('exams') }}</span>
      </a>
      <ul>
          <li>
              <a href="{{URL_STUDENT_EXAM_CATEGORIES}}" title="{{ getPhrase('categories') }}" data-filter-tags="{{ getPhrase('categories') }}">
                  <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">{{ getPhrase('categories') }}</span>
              </a>
          </li>
          <li>
              <a href="{{URL_STUDENT_EXAM_ALL}}" title="{{ getPhrase('exam_series') }}" data-filter-tags="{{ getPhrase('exam_series') }}">
                  <span class="nav-link-text" data-i18n="nav.theme_settings_layout_options">{{ getPhrase('exam_series') }}</span>
              </a>
          </li>
      </ul>
  </li>

  <li>
      <a href="#" title="{{getPhrase('lms')}}" data-filter-tags="{{getPhrase('lms')}}">
          <i class="fal fa-users"></i>
          <span class="nav-link-text" data-i18n="nav.theme_settings">{{getPhrase('lms')}}</span>
      </a>
      <ul>
          <li>
              <a href="{{ URL_STUDENT_LMS_CATEGORIES }}" title="{{ getPhrase('categories') }}" data-filter-tags="{{ getPhrase('categories') }}">
                  <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">{{ getPhrase('categories') }}</span>
              </a>
          </li>
          <li>
              <a href="{{ URL_STUDENT_LMS_SERIES }}" title="{{ getPhrase('series') }}" data-filter-tags="{{ getPhrase('series') }}">
                  <span class="nav-link-text" data-i18n="nav.theme_settings_layout_options">{{ getPhrase('series') }}</span>
              </a>
          </li>
      </ul>
  </li>

  <li class="{{ Request::url() == url(URL_PARENT_ANALYSIS_FOR_STUDENTS) ? 'active' : '' }}">
    <a href="{{URL_PARENT_ANALYSIS_FOR_STUDENTS}}" title="{{ getPhrase('analysis') }}" data-filter-tags="{{ getPhrase('analysis') }}">
      <i class="fal fa-window"></i>
      <span class="nav-link-text" data-i18n="nav.ui_components">{{ getPhrase('analysis') }}</span>
    </a>
  </li>
  				
</ul>