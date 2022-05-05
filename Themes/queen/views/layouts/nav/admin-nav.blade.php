<ul id="js-nav-menu" class="nav-menu">
  <li {{ isActive($active_class, 'dashboard') }}>
      <a href="{{PREFIX}}" title="{{ getPhrase('dashboard') }} " data-filter-tags="{{ getPhrase('dashboard') }}  dashboard">
          <i class="fal fa-dharmachakra"></i>
          <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">{{ getPhrase('dashboard') }} </span>
      </a>
  </li>

  <li class="nav-title">Школа</li>

  <li class="active open">
      <a href="#" title="{{ getPhrase('users') }}" data-filter-tags="{{ getPhrase('users') }}">
          <i class="fal fa-users"></i>
          <span class="nav-link-text" data-i18n="nav.theme_settings">{{ getPhrase('users') }}</span>
      </a>
      <ul>
          <li {{ isActive($active_class, 'users') }}>
              <a href="{{URL_USERS}}" title="{{ getPhrase('users') }}" data-filter-tags="{{ getPhrase('users') }}">
                  <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">{{ getPhrase('users') }}</span>
              </a>
          </li>
          <li {{ isActive($active_class, 'users-unsort') }}>
              <a href="{{URL_USERS_UNSORTED}}" title="{{ getPhrase('users_unsorted') }}" data-filter-tags="{{ getPhrase('users_unsorted') }}">
                  <span class="nav-link-text" data-i18n="nav.theme_settings_layout_options">{{ getPhrase('users_unsorted') }}</span>
              </a>
          </li>
          <li {{ isActive($active_class, 'users-region') }}>
              <a href="{{URL_USERS_REGION}}" title="{{ getPhrase('company_region_pharm') }}" data-filter-tags="{{ getPhrase('company_region_pharm') }}">
                  <span class="nav-link-text" data-i18n="nav.theme_settings_theme_modes_(beta)">{{ getPhrase('company_region_pharm') }}</span>
              </a>
          </li>
      </ul>
  </li>

  <li {{ isActive($active_class, 'exams') }} > 
      <a href="#" title="{{ getPhrase('exams') }}" data-filter-tags="{{ getPhrase('exams') }}">
          <i class="fal fa-window"></i>
          <span class="nav-link-text" data-i18n="nav.ui_components">{{ getPhrase('exams') }}</span>
      </a>
      <ul>
          <li>
              <a href="{{URL_QUIZ_CATEGORIES}}" title="{{ getPhrase('categories') }}" data-filter-tags="{{ getPhrase('categories') }}">
                  <span class="nav-link-text" data-i18n="nav.ui_components_alerts">{{ getPhrase('categories') }}</span>
              </a>
          </li>
          <li>
              <a href="{{URL_QUIZZES}}" title="{{ getPhrase('quiz')}}" data-filter-tags="{{ getPhrase('quiz')}}">
                  <span class="nav-link-text" data-i18n="nav.ui_components_accordions">{{ getPhrase('quiz')}}</span>
              </a>
          </li>
          <li>
              <a href="{{URL_EXAM_SERIES}}" title="{{ getPhrase('exam_series')}}" data-filter-tags="{{ getPhrase('exam_series')}}">
                  <span class="nav-link-text" data-i18n="nav.ui_components_badges">{{ getPhrase('exam_series')}}</span>
              </a>
          </li>
          <li>
              <a href="{{URL_QUIZ_QUESTIONBANK}}" title="{{ getPhrase('question_bank') }}" data-filter-tags="{{ getPhrase('question_bank') }}">
                  <span class="nav-link-text" data-i18n="nav.ui_components_breadcrumbs">{{ getPhrase('question_bank') }}</span>
              </a>
          </li>
          <li>
              <a href="{{URL_INSTRUCTIONS}}" title="{{ getPhrase('instructions')}}" data-filter-tags="{{ getPhrase('instructions')}}s">
                  <span class="nav-link-text" data-i18n="nav.ui_components_buttons">{{ getPhrase('instructions')}}</span>
              </a>
          </li>
          <li>
              <a href="{{URL_MASTERSETTINGS_SUBJECTS}}" title="{{ getPhrase('subjects_master')}}" data-filter-tags="{{ getPhrase('subjects_master')}}">
                  <span class="nav-link-text" data-i18n="nav.ui_components_button_group">{{ getPhrase('subjects_master')}}</span>
              </a>
          </li>                                    
      </ul>
  </li>
  
  <li {{ isActive($active_class, 'lms') }} > 
      <a href="#" title="{{getPhrase('lms')}}" data-filter-tags="{{getPhrase('lms')}}">
          <i class="fal fa-bolt"></i>
          <span class="nav-link-text" data-i18n="nav.utilities">{{getPhrase('lms')}}</span>
      </a>
      <ul>																	
          <li>
              <a href="{{ URL_LMS_CATEGORIES }}" title="{{ getPhrase('categories') }}" data-filter-tags="{{ getPhrase('categories') }}">
                  <span class="nav-link-text" data-i18n="nav.utilities_borders">{{ getPhrase('categories') }}</span>
              </a>
          </li>
          <li>
              <a href="{{ URL_LMS_SERIES }}" title="{{ getPhrase('series') }}" data-filter-tags="{{ getPhrase('series') }}">
                  <span class="nav-link-text" data-i18n="nav.utilities_clearfix">{{ getPhrase('series') }}</span>
              </a>
          </li>
          <li>
              <a href="{{ URL_LMS_CONTENT }}" title="{{ getPhrase('contents') }}" data-filter-tags="{{ getPhrase('contents') }}">
                  <span class="nav-link-text" data-i18n="nav.utilities_color_pallet">{{ getPhrase('contents') }}</span>
              </a>
          </li>                                    
      </ul>
  </li>
  <li {{ isActive($active_class, 'reports') }} >
      <a href="#" title="{{ getPhrase('payment_reports') }}" data-filter-tags="font icons">
          <i class="fal fa-map-marker-alt"></i>
          <span class="nav-link-text" data-i18n="nav.font_icons">{{ getPhrase('payment_reports') }}</span>                                    
      </a>
      <ul>
          <li>
              <a href="{{URL_ONLINE_PAYMENT_REPORTS}}" title="{{ getPhrase('online_payments') }}" data-filter-tags="{{ getPhrase('online_payments') }}">
                  <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">{{ getPhrase('online_payments') }}</span>
              </a>                                        
          </li>
          <li>
              <a href="{{URL_OFFLINE_PAYMENT_REPORTS}}" title="{{ getPhrase('offline_payments') }}" data-filter-tags="{{ getPhrase('offline_payments') }}">
                  <span class="nav-link-text" data-i18n="nav.font_icons_nextgen_icons">{{ getPhrase('offline_payments') }}</span>
              </a>                                        
          </li>
          <li>
              <a href="{{URL_PAYMENT_REPORT_EXPORT}}" title="{{ getPhrase('export') }}" data-filter-tags="{{ getPhrase('export') }}">
                  <span class="nav-link-text" data-i18n="nav.font_icons_stack_icons">{{ getPhrase('export') }}</span>
              </a>
          </li>
      </ul>
  </li>

  <li {{ isActive($active_class, 'coupons') }} >
      <a href="#" title="{{ getPhrase('coupons') }}" data-filter-tags="{{ getPhrase('coupons') }}">
          <i class="fal fa-th-list"></i>
          <span class="nav-link-text" data-i18n="nav.tables">{{ getPhrase('coupons') }}</span>
      </a>
      <ul>
          <li>
              <a href="{{URL_COUPONS}}" title="{{ getPhrase('list') }}" data-filter-tags="{{ getPhrase('list') }}">
                  <span class="nav-link-text" data-i18n="nav.tables_basic_tables">{{ getPhrase('list') }}</span>
              </a>
          </li>
          <li>
              <a href="{{URL_COUPONS_ADD}}" title="{{ getPhrase('add') }}" data-filter-tags="{{ getPhrase('add') }}e">
                  <span class="nav-link-text" data-i18n="nav.tables_generate_table_style">{{ getPhrase('add') }}</span>
              </a>
          </li>
      </ul>
  </li>
  
  <li {{ isActive($active_class, 'events') }} >
      <a href="{{URL_EVENTS}}" title="{{ getPhrase('events') }}" data-filter-tags="{{ getPhrase('events') }}">
          <i class="fal fa-edit"></i>
          <span class="nav-link-text" data-i18n="nav.form_stuff">{{ getPhrase('events') }}</span>
      </a>
  </li>														
  
  <li {{ isActive($active_class, 'trainings') }} >
      <a href="{{URL_TRAININGS}}" title="{{ getPhrase('trainings') }}" data-filter-tags="{{ getPhrase('trainings') }}">
          <i class="fal fa-shield-alt"></i>
          <span class="nav-link-text" data-i18n="nav.plugins">{{ getPhrase('trainings') }}</span>
      </a>
  </li>
  
  <li {{ isActive($active_class, 'partners') }} >
      <a href="{{URL_PARTNERS}}" title="{{ getPhrase('partners') }}" data-filter-tags="{{ getPhrase('partners') }}">
          <i class="fal fa-table"></i>
          <span class="nav-link-text" data-i18n="nav.datatables">{{ getPhrase('partners') }}</span>
      </a>
  </li>
  
  <li class="nav-title">Контент</li>

  <li {{ isActive($active_class, 'messages') }} > 
      <a href="{{URL_MESSAGES}}" title="{{ getPhrase('messages')}}" data-filter-tags="{{ getPhrase('messages')}}">
          <i class="fal fa-chart-pie"></i>
          <span class="nav-link-text" data-i18n="nav.statistics">{{ getPhrase('messages')}}</span>
          <span class="dl-ref label bg-primary-500 ml-2">{{$count = Auth::user()->newThreadsCount()}}</span>
      </a>                                
  </li>
  <li {{ isActive($active_class, 'feedback') }} >
      <a href="{{URL_FEEDBACKS}}" title="{{ getPhrase('feedback') }}" data-filter-tags="{{ getPhrase('feedback') }}">
          <i class="fal fa-exclamation-circle"></i>
          <span class="nav-link-text" data-i18n="nav.notifications">{{ getPhrase('feedback') }}</span>
      </a>
  </li>
  <li {{ isActive($active_class, 'pages') }} > 
      <a href="{{URL_PAGES}}" title="{{ getPhrase('pages') }}" data-filter-tags="{{ getPhrase('pages') }}">
          <i class="fal fa-credit-card-front"></i>
          <span class="nav-link-text" data-i18n="nav.form_plugins">{{ getPhrase('pages') }}</span>
      </a>                                
  </li>
  <li {{ isActive($active_class, 'blogs') }} >
      <a href="{{URL_BLOGS}}" title="{{ getPhrase('blogs') }}" data-filter-tags="{{ getPhrase('blogs') }}">
          <i class="fal fa-globe"></i>
          <span class="nav-link-text" data-i18n="nav.miscellaneous">{{ getPhrase('blogs') }}</span>
      </a>                                
  </li>
  <li {{ isActive($active_class, 'faqs') }} >
      <a href="#" title="{{ getPhrase('faqs') }}" data-filter-tags="{{ getPhrase('faqs') }}">
          <i class="fal fa-globe"></i>
          <span class="nav-link-text" data-i18n="nav.miscellaneous">{{ getPhrase('faqs') }}</span>
      </a>
      <ul>
          <li>
              <a href="{{URL_FAQ_CATEGORIES}}" title="{{ getPhrase('categories') }}" data-filter-tags="{{ getPhrase('categories') }}">
                  <span class="nav-link-text" data-i18n="nav.pages_chat">{{ getPhrase('categories') }}</span>
              </a>
          </li>
          <li>
              <a href="{{URL_FAQ_QUESTIONS}}" title="{{ getPhrase('faqs') }}" data-filter-tags="{{ getPhrase('faqs') }}">
                  <span class="nav-link-text" data-i18n="nav.pages_chat">{{ getPhrase('faqs') }}</span>
              </a>
          </li>
      </ul>                               
  </li>
  
  <li class="nav-title">Настройки</li>
  <li {{ isActive($active_class, 'master_settings') }} >
      <a href="#" title="{{ getPhrase('master_settings') }}" data-filter-tags="{{ getPhrase('master_settings') }}">
          <i class="fal fa-plus-circle"></i>
          <span class="nav-link-text" data-i18n="nav.pages">{{ getPhrase('master_settings') }}</span>
      </a>
      <ul>
          @if(checkRole(getUserGrade(1)))
          <li>
              <a href="{{URL_MASTERSETTINGS_SETTINGS}}" title="{{ getPhrase('settings') }}" data-filter-tags="{{ getPhrase('settings') }}">
                  <span class="nav-link-text" data-i18n="nav.pages_chat">{{ getPhrase('settings') }}</span>
              </a>
          </li>
          @endif
          <li>
              <a href="{{URL_THEMES_LIST}}" title="{{ getPhrase('themes') }}" data-filter-tags="{{ getPhrase('themes') }}">
                  <span class="nav-link-text" data-i18n="nav.pages_contacts">{{ getPhrase('themes') }}</span>
              </a>
          </li>
          <li> 
              <a href="{{URL_LANGUAGES_LIST}}" title="{{ getPhrase('languages') }}" data-filter-tags="{{ getPhrase('languages') }}">
                  <span class="nav-link-text" data-i18n="nav.application_intel_marketing_dashboard">{{ getPhrase('languages') }}</span>
              </a>
          </li>
      </ul>
  </li>
</ul>