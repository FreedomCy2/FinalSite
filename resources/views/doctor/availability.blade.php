<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Availability - Green Pulse Clinic</title>
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
                        <a href="/doctor/availability" class="flex items-center px-4 py-3 text-gray-700 rounded-lg active-tab">
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
                    <h2 class="text-xl font-semibold text-gray-800">Availability</h2>
                    <p class="text-sm text-gray-500">Set your working hours and block dates</p>
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
            
            <!-- Availability Content -->
            <main class="p-6">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">Set Your Availability</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Weekly Schedule -->
                        <div>
                            <h4 class="font-medium text-gray-800 mb-4">Weekly Schedule</h4>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="font-medium">Monday</span>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm">9:00 AM - 5:00 PM</span>
                                        <button class="text-clinic-600 hover:text-clinic-800">
                                            <i data-feather="edit-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="font-medium">Tuesday</span>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm">9:00 AM - 5:00 PM</span>
                                        <button class="text-clinic-600 hover:text-clinic-800">
                                            <i data-feather="edit-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="font-medium">Wednesday</span>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm">9:00 AM - 5:00 PM</span>
                                        <button class="text-clinic-600 hover:text-clinic-800">
                                            <i data-feather="edit-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="font-medium">Thursday</span>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm">9:00 AM - 5:00 PM</span>
                                        <button class="text-clinic-600 hover:text-clinic-800">
                                            <i data-feather="edit-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="font-medium">Friday</span>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm">9:00 AM - 3:00 PM</span>
                                        <button class="text-clinic-600 hover:text-clinic-800">
                                            <i data-feather="edit-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="font-medium">Saturday</span>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm text-gray-400">Unavailable</span>
                                        <button class="text-clinic-600 hover:text-clinic-800">
                                            <i data-feather="edit-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="font-medium">Sunday</span>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm text-gray-400">Unavailable</span>
                                        <button class="text-clinic-600 hover:text-clinic-800">
                                            <i data-feather="edit-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Block Dates -->
                        <div>
                            <h4 class="font-medium text-gray-800 mb-4">Block Unavailable Dates</h4>
                            
                            <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                <p class="text-sm text-gray-600 mb-3">Select dates to mark as unavailable:</p>
                                <input type="date" class="w-full p-2 border border-gray-300 rounded-lg mb-2">
                                <button class="w-full bg-clinic-500 hover:bg-clinic-600 text-white py-2 rounded-lg font-medium">
                                    Block Date
                                </button>
                            </div>
                            
                            <div>
                                <h5 class="font-medium text-gray-800 mb-2">Blocked Dates</h5>
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center p-2 bg-white border border-gray-200 rounded-lg">
                                        <span class="text-sm">November 23, 2023</span>
                                        <button class="text-red-500 hover:text-red-700">
                                            <i data-feather="x" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                    <div class="flex justify-between items-center p-2 bg-white border border-gray-200 rounded-lg">
                                        <span class="text-sm">December 25, 2023</span>
                                        <button class="text-red-500 hover:text-red-700">
                                            <i data-feather="x" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
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