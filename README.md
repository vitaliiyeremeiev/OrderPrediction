#Start docker
make up

#install composer
make install

#The site will be available on
http://localhost/

#Stop docker
make down

#Start tests
make test