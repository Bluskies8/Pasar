<header class="w-100 d-flex" style="height: 50px;background: #dfe7f1;">
    <div class="h-100 p-1 d-flex align-items-center justify-content-center" style="min-width: 200px;max-width: 200px;border-right: 1px solid lightgrey;">
        <p style="color: rgb(24, 144, 255);font-size: 30px;font-weight: bold;">LOGO</p>
    </div>
    <div class="w-100 d-flex justify-content-between">
        <div class="d-flex align-items-center"><i class="fas fa-plus-circle fa-xl ms-3 me-2" data-bs-toggle="tooltip" data-bss-tooltip="" data-bs-placement="bottom" id="quick-create" title="Quick Create"></i><i class="fas fa-clock fa-xl ms-2 me-3" data-bs-toggle="tooltip" data-bss-tooltip="" data-bs-placement="bottom" id="recent-activity" title="Recent Activity"></i>
            <div id="searchbar" class="d-none d-lg-flex">
                <div class="dropdown">
                    <button class="btn dropdown-toggle d-flex align-items-center" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="height: 34px;box-shadow: none;">
                        <i class="fas fa-search" style="font-size: 16px;"></i></button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">First Item</a>
                        <a class="dropdown-item" href="#">Second Item</a>
                        <a class="dropdown-item" href="#">Third Item</a>
                    </div>
                </div><input type="text" style="outline: none;border: none;width: 225px;" placeholder="Search">
            </div>
        </div>
        <div class="d-flex align-items-center">
            <div class="me-3 position-relative"><i class="fas fa-bell fa-xl" data-bs-toggle="tooltip" data-bss-tooltip="" data-bs-placement="bottom" title="Notifications"></i>
                <p class="position-absolute rounded-circle d-flex align-items-center justify-content-center notification-nudge">0</p>
            </div>
            <div class="me-3 position-relative"><i class="fas fa-folder-open fa-xl"></i>
                <p class="position-absolute rounded-circle d-flex align-items-center justify-content-center notification-nudge">0</p>
            </div>
            <i class="fas fa-cog fa-xl me-3"></i>
            <i class="fas fa-question-circle fa-xl me-3"></i>
            <div class="dropdown me-4">
                <button class="btn p-0" aria-expanded="false" data-bs-toggle="dropdown" type="button" style="outline: none;box-shadow: none;">
                    <img class="rounded-circle" style="width: 40px;height: 40px;" src="{{asset('img/logo.svg')}}">
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" style="cursor: default;">Profile</a>
                    <a href="/logout" class="dropdown-item" style="cursor: default;">Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>
