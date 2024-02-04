#Setup
=======
This repository contains the Docker configuration files and resources for running the Employee list in a Docker container.
Before you begin, please ensure you have Docker installed on your machine.
git clone this repository
#In terminal 
    -sudo docker build -t listdata.
    -sudo docker run -p 80:80 listdata
Open your web browser and go to http://localhost:8080/index.php to access the application
To Access the database go to http://localhost:8081/index.php
All credentials are in the docker-compose.yml file.





