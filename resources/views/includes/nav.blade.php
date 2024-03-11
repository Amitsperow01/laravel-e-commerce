<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>

                <a href="{{ route('dashboard') }}"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..." />
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i
                            class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>


            <li class="treeview">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
                {{-- <ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul> --}}
            </li>
            @can('user_index')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-circle-o"></i> <span>Manage Users</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('user.index') }}"><i class="fa fa-users"></i>User list</a></li>
                        @can('user_create')
                            <li><a href="{{ route('user.create') }}"><i class="fa fa-user"></i>User Add</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('page_index')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-circle-o"></i> <span>Manage Pages</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('page.index') }}"><i class="fa fa-square"></i>Page list</a>
                        </li>
                        @can('page_create')
                            <li><a href="{{ route('page.create') }}"><i class="fa fa-square"></i>Page Add</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('slider_index')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-circle-o"></i> <span>Manage Slider</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('slider.index') }}"><i class="fa fa-sliders"></i>Slider
                                list</a></li>
                        @can('slider_create')
                            <li><a href="{{ route('slider.create') }}"><i class="fa fa-sliders"></i>Slider Add</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('block_index')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-circle-o"></i> <span>Manage Block</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('block.index') }}"><i class="fa fa-block"></i>Block list</a>
                        </li>
                        @can('block_create')
                            <li><a href="{{ route('block.create') }}"><i class="fa fa-square"></i>Block Add</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('manage_roles')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-circle-o"></i> <span>Manage Roles</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('role.index') }}"><i class="fa fa-tasks"
                                    aria-hidden="true"></i> Role list</a></li>
                        <li><a href="{{ route('role.create') }}"><i class="fa fa-tasks"></i>Role Add</a></li>
                    </ul>
                </li>
            @endcan

            @can('manage_permission')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-circle-o"></i> <span>Manage Permissions</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('permission.index') }}"><i class="fa fa-lock"></i>Permission
                                list</a></li>
                        <li><a href="{{ route('permission.create') }}"><i class="fa fa-unlock"></i>Permission Add</a></li>
                    </ul>
                </li>
            @endcan
            @can('manage_enquiry')
                <li class="treeview">
                    <a href="{{ route('enquiry') }}">
                        <i class="fa fa-circle-o"></i> <span>Manage Enquiries</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
            @endcan

            @can('product_index')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-circle-o"></i> <span>Manage Prodect</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('product.index') }}"><i class="fa fa-lock"></i>Prodect
                                list</a></li>
                        @can('product_create')
                            <li><a href="{{ route('product.create') }}"><i class="fa fa-unlock"></i>Prodect Add</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('category_index')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-circle-o"></i> <span>Manage category</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('category.index') }}"><i class="fa fa-lock"></i>category
                                list</a></li>
                        @can('category_create')
                            <li><a href="{{ route('category.create') }}"><i class="fa fa-unlock"></i>category Add</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('attribute_index')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-circle-o"></i> <span>Manage Attribute</span> <i
                            class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{ route('attribute.index') }}"><i class="fa fa-lock"></i>Attribute
                                list</a></li>
                        @can('attribute_create')
                            <li><a href="{{ route('attribute.create') }}"><i class="fa fa-unlock"></i>Attribute Add</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o"></i> <span>Manage Coupon</span> <i
                        class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="{{ route('coupon.index') }}"><i class="fa fa-lock"></i>Coupon
                            list</a></li>
                        <li><a href="{{ route('coupon.create') }}"><i class="fa fa-unlock"></i>Coupon Add</a></li>
                 
                </ul>
            </li>
            <li class="treeview">
                <a href="{{ route('manageorder') }}">
                    <i class="fa fa-circle-o"></i> <span>Manage Orders</span> <i
                        class="fa fa-angle-left pull-right"></i>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
