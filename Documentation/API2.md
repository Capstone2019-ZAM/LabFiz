<h1 align="center">
API Documentation
<br><br>
<a href=""><img src="https://img.shields.io/badge/Maintained%3F-yes-green.svg" alt="Build Status"></a>
<a href=""><img src="https://img.shields.io/badge/Version-1.0-<COLOR>.svg" alt="Build Status"></a>
<a href=""><img src="https://img.shields.io/badge/Made%20with-Markdown-1f425f.svg" alt="Build Status"></a>
</h1>

The end points described below serve authenticated JSON to the VueJs frontend for the laravel app. All the endpoints(except login) are protected using token based authentication with short-lived access tokens. Note that the refresh route(localhost/api/user/refresh) will need to be invoked when an api access token expires in order to generate a new token pair{api auth token, refresh token} for future endpoint requests.

## Bearer Authentication

HTTP requests to protected routes will require the Authorization field set in the HTTP header with a key value of Bearer + ' ' + token.


*Format:*

```bash
Authorization: Bearer Token
```
*Example:*
```bash
Authorization: Bearer 1shtRTbPCVs2xe7cviyaIAGWClT57y9YwjyVSFerKgXeFDh0LnvdpyM6CUvb
```


## Generic Errors

  

*Using an authentication token that has expired:*

```json
{
"status": "401 (Unauthorized)",
"message": "Your authentication token has expired, request a refresh using the refresh route.",
"data": ""
}

```

*Authorization field is either null or doesn't match the required format with the authentication token:*

```json

{

"status": "422 (Unprocessable Entity)",
"message": "Authorization field of request header requires a Bearer token.",
"data": ""
}

```

*Authentication token supplied is not valid(i.e: does not exist):*

```json

{

"status": "422 (Unprocessable Entity)",
"message": "Invalid authentication token. Please make sure the bearer token is valid.",
"data": ""
}

``` 

## Endpoints

  
<!--ts-->

*  [**Users**](#users)
*  [Login](#login)
*  [Refresh](#Refresh)
*  [Get](#Get-User-By-Id)
*  [Get all](#Get-All-Users)
*  [Create/Update](#Create-User)
*  [Delete](#Delete-User)
*  [**Reports**](#reports)
*  [Get](#Get-Report-By-Id)
*  [Get all](#Get-All-Reports)
*  [Create/Update](#Create-Report)
*  [Delete](#Delete-Report)
*  [Restore](#Restore-Report)
*  [**Inspections**](#inspections)
*  [Get](#Get-Inspection-By-Id)
*  [Get all](#Get-All-Inspections)
*  [Create/Update](#Create-Inspection)
*  [Delete](#Delete-Inspection)
*  [**Issues**](#issues)
*  [Get](#Get-Issue-By-Id)
*  [Get all](#Get-All-Issues)
*  [Create/Update](#Create-Issue)
*  [Delete](#Delete-Issue)
*  [**Labs**](#labs)
*  [Get](#Get-Lab-By-Id)
*  [Get all](#Get-All-Labs)
*  [Create/Update](#Create-Lab)
*  [Delete](#Delete-Lab)
*  [**Templates**](#templates)
*  [Get](#Get-Template-By-Id)
*  [Get all](#Get-All-Templates)
*  [Create/Update](#Create-Template)
*  [Delete](#Delete-Template)
*  [**Comments**](#comments)
*  [Get](#Get-Comment-By-Id)
*  [Get all](#Get-All-Comments)
*  [Create/Update](#Create-Comment)
*  [Delete](#Delete-Comment)

<!--te-->

<!--te-->

| # | Category |           Route URL          | Latest Version | Request Type |              Desc              |                More Info               |
|:-:|:--------:|:----------------------------:|:--------------:|:------------:|:------------------------------:|:--------------------------------------:|
| 1 |  User  | localhost/api/user/login            |        -       |      POST     | Logins in a user by the user id | [More](#Login) |
| 2 |  User  | localhost/api/user/refresh            |        -       |      POST     | Refreshes an expired api auth token | [More](#Refresh) |
| 3 |  User  | localhost/api/user/{id} |        -       |      GET     | Gets a user by the user id | [More](#GetUserById) |
| 4 |  User  | localhost/api/users |        -       |      GET     | Gets all users | [More](#GetAllUsers) |
| 5 |  User  | localhost/api/user |        -       |      POST     | Creates a user if it does not exist, otherwise updates an exisiting one | [More](#CreateUser) |
| 6 |  User  | localhost/api/user/{id} |        -       |      POST     | Deletes an exisiting user | [More](#DeleteUser) |
| 7 |  User  | localhost/api/user/{id} |        -       |      DELETE    | Deletes a user by id | [More](#DeleteUser) |
| 8 |  Report  | localhost/api/v1/report/{id} |        1       |      GET     | Gets a report by the report id | [More](#GetReportById) |
| 9 |  Report  |   localhost/api/v1/reports   |        1       |      GET     |        Gets all reports        | [More](#GetAllReports) |
| 10 |  Report  |    localhost/api/v1/report   |        1       |     POST     |     Creates a report if it does not exist, otherwise updates an exisiting one    | [More](#CreateReport) |
| 11 |  Report  |    localhost/api/v1/report/{id}   |        1       |    DELETE    |     Deletes a report by id     | [More](#DeleteReport) |
| 12 |  Report  |    localhost/api/v1/restore_report/{id}   |        1       |    DELETE    |     Restores a deleted report by id     | [More](#RestoreReport) |
| 13 |  Inspection  | localhost/api/v1/report/{id} |        1       |      GET     | Gets an inspection assignment by the id | [More](#GetInspectionById) |
| 14 |  Inspection  |   localhost/api/v1/inspection   |        1       |      GET     |        Gets all inspection assignments        | [More](#GetAllInspections) |
| 15 |  Inspection  |    localhost/api/v1/inspection   |        1       |     POST     |     Creates an inspection if it does not exist, otherwise updates exisiting one    | [More](#CreateInspection) |
| 16 |  Inspection  |    localhost/api/v1/inspection/{id}   |        1       |    DELETE    |     Deletes an inspection assignment     | [More](#DeleteInspection) |
| 17 |  Issue  | localhost/api/v1/issue/{id} |        1       |      GET     | Gets an issue by id | [More](#GetIssueById) |
| 18 |  Issue  |   localhost/api/v1/issues   |        1       |      GET     |        Gets all issues        | [More](#GetAllIssues) |
| 19 |  Issue  |    localhost/api/v1/issue   |        1       |     POST     |     Creates an issue if it does not exist, otherwise updates exisiting one    | [More](#CreateIssue) |
| 20 |  Issue  |    localhost/api/v1/issue/{id}   |        1       |    DELETE    |     Deletes an issue by id     | [More](#DeleteIssue) |
| 21 |  Lab  | localhost/api/v1/lab/{id} |        1       |      GET     | Gets an lab by id | [More](#GetLabById) |
| 22 |  Lab  |   localhost/api/v1/labs   |        1       |      GET     |        Gets all labs        | [More](#GetAllLabs) |
| 23 |  Lab  |    localhost/api/v1/lab   |        1       |     POST     |     Creates a lab if it does not exist, otherwise updates exisiting one    | [More](#CreateLab) |
| 24 |  Comment  |    localhost/api/v1/comments/   |        1       |    GET    |     Gets all all comments for given issue id     | [More](#GetAllComments) |
| 25 |  Comment  |    localhost/api/v1/comment/{id}   |        1       |    GET    |     Gets comment by id      | [More](#GetByIdComment) |
| 26 |  Comment  |    localhost/api/v1/comment/{id}   |        1       |    POST    |     Creates a comment for given issue id     | [More](#CreateComment) |
| 27 |  Comment  |    localhost/api/v1/comment/{id}   |        1       |    DELETE    |     Deletes a comment by id     | [More](#DeleteComment) |
| 28 |  Template  |    localhost/api/v1/templates/   |        1       |    GET    |     Gets all all templates     | [More](#GetAllTemplate) |
| 29 |  Template  |    localhost/api/v1/template/{id}   |        1       |    GET    |     Gets template by id      | [More](#GetByITemplate) |
| 30 |  Template  |    localhost/api/v1/template/{id}   |        1       |    POST    |     Creates or updates a template     | [More](#CreatTemplate) |
| 31 |  Template  |    localhost/api/v1/template/{id}   |        1       |    DELETE    |     Deletes a template by id     | [More](#DeletTemplate) |

Users
============

## Login

```bash

Logs in the user using a short lived access token. Once the access token has expired,

a refresh will need to be issued to the refresh route in order to generate a new

refresh and access token pair.

```

  

*  **Route:**

  

localhost/api/user/login

  
  

*  **Request Type:**

POST

*  **Content Type:**

`application/json` .

*  **Auth Required:**

  

**Yes**


* **Body:**

|          	|                 Email                	|                      Password                     	|
|:--------:	|:------------------------------------:	|:-------------------------------------------------:	|
| Required 	|                   x                  	|                         x                         	|
| Optional 	|                                      	|                                                   	|
|   Notes  	| 	| 	|
| Optional | | |

| Notes | | |

*  **Sample Request:**

  

```json

{

"email": "bob@gmail.com",

"password": "dogfood"

}

```

*  **Success Response:**

  

```json

{

"status": "200 (Ok)",

"message": "User logged in successfully.",

"data": {

"email": "bob@gmail.com",

"role": "admin",

"token": "KMxhZdg8IL83STU8pwDYJmFTJbHmdp1HvGOqh6Q1ACumJxodNmFYFMFdOnwt",

"token_type": "ApiAuth",

"expires_at": "2020-02-04T08:08:26.000000Z",

"refresh_token": "hrRf6LGb8WFEl8RFFFQYMsp1Fk6vLIfq9eiSoAWf40pfXQTk6GcTtuqTsBZ7"

}

}

```

  

*  **Error Response:**

  

```json

{

"status": "400 (Bad Request)",

"message": "Invalid password.",

"data": ""

}

```

  

OR

  

```json

{

"status": "422 (Unprocessable Entity)",

"message": {

"password": [

"The password field is required."

],

"email": [

"The email field is required."

]

},

"data": ""

}

```

  

## Refresh

```bash

Used to refresh auth tokens. A new api auth and refresh token pair will be generated.

```

  

*  **Route:**

  

localhost/api/user/refresh

  
  

*  **Request Type:**

POST

*  **Content Type:**

`application/json` .

*  **Auth Required:**

  

**Yes**

*  **Body:**

  
  

*  **Sample Request:**

  

```json

{

"api_refresh_token": "I3tDzkQxQnyQbDNPmQyOPgmWWu6z7fxJQj7ffDG2JpJft7kNgouuncSZLkTb"

}

```

*  **Success Response:**

  

```json

{

"status": "200 (Ok)",

"message": "Api token refreshed successfully",

"data": {

"token": "q2E5T7rHcPUblPCiSWBE3wikjksctzdOIJOFj7oXbLXNxqB03FRVRoFrJVkK",

"token_type": "ApiAuth",

"expires_at": "2020-02-04T23:27:46.000000Z",

"refresh_token": "WmtUxLxverc6tzDPgU6lBfkJzYi0UDdxqMfbXhcMnYNixNIv5GDAfh9bqKyM"

}

}

```

  

*  **Error Response:**

  

```json

{

"status": "422 (Unprocessable Entity)",

"message": {

"api_refresh_token": [

"The api refresh token field is required."

]

},

"data": ""

}

```

  

OR

  
  

```json

{

"status": "400 (Bad Request)",

"message": "Authentication token has not expired yet.",

"data": ""

}

```

  
  

OR

  
  

```json

{

"status": "400 (Bad Request)",

"message": "Could not find given refresh token.",

"data": ""

}

```

  

## Get User By Id

```bash

Logs in the user using a short lived access token.

Once the access token has expired, a refresh will

need to be issued to the refresh route in

order to generate a new refresh and access token pair.

```

  

*  **Route:**

  

localhost/api/user/{id}

  
  

*  **Request Type:**

POST

*  **Content Type:**

`application/json` .

*  **Auth Required:**

  

**Yes**


* **Body:**

|          	|                 Email                	|                      Password                     	|
|:--------:	|:------------------------------------:	|:-------------------------------------------------:	|
| Required 	|                   x                  	|                         x                         	|
| Optional 	|                                      	|                                                   	|
|   Notes  	| 	| 	|

*  **Sample Request:**

  

```json

localhost/api/user/1

```

*  **Success Response:**

  

```json

{

"status": "200 (Ok)",

"message": "User retrieved successfully.",

"data": {

"id": 1,

"first_name": "Isabell",

"last_name": "Adams",

"department": "chemical",

"email": "egrimes@example.net",

"email_verified_at": "2020-02-03 01:30:23",

"api_token": "24nsjA8zwK21ewKMCNab9EFm2NMgozN2x8k1fDktxgRbQfK4sZFi73FWULMe",

"created_at": "2020-02-03 01:30:23",

"updated_at": "2020-02-05 07:41:53",

"api_token_expiry_date": "2020-02-04 00:04:23",

"api_refresh_token": "s7uLzmhqRF44nVwBRou8JrJqfLk36dPUxsMjoPKj9OkHOCDxyBAk7ZMOpAM5",

"api_token_type": "ApiAuth"

}

}

```

  

*  **Error Response:**

  

```json

{

"status": "400 (Bad Request)",

"message": "No query results for model [App\\User] 232",

"data": ""

}

```

  

## Get All Users

```bash

Gets all users.

```

  

*  **Route:**

  

localhost/api/users

  
  

*  **Request Type:**

POST

*  **Content Type:**

`application/json` .

*  **Auth Required:**

  

**Yes**

*  **Body:**

  
  

*  **Sample Request:**

  

```json

```

*  **Success Response:**

  

```json

{

"status": "200 (Ok)",

"message": "All Users retrieved successfully.",

"data": [

{

"id": 1,

"first_name": "Isabell",

"last_name": "Adams",

"department": "chemical",

"email": "egrimes@example.net",

"email_verified_at": "2020-02-03 01:30:23",

"api_token": "SjFJ0XyVOke1bpHfXVq8IAbwCTYwIgXHWztJi6lnJeLrLlu1QOgSQApJfK9r",

"created_at": "2020-02-03 01:30:23",

"updated_at": "2020-02-03 01:30:23",

"api_token_expiry_date": "2020-02-04 00:04:23",

"api_refresh_token": null,

"api_token_type": "ApiAuth"

},

{

"id": 2,

"first_name": "Eusebio",

"last_name": "Schamberger",

"department": "software",

"email": "tatyana.zemlak@example.net",

"email_verified_at": "2020-02-03 01:30:23",

"api_token": "eAljW1ZkFQqKJvS6zg2660weDAMgYdhHwBodAMsbke7hA2lsioPoAJ6swDla",

"created_at": "2020-02-03 01:30:23",

"updated_at": "2020-02-03 01:30:23",

"api_token_expiry_date": "2020-02-04 00:04:23",

"api_refresh_token": null,

"api_token_type": "ApiAuth"

},

{

"id": 3,

"first_name": "Tyshawn",

"last_name": "Blanda",

"department": "electrical",

"email": "ebradtke@example.org",

"email_verified_at": "2020-02-03 01:30:23",

"api_token": "R1k6sY55sbzXjVkSycH8qZS9aGQB3m4d3S1XEfEUJKfemN8P6cEJg1XcYc0Y",

"created_at": "2020-02-03 01:30:23",

"updated_at": "2020-02-03 01:30:23",

"api_token_expiry_date": "2020-02-04 00:04:23",

"api_refresh_token": null,

"api_token_type": "ApiAuth"

},

{

"id": 4,

"first_name": "Izaiah",

"last_name": "Rowe",

"department": "chemical",

"email": "laura13@example.com",

"email_verified_at": "2020-02-03 01:30:23",

"api_token": "FxppX3PqRAAZYW7V8q0tZOCvhdbOSDTwadG3hs0inNC5yninXTWGrWcg0pxL",

"created_at": "2020-02-03 01:30:23",

"updated_at": "2020-02-03 01:30:23",

"api_token_expiry_date": "2020-02-04 00:04:23",

"api_refresh_token": null,

"api_token_type": "ApiAuth"

},

{

"id": 5,

"first_name": "Mariah",

"last_name": "Feil",

"department": "petroleum",

"email": "ollie.bayer@example.org",

"email_verified_at": "2020-02-03 01:30:23",

"api_token": "7ql7LrH7woABenV5435BPigx77fQMJusFLvVqk88obQs5J6v9V7lLzUIDHeF",

"created_at": "2020-02-03 01:30:23",

"updated_at": "2020-02-03 01:30:23",

"api_token_expiry_date": "2020-02-04 00:04:23",

"api_refresh_token": null,

"api_token_type": "ApiAuth"

}

]

}

```

  

*  **Error Response:**

  

```json

```

  

Reports
============

  

## Get Report By Id

```bash

Gets a report by the report id

```

  

*  **Route:**

  

localhost/api/v1/report/{id}

*  **Request Type:**

GET

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**

  

localhost/api/v1/report/5

*  **Success Response:**

  

```json

{

"status": "200 (Ok)",

"message": "Report retrieved successfully.",

"data": {

"id": 5,

"title": "some cool title",

"user_id": 1,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_template_id": 1,

"room": "edc-232",

"due_date": "2020-02-04",

"sections": [

{

"id": 4,

"title": "sect_title_1",

"report_id": 5,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_section_template_id": 1,

"questions": [

{

"id": 2,

"question": "quest_title_1",

"report_section_id": 4,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

},

{

"id": 3,

"question": "quest_title_2",

"report_section_id": 4,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

}

]

},

{

"id": 5,

"title": "sect_title_2",

"report_id": 5,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_section_template_id": 1,

"questions": [

{

"id": 4,

"question": "quest_title_1",

"report_section_id": 5,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

},

{

"id": 5,

"question": "quest_title_2",

"report_section_id": 5,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

}

]

},

{

"id": 6,

"title": "sect_title_3",

"report_id": 5,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_section_template_id": 1,

"questions": [

{

"id": 6,

"question": "quest_title_1",

"report_section_id": 6,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

},

{

"id": 7,

"question": "quest_title_2",

"report_section_id": 6,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

}

]

}

]

}

}

```

  

*  **Error Response:**

  

```json

```

  

## Get All Reports

```bash

Gets all reports

```

  

*  **Route:**

  

localhost/api/v1/reports

*  **Request Type:**

GET

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**

  

localhost/api/v1/reports

*  **Success Response:**

  

```json

{

"status": "200 (Ok)",

"message": "All Reports retrieved successfully.",

"data": [

{

"id": 5,

"title": "some cool title",

"user_id": 1,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_template_id": 1,

"room": "edc-232",

"due_date": "2020-02-04",

"sections": [

{

"id": 4,

"title": "sect_title_1",

"report_id": 5,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_section_template_id": 1,

"questions": [

{

"id": 2,

"question": "quest_title_1",

"report_section_id": 4,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

},

{

"id": 3,

"question": "quest_title_2",

"report_section_id": 4,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

}

]

},

{

"id": 5,

"title": "sect_title_2",

"report_id": 5,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_section_template_id": 1,

"questions": [

{

"id": 4,

"question": "quest_title_1",

"report_section_id": 5,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

},

{

"id": 5,

"question": "quest_title_2",

"report_section_id": 5,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

}

]

},

{

"id": 6,

"title": "sect_title_3",

"report_id": 5,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_section_template_id": 1,

"questions": [

{

"id": 6,

"question": "quest_title_1",

"report_section_id": 6,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

},

{

"id": 7,

"question": "quest_title_2",

"report_section_id": 6,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

}

]

}

]

},

{

"id": 6,

"title": "some cool title",

"user_id": 1,

"created_at": "2020-02-17 00:27:17",

"updated_at": "2020-02-17 00:27:17",

"report_template_id": 1,

"room": "edc-232",

"due_date": "2020-02-04",

"sections": [

{

"id": 7,

"title": "sect_title_1",

"report_id": 6,

"created_at": "2020-02-17 00:27:17",

"updated_at": "2020-02-17 00:27:17",

"report_section_template_id": 1,

"questions": [

{

"id": 8,

"question": "quest_title_1",

"report_section_id": 7,

"created_at": "2020-02-17 00:27:17",

"updated_at": "2020-02-17 00:27:17",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

},

{

"id": 9,

"question": "quest_title_2",

"report_section_id": 7,

"created_at": "2020-02-17 00:27:17",

"updated_at": "2020-02-17 00:27:17",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

}

]

},

{

"id": 8,

"title": "sect_title_2",

"report_id": 6,

"created_at": "2020-02-17 00:27:17",

"updated_at": "2020-02-17 00:27:17",

"report_section_template_id": 1,

"questions": [

{

"id": 10,

"question": "quest_title_1",

"report_section_id": 8,

"created_at": "2020-02-17 00:27:17",

"updated_at": "2020-02-17 00:27:17",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

},

{

"id": 11,

"question": "quest_title_2",

"report_section_id": 8,

"created_at": "2020-02-17 00:27:17",

"updated_at": "2020-02-17 00:27:17",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

}

]

},

{

"id": 9,

"title": "sect_title_3",

"report_id": 6,

"created_at": "2020-02-17 00:27:17",

"updated_at": "2020-02-17 00:27:17",

"report_section_template_id": 1,

"questions": [

{

"id": 12,

"question": "quest_title_1",

"report_section_id": 9,

"created_at": "2020-02-17 00:27:17",

"updated_at": "2020-02-17 00:27:17",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

},

{

"id": 13,

"question": "quest_title_2",

"report_section_id": 9,

"created_at": "2020-02-17 00:27:17",

"updated_at": "2020-02-17 00:27:17",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

}

]

}

]

}

]

}

```

  
  

*  **Error Response:**

  

```json

```

  

## Create Report

```bash

Creates a report if it does not exist, otherwise updates an exisiting one.

```

  

*  **Route:**

  

localhost/api/v1/report

*  **Request Type:**

POST

*  **Content Type:**

`application/json` .

*  **Auth Required:**

  

YES

* **Body:**

|          | Title |                      Sections                     |                               Section Title                               |       Section Questions       |
|:--------:|:-----:|:-------------------------------------------------:|:-------------------------------------------------------------------------:|:-----------------------------:|
| Required |   x   |                                                   |                                                                           |                               |
| Optional |       |                         x                         |                                     x                                     |               x               |
|   Notes  |       | key with value of array containing section titles | section titles(sect_title_1,sect_title_2), etc. within the "sections" key | questions within the "qs" key |
  

*  **Sample Request:**

  

```json

{

"title" : "some cool report title",

"id": -1,

"template_id": 1,

"room" : "edc-232",

"due_date": "2020-02-04 23:26:46",

"assigned_to" : 1

},


```

*  **Success Response:**

  

```json

{

"status": "200 (Ok)",

"message": "Created report document successfully!",

"data": {

"id": -1,

"title": "some cool report title",

"user_id": 1,

"created_at": "2020-02-17T03:58:03.000000Z",

"updated_at": "2020-02-17T03:58:03.000000Z",

"report_template_id": 1,

"room": "edc-232",

"due_date": "2020-02-04 23:26:46",

"sections": {

"sect_title_1": {

"id": 22,

"title": "sect_title_1",

"report_id": 11,

"created_at": "2020-02-17T03:58:03.000000Z",

"updated_at": "2020-02-17T03:58:03.000000Z",

"report_section_template_id": null,

"questions": {

"quest_title_1": {

"report_section_id": 22,

"question": "quest_title_1",

"report_question_template_id": 1,

"answer": "dog",

"description": "food",

"updated_at": "2020-02-17 03:58:03",

"created_at": "2020-02-17 03:58:03",

"id": 38

},

"quest_title_2": {

"report_section_id": 22,

"question": "quest_title_2",

"report_question_template_id": 1,

"answer": "dog",

"description": "food",

"updated_at": "2020-02-17 03:58:03",

"created_at": "2020-02-17 03:58:03",

"id": 39

}

}

},

"sect_title_2": {

"id": 23,

"title": "sect_title_2",

"report_id": 11,

"created_at": "2020-02-17T03:58:03.000000Z",

"updated_at": "2020-02-17T03:58:03.000000Z",

"report_section_template_id": null,

"questions": {

"quest_title_1": {

"report_section_id": 23,

"question": "quest_title_1",

"report_question_template_id": 1,

"answer": "dog",

"description": "food",

"updated_at": "2020-02-17 03:58:03",

"created_at": "2020-02-17 03:58:03",

"id": 40

},

"quest_title_2": {

"report_section_id": 23,

"question": "quest_title_2",

"report_question_template_id": 1,

"answer": "dog",

"description": "food",

"updated_at": "2020-02-17 03:58:03",

"created_at": "2020-02-17 03:58:03",

"id": 41

}

}

},

"sect_title_3": {

"id": 24,

"title": "sect_title_3",

"report_id": 11,

"created_at": "2020-02-17T03:58:03.000000Z",

"updated_at": "2020-02-17T03:58:03.000000Z",

"report_section_template_id": null,

"questions": {

"quest_title_1": {

"report_section_id": 24,

"question": "quest_title_1",

"report_question_template_id": 1,

"answer": "dog",

"description": "food",

"updated_at": "2020-02-17 03:58:03",

"created_at": "2020-02-17 03:58:03",

"id": 42

},

"quest_title_2": {

"report_section_id": 24,

"question": "quest_title_2",

"report_question_template_id": 1,

"answer": "dog",

"description": "food",

"updated_at": "2020-02-17 03:58:03",

"created_at": "2020-02-17 03:58:03",

"id": 43

}

}

}

}

}

}

```

  

OR

  

```json

{

"status": "200 (Ok)",

"message": "Updated report document successfully!",

"data": {

"id": 5,

"title": "some cool report title",

"user_id": 1,

"created_at": "2020-02-17T00:23:40.000000Z",

"updated_at": "2020-02-17T04:10:54.000000Z",

"report_template_id": 1,

"room": "edc-232",

"due_date": "2020-02-04 23:26:46",

"sections": {

"sect_title_1": {

"id": 4,

"title": "sect_title_1",

"report_id": 5,

"created_at": "2020-02-17T00:23:40.000000Z",

"updated_at": "2020-02-17T00:23:40.000000Z",

"report_section_template_id": null,

"questions": {

"quest_title_1": {

"id": 2,

"question": "quest_title_1",

"report_section_id": 4,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

},

"quest_title_2": {

"id": 3,

"question": "quest_title_2",

"report_section_id": 4,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

}

}

},

"sect_title_2": {

"id": 5,

"title": "sect_title_2",

"report_id": 5,

"created_at": "2020-02-17T00:23:40.000000Z",

"updated_at": "2020-02-17T00:23:40.000000Z",

"report_section_template_id": null,

"questions": {

"quest_title_1": {

"id": 4,

"question": "quest_title_1",

"report_section_id": 5,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

},

"quest_title_2": {

"id": 5,

"question": "quest_title_2",

"report_section_id": 5,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

}

}

},

"sect_title_3": {

"id": 6,

"title": "sect_title_3",

"report_id": 5,

"created_at": "2020-02-17T00:23:40.000000Z",

"updated_at": "2020-02-17T00:23:40.000000Z",

"report_section_template_id": null,

"questions": {

"quest_title_1": {

"id": 6,

"question": "quest_title_1",

"report_section_id": 6,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

},

"quest_title_2": {

"id": 7,

"question": "quest_title_2",

"report_section_id": 6,

"created_at": "2020-02-17 00:23:40",

"updated_at": "2020-02-17 00:23:40",

"report_question_template_id": 1,

"answer": "dog",

"description": "food"

}

}

}

}

}

}

```

  

*  **Error Response:**

```json

{

"status": "422 (Unprocessable Entity)",

"message": {

"id": [

"The id field is required."

],

"title": [

"The title field is required."

],

"room": [

"The room field is required."

],

"template_id": [

"The template id field is required."

]

},

"data": ""

}

```

  

OR

  
  

```json

{

"status": "422 (Unprocessable Entity)",

"message": {

"sections.sect_title_1.qs": [

"The sections.sect_title_1.qs field is required when sections.sect_title_1 is present."

],

"sections.sect_title_2.qs": [

"The sections.sect_title_2.qs field is required when sections.sect_title_2 is present."

],

"sections.sect_title_3.qs": [

"The sections.sect_title_3.qs field is required when sections.sect_title_3 is present."

]

},

"data": ""

}

```

  
  

## Restore Report

```bash

Restores a deleted report by the id.

```

  

*  **Route:**

  

localhost/api/v1/restore_report/{id}

*  **Request Type:**

POST

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**

  

localhost/api/v1/restore_report/59

*  **Success Response:**

  

```json

{

"status":  "200 (Ok)",

"message":  "Report restored successfully.",

"data":  {

"id":  2,

"title":  "Wet Labs Template - 2020-03-24",

"template_id":  1,

"status":  "Overdue",

"lab":  "ED-416",

"due_date":  "2020-03-31",

"user_id":  12,

"assigned_to":  4,

"created_at":  "2020-03-24 02:52:57",

"updated_at":  "2020-03-28 05:43:08",

"deleted_at":  null

}

}

```

  

*  **Error Response:**

  

```json
{

"status":  "400 (Bad Request)",

"message":  "Could not find report record to delete.",

"data":  ""

}
```

  
  ## Delete Report

```bash

Deletes an existing report by the id.

```

  

*  **Route:**

  

localhost/api/v1/report/{id}

*  **Request Type:**

DELETE

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**

  

localhost/api/v1/report/59

*  **Success Response:**

  

```json

{

"status": "200 (Ok)",

"message": "Report deleted succesfully.",

"data": {

"id": 18,

"title": "some cool title 2029",

"user_id": 1,

"created_at": "2019-12-27 04:27:45",

"updated_at": "2019-12-27 04:27:45"

"deleted_at": "2019-12-27 04:27:45"


}

}

```

  

*  **Error Response:**

  

```json

```

  

Inspections
============

## Get Inspection By Id

```bash

Gets an inspection assignment by the id

```

  

*  **Route:**

  

localhost/api/v1/inspection/{id}

*  **Request Type:**

GET

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**

  

localhost/api/v1/inspection/2

*  **Success Response:**

  

```json

{

"status": "200 (Ok)",

"message": "Inspection assignment retrieved succesfully.",

"data": {

"id": 2,

"room": 69,

"report_id": 1,

"user_id": 1,

"assigned_to": 1,

"due_date": "2020-12-12",

"status": "incomplete",

"created_at": "2019-12-27 08:02:34",

"updated_at": "2019-12-27 08:02:34"

}

}

```

  

*  **Error Response:**

  

```json

  

```

  
  

## Get All Inspections

```bash

Gets all inspection assignments

```

  

*  **Route:**

  

localhost/api/v1/inspections

*  **Request Type:**

GET

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**

  

localhost/api/v1/inspections

*  **Success Response:**

  

```json

{

"status": "200 (Ok)",

"message": "All Inspection assignments retrieved succesfully.",

"data": [

{

"id": 2,

"room": 69,

"report_id": 1,

"user_id": 1,

"assigned_to": 1,

"due_date": "2020-12-12",

"status": "incomplete",

"created_at": "2019-12-27 08:02:34",

"updated_at": "2019-12-27 08:02:34"

},

{

"id": 3,

"room": 250,

"report_id": 1,

"user_id": 1,

"assigned_to": 1,

"due_date": "2020-12-12",

"status": "incomplete",

"created_at": "2019-12-27 08:12:44",

"updated_at": "2019-12-27 08:12:44"

}

]

}

```

  
  

*  **Error Response:**

  

```json

```

  

## Create Inspection

```bash

Creates an inspection if it does not exist, otherwise updates an exisiting one

```

  

*  **Route:**

  

localhost/api/v1/inspection

*  **Request Type:**

POST

*  **Content Type:**

`application/json` .

*  **Auth Required:**

  

YES

*  **Body:**

  

| | report_id | room | assigned_to | due_date |

|:--------:|:--------------------------------------------------------:|:---------------------:|:-----------------------:|:-----------------------------------------------:|

| Required | x | x | x | x |

| Optional | | | | |

| Notes | needs to be the report id this inspection is referencing | as an unsigned number | needs to be the user id | due date time stamp format: YYYY-MM-DD HH:MM:SS |

  
  

*  **Sample Request:**

  

```json

{

"id": 155,

"report_id": 155,

"room": 1,

"assigned_to" : 2,

"user_id" : "1",

"status" : "incomplete",

"due_date": "2020-02-04 23:26:46"

}

```

*  **Success Response:**

  
  

```json

{

"status": "200 (Ok)",

"message": "Created inspection assignment succesfully!",

"data": {

"room": 1,

"report_id": 155,

"assigned_to": 2,

"user_id": 23,

"due_date": "2020-02-04 23:26:46",

"status": "incomplete",

"updated_at": "2020-02-05 06:37:11",

"created_at": "2020-02-05 06:37:11",

"id": 3

}

}

```

  

*  **Error Response:**

  

```json

{

"status": "422 (Unprocessable Entity)",

"message": {

"report_id": [

"The report id field is required."

],

"room": [

"The room field is required."

],

"assigned_to": [

"The assigned to field is required."

],

"due_date": [

"The due date field is required."

]

},

"data": ""

}

```

  
  

## Delete Inspection

```bash

Deletes an existing inspection by the id.

```

  

*  **Route:**

  

localhost/api/v1/inspection/{id}

*  **Request Type:**

DELETE

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**

  

localhost/api/v1/inspection/59

*  **Success Response:**

  

```json

{

"status": "200 (Ok)",

"message": "Inspection assignment deleted succesfully.",

"data": {

"id": 3,

"room": 250,

"report_id": 1,

"user_id": 1,

"assigned_to": 1,

"due_date": "2020-12-12",

"status": "incomplete",

"created_at": "2019-12-27 08:12:44",

"updated_at": "2019-12-27 08:12:44"

}

}

```

  

*  **Error Response:**

  

```json

  

```

  

Issues
============

## Get Issue By Id

```bash

Gets an issue by the id

```

  

*  **Route:**

  

localhost/api/v1/issue/{id}

*  **Request Type:**

GET

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**

  

localhost/api/v1/issue/2

*  **Success Response:**

  

```json

{

"status": "200 (Ok)",

"message": "Issue retrieved succesfully.",

"data": {

"id": 1,

"room": 69,

"status": "incomplete",

"title": "oil spill",

"severity": "extreme",

"description": "someone clean this oil spill asap!",

"comments": "yikes, wow what a big oil spill!",

"user_id": 1,

"created_at": "2019-12-27 08:24:41",

"updated_at": "2019-12-27 08:24:41"

}

}

```

  

*  **Error Response:**

  

```json

```

  

## Get All Issues

```bash

Gets all issues

```

  

*  **Route:**

  

localhost/api/v1/issues

*  **Request Type:**

GET

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**

  

localhost/api/v1/issues

*  **Success Response:**

  

```json

{

"status": "200 (Ok)",

"message": "All Issues retrieved succesfully.",

"data": [

{

"id": 1,

"room": 69,

"status": "incomplete",

"title": "oil spill",

"severity": "extreme",

"description": "someone clean this oil spill asap!",

"comments": "yikes, wow what a big oil spill!",

"user_id": 1,

"created_at": "2019-12-27 08:24:41",

"updated_at": "2019-12-27 08:24:41"

},

{

"id": 2,

"room": 234,

"status": "incomplete",

"title": "chemical spill",

"severity": "extreme",

"description": "someone clean this chemical spill asap!",

"comments": "yikes, wow what a big chemical spill!",

"user_id": 1,

"created_at": "2019-12-27 08:28:44",

"updated_at": "2019-12-27 08:28:44"

}

]

}

```

  

*  **Error Response:**

  

```json

  

```

  

## Create Issue

```bash

Creates an issue if it does not exist, otherwise updates an exisiting one

```

  

*  **Route:**

  

localhost/api/v1/issue

*  **Request Type:**

POST

*  **Content Type:**

`application/json` .

*  **Auth Required:**

  

YES

* **Body:**

|          | title |          room         |       assigned_to       | severity | description | comments |
|:--------:|:-----:|:---------------------:|:-----------------------:|:--------:|:-----------:|:--------:|
| Required |   x   |           x           |            x            |     x    |      x      |     x    |
| Optional |       |                       |                         |          |             |          |
|   Notes  |       | as an unsigned number | needs to be the user id |          |             |          |

  
*  **Sample Request:**

```json

{

"id": 1,

"room": 213,

"title": "some cool title 32",

"severity": "critical",

"description": "dog food",

"comments": "more dog food",

"resolution_date": "2020-02-04 23:26:46",

"assigned_to": 1

}

```

*  **Success Response:**

  
  

```json

{

"status": "200 (Ok)",

"message": "Created issue succesfully!",

"data": {

"id": 1,

"room": 213,

"status": "incomplete",

"title": "some cool title 32",

"severity": "critical",

"description": "dog food",

"comments": "more dog food",

"user_id": 23,

"created_at": "2020-02-05 03:28:42",

"updated_at": "2020-02-05 03:29:01",

"resolution_date": "2020-02-04 23:26:46"

}

}

```

  

*  **Error Response:**

  

```json

{

"status": "422 (Unprocessable Entity)",

"message": {

"id": [

"The id field is required."

],

"title": [

"The title field is required."

],

"room": [

"The room field is required."

],

"assigned_to": [

"The assigned to field is required."

],

"severity": [

"The severity field is required."

],

"description": [

"The description field is required."

],

"comments": [

"The comments field is required."

]

},

"data": ""

}

```

  
  

## Delete Issue

```bash

Deletes an existing issue by the id.

```

  

*  **Route:**

  

localhost/api/v1/issue/{id}

*  **Request Type:**

DELETE

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**

  

localhost/api/v1/issue/59

*  **Success Response:**

  

```json

{

"status": "200 (Ok)",

"message": "Issue deleted succesfully.",

"data": {

"id": 1,

"room": 69,

"status": "incomplete",

"title": "oil spill",

"severity": "extreme",

"description": "someone clean this oil spill asap!",

"comments": "yikes, wow what a big oil spill!",

"user_id": 1,

"created_at": "2019-12-27 08:24:41",

"updated_at": "2019-12-27 08:24:41"

}

}

```

  

*  **Error Response:**

  

```json

{

"status": "400 (Bad Request)",

"message": "Could not find issue to be deleted by id",

"data": ""

}

```

  
  

Labs
============

## Get Lab By Id

```bash

Gets an lab by the id

```

  

*  **Route:**

  

localhost/api/v1/lab/{id}

*  **Request Type:**

GET

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**

  

localhost/api/v1/lab/2

*  **Success Response:**

  

```json

{

"status": "200 (Ok)",

"message": "Lab retrieved successfully.",

"data": {

"id": 1,

"created_at": "2020-02-05 10:09:14",

"updated_at": "2020-02-05 10:09:16",

"title": "bob"

}

}

```

  

*  **Error Response:**

  

```json

```

  
  

## Get All Labs

```bash

Gets all labs

```

  

*  **Route:**

  

localhost/api/v1/labs

*  **Request Type:**

GET

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**

  

localhost/api/v1/labs

*  **Success Response:**

  

```json

{

"status": "200 (Ok)",

"message": "All Labs retrieved successfully.",

"data": [

{

"id": 1,

"created_at": "2020-02-05 10:09:14",

"updated_at": "2020-02-05 10:09:16",

"title": "edc-232"

}

]

}

```

  

*  **Error Response:**

  

```json

  

```

  

## Create Lab

```bash

Creates a lab if it does not exist, otherwise updates an exisiting one

```

  

*  **Route:**

  

localhost/api/v1/lab

*  **Request Type:**

POST

*  **Content Type:**

`application/json` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**

  
  

*  **Success Response:**

  
  

*  **Error Response:**

  
  

## Delete Lab

```bash

Deletes an existing lab by the id.

```

  

*  **Route:**

  

localhost/api/v1/lab/{id}

*  **Request Type:**

DELETE

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**

  

localhost/api/v1/lab/59

*  **Success Response:**

  

```json

  

```

  

*  **Error Response:**

  

```json

```
Comments
============

## Get Comment By Id

```bash

Gets an comment by the id

```

  

*  **Route:**

  

localhost/api/v1/comment/{id}

*  **Request Type:**

GET

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**
 

localhost/api/v1/comment/1

*  **Success Response:**
```json
{
    "status": "200 (Ok)",
    "message": "Comments related to issue retrieved succesfully.",
    "data": [
        {
            "id": 1,
            "content": "adsasdada",
            "issue_id": 1,
            "user_id": 12,
            "created_at": "2020-03-22 03:58:06",
            "updated_at": "2020-03-22 03:58:06"
        }
    ]
}
  

```

  

*  **Error Response:**

  

```json

```

  
  

## Get All Comments

```bash

Gets all comments

```

  

*  **Route:**

  

localhost/api/v1/comments

*  **Request Type:**

GET

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**

  

localhost/api/v1/comments

*  **Success Response:**

  

```json

{
    "status": "200 (Ok)",
    "message": "Comments related to issue retrieved succesfully.",
    "data": [
        {
            "id": 1,
            "content": "adsasdada",
            "issue_id": 1,
            "user_id": 12,
            "created_at": "2020-03-22 03:58:06",
            "updated_at": "2020-03-22 03:58:06"
        },
        {
            "id": 2,
            "content": "adsasd",
            "issue_id": 1,
            "user_id": 12,
            "created_at": "2020-03-22 03:58:08",
            "updated_at": "2020-03-22 03:58:08"
        },
        {
            "id": 3,
            "content": "asdadasd",
            "issue_id": 1,
            "user_id": 12,
            "created_at": "2020-03-24 02:36:27",
            "updated_at": "2020-03-24 02:36:27"
        },
        {
            "id": 4,
            "content": "adad a -adadada -adad",
            "issue_id": 1,
            "user_id": 12,
            "created_at": "2020-03-24 02:36:33",
            "updated_at": "2020-03-24 02:36:33"
        },
        {
            "id": 5,
            "content": "<alert>Asda</alert>",
            "issue_id": 1,
            "user_id": 12,
            "created_at": "2020-03-24 02:42:27",
            "updated_at": "2020-03-24 02:42:27"
        },
        {
            "id": 6,
            "content": "<script>alert('ade');</script>",
            "issue_id": 1,
            "user_id": 12,
            "created_at": "2020-03-24 02:43:06",
            "updated_at": "2020-03-24 02:43:06"
        },
        {
            "id": 7,
            "content": "alert(&#39;ade&#39;);",
            "issue_id": 1,
            "user_id": 12,
            "created_at": "2020-03-24 02:46:02",
            "updated_at": "2020-03-24 02:46:02"
        },
        {
            "id": 8,
            "content": "&#34;asdad&#34;",
            "issue_id": 1,
            "user_id": 12,
            "created_at": "2020-03-24 02:46:24",
            "updated_at": "2020-03-24 02:46:24"
        },
        {
            "id": 9,
            "content": "alert(&#34;boom&#34;)",
            "issue_id": 1,
            "user_id": 12,
            "created_at": "2020-03-24 02:47:16",
            "updated_at": "2020-03-24 02:47:16"
        }
    ]
}

```

  

*  **Error Response:**

  

```json

  

```

  

## Create Comment

```bash

Creates a comment if it does not exist, otherwise updates an exisiting one

```

  

*  **Route:**

  

localhost/api/v1/comment

*  **Request Type:**

POST

*  **Content Type:**

`application/json` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**
```json

  {
    "content" :"hahahah2",
	"issue_id" : 3
  }
  
```
*  **Success Response:**
```json

  {
    "status": "200 (Ok)",
    "message": "Created Comment succesfully!",
    "data": {
        "user_id": 12,
        "content": "hahahah2",
        "issue_id": 3,
        "updated_at": "2020-03-29 21:33:23",
        "created_at": "2020-03-29 21:33:23",
        "id": 15
    }
}
  ```

*  **Error Response:**

  
  ``` json
  
```


## Delete Comment

```bash

Deletes an existing comment by the id.

```

  

*  **Route:**

  

localhost/api/v1/comment/{id}

*  **Request Type:**

DELETE

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

*  **Sample Request:**

  

localhost/api/v1/comment/59

*  **Success Response:**

  

```json
{
    "status": "200 (Ok)",
    "message": "Comment deleted succesfully",
    "data": {
        "user_id": 12,
        "content": "hahahah2",
        "issue_id": 3,
        "updated_at": "2020-03-29 21:33:23",
        "created_at": "2020-03-29 21:33:23",
        "id": 15
    }
}
  

```

  

*  **Error Response:**
```json
  {

"status":  "400 (Bad Request)",

"message":  "",

"data":  ""

}
```

Templates
============

## Get Template By Id

```bash

Gets an template by the id

```

  

*  **Route:**

  

localhost/api/v1/template/{id}

*  **Request Type:**

GET

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**
 

localhost/api/v1/template/1

*  **Success Response:**
```json
{
            "id": 1,
            "name": "Wet Labs Template",
            "schema": "[{\"section_nm\":\"Section 1\",\"questions\":[\"q1\",\"q2\"]}]",
            "user_id": 12,
            "created_at": "2020-03-22 03:57:21",
            "updated_at": "2020-03-22 03:57:28"
}
  

```

  

*  **Error Response:**

  

```json

```

  
  

## Get All Templates

```bash

Gets all templates

```

  

*  **Route:**

  

localhost/api/v1/templates

*  **Request Type:**

GET

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**

  

localhost/api/v1/templates

*  **Success Response:**

  

```json

{
    "status": "200 (Ok)",
    "message": "All Templates retrieved successfully.",
    "data": [
        {
            "id": 1,
            "name": "Wet Labs Template",
            "schema": "[{\"section_nm\":\"Section 1\",\"questions\":[\"q1\",\"q2\"]}]",
            "user_id": 12,
            "created_at": "2020-03-22 03:57:21",
            "updated_at": "2020-03-22 03:57:28"
        },
        {
            "id": 2,
            "name": "Wet Labs Template 2",
            "schema": "[{\"section_nm\":\"Section 1\",\"questions\":[\"q1\",\"q2\"]}]",
            "user_id": 12,
            "created_at": "2020-03-22 03:58:21",
            "updated_at": "2020-03-22 03:58:28"
        }
    ]
}

```

  

*  **Error Response:**

  

```json
 {
	"status":  "400 (Bad Request)",

	"message":  "",

	"data":  ""
}
```

  

## Create Template

```bash

Creates a template if it does not exist, otherwise updates an exisiting one

```

  

*  **Route:**

  

localhost/api/v1/template

*  **Request Type:**

POST

*  **Content Type:**

`application/json` .

*  **Auth Required:**

  

YES

*  **Body:**

  
  

*  **Sample Request:**
```json
{
"id": 1,
"name" :"Template New",
"schema": "{ 'sections': [ 'a','b' ] }"
	
}
  
```
*  **Success Response:**
```json
 {
    "status": "200 (Ok)",
    "message": "Created template successfully!",
    "data": {
        "id": 1,
        "name": "Template New",
        "schema": "{ 'sections': [ 'a','b' ] }",
        "user_id": 12,
        "created_at": "2020-03-22 03:57:21",
        "updated_at": "2020-03-29 22:11:21"
    }
}
```
OR
```json

{
    "status": "200 (Ok)",
    "message": "Updated template successfully!",
    "data": {
        "id": 1,
        "name": "Template New",
        "schema": "{ 'sections': [ 'a','b' ] }",
        "user_id": 12,
        "created_at": "2020-03-22 03:57:21",
        "updated_at": "2020-03-29 22:11:21"
    }
}
  

*  **Error Response:**
```json

  {
    "status": "422 (Unprocessable Entity)",
    "message": {        
    },
    "data": ""
}
  
  ```

## Delete Template

```bash

Deletes an existing template by the id.

```

  

*  **Route:**

  

localhost/api/v1/template/{id}

*  **Request Type:**

DELETE

*  **Content Type:**

`N/A` .

*  **Auth Required:**

  

YES

*  **Body:**

*  **Sample Request:**

  

localhost/api/v1/template/1

*  **Success Response:**

  

```json
{
    "status": "200 (Ok)",
    "message": "Template deleted successfully",
    "data": ""
}

```

  

*  **Error Response:**

  

```json

{
    "status": "400 (Bad Request)",
    "message": ""
    "data": ""
}
```