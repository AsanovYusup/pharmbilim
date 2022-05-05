<nav class="shortcut-menu d-none d-sm-block">
  <input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
  <label for="menu_open" class="menu-open-button ">
    <span class="app-shortcut-icon d-block"></span>
  </label>
  <a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Вверх">
    <i class="fal fa-arrow-up"></i>
  </a>
  <a href="<?php echo e(URL_USERS_LOGOUT); ?>" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="<?php echo e(getPhrase('logout')); ?>">
    <i class="fal fa-sign-out"></i>
  </a>
  <a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="left"
    title="Полный экран">
    <i class="fal fa-expand"></i>
  </a>
  <a href="#" class="menu-item btn" data-action="app-print" data-toggle="tooltip" data-placement="left"
    title="Распечатать страницу">
    <i class="fal fa-print"></i>
  </a>
  <a href="https://wa.me/996505003744" class="menu-item btn" data-toggle="tooltip" data-placement="left"
    title="Написать по Ватсап">
    <i class="fab fa-whatsapp"></i>
  </a>
  
</nav>