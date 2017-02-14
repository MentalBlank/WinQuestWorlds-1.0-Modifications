Created By MentalBlank (mentalblank@live.com)
Achievements Fixed by F3ar and Inuyasha

Released On: 
- http://cris-is.stylin-on.me/

Running This SQL Query will fix some problems with the Emulator, top100 and Character Pages:

ALTER TABLE `wqw_users` ADD `monkill` INT( 255 ) NOT NULL DEFAULT '0',
ADD `pvpkill` INT( 255 ) NOT NULL DEFAULT '0',
ADD `chartype` VARCHAR( 255 ) NOT NULL DEFAULT 'Adventurer'

Since all you people who are trying to make the character preview load customs are all failing horribly... I've added a modified version of the swf that will load them

~MentalBlank
Dont forget to say thanks.