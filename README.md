<div align="center">
<img src="Documentation/Logo/labfiz_logo_hd.png"  width="25%" height="auto">
 
 ###### Laboratory Safety and Inspection Made Easy
 ###### http://labfiz.com
 </div>
 
# Table of Contents 
- [LabFiz](#labfiz)
- [Features](#features)
- [Documentation](#documentation)
  * [Presenations and Demo](#presenations-and-demo)
  * [Requirments and Analysis](#requriments-and-analysis)
  * [Solution Modeling](#solution-modeling)
- [Project Management](#project-management)
- [Built Using](#built-using)
- [Authors](#authors)
- [License](#license)


 ## LabFiz
Workplace and Lab safety is an important aspect of any institution. however, there are no feasible management solutions available. LabFiz is a web application, designed to simplify lab inspection and safety management in academic settings. LabFiz allows lab inspectors to automate assignment process and track inspections, to stay up to date on inspection requirements as required by their organization. LabFiz also provides features such as issue tracking, to enable collaboration and resolve issue in a timely manner.

Check out the demo site @ http://labfiz.com and presentation here.

## Installation

Prerequisites PHP v7+ , MySQL v5.7+ , Composer and Node.js. Consider using [Homstead](https://laravel.com/docs/7.x/homestead) or [Laragon](https://laragon.org) for installation on Windows OS.
```
- Clone the repository on your system
- Traverse to the project root folder
- Run composer install
  Ensure php artisan commands are available now.
- Run npm install
- Run npm run dev
- Update .env file for db connection , mail service and app preference
- Run php artisan migrate:fresh
- Run additional seeders if required example:
  php artisan db:seed --class=LabSeeder
- Run php artisan serve
```
 ## Features
 
 #### Create your own custom templates
  Create your own custom checklists and inspection templates as your orginization demands.

 #### Manage Inspections
  You can create assignments for your team member and track their progress through reports with ease.

 #### Track Issues
  Create and assign issue instance and track its progress easily.
  
 #### Easily create and assign access to your team mates
  Manage your team and grant them roles as they need.
  
 #### Email Notifications
  Easily add an email service to start receiving email notifications.


## Documentation

### Presentation and Demo
 - [Presentations](https://github.com/Capstone2019-ZAM/LabFiz/tree/master/Documentation/Presentations)
 - [Poster](https://github.com/Capstone2019-ZAM/Capstone/blob/master/Documentation/Poster.png)

### Requirments and Analysis
 - [Abstract](https://github.com/Capstone2019-ZAM/LabFiz/blob/master/Documentation/Abstract.pdf)
 - [After Action Review](https://github.com/Capstone2019-ZAM/LabFiz/blob/master/Documentation/after_reveiw.pdf)
 - [Back End Review](https://github.com/Capstone2019-ZAM/LabFiz/blob/master/Documentation/backend_review.md)
 - [Business Requirement & Analysis](https://github.com/Capstone2019-ZAM/LabFiz/blob/master/Documentation/BusinessRequirementandProposal.pdf)
 - [Code Review](https://github.com/Capstone2019-ZAM/LabFiz/blob/master/Documentation/Code%20Review.pdf)
 - [FRD document](https://github.com/Capstone2019-ZAM/LabFiz/blob/master/Documentation/Functional%20Requirements%20Document.pdf)
 - [User Stories](https://github.com/Capstone2019-ZAM/Capstone/blob/master/Documentation/User%20Stories.xlsx)
 ### Solution Modeling
 - [API Documentation](https://github.com/Capstone2019-ZAM/Capstone/blob/master/Documentation/API2.md)
 - [Data Flow](https://github.com/Capstone2019-ZAM/LabFiz/blob/master/Documentation/DataFlow%20(1).jpg)
 - [ERD document](https://github.com/Capstone2019-ZAM/LabFiz/blob/master/Documentation/ERD%20Updated.png)
 - [System Architecture](https://github.com/Capstone2019-ZAM/LabFiz/blob/master/Documentation/System%20Architectural%20V2.1.png)
 - [User Interaction](https://github.com/Capstone2019-ZAM/LabFiz/blob/master/Documentation/User%20Interaction.jpg)
 - [Wireframes](https://github.com/Capstone2019-ZAM/Capstone/blob/master/Documentation/Wireframe%20-%20Coordinator%20(2).svg)
 ## Project Management
   LabFiz project was managed with Asana. Check out our project management @ [Asana](https://app.asana.com/0/1139874116808383) / [Asana Screenshots](https://github.com/Capstone2019-ZAM/Capstone/tree/master/Documentation/Asana%20Screenshots)
   
 ## Built Using
  - Laravel PHP
  - Vue.js & Veutify.js
 
## Authors 
- 	Muhammad Ahmed  ([@ahmed35m](https://github.com/ahmed35m))
-  Zain Abedin
-  Alwin Baby

## License 
 This project is to be licensed under the MIT License
 

