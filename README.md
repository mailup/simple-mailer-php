Simple SMTP+ Implementation samples
------------------------
A very short list of readymade SMTP+ implementation samples.
The samples contained in this repository are based on easy-to-handle scenarios and suggest some possible implementation approaches.

Each sample, easily downloadable as a standalone netbeans project, will make use of different features/abilities of MailUp SMTP+ service.

Requirements
------------------------
* local/remote MySql database instance
* Apache web server
* a valid third party SMTP host along with credentials 
* a valid MailUp SMTP+ account ( required in some samples only )

suggested :
* netbeans

notes : in order to run some of the below samples you'll be needing a valid smtp+ account. For detailed information on how to get an SMTP+ account please visit [MailUp Help] [1] 

  [1]: http://help.mailup.com/display/MUG/SMTP+Settings        "MailUp Help"
  
Bundles download
------------------------
It is possible to download and install each required software from producers' web sites or installing from a bundle such as :

* WAMP (http://www.wampserver.com/en/)
* EasyPhP (http://www.easyphp.org/)  


Samples overview 
------------------------
* Sample 1  : A simple Email dispatch wrapped up into a bunch of code lines ( indicated for code beginners). 
* Sample 2  : Advanced SMTP+ features taken into consideration in this sample, including headers, charset handling and embedding of some images ( suggested for average skilled devs ).
* Sample 3  : Retrieving a recipients' pool from MySQL table to send a message to. ( indicated for those who already implement a self-hosted database and need to gather recipients' addresses from it ).
* Sample 4  : Error handling/trapping on email sending ( suggested for large recipients' lists or low bandwidth subscribers).
* Sample 5  : Uploading recipients' information and email message from file. ( suggested for those who need to send a message starting from an HTML message and a CSV/XLS file containing the list of recipients  )
* Sample 6  : Uploading an Email message as zip archive and send it to MailUp console ( suggested for those yet to be acquainted with MailUp Web interface and for those who are willing to simplify the upload to Mailup of either HTML message and related images).
* Sample 7  : Sending customized email messages ( suggested if you rely on smtp+ service but still need to nest customized content in the markup ).


Installation
------------------------



Revision history
------------------------



