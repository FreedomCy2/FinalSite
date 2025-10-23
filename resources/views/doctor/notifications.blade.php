<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Green Pulse Clinic</title>
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
        .notification {
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
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
                        <a href="/doctor/dashboard" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100">
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
                        <a href="/doctor/notifications" class="flex items-center px-4 py-3 text-gray-700 rounded-lg active-tab">
                            <i data-feather="bell" class="w-5 h-5 mr-3"></i>
                            <span>Notifications</span>
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
                <button class="w-full mt-4 flex items-center justify-center space-x-2 text-gray-600 hover:text-gray-800 py-2 rounded-lg hover:bg-gray-100">
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
                    <h2 class="text-xl font-semibold text-gray-800">Notifications</h2>
                    <p class="text-sm text-gray-500">Stay updated with clinic activities</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <a href="notifications.html" class="p-2 rounded-full hover:bg-gray-100">
                            <i data-feather="bell" class="w-5 h-5 text-gray-600"></i>
                        </a>
                    </div>
                    <div class="w-8 h-8 bg-clinic-500 rounded-full flex items-center justify-center text-white font-medium">SJ</div>
                </div>
            </header>
            
            <!-- Notifications Content -->
            <main class="p-6">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Notifications</h3>
                    
                    <div class="space-y-4">
                        <div class="notification p-4 bg-blue-50 border border-blue-200 rounded-lg flex items-start">
                            <div class="p-2 bg-blue-100 rounded-lg mr-4">
                                <i data-feather="calendar" class="w-5 h-5 text-blue-500"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">New Appointment Booking</p>
                                <p class="text-sm text-gray-600">Robert Taylor booked an appointment for November 5, 2023 at 11:00 AM.</p>
                                <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <i data-feather="x" class="w-4 h-4"></i>
                            </button>
                        </div>
                        
                        <div class="notification p-4 bg-amber-50 border border-amber-200 rounded-lg flex items-start">
                            <div class="p-2 bg-amber-100 rounded-lg mr-4">
                                <i data-feather="alert-circle" class="w-5 h-5 text-amber-500"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">Appointment Cancellation</p>
                                <p class="text-sm text-gray-600">Maria Garcia cancelled her appointment for October 20, 2023.</p>
                                <p class="text-xs text-gray-500 mt-1">5 hours ago</p>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <i data-feather="x" class="w-4 h-4"></i>
                            </button>
                        </div>
                        
                        <div class="notification p-4 bg-clinic-50 border border-clinic-200 rounded-lg flex items-start">
                            <div class="p-2 bg-clinic-100 rounded-lg mr-4">
                                <i data-feather="info" class="w-5 h-5 text-clinic-500"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">System Update</p>
                                <p class="text-sm text-gray-600">New features have been added to the doctor dashboard.</p>
                                <p class="text-xs text-gray-500 mt-1">1 day ago</p>
                            </div>
                            <button class="text-gray-400 hover:text-gray-600">
                                <i data-feather="x" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>