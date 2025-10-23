<!DOCTYPE html>
<html lang="en"> booking
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Flow</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .sidebar-item:hover .sidebar-icon {
            transform: translateX(5px);
            transition: all 0.3s ease;
        }
        .active-route {
            background-color: #68D6EC;
            color: white;
        }
        .active-route .sidebar-icon {
            color: white;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: white;
            min-width: 180px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            border-radius: 8px;
            z-index: 1000;
            margin-top: 8px;
            border: 1px solid #e5e7eb;
        }
        .dropdown-menu.show {
            display: block;
        }
        .dropdown-item {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            color: #374151;
            text-decoration: none;
            transition: background-color 0.2s;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }
        .dropdown-item:hover {
            background-color: #f9fafb;
        }
        .dropdown-divider {
            height: 1px;
            background-color: #e5e7eb;
            margin: 4px 0;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans flex">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg h-screen fixed">
        <div class="p-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-[#68D6EC] flex items-center">
                <i data-feather="activity" class="mr-2"></i>
                Clinic Flow
            </h1>
        </div>
        <nav class="mt-6">
            <div class="px-4">
                <h3 class="text-xs uppercase text-gray-500 font-semibold tracking-wider">Main</h3>
            </div>
            <div class="mt-3">
                <a href="/admin/dashboard" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item active-route">
                    <i data-feather="home" class="sidebar-icon mr-3 text-blue-500"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="/admin/booking" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="calendar" class="sidebar-icon mr-3 text-green-500"></i>
                    <span class="font-medium">Booking</span>
                </a>
                <a href="/admin/doctors" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="user" class="sidebar-icon mr-3 text-purple-500"></i>
                    <span class="font-medium">Doctors</span>
                </a>
                <a href="/admin/manage-users" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="users" class="sidebar-icon mr-3 text-red-500"></i>
                    <span class="font-medium">Manage Users</span>
                </a>
                <a href="/admin/reminders" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="bell" class="sidebar-icon mr-3 text-yellow-500"></i>
                    <span class="font-medium">Reminders</span>
                </a>
                <a href="/admin/schedule" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="clock" class="sidebar-icon mr-3 text-indigo-500"></i>
                    <span class="font-medium">Schedule</span>
                </a>
                <a href="/admin/records" class="flex items-center px-6 py-3 text-gray-600 hover:bg-[#68D6EC]/10 sidebar-item">
                    <i data-feather="file-text" class="sidebar-icon mr-3 text-teal-500"></i>
                    <span class="font-medium">Records</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 ml-64 p-8">
        <!-- Header -->
        <header class="bg-white rounded-lg shadow-sm p-4 mb-6 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Dashboard Overview</h2>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <i data-feather="search" class="absolute left-3 top-2.5 text-gray-400"></i>
                    <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#68D6EC] focus:border-transparent">
                </div>
                <div class="relative">
                    <i data-feather="bell" class="text-gray-500 cursor-pointer hover:text-[#68D6EC]"></i>
                    <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-red-500"></span>
                </div>
                <div class="relative" id="user-menu">
                    <button id="user-menu-button" class="flex items-center focus:outline-none">
                        <img src="http://static.photos/people/200x200/1" alt="Admin" class="w-8 h-8 rounded-full mr-2">
                        <span class="font-medium">Admin</span>
                        <i data-feather="chevron-down" class="ml-1 w-4 h-4"></i>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu" id="dropdown-menu">
                        <a href="/admin/profile" class="dropdown-item">
                            <i data-feather="user" class="mr-2 w-4 h-4"></i>
                            Profile
                        </a>
                        <a href="/admin/settings" class="dropdown-item">
                            <i data-feather="settings" class="mr-2 w-4 h-4"></i>
                            Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <!-- Logout trigger (opens modal) -->
                        <button id="logout-button" type="button" class="dropdown-item text-red-600">
                            <i data-feather="log-out" class="mr-2 w-4 h-4"></i>
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- ============================================ -->
        <!-- PLACE YOUR CONTENT CODE HERE - START -->
        <!-- ============================================ -->

        <!-- Add your custom content below this line -->
        <!-- This is where you should place your dashboard content, charts, tables, etc. -->

        <!-- Example: You can add your own components here -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold mb-4">Your Custom Content</h3>
            <p class="text-gray-600">Add your dashboard components, charts, tables, or any other content here.</p>
        </div>

        <!-- ============================================ -->
        <!-- PLACE YOUR CONTENT CODE HERE - END -->
        <!-- ============================================ -->

    </div>

    <!-- Logout Confirmation Modal -->
    <div id="logout-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <div class="flex items-center mb-4">
                <h3 class="text-lg font-semibold">Confirm Logout</h3>
            </div>
            <p class="text-gray-600 mb-6">Are you sure you want to logout from Clinic Flow?</p>
            <div class="flex justify-end space-x-3">
                <button id="cancel-logout" type="button" class="px-4 py-2 rounded bg-gray-200">Cancel</button>
                <button id="confirm-logout" type="button" class="px-4 py-2 rounded bg-red-500 text-white">Logout</button>
            </div>
        </div>
    </div>

    <!-- Hidden logout form actually submitted to server -->
    <form id="logout-form" method="POST" action="{{ route('admin.logout') }}" class="hidden">
        @csrf
    </form>

    <script>
        feather.replace();
        
        document.addEventListener('DOMContentLoaded', function() {
            // Highlight current route in sidebar
            const currentPath = window.location.pathname.split('/').pop() || 'dashboard';
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            
            sidebarItems.forEach(item => {
                const href = item.getAttribute('href').split('/').pop();
                if (href === currentPath || (currentPath === '' && href === 'dashboard')) {
                    item.classList.add('active-route');
                } else {
                    item.classList.remove('active-route');
                }
            });
            
            // User dropdown functionality
            const userMenuButton = document.getElementById('user-menu-button');
            const dropdownMenu = document.getElementById('dropdown-menu');
            
            userMenuButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('show');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.closest('#user-menu')) {
                    dropdownMenu.classList.remove('show');
                }
            });
            
            const logoutButton = document.getElementById('logout-button');
            const logoutForm = document.getElementById('logout-form');
            const logoutModal = document.getElementById('logout-modal');
            const cancelLogout = document.getElementById('cancel-logout');
            const confirmLogout = document.getElementById('confirm-logout');

            // open modal when user clicks logout
            logoutButton && logoutButton.addEventListener('click', function(e) {
                e.preventDefault();
                logoutModal.classList.remove('hidden');
            });

            cancelLogout && cancelLogout.addEventListener('click', function() {
                logoutModal.classList.add('hidden');
            });

            // on confirm, submit the hidden POST logout form (includes CSRF)
            confirmLogout && confirmLogout.addEventListener('click', function() {
                logoutForm.submit();
            });
        });
    </script>
</body>
</html>