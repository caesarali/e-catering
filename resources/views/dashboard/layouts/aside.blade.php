<aside class="main-sidebar">
    <section class="sidebar">
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span><strong>Dashboard</strong></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/admin') }}"><i class="fa fa-circle-o"></i> Home</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-shopping-cart"></i> <span><strong>Order</strong></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('pending-order') }}">
                            <i class="fa fa-circle-o"></i> Pending Orders
                            <span class="pull-right-container">
                                @if ($count1 != 0)
                                    <span class="label label-info pull-right">{{ $count1 }}</span>
                                @endif
                                @if ($count0 != 0)
                                    <span class="label label-warning pull-right">{{ $count0 }}</span>
                                @endif
                            </span>
                        </a>
                    </li>
                    <li><a href="{{ route('all-order') }}"><i class="fa fa-circle-o"></i> Completly Orders</a></li>
                </ul>
            </li>
            <li><a href="{{ route('customer.index') }}"><i class="fa fa-user"></i> <span><strong>Customer</strong></span></a></li>
            <li><a href="{{ route('food-menu.index') }}"><i class="fa fa-cog"></i> <span><strong>Food Menu</strong></span></a></li>
            {{-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i> <span><strong>Others</strong></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('food-menu.index') }}"><i class="fa fa-circle-o"></i> Food Menu</a></li>
                </ul>
            </li> --}}
        </ul>
    </section>
</aside>