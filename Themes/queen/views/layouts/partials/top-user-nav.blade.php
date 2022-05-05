<div>
    <a href="#" data-toggle="dropdown" title="{{Auth::user()->name}}" class="header-icon d-flex align-items-center justify-content-center ml-2">
        <img src="{{ getProfilePath(Auth::user()->image, 'thumb') }}" alt="{{Auth::user()->name}}" class="profile-image rounded-circle">
        <!-- you can also add username next to the avatar with the codes below:
<span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">Me</span>
<i class="ni ni-chevron-down hidden-xs-down"></i> -->
    </a>	

    <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
        <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
            <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                <span class="mr-2">
                    <img src="{{ getProfilePath(Auth::user()->image, 'thumb') }}" alt="{{Auth::user()->name}}" class="rounded-circle profile-image" >
                </span>
                <div class="info-card-text">
                    <div class="fs-lg text-truncate text-truncate-lg">{{Auth::user()->name}}</div>
                    <span class="text-truncate text-truncate-md opacity-80">{{Auth::user()->region}}</span>
                </div>
            </div>
        </div>
        <div class="dropdown-divider m-0"></div>
        {{-- change password --}}
        <a href="{{URL_USERS_CHANGE_PASSWORD}}{{Auth::user()->slug}}" class="dropdown-item">
            <span data-i18n="drpdwn.reset_layout">{{ getPhrase('change_password') }}</span>
        </a>
        <a href="{{URL_USER_DETAILS}}{{Auth::user()->slug}}" class="dropdown-item">
            <span data-i18n="drpdwn.settings">{{ getPhrase('Детали профиля') }}</span>
        </a>
        <a href="{{URL_USERS_EDIT}}{{Auth::user()->slug}}" class="dropdown-item">
            <span data-i18n="drpdwn.settings">{{ getPhrase('Настройки профиля') }}</span>
        </a>
        <div class="dropdown-divider m-0"></div>
        @if(checkRole(getUserGrade(2)))
          <a href="{{URL_LANGUAGES_LIST}}" class="dropdown-item">
              <span data-i18n="drpdwn.languages">{{ getPhrase('languages') }}</span>
          </a>                        
        @endif        
        <div class="dropdown-divider m-0"></div>
        <a class="dropdown-item fw-500 pt-3 pb-3" href="{{URL_USERS_LOGOUT}}">
            <span data-i18n="drpdwn.page-logout">{{ getPhrase('logout') }}</span>
            <span class="float-right fw-n">&commat;{{Auth::user()->name}}</span>
        </a>
    </div>
</div>