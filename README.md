# VendShit 1.0
Vending Machine Framework

## Getting Started

Download and read the documentation [here](http://www.mobilarian.com/showthread.php?t=1438493&p=23023323&viewfull=1#post23023323).
For the block diagram, process diagram and hardware requirements, see chapter II in the documentation. For circuit design and architecture, installation and technical details, see chapter III in the documentation.

## Features
- Touch Screen LCD
- Web Based System
	- Vend OS - Vending Machine Framework
	- Vend Admin - Admin Panel
 	- Vend UI - User Interface
- SMS Notification (alert for low stocks)
- Play Video Advertisment (when system is idle)
- Print Receipt
- 1 Peso, 5 Peso, 10 Peso Coin Slot
- Internet Connected (IOT)

## Requirements
LAMP is an archetypal model of web service solution stacks, named as an acronym of the names of its original four open-source components: the Linux operating system, the Apache HTTP Server, the MySQL relational database management system (RDBMS), and the PHP programming language. The LAMP components are largely interchangeable and not limited to the original selection. As a solution stack, LAMP is suitable for building dynamic web sites and web applications

PySerial encapsulates the access for the serial port. It provides backends for Python running on Windows, Linux, BSD (possibly any POSIX compliant system), Jython and IronPython (.NET and Mono). The module named serial automatically selects the appropriate backend.

TCP/IP Serial Bridge opens a TCP/IP port. When a connection is made to that port (e.g. with telnet) it forwards all data to the serial port and vice versa. It only exports a raw socket connection. The next example below gives the client much more control over the remote serial port.

Butterfly is a tornado web server written in python which powers a full featured web terminal.

## Installation
1. Install LAMP
- Install Apache2 and PHP5

	`sudo apt-get install apache2 php5 libapache2-mod-php5`
- Install MySQL

	`sudo apt-get install mysql-server mysql-client php5-mysql`
- Install PhpMyAdmin

	`sudo apt-get install phpmyadmin`
- Configure PhpMyAdmin

	`echo Include /etc/phpmyadmin/apache.conf >> /etc/apache2/apache2.conf`	
- Reboot

	`reboot`

2. Install pip (if not installed on your system)

	`sudo python get-pip.py`

2. Install PySerial

	`sudo pip install pyserial`

3. Run TCP/IP Serial Bridge
- Run tcp_serial_redirect.py

	`sudo python tcp_serial_redirect.py [options] [port [baudrate]]`

4. Install and Run Butterfly
- Install Butterfly

	`sudo pip install butterfly`
- Run and configure

	`butterfly.server.py --unsercure --host="0.0.0.0"`

5. Configure

- Create a script called mystartup.sh in /etc/init.d/ directory(login as root)
	
	`vi /etc/init.d/mystartup.sh`

- Add commands to this script one by one:

	`!/bin/bash`

- Setup executable permission on script:

	`chmod +x /etc/init.d/mystartup.sh`

- Make sure this script get executed every time Debian Linux system boot up/comes up:
	`update-rc.d mystartup.sh defaults 100`

Where,
mystartup.sh: Your startup script name
defaults : The argument 'defaults' refers to the default runlevels, which are 2 through 5.
100 : Number 100 means script will get executed before any script containing number 101. Just run the command ls -l /etc/rc3.d/ and you will see all script soft linked to /etc/init.d with numbers.

Next time you reboot the system, you custom command or script will get executed via mystartup.sh. You can add more commands to this file or even call other shell/perl scripts from this file too.

- Execute shell script at system startup
Open the file mystartup.sh in /etc/init.d/ directory
	`vi /etc/init.d/ mystartup.sh`

Append your script path to the end as follows (suppose your script is /root/fw.start script that starts firewall)

	`/root/fw.start`

Save the file.

## Check this out!
>Fore more information, check out my thread at [mobilarian](http://www.mobilarian.com/showthread.php?t=1438493&p=23023323&viewfull=1#post23023323)

