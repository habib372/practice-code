<!-- errors / MySQL shutdown unexpectedly-->
12:19:12 PM [mysql] Attempting to start MySQL app...
12:19:12 PM [mysql] Status change detected: running
12:19:13 PM [mysql] Status change detected: stopped
12:19:13 PM [mysql] Error: MySQL shutdown unexpectedly.
12:19:13 PM [mysql] This may be due to a blocked port, missing dependencies,
12:19:13 PM [mysql] improper privileges, a crash, or a shutdown by another method
12:19:13 PM [mysql] Press the Logs button to view error logs and check
12:19:13 PM [mysql] the Windows Event Viewer for more clues
12:19:13 PM [mysql] If you need more help, copy and post this
12:19:13 PM [mysql] entire log window on the forums


<!-- Solve -->
1. Rename folder mysql/data to mysql/data_old
2. Make a copy of mysql/backup folder and name it as mysql/data
3. Copy all your database folders from mysql/data_old into mysql/data (except mysql, performance_schema, and phpmyadmin folders)
4. Copy mysql/data_old/ibdata1 file into mysql/data folder
5. Start MySQL from XAMPP control panel