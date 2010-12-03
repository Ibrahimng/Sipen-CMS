#
# Table structure for table `companies`
#
# Creation: Nov 02, 2010 at 10:48 PM
# Last update: Nov 04, 2010 at 11:17 PM
#

DROP TABLE IF EXISTS `companies`;
CREATE TABLE `companies` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(64) NOT NULL,
  `state` varchar(32) NOT NULL,
  `zip` varchar(32) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

#
# Dumping data for table `companies`
#

INSERT INTO `companies` (`id`, `name`, `address`, `city`, `state`, `zip`, `phone`, `logo`, `created_at`, `updated_at`) VALUES (15, 'Sipen', '555 Hard Drive', 'Sunshine City', 'NC', '28557', '252-555-1212', '', '2010-11-02 23:29:12', '2010-11-04 23:17:50');
# --------------------------------------------------------

#
# Table structure for table `customerplans`
#
# Creation: Oct 05, 2010 at 09:14 PM
# Last update: Oct 05, 2010 at 09:14 PM
#

DROP TABLE IF EXISTS `customerplans`;
CREATE TABLE `customerplans` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `planid` int(10) unsigned NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `scheduleclose` date NOT NULL,
  `lastbilling` date NOT NULL,
  `nextbilling` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

#
# Dumping data for table `customerplans`
#

# --------------------------------------------------------

#
# Table structure for table `customers`
#
# Creation: Oct 05, 2010 at 08:54 PM
# Last update: Oct 05, 2010 at 08:54 PM
#

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `regnumber` varchar(16) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(16) NOT NULL,
  `state` varchar(32) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

#
# Dumping data for table `customers`
#

# --------------------------------------------------------

#
# Table structure for table `groupnames`
#
# Creation: Oct 02, 2010 at 10:02 PM
# Last update: Oct 02, 2010 at 10:02 PM
#

DROP TABLE IF EXISTS `groupnames`;
CREATE TABLE `groupnames` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `groupname` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

#
# Dumping data for table `groupnames`
#

# --------------------------------------------------------

#
# Table structure for table `logs`
#
# Creation: Nov 10, 2010 at 10:30 PM
# Last update: Nov 10, 2010 at 10:30 PM
#

DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `ip` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `type` varchar(64) NOT NULL,
  `username` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

#
# Dumping data for table `logs`
#

# --------------------------------------------------------

#
# Table structure for table `plans`
#
# Creation: Oct 16, 2010 at 07:15 PM
# Last update: Nov 26, 2010 at 12:04 AM
#

DROP TABLE IF EXISTS `plans`;
CREATE TABLE `plans` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(16) default '0',
  `period` int(11) NOT NULL default '1',
  `hidden` tinyint(4) NOT NULL,
  `plancolor` varchar(16) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

#
# Dumping data for table `plans`
#

INSERT INTO `plans` (`id`, `name`, `description`, `price`, `period`, `hidden`, `plancolor`, `updated_at`, `created_at`) VALUES (1, 'Test Plan (30 User License)', 'Test Plan - Please Delete Me', '30.00', 1, 1, '#99cccc', '2010-11-11 14:30:38', '2010-11-11 14:30:38');
# --------------------------------------------------------

#
# Table structure for table `planvariables`
#
# Creation: Nov 12, 2010 at 01:46 PM
# Last update: Nov 25, 2010 at 11:15 PM
#

DROP TABLE IF EXISTS `planvariables`;
CREATE TABLE `planvariables` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `planid` int(10) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  `validation` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `defaultvalue` varchar(255) default NULL,
  `required` tinyint(4) NOT NULL default '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

#
# Dumping data for table `planvariables`
#

INSERT INTO `planvariables` (`id`, `planid`, `name`, `validation`, `description`, `defaultvalue`, `required`, `created_at`, `updated_at`) VALUES (7, 1, 'Username', 'username', 'Unique login ID to access features', '', 1, '2010-11-12 13:50:44', '0000-00-00 00:00:00');
INSERT INTO `planvariables` (`id`, `planid`, `name`, `validation`, `description`, `defaultvalue`, `required`, `created_at`, `updated_at`) VALUES (6, 1, 'Password', 'password', 'Password for corresponding username.', '', 1, '2010-11-12 13:49:35', '0000-00-00 00:00:00');
# --------------------------------------------------------

#
# Table structure for table `settings`
#
# Creation: Nov 11, 2010 at 11:24 AM
# Last update: Nov 11, 2010 at 12:24 PM
#

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

#
# Dumping data for table `settings`
#

INSERT INTO `settings` (`id`, `name`, `value`) VALUES (1, 'failedLoginLimit', '5');
# --------------------------------------------------------

#
# Table structure for table `usergroups`
#
# Creation: Oct 02, 2010 at 10:04 PM
# Last update: Oct 02, 2010 at 10:04 PM
#

DROP TABLE IF EXISTS `usergroups`;
CREATE TABLE `usergroups` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `groupid` int(10) unsigned NOT NULL,
  `userid` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

#
# Dumping data for table `usergroups`
#

# --------------------------------------------------------

#
# Table structure for table `users`
#
# Creation: Nov 11, 2010 at 09:44 AM
# Last update: Nov 25, 2010 at 11:14 PM
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(64) default NULL,
  `password` varchar(64) default NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `level` int(11) default '1',
  `last_login` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(64) NOT NULL,
  `state` varchar(32) NOT NULL,
  `zip` varchar(16) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `failed` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

#
# Dumping data for table `users`
#

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `level`, `last_login`, `address`, `city`, `state`, `zip`, `phone`, `email`, `failed`, `created_at`, `updated_at`) VALUES (10, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', '', 2, '2010-11-25 23:14:58', '555 Hard Drive', 'Sunshine City', 'NC', '28557', '252-555-1212', 'admin@mydomain.com', 0, '2010-11-22 22:12:44', '2010-11-25 23:14:58');



    