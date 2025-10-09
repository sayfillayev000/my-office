
<header class="adminuiux-header"> 
    <!-- Fixed navbar --> 
    <nav class="navbar navbar-expand-lg fixed-top"> 
        <div class="container-fluid"> 
 
            <!-- main sidebar toggle --> 
            <button class="btn btn-link btn-square sidebar-toggler" type="button" onclick="initSidebar()"> 
                <i class="sidebar-svg" data-feather="menu"></i> 
            </button> 
 
            <!-- logo --> 
            <a class="navbar-brand" href="#"> 
                <img data-bs-img="light" src="https://my.synterra.uz/static/images/synterra_logo.png" alt=""> 
                <img data-bs-img="dark" src="https://my.synterra.uz/assets/img/logo.svg" alt=""> 
                <div class=""> 
                    <span class="h5">Synterra<b>UZ</b></span> 
                    <p class="fs-12 opacity-75">Makonlar birlashadi</p> 
                </div> 
            </a> 
 
            <!-- right icons button --> 
            <div class="ms-auto"> 
                <!-- global search toggle --> 
                <button class="btn btn-link btn-square btn-icon btn-link-header" type="button" onclick="openSearch()"> 
                    <i data-feather="search"></i> 
                </button> 
 
                <!-- dark mode --> 
                <button class="btn btn-link btn-square btnsunmoon btn-link-header" id="btn-layout-modes-dark-page"> 
                    <i class="sun mx-auto" data-feather="sun"></i> 
                    <i class="moon mx-auto" data-feather="moon"></i> 
                </button> 
 
                <!-- language dropdown --> 
                <div class="dropdown d-none d-sm-inline-block"> 
                    <button class="btn btn-link btn-square btn-icon btn-link-header dropdown-toggle no-caret" type="button" data-bs-toggle="dropdown" aria-expanded="false"> <i class="bi bi-translate"></i> 
                    </button><ul class="dropdown-menu dropdown-menu-end"> 
                        <li><a class="dropdown-item active" data-value="OZ">O'Z - O'zbek</a></li> 
                        <li><a class="dropdown-item" data-value="UZ">ЎЗ - Ўзбек</a></li> 
                        <li><a class="dropdown-item" data-value="RU">RU - Русский</a></li> 
                        <li><a class="dropdown-item" data-value="EN">EN - English</a></li> 
                    </ul> 
                </div> 
 
                <!-- notification dropdown --> 
                <div class="dropdown d-inline-block"> 
                    <button class="btn btn-link btn-square btn-icon btn-link-header dropdown-toggle no-caret" type="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                        <i data-feather="bell"></i> 
 
                    </button> 
                    <ul class="dropdown-menu dropdown-menu-end notification-dd sm-mi-45px"> 
 
 
                        <li class="text-center"> 
                            <a href="#" class="btn btn-link text-center"> 
                                View all <i class="bi bi-arrow-right fs-14"></i> 
                            </a> 
                        </li> 
                    </ul> 
                </div> 
 
                <!-- profile dropdown --> 
                <div class="dropdown d-inline-block"> 
                    <a class="dropdown-toggle btn btn-link btn-square btn-link-header style-none no-caret px-0" id="userprofiledd" data-bs-toggle="dropdown" aria-expanded="false" role="button"> 
                        <div class="row gx-0 d-inline-flex"> 
                            <div class="col-auto align-self-center"> 
                                <figure class="avatar avatar-28 rounded-circle coverimg align-middle"> 
                                    <img src="https://my.synterra.uz/assets/img/modern-ai-image/user-6.jpg" alt="" id="userphotoonboarding2"> 
                                </figure> 
                            </div> 
                        </div> 
                    </a> 
                    <div class="dropdown-menu dropdown-menu-end width-300 pt-0 px-0" aria-labelledby="userprofiledd"> 
                        <div class="bg-theme-1-space rounded py-3 mb-3 dropdown-dontclose"> 
                            <div class="row gx-0"> 
                                <div class="col-auto px-3"> 
                                    <figure class="avatar avatar-50 rounded-circle coverimg align-middle"> 
                                        <img src="https://my.synterra.uz/assets/img/modern-ai-image/user-6.jpg" alt=""> 
                                    </figure> 
                                </div> 
                                <div class="col align-self-center "> 
                                    <p class="mb-1"><span>AdminUIUX</span></p> 
                                    <p><i class="bi bi-wallet2 me-2"></i> $1100.00 <small class="opacity-50">Balance</small> 
                                    </p> 
                                </div> 
                            </div> 
                        </div> 
                        <div class="px-2"> 
                            <div><a class="dropdown-item" href="#"><i data-feather="user" class="avatar avatar-18 me-1"></i> My 
                                Profile</a> 
                            </div> 
                            <div> 
                                <a class="dropdown-item" href="#"> 
                                    <div class="row g-0"> 
                                        <div class="col align-self-center"><i data-feather="layout" class="avatar avatar-18 me-1"></i> 
                                            My Dashboard 
                                        </div> 
                                        <div class="col-auto"> 
                                            <figure class="avatar avatar-20 coverimg rounded-circle"> 
                                                <img src="https://my.synterra.uz/assets/img/modern-ai-image/user-1.jpg" alt=""> 
                                            </figure><figure class="avatar avatar-20 coverimg rounded-circle"> 
                                                <img src="https://my.synterra.uz/assets/img/modern-ai-image/user-2.jpg" alt=""> 
                                            </figure> 
                                            <figure class="avatar avatar-20 coverimg rounded-circle"> 
                                                <img src="https://my.synterra.uz/assets/img/modern-ai-image/user-4.jpg" alt=""> 
                                            </figure> 
                                            <div class="avatar avatar-20 bg-theme-1 rounded-circle text-center align-middle"> 
                                                <small class="fs-10 align-middle">9+</small> 
                                            </div> 
                                        </div> 
                                    </div> 
                                </a> 
                            </div> 
                            <div> 
                                <a class="dropdown-item" href="#"> 
                                    <i data-feather="dollar-sign" class="avatar avatar-18 me-1"></i> Earning 
                                </a> 
                            </div> 
                            <div> 
                                <a class="dropdown-item" href="#"> 
                                    <div class="row gx-3"> 
                                        <div class="col"><i data-feather="gift" class="avatar avatar-18 me-1"></i> Subscription</div> 
                                        <div class="col-auto"> 
                                            <p class="small text-success">Upgrade</p> 
                                        </div> 
                                        <div class="col-auto"><span class="arrow bi bi-chevron-right"></span></div> 
                                    </div> 
                                </a> 
                            </div> 
                            <div class="dropdown open-left dropdown-dontclose"> 
                                <a class="dropdown-item" data-bs-toggle="dropdown" aria-expanded="false" role="button"> 
                                    <div class="row gx-3"> 
                                        <div class="col"><i class="bi bi-translate avatar avatar-18 me-1"></i> Language</div> 
                                        <div class="col-auto"><small class="vm">EN - English</small> <i class="bi bi-translate"></i></div> 
                                        <div class="col-auto"><span class="arrow bi bi-chevron-right"></span></div> 
                                    </div> 
                                </a> 
                                <div class="dropdown-menu dropdown-menu-end"> 
                                    <div><a class="dropdown-item active" data-value="EN">EN - English</a></div> 
                                    <div><a class="dropdown-item" data-value="FR">FR - French</a></div> 
                                    <div><a class="dropdown-item" data-value="CH">CH - Chinese</a></div> 
                                    <div><a class="dropdown-item" data-value="HI">HI - Hindi</a></div> 
                                </div> 
                            </div> 
                            <div> 
                                <a class="dropdown-item" href="#"> 
                                    <i data-feather="settings" class="avatar avatar-18 me-1"></i> Account Setting 
                                </a> 
                            </div> 
                            <div> 
                                <a class="dropdown-item theme-red" href="#"> 
                                    <i data-feather="power" class="avatar avatar-18 me-1"></i> Logout 
                                </a> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
 
            </div> 
        </div> 
    </nav> 
 
    <!-- search global wrap --> 
    <div class="adminuiux-search-full"><div class="row gx-2 align-items-center"> 
            <div class="col-auto"> 
                <!-- close global search toggle --> 
                <button class="btn btn-link btn-square " type="button" onclick="closeSearch()"> 
                    <i data-feather="arrow-left"></i> 
                </button> 
            </div> 
            <div class="col"> 
                <input class="form-control pe-0 border-0" type="search" placeholder="Type something here..."> 
            </div> 
            <div class="col-auto"> 
                <!-- filter dropdown --> 
                <div class="dropdown input-group-text border-0 p-0"> 
                    <button class="dropdown-toggle btn btn-link btn-square no-caret" type="button" id="searchfilter2" data-bs-toggle="dropdown" aria-expanded="false"> 
                        <i data-feather="sliders"></i> 
                    </button> 
                    <div class="dropdown-menu dropdown-menu-end dropdown-dontclose width-300"> 
                        <ul class="nav adminuiux-nav" id="searchtab2" role="tablist"> 
                            <li class="nav-item" role="presentation"> 
                                <button class="nav-link active" id="searchall-tab2" data-bs-toggle="tab" data-bs-target="#searchall2" type="button" role="tab" aria-controls="searchall2" aria-selected="true">All</button> 
                            </li> 
                            <li class="nav-item" role="presentation"> 
                                <button class="nav-link" id="searchorders-tab2" data-bs-toggle="tab" data-bs-target="#searchorders2" type="button" role="tab" aria-controls="searchorders2" aria-selected="false" tabindex="-1">Orders</button> 
                            </li> 
                            <li class="nav-item" role="presentation"> 
                                <button class="nav-link" id="searchcontacts-tab2" data-bs-toggle="tab" data-bs-target="#searchcontacts2" type="button" role="tab" aria-controls="searchcontacts2" aria-selected="false" tabindex="-1">Contacts</button> 
                            </li> 
                        </ul> 
                        <div class="tab-content py-3" id="searchtabContent"> 
                            <div class="tab-pane fade active show" id="searchall2" role="tabpanel" aria-labelledby="searchall-tab2"> 
                                <ul class="list-group adminuiux-list-group list-group-flush bg-none show"> 
                                    <li class="list-group-item"> 
                                        <div class="row gx-3"> 
                                            <div class="col">Search apps</div> 
                                            <div class="col-auto"> 
                                                <div class="form-check form-switch"> 
                                                    <input class="form-check-input" type="checkbox" role="switch" id="searchswitch1"> 
                                                    <label class="form-check-label" for="searchswitch1"></label> 
                                                </div> 
                                            </div> 
                                        </div> 
                                    </li> 
                                    <li class="list-group-item"> 
                                        <div class="row gx-3"> 
                                            <div class="col">Include Pages</div> 
                                            <div class="col-auto"> 
                                                <div class="form-check form-switch"> 
                                                    <input class="form-check-input" type="checkbox" role="switch" id="searchswitch2" checked=""> 
                                                    <label class="form-check-label" for="searchswitch2"></label> 
                                                </div> 
                                            </div> 
                                        </div></li> 
                                    <li class="list-group-item"> 
                                        <div class="row gx-3"> 
                                            <div class="col">Internet resource</div> 
                                            <div class="col-auto"> 
                                                <div class="form-check form-switch"> 
                                                    <input class="form-check-input" type="checkbox" role="switch" id="searchswitch3" checked=""> 
                                                    <label class="form-check-label" for="searchswitch3"></label> 
                                                </div> 
                                            </div> 
                                        </div> 
                                    </li> 
                                    <li class="list-group-item"> 
                                        <div class="row gx-3"> 
                                            <div class="col">News and Blogs</div> 
                                            <div class="col-auto"> 
                                                <div class="form-check form-switch"> 
                                                    <input class="form-check-input" type="checkbox" role="switch" id="searchswitch4"> 
                                                    <label class="form-check-label" for="searchswitch4"></label> 
                                                </div> 
                                            </div> 
                                        </div> 
                                    </li> 
                                </ul> 
                            </div> 
                            <div class="tab-pane fade" id="searchorders2" role="tabpanel" aria-labelledby="searchorders-tab2"> 
                                <ul class="list-group adminuiux-list-group list-group-flush bg-none show"> 
                                    <li class="list-group-item"> 
                                        <div class="row gx-3"> 
                                            <div class="col">Show order ID</div> 
                                            <div class="col-auto"> 
                                                <div class="form-check form-switch"> 
                                                    <input class="form-check-input" type="checkbox" role="switch" id="searchswitch5"> 
                                                    <label class="form-check-label" for="searchswitch5"></label> 
                                                </div> 
                                            </div> 
                                        </div> 
                                    </li> 
                                    <li class="list-group-item"> 
                                        <div class="row gx-3"> 
                                            <div class="col">International Order</div> 
                                            <div class="col-auto"> 
                                                <div class="form-check form-switch"> 
                                                    <input class="form-check-input" type="checkbox" role="switch" id="searchswitch6" checked=""> 
                                                    <label class="form-check-label" for="searchswitch6"></label> 
                                                </div> 
                                            </div> 
                                        </div> 
                                    </li> 
                                    <li class="list-group-item"> 
                                        <div class="row gx-3"> 
                                            <div class="col">Taxable Product</div> 
                                            <div class="col-auto"> 
                                                <div class="form-check form-switch"><input class="form-check-input" type="checkbox" role="switch" id="searchswitch7" checked=""> 
                                                    <label class="form-check-label" for="searchswitch7"></label> 
                                                </div> 
                                            </div> 
                                        </div> 
                                    </li> 
                                    <li class="list-group-item"> 
                                        <div class="row gx-3"> 
                                            <div class="col">Published Product</div> 
                                            <div class="col-auto"> 
                                                <div class="form-check form-switch"> 
                                                    <input class="form-check-input" type="checkbox" role="switch" id="searchswitch8"> 
                                                    <label class="form-check-label" for="searchswitch8"></label> 
                                                </div> 
                                            </div> 
                                        </div> 
                                    </li> 
                                </ul> 
                            </div> 
                            <div class="tab-pane fade" id="searchcontacts2" role="tabpanel" aria-labelledby="searchcontacts-tab2"> 
                                <ul class="list-group adminuiux-list-group list-group-flush bg-none show"> 
                                    <li class="list-group-item"> 
                                        <div class="row gx-3"> 
                                            <div class="col">Have email ID</div> 
                                            <div class="col-auto"> 
                                                <div class="form-check form-switch"> 
                                                    <input class="form-check-input" type="checkbox" role="switch" id="searchswitch9"> 
                                                    <label class="form-check-label" for="searchswitch9"></label> 
                                                </div> 
                                            </div> 
                                        </div> 
                                    </li> 
                                    <li class="list-group-item"> 
                                        <div class="row gx-3"> 
                                            <div class="col">Have phone number</div> 
                                            <div class="col-auto"> 
                                                <div class="form-check form-switch"> 
                                                    <input class="form-check-input" type="checkbox" role="switch" id="searchswitch10" checked=""> 
                                                    <label class="form-check-label" for="searchswitch10"></label> 
                                                </div> 
                                            </div> 
                                        </div> 
                                    </li> 
                                    <li class="list-group-item"> 
                                        <div class="row gx-3"> 
                                            <div class="col">Photo available</div> 
                                            <div class="col-auto"> 
                                                <div class="form-check form-switch"> 
                                                    <input class="form-check-input" type="checkbox" role="switch" id="searchswitch11" checked=""> 
                                                    <label class="form-check-label" for="searchswitch11"></label> 
                                                </div> 
                                            </div> 
                                        </div> 
                                    </li><li class="list-group-item"> 
                                        <div class="row gx-3"> 
                                            <div class="col">Referral</div> 
                                            <div class="col-auto"> 
                                                <div class="form-check form-switch"> 
                                                    <input class="form-check-input" type="checkbox" role="switch" id="searchswitch12"> 
                                                    <label class="form-check-label" for="searchswitch12"></label> 
                                                </div> 
                                            </div> 
                                        </div> 
                                    </li> 
                                </ul> 
                            </div> 
                        </div> 
                        <div class=""> 
                            <div class="row gx-3"> 
                                <div class="col"><button class="btn btn-link">Reset</button></div> 
                                <div class="col-auto"> 
                                    <button class="btn btn-theme">Apply</button> 
                                </div> 
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
</header> 