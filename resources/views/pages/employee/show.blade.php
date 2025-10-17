@extends('layouts.app')

@section('content')    <div class="container mt-3">
                            <div class="card adminuiux-card mb-3">
                                <div class="card-header">
                                    <div class="row gx-3 align-items-center">
                                        <div class="col">
                                            <p class="h6">Standard Modal</p>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-outline-theme btn-square" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false">
                                                <i class="bi bi-code-slash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <button type="button" class="btn btn-theme" data-bs-toggle="modal" data-bs-target="#standardmodal">
                                        Standard modal
                                    </button>
                                </div>
                                <div class="collapse" id="collapse1">
                                    <div class="card-footer border-top">
                                        <div class="bg-dark text-white p-2 rounded my-2">
                                            <pre class="mb-2"><code class="code rounded language-html">
&lt;button type="button" class="btn btn-theme" data-bs-toggle="modal" data-bs-target="#standardmodal"&gt;
    Standard modal
&lt;/button&gt;

&lt;!-- Standard Modal --&gt;
&lt;div class="modal fade" id="standardmodal" tabindex="-1" aria-labelledby="standardmodalLabel" aria-hidden="true"&gt;
    &lt;div class="modal-dialog"&gt;
        &lt;div class="modal-content"&gt;
            &lt;div class="modal-header"&gt;
                &lt;p class="modal-title h5" id="standardmodalLabel"&gt;Modal title&lt;/p&gt;
                &lt;button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"&gt;&lt;/button&gt;
            &lt;/div&gt;
            &lt;div class="modal-body"&gt;
                ...
            &lt;/div&gt;
            &lt;div class="modal-footer"&gt;
                &lt;button type="button" class="btn btn-secondary" data-bs-dismiss="modal"&gt;Close&lt;/button&gt;
                &lt;button type="button" class="btn btn-theme"&gt;Save changes&lt;/button&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
                    </code></pre>
                                            <button type="button" class="btn btn-outline-light  btn-square copycode"><i class="bi bi-clipboard"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card adminuiux-card mb-3">
                                <div class="card-header">
                                    <div class="row gx-3 align-items-center">
                                        <div class="col">
                                            <p class="h6">Modal Scrolling Content</p>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-outline-theme btn-square" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false">
                                                <i class="bi bi-code-slash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <button type="button" class="btn btn-theme" data-bs-toggle="modal" data-bs-target="#scrollingmodal">
                                        Scrolling modal
                                    </button>
                                </div>
                                <div class="collapse" id="collapse2">
                                    <div class="card-footer border-top">
                                        <div class="bg-dark text-white p-2 rounded my-2">
                                            <pre class="mb-2"><code class="code rounded language-html">
&lt;button type="button" class="btn btn-theme" data-bs-toggle="modal" data-bs-target="#scrollingmodal"&gt;
    Scrolling modal
&lt;/button&gt;

&lt;!-- scrolling Modal --&gt;
&lt;div class="modal fade" id="scrollingmodal" tabindex="-1" aria-labelledby="scrollingmodalLabel" aria-hidden="true"&gt;
    &lt;div class="modal-dialog modal-dialog-scrollable"&gt;
        &lt;div class="modal-content"&gt;
            &lt;div class="modal-header"&gt;
                &lt;p class="modal-title h5" id="scrollingmodalLabel"&gt;modal-dialog-scrollable&lt;/p&gt;
                &lt;button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"&gt;&lt;/button&gt;
            &lt;/div&gt;
            &lt;div class="modal-body"&gt;
                &lt;p class="mb-5"&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla id varius sapien, eget finibus leo. Mauris lorem elit, efficitur eget enim et, rhoncus hendrerit ligula. Phasellus lobortis massa hendrerit velit volutpat, sed hendrerit ante semper. Sed at interdum turpis. Donec elementum lobortis magna, porttitor luctus dui gravida vel. Donec vestibulum consectetur elit, id finibus erat egestas nec. Curabitur efficitur rutrum arcu, sed interdum est consequat eu. Curabitur lacus leo, semper fringilla lacus in, vehicula rhoncus nisl. Vestibulum efficitur ligula quis ornare pharetra. Nulla tempus ultricies neque interdum luctus. Integer mollis laoreet eleifend. Nullam eu luctus massa, nec tempor mauris.&lt;/p&gt;
                &lt;p class="mb-5"&gt;Curabitur vitae odio enim. Vestibulum condimentum diam sit amet lacus dignissim, vitae condimentum neque dictum. Aliquam rhoncus, lorem sit amet mollis scelerisque, mi felis bibendum sapien, in sollicitudin nisl lorem eu nisi. Vivamus elementum quam vitae aliquam tempus. Ut pulvinar efficitur ante, in varius mi lacinia et. Vivamus consequat quam lectus. Pellentesque tincidunt condimentum nisi, sed semper turpis cursus a. Nulla id libero a augue placerat elementum id ornare ipsum.&lt;/p&gt;
                &lt;p class="mb-5"&gt;Suspendisse auctor pretium felis bibendum blandit. Mauris volutpat, massa quis tempus sodales, tortor odio lobortis odio, et pulvinar mauris tortor eget augue. Suspendisse vel pulvinar massa, hendrerit laoreet turpis. Donec eu urna posuere, porttitor lectus at, porta mi. Aliquam erat volutpat. Proin nec tortor sagittis, ornare turpis a, iaculis odio. Nulla id enim non dolor gravida porttitor. Vestibulum eget est lacus. Vivamus quis libero vitae nibh ullamcorper sagittis nec in sem.&lt;/p&gt;
                &lt;p class="mb-5"&gt;Morbi lectus risus, ultricies vel justo in, efficitur semper dui. Sed sit amet leo ullamcorper, viverra est quis, blandit turpis. Phasellus tincidunt lectus non lorem suscipit, in dignissim est ultrices. In cursus risus sed quam ornare volutpat. Sed in tortor molestie, viverra erat sed, ullamcorper eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse potenti.&lt;/p&gt;
                &lt;p class="mb-5"&gt;Praesent dapibus dolor vel urna sagittis, id vehicula tortor varius. Aenean feugiat egestas posuere. Maecenas at condimentum tellus. Aenean elementum pharetra velit, sit amet porttitor erat efficitur eu. In sed tellus eu mi malesuada porttitor. Donec ultricies bibendum leo, ac venenatis quam. Phasellus sed risus id leo rhoncus cursus eu tincidunt turpis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi justo libero, consectetur at tristique et, rhoncus quis metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Mauris at cursus turpis. Integer quis nibh tempus, tincidunt leo sed, lacinia turpis. Sed facilisis orci a elit sagittis condimentum. Ut laoreet eget ex ut euismod. Donec vitae ipsum non lectus mollis ultricies. In hac habitasse platea dictumst.&lt;/p&gt;
            &lt;/div&gt;
            &lt;div class="modal-footer"&gt;
                &lt;button type="button" class="btn btn-secondary" data-bs-dismiss="modal"&gt;Close&lt;/button&gt;
                &lt;button type="button" class="btn btn-theme"&gt;Save changes&lt;/button&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
                    </code></pre>
                                            <button type="button" class="btn btn-outline-light  btn-square copycode"><i class="bi bi-clipboard"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card adminuiux-card mb-3">
                                <div class="card-header">
                                    <div class="row gx-3 align-items-center">
                                        <div class="col">
                                            <p class="h6">Modal Vertical Middle</p>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-outline-theme btn-square" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false">
                                                <i class="bi bi-code-slash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <button type="button" class="btn btn-theme" data-bs-toggle="modal" data-bs-target="#verticalmiddlemodal">
                                        Vertical middle modal
                                    </button>
                                </div>
                                <div class="collapse" id="collapse3">
                                    <div class="card-footer border-top">
                                        <div class="bg-dark text-white p-2 rounded my-2">
                                            <pre class="mb-2"><code class="code rounded language-html">
&lt;button type="button" class="btn btn-theme" data-bs-toggle="modal" data-bs-target="#verticalmiddlemodal"&gt;
    Vertical middle modal
&lt;/button&gt;

&lt;!-- vertical middle Modal --&gt;
&lt;div class="modal fade" id="verticalmiddlemodal" tabindex="-1" aria-labelledby="verticalmiddlemodalLabel" aria-hidden="true"&gt;
    &lt;div class="modal-dialog modal-dialog-centered"&gt;
        &lt;div class="modal-content"&gt;
            &lt;div class="modal-header"&gt;
                &lt;p class="modal-title h5" id="verticalmiddlemodalLabel"&gt;modal-dialog-centered&lt;/p&gt;
                &lt;button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"&gt;&lt;/button&gt;
            &lt;/div&gt;
            &lt;div class="modal-body"&gt;
                ...
            &lt;/div&gt;
            &lt;div class="modal-footer"&gt;
                &lt;button type="button" class="btn btn-secondary" data-bs-dismiss="modal"&gt;Close&lt;/button&gt;
                &lt;button type="button" class="btn btn-theme"&gt;Save changes&lt;/button&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
                    </code></pre>
                                            <button type="button" class="btn btn-outline-light  btn-square copycode"><i class="bi bi-clipboard"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card adminuiux-card mb-3">
                                <div class="card-header">
                                    <div class="row gx-3 align-items-center">
                                        <div class="col">
                                            <p class="h6">Modal Sizes</p>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-outline-theme btn-square" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false">
                                                <i class="bi bi-code-slash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <button type="button" class="btn btn-theme me-2 my-1" data-bs-toggle="modal" data-bs-target="#xlmodal">
                                        Extra Large modal
                                    </button>
                                    <button type="button" class="btn btn-theme me-2 my-1" data-bs-toggle="modal" data-bs-target="#lgmodal">
                                        Large modal
                                    </button> my-1
                                    <button type="button" class="btn btn-theme me-2 my-1" data-bs-toggle="modal" data-bs-target="#smmodal">
                                        small modal
                                    </button>
                                </div>
                                <div class="collapse" id="collapse4">
                                    <div class="card-footer border-top">
                                        <div class="bg-dark text-white p-2 rounded my-2">
                                            <pre class="mb-2"><code class="code rounded language-html">
&lt;button type="button" class="btn btn-theme me-2" data-bs-toggle="modal" data-bs-target="#xlmodal"&gt;
    Extra Large modal
&lt;/button&gt;
&lt;button type="button" class="btn btn-theme me-2" data-bs-toggle="modal" data-bs-target="#lgmodal"&gt;
    Large modal
&lt;/button&gt;
&lt;button type="button" class="btn btn-theme me-2" data-bs-toggle="modal" data-bs-target="#smmodal"&gt;
    small modal
&lt;/button&gt;

&lt;!-- modal-xl Modal --&gt;
&lt;div class="modal fade" id="xlmodal" tabindex="-1" aria-labelledby="xlmodalLabel" aria-hidden="true"&gt;
    &lt;div class="modal-dialog modal-xl"&gt;
        &lt;div class="modal-content"&gt;
            &lt;div class="modal-header"&gt;
                &lt;p class="modal-title h5" id="xlmodalLabel"&gt;modal-xl&lt;/p&gt;
                &lt;button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"&gt;&lt;/button&gt;
            &lt;/div&gt;
            &lt;div class="modal-body"&gt;
                ...
            &lt;/div&gt;
            &lt;div class="modal-footer"&gt;
                &lt;button type="button" class="btn btn-secondary" data-bs-dismiss="modal"&gt;Close&lt;/button&gt;
                &lt;button type="button" class="btn btn-theme"&gt;Save changes&lt;/button&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;

&lt;!-- modal-lg Modal --&gt;
&lt;div class="modal fade" id="lgmodal" tabindex="-1" aria-labelledby="lgmodalLabel" aria-hidden="true"&gt;
    &lt;div class="modal-dialog modal-lg"&gt;
        &lt;div class="modal-content"&gt;
            &lt;div class="modal-header"&gt;
                &lt;p class="modal-title h5" id="lgmodalLabel"&gt;modal-lg&lt;/p&gt;
                &lt;button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"&gt;&lt;/button&gt;
            &lt;/div&gt;
            &lt;div class="modal-body"&gt;
                ...
            &lt;/div&gt;
            &lt;div class="modal-footer"&gt;
                &lt;button type="button" class="btn btn-secondary" data-bs-dismiss="modal"&gt;Close&lt;/button&gt;
                &lt;button type="button" class="btn btn-theme"&gt;Save changes&lt;/button&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;

&lt;!-- modal-sm Modal --&gt;
&lt;div class="modal fade" id="smmodal" tabindex="-1" aria-labelledby="smmodalLabel" aria-hidden="true"&gt;
    &lt;div class="modal-dialog modal-sm"&gt;
        &lt;div class="modal-content"&gt;
            &lt;div class="modal-header"&gt;
                &lt;p class="modal-title h5" id="smmodalLabel"&gt;modal-sm&lt;/p&gt;
                &lt;button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"&gt;&lt;/button&gt;
            &lt;/div&gt;
            &lt;div class="modal-body"&gt;
                ...
            &lt;/div&gt;
            &lt;div class="modal-footer"&gt;
                &lt;button type="button" class="btn btn-secondary" data-bs-dismiss="modal"&gt;Close&lt;/button&gt;
                &lt;button type="button" class="btn btn-theme"&gt;Save changes&lt;/button&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
                    </code></pre>
                                            <button type="button" class="btn btn-outline-light  btn-square copycode"><i class="bi bi-clipboard"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card adminuiux-card mb-3">
                                <div class="card-header">
                                    <div class="row gx-3 align-items-center">
                                        <div class="col">
                                            <p class="h6">Modal Fullscreen</p>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-outline-theme btn-square" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false">
                                                <i class="bi bi-code-slash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>Another override is the option to pop up a modal that covers the user viewport, available via modifier classes that are placed on a <code>.modal-dialog</code>.</p>
                                    <table class="table table-sm mb-3">
                                        <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>Fullscreen in</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><code>.modal-fullscreen</code></td>
                                                <td>Always</td>
                                            </tr>
                                            <tr>
                                                <td><code>.modal-fullscreen-sm-down</code></td>
                                                <td><code>576px</code></td>
                                            </tr>
                                            <tr>
                                                <td><code>.modal-fullscreen-md-down</code></td>
                                                <td><code>768px</code></td>
                                            </tr>
                                            <tr>
                                                <td><code>.modal-fullscreen-lg-down</code></td>
                                                <td><code>992px</code></td>
                                            </tr>
                                            <tr>
                                                <td><code>.modal-fullscreen-xl-down</code></td>
                                                <td><code>1200px</code></td>
                                            </tr>
                                            <tr>
                                                <td><code>.modal-fullscreen-xxl-down</code></td>
                                                <td><code>1400px</code></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <code>
            <!-- Full screen modal -->
            &lt;div class="modal-dialog modal-fullscreen-sm-down"&gt;&lt;/div&gt;
            </code>
                                    <br>
                                    <button type="button" class="btn btn-theme me-2" data-bs-toggle="modal" data-bs-target="#fullscreenmodal">
                                        Fullscreen modal
                                    </button>
                                </div>
                                <div class="collapse" id="collapse5">
                                    <div class="card-footer border-top">
                                        <div class="bg-dark text-white p-2 rounded my-2">
                                            <pre class="mb-2"><code class="code rounded language-html">
&lt;button type="button" class="btn btn-theme me-2" data-bs-toggle="modal" data-bs-target="#fullscreenmodal"&gt;
    Fullscreen modal
&lt;/button&gt;
			
&lt;!-- fullscreen Modal --&gt;
&lt;div class="modal fade" id="fullscreenmodal" tabindex="-1" aria-labelledby="fullscreenmodalLabel" aria-hidden="true"&gt;
    &lt;div class="modal-dialog modal-fullscreen"&gt;
        &lt;div class="modal-content"&gt;
            &lt;div class="modal-header"&gt;
                &lt;p class="modal-title h5" id="fullscreenmodalLabel"&gt;modal-fullscreen&lt;/p&gt;
                &lt;button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"&gt;&lt;/button&gt;
            &lt;/div&gt;
            &lt;div class="modal-body"&gt;
                ...
            &lt;/div&gt;
            &lt;div class="modal-footer"&gt;
                &lt;button type="button" class="btn btn-secondary" data-bs-dismiss="modal"&gt;Close&lt;/button&gt;
                &lt;button type="button" class="btn btn-theme"&gt;Save changes&lt;/button&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
                    </code></pre>
                                            <button type="button" class="btn btn-outline-light  btn-square copycode"><i class="bi bi-clipboard"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- component footer -->
                            <div class="mb-3">
                                <div class="row gx-3">
                                    <div class="col">
                                        <a href="component-list-groups.html" class="btn btn-accent my-2"><i class="bi bi-arrow-left mr-2"></i> List Groups</a>
                                    </div>
                                    <div class="col-auto">
                                        <a href="component-off-canvas.html" class="btn btn-theme my-2">Off Canvas <i class="bi bi-arrow-right ms-2"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                                    @endsection