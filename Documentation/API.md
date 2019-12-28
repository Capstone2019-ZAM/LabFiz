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
 * [**Inspections**](#inspections)
     * [Get](#GetInspectionById)
     * [Get all](#GetAllInspections)
     * [Create](#CreateInspection)
     * [Delete](#DeleteInspection)
 * [**Issues**](#issues)
     * [Get](#GetIssueById)
     * [Get all](#GetAllIssues)
     * [Create](#CreateIssue)
     * [Delete](#DeleteIssue)
<!--te-->

# Endpoints Table
| # | Category |           Route URL          | Latest Version | Request Type |              Desc              |                More Info               |
|:-:|:--------:|:----------------------------:|:--------------:|:------------:|:------------------------------:|:--------------------------------------:|
| 1 |  User  | localhost/api/login            |        -       |      POST     | Gets a report by the report id | [Login](#Login) |
| 2 |  Report  | localhost/api/v1/report/{id} |        1       |      GET     | Gets a report by the report id | [Get](#GetReportById) |
| 3 |  Report  |   localhost/api/v1/reports   |        1       |      GET     |        Gets all reports        | [Get all](#GetAllReports) |
| 4 |  Report  |    localhost/api/v1/report   |        1       |     POST     |     Creates a unique report    | [Create](#CreateReport) |
| 5 |  Report  |    localhost/api/v1/report/{id}   |        1       |    DELETE    |     Deletes a report by id     | [Delete](#DeleteReport) |
| 6 |  Inspection  | localhost/api/v1/report/{id} |        1       |      GET     | Gets an inspection assignment by the id | [Get](#GetInspectionById) |
| 7 |  Inspection  |   localhost/api/v1/inspection   |        1       |      GET     |        Gets all inspection assignments        | [Get all](#GetAllInspections) |
| 8 |  Inspection  |    localhost/api/v1/inspection   |        1       |     POST     |     Creates a unique inspection assignment    | [Create](#CreateInspection) |
| 9 |  Inspection  |    localhost/api/v1/inspection/{id}   |        1       |    DELETE    |     Deletes an inspection assignment     | [Delete](#DeleteInspection) |
| 10 |  Issue  | localhost/api/v1/issue/{id} |        1       |      GET     | Gets an issue by id | [Get](#GetIssueById) |
| 11 |  Issue  |   localhost/api/v1/issue   |        1       |      GET     |        Gets all issues        | [Get all](#GetAllIssues) |
| 12 |  Issue  |    localhost/api/v1/issue   |        1       |     POST     |     Creates a unique issue    | [Create](#CreateIssue) |
| 13 |  Issue  |    localhost/api/v1/issue/{id}   |        1       |    DELETE    |     Deletes an issue by id     | [Delete](#DeleteIssue) |

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
        "title": "some cool report title",
        "user_id": 1,
        "updated_at": "2019-12-28 04:15:02",
        "created_at": "2019-12-28 04:15:02",
        "id": 27,
        "$sect": {
            "title": "sect_title_3",
            "report_id": 27,
            "updated_at": "2019-12-28 04:15:02",
            "created_at": "2019-12-28 04:15:02",
            "id": 43
        },
        "quest_title_1": {
            "question": "quest_title_1",
            "report_section_id": 41,
            "updated_at": "2019-12-28 04:15:02",
            "created_at": "2019-12-28 04:15:02",
            "id": 71
        },
        "quest_title_2": {
            "question": "quest_title_2",
            "report_section_id": 41,
            "updated_at": "2019-12-28 04:15:02",
            "created_at": "2019-12-28 04:15:02",
            "id": 72
        },
        "quest_title_3": {
            "question": "quest_title_3",
            "report_section_id": 42,
            "updated_at": "2019-12-28 04:15:02",
            "created_at": "2019-12-28 04:15:02",
            "id": 73
        },
        "quest_title_4": {
            "question": "quest_title_4",
            "report_section_id": 43,
            "updated_at": "2019-12-28 04:15:02",
            "created_at": "2019-12-28 04:15:02",
            "id": 74
        },
        "quest_title_5": {
            "question": "quest_title_5",
            "report_section_id": 43,
            "updated_at": "2019-12-28 04:15:02",
            "created_at": "2019-12-28 04:15:02",
            "id": 75
        },
        "quest_title_6": {
            "question": "quest_title_6",
            "report_section_id": 43,
            "updated_at": "2019-12-28 04:15:02",
            "created_at": "2019-12-28 04:15:02",
            "id": 76
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
    "status": "422 (Unprocessable Entity)",
    "message": {
        "title": [
            "The title field is required."
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

OR

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

Inspections
============
GetInspectionById
-----
```bash
  Gets an inspection assignment by the id
```

* **Route:** 

  localhost/api/v1/inspection/{id}
 
* **Request Type:** 
  
  GET
  
  
* **Content Type:** 
  
  `N/A` .
  
* **Auth Required:**

  YES
  
* **Body:**


* **Sample Request:**

    localhost/api/v1/inspection/2
  
  
* **Success Response:**

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


GetAllInspections
-----
```bash
  Gets all inspection assignments	
```

* **Route:** 

  localhost/api/v1/inspections
 
* **Request Type:** 
  
  GET
  
  
* **Content Type:** 
  
  `N/A` .
  
* **Auth Required:**

  YES
  
* **Body:**


* **Sample Request:**

    localhost/api/v1/inspections
  
  
* **Success Response:**

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

OR


```json
{
    "status": "200 (Ok)",
    "message": "All Inspection assignments retrieved succesfully.",
    "data": []
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

CreateInspection
-----
```bash
  Creates a unique inspection.
```

* **Route:** 

  localhost/api/v1/inspection
 
* **Request Type:** 
  
  POST
  
  
* **Content Type:** 
  
      `application/json` .
      
* **Auth Required:**

  YES
  
* **Body:**

|          |                         report_id                        |          room         |       assigned_to       |                     due_date                    |
|:--------:|:--------------------------------------------------------:|:---------------------:|:-----------------------:|:-----------------------------------------------:|
| Required |                             x                            |           x           |            x            |                        x                        |
| Optional |                                                          |                       |                         |                                                 |
|   Notes  | needs to be the report id this inspection is referencing | as an unsigned number | needs to be the user id | due date time stamp format: YYYY-MM-DD HH:MM:SS |


* **Sample Request:**

```json
{
	"report_id": 1,
	"room" : 69,
	"assigned_to": 1,
	"due_date": "2020-12-12 10:10:5"
}
```  
  
* **Success Response:**


```json
{
    "status": "200 (Ok)",
    "message": "Created inspection assignment succesfully!",
    "data": {
        "room": 69,
        "report_id": 1,
        "assigned_to": 1,
        "user_id": 1,
        "due_date": "2020-12-12 10:10:5",
        "status": "incomplete",
        "updated_at": "2019-12-27 08:02:34",
        "created_at": "2019-12-27 08:02:34",
        "id": 2
    }
}
```  

* **Error Response:**

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

OR

```json
{
    "status": "422 (Unprocessable Entity)",
    "message": {
        "room": [
            "The room must be a number."
        ],
        "assigned_to": [
            "The assigned to must be a number."
        ]
    },
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


DeleteInspection
-----
```bash
  Deletes an existing inspection by the id.
```

* **Route:** 

    localhost/api/v1/inspection/{id}
 
* **Request Type:** 
  
  DELETE
  
  
* **Content Type:** 
  
  `N/A` .
  
* **Auth Required:**

  YES
  
* **Body:**


* **Sample Request:**

    localhost/api/v1/inspection/59
  
  
* **Success Response:**

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

Issues
============
GetIssueById
-----
```bash
  Gets an issue by the id
```

* **Route:** 

  localhost/api/v1/issue/{id}
 
* **Request Type:** 
  
  GET
  
  
* **Content Type:** 
  
  `N/A` .
  
* **Auth Required:**

  YES
  
* **Body:**


* **Sample Request:**

    localhost/api/v1/issue/2
  
  
* **Success Response:**

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


GetAllIssues
-----
```bash
  Gets all issues	
```

* **Route:** 

  localhost/api/v1/issues
 
* **Request Type:** 
  
  GET
  
  
* **Content Type:** 
  
  `N/A` .
  
* **Auth Required:**

  YES
  
* **Body:**


* **Sample Request:**

    localhost/api/v1/issues
  
  
* **Success Response:**

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

OR


```json
{
    "status": "200 (Ok)",
    "message": "All Issues retrieved succesfully.",
    "data": []
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

CreateIssue
-----
```bash
  Creates a unique issue.
```

* **Route:** 

  localhost/api/v1/issue
 
* **Request Type:** 
  
  POST
  
  
* **Content Type:** 
  
      `application/json` .
      
* **Auth Required:**

  YES
  
* **Body:**

|          | title |          room         |       assigned_to       | severity | description | comments |
|:--------:|:-----:|:---------------------:|:-----------------------:|:--------:|:-----------:|:--------:|
| Required |   x   |           x           |            x            |     x    |      x      |     x    |
| Optional |       |                       |                         |          |             |          |
|   Notes  |       | as an unsigned number | needs to be the user id |          |             |          |


* **Sample Request:**

```json
{
	"title": "oil spill",
	"room" : 69,
	"assigned_to": 1,
	"severity": "extreme",
	"description": "someone clean this oil spill asap!",
	"comments": "yikes, wow what a big oil spill!"
}
```  
  
* **Success Response:**


```json
{
    "status": "200 (Ok)",
    "message": "Created issue succesfully!",
    "data": {
        "title": "oil spill",
        "room": 69,
        "user_id": 1,
        "severity": "extreme",
        "status": "incomplete",
        "description": "someone clean this oil spill asap!",
        "comments": "yikes, wow what a big oil spill!",
        "updated_at": "2019-12-27 08:24:41",
        "created_at": "2019-12-27 08:24:41",
        "id": 1
    }
}
```  

* **Error Response:**

```json
{
    "status": "422 (Unprocessable Entity)",
    "message": {
        "title": [
            "The title field is required."
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
        "assigned_to": [
            "The assigned to must be a number."
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

OR

```json
{
    "status": "422 (Unprocessable Entity)",
    "message": {
        "title": [
            "The title field is required."
        ]
    },
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


DeleteIssue
-----
```bash
  Deletes an existing issue by the id.
```

* **Route:** 

    localhost/api/v1/issue/{id}
 
* **Request Type:** 
  
  DELETE
  
  
* **Content Type:** 
  
  `N/A` .
  
* **Auth Required:**

  YES
  
* **Body:**


* **Sample Request:**

    localhost/api/v1/issue/59
  
  
* **Success Response:**

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

* **Error Response:**

```json
{
    "status": "400 (Bad Request)",
    "message": "Could not find issue to be deleted by id",
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
