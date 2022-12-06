<header class="page-topbar d-flex">
    <div class="navbar w-100">
        <div class="px-3 py-2 d-flex align-items-center justify-content-between w-100">
            <button class="btn" id="sidebar-btn">
                <i class="bi bi-list fs-4"></i>
            </button>
            <a href="/" class="btn btn-primary">Home Page</a>
        </div>
    </div>
</header>
<div class="vertical-menu">
    <div class="navbar-brand">
        <i class="bi bi-flower2 fs-4"></i>
        <span class="fs-4 ms-2">VARNAM</span>    
    </div>
    <ul class="menu-list">
        <li class="menu-title">MENU</li>
        <li class="menu-item <?= ($PAGE_TITLE == "dashboard - admin" ? "active" : "") ?>">
            <a href="/admin">
                <i class="bi bi-house-heart icon-left"></i>
                Dashboard
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
        </li>
        <li class="menu-item <?= ($PAGE_TITLE == "users - admin" ? "active" : "") ?>">
            <a href="/admin/users.php">
                <i class="bi bi-people icon-left"></i>
                Users
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
        </li>
        <li class="menu-item has-sub-menu <?= ($PAGE_TITLE == "categories - admin" ? "active" : "collapsed") ?>">
            <a href="#">
                <i class="bi bi-boxes icon-left"></i>
                    Categories
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "categories - view" ? "active" : "") ?>">
                    <a href="/admin/categories/">View Categories</a>
                </li>
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "categories - add" ? "active" : "") ?>">
                    <a href="/admin/categories/add.php">Add Category</a>
                </li>
            </ul>
        </li>
        <li class="menu-item has-sub-menu <?= ($PAGE_TITLE == "products - admin" ? "active" : "collapsed") ?>">
            <a href="#">
                <i class="bi bi-box-seam icon-left"></i>
                Products
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "products - view" ? "active" : "") ?>">
                    <a href="/admin/products/">View Products</a>
                </li>
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "products - add" ? "active" : "") ?>">
                    <a href="/admin/products/add.php">Add Products</a>
                </li>
            </ul>
        </li>
        <li class="menu-item <?= ($PAGE_TITLE == "orders - admin" ? "active" : "") ?>">
            <a href="/admin/orders/">
                <i class="bi bi-basket icon-left"></i>
                Orders
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
        </li>
        <li class="menu-item <?= ($PAGE_TITLE == "carts - admin" ? "active" : "") ?>">
            <a href="/admin/cart/">
                <i class="bi bi-cart2 icon-left"></i>
                Cart
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
        </li><li class="menu-item <?= ($PAGE_TITLE == "payment qr - admin" ? "active" : "") ?>">
            <a href="/admin/payment_qr/">
                <i class="bi bi-qr-code-scan icon-left"></i>
                Payment QR
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
        </li>
    </ul>
</div>