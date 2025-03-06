<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- Logo -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('admin.index') }}">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120"
                    xml:space="preserve">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                        <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                        <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                    </g>
                </svg>
            </a>
        </div>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <!-- Dashboard -->
            <li class="nav-item">
                <a wire:navigate href="/admin" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span>
                </a>
            </li>

             <!-- Orders -->
             <li class="nav-item">
                <a wire:navigate href="/admin/orders"
                    class="nav-link {{ request()->is('admin/orders') ? 'active' : '' }}">
                    <i class="fe fe-tag fe-16"></i>
                    <span class="ml-3 item-text">Orders </span>
                </a>
            </li>


            <!-- Products Section -->
            <li class="nav-item " x-data="{ open: {{ request()->is('admin/view_product', 'admin/add_product', 'admin/edit_product') ? 'true' : 'false' }} }">

                <a href="#"
                    class="nav-link flex items-center justify-between

                {{ request()->is('admin/view_product', 'admin/add_product', 'admin/edit_product') ? 'active text-blue-500' : '' }}"
                    x-on:click.prevent="open = !open">

                    <div class="flex items-center">
                        <i class="fe fe-box fe-16"></i>
                        <span class="ml-3 item-text">Products</span>
                    </div>
                    <i class="fe fe-chevron-down transform transition-all duration-300"
                        :class="{ 'rotate-180': open }"></i>
                </a>

                <!-- Sidebar Nested Items -->
                <ul x-show="open" x-cloak x-transition class="pl-4 border-l border-gray-200 ml-4 mt-1">
                    <li>
                        <a wire:navigate href="/admin/view_product"
                            class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('admin/view_product') ? 'text-[#0045ce] underline' : '' }}">
                            View Products
                        </a>
                    </li>
                    <li>
                        <a wire:navigate href="/admin/add_product"
                            class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('admin/add_product') ? 'text-[#0045ce] underline' : '' }}">
                            Add Product
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Categories -->
            <li class="nav-item">
                <a wire:navigate href="/admin/categories"
                    class="nav-link {{ request()->is('admin/categories') ? 'active' : '' }}">
                    <i class="fe fe-list fe-16"></i>
                    <span class="ml-3 item-text">Categories</span>
                </a>
            </li>



            <!-- Posts -->

            <li class="nav-item " x-data="{ open: {{ request()->is('admin/posts', 'admin/add_post', 'admin/edit_post') ? 'true' : 'false' }} }">

                <a href="#"
                    class="nav-link flex items-center justify-between

            {{ request()->is('admin/posts', 'admin/add_post', 'admin/edit_post') ? 'active text-blue-500' : '' }}"
                    x-on:click.prevent="open = !open">

                    <div class="flex items-center">
                        <i class="fe fe-file-text fe-16"></i>
                        <span class="ml-3 item-text">Posts</span>
                    </div>
                    <i class="fe fe-chevron-down transform transition-all duration-300"
                        :class="{ 'rotate-180': open }"></i>
                </a>

                <!-- Sidebar Nested Items -->
                <ul x-show="open" x-cloak x-transition class="pl-4 border-l border-gray-200 ml-4 mt-1">
                    <li>
                        <a wire:navigate href="/admin/posts"
                            class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('admin/posts') ? 'text-[#0045ce] underline' : '' }}">
                            View Posts
                        </a>
                    </li>
                    <li>
                        <a wire:navigate href="/admin/add_post"
                            class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('admin/add_post') ? 'text-[#0045ce] underline' : '' }}">
                            Add Post
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Post Categories -->
            <li class="nav-item">
                <a wire:navigate href="/admin/post_categories"
                    class="nav-link {{ request()->is('admin/post_categories') ? 'active' : '' }}">
                    <i class="fe fe-tag fe-16"></i>
                    <span class="ml-3 item-text">Post Categories</span>
                </a>
            </li>


            <!-- Users -->

            <li class="nav-item " x-data="{ open: {{ request()->is('admin/users', 'admin/add_user', 'admin/edit_user') ? 'true' : 'false' }} }">

                <a href="#"
                    class="nav-link flex items-center justify-between

            {{ request()->is('admin/users', 'admin/add_user', 'admin/edit_user') ? 'active text-blue-500' : '' }}"
                    x-on:click.prevent="open = !open">

                    <div class="flex items-center">
                        <i class="fe fe-user fe-16"></i>
                        <span class="ml-3 item-text">Users</span>
                    </div>
                    <i class="fe fe-chevron-down transform transition-all duration-300"
                        :class="{ 'rotate-180': open }"></i>
                </a>

                <!-- Sidebar Nested Items -->
                <ul x-show="open" x-cloak x-transition class="pl-4 border-l border-gray-200 ml-4 mt-1">
                    <li>
                        <a wire:navigate href="/admin/users"
                            class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('admin/users') ? 'text-[#0045ce] underline' : '' }}">
                            View Users
                        </a>
                    </li>
                    <li>
                        <a wire:navigate href="/admin/add_user"
                            class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('admin/add_user') ? 'text-[#0045ce] underline' : '' }}">
                            Add User
                        </a>
                    </li>
                </ul>
            </li>


             <!-- Admins -->

             <li class="nav-item " x-data="{ open: {{ request()->is('admin/admins', 'admin/add_admin', 'admin/edit_admin') ? 'true' : 'false' }} }">

                <a href="#"
                    class="nav-link flex items-center justify-between

            {{ request()->is('admin/admins', 'admin/add_admin', 'admin/edit_admin') ? 'active text-blue-500' : '' }}"
                    x-on:click.prevent="open = !open">

                    <div class="flex items-center">
                        <i class="fe fe-shield fe-16"></i>
                        <span class="ml-3 item-text">Admins</span>
                    </div>
                    <i class="fe fe-chevron-down transform transition-all duration-300"
                        :class="{ 'rotate-180': open }"></i>
                </a>

                <!-- Sidebar Nested Items -->
                <ul x-show="open" x-cloak x-transition class="pl-4 border-l border-gray-200 ml-4 mt-1">
                    <li>
                        <a wire:navigate href="/admin/admins"
                            class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('admin/admins') ? 'text-[#0045ce] underline' : '' }}">
                            View Admins
                        </a>
                    </li>
                    <li>
                        <a wire:navigate href="/admin/add_admin"
                            class="block px-4 py-2 hover:bg-gray-100 {{ request()->is('admin/add_admin') ? 'text-[#0045ce] underline' : '' }}">
                            Add Admin
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>


    <style>
        .active {
            background-color: #f8f9fa;
            color: #1b68ff !important;
        }

        .vertical.collapsed .item-text,
        .vertical.collapsed .fe-chevron-down {
            display: none !important;
        }

        .vertical.collapsed .nav-link {
            justify-content: center !important;
        }
    </style>
</aside>
