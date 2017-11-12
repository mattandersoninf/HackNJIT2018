# email bot that will notify students that have a preference towards specific research opportunities
import smtplib, sys, json, pyodbc
#class EmailBot(self):
# this is the content of the email that you want to send

try:    # grab inputs from php script
    inputs = list(sys.argv[1].split('')) 
    
    if inputs[0] == 'Faculty': email_content = 'insert path to faculty email content'
    elif input[0] == 'Student': email_content = 'insert path to student email content'
    else:
    
    # this connection line to the email server
    mail = smtplib.SMTP('mail.njit.', 587)
    # this is how you identify yourself to the server
    mail.ehlo()
    # start tls(transport layer security) mode to encrypt email account
    mail.starttls()
    
    #mail.login('email user', 'password')
    mail.login('cww5', 'cww5cww5')
    
    # fromemail is the email that is going to be read that it was sent from
    # reciever : you're sending an email to said reciever
    # contents: email contains contents specified above
    mail.sendmail('matt.anderson.inf@gmail.com','mra97@scarletmail.rutgers.edu', email_content)
    
    print('An email was sent.')
    
    
    