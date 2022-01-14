# Restaurant Demo
# Objective
A website for restaurant owner using PHP and Googel cloud storage (Firestorage). An admin panel for Restaurant owner to add the new menu and find what is added to the Menu. He/she can easily search the menu. It is a Demo version of Restaurant admin panel.
# Installation Guide
  - clone the porject repository
  - install composer in your pc
  - open terminal as administrator in the project directory
  - install the requirements using following commands
   ```
   composer require google/apiclient
   composer require google/cloud-firestore

   composer require google/cloud
   composer require kreait/firebase-php
   composer require google/cloud-storage
   ```
   
  - change the setRedirectUri to your porject directory in configold.php
  - start PHP localhost server and execute login.php

# Website Road Map
   - First login with Google account and redirect to HOME
   - HOME tab shows the ordered menu and lates added menu
   - In MENU tab, user can add the new menu (data is stored to googel firestore)
   - PROFILE tab shows user's full name, currently using G-mail and profile picture
   -  and LOGOUT is included

![alt text](http://sharetee.org/HLA/home.png)
![alt text](http://sharetee.org/HLA/showmenu.png)
![alt text](http://sharetee.org/HLA/searchresult.png)
![alt text](http://sharetee.org/HLA/addmenu.png)
