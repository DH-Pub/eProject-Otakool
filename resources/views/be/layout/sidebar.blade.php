<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ Route('be') }}" class="brand-link">
        {{-- <img src="{{ asset('images') }}" alt="Otakool-admin"
        class="brand-image img-circle elevation-3"
        style="opacity: 0.8"> --}}
        <span class="brand-text font-weight-light">Otakool BackEnd</span>
    </a>

    {{-- sidebar --}}
    <div class="sidebar">

        @php
            $admin = Auth::guard('admin')->user();
        @endphp

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('images/admins/admin1.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="" class="d-block">{{ $admin->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">

                {{-- Admin --}}
                <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>
                            Admin
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ml-2">

                        {{-- if it's the main admin --}}
                        @if ($admin->role == 'main')
                            <li class="nav-item">
                                <a href="{{ route('admin.register') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Register an admin</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Admin index</p>
                                </a>
                            </li>
                        @endif
                        {{-- ----------------- --}}

                        <li class="nav-item">
                            <a href="{{ Route('admin.profile', $admin->id) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ Route('change.password') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ Route('admin.logout') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Log out</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if ($admin->role == 'main')
                    {{-- Customers --}}
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Customers
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-2">
                            <li class="nav-item">
                                <a href="{{ Route('customer.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Customers</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Feedback --}}
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-mail-bulk"></i>
                            <p>
                                Feedbacks
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-2">
                            <li class="nav-item">
                                <a href="{{ Route('be.feedback') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Feedbacks</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Contact --}}
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-comment-alt"></i>
                            <p>
                                Contacts
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-2">
                            <li class="nav-item">
                                <a href="{{ Route('be.contact') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Contacts</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Q&A --}}
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-question-circle"></i>
                            <p>
                                Q&A
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-2">
                            <li class="nav-item">
                                <a href="{{ Route('be.qa') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Q&A</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Route('be.qa.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Q&A</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                News
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-2">
                            <li class="nav-item">
                                <a href="{{ Route('be.news.category') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View News Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Route('be.news.category.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create News Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Route('be.news') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View News</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Route('be.news.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create News</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if ($admin->role == 'product' || $admin->role == 'main')
                    {{-- Product --}}
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>
                                Products
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-2">
                            <li class="nav-item">
                                <a href="{{ Route('be.product') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Products</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ Route('be.product.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create a Product</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('be.product.hidden') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hidden Products</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Comment --}}
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-comments"></i>
                            <p>
                                Comments
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-2">
                            <li class="nav-item">
                                <a href="{{ route('be.comment') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Comments</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Promotion --}}
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-percent"></i>
                            <p>
                                Promotions
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-2">
                            <li class="nav-item">
                                <a href="{{ route('be.promotion') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Promotions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('be.promotion.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Promotions</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if ($admin->role == 'order' || $admin->role == 'main')
                    {{-- Order --}}
                    <li class="nav-item has-treeview">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-truck-loading"></i>
                            <p>
                                Orders
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-2">
                            <li class="nav-item">
                                <a href="{{ route('be.order') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>View Orders</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('be.order.income') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Income</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('be.order.canceled') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Canceled Orders</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </nav>
    </div>
</aside>
