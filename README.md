# Tailor Test
This test application uses code from [Zalando/Tailor](https://github.com/zalando/tailor).
<br />
<br />
Skeleton used from [phalcon-compose](https://github.com/phalcon/phalcon-compose)

## Start Project
To start the project use docker-compose. All neede services will be created and started automatically, there is no need for a service running on localhost. <br />
Nevertheless, you need to free the ports 80,8080,8100,8101,5432 in order to successfully run docker.
``` bash
# Do the following on your own:
# Install composer dependencies for backend
# Install composer dependencies for frontend
# Install npm dependencies for tailor

# Start infrastructure
docker-compose up -d
```

You can see the result on [localhost](http://localhost) <br /><br />
Frontend is available via [localhost:8100](http://localhost:8100) <br />
Backend is available via [localhost:8101](http://localhost:8101) <br />
PhpPgAdmin is available via [localhost:8080](http://localhost:8080)  (Username and Password can be seen in variables.env)

## Infrastructure

### Tailor
Tailor composes the delivered page out of multiple fragment. The template can be found in "tailor/templates".

### Frontend
The frontend generates the HTML Code based on the result from the Backend API calls. <br/>
As HTTP Client [HTTPful](http://phphttpclient.com/) is used.

### Backend
The Backend API uses [Phalcon](https://github.com/phalcon/cphalcon) as Framework. 
The Backend connects to a PostgreSQL server and create JSON response based on some programmed test data.

### PostgreSQL
A PostgreSQL database will be run by docker and is available to the application inside the containers as well as the host on port 5432.
