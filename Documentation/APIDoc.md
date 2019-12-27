# API Documentation 
The end points described below are meant to perform CRUD operations on a relational database backend and serve authenticated JSON to the front-end for the laravel app.

*Current Latest API version is 1.0.

*All routes are protected using token based authentication.

*Documentation style follows @iros REST api documentation.

# Table of Contents

<!--ts-->
 * [**Users**](#users)
     * [Login](#login)
 * [**Reports**](#reports)
     * [Get](#GetReportById)
     * [Get all](#GetAllReports)
     * [Create](#CreateReport)
     * [Delete](#DeleteReport)
<!--te-->

# Endpoints Table
| # | Category |           Route URL          | Latest Version | Request Type |              Desc              |                More Info               |
|:-:|:--------:|:----------------------------:|:--------------:|:------------:|:------------------------------:|:--------------------------------------:|
| 1 |  User  | localhost/api/login            |        -       |      POST     | Gets a report by the report id | [Login](#Login) |
| 2 |  Report  | localhost/api/v1/report/{id} |        1       |      GET     | Gets a report by the report id | [Get](#GetReportById) |
| 3 |  Report  |   localhost/api/v1/reports   |        1       |      GET     |        Gets all reports        | [Get all](#GetAllReports) |
| 4 |  Report  |    localhost/api/v1/report   |        1       |     POST     |     Creates a unique report    | [Create](#CreateReport) |
| 5 |  Report  |    localhost/api/v1/report/{id}   |        1       |    DELETE    |     Deletes a report by id     | [Delete](#DeleteReport) |

Users
============
Login
-----
```bash
  Logs in the user using token based authentication.
```

* **Route:** 

localhost/api/login


* **Request Type:** 
  
  POST
  
  
* **Content Type:** 
 
    `application/json` .
  
  
* **Auth Required:**

  **Yes**
  
  
* **Body:**

|          	|                 Email                	|                      Password                     	|
|:--------:	|:------------------------------------:	|:-------------------------------------------------:	|
| Required 	|                   x                  	|                         x                         	|
| Optional 	|                                      	|                                                   	|
|   Notes  	| 	| 	|
  
* **Sample Request:**

```json  
{
	"email": "bob@gmail.com",
	"password": "dogfood"
}
```
  
* **Success Response:**

```json
{
    "status": "200 (Ok)",
    "message": "User logged in successfully.",
    "data": {
        "email": "bob@gmail.com",
        "role": "admin",
        "token": "UcZ8JrhrCZzcy1Hdz53iVIqpYMVgYivSMCBTKM2t7CNuWSEv9KkXB5KutFCc"
    }
}
```

* **Error Response:**

```json
{
    "status": "400 (Bad Request)",
    "message": "Invalid password.",
    "data": ""
}
```

Reports
============
GetReportById
-----
```bash
  Gets a report by the report id
```

* **Route:** 

  localhost/api/v1/report/{id}
 
* **Request Type:** 
  
  GET
  
  
* **Content Type:** 
  
  `N/A` .
  
* **Auth Required:**

  YES
  
* **Body:**


* **Sample Request:**

    localhost/api/v1/report/1
  
  
* **Success Response:**

```json
{
    "status": "200 (Ok)",
    "message": "Report retrieved succesfully.",
    "data": {
        "id": 1,
        "title": "Some cool title",
        "user_id": 1,
        "created_at": "2019-12-27 02:03:36",
        "updated_at": "2019-12-27 02:03:36"
    }
}
```

* **Error Response:**

```json
{
    "status": "400 (Bad Request)",
    "message": "Ill formed input",
    "data": ""
}
```


OR


```json
{
    "status": "401 (Unauthorized)",
    "message": "You are not authorized to access this route.",
    "data": ""
}
```


GetAllReports
-----
```bash
  Gets all reports	
```

* **Route:** 

  localhost/api/v1/reports
 
* **Request Type:** 
  
  GET
  
  
* **Content Type:** 
  
  `N/A` .
  
* **Auth Required:**

  YES
  
* **Body:**


* **Sample Request:**

    localhost/api/v1/reports
  
  
* **Success Response:**

```json
{
    "status": "200 (Ok)",
    "message": "All Reports retrieved succesfully.",
    "data": [
        {
            "id": 1,
            "title": "Oil Spills",
            "user_id": 1,
            "created_at": "2019-12-27 02:03:36",
            "updated_at": "2019-12-27 02:03:36"
        },
        {
            "id": 2,
            "title": "Oil Spills",
            "user_id": 1,
            "created_at": "2019-12-27 02:03:36",
            "updated_at": "2019-12-27 02:03:36"
        },
        {
            "id": 3,
            "title": "Oil Spills",
            "user_id": 1,
            "created_at": "2019-12-27 02:03:36",
            "updated_at": "2019-12-27 02:03:36"
        },
        {
            "id": 4,
            "title": "Oil Spills",
            "user_id": 1,
            "created_at": "2019-12-27 02:03:36",
            "updated_at": "2019-12-27 02:03:36"
        },
        {
            "id": 5,
            "title": "Oil Spills",
            "user_id": 1,
            "created_at": "2019-12-27 02:03:36",
            "updated_at": "2019-12-27 02:03:36"
        },
        {
            "id": 6,
            "title": "Oil Spills",
            "user_id": 1,
            "created_at": "2019-12-27 02:03:36",
            "updated_at": "2019-12-27 02:03:36"
        },
        {
            "id": 7,
            "title": "Oil Spills",
            "user_id": 1,
            "created_at": "2019-12-27 02:03:36",
            "updated_at": "2019-12-27 02:03:36"
        },
        {
            "id": 8,
            "title": "Oil Spills",
            "user_id": 1,
            "created_at": "2019-12-27 02:03:36",
            "updated_at": "2019-12-27 02:03:36"
        },
        {
            "id": 9,
            "title": "Oil Spills",
            "user_id": 1,
            "created_at": "2019-12-27 02:03:36",
            "updated_at": "2019-12-27 02:03:36"
        },
        {
            "id": 10,
            "title": "Chemical Spills",
            "user_id": 1,
            "created_at": "2019-12-27 02:03:36",
            "updated_at": "2019-12-27 02:03:36"
        }
    ]
}
```

OR


```json
{
    "status": "200 (Ok)",
    "message": "All Reports retrieved succesfully.",
    "data": ""
}
```


* **Error Response:**

```json
{
    "status": "401 (Unauthorized)",
    "message": "You are not authorized to access this route.",
    "data": ""
}
```

CreateReport
-----
```bash
  Creates a unique report.
```

* **Route:** 

  localhost/api/v1/report
 
* **Request Type:** 
  
  POST
  
  
* **Content Type:** 
  
      `application/json` .
      
* **Auth Required:**

  YES
  
* **Body:**

|          | Title |                      Sections                     |                               Section Title                               |       Section Questions       |
|:--------:|:-----:|:-------------------------------------------------:|:-------------------------------------------------------------------------:|:-----------------------------:|
| Required |   x   |                                                   |                                                                           |                               |
| Optional |       |                         x                         |                                     x                                     |               x               |
|   Notes  |       | key with value of array containing section titles | section titles(sect_title_1,sect_title_2), etc. within the "sections" key | questions within the "qs" key |

* **Sample Request:**

```json
{
	"title" : "some cool title 2019",
	"sections" : {
		"sect_title_1" : {
		 "qs": ["quest_title_1","quest_title_2"]
		},
		"sect_title_2" : {
			"qs": ["quest_title_1"]
		},
		"sect_title_3" : {
			"qs": ["quest_title_1","quest_title_2","quest_title_3"]
		}
	}
}
```  

OR

```json
{
	"title" : "some cool title 2029"
}
```  
  
* **Success Response:**

```json
{
    "status": "200 (Ok)",
    "message": "Created report document succesfully!",
    "data": {
        "some cool title 2019": {
            "title": "some cool title 2019",
            "user_id": 1,
            "updated_at": "2019-12-27 04:24:33",
            "created_at": "2019-12-27 04:24:33",
            "id": 16
        },
        "$sect": {
            "title": "sect_title_3",
            "report_id": 16,
            "updated_at": "2019-12-27 04:24:33",
            "created_at": "2019-12-27 04:24:33",
            "id": 16
        },
        "quest_title_1": {
            "question": "quest_title_1",
            "report_section_id": 16,
            "updated_at": "2019-12-27 04:24:33",
            "created_at": "2019-12-27 04:24:33",
            "id": 20
        },
        "quest_title_2": {
            "question": "quest_title_2",
            "report_section_id": 16,
            "updated_at": "2019-12-27 04:24:33",
            "created_at": "2019-12-27 04:24:33",
            "id": 21
        },
        "quest_title_3": {
            "question": "quest_title_3",
            "report_section_id": 16,
            "updated_at": "2019-12-27 04:24:33",
            "created_at": "2019-12-27 04:24:33",
            "id": 22
        }
    }
}
```

OR

```
{
    "status": "200 (Ok)",
    "message": "Created report document succesfully!",
    "data": {
        "some cool title 2029": {
            "title": "some cool title 2029",
            "user_id": 1,
            "updated_at": "2019-12-27 04:27:45",
            "created_at": "2019-12-27 04:27:45",
            "id": 18
        }
    }
}
```

* **Error Response:**

```json
{
    "status": "401 (Unauthorized)",
    "message": "You are not authorized to access this route.",
    "data": ""
}
```


DeleteReport
-----
```bash
  Deletes an existing report by the id.
```

* **Route:** 

    localhost/api/v1/report/{id}
 
* **Request Type:** 
  
  DELETE
  
  
* **Content Type:** 
  
  `N/A` .
  
* **Auth Required:**

  YES
  
* **Body:**


* **Sample Request:**

    localhost/api/v1/report/59
  
  
* **Success Response:**

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
    }
}
```

* **Error Response:**

```json
{
    "status": "400 (Bad Request)",
    "message": "Could not find report to be deleted by id",
    "data": ""
}
```


OR


```json
{
    "status": "401 (Unauthorized)",
    "message": "You are not authorized to access this route.",
    "data": ""
}
```


