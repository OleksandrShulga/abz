Для розгортання треба заповнити env і виконати команди:
1) composer install
2) php artisan key:generate
3) php artisan migrate
4) php artisan db:seed
5) php artisan storage:link
6) npm install
7) npm run prod

Це тестове завдання, зроблене по наступному технічному завданню:

PHP Developer
Test Assignment

( ! ) General Information
1. Requirements and deliverables for your test assignment solution:
   a. Deploy your work on any hosting (so that it can be viewed in a browser without us deploying
   your source code ourselves) and send us a link to it.
   b. In your email specify the list of completed items and which tools, libraries, etc. you used in
   your solution. If you did not complete all the items of the test assignment, please clarify the
   reason why you have not completed them (not enough time, not enough
   experience/knowledge, something else).
   c. Be sure to attach to the letter the most detailed and up-to-date CV, indicating the city, photo,
   contacts and previous work experience (even if not related to IT).
   d. Provide a link to the github/bitbucket repository.
   e. Write in the email how many hours were spent on the assignment and which
   difficulties/problems you have faced.
   f. Send your email to the email address hr@abz.agency.
2. Materials for this test assignment:
   a. All materials used in this test assignment were specially developed by abz.agency employees
   to test applicants' knowledge as part of the test assignment for this vacancy and have nothing
   to do with our commercial projects.
   b. Your work will not be used for commercial and (even) non-commercial purposes.
   c. You must not use any materials of this test assignment and your solution to it for any
   commercial or non-commercial purposes (including in a portfolio, for organizing courses, or as
   a test in another company).

Important! Your solution to the test assignment will only be considered by our team if it complies with all the
requirements listed above.

_____________________________________________________________________________________________________________________________________
( HR ) Polina
- hr_polina_b@abz.agency
- +380 97 055 45 74
- https://t.me/hr_polina_b
- https://www.linkedin.com/in/hr-abz-agency-polina/

( HR ) Nastya
- hr_nastya_p@abz.agency
- +380 68 868 58 01
- https://t.me/hr_nastya_p
- https://www.linkedin.com/in/hr-abz-agency-nastya/

www.abz.agency
hr@abz.agency

(<) Test assignment
1. Implement simple REST API server as defined in the API documentation (OpenAPI)
2. Data generation / seeders
   a. Implement a data generator and seeders for the initial filling of the database with data (45
   users).
   b. The data should be as close as possible similar to the data which a real user would fill.
3. POST request handling requirements:
   a. The image needs to be cropped (center/center) and saved as jpg 70x70px.
   b. The image should be optimized using the tinypng.com API. You can use any other API service
   for image optimization (we use kraken.io, but it's paid only), just make sure to indicate in the
   description of the test task which service was used and why.
   c. An authorization token is needed only to demonstrate the ability to generate and use it.
4. Implement frontend part, just to demonstrate how your server works. Without beautiful design and
   formatting, you can use any ready-made UI components that you feel comfortable working with. We
   will only be paying attention to the output of the data and verifying if form works.
   a. Display a list of users with a “Show more” button, output 6 users per page.
   b. Create an add new user form. No validation is needed on the front-end part, all validations
   should be done only on the server side.
