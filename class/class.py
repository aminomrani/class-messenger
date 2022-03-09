import requests

class classroom(requests):
    def __init__ (self,username,password,api):
        self.username = username
        self.password = password
        self.api = api

    def log(data):
        #data is a string
        #make log file from dictionary (all of user camand)
        logfile = open('log',"a")
        logfile.write(data.incode())
        logfile.close()

    def getlog(self):
        login_to_sit = requests.get(self.api , auth = (self.username,self.password))
        if login_to_sit == 200 :
            openlogfile = open('log')
            data = openlogfile.read()
            return data.decode('utf8')

    def login(self):
        login_to_site = requests.get(self.api , auth =(self.username,self.password))
        if login_to_site.status_code == 200 : #return 200
            print ("Welcome to secret class - devlop by pgu students")
            f = open("username.txt","w")
            f.write(self.username)
            f.close()
            f1 = open("password.txt","w")
            f1.write(self.password)
            f1.close()
            