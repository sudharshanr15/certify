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
    <a class="navbar-brand" href="#">
        <span class="nav-icon"><img src="/assets/images/certificate.svg" alt=""></span>
        <span class="fs-4 ms-2">APSCE</span>
    </a>
    <ul class="menu-list">
        <li class="menu-title">MENU</li>
        <li class="menu-item <?= ($PAGE_TITLE == "users - admin" ? "active" : "") ?>">
            <a href="/admin/users/">
                <i class="bi bi-people icon-left"></i>
                Users
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
        </li>
        <li class="menu-item has-sub-menu <?= ($PAGE_TITLE == "organization - admin" ? "active" : "collapsed") ?>">
            <a href="#">
                <i class="bi bi-building icon-left"></i>
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
        <li class="menu-item has-sub-menu <?= ($PAGE_TITLE == "sub events - admin" ? "active" : "collapsed") ?>">
            <a href="/admin/sub_events/">
                <i class="bi bi-boxes icon-left"></i>
                Sub Events
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "sub events - view" ? "active" : "") ?>">
                    <a href="/admin/sub_events/">View Sub event</a>
                </li>
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "sub events - add" ? "active" : "") ?>">
                    <a href="/admin/sub_events/add.php">Add Sub event</a>
                </li>
            </ul>
        </li>
        <li class="menu-item has-sub-menu <?= ($PAGE_TITLE == "participants - admin" ? "active" : "collapsed") ?>">
            <a href="#">
                <i class="bi bi-person-badge-fill icon-left"></i>
                Participants
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "participants - view" ? "active" : "") ?>">
                    <a href="/admin/participants/">View Participants</a>
                </li>
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "participants - import" ? "active" : "") ?>">
                    <a href="/admin/participants/import.php">Import Participants</a>
                </li>
            </ul>
        </li>
        <li class="menu-item has-sub-menu <?= ($PAGE_TITLE == "certificates - admin" ? "active" : "collapsed") ?>">
            <a href="/admin/certificates/">
                <i class="bi bi-award icon-left"></i>
                Certificates
                <i class="bi bi-chevron-right pt-2 icon-right"></i>
            </a>
            <ul class="sub-menu">
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "certificates - view" ? "active" : "") ?>">
                    <a href="/admin/certificates/">User Certificates</a>
                </li>
                <li class="sub-menu-item <?= ($SUB_MENU_TITLE == "certificates - template" ? "active" : "") ?>">
                    <a href="/admin/certificates/template.php">Templates</a>
                </li>
            </ul>
        </li>
    </ul>
</div>