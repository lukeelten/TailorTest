# Tailor Test
This test application uses code from [Zalando/Tailor](https://github.com/zalando/tailor)


## Start Project
To start the project use docker-compose. All neede services will be created and started automatically, there is no need for a service running on localhost. <br />
Nevertheless, you need to free the ports 80,8080,8081,8100,8101,5432 in order to successfully run docker.
``` bash
docker-compose up -d
```

You can see the result on [localhost](http://localhost)

### Tailor
Tailor composes the delivered page out of multiple fragment.

### Frontend
The frontend generates the HTML Code based on the result from the Backend API calls. <br/>
As HTTP Client it uses [HTTPFUL](http://phphttpclient.com/)

### Backend
The Backend API uses [Phalcon](https://github.com/phalcon/cphalcon) as Framework. 
The Backend connects to a PostgreSQL server and create JSON response based on some programmed test data.