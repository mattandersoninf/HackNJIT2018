# email bot that will notify students that have a preference towards specific research opportunities
import smtplib

#class EmailBot(self):
# this is the content of the email that you want to send
email_content = 'this is an email.'
# this connection line to the email server
mail = smtplib.SMTP('smtp.gmail.com', 587)
# this is how you identify yourself to the server
mail.ehlo()
# start tls(transport layer security) mode to encrypt email account
mail.starttls()

#mail.login('email user', 'password')
mail.login('matt.anderson.inf@gmail.com', 'Hummingbird95.')

# fromemail is the email that is going to be read that it was sent from
# reciever : you're sending an email to said reciever
# contents: email contains contents specified above
mail.sendmail('matt.anderson.inf@gmail.com','mra97@scarletmail.rutgers.edu', email_content)

print('An email was sent.')
    
    
    