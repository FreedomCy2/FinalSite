<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClinicFlow - Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            100: '#E6F7FB',
                            500: '#68D6EC',
                            600: '#4BC9E3',
                        },
                        secondary: {
                            100: '#F0F9FF',
                            500: '#3B82F6',
                            600: '#2563EB',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e6f7fb 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .glow {
            animation: glow 2s infinite alternate;
        }
        @keyframes glow {
            from {
                box-shadow: 0 0 10px -5px rgba(104, 214, 236, 0.6);
            }
            to {
                box-shadow: 0 0 20px 2px rgba(104, 214, 236, 0.6);
            }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto text-center mb-16">
                <div class="flex justify-center mb-6">
                    <img src="ClinicLogo.png" alt="ClinicFlow Logo" class="w-32 h-32 rounded-full object-cover shadow-lg">
</div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Welcome to ClinicFlow</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Streamlined healthcare management for modern clinics</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <!-- Patient Login Card -->
            <a href="{{ route('user.introduction') }}" class="card-hover">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 h-full glow">
                    <div class="p-8">
                        <div class="flex justify-center mb-6">
                            <div class="bg-primary-100 rounded-full p-4">
                                <i data-feather="user" class="w-8 h-8 text-primary-500"></i>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-center text-gray-800 mb-3">Patient Portal</h3>
                        <p class="text-gray-600 text-center mb-6">Access your medical records, appointments, and health information</p>
                        <button class="w-full bg-primary-500 hover:bg-primary-600 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
                            Continue as Patient
                        </button>
                    </div>
                </div>
            </a>

<!-- Staff Login Card -->
<a href="{{ route('admin.login') }}" class="card-hover">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 h-full">
        <div class="p-8">
            <div class="flex justify-center mb-6">
                <div class="rounded-full p-4" style="background-color: #E3F6F9;">
                    <i data-feather="users" class="w-8 h-8" style="color: #3DA6C1;"></i>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-center text-gray-800 mb-3">Staff Portal</h3>
            <p class="text-gray-600 text-center mb-6">Access the clinic management system and patient records</p>
            <button class="w-full text-white font-bold py-3 px-4 rounded-lg transition duration-300"
                style="background-color: #3DA6C1; hover:bg-color: #3592AA;">
                Continue as Staff
            </button>
        </div>
    </div>
</a>

        </div>

        <div class="max-w-4xl mx-auto mt-12 text-center">
            <p class="text-gray-500">Need help? <a href="#" class="text-primary-500 hover:text-primary-600 font-medium">Contact our support team</a></p>
        </div>
    </div>

    <script>
        feather.replace();
        
        // Simple animation for the cards on load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.5s ease ' + (index * 0.1) + 's';
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            });
        });
    </script>
</body>
</html>