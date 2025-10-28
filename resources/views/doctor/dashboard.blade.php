<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Green Pulse Clinic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clinic: {
                            100: '#ECFDF5',
                            500: '#10B981',
                            600: '#059669'
                        }
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .sidebar {
            transition: all 0.3s ease;
        }
        .active-tab {
            background-color: #ECFDF5;
            border-left: 4px solid #10B981;
            color: #059669;
        }
        .appointment-card {
            transition: all 0.2s ease;
        }
        .appointment-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar bg-white w-64 shadow-md flex flex-col">
            <div class="p-6">
                <div class="flex items-center space-x-2">
                    <i data-feather="heart" class="text-clinic-500 w-6 h-6"></i>
                    <h1 class="text-xl font-bold text-gray-800">Green Pulse Clinic</h1>
                </div>
                <p class="mt-1 text-sm text-gray-500">Doctor Dashboard</p>
            </div>
            
            <nav class="flex-1 px-4 py-6">
                <ul class="space-y-2">
                    <li>
                        <a href="/doctor/dashboard" class="flex items-center px-4 py-3 text-gray-700 rounded-lg active-tab">
                            <i data-feather="home" class="w-5 h-5 mr-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/doctor/appointments" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i data-feather="calendar" class="w-5 h-5 mr-3"></i>
                            <span>My Appointments</span>
                        </a>
                    </li>
                    <li>
                        <a href="/doctor/availability" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i data-feather="clock" class="w-5 h-5 mr-3"></i>
                            <span>Availability</span>
                        </a>
                    </li>
                    <li>
                        <a href="/doctor/notifications" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i data-feather="bell" class="w-5 h-5 mr-3"></i>
                            <span>Notifications</span>
                            <span class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                        </a>
                    </li>
                    <li>
                        <a href="/doctor/profile" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100">
                            <i data-feather="user" class="w-5 h-5 mr-3"></i>
                            <span>Profile Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-clinic-500 rounded-full flex items-center justify-center text-white font-medium">DR</div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">Dr. Sarah Johnson</p>
                        <p class="text-xs text-gray-500">Cardiologist</p>
                    </div>
                </div>
                <button id="sidebar-logout-button" type="button" class="w-full mt-4 flex items-center justify-center space-x-2 text-gray-600 hover:text-gray-800 py-2 rounded-lg hover:bg-gray-100">
                    <i data-feather="log-out" class="w-4 h-4"></i>
                    <span>Logout</span>
                </button>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
                    <p class="text-sm text-gray-500">Welcome back, Dr. Johnson</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <a href="notifications.html" class="p-2 rounded-full hover:bg-gray-100">
                            <i data-feather="bell" class="w-5 h-5 text-gray-600"></i>
                        </a>
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full w-2 h-2"></span>
                    </div>
                    <div class="w-8 h-8 bg-clinic-500 rounded-full flex items-center justify-center text-white font-medium">SJ</div>
                </div>
            </header>
            
            <!-- Dashboard Content -->
            <main class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Today's Appointments</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1">5</p>
                            </div>
                            <div class="p-3 bg-clinic-100 rounded-lg">
                                <i data-feather="calendar" class="w-6 h-6 text-clinic-500"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">2 upcoming, 3 completed</p>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Weekly Appointments</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1">24</p>
                            </div>
                            <div class="p-3 bg-blue-100 rounded-lg">
                                <i data-feather="users" class="w-6 h-6 text-blue-500"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">+3 from last week</p>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Patient Satisfaction</p>
                                <p class="text-2xl font-bold text-gray-800 mt-1">94%</p>
                            </div>
                            <div class="p-3 bg-amber-100 rounded-lg">
                                <i data-feather="star" class="w-6 h-6 text-amber-500"></i>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Based on 42 reviews</p>
                    </div>
                </div>
                
                <!-- Upcoming Appointments -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">Upcoming Appointments</h3>
                        <a href="appointments.html" class="text-sm text-clinic-600 font-medium hover:underline">View All</a>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="appointment-card bg-white border border-gray-200 rounded-lg p-4 flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-clinic-100 rounded-full flex items-center justify-center">
                                    <i data-feather="user" class="w-5 h-5 text-clinic-500"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Michael Chen</p>
                                    <p class="text-sm text-gray-500">Regular Checkup</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium text-gray-800">10:30 AM</p>
                                <p class="text-sm text-gray-500">Today</p>
                            </div>
                        </div>
                        
                        <div class="appointment-card bg-white border border-gray-200 rounded-lg p-4 flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-clinic-100 rounded-full flex items-center justify-center">
                                    <i data-feather="user" class="w-5 h-5 text-clinic-500"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Jennifer Lopez</p>
                                    <p class="text-sm text-gray-500">Cardiac Consultation</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium text-gray-800">2:15 PM</p>
                                <p class="text-sm text-gray-500">Today</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

</main>
        <!-- Logout Confirmation Modal -->
        <div id="logout-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
                <div class="flex items-center mb-4">
                    <h3 class="text-lg font-semibold">Confirm Logout</h3>
                </div>
                <p class="text-gray-600 mb-6">Are you sure you want to logout?</p>
                <div class="flex justify-end space-x-3">
                    <button id="cancel-logout" type="button" class="px-4 py-2 rounded bg-gray-200">Cancel</button>
                    <button id="confirm-logout" type="button" class="px-4 py-2 rounded bg-red-500 text-white">Logout</button>
                </div>
            </div>
        </div>

        <!-- Hidden logout form actually submitted to server -->
        <form id="logout-form" method="POST" action="{{ route('doctor.logout') }}" class="hidden">
            @csrf
        </form>

    <script>
        // Replace icons
        feather.replace();

        document.addEventListener('DOMContentLoaded', function() {
            const logoutButton = document.getElementById('sidebar-logout-button');
            const logoutForm = document.getElementById('logout-form');
            const logoutModal = document.getElementById('logout-modal');
            const cancelLogout = document.getElementById('cancel-logout');
            const confirmLogout = document.getElementById('confirm-logout');

            // open modal when user clicks logout in the sidebar
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