# GraphQL API with Laravel and secured with Auth0

A sample GraphQL API built with Laravel and secured with Auth0

## Requirements

In order to run this application, you need the following software installed on your machine:

- [PHP 7.*](https://php.net/)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com)

## Installation

After cloning this repository, move in the cloned directory and follows these steps.

1. Create a `.env` file by copying the `.env.example` file, as shown by the following example:

```shell
cp .env.example .env
```

2. Edit the `.env` file in order to configure the parameters to access your database.

3. Install the project's dependencies by running Composer, as shown below:

   ```shell
   composer install
   ```

4. Initialize your database by typing the following command:

   ```shell
   php artisan migrate --seed
   ```

   

5. Run the application by typing:

   ```shell
   php artisan serve
   ```

   

6. Open a browser to http://localhost:8000/graphql?query=query{wines}

   