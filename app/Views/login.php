<!-- app/Views/login.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url('assets/css/output.css') ?>" rel="stylesheet">
    <title>Login</title>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-sm">
        <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Login</h2>

        <?php if(session()->getFlashdata('error')): ?>
        <p class="text-red-500 text-sm mb-4"> <?php echo session()->getFlashdata('error'); ?> </p>
        <?php endif; ?>

        <form action="/login" method="POST" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-600">Username:</label>
                <input type="text" name="username" id="username"
                    class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md text-gray-900 focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-600">Password:</label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-md text-gray-900 focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <button type="submit"
                class="w-full bg-blue-500 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                Login
            </button>
        </form>
    </div>
</body>

</html>