from numpy import array
import requests

class classroom(requests):
    def __init__ (self,username,password,api):
        self.username = username
        self.password = password
        self.api = 'http://localhost/'

    def log(data):
        #data is a string
        #make log file from dictionary (all of user camand)
        logfile = open('log',"a")
        logfile.write(data.incode())
        logfile.close()

    def getlog(self): #get all log files
        login_to_sit = requests.get(self.api , params = {'username':self.username,'password' : self.password })
        if login_to_sit == 200 :
            openlogfile = open('log')
            data = openlogfile.read()
            return data.decode('utf8')
        else :
            return 'server error : server is not responding'

    def login(self):
        login_to_site = requests.get(self.api , params = {'username':self.username,'password' : self.password })
        if login_to_site.status_code == 200 : #return 200
            print ("Welcome to secret class - devlop by pgu students")
            f = open("username.txt","w")
            f.write(self.username)
            f.close()
            f1 = open("password.txt","w")
            f1.write(self.password)
            f1.close()
        else: 
            return 'server error : server is not responding'
    def register(self) : 
        login_to_site = requests.get(self.api , params = {'type':'register','username':self.username,'password' : self.password })
        if login_to_site.status_code == 200 : 
            print ("ok, registration")


    
            