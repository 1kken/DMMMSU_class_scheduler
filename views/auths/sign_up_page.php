<?php 
require_once("../../includes/config_session.inc.php");
require_once("../../includes/signup/signup_view.php");
?>
<link rel="stylesheet" href="/DMMMSU_class_scheduler/public/css/output.css">
<div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-950">
    <div class="bg-white dark:bg-gray-900 shadow-md rounded-lg px-8 py-6 max-w-md">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 max-w-xl">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                Create an Account
            </h1>
            <form class="space-y-4 md:space-y-6" action="/DMMMSU_class_scheduler/includes/signup.handler.php" method="post">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your ID Number</label>
                    <input type="number" name="id-number" id="id-number" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="21111111" required="">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required="">
                </div>
                <div class="mb-4">
                    <label for="confirm-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm Password</label>
                    <input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required="">
                </div>
                <div class="mb-4">
                    <label for="user-type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">User Type</label>
                    <select name="user-type" id="user-type" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required="">
                        <option value="student">Student</option>
                        <option value="instructor">Instructor</option>
                    </select>
                </div>
                <div class="flex items-start mb-4">
                </div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create an Account</button>
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    Already have an account? <a href="/DMMMSU_class_scheduler/views/auths/log_in_page.php" class="font-medium text-indigo-600 hover:underline dark:text-indigo-500">Login here</a>
                </p>
            </form>
        </div>
        <?php
            check_for_signup_errors(); 
        ?>
    </div>
</div>
