# HospitalLogin

This code is a web interface using a simple MVC model.
Both doctors and patients can create an account, or login if they already have one.
Passwords are hashed for more safety. 
They can move to the other login page if needed.
Specialty for doctors is optional.
The site cancels the registration if the email is already used, if the password is too short or if the doctor declared as treating physician by a new patient does not exist.
The user can log out.

Here is the structure of the database that should be used with this code : 
DATABASE : Hospital
TABLES : 
- Doctor(idDoctor INT AUTO_INC, Name TEXT NOT NULL, Password TEXT NOT NULL, email TEXT NOT NULL, specialty TEXT);

- Patient(idPatient INT AUTO_INC, Name TEXT NOT NULL, Password TEXT NOT NULL, email TEXT NOT NULL, idDoctor INT NOT NULL)
