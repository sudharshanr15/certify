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
            <a href="/admin/users/">
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
        <li class="menu-title">CUSTOMIZATION</li>
        <li class="menu-item has-sub-menu <?= ($PAGE_TITLE == "product colors - admin" ? "active" : "collapsed") ?>">
            <a href="#">
                <i class="bi bi-palette icon-left"></i>
                Flower Colors
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "colors - view" ? "active" : "") ?>">
                    <a href="/admin/flower_colors/">View Colors</a>
                </li>
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "colors - add" ? "active" : "") ?>">
                    <a href="/admin/flower_colors/add.php">Add Colors</a>
                </li>
            </ul>
        </li>
        <li class="menu-item has-sub-menu <?= ($PAGE_TITLE == "balloon - admin" ? "active" : "collapsed") ?>">
            <a href="#">
                <i class="bi bi-balloon icon-left"></i>
                    Balloons
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "balloon - view" ? "active" : "") ?>">
                    <a href="/admin/balloon/">View Balloon</a>
                </li>
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "balloon - add" ? "active" : "") ?>">
                    <a href="/admin/balloon/add.php">Add Balloon</a>
                </li>
            </ul>
        </li>
        <li class="menu-item has-sub-menu <?= ($PAGE_TITLE == "chocolate - admin" ? "active" : "collapsed") ?>">
            <a href="#">
                <i class="bi bi-palette icon-left"></i>
                Chocolates
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "chocolate - view" ? "active" : "") ?>">
                    <a href="/admin/chocolate/">View Chocolate</a>
                </li>
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "chocolate - add" ? "active" : "") ?>">
                    <a href="/admin/chocolate/add.php">Add Chocolate</a>
                </li>
            </ul>
        </li>
        <li class="menu-item has-sub-menu <?= ($PAGE_TITLE == "message card - admin" ? "active" : "collapsed") ?>">
            <a href="#">
                <i class="bi bi-postcard-heart icon-left"></i>
                    Message Card
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "message card - view" ? "active" : "") ?>">
                    <a href="/admin/message_card/">View Card</a>
                </li>
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "message card - add" ? "active" : "") ?>">
                    <a href="/admin/message_card/add.php">Add Card</a>
                </li>
            </ul>
        </li>
        <li class="menu-item has-sub-menu <?= ($PAGE_TITLE == "toys - admin" ? "active" : "collapsed") ?>">
            <a href="#">
                <i class="bi bi-palette icon-left"></i>
                Toys
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "toys - view" ? "active" : "") ?>">
                    <a href="/admin/toys/">View Toys</a>
                </li>
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "toys - add" ? "active" : "") ?>">
                    <a href="/admin/toys/add.php">Add Toys</a>
                </li>
            </ul>
        </li>
        <li class="menu-item has-sub-menu <?= ($PAGE_TITLE == "wrapping colors - admin" ? "active" : "collapsed") ?>">
            <a href="#">
                <i class="bi bi-palette icon-left"></i>
                Wrapping Colors
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "wrapping colors - view" ? "active" : "") ?>">
                    <a href="/admin/wrapping_colors/">View Wrappers</a>
                </li>
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "wrapping colors - add" ? "active" : "") ?>">
                    <a href="/admin/wrapping_colors/add.php">Add Wrapper</a>
                </li>
            </ul>
        </li>
        <li class="menu-item has-sub-menu <?= ($PAGE_TITLE == "product types - admin" ? "active" : "collapsed") ?>">
            <a href="/admin">
                <i class="bi bi-grid-1x2 icon-left"></i>
                Product Types
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "types - view" ? "active" : "") ?>">
                    <a href="/admin/product_types/">View Types</a>
                </li>
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "types - add" ? "active" : "") ?>">
                    <a href="/admin/product_types/add.php">Add Types</a>
                </li>
            </ul>
        </li>
    </ul>
</div>