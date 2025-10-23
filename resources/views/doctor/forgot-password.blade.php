<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Password Wizardry Portal</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: {
                100: '#ECFDF5',
                500: '#10B981',
                600: '#059669'
              }
            }
          }
        }
      }
    </script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <custom-navbar></custom-navbar>
    
    <main class="flex-grow flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg p-8 max-w-md w-full">
            <div class="text-center mb-8">
                <i data-feather="key" class="w-12 h-12 text-primary-500 mx-auto"></i>
                <h1 class="text-2xl font-bold text-gray-800 mt-4">Forgot Password?</h1>
                <p class="text-gray-600 mt-2">Enter your email and we'll send you a reset link</p>
            </div>

            <form id="resetForm" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                    <div class="relative">
                        <input 
                            type="email" 
                            id="email" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                            placeholder="your@email.com">
                        <i data-feather="mail" class="absolute right-3 top-3.5 text-gray-400"></i>
                    </div>
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-primary-500 hover:bg-primary-600 text-white font-medium py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                    <i data-feather="send" class="mr-2"></i>
                    Send Reset Link
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="/doctor/login" class="text-primary-500 hover:text-primary-600 font-medium text-sm inline-flex items-center">
                    <i data-feather="arrow-left" class="w-4 h-4 mr-1"></i>
                    Back to login
                </a>
            </div>
        </div>
    </main>

    <div id="successToast" class="fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-primary-100 border border-primary-300 text-primary-700 px-6 py-3 rounded-lg shadow-lg hidden">
        <div class="flex items-center">
            <i data-feather="check-circle" class="text-primary-500 mr-2"></i>
            <span>Reset link sent to your email!</span>
        </div>
    </div>

    <custom-footer></custom-footer>

    <script src="components/navbar.js"></script>
    <script src="components/footer.js"></script>
    <script src="script.js"></script>
    <script>
        feather.replace();
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            
            // In a real app, this would call your backend API
            console.log('Would send reset email to:', email);
            
            // Simulate successful submission
            const toast = document.getElementById('successToast');
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 3000);
        });
    </script>
</body>
</html>