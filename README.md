# ResPort
------
[Hackathon Project] ResPort (RESearch PORTal) is a portal intended to be used by the students and faculty of New Jersey Institute of Technology (NJIT) to help bring awareness to research opportunities for students and teachers. As of now, the project is deployed on NJIT's debug servers (afsaccess1.njit.edu), which means no one outside NJIT network can use the portal. While this project is not 100% ready, below are some of the current functionalities we built within 24 hours of the competition:

Current Functionalities
---

Login Side:
 - Login by NJIT students only (We have functionality which ensures only NJIT students have access)
 - Login by teacher (locally set in MySQL database for project and testing purposes, since we don't have access for teacher credentials)
 
Faculty Side: 
 - Create and edit profile
 - Create research opportunities
 - Browse through that faculty's created opportunities
 
Student Side: 
 - Create and edit profile
 - Browse through different research opportunities and filter by college name within NJIT


Performance @ HackNJIT: 3rd place finish in entire competition

**Team Members:**

------

- Chidanand Khode   (FRONT END)
 
- Kevin Aizic       (FRONT END)
 
- Connor Watson     (BACK END)
 
- Matthew Anderson  (BACK END)

------

What's Next?
---

We plan on adding following functionalities to this project:

Login Side:
 - Ensuring only NJIT faculty can login as a teacher, and not have it locally set in the database

Faculty Side:
 - See number of hearted research opportunities when browsing through opportunities next to the heart at the bottom of the page
 - Have the heart at the bottom of the page when browsing through opportunities be clickable
 - Once the heart is clicked on the above page, new page opens up where teacher can see the list of students who hearted the opportunity
 - Above list should contain student information (populated from their profile data)

Student Side:
 - Heart an opportunity 
 - Browse through hearted opportunities
 - Filter by key words when browsing opportunities
 - See teacher email at bottom of each opportunity so student can contact them, separately (maybe for future versions, use in-portal messaging)

Additional:
 - Deploy the portal on NJIT's web servers, so that any faculty or student belonging to NJIT can access the portal when they are physically out of NJIT networks.
