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
        <li class="menu-item has-sub-menu <?= ($PAGE_TITLE == "organization - admin" ? "active" : "collapsed") ?>">
            <a href="#">
                <i class="bi bi-boxes icon-left"></i>
                    Organization
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "organization - view" ? "active" : "") ?>">
                    <a href="/admin/organization/">View Organizations</a>
                </li>
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "organization - add" ? "active" : "") ?>">
                    <a href="/admin/organization/add.php">Add Organization</a>
                </li>
            </ul>
        </li>
        <li class="menu-item has-sub-menu <?= ($PAGE_TITLE == "events - admin" ? "active" : "collapsed") ?>">
            <a href="#">
                <i class="bi bi-box-seam icon-left"></i>
                Events
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "events - view" ? "active" : "") ?>">
                    <a href="/admin/events/">View Events</a>
                </li>
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "events - add" ? "active" : "") ?>">
                    <a href="/admin/events/add.php">Add Event</a>
                </li>
            </ul>
        </li>
        <li class="menu-item <?= ($PAGE_TITLE == "participants - admin" ? "active" : "") ?>">
            <a href="/admin/participants/">
                <i class="bi bi-basket icon-left"></i>
                Participants
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
        </li>
        <li class="menu-item <?= ($PAGE_TITLE == "certificates - admin" ? "active" : "") ?>">
            <a href="/admin/certificates/">
                <i class="bi bi-basket icon-left"></i>
                Certificates
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
        </li>
    </ul>
</div>