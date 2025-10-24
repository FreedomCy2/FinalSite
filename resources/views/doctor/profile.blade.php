<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Profile Settings - Green Pulse Clinic</title>
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
          },
          boxShadow: {
            soft: '0 4px 20px rgba(16,185,129,0.15)',
          },
        },
      },
    };
  </script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(to bottom right, #f0fdf4, #ffffff);
    }
    .active-tab {
      background: linear-gradient(to right, #d1fae5, #a7f3d0);
      color: #065f46;
      font-weight: 600;
      border-left: 4px solid #10B981;
    }
  </style>
</head>
<body class="min-h-screen flex">
  <!-- Sidebar -->
  <aside class="w-72 bg-white/90 backdrop-blur-lg shadow-soft flex flex-col rounded-r-3xl">
    <div class="p-6 border-b border-gray-100">
      <div class="flex items-center space-x-2">
        <i data-feather="heart" class="text-clinic-500 w-6 h-6"></i>
        <h1 class="text-xl font-bold text-gray-800">Green Pulse Clinic</h1>
      </div>
      <p class="text-sm text-gray-500 mt-1">Doctor Dashboard</p>
    </div>

    <nav class="flex-1 p-5 space-y-2">
      <a href="/doctor/dashboard" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-clinic-100 transition-all">
        <i data-feather="home" class="w-5 h-5 mr-3"></i>
        Dashboard
      </a>
      <a href="/doctor/appointments" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-clinic-100 transition-all">
        <i data-feather="calendar" class="w-5 h-5 mr-3"></i>
        My Appointments
      </a>
      <a href="/doctor/availability" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-clinic-100 transition-all">
        <i data-feather="clock" class="w-5 h-5 mr-3"></i>
        Availability
      </a>
      <a href="/doctor/notifications" class="flex items-center px-4 py-3 rounded-lg text-gray-700 hover:bg-clinic-100 transition-all relative">
        <i data-feather="bell" class="w-5 h-5 mr-3"></i>
        Notifications
        <span class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
      </a>
      <a href="/doctor/profile" class="flex items-center px-4 py-3 rounded-lg active-tab">
        <i data-feather="user" class="w-5 h-5 mr-3"></i>
        Profile Settings
      </a>
    </nav>

    <div class="p-5 border-t border-gray-100">
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 bg-clinic-500 rounded-full flex items-center justify-center text-white font-semibold">DR</div>
        <div>
          <p class="font-medium text-gray-800">Dr. Sarah Johnson</p>
          <p class="text-xs text-gray-500">Cardiologist</p>
        </div>
      </div>

      <!-- Logout Button -->
      <button onclick="logoutConfirm()" 
              class="w-full mt-4 flex items-center justify-center space-x-2 
                     text-gray-600 hover:text-gray-900 py-2 rounded-lg 
                     hover:bg-clinic-100 transition-all">
        <i data-feather="log-out" class="w-4 h-4"></i>
        <span>Logout</span>
      </button>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 overflow-auto p-8">
    <!-- Header -->
    <header class="bg-white shadow-soft rounded-2xl px-6 py-4 flex justify-between items-center mb-6">
      <div>
        <h2 class="text-2xl font-semibold text-gray-800">Profile Settings</h2>
        <p class="text-sm text-gray-500">Manage your personal and professional information</p>
      </div>
      <div class="flex items-center space-x-4">
        <div class="relative">
          <button class="p-2 rounded-full hover:bg-clinic-100 transition">
            <i data-feather="bell" class="w-5 h-5 text-gray-600"></i>
          </button>
          <span class="absolute top-2 right-2 bg-red-500 w-2 h-2 rounded-full"></span>
        </div>
        <div class="w-8 h-8 bg-clinic-500 rounded-full flex items-center justify-center text-white font-medium">SJ</div>
      </div>
    </header>

    <!-- Profile Card -->
    <section class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-soft p-8">
      <h3 class="text-lg font-semibold text-gray-800 mb-6 border-b border-gray-200 pb-3">Profile Information</h3>

      <!-- Profile Picture Section -->
      <div class="flex flex-col md:flex-row md:items-center md:space-x-8 mb-8">
        <div class="relative w-32 h-32">
          <img id="profileImage" src="https://i.pravatar.cc/150?img=47" alt="Profile Photo"
            class="w-32 h-32 rounded-full object-cover shadow-md border-4 border-clinic-100" />
          <label for="fileUpload"
            class="absolute bottom-0 right-0 bg-clinic-500 hover:bg-clinic-600 text-white rounded-full p-2 cursor-pointer shadow-lg transition">
            <i data-feather="camera" class="w-4 h-4"></i>
          </label>
          <input id="fileUpload" type="file" accept="image/*" class="hidden" onchange="previewImage(event)" />
        </div>

        <div class="mt-4 md:mt-0">
          <h4 class="text-lg font-medium text-gray-800">Dr. Sarah Johnson</h4>
          <p class="text-sm text-gray-500">Cardiologist at Green Pulse Clinic</p>
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Left Column -->
        <div class="space-y-5">
          <h4 class="font-medium text-gray-800">Personal Details</h4>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
            <input type="text" value="Dr. Sarah Johnson"
              class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input type="email" value="sarah.johnson@greenpulse.com"
              class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
            <input type="tel" value="(555) 123-4567"
              class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Specialization</label>
            <input type="text" value="Cardiology"
              class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
          </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-5">
          <h4 class="font-medium text-gray-800">Working Hours</h4>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
            <input type="time" value="09:00"
              class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
            <input type="time" value="17:00"
              class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition" />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Appointment Duration</label>
            <select class="w-full p-3 border border-gray-300 rounded-xl focus:border-clinic-500 focus:ring-1 focus:ring-clinic-500 transition">
              <option>15 minutes</option>
              <option selected>30 minutes</option>
              <option>45 minutes</option>
              <option>60 minutes</option>
            </select>
          </div>

          <button
            class="w-full mt-6 bg-clinic-500 hover:bg-clinic-600 text-white py-3 rounded-xl font-medium shadow-md hover:shadow-lg transition-all">
            Save Changes
          </button>
        </div>
      </div>
    </section>
  </main>

  <script>
    feather.replace();

    function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function(){
        const output = document.getElementById('profileImage');
        output.src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    }

    // Logout confirmation
    function logoutConfirm() {
      if (confirm("Are you sure you want to log out?")) {
        window.location.href = "logout.php"; // redirect to logout.php
      }
    }
  </script>
</body>
</html>
