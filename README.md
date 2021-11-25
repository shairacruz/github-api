## Simple Github API Exercise

This is a simple API application that enables user to search for github user information

Technologies Used: 
- Laravel 8
- Laravel Sanctum
- MySQL
- Redis

### Project Setup 

Follow this instructions to setup the project: 
1. Clone the repository
2. Make sure to configure .env file according to your local settings
3. Run **composer install**
4. Run MySQL and Redis servers
5. Run **php artisan migrate**
6. Run **php artisan serve**

### API Endpoints
Main Domain: http://127.0.0.1:8000

##### Register API
- Endpoint: /api/register
- Method: POST
- Headers
  - Accept : application/json
- Body
  - x-www-form-urlencoded
  - Required parameters
    - username
    - password
    - password_confirmation
- Note: Save the token generated from this api to authenticate search endpoint

##### Login API
- Endpoint: /api/login
- Method: POST
- Body
  - x-www-form-urlencoded
  - Required parameters
    - username
    - password
- Note: Save the token generated from this api to authenticate search endpoint

##### Github search API
- Endpoint: /api/github/search/{username seperated by comma}
- Example: /api/github/search/apple,citrus,delta,banana
- Method: GET
- Authorization: Bearer Token
  - Input the token generated from login/register
- Headers
  - Accept : application/json
  
##### Logout API
- Endpoint: /api/logout
- Method: POST
- Authorization: Bearer Token
  - Input the token generated from login/register
