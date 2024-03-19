<?php
require_once("../../includes/config_session.inc.php");
require_once("../../includes/login/login_view.php");
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/DMMMSU_class_scheduler/public/css/output.css">
<div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-950">
	<div class="bg-white dark:bg-gray-900 shadow-md rounded-lg px-8 py-6 max-w-md">
		<h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-200">Welcome User</h1>

		<form action="/DMMMSU_class_scheduler/includes/login.handler.php" method="post">
			<div class="mb-4">
				<label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">ID number</label>
				<input type="number" id="id-number" name="id-number" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="21111111" required>
			</div>
			<div class="mb-4">
				<label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
				<input type="password" id="password" name="password" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter your password" required>
			</div>
			<div class="mb-4">
				<label for="user-type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">User Type</label>
				<select name="user-type" id="user-type" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required="">
					<option value="student">Student</option>
					<option value="instructor">Instructor</option>
				</select>
			</div>
			<div class="flex items-center justify-between mb-4">
				<div class="flex items-center">
					<input type="checkbox" id="remember" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 focus:outline-none" checked>
					<label for="remember" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Remember me</label>
				</div>
				<a href="/DMMMSU_class_scheduler/views/auths/sign_up_page.php" class="text-xs text-indigo-500 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create
					Account</a>
			</div>
			<button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</button>
		</form>
		<?php
		check_login_errors(); ?>
	</div>
</div>

</html>