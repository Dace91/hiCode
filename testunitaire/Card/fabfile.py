from fabric.api import *
from fabtools import require
import fabtools

env.use_ssh_config = True

env.hosts=['antoine@192.168.1.13']

def hello(name):
    run('echo hello %s' % name)

def deploy():
    with settings(mysql_user='root', mysql_password='antoine'):
        require.mysql.database('myapp', owner='dbuser')
