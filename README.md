# companySalaries
To monitor company salaries

# Consuming the API
1. Run php artisan serve in the command line 
2. You can resgister through http://localhost:8000/api/register using PUT method
	- Add Header with key Accept and Value application\json
	- Add another Header with key Content-Type and Value application\json
	- Add to the body form data the following:
	  - Key name and Value anyname
	  - key email and value anyemail
	  - key password and value anypassword
	  - key password_confirmation and value same as the password
	  -	You will receive the response with the API token that will be used to call another API
3. You can login through http://localhost:8000/api/login using PUT method
	- Add Header with key Accept and Value application\json
	- Add another Header with key Content-Type and Value application\json
	- Add to the body form data the following:
	  - key email and value anyemail
	  - key password and value anypassword
	  -	You will receive the response with the API token that will be used to call another API  
4. After that you can call the salaries API through http://localhost:8000/api/salaries/{month} using GET method
	- Add Header with key Accept and Value application\json
	- Add another Header with key Content-Type and Value application\json
	- Add AUTH of type bearer and the API token you get from the previous API:
	- Month filter should be the number of the month ( ex;01 for Jan, 12 for Dec) http://localhost:8000/api/salaries/01
	- If you want to list all the remaining months salaries you should add zero http://localhost:8000/api/salaries/0
	- If you didn't pass an AUTH token to the API you will get not authenticated.
	
	 	  
