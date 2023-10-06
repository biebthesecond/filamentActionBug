
# Setup
Next to default things, the bug can be reproduced after you create an account. After that you should get redirected to a page with a text input. Fill in this input with whatever you fancy and a table should appear. The row action in that table isn't working. The bulk action is. I hope this is enough
* > composer install
* > npm install
* > php artisan key:generate
* Env variables
  * APP_NAME
  * APP_URL
  * DATABASE
    * DB_HOST
    * DB_PORT
    * DB_DATABASE
    * DB_USERNAME
    * DB_PASSWORD
  * MAILTRAP
    * MAIL_MAILER=smtp
    * MAIL_HOST=sandbox.smtp.mailtrap.io
    * MAIL_PORT=2525
    * MAIL_USERNAME=
    * MAIL_PASSWORD=
    * MAIL_FROM_ADDRESS=from@example.com
    * MAIL_FROM_NAME="${APP_NAME}"
  * QUEUE_CONNECTION=sync
* > php artisan migrate --seed
* > php artisan storage:link
* > npm run dev

