#How to set up the container
    1) run the following commands from your directory (powershell on windows, terminal on linux)
        docker build -t project .
        docker run -p "8080:80" -v ${PWD}/codeigniter:/app -v ${PWD}/mysql:/var/lib/mysql project
    3) go to localhost:8080/phpmyadmin and log in with username: "admin" and the generated password (you'll have to search the logs for it)
    4) create a new database called 'Data'
    5) import Data.sql into the newly created database

#Note's
I would like to clearify that this was a school project. 
The database is empty so you will have to populate it yourself. This can be done manually or you can do this by going to localhost:8080 and creating an account, products,... manually.

The used framework is codeigniter 4

The dockerfile was provided to me by my professor