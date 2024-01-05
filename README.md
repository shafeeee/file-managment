# file-managment
 
The portal aims to provide an organized platform for managing user access, file uploads, and structured viewing of files related to logos, social media posts, and branding guidelines.
Functional Requirements:
    • User Management:
        ◦ The admin should have the ability to create new user accounts.
        ◦ The admin should be able to delete user accounts when necessary.
        ◦ Users should have unique login credentials to access the portal.
    • File Upload and Management:
        ◦ Users should be able to log in securely to the portal.
        ◦ Users can upload files to the portal.
        ◦ The admin should have the ability to upload files to specific user folders. And user will be able to see those files when they login. 
        ◦ Uploaded files should support various formats (e.g., images, documents) commonly used for logos, social media posts, and branding guidelines.
        ◦ File uploads should have appropriate validations (file type, size limits).

1. HOW TO INSTALL?
----------------------------------------------------------------------------------------
1. Rename envexample with specific values, database host, username and password
2. `npm install` and `npm run dev`
3. `composer install` and `php artisan key:generate`
3. `php artisan migrate`
4. `php artisan db:seed --class=AdminSeeder` for seeding
5. `php artisan storage:link`
6. `php artisan serve`
7. Login with `admin@example.com` and password is `password`
8. Test by adding users 

