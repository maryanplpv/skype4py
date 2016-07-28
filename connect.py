import datetime
import mysql.connector
import Skype4Py
import time
import urllib

skype = Skype4Py.Skype()
skype.Attach()

# Check new message
def checkNew():
	cnx = mysql.connector.connect(user='root', database='complaints')
	cursor = cnx.cursor()
	query = ("SELECT * from messages WHERE m_status='new'")
	data = cursor.execute(query)
	rows = cursor.fetchall()	
	if cursor.rowcount > 0:
		print "# +1 new message found!"
		sendAllMessage()


# send message
def sendAllMessage():
	print "--Prepare sending message..."
	cnx = mysql.connector.connect(user='root', database='complaints')
	cursor = cnx.cursor()
	query = ("SELECT * from messages WHERE m_status='new' LIMIT 1")
	data = cursor.execute(query)
	rows = cursor.fetchall()

	for row in rows:		
		messageId = row[0] 
		username = row[1]
		message = row[2]
		print "--message sent to: " + username
		skype.SendMessage(username, message)

	cursor.execute("UPDATE messages SET m_status = %s WHERE id = %s", ('sent', messageId))
	cnx.commit()
	cursor.close()
	cnx.close()

# monitoring
while True:
	checkNew()	
	time.sleep(2)




