<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealWell Haven Clinic</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6', // blue-500 as default primary
                        secondary: '#10b981', // emerald-500 as default secondary
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
        .hero-bg {
            background-image: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), 
                              url('http://static.photos/medical/1200x630/42');
            background-size: cover;
            background-position: center;
        }
        .btn-primary {
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i data-feather="heart" class="text-primary h-8 w-8"></i>
                        <span class="ml-2 text-xl font-bold text-gray-800">HealWell Haven</span>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="#" class="border-primary text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Home</a>
                    <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Services</a>
                    <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Doctors</a>
                    <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Contact</a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <button class="bg-primary hover:bg-primary-600 text-white px-4 py-2 rounded-md text-sm font-medium btn-primary">
                        Book Appointment
                    </button>
                </div>
                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <i data-feather="menu"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-bg">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="block">Your Health is</span>
                    <span class="block text-primary">Our Priority</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Comprehensive healthcare services tailored to your needs with compassionate professionals dedicated to your wellbeing.
                </p>
                <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                    <div class="rounded-md shadow">
                        <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-primary-600 md:py-4 md:text-lg md:px-10 btn-primary">
                            Book an Appointment
                        </a>
                    </div>
                    <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                        <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10">
                            Our Services
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-primary font-semibold tracking-wide uppercase">Services</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Comprehensive Healthcare Solutions
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    We offer a wide range of medical services to meet all your healthcare needs.
                </p>
            </div>

            <div class="mt-10">
                <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                            <i data-feather="activity"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Diagnostics</p>
                        <p class="mt-2 ml-16 text-base text-gray-500">
                            State-of-the-art diagnostic equipment for accurate and timely results.
                        </p>
                    </div>

                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                            <i data-feather="heart"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Cardiology</p>
                        <p class="mt-2 ml-16 text-base text-gray-500">
                            Comprehensive heart care from prevention to advanced treatments.
                        </p>
                    </div>

                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                            <i data-feather="eye"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Ophthalmology</p>
                        <p class="mt-2 ml-16 text-base text-gray-500">
                            Expert eye care for vision correction and eye health management.
                        </p>
                    </div>

                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                            <i data-feather="thermometer"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Pediatrics</p>
                        <p class="mt-2 ml-16 text-base text-gray-500">
                            Specialized care for infants, children, and adolescents.
                        </p>
                    </div>

                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                            <i data-feather="scissors"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Surgery</p>
                        <p class="mt-2 ml-16 text-base text-gray-500">
                            Minimally invasive and traditional surgical procedures.
                        </p>
                    </div>

                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary-500 text-white">
                            <i data-feather="shield"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Emergency Care</p>
                        <p class="mt-2 ml-16 text-base text-gray-500">
                            24/7 emergency services with rapid response and expert care.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-primary font-semibold tracking-wide uppercase">Testimonials</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    What Our Patients Say
                </p>
            </div>
            <div class="mt-10 grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img class="h-12 w-12 rounded-full" src="http://static.photos/people/200x200/1" alt="Patient">
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Sarah Johnson</h3>
                            <p class="text-gray-500">Cardiac Patient</p>
                        </div>
                    </div>
                    <p class="mt-4 text-gray-600">
                        "The care I received was exceptional. The doctors took time to explain everything and made me feel comfortable throughout my treatment."
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img class="h-12 w-12 rounded-full" src="http://static.photos/people/200x200/2" alt="Patient">
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Michael Chen</h3>
                            <p class="text-gray-500">Pediatric Care</p>
                        </div>
                    </div>
                    <p class="mt-4 text-gray-600">
                        "My kids actually look forward to their check-ups! The pediatric team is amazing with children and very thorough."
                    </p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img class="h-12 w-12 rounded-full" src="http://static.photos/people/200x200/3" alt="Patient">
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">David Wilson</h3>
                            <p class="text-gray-500">Emergency Care</p>
                        </div>
                    </div>
                    <p class="mt-4 text-gray-600">
                        "When I had my accident, the emergency team acted quickly and professionally. I'm grateful for their expertise and compassion."
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-primary">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">Ready to take control of your health?</span>
                <span class="block text-primary-200">Book your appointment today.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-white hover:bg-gray-50">
                        Schedule Now
                    </a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="#" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Clinic</h3>
                    <ul class="mt-4 space-y-4">
                        <li>
                            <a href="#" class="text-base text-gray-300 hover:text-white">About Us</a>
                        </li>
                        <li>
                            <a href="#" class="text-base text-gray-300 hover:text-white">Our Team</a>
                        </li>
                        <li>
                            <a href="#" class="text-base text-gray-300 hover:text-white">Careers</a>
                        </li>
                        <li>
                            <a href="#" class="text-base text-gray-300 hover:text-white">News</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Services</h3>
                    <ul class="mt-4 space-y-4">
                        <li>
                            <a href="#" class="text-base text-gray-300 hover:text-white">Primary Care</a>
                        </li>
                        <li>
                            <a href="#" class="text-base text-gray-300 hover:text-white">Specialty Care</a>
                        </li>
                        <li>
                            <a href="#" class="text-base text-gray-300 hover:text-white">Diagnostics</a>
                        </li>
                        <li>
                            <a href="#" class="text-base text-gray-300 hover:text-white">Emergency Care</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Patient Resources</h3>
                    <ul class="mt-4 space-y-4">
                        <li>
                            <a href="#" class="text-base text-gray-300 hover:text-white">Patient Portal</a>
                        </li>
                        <li>
                            <a href="#" class="text-base text-gray-300 hover:text-white">Insurance</a>
                        </li>
                        <li>
                            <a href="#" class="text-base text-gray-300 hover:text-white">Billing</a>
                        </li>
                        <li>
                            <a href="#" class="text-base text-gray-300 hover:text-white">FAQs</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Contact</h3>
                    <ul class="mt-4 space-y-4">
                        <li class="text-base text-gray-300">
                            123 Medical Drive<br>
                            Healthville, HV 12345
                        </li>
                        <li class="text-base text-gray-300">
                            Phone: (123) 456-7890
                        </li>
                        <li class="text-base text-gray-300">
                            Email: info@healwellhaven.com
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-700 pt-8 md:flex md:items-center md:justify-between">
                <div class="flex space-x-6 md:order-2">
                    <a href="#" class="text-gray-400 hover:text-gray-300">
                        <i data-feather="facebook" class="h-6 w-6"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-300">
                        <i data-feather="instagram" class="h-6 w-6"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-300">
                        <i data-feather="twitter" class="h-6 w-6"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-300">
                        <i data-feather="linkedin" class="h-6 w-6"></i>
                    </a>
                </div>
                <p class="mt-8 text-base text-gray-400 md:mt-0 md:order-1">
                    &copy; 2023 HealWell Haven Clinic. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script>
        feather.replace();
        // Simple animation for features
        document.addEventListener('DOMContentLoaded', function() {
            const features = document.querySelectorAll('.relative');
            features.forEach((feature, index) => {
                feature.style.opacity = '0';
                feature.style.transform = 'translateY(20px)';
                feature.style.transition = `opacity 0.5s ease ${index * 0.1}s, transform 0.5s ease ${index * 0.1}s`;
                
                setTimeout(() => {
                    feature.style.opacity = '1';
                    feature.style.transform = 'translateY(0)';
                }, 500 + (index * 100));
            });
        });
    </script>
</body>
</html>
