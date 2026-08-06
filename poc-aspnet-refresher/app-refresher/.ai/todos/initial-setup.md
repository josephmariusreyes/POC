## Goal
- I need to create a simple job CRM website using asp.net
- Make the website professional looking use clean design
- Use bootstrap css for styling
- Use jquery library for javascript code
- Use best practices for creating website in MVC pattern
- Create clean foldering structure
- Use a service for any read, create, update, that will be done in the test json data under test-data folder

## Instruction
- Create 4 pages, 
-- Home page
-- Profile page

- Home page will have 3 main section
( section 1 will be the area for the hero banner, just add some heading and description here that says the website is for providing remote work )

( section 2 will display some testimonial from users who found remote jobs, just keep it professional looking )

( section 3 there will be a contact us form there make the form working and implement validation add these fields name, message, on submit of the contact us form, update contact-us-submission.json under the test-data folder, add there the submitted data from the form )

- Login page
( implement here a clean looking login page, username and password are the fields for the login form, on submit compare against user.json )

- Profile page
( this page will only be accessible if logged in )
( Display all the information of the logged in user, you may retrieve this from user.json, put it in a form that can be updated, on submit of the form update the record in user.json file, keep the page looking clean and professional )

## completed
- Switched the application to support MVC pattern with controllers and views while keeping the existing project functional.
- Added clean folder structure for MVC and app logic:
	- Controllers: HomeController, AuthController, ProfileController
	- Models: User, EmploymentHistoryItem, ContactSubmission
	- Services: IUserService, IContactSubmissionService, JsonUserService, JsonContactSubmissionService
	- ViewModels: HomeViewModel, LoginViewModel, ProfileViewModel
	- Views: Home (Index, About), Auth (Login), Profile (Index), Shared layout and validation partial
- Implemented 4 pages:
	- Home page with 3 required sections:
		- Hero banner with heading and description for remote work
		- Professional testimonial cards
		- Contact Us form with validation (name, message)
	- Login page with username/password validation and clean UI
	- Profile page that is only accessible when logged in
	- About page for additional professional site content
- Implemented session-based login flow:
	- Validates credentials from test-data/users.json
	- Stores logged-in user in session
	- Supports logout
- Implemented protected profile management:
	- Redirects non-authenticated users to login
	- Loads logged-in user details from test-data/users.json
	- Updates user record in test-data/users.json on submit
- Implemented contact form persistence:
	- On submit, appends entry to test-data/contact-us-submission.json
	- Includes submitted UTC timestamp
- Applied professional design updates using Bootstrap and custom CSS:
	- Structured, clean layout
	- Responsive sections and cards
	- Improved form styling
- Added jQuery-based page reveal animations for polished user experience.
- Updated Program.cs configuration:
	- Added controllers with views
	- Added session middleware
	- Registered JSON-backed services in DI
	- Added default controller route

- Validation: dotnet build completed successfully.

