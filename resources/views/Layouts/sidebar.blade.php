<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('welcome')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <!-- End Dashboard Nav -->
        <hr>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-cart"></i><span>Orders</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('Orders.index')}}"> <i class="bi bi-circle"></i><span>Order</span> </a>
                </li>

            </ul>
        </li>
        <!-- End Components Nav -->
        <hr>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-tags"></i><span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('Category.index')}}">
                        <i class="bi bi-circle"></i><span>Category</span>
                    </a>
                </li>

            </ul>
        </li>
        <!-- End Forms Nav -->
        <hr>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-table"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('Table.index')}}">
                        <i class="bi bi-circle"></i><span> Table</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('Table_reserve.index')}}"> <i class="bi bi-circle"></i><span>Table Reserve</span> </a>
                </li>
            </ul>
        </li>
        <!-- End Tables Nav -->
        <hr>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bar-chart"></i><span>Analysis Chart</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('analythis.index')}}"> <i class="bi bi-circle"></i><span>Sales Analysis</span> </a>
                </li>

            </ul>
        </li>
        <!-- End Charts Nav -->
        <hr>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#products-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-box-seam"></i><span>Meals</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="products-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('Product.index')}}">
                        <i class="bi bi-circle"></i><span>Product</span>
                    </a>
                </li>
            </ul>
        </li>
        <hr>



        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#inventory-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-boxes"></i><span>Inventory</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="inventory-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('Inventory.index')}}">
                        <i class="bi bi-circle"></i><span>Product</span>
                    </a>
                </li>
            </ul>
        </li>
        <hr>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#Staff-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people"></i><span>Staff</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="Staff-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('Staff.index')}}">
                        <i class="bi bi-circle"></i><span>Staff</span>
                    </a>
                </li>
            </ul>
        </li>
        <hr>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#Users-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person-circle"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="Users-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('User.index')}}">
                        <i class="bi bi-circle"></i><span>User</span>
                    </a>
                </li>
            </ul>
        </li>
        <hr>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#Contact-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-telephone"></i><span>Messages</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="Contact-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('Message.index')}}">
                        <i class="bi bi-circle"></i><span>Message</span>
                    </a>
                </li>
            </ul>
        </li>
        <hr>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#Ai-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-box-seam"></i><span>Ai</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="Ai-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{route('Staff.index')}}">
                        <i class="bi bi-circle"></i><span>Yolo</span>
                    </a>
                </li>
            </ul>
        </li>


        <!-- End Icons Nav -->


    </ul>
</aside>
