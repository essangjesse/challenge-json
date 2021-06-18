# Challenge Json Web Service

### **Description**

This will create a dockerized stack for our service, made up of one container that houses the images (Nginx, PHP7.4 PHP7.4-fpm, Composer, NPM, Node.js v10.x) needed to run our Laravel application which imports the contents of a JSON-file cleanly and consistently to a database.

### **Directory Structure**
```
+-- .git
+-- resources
|   +-- default
|   +-- nginx.conf
|   +-- supervisord.conf
|   +-- www.conf
+-- src <project root>
+-- .gitignore
+-- docker-compose.yml
+-- Dockerfile
+-- php-override.ini
+-- readme.md <this file>
```

### **Prerequisites**

Depending on your OS, the appropriate version of Docker Community Edition has to be installed on your machine.  ([Download Docker Community Edition](https://hub.docker.com/search/?type=edition&offering=community))

Download and Install Postman on your machine for consuming API endpoints. ([Download Postman](https://www.postman.com/downloads/))

Ensure that you have a MySQL server instance running on your local machine. Learn how to install MySQL [on MacOS](https://flaviocopes.com/mysql-how-to-install/), [on Windows](https://www.liquidweb.com/kb/install-mysql-windows/). After successfully installing your MySQL server you may choose to download an administration tool such as [MySQL Workbench](https://www.mysql.com/products/workbench/) or [phpMyAdmin](https://www.phpmyadmin.net/).

### **How To Install**

1. Clone the project from the github repository:

    ```
    $ git clone https://github.com/essangjesse/challenge-json.git
    ```

2. `cd` into the project folder.

3. By default, port 80 in your docker container is mapped to port 8000 on your local machine. This mapping is done in the `docker-compose.yml` which can be found in the project root. If you already have some service running on port 8000 you should map port 80 to a different port before you proceed.

4. Execute the following command:

    ```
    $ docker compose up -d
    ```

    This will download/build all the required images and start the stack containers. It usually takes a bit of time, so grab a cup of coffee.

6. After the whole stack is up, ssh into the app container by running the following command:

    ```
    $ docker exec -it ChallengeJsonWS bash
    ```

7. In that shell, run `$ composer update` to install all your Laravel dependencies.

8. Copy .env.example to .env:

    ```
    $ cp .env.example .env
    ```

9. To generate your app key, run:

    ```
    $ php artisan key:generate
    ```

10. In the `.env` file, configure your database connection parameters and set the **QUEUE_CONNECTION** parameter to `database`.

11. In your terminal, run `php artisan migrate` to migrate existing tables to your database.

### **Postman Documentation**

Refer to the [Postman Documentation](https://documenter.getpostman.com/view/14479887/TzeXk7Zd) for instructions on how to consume the endpoints.
