-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 11, 2011 at 09:09 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `apsn`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `eventID` int(11) NOT NULL,
  `sessionID` int(11) NOT NULL,
  `volunID` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `hours` int(11) NOT NULL,
  `remarks` int(11) NOT NULL,
  PRIMARY KEY (`eventID`,`sessionID`,`volunID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_details`
--

CREATE TABLE IF NOT EXISTS `event_details` (
  `eventID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `organizer` varchar(40) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `vacancies` int(11) NOT NULL,
  `waitlist` int(11) NOT NULL,
  `sessions` int(11) NOT NULL,
  PRIMARY KEY (`eventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `event_details`
--

INSERT INTO `event_details` (`eventID`, `name`, `description`, `organizer`, `venue`, `date_from`, `date_to`, `vacancies`, `waitlist`, `sessions`) VALUES
(1, 'Weekly Tution', 'This is just to see if this chutiyaap is working fine or not.....:) :P', '', '', '2011-11-15', '2011-11-24', 3, 0, 2),
(2, '', '', '', '', '0000-00-00', '0000-00-00', 0, 0, 0),
(3, 'Katong Fest', 'Test', 'Katong School', 'Tanah Merah', '2011-11-11', '2011-12-04', 20, 0, 3),
(4, 'Katong', 'Fest', 'Katong School', 'tanah meral', '2011-11-11', '2011-11-11', 20, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `session_details`
--

CREATE TABLE IF NOT EXISTS `session_details` (
  `eventID` int(11) NOT NULL,
  `sessionID` int(11) NOT NULL,
  `date` date NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  PRIMARY KEY (`eventID`,`sessionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session_details`
--

INSERT INTO `session_details` (`eventID`, `sessionID`, `date`, `starttime`, `endtime`) VALUES
(1, 1, '2011-11-15', '00:00:00', '00:00:00'),
(1, 2, '2011-11-24', '00:00:00', '00:00:00'),
(3, 1, '2011-11-11', '11:11:00', '11:11:00'),
(3, 2, '2011-12-03', '12:00:00', '12:00:00'),
(3, 3, '2011-12-04', '12:00:00', '12:00:00'),
(4, 1, '2011-11-11', '11:11:11', '11:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `signedup_volunteers`
--

CREATE TABLE IF NOT EXISTS `signedup_volunteers` (
  `eventID` int(11) NOT NULL,
  `volunID` varchar(40) NOT NULL,
  `status` varchar(10) NOT NULL,
  `queueNum` int(11) NOT NULL,
  PRIMARY KEY (`eventID`,`volunID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signedup_volunteers`
--

INSERT INTO `signedup_volunteers` (`eventID`, `volunID`, `status`, `queueNum`) VALUES
(1, 'athifsaleem@gmail.com', 'confirmed', 1),
(4, 'akhand@gmail.com', 'confirmed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_session_details`
--

CREATE TABLE IF NOT EXISTS `temp_session_details` (
  `eventID` int(11) NOT NULL,
  `sessionID` int(11) NOT NULL,
  `date` date NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  PRIMARY KEY (`eventID`,`sessionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_cformsdata`
--

CREATE TABLE IF NOT EXISTS `wp_cformsdata` (
  `f_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sub_id` int(11) unsigned NOT NULL,
  `field_name` varchar(100) NOT NULL DEFAULT '',
  `field_val` text,
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1069 ;

--
-- Dumping data for table `wp_cformsdata`
--

INSERT INTO `wp_cformsdata` (`f_id`, `sub_id`, `field_name`, `field_val`) VALUES
(422, 16, 'Fieldset7', 'Contact Details'),
(421, 16, 'FieldsetEnd6', '--'),
(420, 16, 'Name of Diploma/Degree Attained', 'Kindergarten'),
(419, 16, 'Highest Educational Level Attained', '1'),
(418, 16, 'Fieldset5', 'Education'),
(417, 16, 'FieldsetEnd4', '--'),
(416, 16, 'Spoken', 'Bhojpuri'),
(415, 16, 'Written', 'English'),
(414, 16, 'Fieldset3', 'Language'),
(413, 16, 'FieldsetEnd2', '--'),
(412, 16, 'NS Status', '3'),
(411, 16, 'Marital Status', '4'),
(410, 16, 'Country of Birth', 'India'),
(409, 16, 'Singapore PR?', '0'),
(408, 16, 'Religion', 'Hindu'),
(407, 16, 'Race', 'Nigga'),
(406, 16, 'Nationality', 'Indian'),
(405, 16, 'Date', '1992-07-22'),
(404, 16, 'NRIC', '123456'),
(403, 16, 'Sex', '2'),
(402, 16, 'Last Name', 'Dudani'),
(401, 16, 'First Name', 'Shelly'),
(400, 16, 'Title', '3'),
(398, 16, 'page', '/apsn/?page_id=6'),
(399, 16, 'Fieldset1', 'Personal Details'),
(397, 15, 'FieldsetEnd4', '--'),
(396, 15, 'Availability for routine regular school activities', '1'),
(395, 15, 'FieldsetEnd3', '--'),
(126, 6, 'Please provide details', 'cannot'),
(125, 6, 'instructional (eg cooking lessons, arts)', 'on'),
(124, 6, 'Adults', 'on'),
(123, 6, 'Youth', 'on'),
(122, 6, 'Children', 'on'),
(121, 6, 'Fieldset2', 'Areas of Interest'),
(120, 6, 'Special Skills and Talents to contribute', 'cannot'),
(119, 6, 'If yes, please specify the name of the organization', 'cannot'),
(118, 6, 'Previous Volunteering Experience', '0'),
(117, 6, 'Fieldset1', 'Volunteering'),
(116, 6, 'page', '/apsn/?page_id=6'),
(427, 16, 'Pager/Handphone', '23432'),
(426, 16, 'Home Telephone', '923223'),
(425, 16, 'Email', 'chillinout@gmail.com'),
(424, 16, 'Postal Code', '639809'),
(423, 16, 'Home Address', '20 nanyang avenue'),
(127, 6, 'Organizing Activities', '-'),
(128, 6, 'Admin/Instructional Support', '-'),
(129, 6, 'Others (please specify)', ''),
(130, 6, 'FieldsetEnd3', '--'),
(131, 6, 'Availability for routine regular school activities', '1'),
(132, 6, 'FieldsetEnd4', '--'),
(373, 14, 'page', '/apsn/?page_id=6'),
(489, 18, 'page', '/apsn/?page_id=6'),
(488, 17, 'FieldsetEnd8', '--'),
(487, 17, 'Others(Please Specify)', 'adfsadf'),
(486, 17, 'Type of Dwelling', '1'),
(485, 17, 'Pager/Handphone', '12231'),
(483, 17, 'Email', 'anshu@gmail.com'),
(484, 17, 'Home Telephone', '12323'),
(482, 17, 'Postal Code', '34232'),
(481, 17, 'Home Address', 'Nanyang Avenue'),
(480, 17, 'Fieldset7', 'Contact Details'),
(479, 17, 'FieldsetEnd6', '--'),
(478, 17, 'Name of Diploma/Degree Attained', 'University'),
(477, 17, 'Highest Educational Level Attained', '1'),
(476, 17, 'Fieldset5', 'Education'),
(474, 17, 'Spoken', 'Bhojpuri'),
(475, 17, 'FieldsetEnd4', '--'),
(394, 15, 'Others (please specify)', 'Nothing'),
(393, 15, 'Admin/Instructional Support', 'on'),
(392, 15, 'Organizing Activities', 'on'),
(391, 15, 'Please provide details', 'Yes!'),
(390, 15, 'instructional (eg cooking lessons, arts)', 'on'),
(389, 15, 'Adults', 'on'),
(388, 15, 'Youth', 'on'),
(387, 15, 'Children', 'on'),
(386, 15, 'Fieldset2', 'Areas of Interest'),
(385, 15, 'Special Skills and Talents to contribute', 'Nothing!'),
(384, 15, 'If yes, please specify the name of the organization', 'Heya!'),
(383, 15, 'Previous Volunteering Experience', '0'),
(382, 15, 'Fieldset1', 'Volunteering'),
(381, 15, 'page', '/apsn/?page_id=6'),
(380, 14, 'FieldsetEnd2', '--'),
(379, 14, 'Fax Number', '1332432'),
(378, 14, 'Office Number', '23324'),
(377, 14, 'Postal Code', '6390809'),
(376, 14, 'Workplace Address', '10 Unemployed Avenue'),
(374, 14, 'Fieldset1', 'Occupation'),
(375, 14, 'Name of Employer/Company', 'Unemployed Inc.'),
(473, 17, 'Written', 'Bhojpuri'),
(472, 17, 'Fieldset3', 'Language'),
(471, 17, 'FieldsetEnd2', '--'),
(470, 17, 'NS Status', '1'),
(469, 17, 'Marital Status', '1'),
(468, 17, 'Country of Birth', 'India'),
(467, 17, 'Singapore PR?', '1'),
(466, 17, 'Religion', 'Hindu'),
(465, 17, 'Race', 'Indian'),
(464, 17, 'Nationality', 'Indian'),
(463, 17, 'Date', '1992-2-12'),
(462, 17, 'NRIC', '12323'),
(461, 17, 'Sex', '2'),
(460, 17, 'Last Name', 'Garodia'),
(459, 17, 'First Name', 'Anshu'),
(458, 17, 'Title', '3'),
(457, 17, 'Fieldset1', 'Personal Details'),
(456, 17, 'page', '/apsn/?page_id=6'),
(257, 10, 'page', '/apsn/?page_id=6'),
(258, 10, 'Fieldset1', 'Occupation'),
(259, 10, 'Name of Employer/Company', 'Government of Pluto'),
(260, 10, 'Workplace Address', '42, Pluto Street,Sun Core'),
(261, 10, 'Postal Code', '007'),
(262, 10, 'Office Number', '007'),
(263, 10, 'Fax Number', '007'),
(264, 10, 'FieldsetEnd2', '--'),
(265, 11, 'page', '/apsn/?page_id=6'),
(266, 11, 'Fieldset1', 'Volunteering'),
(267, 11, 'Previous Volunteering Experience', '1'),
(268, 11, 'If yes, please specify the name of the organization', 'every organization'),
(269, 11, 'Special Skills and Talents to contribute', 'universal set'),
(270, 11, 'Fieldset2', 'Areas of Interest'),
(271, 11, 'Children', 'on'),
(272, 11, 'Youth', 'on'),
(273, 11, 'Adults', 'on'),
(274, 11, 'instructional (eg cooking lessons, arts)', '-'),
(275, 11, 'Please provide details', 'every good looking,talented and smart creation of God(Me)'),
(276, 11, 'Organizing Activities', 'on'),
(277, 11, 'Admin/Instructional Support', 'on'),
(278, 11, 'Others (please specify)', 'Overtaking your Firm'),
(279, 11, 'FieldsetEnd3', '--'),
(280, 11, 'Availability for routine regular school activities', '3'),
(281, 11, 'FieldsetEnd4', '--'),
(282, 12, 'page', '/apsn/?page_id=6'),
(283, 12, 'Fieldset1', 'Personal Details'),
(284, 12, 'Title', '2'),
(285, 12, 'First Name', 'Akhand'),
(286, 12, 'Last Name', 'Singh'),
(287, 12, 'Sex', '1'),
(288, 12, 'NRIC', 'abcd'),
(289, 12, 'Date', '10/18/1992'),
(290, 12, 'Nationality', 'indian'),
(291, 12, 'Race', 'indian'),
(292, 12, 'Religion', 'hindu'),
(293, 12, 'Singapore PR?', '0'),
(294, 12, 'Country of Birth', 'india'),
(295, 12, 'Marital Status', '4'),
(296, 12, 'NS Status', '3'),
(297, 12, 'FieldsetEnd2', '--'),
(298, 12, 'Fieldset3', 'Language'),
(299, 12, 'Written', 'english'),
(300, 12, 'Spoken', 'angrezi'),
(301, 12, 'FieldsetEnd4', '--'),
(302, 12, 'Fieldset5', 'Education'),
(303, 12, 'Highest Educational Level Attained', '1'),
(304, 12, 'Name of Diploma/Degree Attained', 'kindergarten'),
(305, 12, 'FieldsetEnd6', '--'),
(306, 12, 'Fieldset7', 'Contact Details'),
(307, 12, 'Home Address', '123,abc,pluto'),
(308, 12, 'Postal Code', '!@#$%^'),
(309, 12, 'Email', '007bond@president.pluto.com'),
(310, 12, 'Home Telephone', '007'),
(311, 12, 'Pager/Handphone', '007'),
(312, 12, 'Type of Dwelling', '5'),
(313, 12, 'Others(Please Specify)', ''),
(314, 12, 'FieldsetEnd8', '--'),
(315, 12, 'Fieldset1', 'Occupation'),
(316, 12, 'Name of Employer/Company', 'Government of Pluto'),
(317, 12, 'Workplace Address', '42, Pluto Street,Sun Core'),
(318, 12, 'Postal Code', '007'),
(319, 12, 'Office Number', '007'),
(320, 12, 'Fax Number', '007'),
(321, 12, 'FieldsetEnd2', '--'),
(322, 12, 'Fieldset1', 'Volunteering'),
(323, 12, 'Previous Volunteering Experience', '1'),
(324, 12, 'If yes, please specify the name of the organization', 'every organization'),
(325, 12, 'Special Skills and Talents to contribute', 'universal set'),
(326, 12, 'Fieldset2', 'Areas of Interest'),
(327, 12, 'Children', 'on'),
(328, 12, 'Youth', 'on'),
(329, 12, 'Adults', 'on'),
(330, 12, 'instructional (eg cooking lessons, arts)', '-'),
(331, 12, 'Please provide details', 'every good looking,talented and smart creation of God(Me)'),
(332, 12, 'Organizing Activities', 'on'),
(333, 12, 'Admin/Instructional Support', 'on'),
(334, 12, 'Others (please specify)', 'Overtaking your Firm'),
(335, 12, 'FieldsetEnd3', '--'),
(336, 12, 'Availability for routine regular school activities', '3'),
(337, 12, 'FieldsetEnd4', '--'),
(338, 12, 'Fieldset1', 'Declarations'),
(339, 12, 'Have you been convicted or charged in a court of law in any country ?', '1'),
(428, 16, 'Type of Dwelling', '1'),
(429, 16, 'Others(Please Specify)', 'Heya!'),
(430, 16, 'FieldsetEnd8', '--'),
(431, 16, 'Fieldset1', 'Occupation'),
(432, 16, 'Name of Employer/Company', 'Unemployed Inc.'),
(433, 16, 'Workplace Address', '10 Unemployed Avenue'),
(434, 16, 'Postal Code', '6390809'),
(435, 16, 'Office Number', '23324'),
(436, 16, 'Fax Number', '1332432'),
(437, 16, 'FieldsetEnd2', '--'),
(438, 16, 'Fieldset1', 'Volunteering'),
(439, 16, 'Previous Volunteering Experience', '0'),
(440, 16, 'If yes, please specify the name of the organization', 'Heya!'),
(441, 16, 'Special Skills and Talents to contribute', 'Nothing!'),
(442, 16, 'Fieldset2', 'Areas of Interest'),
(443, 16, 'Children', 'on'),
(444, 16, 'Youth', 'on'),
(445, 16, 'Adults', 'on'),
(446, 16, 'instructional (eg cooking lessons, arts)', 'on'),
(447, 16, 'Please provide details', 'Yes!'),
(448, 16, 'Organizing Activities', 'on'),
(449, 16, 'Admin/Instructional Support', 'on'),
(450, 16, 'Others (please specify)', 'Nothing'),
(451, 16, 'FieldsetEnd3', '--'),
(452, 16, 'Availability for routine regular school activities', '1'),
(453, 16, 'FieldsetEnd4', '--'),
(454, 16, 'Fieldset1', 'Declarations'),
(455, 16, 'Have you been convicted or charged in a court of law in any country ?', '0'),
(490, 18, 'Fieldset1', 'Occupation'),
(491, 18, 'Name of Employer/Company', 'Unemployed Inc.'),
(492, 18, 'Workplace Address', 'Hello!'),
(493, 18, 'Postal Code', '4545'),
(494, 18, 'Office Number', '234234'),
(495, 18, 'Fax Number', '234234'),
(496, 18, 'FieldsetEnd2', '--'),
(497, 19, 'page', '/apsn/?page_id=6'),
(498, 19, 'Fieldset1', 'Volunteering'),
(499, 19, 'Previous Volunteering Experience', '0'),
(500, 19, 'If yes, please specify the name of the organization', 'None!'),
(501, 19, 'Special Skills and Talents to contribute', 'Singing!'),
(502, 19, 'Fieldset2', 'Areas of Interest'),
(503, 19, 'Children', 'on'),
(504, 19, 'Youth', 'on'),
(505, 19, 'Adults', 'on'),
(506, 19, 'instructional (eg cooking lessons, arts)', 'on'),
(507, 19, 'Please provide details', 'dafsadf'),
(508, 19, 'Organizing Activities', 'on'),
(509, 19, 'Admin/Instructional Support', 'on'),
(510, 19, 'Others (please specify)', 'asdfsadf'),
(511, 19, 'FieldsetEnd3', '--'),
(512, 19, 'Availability for routine regular school activities', '1'),
(513, 19, 'FieldsetEnd4', '--'),
(514, 20, 'page', '/apsn/?page_id=6'),
(515, 20, 'Fieldset1', 'Personal Details'),
(516, 20, 'Title', '3'),
(517, 20, 'First Name', 'Anshu'),
(518, 20, 'Last Name', 'Garodia'),
(519, 20, 'Sex', '2'),
(520, 20, 'NRIC', '12323'),
(521, 20, 'Date', '1992-2-12'),
(522, 20, 'Nationality', 'Indian'),
(523, 20, 'Race', 'Indian'),
(524, 20, 'Religion', 'Hindu'),
(525, 20, 'Singapore PR?', '1'),
(526, 20, 'Country of Birth', 'India'),
(527, 20, 'Marital Status', '1'),
(528, 20, 'NS Status', '1'),
(529, 20, 'FieldsetEnd2', '--'),
(530, 20, 'Fieldset3', 'Language'),
(531, 20, 'Written', 'Bhojpuri'),
(532, 20, 'Spoken', 'Bhojpuri'),
(533, 20, 'FieldsetEnd4', '--'),
(534, 20, 'Fieldset5', 'Education'),
(535, 20, 'Highest Educational Level Attained', '1'),
(536, 20, 'Name of Diploma/Degree Attained', 'University'),
(537, 20, 'FieldsetEnd6', '--'),
(538, 20, 'Fieldset7', 'Contact Details'),
(539, 20, 'Home Address', 'Nanyang Avenue'),
(540, 20, 'Postal Code', '34232'),
(541, 20, 'Email', 'anshu@gmail.com'),
(542, 20, 'Home Telephone', '12323'),
(543, 20, 'Pager/Handphone', '12231'),
(544, 20, 'Type of Dwelling', '1'),
(545, 20, 'Others(Please Specify)', 'adfsadf'),
(546, 20, 'FieldsetEnd8', '--'),
(547, 20, 'Fieldset1', 'Occupation'),
(548, 20, 'Name of Employer/Company', 'Unemployed Inc.'),
(549, 20, 'Workplace Address', 'Hello!'),
(550, 20, 'Postal Code', '4545'),
(551, 20, 'Office Number', '234234'),
(552, 20, 'Fax Number', '234234'),
(553, 20, 'FieldsetEnd2', '--'),
(554, 20, 'Fieldset1', 'Volunteering'),
(555, 20, 'Previous Volunteering Experience', '0'),
(556, 20, 'If yes, please specify the name of the organization', 'None!'),
(557, 20, 'Special Skills and Talents to contribute', 'Singing!'),
(558, 20, 'Fieldset2', 'Areas of Interest'),
(559, 20, 'Children', 'on'),
(560, 20, 'Youth', 'on'),
(561, 20, 'Adults', 'on'),
(562, 20, 'instructional (eg cooking lessons, arts)', 'on'),
(563, 20, 'Please provide details', 'dafsadf'),
(564, 20, 'Organizing Activities', 'on'),
(565, 20, 'Admin/Instructional Support', 'on'),
(566, 20, 'Others (please specify)', 'asdfsadf'),
(567, 20, 'FieldsetEnd3', '--'),
(568, 20, 'Availability for routine regular school activities', '1'),
(569, 20, 'FieldsetEnd4', '--'),
(570, 20, 'Fieldset1', 'Declarations'),
(571, 20, 'Have you been convicted or charged in a court of law in any country ?', '0'),
(572, 21, 'page', '/apsn/?page_id=6'),
(573, 21, 'Fieldset1', 'Personal Details'),
(574, 21, 'Title', '3'),
(575, 21, 'First Name', 'akhand'),
(576, 21, 'Last Name', 'pratap'),
(577, 21, 'Sex', '1'),
(578, 21, 'NRIC', ''),
(579, 21, 'Date', ''),
(580, 21, 'Nationality', ''),
(581, 21, 'Race', ''),
(582, 21, 'Religion', ''),
(583, 21, 'Singapore PR?', '1'),
(584, 21, 'Country of Birth', ''),
(585, 21, 'Marital Status', '1'),
(586, 21, 'NS Status', '1'),
(587, 21, 'FieldsetEnd2', '--'),
(588, 21, 'Fieldset3', 'Language'),
(589, 21, 'Written', ''),
(590, 21, 'Spoken', ''),
(591, 21, 'FieldsetEnd4', '--'),
(592, 21, 'Fieldset5', 'Education'),
(593, 21, 'Highest Educational Level Attained', '1'),
(594, 21, 'Name of Diploma/Degree Attained', ''),
(595, 21, 'FieldsetEnd6', '--'),
(596, 21, 'Fieldset7', 'Contact Details'),
(597, 21, 'Home Address', ''),
(598, 21, 'Postal Code', ''),
(599, 21, 'Email', 'akhand@gmail.com'),
(600, 21, 'Home Telephone', ''),
(601, 21, 'Pager/Handphone', '1231232'),
(602, 21, 'Type of Dwelling', '1'),
(603, 21, 'Others(Please Specify)', ''),
(604, 21, 'FieldsetEnd8', '--'),
(605, 22, 'page', '/apsn/?page_id=6'),
(606, 22, 'Fieldset1', 'Occupation'),
(607, 22, 'Name of Employer/Company', 'akhand'),
(608, 22, 'Workplace Address', ''),
(609, 22, 'Postal Code', ''),
(610, 22, 'Office Number', ''),
(611, 22, 'Fax Number', ''),
(612, 22, 'FieldsetEnd2', '--'),
(613, 23, 'page', '/apsn/?page_id=6'),
(614, 23, 'Fieldset1', 'Volunteering'),
(615, 23, 'Previous Volunteering Experience', '1'),
(616, 23, 'If yes, please specify the name of the organization', 'yes'),
(617, 23, 'Special Skills and Talents to contribute', ''),
(618, 23, 'Fieldset2', 'Areas of Interest'),
(619, 23, 'Children', '-'),
(620, 23, 'Youth', '-'),
(621, 23, 'Adults', '-'),
(622, 23, 'instructional (eg cooking lessons, arts)', '-'),
(623, 23, 'Please provide details', ''),
(624, 23, 'Organizing Activities', '-'),
(625, 23, 'Admin/Instructional Support', '-'),
(626, 23, 'Others (please specify)', ''),
(627, 23, 'FieldsetEnd3', '--'),
(628, 23, 'Availability for routine regular school activities', '1'),
(629, 23, 'FieldsetEnd4', '--'),
(630, 24, 'page', '/apsn/?page_id=6'),
(631, 24, 'Fieldset1', 'Personal Details'),
(632, 24, 'Title', '3'),
(633, 24, 'First Name', 'akhand'),
(634, 24, 'Last Name', 'pratap'),
(635, 24, 'Sex', '1'),
(636, 24, 'NRIC', ''),
(637, 24, 'Date', ''),
(638, 24, 'Nationality', ''),
(639, 24, 'Race', ''),
(640, 24, 'Religion', ''),
(641, 24, 'Singapore PR?', '1'),
(642, 24, 'Country of Birth', ''),
(643, 24, 'Marital Status', '1'),
(644, 24, 'NS Status', '1'),
(645, 24, 'FieldsetEnd2', '--'),
(646, 24, 'Fieldset3', 'Language'),
(647, 24, 'Written', ''),
(648, 24, 'Spoken', ''),
(649, 24, 'FieldsetEnd4', '--'),
(650, 24, 'Fieldset5', 'Education'),
(651, 24, 'Highest Educational Level Attained', '1'),
(652, 24, 'Name of Diploma/Degree Attained', ''),
(653, 24, 'FieldsetEnd6', '--'),
(654, 24, 'Fieldset7', 'Contact Details'),
(655, 24, 'Home Address', ''),
(656, 24, 'Postal Code', ''),
(657, 24, 'Email', 'akhand@gmail.com'),
(658, 24, 'Home Telephone', ''),
(659, 24, 'Pager/Handphone', '1231232'),
(660, 24, 'Type of Dwelling', '1'),
(661, 24, 'Others(Please Specify)', ''),
(662, 24, 'FieldsetEnd8', '--'),
(663, 24, 'Fieldset1', 'Occupation'),
(664, 24, 'Name of Employer/Company', 'akhand'),
(665, 24, 'Workplace Address', ''),
(666, 24, 'Postal Code', ''),
(667, 24, 'Office Number', ''),
(668, 24, 'Fax Number', ''),
(669, 24, 'FieldsetEnd2', '--'),
(670, 24, 'Fieldset1', 'Volunteering'),
(671, 24, 'Previous Volunteering Experience', '1'),
(672, 24, 'If yes, please specify the name of the organization', 'yes'),
(673, 24, 'Special Skills and Talents to contribute', ''),
(674, 24, 'Fieldset2', 'Areas of Interest'),
(675, 24, 'Children', '-'),
(676, 24, 'Youth', '-'),
(677, 24, 'Adults', '-'),
(678, 24, 'instructional (eg cooking lessons, arts)', '-'),
(679, 24, 'Please provide details', ''),
(680, 24, 'Organizing Activities', '-'),
(681, 24, 'Admin/Instructional Support', '-'),
(682, 24, 'Others (please specify)', ''),
(683, 24, 'FieldsetEnd3', '--'),
(684, 24, 'Availability for routine regular school activities', '1'),
(685, 24, 'FieldsetEnd4', '--'),
(686, 24, 'Fieldset1', 'Declarations'),
(687, 24, 'Have you been convicted or charged in a court of law in any country ?', '0'),
(688, 25, 'page', '/apsn/?page_id=6'),
(689, 25, 'Fieldset1', 'Personal Details'),
(690, 25, 'Title', '2'),
(691, 25, 'First Name', 'Atif '),
(692, 25, 'Last Name', 'Saleem'),
(693, 25, 'Sex', '1'),
(694, 25, 'NRIC', 'G0979652K'),
(695, 25, 'Date', '1992-07-22'),
(696, 25, 'Nationality', 'Indian'),
(697, 25, 'Race', 'Indian'),
(698, 25, 'Religion', 'Muslim'),
(699, 25, 'Singapore PR?', '0'),
(700, 25, 'Country of Birth', 'UAE'),
(701, 25, 'Marital Status', '1'),
(702, 25, 'NS Status', '3'),
(703, 25, 'FieldsetEnd2', '--'),
(704, 25, 'Fieldset3', 'Language'),
(705, 25, 'Written', 'English'),
(706, 25, 'Spoken', 'English'),
(707, 25, 'FieldsetEnd4', '--'),
(708, 25, 'Fieldset5', 'Education'),
(709, 25, 'Highest Educational Level Attained', '5'),
(710, 25, 'Name of Diploma/Degree Attained', 'CBSE'),
(711, 25, 'FieldsetEnd6', '--'),
(712, 25, 'Fieldset7', 'Contact Details'),
(713, 25, 'Home Address', '20 Nanyang Avenue'),
(714, 25, 'Postal Code', '639809'),
(715, 25, 'Email', 'atif1@e.ntu.edu.sg'),
(716, 25, 'Home Telephone', '98280444'),
(717, 25, 'Pager/Handphone', '98280444'),
(718, 25, 'Type of Dwelling', '1'),
(719, 25, 'Others(Please Specify)', 'HDB'),
(720, 25, 'FieldsetEnd8', '--'),
(721, 26, 'page', '/apsn/?page_id=6'),
(722, 26, 'Fieldset1', 'Occupation'),
(723, 26, 'Name of Employer/Company', 'IBM'),
(724, 26, 'Workplace Address', 'Dubai'),
(725, 26, 'Postal Code', '97150'),
(726, 26, 'Office Number', '042683367'),
(727, 26, 'Fax Number', '042683367'),
(728, 26, 'FieldsetEnd2', '--'),
(729, 27, 'page', '/apsn/?page_id=6'),
(730, 27, 'Fieldset1', 'Volunteering'),
(731, 27, 'Previous Volunteering Experience', '1'),
(732, 27, 'If yes, please specify the name of the organization', 'Al Noor'),
(733, 27, 'Special Skills and Talents to contribute', 'Dance'),
(734, 27, 'Fieldset2', 'Areas of Interest'),
(735, 27, 'Children', 'on'),
(736, 27, 'Youth', '-'),
(737, 27, 'Adults', 'on'),
(738, 27, 'instructional (eg cooking lessons, arts)', 'on'),
(739, 27, 'Please provide details', 'Interesting in painting'),
(740, 27, 'Organizing Activities', 'on'),
(741, 27, 'Admin/Instructional Support', 'on'),
(742, 27, 'Others (please specify)', 'Interested in Painting'),
(743, 27, 'FieldsetEnd3', '--'),
(744, 27, 'Availability for routine regular school activities', '1'),
(745, 27, 'FieldsetEnd4', '--'),
(746, 28, 'page', '/apsn/?page_id=6'),
(747, 28, 'Fieldset1', 'Personal Details'),
(748, 28, 'Title', '2'),
(749, 28, 'First Name', 'Atif '),
(750, 28, 'Last Name', 'Saleem'),
(751, 28, 'Sex', '1'),
(752, 28, 'NRIC', 'G0979652K'),
(753, 28, 'Date', '1992-07-22'),
(754, 28, 'Nationality', 'Indian'),
(755, 28, 'Race', 'Indian'),
(756, 28, 'Religion', 'Muslim'),
(757, 28, 'Singapore PR?', '0'),
(758, 28, 'Country of Birth', 'UAE'),
(759, 28, 'Marital Status', '1'),
(760, 28, 'NS Status', '3'),
(761, 28, 'FieldsetEnd2', '--'),
(762, 28, 'Fieldset3', 'Language'),
(763, 28, 'Written', 'English'),
(764, 28, 'Spoken', 'English'),
(765, 28, 'FieldsetEnd4', '--'),
(766, 28, 'Fieldset5', 'Education'),
(767, 28, 'Highest Educational Level Attained', '5'),
(768, 28, 'Name of Diploma/Degree Attained', 'CBSE'),
(769, 28, 'FieldsetEnd6', '--'),
(770, 28, 'Fieldset7', 'Contact Details'),
(771, 28, 'Home Address', '20 Nanyang Avenue'),
(772, 28, 'Postal Code', '639809'),
(773, 28, 'Email', 'atif1@e.ntu.edu.sg'),
(774, 28, 'Home Telephone', '98280444'),
(775, 28, 'Pager/Handphone', '98280444'),
(776, 28, 'Type of Dwelling', '1'),
(777, 28, 'Others(Please Specify)', 'HDB'),
(778, 28, 'FieldsetEnd8', '--'),
(779, 28, 'Fieldset1', 'Occupation'),
(780, 28, 'Name of Employer/Company', 'IBM'),
(781, 28, 'Workplace Address', 'Dubai'),
(782, 28, 'Postal Code', '97150'),
(783, 28, 'Office Number', '042683367'),
(784, 28, 'Fax Number', '042683367'),
(785, 28, 'FieldsetEnd2', '--'),
(786, 28, 'Fieldset1', 'Volunteering'),
(787, 28, 'Previous Volunteering Experience', '1'),
(788, 28, 'If yes, please specify the name of the organization', 'Al Noor'),
(789, 28, 'Special Skills and Talents to contribute', 'Dance'),
(790, 28, 'Fieldset2', 'Areas of Interest'),
(791, 28, 'Children', 'on'),
(792, 28, 'Youth', '-'),
(793, 28, 'Adults', 'on'),
(794, 28, 'instructional (eg cooking lessons, arts)', 'on'),
(795, 28, 'Please provide details', 'Interesting in painting'),
(796, 28, 'Organizing Activities', 'on'),
(797, 28, 'Admin/Instructional Support', 'on'),
(798, 28, 'Others (please specify)', 'Interested in Painting'),
(799, 28, 'FieldsetEnd3', '--'),
(800, 28, 'Availability for routine regular school activities', '1'),
(801, 28, 'FieldsetEnd4', '--'),
(802, 28, 'Fieldset1', 'Declarations'),
(803, 28, 'Have you been convicted or charged in a court of law in any country ?', '0'),
(804, 29, 'page', '/apsn/?page_id=6'),
(805, 29, 'Fieldset1', 'Personal Details'),
(806, 29, 'Title', '2'),
(807, 29, 'First Name', 'Atif '),
(808, 29, 'Last Name', 'Saleem'),
(809, 29, 'Sex', '-'),
(810, 29, 'NRIC', ''),
(811, 29, 'Date', ''),
(812, 29, 'Nationality', ''),
(813, 29, 'Race', ''),
(814, 29, 'Religion', ''),
(815, 29, 'Singapore PR?', '1'),
(816, 29, 'Country of Birth', ''),
(817, 29, 'Marital Status', '1'),
(818, 29, 'NS Status', '1'),
(819, 29, 'FieldsetEnd2', '--'),
(820, 29, 'Fieldset3', 'Language'),
(821, 29, 'Written', ''),
(822, 29, 'Spoken', ''),
(823, 29, 'FieldsetEnd4', '--'),
(824, 29, 'Fieldset5', 'Education'),
(825, 29, 'Highest Educational Level Attained', '1'),
(826, 29, 'Name of Diploma/Degree Attained', ''),
(827, 29, 'FieldsetEnd6', '--'),
(828, 29, 'Fieldset7', 'Contact Details'),
(829, 29, 'Home Address', ''),
(830, 29, 'Postal Code', ''),
(831, 29, 'Email', 'ar@gmail.com'),
(832, 29, 'Home Telephone', ''),
(833, 29, 'Pager/Handphone', '98280444'),
(834, 29, 'Type of Dwelling', '1'),
(835, 29, 'Others(Please Specify)', ''),
(836, 29, 'FieldsetEnd8', '--'),
(837, 30, 'page', '/apsn/?page_id=6'),
(838, 30, 'Fieldset1', 'Personal Details'),
(839, 30, 'Title', '2'),
(840, 30, 'First Name', 'Atif '),
(841, 30, 'Last Name', 'Saleem'),
(842, 30, 'Sex', '-'),
(843, 30, 'NRIC', ''),
(844, 30, 'Date', ''),
(845, 30, 'Nationality', ''),
(846, 30, 'Race', ''),
(847, 30, 'Religion', ''),
(848, 30, 'Singapore PR?', '1'),
(849, 30, 'Country of Birth', ''),
(850, 30, 'Marital Status', '1'),
(851, 30, 'NS Status', '1'),
(852, 30, 'FieldsetEnd2', '--'),
(853, 30, 'Fieldset3', 'Language'),
(854, 30, 'Written', ''),
(855, 30, 'Spoken', ''),
(856, 30, 'FieldsetEnd4', '--'),
(857, 30, 'Fieldset5', 'Education'),
(858, 30, 'Highest Educational Level Attained', '1'),
(859, 30, 'Name of Diploma/Degree Attained', ''),
(860, 30, 'FieldsetEnd6', '--'),
(861, 30, 'Fieldset7', 'Contact Details'),
(862, 30, 'Home Address', ''),
(863, 30, 'Postal Code', ''),
(864, 30, 'Email', 'ar@gmail.com'),
(865, 30, 'Home Telephone', ''),
(866, 30, 'Pager/Handphone', '98280444'),
(867, 30, 'Type of Dwelling', '1'),
(868, 30, 'Others(Please Specify)', ''),
(869, 30, 'FieldsetEnd8', '--'),
(870, 31, 'page', '/apsn/?page_id=6'),
(871, 31, 'Fieldset1', 'Occupation'),
(872, 31, 'Name of Employer/Company', 'APSN'),
(873, 31, 'Workplace Address', ''),
(874, 31, 'Postal Code', ''),
(875, 31, 'Office Number', ''),
(876, 31, 'Fax Number', ''),
(877, 31, 'FieldsetEnd2', '--'),
(878, 32, 'page', '/apsn/?page_id=6'),
(879, 32, 'Fieldset1', 'Volunteering'),
(880, 32, 'Previous Volunteering Experience', '0'),
(881, 32, 'If yes, please specify the name of the organization', ''),
(882, 32, 'Special Skills and Talents to contribute', ''),
(883, 32, 'Fieldset2', 'Areas of Interest'),
(884, 32, 'Children', '-'),
(885, 32, 'Youth', '-'),
(886, 32, 'Adults', '-'),
(887, 32, 'instructional (eg cooking lessons, arts)', '-'),
(888, 32, 'Please provide details', ''),
(889, 32, 'Organizing Activities', '-'),
(890, 32, 'Admin/Instructional Support', '-'),
(891, 32, 'Others (please specify)', ''),
(892, 32, 'FieldsetEnd3', '--'),
(893, 32, 'Availability for routine regular school activities', '1'),
(894, 32, 'FieldsetEnd4', '--'),
(895, 33, 'page', '/apsn/?page_id=6'),
(896, 33, 'Fieldset1', 'Personal Details'),
(897, 33, 'Title', '2'),
(898, 33, 'First Name', 'Atif '),
(899, 33, 'Last Name', 'Saleem'),
(900, 33, 'Sex', '-'),
(901, 33, 'NRIC', ''),
(902, 33, 'Date', ''),
(903, 33, 'Nationality', ''),
(904, 33, 'Race', ''),
(905, 33, 'Religion', ''),
(906, 33, 'Singapore PR?', '1'),
(907, 33, 'Country of Birth', ''),
(908, 33, 'Marital Status', '1'),
(909, 33, 'NS Status', '1'),
(910, 33, 'FieldsetEnd2', '--'),
(911, 33, 'Fieldset3', 'Language'),
(912, 33, 'Written', ''),
(913, 33, 'Spoken', ''),
(914, 33, 'FieldsetEnd4', '--'),
(915, 33, 'Fieldset5', 'Education'),
(916, 33, 'Highest Educational Level Attained', '1'),
(917, 33, 'Name of Diploma/Degree Attained', ''),
(918, 33, 'FieldsetEnd6', '--'),
(919, 33, 'Fieldset7', 'Contact Details'),
(920, 33, 'Home Address', ''),
(921, 33, 'Postal Code', ''),
(922, 33, 'Email', 'ar@gmail.com'),
(923, 33, 'Home Telephone', ''),
(924, 33, 'Pager/Handphone', '98280444'),
(925, 33, 'Type of Dwelling', '1'),
(926, 33, 'Others(Please Specify)', ''),
(927, 33, 'FieldsetEnd8', '--'),
(928, 33, 'Fieldset1', 'Occupation'),
(929, 33, 'Name of Employer/Company', 'APSN'),
(930, 33, 'Workplace Address', ''),
(931, 33, 'Postal Code', ''),
(932, 33, 'Office Number', ''),
(933, 33, 'Fax Number', ''),
(934, 33, 'FieldsetEnd2', '--'),
(935, 33, 'Fieldset1', 'Volunteering'),
(936, 33, 'Previous Volunteering Experience', '0'),
(937, 33, 'If yes, please specify the name of the organization', ''),
(938, 33, 'Special Skills and Talents to contribute', ''),
(939, 33, 'Fieldset2', 'Areas of Interest'),
(940, 33, 'Children', '-'),
(941, 33, 'Youth', '-'),
(942, 33, 'Adults', '-'),
(943, 33, 'instructional (eg cooking lessons, arts)', '-'),
(944, 33, 'Please provide details', ''),
(945, 33, 'Organizing Activities', '-'),
(946, 33, 'Admin/Instructional Support', '-'),
(947, 33, 'Others (please specify)', ''),
(948, 33, 'FieldsetEnd3', '--'),
(949, 33, 'Availability for routine regular school activities', '1'),
(950, 33, 'FieldsetEnd4', '--'),
(951, 33, 'Fieldset1', 'Declarations'),
(952, 33, 'Have you been convicted or charged in a court of law in any country ?', '1'),
(953, 34, 'page', '/apsn/?page_id=6'),
(954, 34, 'Fieldset1', 'Personal Details'),
(955, 34, 'Title', '2'),
(956, 34, 'First Name', 'Rick'),
(957, 34, 'Last Name', 'Lim'),
(958, 34, 'Sex', '1'),
(959, 34, 'NRIC', ''),
(960, 34, 'Date', ''),
(961, 34, 'Nationality', ''),
(962, 34, 'Race', ''),
(963, 34, 'Religion', ''),
(964, 34, 'Singapore PR?', '1'),
(965, 34, 'Country of Birth', ''),
(966, 34, 'Marital Status', '1'),
(967, 34, 'NS Status', '1'),
(968, 34, 'FieldsetEnd2', '--'),
(969, 34, 'Fieldset3', 'Language'),
(970, 34, 'Written', ''),
(971, 34, 'Spoken', ''),
(972, 34, 'FieldsetEnd4', '--'),
(973, 34, 'Fieldset5', 'Education'),
(974, 34, 'Highest Educational Level Attained', '1'),
(975, 34, 'Name of Diploma/Degree Attained', ''),
(976, 34, 'FieldsetEnd6', '--'),
(977, 34, 'Fieldset7', 'Contact Details'),
(978, 34, 'Home Address', ''),
(979, 34, 'Postal Code', ''),
(980, 34, 'Email', 'atif.saleem@me.com'),
(981, 34, 'Home Telephone', ''),
(982, 34, 'Pager/Handphone', '98280444'),
(983, 34, 'Type of Dwelling', '1'),
(984, 34, 'Others(Please Specify)', ''),
(985, 34, 'FieldsetEnd8', '--'),
(986, 35, 'page', '/apsn/?page_id=6'),
(987, 35, 'Fieldset1', 'Occupation'),
(988, 35, 'Name of Employer/Company', 'APSN'),
(989, 35, 'Workplace Address', ''),
(990, 35, 'Postal Code', ''),
(991, 35, 'Office Number', ''),
(992, 35, 'Fax Number', ''),
(993, 35, 'FieldsetEnd2', '--'),
(994, 36, 'page', '/apsn/?page_id=6'),
(995, 36, 'Fieldset1', 'Volunteering'),
(996, 36, 'Previous Volunteering Experience', '1'),
(997, 36, 'If yes, please specify the name of the organization', ''),
(998, 36, 'Special Skills and Talents to contribute', ''),
(999, 36, 'Fieldset2', 'Areas of Interest'),
(1000, 36, 'Children', '-'),
(1001, 36, 'Youth', '-'),
(1002, 36, 'Adults', 'on'),
(1003, 36, 'instructional (eg cooking lessons, arts)', 'on'),
(1004, 36, 'Please provide details', ''),
(1005, 36, 'Organizing Activities', 'on'),
(1006, 36, 'Admin/Instructional Support', 'on'),
(1007, 36, 'Others (please specify)', ''),
(1008, 36, 'FieldsetEnd3', '--'),
(1009, 36, 'Availability for routine regular school activities', '1'),
(1010, 36, 'FieldsetEnd4', '--'),
(1011, 37, 'page', '/apsn/?page_id=6'),
(1012, 37, 'Fieldset1', 'Personal Details'),
(1013, 37, 'Title', '2'),
(1014, 37, 'First Name', 'Rick'),
(1015, 37, 'Last Name', 'Lim'),
(1016, 37, 'Sex', '1'),
(1017, 37, 'NRIC', ''),
(1018, 37, 'Date', ''),
(1019, 37, 'Nationality', ''),
(1020, 37, 'Race', ''),
(1021, 37, 'Religion', ''),
(1022, 37, 'Singapore PR?', '1'),
(1023, 37, 'Country of Birth', ''),
(1024, 37, 'Marital Status', '1'),
(1025, 37, 'NS Status', '1'),
(1026, 37, 'FieldsetEnd2', '--'),
(1027, 37, 'Fieldset3', 'Language'),
(1028, 37, 'Written', ''),
(1029, 37, 'Spoken', ''),
(1030, 37, 'FieldsetEnd4', '--'),
(1031, 37, 'Fieldset5', 'Education'),
(1032, 37, 'Highest Educational Level Attained', '1'),
(1033, 37, 'Name of Diploma/Degree Attained', ''),
(1034, 37, 'FieldsetEnd6', '--'),
(1035, 37, 'Fieldset7', 'Contact Details'),
(1036, 37, 'Home Address', ''),
(1037, 37, 'Postal Code', ''),
(1038, 37, 'Email', 'atif.saleem@me.com'),
(1039, 37, 'Home Telephone', ''),
(1040, 37, 'Pager/Handphone', '98280444'),
(1041, 37, 'Type of Dwelling', '1'),
(1042, 37, 'Others(Please Specify)', ''),
(1043, 37, 'FieldsetEnd8', '--'),
(1044, 37, 'Fieldset1', 'Occupation'),
(1045, 37, 'Name of Employer/Company', 'APSN'),
(1046, 37, 'Workplace Address', ''),
(1047, 37, 'Postal Code', ''),
(1048, 37, 'Office Number', ''),
(1049, 37, 'Fax Number', ''),
(1050, 37, 'FieldsetEnd2', '--'),
(1051, 37, 'Fieldset1', 'Volunteering'),
(1052, 37, 'Previous Volunteering Experience', '1'),
(1053, 37, 'If yes, please specify the name of the organization', ''),
(1054, 37, 'Special Skills and Talents to contribute', ''),
(1055, 37, 'Fieldset2', 'Areas of Interest'),
(1056, 37, 'Children', '-'),
(1057, 37, 'Youth', '-'),
(1058, 37, 'Adults', 'on'),
(1059, 37, 'instructional (eg cooking lessons, arts)', 'on'),
(1060, 37, 'Please provide details', ''),
(1061, 37, 'Organizing Activities', 'on'),
(1062, 37, 'Admin/Instructional Support', 'on'),
(1063, 37, 'Others (please specify)', ''),
(1064, 37, 'FieldsetEnd3', '--'),
(1065, 37, 'Availability for routine regular school activities', '1'),
(1066, 37, 'FieldsetEnd4', '--'),
(1067, 37, 'Fieldset1', 'Declarations'),
(1068, 37, 'Have you been convicted or charged in a court of law in any country ?', '1');

-- --------------------------------------------------------

--
-- Table structure for table `wp_cformssubmissions`
--

CREATE TABLE IF NOT EXISTS `wp_cformssubmissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` varchar(3) DEFAULT '',
  `sub_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(40) DEFAULT '',
  `ip` varchar(15) DEFAULT '',
  `approved` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `wp_cformssubmissions`
--

INSERT INTO `wp_cformssubmissions` (`id`, `form_id`, `sub_date`, `email`, `ip`, `approved`) VALUES
(4, '', '2011-11-10 23:59:32', 'ww@ww.com', '::1', 0),
(5, '2', '2011-11-10 23:59:32', 'ww@ww.com', '::1', 0),
(6, '3', '2011-11-10 23:59:32', 'ww@ww.com', '::1', 0),
(8, '', '2011-11-10 23:59:32', 'athifsaleem@gmail.com', '127.0.0.1', 0),
(9, '', '2011-11-10 23:59:32', '007bond@president.pluto.com', '127.0.0.1', 0),
(10, '2', '2011-11-10 23:59:32', '007bond@president.pluto.com', '127.0.0.1', 0),
(11, '3', '2011-11-10 23:59:32', '007bond@president.pluto.com', '127.0.0.1', 0),
(12, '4', '2011-11-10 23:59:32', '007bond@president.pluto.com', '127.0.0.1', 0),
(13, '', '2011-11-10 23:59:32', 'chillinout@gmail.com', '127.0.0.1', 0),
(14, '2', '2011-11-10 23:59:32', 'chillinout@gmail.com', '127.0.0.1', 0),
(15, '3', '2011-11-10 23:59:32', 'chillinout@gmail.com', '127.0.0.1', 0),
(16, '4', '2011-11-10 23:59:32', 'chillinout@gmail.com', '127.0.0.1', 0),
(17, '', '2011-11-10 23:59:32', 'anshu@gmail.com', '127.0.0.1', 0),
(18, '2', '2011-11-10 23:59:32', 'anshu@gmail.com', '127.0.0.1', 0),
(19, '3', '2011-11-10 23:59:32', 'anshu@gmail.com', '127.0.0.1', 0),
(20, '4', '2011-11-10 23:59:32', 'anshu@gmail.com', '127.0.0.1', 0),
(21, '', '2011-11-10 23:59:32', 'akhand@gmail.com', '127.0.0.1', 0),
(22, '2', '2011-11-10 23:59:32', 'akhand@gmail.com', '127.0.0.1', 0),
(23, '3', '2011-11-10 23:59:32', 'akhand@gmail.com', '127.0.0.1', 0),
(24, '4', '2011-11-10 23:59:32', 'akhand@gmail.com', '127.0.0.1', 0),
(25, '', '2011-11-11 00:13:41', 'atif1@e.ntu.edu.sg', '127.0.0.1', 1),
(26, '2', '2011-11-11 00:13:41', 'atif1@e.ntu.edu.sg', '127.0.0.1', 1),
(27, '3', '2011-11-11 00:13:41', 'atif1@e.ntu.edu.sg', '127.0.0.1', 1),
(28, '4', '2011-11-11 00:13:41', 'atif1@e.ntu.edu.sg', '127.0.0.1', 1),
(29, '', '2011-11-10 23:59:32', 'ar@gmail.com', '127.0.0.1', 0),
(30, '', '2011-11-10 23:59:32', 'ar@gmail.com', '127.0.0.1', 0),
(31, '2', '2011-11-10 23:59:32', 'ar@gmail.com', '127.0.0.1', 0),
(32, '3', '2011-11-10 23:59:32', 'ar@gmail.com', '127.0.0.1', 0),
(33, '4', '2011-11-10 23:59:32', 'ar@gmail.com', '127.0.0.1', 0),
(34, '', '2011-11-11 01:53:12', 'atif.saleem@me.com', '127.0.0.1', 1),
(35, '2', '2011-11-11 01:53:12', 'atif.saleem@me.com', '127.0.0.1', 1),
(36, '3', '2011-11-11 01:53:12', 'atif.saleem@me.com', '127.0.0.1', 1),
(37, '4', '2011-11-11 01:53:12', 'atif.saleem@me.com', '127.0.0.1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_commentmeta`
--

CREATE TABLE IF NOT EXISTS `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_comments`
--

CREATE TABLE IF NOT EXISTS `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_approved` (`comment_approved`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `wp_comments`
--

INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'Mr WordPress', '', 'http://wordpress.org/', '', '2011-09-30 02:34:08', '2011-09-30 02:34:08', 'Hi, this is a comment.<br />To delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.', 0, 'post-trashed', '', '', 0, 0),
(2, 2, 'Atif', 'athifsaleem@gmail.com', 'http://san.com', '127.0.0.1', '2011-11-02 18:12:14', '2011-11-02 18:12:14', 'HEY YA!', 0, '0', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/534.51.22 (KHTML, like Gecko) Version/5.1.1 Safari/534.51.22', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_answer`
--

CREATE TABLE IF NOT EXISTS `wp_events_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_id` varchar(23) NOT NULL,
  `attendee_id` int(11) NOT NULL DEFAULT '0',
  `question_id` int(11) NOT NULL DEFAULT '0',
  `answer` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `registration_id` (`registration_id`),
  KEY `attendee_id` (`attendee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `wp_events_answer`
--

INSERT INTO `wp_events_answer` (`id`, `registration_id`, `attendee_id`, `question_id`, `answer`) VALUES
(1, '4eb569856d8312.66590467', 1, 1, 'Akhand Pratap '),
(2, '4eb569856d8312.66590467', 1, 2, 'Singh'),
(3, '4eb569856d8312.66590467', 1, 3, 'birlaakhand@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_attendee`
--

CREATE TABLE IF NOT EXISTS `wp_events_attendee` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `registration_id` varchar(23) DEFAULT '0',
  `lname` varchar(45) DEFAULT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip` varchar(45) DEFAULT NULL,
  `country_id` varchar(128) DEFAULT NULL,
  `organization_name` varchar(50) DEFAULT NULL,
  `vat_number` varchar(20) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment` varchar(45) DEFAULT NULL,
  `payment_status` varchar(45) DEFAULT 'Incomplete',
  `txn_type` varchar(45) DEFAULT NULL,
  `txn_id` varchar(45) DEFAULT NULL,
  `amount_pd` decimal(20,2) DEFAULT '0.00',
  `total_cost` decimal(20,2) DEFAULT '0.00',
  `price_option` varchar(100) DEFAULT NULL,
  `coupon_code` varchar(45) DEFAULT NULL,
  `quantity` varchar(5) DEFAULT '0',
  `payment_date` varchar(45) DEFAULT NULL,
  `event_id` varchar(45) DEFAULT NULL,
  `event_time` varchar(15) DEFAULT NULL,
  `end_time` varchar(15) DEFAULT NULL,
  `start_date` varchar(45) DEFAULT NULL,
  `end_date` varchar(45) DEFAULT NULL,
  `attendee_session` varchar(250) DEFAULT NULL,
  `transaction_details` text,
  `pre_approve` int(11) DEFAULT '1',
  `checked_in` int(1) DEFAULT '0',
  `checked_in_quantity` int(11) DEFAULT '0',
  `hashSalt` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `registration_id` (`registration_id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_events_attendee`
--

INSERT INTO `wp_events_attendee` (`id`, `registration_id`, `lname`, `fname`, `address`, `address2`, `city`, `state`, `zip`, `country_id`, `organization_name`, `vat_number`, `email`, `phone`, `date`, `payment`, `payment_status`, `txn_type`, `txn_id`, `amount_pd`, `total_cost`, `price_option`, `coupon_code`, `quantity`, `payment_date`, `event_id`, `event_time`, `end_time`, `start_date`, `end_date`, `attendee_session`, `transaction_details`, `pre_approve`, `checked_in`, `checked_in_quantity`, `hashSalt`) VALUES
(1, '4eb569856d8312.66590467', 'Singh', 'Akhand Pratap ', '', '', '', '', '', '', '', NULL, 'birlaakhand@gmail.com', '', '2011-11-05 16:51:17', '', 'Completed', '', NULL, 0.00, 0.00, 'General Admission', '', '1', '11-05-2011', '1', '10:00', '20:00', '2011-11-25', '2011-11-29', 'sbekinuppgnf78k5eb3mqi5mf3', NULL, 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_attendee_cost`
--

CREATE TABLE IF NOT EXISTS `wp_events_attendee_cost` (
  `attendee_id` int(11) DEFAULT NULL,
  `cost` decimal(20,2) DEFAULT '0.00',
  `quantity` int(11) DEFAULT NULL,
  KEY `attendee_id` (`attendee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_events_attendee_cost`
--

INSERT INTO `wp_events_attendee_cost` (`attendee_id`, `cost`, `quantity`) VALUES
(1, 0.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_attendee_meta`
--

CREATE TABLE IF NOT EXISTS `wp_events_attendee_meta` (
  `ameta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `attendee_id` int(11) DEFAULT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`ameta_id`),
  KEY `attendee_id` (`attendee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_events_attendee_meta`
--

INSERT INTO `wp_events_attendee_meta` (`ameta_id`, `attendee_id`, `meta_key`, `meta_value`, `date_added`) VALUES
(1, 1, 'primary_attendee', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_category_detail`
--

CREATE TABLE IF NOT EXISTS `wp_events_category_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) DEFAULT NULL,
  `category_identifier` varchar(45) DEFAULT NULL,
  `category_desc` text,
  `display_desc` varchar(4) DEFAULT NULL,
  `wp_user` int(22) DEFAULT '1',
  UNIQUE KEY `id` (`id`),
  KEY `category_identifier` (`category_identifier`),
  KEY `wp_user` (`wp_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_category_rel`
--

CREATE TABLE IF NOT EXISTS `wp_events_category_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_detail`
--

CREATE TABLE IF NOT EXISTS `wp_events_detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_code` varchar(26) DEFAULT '0',
  `event_name` varchar(100) DEFAULT NULL,
  `event_desc` text,
  `display_desc` varchar(1) DEFAULT 'Y',
  `display_reg_form` varchar(1) DEFAULT 'Y',
  `event_identifier` varchar(75) DEFAULT NULL,
  `start_date` varchar(15) DEFAULT NULL,
  `end_date` varchar(15) DEFAULT NULL,
  `registration_start` varchar(15) DEFAULT NULL,
  `registration_end` varchar(15) DEFAULT NULL,
  `registration_startT` varchar(15) DEFAULT NULL,
  `registration_endT` varchar(15) DEFAULT NULL,
  `visible_on` varchar(15) DEFAULT NULL,
  `address` text,
  `address2` text,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(11) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `venue_title` varchar(250) DEFAULT NULL,
  `venue_url` varchar(250) DEFAULT NULL,
  `venue_image` text,
  `venue_phone` varchar(15) DEFAULT NULL,
  `virtual_url` varchar(250) DEFAULT NULL,
  `virtual_phone` varchar(15) DEFAULT NULL,
  `reg_limit` varchar(25) DEFAULT '999999',
  `allow_multiple` varchar(15) DEFAULT 'N',
  `additional_limit` int(10) DEFAULT '5',
  `send_mail` varchar(2) DEFAULT 'Y',
  `is_active` varchar(1) DEFAULT 'Y',
  `event_status` varchar(1) DEFAULT 'A',
  `conf_mail` text,
  `use_coupon_code` varchar(1) DEFAULT 'N',
  `use_groupon_code` varchar(1) DEFAULT 'N',
  `category_id` text,
  `coupon_id` text,
  `tax_percentage` float DEFAULT NULL,
  `tax_mode` int(11) DEFAULT NULL,
  `member_only` varchar(1) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `post_type` varchar(50) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `externalURL` varchar(255) DEFAULT NULL,
  `early_disc` varchar(10) DEFAULT NULL,
  `early_disc_date` varchar(15) DEFAULT NULL,
  `early_disc_percentage` varchar(1) DEFAULT 'N',
  `question_groups` longtext,
  `item_groups` longtext,
  `event_type` varchar(250) DEFAULT NULL,
  `allow_overflow` varchar(1) DEFAULT 'N',
  `overflow_event_id` int(10) DEFAULT '0',
  `recurrence_id` int(11) DEFAULT '0',
  `email_id` int(11) DEFAULT '0',
  `alt_email` text,
  `event_meta` longtext,
  `wp_user` int(22) DEFAULT '1',
  `require_pre_approval` int(11) DEFAULT '0',
  `timezone_string` varchar(250) DEFAULT NULL,
  `likes` int(22) DEFAULT NULL,
  `submitted` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_code` (`event_code`),
  KEY `wp_user` (`wp_user`),
  KEY `event_name` (`event_name`),
  KEY `city` (`city`),
  KEY `state` (`state`),
  KEY `start_date` (`start_date`),
  KEY `end_date` (`end_date`),
  KEY `registration_start` (`registration_start`),
  KEY `registration_end` (`registration_end`),
  KEY `reg_limit` (`reg_limit`),
  KEY `event_status` (`event_status`),
  KEY `recurrence_id` (`recurrence_id`),
  KEY `submitted` (`submitted`),
  KEY `likes` (`likes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_events_detail`
--

INSERT INTO `wp_events_detail` (`id`, `event_code`, `event_name`, `event_desc`, `display_desc`, `display_reg_form`, `event_identifier`, `start_date`, `end_date`, `registration_start`, `registration_end`, `registration_startT`, `registration_endT`, `visible_on`, `address`, `address2`, `city`, `state`, `zip`, `phone`, `venue_title`, `venue_url`, `venue_image`, `venue_phone`, `virtual_url`, `virtual_phone`, `reg_limit`, `allow_multiple`, `additional_limit`, `send_mail`, `is_active`, `event_status`, `conf_mail`, `use_coupon_code`, `use_groupon_code`, `category_id`, `coupon_id`, `tax_percentage`, `tax_mode`, `member_only`, `post_id`, `post_type`, `country`, `externalURL`, `early_disc`, `early_disc_date`, `early_disc_percentage`, `question_groups`, `item_groups`, `event_type`, `allow_overflow`, `overflow_event_id`, `recurrence_id`, `email_id`, `alt_email`, `event_meta`, `wp_user`, `require_pre_approval`, `timezone_string`, `likes`, `submitted`) VALUES
(1, '1-4eb566e3ac444', 'Blood Donation', '', 'Y', 'N', 'blood-donation-1-4eb566e3ac444', '2011-11-25', '2011-11-29', '2011-11-01', '2011-11-22', '00:00', '00:00', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '999', 'N', 0, 'N', 'Y', '', '', '', 'N', NULL, NULL, NULL, NULL, 'N', NULL, NULL, '', '', '', '', '', 'a:1:{i:1;s:1:"1";}', 's:0:"";', NULL, 'N', 0, 0, 0, '', 'a:5:{s:22:"default_payment_status";N;s:8:"venue_id";s:0:"";s:28:"additional_attendee_reg_info";N;s:28:"add_attendee_question_groups";s:0:"";s:14:"date_submitted";s:16:"November 5, 2011";}', 1, 0, '', NULL, '2011-11-05 16:40:03');

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_discount_codes`
--

CREATE TABLE IF NOT EXISTS `wp_events_discount_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_code` varchar(50) DEFAULT NULL,
  `coupon_code_price` decimal(20,2) DEFAULT NULL,
  `use_percentage` varchar(1) DEFAULT NULL,
  `coupon_code_description` text,
  `each_attendee` varchar(1) DEFAULT NULL,
  `wp_user` int(22) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `coupon_code` (`coupon_code`),
  KEY `wp_user` (`wp_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_discount_rel`
--

CREATE TABLE IF NOT EXISTS `wp_events_discount_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_email`
--

CREATE TABLE IF NOT EXISTS `wp_events_email` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email_name` varchar(100) DEFAULT NULL,
  `email_subject` varchar(250) DEFAULT NULL,
  `email_text` text,
  `wp_user` int(22) DEFAULT '1',
  UNIQUE KEY `id` (`id`),
  KEY `wp_user` (`wp_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_locale`
--

CREATE TABLE IF NOT EXISTS `wp_events_locale` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `identifier` varchar(26) DEFAULT '0',
  `wp_user` int(22) DEFAULT '1',
  UNIQUE KEY `id` (`id`),
  KEY `identifier` (`identifier`),
  KEY `wp_user` (`wp_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_locale_rel`
--

CREATE TABLE IF NOT EXISTS `wp_events_locale_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_id` int(11) DEFAULT NULL,
  `locale_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `venue_id` (`venue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_meta`
--

CREATE TABLE IF NOT EXISTS `wp_events_meta` (
  `emeta_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`emeta_id`),
  KEY `event_id` (`event_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_multi_event_registration_id_group`
--

CREATE TABLE IF NOT EXISTS `wp_events_multi_event_registration_id_group` (
  `primary_registration_id` varchar(255) DEFAULT NULL,
  `registration_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_personnel`
--

CREATE TABLE IF NOT EXISTS `wp_events_personnel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `role` varchar(250) DEFAULT NULL,
  `identifier` varchar(26) DEFAULT '0',
  `email` text,
  `meta` text,
  `wp_user` int(22) DEFAULT '1',
  UNIQUE KEY `id` (`id`),
  KEY `identifier` (`identifier`),
  KEY `wp_user` (`wp_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_personnel_rel`
--

CREATE TABLE IF NOT EXISTS `wp_events_personnel_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`),
  KEY `person_id` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_prices`
--

CREATE TABLE IF NOT EXISTS `wp_events_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `price_type` varchar(50) DEFAULT NULL,
  `event_cost` decimal(20,2) NOT NULL DEFAULT '0.00',
  `surcharge` decimal(10,2) NOT NULL DEFAULT '0.00',
  `surcharge_type` varchar(10) DEFAULT NULL,
  `member_price_type` varchar(50) DEFAULT NULL,
  `member_price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `max_qty` int(7) DEFAULT '0',
  `max_qty_members` int(7) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `wp_events_prices`
--

INSERT INTO `wp_events_prices` (`id`, `event_id`, `price_type`, `event_cost`, `surcharge`, `surcharge_type`, `member_price_type`, `member_price`, `max_qty`, `max_qty_members`) VALUES
(2, 1, 'General Admission', 0.00, 0.00, 'flat_rate', 'Members Admission', 0.00, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_qst_group`
--

CREATE TABLE IF NOT EXISTS `wp_events_qst_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL DEFAULT 'NULL',
  `group_identifier` varchar(45) NOT NULL DEFAULT 'NULL',
  `group_description` text,
  `group_order` int(11) DEFAULT '0',
  `show_group_name` tinyint(1) NOT NULL DEFAULT '1',
  `show_group_description` tinyint(1) NOT NULL DEFAULT '1',
  `system_group` tinyint(1) NOT NULL DEFAULT '0',
  `wp_user` int(22) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `system_group` (`system_group`),
  KEY `wp_user` (`wp_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `wp_events_qst_group`
--

INSERT INTO `wp_events_qst_group` (`id`, `group_name`, `group_identifier`, `group_description`, `group_order`, `show_group_name`, `show_group_description`, `system_group`, `wp_user`) VALUES
(1, 'Personal Information', 'personal_information-1320510301', NULL, 0, 1, 1, 1, 1),
(2, 'Address Information', 'address_information-1320510301', NULL, 0, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_qst_group_rel`
--

CREATE TABLE IF NOT EXISTS `wp_events_qst_group_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `wp_events_qst_group_rel`
--

INSERT INTO `wp_events_qst_group_rel` (`id`, `group_id`, `question_id`) VALUES
(1, 1, 3),
(2, 1, 1),
(3, 1, 2),
(4, 2, 4),
(5, 2, 6),
(6, 2, 7),
(7, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_question`
--

CREATE TABLE IF NOT EXISTS `wp_events_question` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sequence` int(11) NOT NULL DEFAULT '0',
  `question_type` enum('TEXT','TEXTAREA','MULTIPLE','SINGLE','DROPDOWN') NOT NULL DEFAULT 'TEXT',
  `question` text NOT NULL,
  `system_name` varchar(15) DEFAULT NULL,
  `response` text,
  `required` enum('Y','N') NOT NULL DEFAULT 'N',
  `required_text` text,
  `admin_only` enum('Y','N') NOT NULL DEFAULT 'N',
  `wp_user` int(22) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `wp_user` (`wp_user`),
  KEY `system_name` (`system_name`),
  KEY `admin_only` (`admin_only`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `wp_events_question`
--

INSERT INTO `wp_events_question` (`id`, `sequence`, `question_type`, `question`, `system_name`, `response`, `required`, `required_text`, `admin_only`, `wp_user`) VALUES
(1, 0, 'TEXT', 'First Name', 'fname', NULL, 'Y', NULL, 'N', 1),
(2, 1, 'TEXT', 'Last Name', 'lname', NULL, 'Y', NULL, 'N', 1),
(3, 2, 'TEXT', 'Email', 'email', NULL, 'Y', NULL, 'N', 1),
(4, 3, 'TEXT', 'Address', 'address', NULL, 'N', NULL, 'N', 1),
(5, 3, 'TEXT', 'Address 2', 'address2', NULL, 'N', NULL, 'N', 1),
(6, 4, 'TEXT', 'City', 'city', NULL, 'N', NULL, 'N', 1),
(7, 5, 'TEXT', 'State', 'state', NULL, 'N', NULL, 'N', 1),
(8, 6, 'TEXT', 'Zip', 'zip', NULL, 'N', NULL, 'N', 1),
(9, 6, 'TEXT', 'Country', 'country', NULL, 'N', NULL, 'N', 1),
(10, 7, 'TEXT', 'Phone', 'phone', NULL, 'N', NULL, 'N', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_seating_chart`
--

CREATE TABLE IF NOT EXISTS `wp_events_seating_chart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `image_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_seating_chart_event`
--

CREATE TABLE IF NOT EXISTS `wp_events_seating_chart_event` (
  `event_id` int(11) DEFAULT NULL,
  `seating_chart_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_seating_chart_event_seat`
--

CREATE TABLE IF NOT EXISTS `wp_events_seating_chart_event_seat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seat_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `attendee_id` int(11) DEFAULT NULL,
  `purchase_price` float DEFAULT NULL,
  `purchase_datetime` datetime DEFAULT '0000-00-00 00:00:00',
  `by_admin` int(11) DEFAULT '0' COMMENT '0=No,1=marked occupied by admin',
  `occupied` int(11) DEFAULT '1' COMMENT '0=Free,1=occupied (basically entry in this table means occupied, but still keeping this option for any future functionality)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_seating_chart_seat`
--

CREATE TABLE IF NOT EXISTS `wp_events_seating_chart_seat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seating_chart_id` int(11) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `row` varchar(255) DEFAULT NULL,
  `seat` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `member_price` float DEFAULT NULL,
  `custom_tag` text,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_start_end`
--

CREATE TABLE IF NOT EXISTS `wp_events_start_end` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `start_time` varchar(10) DEFAULT NULL,
  `end_time` varchar(10) DEFAULT NULL,
  `reg_limit` int(15) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_events_start_end`
--

INSERT INTO `wp_events_start_end` (`id`, `event_id`, `start_time`, `end_time`, `reg_limit`) VALUES
(1, 1, '10:00', '20:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_venue`
--

CREATE TABLE IF NOT EXISTS `wp_events_venue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `identifier` varchar(26) DEFAULT '0',
  `address` varchar(250) DEFAULT NULL,
  `address2` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `state` varchar(250) DEFAULT NULL,
  `zip` varchar(250) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `meta` text,
  `wp_user` int(22) DEFAULT '1',
  UNIQUE KEY `id` (`id`),
  KEY `identifier` (`identifier`),
  KEY `wp_user` (`wp_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_events_venue_rel`
--

CREATE TABLE IF NOT EXISTS `wp_events_venue_rel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `venue_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_formbuilder_fields`
--

CREATE TABLE IF NOT EXISTS `wp_formbuilder_fields` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `form_id` bigint(20) NOT NULL DEFAULT '0',
  `display_order` int(11) NOT NULL DEFAULT '0',
  `field_type` varchar(255) NOT NULL DEFAULT '',
  `field_name` varchar(255) NOT NULL DEFAULT '',
  `field_value` text NOT NULL,
  `field_label` text NOT NULL,
  `required_data` varchar(255) NOT NULL DEFAULT '',
  `error_message` text NOT NULL,
  `help_text` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `wp_formbuilder_fields`
--

INSERT INTO `wp_formbuilder_fields` (`id`, `form_id`, `display_order`, `field_type`, `field_name`, `field_value`, `field_label`, `required_data`, `error_message`, `help_text`) VALUES
(1, 1, 1, 'single line text box', 'Name', '', 'Name', 'any text', 'You must enter your name.', ''),
(2, 1, 2, 'single line text box', 'Email', '', 'Email', 'email address', 'You must enter your email address.', ''),
(3, 1, 3, 'large text area', 'Comments', '', 'Comments', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `wp_formbuilder_forms`
--

CREATE TABLE IF NOT EXISTS `wp_formbuilder_forms` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `subject` text NOT NULL,
  `recipient` text NOT NULL,
  `method` enum('POST','GET') NOT NULL DEFAULT 'POST',
  `action` varchar(255) NOT NULL DEFAULT '',
  `thankyoutext` text NOT NULL,
  `autoresponse` bigint(20) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wp_formbuilder_forms`
--

INSERT INTO `wp_formbuilder_forms` (`id`, `name`, `subject`, `recipient`, `method`, `action`, `thankyoutext`, `autoresponse`) VALUES
(1, 'A New Form', 'Generic Website Feedback Form', 'athifsaleem@gmail.com', 'POST', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_formbuilder_pages`
--

CREATE TABLE IF NOT EXISTS `wp_formbuilder_pages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL DEFAULT '0',
  `form_id` bigint(20) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_formbuilder_responses`
--

CREATE TABLE IF NOT EXISTS `wp_formbuilder_responses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `from_name` varchar(255) NOT NULL DEFAULT '',
  `from_email` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_formbuilder_results`
--

CREATE TABLE IF NOT EXISTS `wp_formbuilder_results` (
  `id` bigint(20) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `form_id` bigint(20) unsigned zerofill NOT NULL DEFAULT '00000000000000000000',
  `timestamp` bigint(20) unsigned zerofill NOT NULL,
  `xmldata` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_formbuilder_tags`
--

CREATE TABLE IF NOT EXISTS `wp_formbuilder_tags` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `form_id` bigint(20) NOT NULL,
  `tag` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_links`
--

CREATE TABLE IF NOT EXISTS `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `wp_links`
--

INSERT INTO `wp_links` (`link_id`, `link_url`, `link_name`, `link_image`, `link_target`, `link_description`, `link_visible`, `link_owner`, `link_rating`, `link_updated`, `link_rel`, `link_notes`, `link_rss`) VALUES
(1, 'http://codex.wordpress.org/', 'Documentation', '', '', '', 'Y', 1, 0, '0000-00-00 00:00:00', '', '', ''),
(2, 'http://wordpress.org/news/', 'WordPress Blog', '', '', '', 'Y', 1, 0, '0000-00-00 00:00:00', '', '', 'http://wordpress.org/news/feed/'),
(3, 'http://wordpress.org/extend/ideas/', 'Suggest Ideas', '', '', '', 'Y', 1, 0, '0000-00-00 00:00:00', '', '', ''),
(4, 'http://wordpress.org/support/', 'Support Forum', '', '', '', 'Y', 1, 0, '0000-00-00 00:00:00', '', '', ''),
(5, 'http://wordpress.org/extend/plugins/', 'Plugins', '', '', '', 'Y', 1, 0, '0000-00-00 00:00:00', '', '', ''),
(6, 'http://wordpress.org/extend/themes/', 'Themes', '', '', '', 'Y', 1, 0, '0000-00-00 00:00:00', '', '', ''),
(7, 'http://planet.wordpress.org/', 'WordPress Planet', '', '', '', 'Y', 1, 0, '0000-00-00 00:00:00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `wp_options`
--

CREATE TABLE IF NOT EXISTS `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=492 ;

--
-- Dumping data for table `wp_options`
--

INSERT INTO `wp_options` (`option_id`, `blog_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 0, 'siteurl', 'http://localhost/apsn', 'yes'),
(2, 0, 'blogname', 'APSN', 'yes'),
(3, 0, 'blogdescription', 'Just another WordPress site', 'yes'),
(4, 0, 'users_can_register', '1', 'yes'),
(5, 0, 'admin_email', 'athifsaleem@gmail.com', 'yes'),
(6, 0, 'start_of_week', '1', 'yes'),
(7, 0, 'use_balanceTags', '0', 'yes'),
(8, 0, 'use_smilies', '1', 'yes'),
(9, 0, 'require_name_email', '1', 'yes'),
(10, 0, 'comments_notify', '1', 'yes'),
(11, 0, 'posts_per_rss', '10', 'yes'),
(12, 0, 'rss_use_excerpt', '0', 'yes'),
(13, 0, 'mailserver_url', 'mail.example.com', 'yes'),
(14, 0, 'mailserver_login', 'login@example.com', 'yes'),
(15, 0, 'mailserver_pass', 'password', 'yes'),
(16, 0, 'mailserver_port', '110', 'yes'),
(17, 0, 'default_category', '1', 'yes'),
(18, 0, 'default_comment_status', 'open', 'yes'),
(19, 0, 'default_ping_status', 'open', 'yes'),
(20, 0, 'default_pingback_flag', '0', 'yes'),
(21, 0, 'default_post_edit_rows', '20', 'yes'),
(22, 0, 'posts_per_page', '10', 'yes'),
(23, 0, 'date_format', 'F j, Y', 'yes'),
(24, 0, 'time_format', 'g:i a', 'yes'),
(25, 0, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(26, 0, 'links_recently_updated_prepend', '<em>', 'yes'),
(27, 0, 'links_recently_updated_append', '</em>', 'yes'),
(28, 0, 'links_recently_updated_time', '120', 'yes'),
(29, 0, 'comment_moderation', '0', 'yes'),
(30, 0, 'moderation_notify', '1', 'yes'),
(31, 0, 'permalink_structure', '', 'yes'),
(32, 0, 'gzipcompression', '0', 'yes'),
(33, 0, 'hack_file', '0', 'yes'),
(34, 0, 'blog_charset', 'UTF-8', 'yes'),
(35, 0, 'moderation_keys', '', 'no'),
(36, 0, 'active_plugins', 'a:3:{i:0;s:17:"cforms/cforms.php";i:1;s:53:"contexture-page-security/contexture-page-security.php";i:2;s:33:"theme-my-login/theme-my-login.php";}', 'yes'),
(37, 0, 'home', 'http://localhost/apsn', 'yes'),
(38, 0, 'category_base', '', 'yes'),
(39, 0, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(40, 0, 'advanced_edit', '0', 'yes'),
(41, 0, 'comment_max_links', '2', 'yes'),
(42, 0, 'gmt_offset', '0', 'yes'),
(43, 0, 'default_email_category', '1', 'yes'),
(44, 0, 'recently_edited', 'a:2:{i:0;s:83:"/Applications/XAMPP/xamppfiles/htdocs/apsn/wp-content/themes/twentyeleven/style.css";i:1;s:0:"";}', 'no'),
(45, 0, 'template', 'twentyeleven', 'yes'),
(46, 0, 'stylesheet', 'twentyeleven', 'yes'),
(47, 0, 'comment_whitelist', '1', 'yes'),
(48, 0, 'blacklist_keys', '', 'no'),
(49, 0, 'comment_registration', '0', 'yes'),
(50, 0, 'rss_language', 'en', 'yes'),
(51, 0, 'html_type', 'text/html', 'yes'),
(52, 0, 'use_trackback', '0', 'yes'),
(53, 0, 'default_role', 'subscriber', 'yes'),
(54, 0, 'db_version', '18226', 'yes'),
(55, 0, 'uploads_use_yearmonth_folders', '1', 'yes'),
(56, 0, 'upload_path', '', 'yes'),
(57, 0, 'blog_public', '0', 'yes'),
(58, 0, 'default_link_category', '2', 'yes'),
(59, 0, 'show_on_front', 'posts', 'yes'),
(60, 0, 'tag_base', '', 'yes'),
(61, 0, 'show_avatars', '1', 'yes'),
(62, 0, 'avatar_rating', 'G', 'yes'),
(63, 0, 'upload_url_path', '', 'yes'),
(64, 0, 'thumbnail_size_w', '150', 'yes'),
(65, 0, 'thumbnail_size_h', '150', 'yes'),
(66, 0, 'thumbnail_crop', '1', 'yes'),
(67, 0, 'medium_size_w', '300', 'yes'),
(68, 0, 'medium_size_h', '300', 'yes'),
(69, 0, 'avatar_default', 'mystery', 'yes'),
(70, 0, 'enable_app', '0', 'yes'),
(71, 0, 'enable_xmlrpc', '0', 'yes'),
(72, 0, 'large_size_w', '1024', 'yes'),
(73, 0, 'large_size_h', '1024', 'yes'),
(74, 0, 'image_default_link_type', 'file', 'yes'),
(75, 0, 'image_default_size', '', 'yes'),
(76, 0, 'image_default_align', '', 'yes'),
(77, 0, 'close_comments_for_old_posts', '0', 'yes'),
(78, 0, 'close_comments_days_old', '14', 'yes'),
(79, 0, 'thread_comments', '1', 'yes'),
(80, 0, 'thread_comments_depth', '5', 'yes'),
(81, 0, 'page_comments', '0', 'yes'),
(82, 0, 'comments_per_page', '50', 'yes'),
(83, 0, 'default_comments_page', 'newest', 'yes'),
(84, 0, 'comment_order', 'asc', 'yes'),
(85, 0, 'sticky_posts', 'a:0:{}', 'yes'),
(86, 0, 'widget_categories', 'a:2:{i:2;a:4:{s:5:"title";s:0:"";s:5:"count";i:0;s:12:"hierarchical";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(87, 0, 'widget_text', 'a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(88, 0, 'widget_rss', 'a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(89, 0, 'timezone_string', '', 'yes'),
(90, 0, 'embed_autourls', '1', 'yes'),
(91, 0, 'embed_size_w', '', 'yes'),
(92, 0, 'embed_size_h', '600', 'yes'),
(93, 0, 'page_for_posts', '0', 'yes'),
(94, 0, 'page_on_front', '0', 'yes'),
(95, 0, 'default_post_format', '0', 'yes'),
(96, 0, 'wp_user_roles', 'a:6:{s:13:"administrator";a:2:{s:4:"name";s:13:"Administrator";s:12:"capabilities";a:64:{s:13:"switch_themes";b:1;s:11:"edit_themes";b:1;s:16:"activate_plugins";b:1;s:12:"edit_plugins";b:1;s:10:"edit_users";b:1;s:10:"edit_files";b:1;s:14:"manage_options";b:1;s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:6:"import";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:8:"level_10";b:1;s:7:"level_9";b:1;s:7:"level_8";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;s:12:"delete_users";b:1;s:12:"create_users";b:1;s:17:"unfiltered_upload";b:1;s:14:"edit_dashboard";b:1;s:14:"update_plugins";b:1;s:14:"delete_plugins";b:1;s:15:"install_plugins";b:1;s:13:"update_themes";b:1;s:14:"install_themes";b:1;s:11:"update_core";b:1;s:10:"list_users";b:1;s:12:"remove_users";b:1;s:9:"add_users";b:1;s:13:"promote_users";b:1;s:18:"edit_theme_options";b:1;s:13:"delete_themes";b:1;s:6:"export";b:1;s:13:"manage_cforms";b:1;s:12:"track_cforms";b:1;}}s:6:"editor";a:2:{s:4:"name";s:6:"Editor";s:12:"capabilities";a:34:{s:17:"moderate_comments";b:1;s:17:"manage_categories";b:1;s:12:"manage_links";b:1;s:12:"upload_files";b:1;s:15:"unfiltered_html";b:1;s:10:"edit_posts";b:1;s:17:"edit_others_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:10:"edit_pages";b:1;s:4:"read";b:1;s:7:"level_7";b:1;s:7:"level_6";b:1;s:7:"level_5";b:1;s:7:"level_4";b:1;s:7:"level_3";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:17:"edit_others_pages";b:1;s:20:"edit_published_pages";b:1;s:13:"publish_pages";b:1;s:12:"delete_pages";b:1;s:19:"delete_others_pages";b:1;s:22:"delete_published_pages";b:1;s:12:"delete_posts";b:1;s:19:"delete_others_posts";b:1;s:22:"delete_published_posts";b:1;s:20:"delete_private_posts";b:1;s:18:"edit_private_posts";b:1;s:18:"read_private_posts";b:1;s:20:"delete_private_pages";b:1;s:18:"edit_private_pages";b:1;s:18:"read_private_pages";b:1;}}s:6:"author";a:2:{s:4:"name";s:6:"Author";s:12:"capabilities";a:10:{s:12:"upload_files";b:1;s:10:"edit_posts";b:1;s:20:"edit_published_posts";b:1;s:13:"publish_posts";b:1;s:4:"read";b:1;s:7:"level_2";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;s:22:"delete_published_posts";b:1;}}s:11:"contributor";a:2:{s:4:"name";s:11:"Contributor";s:12:"capabilities";a:5:{s:10:"edit_posts";b:1;s:4:"read";b:1;s:7:"level_1";b:1;s:7:"level_0";b:1;s:12:"delete_posts";b:1;}}s:10:"subscriber";a:2:{s:4:"name";s:10:"Subscriber";s:12:"capabilities";a:2:{s:4:"read";b:1;s:7:"level_0";b:1;}}s:7:"pending";a:2:{s:4:"name";s:7:"Pending";s:12:"capabilities";a:0:{}}}', 'yes'),
(97, 0, 'widget_search', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(98, 0, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(99, 0, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:"title";s:0:"";s:6:"number";i:5;}s:12:"_multiwidget";i:1;}', 'yes'),
(100, 0, 'widget_archives', 'a:2:{i:2;a:3:{s:5:"title";s:0:"";s:5:"count";i:0;s:8:"dropdown";i:0;}s:12:"_multiwidget";i:1;}', 'yes'),
(101, 0, 'widget_meta', 'a:2:{i:2;a:1:{s:5:"title";s:0:"";}s:12:"_multiwidget";i:1;}', 'yes'),
(102, 0, 'sidebars_widgets', 'a:2:{s:19:"wp_inactive_widgets";a:16:{i:0;s:7:"pages-2";i:1;s:10:"calendar-2";i:2;s:7:"links-2";i:3;s:6:"text-2";i:4;s:5:"rss-2";i:5;s:11:"tag_cloud-2";i:6;s:10:"nav_menu-2";i:7;s:15:"events-widget-2";i:8;s:16:"theme-my-login-2";i:9;s:30:"widget_twentyeleven_ephemera-2";i:10;s:8:"search-2";i:11;s:14:"recent-posts-2";i:12;s:17:"recent-comments-2";i:13;s:10:"archives-2";i:14;s:12:"categories-2";i:15;s:6:"meta-2";}s:13:"array_version";i:3;}', 'yes'),
(103, 0, 'cron', 'a:3:{i:1321065250;a:3:{s:16:"wp_version_check";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:17:"wp_update_plugins";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}s:16:"wp_update_themes";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:10:"twicedaily";s:4:"args";a:0:{}s:8:"interval";i:43200;}}}i:1321065256;a:1:{s:19:"wp_scheduled_delete";a:1:{s:32:"40cd750bba9870f18aada2478b24840a";a:3:{s:8:"schedule";s:5:"daily";s:4:"args";a:0:{}s:8:"interval";i:86400;}}}s:7:"version";i:2;}', 'yes'),
(104, 0, '_transient_doing_cron', '1321040081', 'yes'),
(105, 0, '_site_transient_update_core', 'O:8:"stdClass":3:{s:7:"updates";a:1:{i:0;O:8:"stdClass":9:{s:8:"response";s:6:"latest";s:8:"download";s:40:"http://wordpress.org/wordpress-3.2.1.zip";s:6:"locale";s:5:"en_US";s:8:"packages";O:8:"stdClass":4:{s:4:"full";s:40:"http://wordpress.org/wordpress-3.2.1.zip";s:10:"no_content";s:51:"http://wordpress.org/wordpress-3.2.1-no-content.zip";s:11:"new_bundled";s:52:"http://wordpress.org/wordpress-3.2.1-new-bundled.zip";s:7:"partial";b:0;}s:7:"current";s:5:"3.2.1";s:11:"php_version";s:5:"5.2.4";s:13:"mysql_version";s:3:"5.0";s:11:"new_bundled";s:3:"3.2";s:15:"partial_version";s:0:"";}}s:12:"last_checked";i:1321040083;s:15:"version_checked";s:5:"3.2.1";}', 'yes'),
(363, 0, '_site_transient_update_plugins', 'O:8:"stdClass":3:{s:12:"last_checked";i:1321040087;s:7:"checked";a:12:{s:19:"akismet/akismet.php";s:5:"2.5.3";s:17:"cforms/cforms.php";s:4:"12.2";s:32:"customize-your-community/cyc.php";s:5:"1.2.1";s:45:"enhanced-meta-widget/enhanced-meta-widget.php";s:5:"3.0.0";s:41:"advanced-events-registration/espresso.php";s:8:"3.1.12.L";s:27:"formbuilder/formbuilder.php";s:4:"0.89";s:9:"hello.php";s:3:"1.6";s:34:"my-live-chat-for-wp/mylivechat.php";s:5:"1.0.3";s:29:"osmig-signup-plugin/osmig.php";s:5:"1.0.1";s:53:"contexture-page-security/contexture-page-security.php";s:5:"1.5.3";s:31:"sidebar-login/sidebar-login.php";s:5:"2.3.2";s:33:"theme-my-login/theme-my-login.php";s:5:"6.1.4";}s:8:"response";a:1:{s:31:"sidebar-login/sidebar-login.php";O:8:"stdClass":5:{s:2:"id";s:4:"4105";s:4:"slug";s:13:"sidebar-login";s:11:"new_version";s:5:"2.3.3";s:3:"url";s:50:"http://wordpress.org/extend/plugins/sidebar-login/";s:7:"package";s:61:"http://downloads.wordpress.org/plugin/sidebar-login.2.3.3.zip";}}}', 'yes'),
(107, 0, 'widget_pages', 'a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(108, 0, 'widget_calendar', 'a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(109, 0, 'widget_links', 'a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(110, 0, 'widget_tag_cloud', 'a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(111, 0, 'widget_nav_menu', 'a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(112, 0, 'widget_widget_twentyeleven_ephemera', 'a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(116, 0, '_site_transient_timeout_browser_86f07590c0c6b05817bf50b5e7d924a8', '1317954855', 'yes'),
(490, 0, '_site_transient_timeout_theme_roots', '1321047289', 'yes'),
(491, 0, '_site_transient_theme_roots', 'a:7:{s:17:"adventure-journal";s:7:"/themes";s:8:"coraline";s:7:"/themes";s:9:"liquorice";s:7:"/themes";s:4:"news";s:7:"/themes";s:12:"twentyeleven";s:7:"/themes";s:9:"twentyten";s:7:"/themes";s:6:"zbench";s:7:"/themes";}', 'yes'),
(115, 0, '_site_transient_update_themes', 'O:8:"stdClass":3:{s:12:"last_checked";i:1321040089;s:7:"checked";a:7:{s:17:"adventure-journal";s:5:"1.7.2";s:8:"coraline";s:5:"1.0.2";s:9:"liquorice";s:3:"2.0";s:4:"news";s:3:"0.2";s:12:"twentyeleven";s:3:"1.2";s:9:"twentyten";s:3:"1.2";s:6:"zbench";s:5:"1.2.9";}s:8:"response";a:2:{s:9:"liquorice";a:3:{s:11:"new_version";s:3:"2.2";s:3:"url";s:44:"http://wordpress.org/extend/themes/liquorice";s:7:"package";s:61:"http://wordpress.org/extend/themes/download/liquorice.2.2.zip";}s:6:"zbench";a:3:{s:11:"new_version";s:5:"1.3.1";s:3:"url";s:41:"http://wordpress.org/extend/themes/zbench";s:7:"package";s:60:"http://wordpress.org/extend/themes/download/zbench.1.3.1.zip";}}}', 'yes'),
(117, 0, '_site_transient_browser_86f07590c0c6b05817bf50b5e7d924a8', 'a:9:{s:8:"platform";s:9:"Macintosh";s:4:"name";s:6:"Safari";s:7:"version";s:3:"5.1";s:10:"update_url";s:28:"http://www.apple.com/safari/";s:7:"img_src";s:49:"http://s.wordpress.org/images/browsers/safari.png";s:11:"img_src_ssl";s:48:"https://wordpress.org/images/browsers/safari.png";s:15:"current_version";s:3:"5.1";s:7:"upgrade";b:0;s:8:"insecure";b:0;}', 'yes'),
(118, 0, 'dashboard_widget_options', 'a:4:{s:25:"dashboard_recent_comments";a:1:{s:5:"items";i:5;}s:24:"dashboard_incoming_links";a:5:{s:4:"home";s:21:"http://localhost/apsn";s:4:"link";s:97:"http://blogsearch.google.com/blogsearch?scoring=d&partner=wordpress&q=link:http://localhost/apsn/";s:3:"url";s:130:"http://blogsearch.google.com/blogsearch_feeds?scoring=d&ie=utf-8&num=10&output=rss&partner=wordpress&q=link:http://localhost/apsn/";s:5:"items";i:10;s:9:"show_date";b:0;}s:17:"dashboard_primary";a:7:{s:4:"link";s:26:"http://wordpress.org/news/";s:3:"url";s:31:"http://wordpress.org/news/feed/";s:5:"title";s:14:"WordPress Blog";s:5:"items";i:2;s:12:"show_summary";i:1;s:11:"show_author";i:0;s:9:"show_date";i:1;}s:19:"dashboard_secondary";a:7:{s:4:"link";s:28:"http://planet.wordpress.org/";s:3:"url";s:33:"http://planet.wordpress.org/feed/";s:5:"title";s:20:"Other WordPress News";s:5:"items";i:5;s:12:"show_summary";i:0;s:11:"show_author";i:0;s:9:"show_date";i:0;}}', 'yes'),
(119, 0, 'current_theme', 'Twenty Eleven', 'yes'),
(120, 0, 'can_compress_scripts', '1', 'yes'),
(362, 0, '_site_transient_poptags_40cd750bba9870f18aada2478b24840a', 'a:40:{s:6:"widget";a:3:{s:4:"name";s:6:"widget";s:4:"slug";s:6:"widget";s:5:"count";s:4:"2477";}s:4:"post";a:3:{s:4:"name";s:4:"Post";s:4:"slug";s:4:"post";s:5:"count";s:4:"1672";}s:6:"plugin";a:3:{s:4:"name";s:6:"plugin";s:4:"slug";s:6:"plugin";s:5:"count";s:4:"1488";}s:5:"posts";a:3:{s:4:"name";s:5:"posts";s:4:"slug";s:5:"posts";s:5:"count";s:4:"1249";}s:5:"admin";a:3:{s:4:"name";s:5:"admin";s:4:"slug";s:5:"admin";s:5:"count";s:4:"1237";}s:7:"sidebar";a:3:{s:4:"name";s:7:"sidebar";s:4:"slug";s:7:"sidebar";s:5:"count";s:4:"1202";}s:8:"comments";a:3:{s:4:"name";s:8:"comments";s:4:"slug";s:8:"comments";s:5:"count";s:3:"881";}s:6:"images";a:3:{s:4:"name";s:6:"images";s:4:"slug";s:6:"images";s:5:"count";s:3:"809";}s:7:"twitter";a:3:{s:4:"name";s:7:"twitter";s:4:"slug";s:7:"twitter";s:5:"count";s:3:"778";}s:4:"page";a:3:{s:4:"name";s:4:"page";s:4:"slug";s:4:"page";s:5:"count";s:3:"758";}s:6:"google";a:3:{s:4:"name";s:6:"google";s:4:"slug";s:6:"google";s:5:"count";s:3:"739";}s:5:"links";a:3:{s:4:"name";s:5:"links";s:4:"slug";s:5:"links";s:5:"count";s:3:"686";}s:5:"image";a:3:{s:4:"name";s:5:"image";s:4:"slug";s:5:"image";s:5:"count";s:3:"675";}s:3:"seo";a:3:{s:4:"name";s:3:"seo";s:4:"slug";s:3:"seo";s:5:"count";s:3:"600";}s:3:"rss";a:3:{s:4:"name";s:3:"rss";s:4:"slug";s:3:"rss";s:5:"count";s:3:"530";}s:7:"gallery";a:3:{s:4:"name";s:7:"gallery";s:4:"slug";s:7:"gallery";s:5:"count";s:3:"517";}s:7:"widgets";a:3:{s:4:"name";s:7:"widgets";s:4:"slug";s:7:"widgets";s:5:"count";s:3:"445";}s:5:"pages";a:3:{s:4:"name";s:5:"pages";s:4:"slug";s:5:"pages";s:5:"count";s:3:"443";}s:4:"ajax";a:3:{s:4:"name";s:4:"AJAX";s:4:"slug";s:4:"ajax";s:5:"count";s:3:"439";}s:9:"wordpress";a:3:{s:4:"name";s:9:"wordpress";s:4:"slug";s:9:"wordpress";s:5:"count";s:3:"430";}s:8:"facebook";a:3:{s:4:"name";s:8:"Facebook";s:4:"slug";s:8:"facebook";s:5:"count";s:3:"428";}s:6:"social";a:3:{s:4:"name";s:6:"social";s:4:"slug";s:6:"social";s:5:"count";s:3:"400";}s:9:"shortcode";a:3:{s:4:"name";s:9:"shortcode";s:4:"slug";s:9:"shortcode";s:5:"count";s:3:"389";}s:6:"jquery";a:3:{s:4:"name";s:6:"jquery";s:4:"slug";s:6:"jquery";s:5:"count";s:3:"379";}s:10:"javascript";a:3:{s:4:"name";s:10:"javascript";s:4:"slug";s:10:"javascript";s:5:"count";s:3:"373";}s:4:"feed";a:3:{s:4:"name";s:4:"feed";s:4:"slug";s:4:"feed";s:5:"count";s:3:"355";}s:10:"buddypress";a:3:{s:4:"name";s:10:"buddypress";s:4:"slug";s:10:"buddypress";s:5:"count";s:3:"354";}s:5:"photo";a:3:{s:4:"name";s:5:"photo";s:4:"slug";s:5:"photo";s:5:"count";s:3:"354";}s:5:"video";a:3:{s:4:"name";s:5:"video";s:4:"slug";s:5:"video";s:5:"count";s:3:"350";}s:5:"email";a:3:{s:4:"name";s:5:"email";s:4:"slug";s:5:"email";s:5:"count";s:3:"345";}s:5:"media";a:3:{s:4:"name";s:5:"media";s:4:"slug";s:5:"media";s:5:"count";s:3:"345";}s:6:"photos";a:3:{s:4:"name";s:6:"photos";s:4:"slug";s:6:"photos";s:5:"count";s:3:"340";}s:5:"flash";a:3:{s:4:"name";s:5:"flash";s:4:"slug";s:5:"flash";s:5:"count";s:3:"328";}s:4:"tags";a:3:{s:4:"name";s:4:"tags";s:4:"slug";s:4:"tags";s:5:"count";s:3:"318";}s:5:"stats";a:3:{s:4:"name";s:5:"stats";s:4:"slug";s:5:"stats";s:5:"count";s:3:"312";}s:4:"link";a:3:{s:4:"name";s:4:"link";s:4:"slug";s:4:"link";s:5:"count";s:3:"309";}s:7:"content";a:3:{s:4:"name";s:7:"content";s:4:"slug";s:7:"content";s:5:"count";s:3:"301";}s:8:"category";a:3:{s:4:"name";s:8:"category";s:4:"slug";s:8:"category";s:5:"count";s:3:"289";}s:7:"comment";a:3:{s:4:"name";s:7:"comment";s:4:"slug";s:7:"comment";s:5:"count";s:3:"289";}s:4:"spam";a:3:{s:4:"name";s:4:"spam";s:4:"slug";s:4:"spam";s:5:"count";s:3:"283";}}', 'yes'),
(235, 0, 'theme_my_login', 'a:10:{s:7:"page_id";i:9;s:9:"show_page";i:1;s:10:"enable_css";i:1;s:14:"active_modules";a:5:{i:0;s:29:"custom-email/custom-email.php";i:1;s:41:"custom-redirection/custom-redirection.php";i:2;s:39:"custom-user-links/custom-user-links.php";i:3;s:35:"themed-profiles/themed-profiles.php";i:4;s:35:"user-moderation/user-moderation.php";}s:11:"initial_nag";i:0;s:5:"email";a:6:{s:8:"new_user";a:12:{s:9:"mail_from";s:0:"";s:14:"mail_from_name";s:0:"";s:17:"mail_content_type";s:5:"plain";s:5:"title";s:0:"";s:7:"message";s:0:"";s:13:"admin_mail_to";s:0:"";s:15:"admin_mail_from";s:0:"";s:20:"admin_mail_from_name";s:0:"";s:23:"admin_mail_content_type";s:5:"plain";s:11:"admin_title";s:0:"";s:13:"admin_message";s:0:"";s:13:"admin_disable";b:0;}s:13:"retrieve_pass";a:5:{s:9:"mail_from";s:0:"";s:14:"mail_from_name";s:0:"";s:17:"mail_content_type";s:5:"plain";s:5:"title";s:0:"";s:7:"message";s:0:"";}s:10:"reset_pass";a:7:{s:13:"admin_mail_to";s:0:"";s:15:"admin_mail_from";s:0:"";s:20:"admin_mail_from_name";s:0:"";s:23:"admin_mail_content_type";s:5:"plain";s:11:"admin_title";s:0:"";s:13:"admin_message";s:0:"";s:13:"admin_disable";b:0;}s:13:"user_approval";a:12:{s:13:"admin_disable";b:0;s:14:"mail_from_name";s:0:"";s:9:"mail_from";s:0:"";s:17:"mail_content_type";s:5:"plain";s:5:"title";s:0:"";s:7:"message";s:0:"";s:13:"admin_mail_to";s:0:"";s:20:"admin_mail_from_name";s:0:"";s:15:"admin_mail_from";s:0:"";s:23:"admin_mail_content_type";s:5:"plain";s:11:"admin_title";s:0:"";s:13:"admin_message";s:0:"";}s:15:"user_activation";a:5:{s:14:"mail_from_name";s:0:"";s:9:"mail_from";s:0:"";s:17:"mail_content_type";s:5:"plain";s:5:"title";s:0:"";s:7:"message";s:0:"";}s:11:"user_denial";a:5:{s:14:"mail_from_name";s:0:"";s:9:"mail_from";s:0:"";s:17:"mail_content_type";s:5:"plain";s:5:"title";s:0:"";s:7:"message";s:0:"";}}s:11:"redirection";a:5:{s:13:"administrator";a:4:{s:10:"login_type";s:6:"custom";s:9:"login_url";s:32:"http://localhost/apsn/?page_id=2";s:11:"logout_type";s:7:"default";s:10:"logout_url";s:0:"";}s:6:"editor";a:4:{s:10:"login_type";s:7:"default";s:9:"login_url";s:0:"";s:11:"logout_type";s:7:"default";s:10:"logout_url";s:0:"";}s:6:"author";a:4:{s:10:"login_type";s:7:"default";s:9:"login_url";s:0:"";s:11:"logout_type";s:7:"default";s:10:"logout_url";s:0:"";}s:11:"contributor";a:4:{s:10:"login_type";s:7:"default";s:9:"login_url";s:0:"";s:11:"logout_type";s:7:"default";s:10:"logout_url";s:0:"";}s:10:"subscriber";a:4:{s:10:"login_type";s:6:"custom";s:9:"login_url";s:33:"http://localhost/apsn/?page_id=22";s:11:"logout_type";s:6:"custom";s:10:"logout_url";s:22:"http://localhost/apsn/";}}s:10:"user_links";a:5:{s:13:"administrator";a:2:{i:0;a:2:{s:5:"title";s:9:"Dashboard";s:3:"url";s:31:"http://localhost/apsn/wp-admin/";}i:1;a:2:{s:5:"title";s:7:"Profile";s:3:"url";s:42:"http://localhost/apsn/wp-admin/profile.php";}}s:6:"editor";a:2:{i:0;a:2:{s:5:"title";s:9:"Dashboard";s:3:"url";s:31:"http://localhost/apsn/wp-admin/";}i:1;a:2:{s:5:"title";s:7:"Profile";s:3:"url";s:42:"http://localhost/apsn/wp-admin/profile.php";}}s:6:"author";a:2:{i:0;a:2:{s:5:"title";s:9:"Dashboard";s:3:"url";s:31:"http://localhost/apsn/wp-admin/";}i:1;a:2:{s:5:"title";s:7:"Profile";s:3:"url";s:42:"http://localhost/apsn/wp-admin/profile.php";}}s:11:"contributor";a:2:{i:0;a:2:{s:5:"title";s:9:"Dashboard";s:3:"url";s:31:"http://localhost/apsn/wp-admin/";}i:1;a:2:{s:5:"title";s:7:"Profile";s:3:"url";s:42:"http://localhost/apsn/wp-admin/profile.php";}}s:10:"subscriber";a:2:{i:0;a:2:{s:5:"title";s:9:"Dashboard";s:3:"url";s:31:"http://localhost/apsn/wp-admin/";}i:1;a:2:{s:5:"title";s:7:"Profile";s:3:"url";s:42:"http://localhost/apsn/wp-admin/profile.php";}}}s:10:"moderation";a:1:{s:4:"type";s:4:"none";}s:7:"version";s:5:"6.1.4";}', 'yes'),
(236, 0, 'uninstall_plugins', 'a:3:{i:0;b:0;s:33:"theme-my-login/theme-my-login.php";a:2:{i:0;s:20:"Theme_My_Login_Admin";i:1;s:9:"uninstall";}s:53:"contexture-page-security/contexture-page-security.php";a:2:{i:0;s:13:"CTXPS_Queries";i:1;s:13:"plugin_delete";}}', 'yes'),
(237, 0, 'widget_theme-my-login', 'a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(353, 0, '_site_transient_timeout_browser_82ca89a211d145f1d8bf4c7603dc3ed6', '1320997581', 'yes'),
(354, 0, '_site_transient_browser_82ca89a211d145f1d8bf4c7603dc3ed6', 'a:9:{s:8:"platform";s:9:"Macintosh";s:4:"name";s:6:"Safari";s:7:"version";s:5:"5.1.1";s:10:"update_url";s:28:"http://www.apple.com/safari/";s:7:"img_src";s:49:"http://s.wordpress.org/images/browsers/safari.png";s:11:"img_src_ssl";s:48:"https://wordpress.org/images/browsers/safari.png";s:15:"current_version";s:3:"5.1";s:7:"upgrade";b:0;s:8:"insecure";b:0;}', 'yes'),
(183, 0, 'formbuilder_spam_blocker', 'formBuilderCap', 'yes'),
(184, 0, 'formBuilder_custom_css', 'Enabled', 'yes'),
(185, 0, 'formbuilder_alternate_email_handling', 'Disabled', 'yes'),
(186, 0, 'formbuilder_blacklist', 'Disabled', 'yes'),
(187, 0, 'formbuilder_greylist', 'Disabled', 'yes'),
(188, 0, 'formbuilder_excessive_links', 'Disabled', 'yes'),
(189, 0, 'formbuilder_spammer_ip_checking', 'Disabled', 'yes'),
(190, 0, 'formbuilder_akismet', 'Disabled', 'yes'),
(191, 0, 'formBuilder_referrer_info', 'Enabled', 'yes'),
(192, 0, 'formbuilder_version', '0.89', 'yes'),
(464, 0, '_transient_timeout_plugin_slugs', '1321046754', 'no'),
(465, 0, '_transient_plugin_slugs', 'a:12:{i:0;s:19:"akismet/akismet.php";i:1;s:17:"cforms/cforms.php";i:2;s:32:"customize-your-community/cyc.php";i:3;s:45:"enhanced-meta-widget/enhanced-meta-widget.php";i:4;s:41:"advanced-events-registration/espresso.php";i:5;s:27:"formbuilder/formbuilder.php";i:6;s:9:"hello.php";i:7;s:34:"my-live-chat-for-wp/mylivechat.php";i:8;s:29:"osmig-signup-plugin/osmig.php";i:9;s:53:"contexture-page-security/contexture-page-security.php";i:10;s:31:"sidebar-login/sidebar-login.php";i:11;s:33:"theme-my-login/theme-my-login.php";}', 'no'),
(361, 0, '_site_transient_timeout_poptags_40cd750bba9870f18aada2478b24840a', '1320520967', 'yes'),
(182, 0, 'cforms_settings', 'a:5:{s:6:"global";a:48:{s:9:"plugindir";s:6:"cforms";s:11:"cforms_root";s:47:"http://localhost/apsn/wp-content/plugins/cforms";s:7:"tinyURI";s:44:"http://localhost/apsn/wp-includes/js/tinymce";s:15:"cforms_root_dir";s:68:"/Applications/XAMPP/xamppfiles/htdocs/apsn/wp-content/plugins/cforms";s:10:"cforms_IIS";s:1:"/";s:1:"v";s:4:"12.2";s:18:"cforms_style_title";s:69:"font:normal 0.8em Verdana; text-align:right; color:#777; margin:3px 0";s:18:"cforms_style_table";s:67:"background:#F4F5FB; color:#666; font-size:1em; font-family:verdana;";s:18:"cforms_style_fs_td";s:138:"font-size:105%; font-variant:small-caps; letter-spacing:2px; border-bottom:2px solid #E6E8F7; padding:6px 2px 6px 4px; background:#EFF0FA;";s:21:"cforms_style_fsend_td";s:63:"background:#E6E8F7; font-size:0px; line-height:2px; height:2px;";s:23:"cforms_style_fsendSP_td";s:43:"font-size:0px; line-height:2px; height:4px;";s:19:"cforms_style_key_td";s:93:"color:#000; font-size:90%; white-space:nowrap; padding:4px 20px 4px 15px; vertical-align:top;";s:19:"cforms_style_val_td";s:26:"font-size:90%; width:100%;";s:19:"cforms_style_cforms";s:35:"font:normal 10px Arial; color:#777;";s:16:"cforms_formcount";s:1:"4";s:18:"cforms_upload_err1";s:43:"Generic file upload error. Please try again";s:18:"cforms_upload_err2";s:56:"File is empty. Please upload something more substantial.";s:18:"cforms_upload_err3";s:55:"Sorry, file is too large. You may try to zip your file.";s:18:"cforms_upload_err4";s:63:"File upload failed. Please try again or contact the blog admin.";s:18:"cforms_upload_err5";s:41:"File not accepted, file type not allowed.";s:16:"cforms_rsskeyall";s:32:"3d1e22569b829e2239cbf3b94eb0c25e";s:13:"cforms_rssall";b:0;s:19:"cforms_rssall_count";N;s:18:"cforms_captcha_def";a:16:{s:1:"i";s:1:"i";s:1:"w";s:3:"115";s:1:"h";s:2:"25";s:1:"c";s:6:"000066";s:1:"l";s:6:"000066";s:2:"bg";s:5:"1.gif";s:1:"f";s:9:"font4.ttf";s:2:"fo";N;s:4:"foqa";N;s:2:"f1";s:2:"17";s:2:"f2";s:2:"19";s:2:"a1";s:3:"-12";s:2:"a2";s:2:"12";s:2:"c1";s:1:"4";s:2:"c2";s:1:"5";s:2:"ac";s:32:"abcdefghijkmnpqrstuvwxyz23456789";}s:13:"cforms_sec_qa";s:82:"What color is snow?=white\r\nThe color of grass is=green\r\nTen minus five equals=five";s:14:"cforms_codeerr";s:43:"Please double-check your verification code.";s:20:"cforms_show_quicktag";s:1:"1";s:23:"cforms_show_quicktag_js";b:0;s:21:"cforms_commentsuccess";s:32:"Thank you for leaving a comment.";s:18:"cforms_commentWait";s:2:"15";s:20:"cforms_commentParent";s:13:"mycommentlist";s:18:"cforms_commentHTML";s:212:"<li id=\\"comment-{id}\\">{moderation}\r\n<p>{usercomment}</p>\r\n<p>\r\n<cite>Comment by <a href=\\"{url}\\" rel=\\"external nofollow\\">{author}</a> &mdash; {date} @ <a href=\\"#comment-{id}\\">{time}</a></cite>\r\n</p>\r\n</li>";s:19:"cforms_commentInMod";s:45:"<em>Your comment is awaiting moderation.</em>";s:13:"cforms_avatar";s:2:"32";s:10:"cforms_css";s:10:"cforms.css";s:14:"cforms_labelID";s:1:"0";s:11:"cforms_liID";s:1:"0";s:15:"cforms_database";s:1:"1";s:17:"cforms_datepicker";s:1:"1";s:15:"cforms_dp_start";s:1:"0";s:14:"cforms_dp_date";s:10:"MM/dd/yyyy";s:14:"cforms_dp_days";s:41:"\\"S\\",\\"M\\",\\"T\\",\\"W\\",\\"T\\",\\"F\\",\\"S\\"";s:16:"cforms_dp_months";s:133:"\\"January\\",\\"February\\",\\"March\\",\\"April\\",\\"May\\",\\"June\\",\\"July\\",\\"August\\",\\"September\\",\\"October\\",\\"November\\",\\"December\\"";s:13:"cforms_dp_nav";a:6:{i:0;s:13:"Previous Year";i:1;s:14:"Previous Month";i:2;s:9:"Next Year";i:3;s:10:"Next Month";i:4;s:5:"Close";i:5;s:11:"Choose Date";}s:20:"cforms_showdashboard";s:1:"1";s:16:"cforms_inexclude";a:2:{s:2:"ex";s:0:"";s:3:"ids";s:0:"";}s:11:"cforms_crlf";a:2:{s:1:"h";s:1:"0";s:1:"b";s:1:"0";}s:11:"cforms_smtp";s:32:"0$#$$#$$#$$#$$#$$#$0$#$$#$$#$$#$";}s:4:"form";a:127:{s:14:"cforms1_rsskey";s:32:"26e2da400ad79f39cd86270b4d407cbf";s:11:"cforms1_rss";b:0;s:17:"cforms1_rss_count";i:5;s:17:"cforms1_dontclear";b:0;s:20:"cforms1_count_fields";s:1:"5";s:21:"cforms1_count_field_1";s:47:"My Fieldset$#$fieldsetstart$#$0$#$0$#$0$#$0$#$0";s:21:"cforms1_count_field_2";s:51:"Your Name|Your Name$#$textfield$#$1$#$0$#$1$#$0$#$0";s:21:"cforms1_count_field_3";s:37:"Email$#$textfield$#$1$#$1$#$0$#$0$#$0";s:21:"cforms1_count_field_4";s:47:"Website|http://$#$textfield$#$0$#$0$#$0$#$0$#$0";s:21:"cforms1_count_field_5";s:38:"Message$#$textarea$#$0$#$0$#$0$#$0$#$0";s:16:"cforms1_required";s:10:"(required)";s:21:"cforms1_emailrequired";s:22:"(valid email required)";s:12:"cforms1_ajax";s:1:"1";s:15:"cforms1_confirm";s:1:"0";s:13:"cforms1_fname";s:10:"A new form";s:16:"cforms1_csubject";s:41:"Re: Your note$#$Re: Submitted form (copy)";s:12:"cforms1_cmsg";s:89:"Dear {Your Name},\nThank you for your note!\nWe will get back to you as soon as possible.\n\n";s:17:"cforms1_cmsg_html";s:358:"<div style="font:normal 1em arial; margin-top:10px"><p><strong>Dear {Your Name},</strong></p>\n<p>Thank you for your note!</p>\n<p>We will get back to you as soon as possible.\n<div style="width:80%; background:#f4faff ; color:#aaa; font-size:11px; padding:10px; margin-top:20px"><strong>This is an automatic confirmation message. {Date}.</strong></div></div>\n\n";s:13:"cforms1_email";s:21:"athifsaleem@gmail.com";s:17:"cforms1_fromemail";s:21:"athifsaleem@gmail.com";s:11:"cforms1_bcc";s:0:"";s:14:"cforms1_header";s:147:"A new submission (form: "{Form Name}")\r\n============================================\r\nSubmitted on: {Date}\r\nVia: {Page}\r\nBy {IP} (visitor IP).\r\n.\r\n";s:19:"cforms1_header_html";s:143:"<p style="font:normal 0.8em Verdana; text-align:right; color:#777; margin:3px 0">a form has been submitted on {Date}, via: {Page} [IP {IP}]</p>";s:16:"cforms1_formdata";s:4:"1111";s:13:"cforms1_space";s:2:"30";s:21:"cforms1_noattachments";s:1:"0";s:15:"cforms1_subject";s:26:"A comment from {Your Name}";s:19:"cforms1_submit_text";s:6:"Submit";s:15:"cforms1_success";s:27:"Thank you for your comment!";s:15:"cforms1_failure";s:39:"Please fill in all the required fields.";s:16:"cforms1_limittxt";s:59:"<strong>No more submissions accepted at this time.</strong>";s:15:"cforms1_working";s:20:"One moment please...";s:13:"cforms1_popup";s:2:"nn";s:15:"cforms1_showpos";s:5:"ynyyy";s:12:"cforms1_hide";b:0;s:16:"cforms1_redirect";b:0;s:21:"cforms1_redirect_page";s:28:"http://redirect.to.this.page";s:14:"cforms1_action";s:1:"0";s:19:"cforms1_action_page";s:7:"http://";s:18:"cforms1_upload_dir";s:80:"/Applications/XAMPP/xamppfiles/htdocs/apsn/wp-content/plugins/cforms/attachments";s:18:"cforms1_upload_ext";s:19:"txt,zip,doc,rtf,xls";s:19:"cforms1_upload_size";s:4:"1024";s:16:"cforms1_tracking";s:0:"";s:19:"cforms1_tellafriend";s:2:"01";s:17:"cforms1_dashboard";s:1:"0";s:18:"cforms1_maxentries";s:0:"";s:18:"cforms1_confirmerr";i:8;s:17:"cforms_confirmerr";i:14;s:14:"cforms_showpos";s:5:"yyyyn";s:16:"cforms_fromemail";s:30:"\\"APSN\\" <wordpress@localhost>";s:15:"cforms_formdata";s:4:"0000";s:12:"cforms_fname";s:6:"Part 1";s:11:"cforms_noid";s:1:"0";s:17:"cforms_upload_ext";N;s:18:"cforms_upload_size";N;s:20:"cforms_noattachments";s:1:"0";s:18:"cforms_submit_text";s:14:"Move to Part 2";s:14:"cforms_working";s:20:"One Moment Please...";s:15:"cforms_required";s:1:"*";s:20:"cforms_emailrequired";s:1:"*";s:14:"cforms_success";s:37:"Part 1 has been recorded successfully";s:14:"cforms_failure";s:0:"";s:12:"cforms_popup";s:2:"nn";s:17:"cforms_formaction";b:0;s:16:"cforms_dontclear";b:0;s:16:"cforms_dashboard";s:1:"0";s:17:"cforms_notracking";b:0;s:18:"cforms_customnames";s:1:"0";s:11:"cforms_hide";b:0;s:17:"cforms_maxentries";s:0:"";s:16:"cforms_startdate";s:1:" ";s:14:"cforms_enddate";s:1:" ";s:15:"cforms_redirect";b:0;s:20:"cforms_redirect_page";s:0:"";s:13:"cforms_action";s:1:"0";s:18:"cforms_action_page";s:0:"";s:10:"cforms_rss";b:0;s:16:"cforms_rss_count";N;s:15:"cforms_emailoff";s:1:"0";s:12:"cforms_email";s:0:"";s:10:"cforms_bcc";s:0:"";s:14:"cforms_subject";s:0:"";s:20:"cforms_emailpriority";s:1:"3";s:13:"cforms_header";s:0:"";s:18:"cforms_header_html";s:0:"";s:12:"cforms_space";s:0:"";s:14:"cforms_confirm";s:1:"0";s:15:"cforms_csubject";s:3:"$#$";s:9:"cforms_mp";a:8:{s:7:"mp_form";b:1;s:7:"mp_next";s:6:"Part 2";s:8:"mp_first";b:1;s:8:"mp_email";b:0;s:8:"mp_reset";b:0;s:12:"mp_resettext";s:0:"";s:7:"mp_back";b:0;s:11:"mp_backtext";s:0:"";}s:11:"cforms_ajax";s:1:"0";s:18:"cforms_tellafriend";s:2:"01";s:12:"cforms_tafCC";s:1:"0";s:15:"cforms_tracking";s:0:"";s:19:"cforms_count_fields";i:32;s:20:"cforms_count_field_1";s:52:"Personal Details$#$fieldsetstart$#$0$#$0$#$0$#$0$#$0";s:15:"cforms_limittxt";s:0:"";s:20:"cforms_count_field_2";s:110:"Title#Dr|1#Mr|2#Mdm|3#Mrs|4#Miss|5|title:Please select your desired title$#$multiselectbox$#$1$#$0$#$0$#$0$#$0";s:20:"cforms_count_field_3";s:42:"First Name$#$textfield$#$1$#$0$#$0$#$0$#$0";s:20:"cforms_count_field_4";s:41:"Last Name$#$textfield$#$1$#$0$#$0$#$0$#$0";s:20:"cforms_count_field_5";s:84:"Sex#Male|1#Female|2|title:Please list your gender$#$radiobuttons$#$0$#$0$#$0$#$0$#$0";s:20:"cforms_count_field_6";s:36:"NRIC$#$textfield$#$0$#$0$#$0$#$0$#$0";s:20:"cforms_count_field_7";s:37:"Date$#$datepicker$#$0$#$0$#$0$#$0$#$0";s:20:"cforms_count_field_8";s:43:"Nationality$#$textfield$#$0$#$0$#$0$#$0$#$0";s:20:"cforms_count_field_9";s:36:"Race$#$textfield$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_10";s:40:"Religion$#$textfield$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_11";s:62:"Singapore PR?#Yes|1#No|0#NA|-1$#$selectbox$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_12";s:48:"Country of Birth$#$textfield$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_13";s:96:"Marital Status#Single|1#Married|2#Divorced/Separated|3#Widowed|4$#$selectbox$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_14";s:76:"NS Status#Full Time|1#Reservist|2#Exempted|3$#$selectbox$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_15";s:36:"--$#$fieldsetend$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_16";s:44:"Language$#$fieldsetstart$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_17";s:39:"Written$#$textfield$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_18";s:38:"Spoken$#$textfield$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_19";s:36:"--$#$fieldsetend$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_20";s:45:"Education$#$fieldsetstart$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_21";s:242:"Highest Educational Level Attained#Primary|1#Secondary|2#GCE \\''N\\'' / \\''O\\''|3#ITE|4#GCE \\''A\\''|5#Diploma|6#Pass Degree|7#Honours Degree|8#Master\\''s Degree|9#Doctorate|10|title:Please select your educational level$#$selectbox$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_22";s:63:"Name of Diploma/Degree Attained$#$textfield$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_23";s:36:"--$#$fieldsetend$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_24";s:51:"Contact Details$#$fieldsetstart$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_25";s:44:"Home Address$#$textfield$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_26";s:43:"Postal Code$#$textfield$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_27";s:37:"Email$#$textfield$#$1$#$1$#$0$#$0$#$0";s:21:"cforms_count_field_28";s:46:"Home Telephone$#$textfield$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_29";s:47:"Pager/Handphone$#$textfield$#$1$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_30";s:138:"Type of Dwelling#HDB Room|1#HDB Executive|2#HUDC|3#Semi Detached/Terrace|4#Condominium/Private Apartment|5$#$selectbox$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_31";s:55:"Others(Please Specify) $#$textfield$#$0$#$0$#$0$#$0$#$0";s:21:"cforms_count_field_32";s:36:"--$#$fieldsetend$#$0$#$0$#$0$#$0$#$0";}s:5:"form2";a:59:{s:14:"cforms2_rsskey";s:32:"4ccbc017ec3a80a5466c8904859137af";s:11:"cforms2_rss";b:0;s:17:"cforms2_rss_count";N;s:17:"cforms2_dontclear";b:0;s:20:"cforms2_count_fields";i:7;s:21:"cforms2_count_field_1";s:46:"Occupation$#$fieldsetstart$#$0$#$0$#$0$#$0$#$0";s:21:"cforms2_count_field_2";s:56:"Name of Employer/Company$#$textfield$#$1$#$0$#$1$#$0$#$0";s:21:"cforms2_count_field_3";s:49:"Workplace Address$#$textfield$#$0$#$0$#$0$#$0$#$0";s:21:"cforms2_count_field_4";s:43:"Postal Code$#$textfield$#$0$#$0$#$0$#$0$#$0";s:16:"cforms2_required";s:1:"*";s:21:"cforms2_emailrequired";s:1:"*";s:12:"cforms2_ajax";s:1:"0";s:15:"cforms2_confirm";s:1:"0";s:13:"cforms2_fname";s:6:"Part 2";s:16:"cforms2_csubject";s:41:"Re: Your note$#$Re: Submitted form (copy)";s:12:"cforms2_cmsg";s:89:"Dear {Your Name},\nThank you for your note!\nWe will get back to you as soon as possible.\n\n";s:17:"cforms2_cmsg_html";s:358:"<div style="font:normal 1em arial; margin-top:10px"><p><strong>Dear {Your Name},</strong></p>\n<p>Thank you for your note!</p>\n<p>We will get back to you as soon as possible.\n<div style="width:80%; background:#f4faff ; color:#aaa; font-size:11px; padding:10px; margin-top:20px"><strong>This is an automatic confirmation message. {Date}.</strong></div></div>\n\n";s:13:"cforms2_email";s:21:"athifsaleem@gmail.com";s:17:"cforms2_fromemail";s:21:"athifsaleem@gmail.com";s:11:"cforms2_bcc";s:0:"";s:14:"cforms2_header";s:149:"A new submission (form: \\"{Form Name}\\")\r\n============================================\r\nSubmitted on: {Date}\r\nVia: {Page}\r\nBy {IP} (visitor IP).\r\n.\r\n";s:19:"cforms2_header_html";s:145:"<p style=\\"font:normal 0.8em Verdana; text-align:right; color:#777; margin:3px 0\\">a form has been submitted on {Date}, via: {Page} [IP {IP}]</p>";s:16:"cforms2_formdata";s:4:"1110";s:13:"cforms2_space";s:2:"30";s:21:"cforms2_noattachments";s:1:"0";s:15:"cforms2_subject";s:26:"A comment from {Your Name}";s:19:"cforms2_submit_text";s:14:"Move to part 3";s:15:"cforms2_success";s:36:"Part 2 of the form has been recorded";s:15:"cforms2_failure";s:39:"Please fill in all the required fields.";s:16:"cforms2_limittxt";s:59:"<strong>No more submissions accepted at this time.</strong>";s:15:"cforms2_working";s:20:"One moment please...";s:13:"cforms2_popup";s:2:"nn";s:15:"cforms2_showpos";s:5:"ynyyy";s:12:"cforms2_hide";b:0;s:16:"cforms2_redirect";b:0;s:21:"cforms2_redirect_page";s:28:"http://redirect.to.this.page";s:14:"cforms2_action";s:1:"0";s:19:"cforms2_action_page";s:7:"http://";s:18:"cforms2_upload_dir";s:80:"/Applications/XAMPP/xamppfiles/htdocs/apsn/wp-content/plugins/cforms/attachments";s:18:"cforms2_upload_ext";N;s:19:"cforms2_upload_size";N;s:16:"cforms2_tracking";s:0:"";s:19:"cforms2_tellafriend";s:2:"01";s:17:"cforms2_dashboard";s:1:"0";s:18:"cforms2_maxentries";s:0:"";s:12:"cforms2_noid";s:1:"0";s:18:"cforms2_formaction";b:0;s:18:"cforms2_notracking";b:0;s:19:"cforms2_customnames";s:1:"0";s:17:"cforms2_startdate";s:1:" ";s:15:"cforms2_enddate";s:1:" ";s:16:"cforms2_emailoff";s:1:"0";s:21:"cforms2_emailpriority";s:1:"3";s:10:"cforms2_mp";a:8:{s:7:"mp_form";b:1;s:7:"mp_next";s:6:"Part 3";s:8:"mp_first";b:0;s:8:"mp_email";b:0;s:8:"mp_reset";b:1;s:12:"mp_resettext";s:9:"Reset All";s:7:"mp_back";b:1;s:11:"mp_backtext";s:14:"Back to Part 1";}s:13:"cforms2_tafCC";s:1:"0";s:21:"cforms2_count_field_5";s:45:"Office Number$#$textfield$#$0$#$0$#$0$#$0$#$0";s:18:"cforms2_confirmerr";i:8;s:21:"cforms2_count_field_7";s:36:"--$#$fieldsetend$#$0$#$0$#$0$#$0$#$0";s:21:"cforms2_count_field_6";s:42:"Fax Number$#$textfield$#$0$#$0$#$0$#$0$#$0";}s:5:"form3";a:68:{s:14:"cforms3_rsskey";s:32:"1e4f5421b03f308c8d6488bbee3fb1b2";s:11:"cforms3_rss";b:0;s:17:"cforms3_rss_count";N;s:17:"cforms3_dontclear";b:0;s:20:"cforms3_count_fields";i:16;s:21:"cforms3_count_field_1";s:48:"Volunteering$#$fieldsetstart$#$0$#$0$#$0$#$0$#$0";s:21:"cforms3_count_field_2";s:78:"Previous Volunteering Experience#Yes|1#No|0$#$radiobuttons$#$1$#$0$#$0$#$0$#$0";s:21:"cforms3_count_field_3";s:83:"If yes, please specify the name of the organization$#$textfield$#$0$#$0$#$0$#$0$#$0";s:21:"cforms3_count_field_4";s:71:"Special Skills and Talents to contribute$#$textarea$#$0$#$0$#$0$#$0$#$0";s:21:"cforms3_count_field_5";s:53:"Areas of Interest$#$fieldsetstart$#$0$#$0$#$0$#$0$#$0";s:16:"cforms3_required";s:1:"*";s:21:"cforms3_emailrequired";s:1:"*";s:12:"cforms3_ajax";s:1:"0";s:15:"cforms3_confirm";s:1:"0";s:13:"cforms3_fname";s:6:"Part 3";s:16:"cforms3_csubject";s:41:"Re: Your note$#$Re: Submitted form (copy)";s:12:"cforms3_cmsg";s:89:"Dear {Your Name},\nThank you for your note!\nWe will get back to you as soon as possible.\n\n";s:17:"cforms3_cmsg_html";s:358:"<div style="font:normal 1em arial; margin-top:10px"><p><strong>Dear {Your Name},</strong></p>\n<p>Thank you for your note!</p>\n<p>We will get back to you as soon as possible.\n<div style="width:80%; background:#f4faff ; color:#aaa; font-size:11px; padding:10px; margin-top:20px"><strong>This is an automatic confirmation message. {Date}.</strong></div></div>\n\n";s:13:"cforms3_email";s:21:"athifsaleem@gmail.com";s:17:"cforms3_fromemail";s:21:"athifsaleem@gmail.com";s:11:"cforms3_bcc";s:0:"";s:14:"cforms3_header";s:149:"A new submission (form: \\"{Form Name}\\")\r\n============================================\r\nSubmitted on: {Date}\r\nVia: {Page}\r\nBy {IP} (visitor IP).\r\n.\r\n";s:19:"cforms3_header_html";s:145:"<p style=\\"font:normal 0.8em Verdana; text-align:right; color:#777; margin:3px 0\\">a form has been submitted on {Date}, via: {Page} [IP {IP}]</p>";s:16:"cforms3_formdata";s:4:"1110";s:13:"cforms3_space";s:2:"30";s:21:"cforms3_noattachments";s:1:"0";s:15:"cforms3_subject";s:26:"A comment from {Your Name}";s:19:"cforms3_submit_text";s:14:"Move to Part 3";s:15:"cforms3_success";s:37:"Part 3 has been recorded successfully";s:15:"cforms3_failure";s:39:"Please fill in all the required fields.";s:16:"cforms3_limittxt";s:59:"<strong>No more submissions accepted at this time.</strong>";s:15:"cforms3_working";s:20:"One moment please...";s:13:"cforms3_popup";s:2:"nn";s:15:"cforms3_showpos";s:5:"ynyyy";s:12:"cforms3_hide";b:0;s:16:"cforms3_redirect";b:0;s:21:"cforms3_redirect_page";s:28:"http://redirect.to.this.page";s:14:"cforms3_action";s:1:"0";s:19:"cforms3_action_page";s:7:"http://";s:18:"cforms3_upload_dir";s:80:"/Applications/XAMPP/xamppfiles/htdocs/apsn/wp-content/plugins/cforms/attachments";s:18:"cforms3_upload_ext";N;s:19:"cforms3_upload_size";N;s:16:"cforms3_tracking";s:0:"";s:19:"cforms3_tellafriend";s:2:"01";s:17:"cforms3_dashboard";s:1:"0";s:18:"cforms3_maxentries";s:0:"";s:18:"cforms3_confirmerr";i:8;s:12:"cforms3_noid";s:1:"0";s:18:"cforms3_formaction";b:0;s:18:"cforms3_notracking";b:0;s:19:"cforms3_customnames";s:1:"0";s:17:"cforms3_startdate";s:1:" ";s:15:"cforms3_enddate";s:1:" ";s:16:"cforms3_emailoff";s:1:"0";s:21:"cforms3_emailpriority";s:1:"3";s:10:"cforms3_mp";a:8:{s:7:"mp_form";b:1;s:7:"mp_next";s:6:"Part 4";s:8:"mp_first";b:0;s:8:"mp_email";b:0;s:8:"mp_reset";b:1;s:12:"mp_resettext";s:9:"Reset All";s:7:"mp_back";b:1;s:11:"mp_backtext";s:14:"Back to Part 2";}s:13:"cforms3_tafCC";s:1:"0";s:21:"cforms3_count_field_6";s:39:"Children$#$checkbox$#$0$#$0$#$0$#$0$#$0";s:21:"cforms3_count_field_7";s:36:"Youth$#$checkbox$#$0$#$0$#$0$#$0$#$0";s:21:"cforms3_count_field_8";s:37:"Adults$#$checkbox$#$0$#$0$#$0$#$0$#$0";s:21:"cforms3_count_field_9";s:71:"instructional (eg cooking lessons, arts)$#$checkbox$#$0$#$0$#$0$#$0$#$0";s:22:"cforms3_count_field_10";s:53:"Please provide details$#$textarea$#$0$#$0$#$0$#$0$#$0";s:22:"cforms3_count_field_11";s:52:"Organizing Activities$#$checkbox$#$0$#$0$#$0$#$0$#$0";s:22:"cforms3_count_field_12";s:58:"Admin/Instructional Support$#$checkbox$#$0$#$0$#$0$#$0$#$0";s:22:"cforms3_count_field_13";s:55:"Others (please specify)$#$textfield$#$0$#$0$#$0$#$0$#$0";s:22:"cforms3_count_field_14";s:36:"--$#$fieldsetend$#$0$#$0$#$0$#$0$#$0";s:22:"cforms3_count_field_15";s:137:"Availability for routine regular school activities#Once weekly|1#Twice weekly|2#More than twice weekly |3$#$selectbox$#$0$#$0$#$0$#$0$#$0";s:22:"cforms3_count_field_16";s:36:"--$#$fieldsetend$#$0$#$0$#$0$#$0$#$0";}s:5:"form4";a:55:{s:14:"cforms4_rsskey";s:32:"1cdc5f1c352aeb0d9583f5c700ba7b39";s:11:"cforms4_rss";b:0;s:17:"cforms4_rss_count";N;s:17:"cforms4_dontclear";b:0;s:20:"cforms4_count_fields";i:3;s:21:"cforms4_count_field_1";s:48:"Declarations$#$fieldsetstart$#$0$#$0$#$0$#$0$#$0";s:21:"cforms4_count_field_2";s:116:"Have you been convicted or charged in a court of law in any country ? #Yes|1#No|0$#$radiobuttons$#$1$#$0$#$0$#$0$#$0";s:21:"cforms4_count_field_3";s:548:"<strong> Terms of Agreement: <br>  <ol> <li> I do not conduct/ solicit any communications with a profit in view with APSN employees within or outside premises </li> <li> The abovementioned information given by me in this form is correct and true to the best if my knowledge. </li> <li> I truly understand and accept that if any time after engagement it is found that a false declaration has been made in this form, the organisation has the right to terminate my volunteer involvement forthwith.</li> </ol> </strong>||$#$textonly$#$0$#$0$#$0$#$0$#$0";s:16:"cforms4_required";s:1:"*";s:21:"cforms4_emailrequired";s:1:"*";s:12:"cforms4_ajax";s:1:"0";s:15:"cforms4_confirm";s:1:"0";s:13:"cforms4_fname";s:6:"Part 4";s:16:"cforms4_csubject";s:41:"Re: Your note$#$Re: Submitted form (copy)";s:12:"cforms4_cmsg";s:89:"Dear {Your Name},\nThank you for your note!\nWe will get back to you as soon as possible.\n\n";s:17:"cforms4_cmsg_html";s:358:"<div style="font:normal 1em arial; margin-top:10px"><p><strong>Dear {Your Name},</strong></p>\n<p>Thank you for your note!</p>\n<p>We will get back to you as soon as possible.\n<div style="width:80%; background:#f4faff ; color:#aaa; font-size:11px; padding:10px; margin-top:20px"><strong>This is an automatic confirmation message. {Date}.</strong></div></div>\n\n";s:13:"cforms4_email";s:21:"athifsaleem@gmail.com";s:17:"cforms4_fromemail";s:21:"athifsaleem@gmail.com";s:11:"cforms4_bcc";s:0:"";s:14:"cforms4_header";s:149:"A new submission (form: \\"{Form Name}\\")\r\n============================================\r\nSubmitted on: {Date}\r\nVia: {Page}\r\nBy {IP} (visitor IP).\r\n.\r\n";s:19:"cforms4_header_html";s:145:"<p style=\\"font:normal 0.8em Verdana; text-align:right; color:#777; margin:3px 0\\">a form has been submitted on {Date}, via: {Page} [IP {IP}]</p>";s:16:"cforms4_formdata";s:4:"1110";s:13:"cforms4_space";s:2:"30";s:21:"cforms4_noattachments";s:1:"0";s:15:"cforms4_subject";s:26:"A comment from {Your Name}";s:19:"cforms4_submit_text";s:18:"Submit Application";s:15:"cforms4_success";s:35:"Thank you for signing up with APSN!";s:15:"cforms4_failure";s:39:"Please fill in all the required fields.";s:16:"cforms4_limittxt";s:59:"<strong>No more submissions accepted at this time.</strong>";s:15:"cforms4_working";s:20:"One moment please...";s:13:"cforms4_popup";s:2:"nn";s:15:"cforms4_showpos";s:5:"ynyyy";s:12:"cforms4_hide";b:0;s:16:"cforms4_redirect";b:1;s:21:"cforms4_redirect_page";s:33:"http://localhost/apsn/?page_id=22";s:14:"cforms4_action";s:1:"0";s:19:"cforms4_action_page";s:7:"http://";s:18:"cforms4_upload_dir";s:80:"/Applications/XAMPP/xamppfiles/htdocs/apsn/wp-content/plugins/cforms/attachments";s:18:"cforms4_upload_ext";N;s:19:"cforms4_upload_size";N;s:16:"cforms4_tracking";s:0:"";s:19:"cforms4_tellafriend";s:2:"01";s:17:"cforms4_dashboard";s:1:"0";s:18:"cforms4_maxentries";s:0:"";s:18:"cforms4_confirmerr";i:8;s:12:"cforms4_noid";s:1:"0";s:18:"cforms4_formaction";b:0;s:18:"cforms4_notracking";b:0;s:19:"cforms4_customnames";s:1:"0";s:17:"cforms4_startdate";s:1:" ";s:15:"cforms4_enddate";s:1:" ";s:16:"cforms4_emailoff";s:1:"0";s:21:"cforms4_emailpriority";s:1:"3";s:10:"cforms4_mp";a:8:{s:7:"mp_form";b:1;s:7:"mp_next";s:2:"-1";s:8:"mp_first";b:0;s:8:"mp_email";b:0;s:8:"mp_reset";b:1;s:12:"mp_resettext";s:9:"Reset All";s:7:"mp_back";b:1;s:11:"mp_backtext";s:14:"Back to Part 3";}s:13:"cforms4_tafCC";s:1:"0";}}', 'yes'),
(181, 0, 'formbuilder_permissions', 'a:3:{s:8:"level_10";a:3:{s:7:"connect";s:3:"yes";s:6:"create";s:3:"yes";s:6:"manage";s:3:"yes";}s:7:"level_7";a:3:{s:7:"connect";s:3:"yes";s:6:"create";s:3:"yes";s:6:"manage";s:2:"no";}s:7:"level_2";a:3:{s:7:"connect";s:3:"yes";s:6:"create";s:2:"no";s:6:"manage";s:2:"no";}}', 'yes'),
(155, 0, 'recently_activated', 'a:1:{s:41:"advanced-events-registration/espresso.php";i:1320960353;}', 'yes'),
(156, 0, '_site_transient_timeout_wporg_theme_feature_list', '1317361336', 'yes'),
(157, 0, '_site_transient_wporg_theme_feature_list', 'a:5:{s:6:"Colors";a:15:{i:0;s:5:"black";i:1;s:4:"blue";i:2;s:5:"brown";i:3;s:4:"gray";i:4;s:5:"green";i:5;s:6:"orange";i:6;s:4:"pink";i:7;s:6:"purple";i:8;s:3:"red";i:9;s:6:"silver";i:10;s:3:"tan";i:11;s:5:"white";i:12;s:6:"yellow";i:13;s:4:"dark";i:14;s:5:"light";}s:7:"Columns";a:6:{i:0;s:10:"one-column";i:1;s:11:"two-columns";i:2;s:13:"three-columns";i:3;s:12:"four-columns";i:4;s:12:"left-sidebar";i:5;s:13:"right-sidebar";}s:5:"Width";a:2:{i:0;s:11:"fixed-width";i:1;s:14:"flexible-width";}s:8:"Features";a:18:{i:0;s:8:"blavatar";i:1;s:10:"buddypress";i:2;s:17:"custom-background";i:3;s:13:"custom-colors";i:4;s:13:"custom-header";i:5;s:11:"custom-menu";i:6;s:12:"editor-style";i:7;s:21:"featured-image-header";i:8;s:15:"featured-images";i:9;s:20:"front-page-post-form";i:10;s:19:"full-width-template";i:11;s:12:"microformats";i:12;s:12:"post-formats";i:13;s:20:"rtl-language-support";i:14;s:11:"sticky-post";i:15;s:13:"theme-options";i:16;s:17:"threaded-comments";i:17;s:17:"translation-ready";}s:7:"Subject";a:3:{i:0;s:7:"holiday";i:1;s:13:"photoblogging";i:2;s:8:"seasonal";}}', 'yes'),
(240, 0, 'contexture_ps_db_version', '1.5', 'yes');
INSERT INTO `wp_options` (`option_id`, `blog_id`, `option_name`, `option_value`, `autoload`) VALUES
(241, 0, 'contexture_ps_options', 'a:10:{s:15:"ad_msg_usepages";s:4:"true";s:11:"ad_msg_anon";s:162:"You do not have the appropriate group permissions to access this page. Please try <a href="%login_url%">logging in</a> or contact an administrator for assistance.";s:11:"ad_msg_auth";s:179:"You do not have the appropriate group permissions to access this page. If you believe you <em>should</em> have access to this page, please contact an administrator for assistance.";s:15:"ad_page_anon_id";s:0:"";s:15:"ad_page_auth_id";s:1:"9";s:22:"ad_msg_usefilter_menus";s:4:"true";s:20:"ad_msg_usefilter_rss";s:4:"true";s:19:"ad_opt_protect_site";s:5:"false";s:19:"ad_opt_page_replace";s:5:"false";s:17:"ad_opt_login_anon";s:4:"true";}', 'yes'),
(284, 0, '_site_transient_timeout_browser_1a98a94e058d4cdab91a2a5e1d507acd', '1320874570', 'yes'),
(285, 0, '_site_transient_browser_1a98a94e058d4cdab91a2a5e1d507acd', 'a:9:{s:8:"platform";s:9:"Macintosh";s:4:"name";s:6:"Chrome";s:7:"version";s:12:"15.0.874.106";s:10:"update_url";s:28:"http://www.google.com/chrome";s:7:"img_src";s:49:"http://s.wordpress.org/images/browsers/chrome.png";s:11:"img_src_ssl";s:48:"https://wordpress.org/images/browsers/chrome.png";s:15:"current_version";s:2:"13";s:7:"upgrade";b:0;s:8:"insecure";b:0;}', 'yes'),
(338, 0, 'category_children', 'a:0:{}', 'yes'),
(364, 0, 'events_attendee_tbl_version', '3.1.12.L', 'no'),
(365, 0, 'events_attendee_tbl', 'wp_events_attendee', 'no'),
(366, 0, 'events_attendee_meta_tbl_version', '3.1.12.L', 'no'),
(367, 0, 'events_attendee_meta_tbl', 'wp_events_attendee_meta', 'no'),
(368, 0, 'events_detail_tbl_version', '3.1.12.L', 'no'),
(369, 0, 'events_detail_tbl', 'wp_events_detail', 'no'),
(370, 0, 'events_meta_tbl_version', '3.1.12.L', 'no'),
(371, 0, 'events_meta_tbl', 'wp_events_meta', 'no'),
(372, 0, 'events_email_tbl_version', '3.1.12.L', 'no'),
(373, 0, 'events_email_tbl', 'wp_events_email', 'no'),
(374, 0, 'events_category_detail_tbl_version', '3.1.12.L', 'no'),
(375, 0, 'events_category_detail_tbl', 'wp_events_category_detail', 'no'),
(376, 0, 'events_category_rel_tbl_version', '3.1.12.L', 'no'),
(377, 0, 'events_category_rel_tbl', 'wp_events_category_rel', 'no'),
(378, 0, 'events_venue_tbl_version', '3.1.12.L', 'no'),
(379, 0, 'events_venue_tbl', 'wp_events_venue', 'no'),
(380, 0, 'events_venue_rel_tbl_version', '3.1.12.L', 'no'),
(381, 0, 'events_venue_rel_tbl', 'wp_events_venue_rel', 'no'),
(382, 0, 'events_locale_tbl_version', '3.1.12.L', 'no'),
(383, 0, 'events_locale_tbl', 'wp_events_locale', 'no'),
(384, 0, 'events_locale_rel_tbl_version', '3.1.12.L', 'no'),
(385, 0, 'events_locale_rel_tbl', 'wp_events_locale_rel', 'no'),
(386, 0, 'events_personnel_tbl_version', '3.1.12.L', 'no'),
(387, 0, 'events_personnel_tbl', 'wp_events_personnel', 'no'),
(388, 0, 'events_personnel_rel_tbl_version', '3.1.12.L', 'no'),
(389, 0, 'events_personnel_rel_tbl', 'wp_events_personnel_rel', 'no'),
(390, 0, 'events_discount_rel_tbl_version', '3.1.12.L', 'no'),
(391, 0, 'events_discount_rel_tbl', 'wp_events_discount_rel', 'no'),
(392, 0, 'events_start_end_tbl_version', '3.1.12.L', 'no'),
(393, 0, 'events_start_end_tbl', 'wp_events_start_end', 'no'),
(394, 0, 'events_prices_tbl_version', '3.1.12.L', 'no'),
(395, 0, 'events_prices_tbl', 'wp_events_prices', 'no'),
(396, 0, 'events_discount_codes_tbl_version', '3.1.12.L', 'no'),
(397, 0, 'events_discount_codes_tbl', 'wp_events_discount_codes', 'no'),
(398, 0, 'events_multi_event_registration_id_group_tbl_version', '3.1.12.L', 'no'),
(399, 0, 'events_multi_event_registration_id_group_tbl', 'wp_events_multi_event_registration_id_group', 'no'),
(400, 0, 'events_attendee_cost_tbl_version', '3.1.12.L', 'no'),
(401, 0, 'events_attendee_cost_tbl', 'wp_events_attendee_cost', 'no'),
(402, 0, 'events_organization_settings', 'a:49:{s:12:"organization";s:4:"APSN";s:20:"organization_street1";s:18:"123 West Somewhere";s:20:"organization_street2";s:0:"";s:17:"organization_city";s:9:"Some City";s:18:"organization_state";s:2:"AZ";s:16:"organization_zip";s:5:"84128";s:13:"contact_email";s:21:"athifsaleem@gmail.com";s:12:"default_mail";s:1:"N";s:9:"paypal_id";s:23:"my_email@my_website.com";s:15:"payment_subject";s:33:"Payment Received for [event_name]";s:15:"payment_message";s:197:"***This Is An Automated Response***\r\n\r\nThank You [fname] [lname]\r\n\r\nWe have just received a payment in the amount of [event_price] for your registration to [event_name].\r\n\r\nTransaction ID: [txn_id]";s:7:"message";s:583:"***This is an automated response - Do Not Reply***\r\n\r\nThank you [fname] [lname] for registering for [event].\r\n\r\nThis event starts at [start_time] on [start_date] and runs until [end_time] on [end_date].\r\n\r\nLocation:\r\n[location]\r\n\r\nPhone: [location_phone]\r\n\r\nGoogle Map: [google_map_link]\r\n\r\nWe hope that you will find this event both informative and enjoyable. Should you have any questions, please contact [contact].\r\n\r\nIf you have not done so already, please submit your payment in the amount of [cost].\r\n\r\nClick here to review your payment information [payment_url].\r\n\r\nThank You.";s:10:"country_id";s:0:"";s:26:"expire_on_registration_end";s:1:"Y";s:20:"email_before_payment";s:1:"N";s:20:"enable_default_style";s:1:"Y";s:16:"event_ssl_active";N;s:17:"use_venue_manager";N;s:13:"event_page_id";s:2:"39";s:10:"return_url";s:2:"40";s:13:"cancel_return";s:2:"41";s:10:"notify_url";s:2:"42";s:20:"organization_country";s:1:"0";s:21:"organization_timezone";s:16:"America/New_York";s:15:"currency_format";s:3:"USD";s:15:"currency_symbol";s:1:"$";s:19:"events_listing_type";s:0:"";s:11:"use_sandbox";s:0:"";s:18:"events_in_dasboard";N;s:11:"use_captcha";N;s:19:"recaptcha_publickey";N;s:20:"recaptcha_privatekey";N;s:15:"recaptcha_theme";N;s:15:"recaptcha_width";N;s:18:"recaptcha_language";N;s:15:"use_custom_post";s:0:"";s:25:"espresso_dashboard_widget";N;s:14:"time_reg_limit";N;s:25:"use_attendee_pre_approval";N;s:28:"show_pending_payment_options";N;s:21:"use_personnel_manager";N;s:19:"use_event_timezones";N;s:12:"full_logging";N;s:9:"surcharge";N;s:14:"surcharge_type";N;s:14:"surcharge_text";N;s:15:"show_reg_footer";N;s:12:"affiliate_id";N;s:22:"default_payment_status";N;}', 'yes'),
(403, 0, 'events_question_tbl_version', '3.1.12.L', 'no'),
(404, 0, 'events_question_tbl', 'wp_events_question', 'no'),
(405, 0, 'events_qst_group_tbl_version', '3.1.12.L', 'no'),
(406, 0, 'events_qst_group_tbl', 'wp_events_qst_group', 'no'),
(407, 0, 'events_qst_group_rel_tbl_version', '3.1.12.L', 'no'),
(408, 0, 'events_qst_group_rel_tbl', 'wp_events_qst_group_rel', 'no'),
(409, 0, 'events_answer_tbl_version', '3.1.12.L', 'no'),
(410, 0, 'events_answer_tbl', 'wp_events_answer', 'no'),
(411, 0, 'events_seating_chart_tbl_version', '3.1.12.L', 'no'),
(412, 0, 'events_seating_chart_tbl', 'wp_events_seating_chart', 'no'),
(413, 0, 'events_seating_chart_seat_tbl_version', '3.1.12.L', 'no'),
(414, 0, 'events_seating_chart_seat_tbl', 'wp_events_seating_chart_seat', 'no'),
(415, 0, 'events_seating_chart_event_tbl_version', '3.1.12.L', 'no'),
(416, 0, 'events_seating_chart_event_tbl', 'wp_events_seating_chart_event', 'no'),
(417, 0, 'events_seating_chart_event_seat_tbl_version', '3.1.12.L', 'no'),
(418, 0, 'events_seating_chart_event_seat_tbl', 'wp_events_seating_chart_event_seat', 'no'),
(419, 0, 'widget_events-widget', 'a:2:{i:2;a:0:{}s:12:"_multiwidget";i:1;}', 'yes'),
(473, 0, '_transient_timeout_feed_dcef1f8abdbc2ff3e2274fce36e6f763', '1321003267', 'no');
INSERT INTO `wp_options` (`option_id`, `blog_id`, `option_name`, `option_value`, `autoload`) VALUES
(474, 0, '_transient_feed_dcef1f8abdbc2ff3e2274fce36e6f763', 'a:4:{s:5:"child";a:1:{s:0:"";a:1:{s:3:"rss";a:1:{i:0;a:6:{s:4:"data";s:2:"  ";s:7:"attribs";a:1:{s:0:"";a:1:{s:7:"version";s:3:"2.0";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:1:{s:0:"";a:1:{s:7:"channel";a:1:{i:0;a:6:{s:4:"data";s:18:"                  ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:3:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:64:"Event Espresso - WordPress Event Registration and Manager Plugin";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:24:"http://eventespresso.com";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:30:"An Event Manager for Wordpress";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:13:"lastBuildDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Tue, 08 Nov 2011 01:25:40 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"language";a:1:{i:0;a:5:{s:4:"data";s:2:"en";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:9:"generator";a:1:{i:0;a:5:{s:4:"data";s:29:"http://wordpress.org/?v=3.0.2";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"item";a:10:{i:0;a:6:{s:4:"data";s:14:"              ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:45:"Do Not Upgrade HTTPS (SSL) plugin by Mike Ems";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:75:"http://eventespresso.com/2011/11/event-espresso-wordpress-https-ssl-plugin/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:84:"http://eventespresso.com/2011/11/event-espresso-wordpress-https-ssl-plugin/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Tue, 08 Nov 2011 01:25:40 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:5:{i:0;a:5:{s:4:"data";s:4:"News";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:1;a:5:{s:4:"data";s:8:"Versions";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:2;a:5:{s:4:"data";s:17:"Wordpress Plugins";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:3;a:5:{s:4:"data";s:5:"https";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:4;a:5:{s:4:"data";s:3:"ssl";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:32:"http://eventespresso.com/?p=5073";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:328:"A recent update to the WordPress HTTPS (SSL) plugin (version 2.0) created conflicts with the Event Espresso registration pages. We have forked his plugin at version 1.9.2 to support our users. This version is now included for free for all users. If you upgraded your HTTPS (SSL) plugin to version 2.0, you can download the [...]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:5:"Garth";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:728:"<p>A recent update to the WordPress HTTPS (SSL) plugin (version 2.0) created conflicts with the Event Espresso registration pages. We have forked his plugin at version 1.9.2 to support our users. This version is now included for free for all users. If you upgraded your HTTPS (SSL) plugin to version 2.0, you can download the <a\ntitle="Event Espresso HTTPS SSL Plugin" href="http://ee-updates.s3.amazonaws.com/espresso-https.1.0.zip">Event Espresso HTTPS (SSL) plugin</a> to fix any SSL/secure transaction problems.</p><p>This for will be a relatively temporary fix until we can incorporate this functionality directly into the Event Espresso core plugin. We appologize for this convenience and thank you for your patience.</p> ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:80:"http://eventespresso.com/2011/11/event-espresso-wordpress-https-ssl-plugin/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"0";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:1;a:6:{s:4:"data";s:15:"               ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:40:"WordPress Events Manager Plugin Feedback";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:65:"http://eventespresso.com/2011/10/wordpress-events-manager-plugin/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:74:"http://eventespresso.com/2011/10/wordpress-events-manager-plugin/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Wed, 19 Oct 2011 03:58:00 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:6:{i:0;a:5:{s:4:"data";s:16:"Event Management";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:1;a:5:{s:4:"data";s:13:"Event Manager";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:2;a:5:{s:4:"data";s:18:"Event Registration";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:3;a:5:{s:4:"data";s:16:"event management";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:4;a:5:{s:4:"data";s:13:"event manager";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:5;a:5:{s:4:"data";s:12:"event plugin";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:32:"http://eventespresso.com/?p=5018";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:340:"We have a variety of customers from WordPress developers to event managers who need a WordPress events plugin to manage their online event registration and make their events more successful and profitable. While we acknowledge we are not perfect, we&#8217;d like to share some of the good feedback about our plugin and support that we [...]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:5:"Garth";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:2494:"<p>We have a variety of customers from WordPress developers to event managers who need a <a\ntitle="WordPress events manager plugin" href="http://eventespresso.com/download/">WordPress events plugin</a> to manage their <a\ntitle="online event registration software" href="http://eventespresso.com/download/">online event registration</a> and make their events more successful and profitable. While we acknowledge we are not perfect, we&#8217;d like to share some of the good feedback about our plugin and support that we have received recently from our WordPress event managers and developers.</p><blockquote><p>I recently downloaded [Event Espresso] to add to a nonprofit site for a Boy Scout troop and the features work wonderfully with what we wanted to accomplish for the site. It allows us to set up calendar, events, and even take payments for trips.  At first, I thought that it would be over kill for such a small site, but now I see the possibilities and will definitely be offering Event Espresso to my clients that need an event organization system for their web sites.&#8221; ~ http://BSA-troop462.org</p></blockquote><blockquote><p>Love the multi-event registration. The plugin is flawless with regards to attendee management.&#8221; ~ http://www.southeasthomeschoolexpo.com</p></blockquote><blockquote><p>I got quick feedback direct from the programmer and that helped make for a very favorable impression!&#8221; ~ http://beattystreetstudios.com.</p></blockquote><blockquote><p>I&#8217;ve only asked one question of the support thread and it was answered very quickly and easily &#8211; plus the archives of other questions have come in handy as well.&#8221; ~ http://www.wtcta.org</p></blockquote><blockquote><p>Quick, to-the-point, professional, friendly&#8230; Heck, this is what support should be like.&#8221; ~ http://www.nitaonline.org</p></blockquote><p>We&#8217;re confident you can have this type of experience with your online event registrations too.</p><p>If you&#8217;re not a customer already, please take a <a\ntitle="Free online event registration software" href="http://eventespresso.com/download/test-drive-event-espresso/">free test-drive of our online event registration software</a> which is the most complete and well supported <a\ntitle="WordPress events manager plugin" href="http://eventespresso.com/download/">WordPress events manager plugin</a>.</p><p>Please give us your <a\ntitle="Feedback" href="http://eventespresso.com/user-survey/">feedback</a>.</p> ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:70:"http://eventespresso.com/2011/10/wordpress-events-manager-plugin/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"0";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:2;a:6:{s:4:"data";s:14:"              ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:53:"We’re Powering Social Media Week Event Registration";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:79:"http://eventespresso.com/2011/09/powering-social-media-week-event-registration/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:88:"http://eventespresso.com/2011/09/powering-social-media-week-event-registration/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Sat, 24 Sep 2011 21:03:30 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:5:{i:0;a:5:{s:4:"data";s:11:"Development";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:1;a:5:{s:4:"data";s:16:"Event Management";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:2;a:5:{s:4:"data";s:18:"Event Registration";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:3;a:5:{s:4:"data";s:4:"News";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:4;a:5:{s:4:"data";s:19:"Technology Partners";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:32:"http://eventespresso.com/?p=4990";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:376:"Event Espresso is a major technology sponsor of Social Media Week. Event Espresso provided core registration functionality and developed powerful user management controls. A major portion of our involvement was making sure the roles and permissions, with the addition of regional manager permissions, set up to work across the network of 12 different sites/event cities. [...]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:5:"Garth";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:1724:"<p\nstyle="text-align: center;"><a\nhref="http://eventespresso.com/wp-content/uploads/2011/09/social-media-week.jpg"><img\nclass="aligncenter size-full wp-image-5003" title="Social Media Week" src="http://eventespresso.com/wp-content/uploads/2011/09/social-media-week.jpg" alt="Social Media Week Banner" width="625" height="106" /></a></p><p>Event Espresso is a major technology sponsor of <a\ntitle="Social Media" href="http://socialmediaweek.org/">Social Media Week</a>. Event Espresso provided core registration functionality and developed powerful user management controls. A  major portion of our involvement was making sure the roles and  permissions, with the addition of regional manager permissions, set up  to work across the network of 12 different sites/event cities.<br\n/> Seth worked with them personally to make sure that the development went smoothly. Social Media Week had one designer and two developers working on an integrated theme.</p><p><strong>About Social Media Week</strong><br\n/> <a\ntitle="Social Media" href="http://socialmediaweek.org/">Social Media Week</a> (SMW) is a global platform that connects  people, content, and conversation around emerging trends in social and  mobile media. Delivered primarily through a network of  internationally hosted biannual conferences and online through social  and mobile media, Social Media Week brings hundreds of thousands of  people together every year through learning experiences that aim to  advance our understanding of social media’s role in society.</p><p><strong>UPDATE:</strong></p><p>This year Social Media Week surpassed 20,000 attendees, across 700+ events, in 12 different cities around the world, from September 19th to 23rd, 2011.</p> ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:84:"http://eventespresso.com/2011/09/powering-social-media-week-event-registration/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"0";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:3;a:6:{s:4:"data";s:21:"                     ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:19:"Version 3.1 is Here";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:45:"http://eventespresso.com/2011/08/version-3-1/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:54:"http://eventespresso.com/2011/08/version-3-1/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Wed, 31 Aug 2011 05:45:57 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:12:{i:0;a:5:{s:4:"data";s:12:"New Versions";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:1;a:5:{s:4:"data";s:4:"News";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:2;a:5:{s:4:"data";s:8:"Versions";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:3;a:5:{s:4:"data";s:3:"3.1";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:4;a:5:{s:4:"data";s:5:"admin";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:5;a:5:{s:4:"data";s:8:"customer";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:6;a:5:{s:4:"data";s:4:"fast";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:7;a:5:{s:4:"data";s:7:"payment";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:8;a:5:{s:4:"data";s:12:"registration";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:9;a:5:{s:4:"data";s:7:"reports";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:10;a:5:{s:4:"data";s:9:"ticketing";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:11;a:5:{s:4:"data";s:8:"versions";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:32:"http://eventespresso.com/?p=4902";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:376:"The latest update is located here. As we continue toward our goal to offer event organizers autonomy through the best event registration and ticketing software, Event Espresso 3.1 brings significant improvements including: New Features Added support for custom style sheet selection Venue and Staff Manager shortcodes Meta data support for Events, Venues and Staff Added [...]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:5:"Garth";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:6811:"<div\nclass="wp-caption alignleft" style="width: 135px"><a\nhref="http://ee-screenshots.s3.amazonaws.com/2011/09/banner125x125.jpg"><img\ntitle="Event Espresso Version 3.1 Now Available" src="http://ee-screenshots.s3.amazonaws.com/2011/09/banner125x125.jpg" alt="Event Espresso Version 3.1 Now Available" width="125" height="125" /></a><p\nclass="wp-caption-text">Event Espresso Version 3.1 Now Available</p></div><p><strong>The latest update is <a\nhref="http://eventespresso.com/forums/2011/08/version-3-1/" target="_blank">located here</a>.</strong></p><p>As we continue toward our goal to offer event organizers autonomy through the best event registration and ticketing software, <a\ntitle="Event Espresso 3.1" href="http://eventespresso.com/forums/2011/08/version-3-1/">Event Espresso 3.1</a> brings significant improvements including:</p><p><strong>New Features</strong></p><ul><li>Added support for custom style sheet selection</li><li>Venue and Staff Manager shortcodes</li><li>Meta data support for Events, Venues and Staff</li><li>Added Eway, Merchant Warrior, and 2checkout payment gateways</li><li>Optimized attendee and payment editing</li><li>Attendees can return and update registration details</li><li>And more</li></ul><p><strong>Updates/Changes/Fixes </strong></p><ul><li>SPEED! In some cases we&#8217;ve reduced page load times down 80%</li><li>Fixed the problem with adding/editing links in the editors Read more: Coming Soon – Version 3.1.0</li><li>Fixed Internet Explorer bug in the event editor Read more: Coming Soon – Version 3.1</li><li>Fixed the email system to send emails to all registrants when registering for multiple events Read more: Coming Soon – Version 3.1</li><li>Optimized database queries</li><li>Fixed attendee overview issues and attendee totals</li><li>Fixed SSL problems</li><li>Removed (unused) TimThumb script (security update)</li><li>And that&#8217;s not all</li></ul><p><strong>Screen Shots</strong></p><p\nstyle="text-align: center;"><div\nclass="wp-caption aligncenter" style="width: 616px"><a\nhref="http://ee-updates.s3.amazonaws.com/images/event-listing-8-23-11.jpg"><img\nclass=" " title="Event Espresso Event Listings" src="http://ee-updates.s3.amazonaws.com/images/event-listing-8-23-11.jpg" alt="Redesigned Event Listings" width="606" height="472" /></a><p\nclass="wp-caption-text">Redesigned Event Listings</p></div><div\nclass="wp-caption aligncenter" style="width: 621px"><a\nhref="http://ee-updates.s3.amazonaws.com/images/registration-forms-8-23-11.jpg"><img\nclass=" " title="Redesigned Registration Forms" src="http://ee-updates.s3.amazonaws.com/images/registration-forms-8-23-11.jpg" alt="Event Espresso Registration Forms" width="611" height="753" /></a><p\nclass="wp-caption-text">Redesigned Registration Forms</p></div><p\nstyle="text-align: center;"><div\nclass="wp-caption aligncenter" style="width: 440px"><a\nhref="http://ee-screenshots.s3.amazonaws.com/2011/08/shortcodes-in-action-8-23-11.jpg"><img\nclass=" " title="Event Description Shortcodes" src="http://ee-screenshots.s3.amazonaws.com/2011/08/shortcodes-in-action-8-23-11.jpg" alt="Event Description Shortcodes" width="430" height="550" /></a><p\nclass="wp-caption-text">Event Description Shortcodes</p></div><p\nstyle="text-align: center;"><div\nclass="wp-caption aligncenter" style="width: 457px"><a\nhref="http://ee-screenshots.s3.amazonaws.com/2011/08/edit-registration-details-8-23-11.jpg"><img\nclass=" " title="Edit Registration Details" src="http://ee-screenshots.s3.amazonaws.com/2011/08/edit-registration-details-8-23-11.jpg" alt="Edit Registration Details" width="447" height="692" /></a><p\nclass="wp-caption-text">Edit Registration Details</p></div><p\nstyle="text-align: center;"><div\nclass="wp-caption aligncenter" style="width: 499px"><a\nhref="http://ee-screenshots.s3.amazonaws.com/2011/08/visual-styles-08-23-11.jpg"><img\nclass=" " title="Enhanced Event Templates and Styles" src="http://ee-screenshots.s3.amazonaws.com/2011/08/visual-styles-08-23-11.jpg" alt="Enhanced Event Templates and Styles" width="489" height="619" /></a><p\nclass="wp-caption-text">Enhanced Event Templates and Styles</p></div><p\nstyle="text-align: center;"><div\nclass="wp-caption aligncenter" style="width: 801px"><a\nhref="http://ee-screenshots.s3.amazonaws.com/2011/08/attendee-graphic-reports-08-23-11.jpg"><img\nclass=" " title="Graphical Attendee Reports" src="http://ee-screenshots.s3.amazonaws.com/2011/08/attendee-graphic-reports-08-23-11.jpg" alt="Graphical Attendee Reports" width="791" height="365" /></a><p\nclass="wp-caption-text">Graphical Attendee Reports</p></div><p\nstyle="text-align: center;"><div\nclass="wp-caption aligncenter" style="width: 666px"><a\nhref="http://ee-screenshots.s3.amazonaws.com/2011/08/event-overview-08-23-11.jpg"><img\nclass=" " title="Optimized Event Admin Area" src="http://ee-screenshots.s3.amazonaws.com/2011/08/event-overview-08-23-11.jpg" alt="Optimized Event Admin Area" width="656" height="424" /></a><p\nclass="wp-caption-text">Optimized Event Admin Area</p></div><p\nstyle="text-align: center;"><div\nclass="wp-caption aligncenter" style="width: 674px"><a\nhref="http://ee-updates.s3.amazonaws.com/images/optimized-attendee-reports-08-23-11.jpg"><img\nclass=" " title="Fast Attendee Reports" src="http://ee-updates.s3.amazonaws.com/images/optimized-attendee-reports-08-23-11.jpg" alt="Fast Attendee Reports" width="664" height="383" /></a><p\nclass="wp-caption-text">Fast Attendee Reports</p></div><p\nstyle="text-align: center;"><div\nclass="wp-caption aligncenter" style="width: 630px"><a\nhref="http://ee-screenshots.s3.amazonaws.com/2011/08/admin-attendee-editor-9-23-11.jpg"><img\nclass=" " title="Optimized Attendee Management" src="http://ee-screenshots.s3.amazonaws.com/2011/08/admin-attendee-editor-9-23-11.jpg" alt="Optimized Attendee Management" width="620" height="633" /></a><p\nclass="wp-caption-text">Optimized Attendee Management</p></div><div\nclass="wp-caption aligncenter" style="width: 626px"><a\nhref="http://ee-screenshots.s3.amazonaws.com/2011/08/payment-admin-8-23-11.jpg"><img\nclass=" " title="Optimized Payment Management" src="http://ee-screenshots.s3.amazonaws.com/2011/08/payment-admin-8-23-11.jpg" alt="Optimized Payment Management" width="616" height="386" /></a><p\nclass="wp-caption-text">Optimized Payment Management</p></div><p\nstyle="text-align: center;"><div\nclass="wp-caption aligncenter" style="width: 572px"><a\nhref="http://ee-screenshots.s3.amazonaws.com/2011/08/help-support-page-8-23-11.jpg"><img\nclass=" " title="Added Support Area" src="http://ee-screenshots.s3.amazonaws.com/2011/08/help-support-page-8-23-11.jpg" alt="Added Support Area" width="562" height="465" /></a><p\nclass="wp-caption-text">Added Support Area</p></div><p>We are in the final stages of testing, but feel free to get excited and please spread the news!</p> ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:50:"http://eventespresso.com/2011/08/version-3-1/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"4";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:4;a:6:{s:4:"data";s:14:"              ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:41:"We’re Sponsoring WordCamp San Francisco";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:67:"http://eventespresso.com/2011/07/sponsoring-wordcamp-san-francisco/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:76:"http://eventespresso.com/2011/07/sponsoring-wordcamp-san-francisco/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Thu, 28 Jul 2011 06:07:25 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:5:{i:0;a:5:{s:4:"data";s:6:"Events";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:1;a:5:{s:4:"data";s:4:"News";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:2;a:5:{s:4:"data";s:8:"WordCamp";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:3;a:5:{s:4:"data";s:9:"Wordpress";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:4;a:5:{s:4:"data";s:17:"Wordpress Plugins";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:32:"http://eventespresso.com/?p=4749";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:345:"We’re pleased to announce that the 6th WordCamp on our 2011 sponsorship schedule is San Francisco, Friday, August 12th – to – Sunday, August 14th at the Mission Bay Conference Center. There will also be auxiliary events over the weekend at the Automattic Lounge at Pier 38. WordCamp San Francisco 2011, the official annual conference [...]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:4:"Seth";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:1753:"<p><a\nhref="http://2011.sf.wordcamp.org"><img\nclass="alignright" title="I''m sponsoring WordCamp San Francisco 2011!" src="http://2011.sf.wordcamp.org/files/2011/07/wcsf11-badge-sponsor.png" alt="I''m sponsoring WordCamp San Francisco 2011!" width="150" height="150" /></a>We’re pleased to announce that the 6th WordCamp on our 2011 sponsorship schedule is San Francisco, Friday, August 12th – to – Sunday, August 14th at the <a\nhref="http://maps.google.com/maps/ms?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;ie=UTF8&amp;hq=&amp;hnear=38+Pier,+San+Francisco,+California+94111&amp;msa=0&amp;msid=210102532727561902705.000482f4e0053f1b156dc&amp;ll=37.777228,-122.389755&amp;spn=0.040704,0.109863" target="_blank">Mission Bay Conference Center</a>. There will also be auxiliary events over the weekend at the Automattic Lounge at Pier 38.</p><blockquote><p><a\nhref="http://2011.sf.wordcamp.org/" target="_blank">WordCamp San Francisco 2011</a>, the official annual conference of the WordPress open source project, will be the weekend of <strong>August 12-14</strong>,  with three days of sessions for publishers, bloggers, and developers at  the Mission Bay Conference Center and another day or two of related  events around town, including a core contributors summit and various  mini-meetups.</p></blockquote><p>As with other WordCamps we sponsor, there is likely to be licenses of Event Espresso given away to a few lucky individuals who are at the San Francisco WordCamp and special  offers made available to all the participants and those following Event Espresso on Twitter during the WordCamp.</p><p><a\nhref="http://2011.sf.wordcamp.org/get-tickets/" target="_blank">Register today</a> to reserve your seat at this west coast WordCamp.</p> ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:72:"http://eventespresso.com/2011/07/sponsoring-wordcamp-san-francisco/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"1";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:5;a:6:{s:4:"data";s:14:"              ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:22:"Meetup.com Alternative";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:56:"http://eventespresso.com/2011/06/meetup-com-alternative/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:65:"http://eventespresso.com/2011/06/meetup-com-alternative/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Wed, 08 Jun 2011 16:58:57 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:5:{i:0;a:5:{s:4:"data";s:10:"Eventbrite";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:1;a:5:{s:4:"data";s:6:"Events";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:2;a:5:{s:4:"data";s:12:"Registration";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:3;a:5:{s:4:"data";s:9:"Ticketing";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:4;a:5:{s:4:"data";s:6:"meetup";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:32:"http://eventespresso.com/?p=4700";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:325:"Event Espresso customers come from all parts of the world and use our plugins for a wide variety of reasons. A few of our current customers were looking for an alternative to meetup.com. This is what they said they didn&#8217;t like about it: Meetup.com is Expensive &#8211; Their fees range between $12 &#8211; $24 per [...]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:5:"Garth";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:1877:"<div\nid="attachment_4710" class="wp-caption alignleft" style="width: 220px"><a\nhref="http://eventespresso.com/wp-content/uploads/2011/06/name_badge_red.jpg"><img\nclass="size-full wp-image-4710 " title="Alternative to Meetup.com" src="http://eventespresso.com/wp-content/uploads/2011/06/name_badge_red.jpg" alt="Alternative to Meetup.com" width="210" height="210" /></a><p\nclass="wp-caption-text">Alternative to Meetup.com</p></div><p>Event Espresso customers come from all parts of the world and use our plugins for a wide variety of reasons. A few of our current customers were looking for an alternative to meetup.com. This is what they said they didn&#8217;t like about it:</p><ul><li>Meetup.com is Expensive &#8211; Their fees range between $12 &#8211; $24 per group per month!</li><li>Meetup.com is Controlling &#8211; Event organizers have very little over their brand (the style and functionality) of their user&#8217;s experience!</li><li>Meetup.com is Too Simple &#8211; While simplicity is good for some people, too simple doesn&#8217;t get the job done and they don&#8217;t have enough of the features to get everything done the right way.</li></ul><p><a\ntitle="About Event Espresso Mission" href="http://eventespresso.com/about/">Event Espresso&#8217;s mission</a> is &#8220;to empower business and organization leaders with the  event  registration, ticketing and management tools that maximize the  success  of events.&#8221; With Event Espresso, you can be more autonomous and empowered, and create your own alternative to meetup.com. With Event Espresso, you can save more money, control your user&#8217;s experience and your brand, and you can get your event registration done more like you want them. We understand there is a place for some people to want or use these type of services, but we certainly want people to understand there is another option.</p> ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:61:"http://eventespresso.com/2011/06/meetup-com-alternative/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"1";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:6;a:6:{s:4:"data";s:16:"                ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:49:"Now Available: Multiple Event Registration Add-on";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:78:"http://eventespresso.com/2011/05/available-multiple-event-registration-add-on/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:87:"http://eventespresso.com/2011/05/available-multiple-event-registration-add-on/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Fri, 27 May 2011 07:33:14 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:7:{i:0;a:5:{s:4:"data";s:6:"Addons";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:1;a:5:{s:4:"data";s:16:"Event Management";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:2;a:5:{s:4:"data";s:8:"Features";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:3;a:5:{s:4:"data";s:12:"New Versions";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:4;a:5:{s:4:"data";s:4:"News";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:5;a:5:{s:4:"data";s:12:"Registration";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:6;a:5:{s:4:"data";s:9:"Ticketing";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:32:"http://eventespresso.com/?p=4661";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:338:"We&#8217;d like to make a quick announcement that the Multi-Event Registration Add-on is now available for purchase. We understand that it took longer to complete than we wanted it to, and we still have plans for its future, but we couldn&#8217;t hold it back any longer. This add-on allows allows attendees to register for multiple [...]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:5:"Garth";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:2526:"<p>We&#8217;d like to make a quick announcement that the <a\ntitle="multiple event registration" href="http://eventespresso.com/download/plugins-and-addons/multiple-event-registration/">Multi-Event Registration Add-on</a> is now available for purchase. We understand that it took longer to complete than we wanted it to, and we still have plans for its future, but we couldn&#8217;t hold it back any longer. This add-on allows allows attendees to register for multiple events during a single checkout, and even add additional attendees. This add-on makes it easy for your attendees to register by giving them an option to reuse the information later in the registration form if they are registering the same person for multiple events.</p><p>We are very excited about this add-on because as far as we can tell it is a first among the commercial event registration industry, and certainly among the WordPress Plugin market. The Multi-Event Registration Addon is now included in the <a\ntitle="Event Espresso Advanced Version" href="http://eventespresso.com/download/advanced/">Advanced</a> and <a\ntitle="Event Espresso Developer License" href="http://eventespresso.com/download/developer/">Developer</a> licenses of Event Espresso.  Enjoy!</p><p>Price: $39.95</p><div><a\nhref="https://www.e-junkie.com/ecom/gb.php?c=cart&i=MER-ADDON&cl=113214&ejc=2" target="ej_ejc" class="ec_ejc_thkbx" onClick="javascript:return EJEJC_lc(this);"><img\nsrc="http://espresso-site.s3.amazonaws.com/wp-content/uploads/2010/08/add-to-cart-small.gif" border="0" alt="Add to Cart"/></a> | <a\nhref="https://www.e-junkie.com/ecom/gb.php?c=cart&cl=113214&ejc=2" target="ej_ejc" class="ec_ejc_thkbx" onClick="javascript:return EJEJC_lc(this);"><img\nsrc="http://espresso-site.s3.amazonaws.com/wp-content/uploads/2010/08/checkout-button-small.gif" border="0" alt="View Cart"/></a></div><div\nclass="wp-caption alignright" style="width: 249px"><a\nhref="http://ee-screenshots.s3.amazonaws.com/2011/03/cart-checkout.gif"><img\nclass="  " title="Event Checkout" src="http://ee-screenshots.s3.amazonaws.com/2011/03/cart-checkout.gif" alt="Event Checkout" width="239" height="334" /></a><p\nclass="wp-caption-text">Event Checkout</p></div><div\nclass="wp-caption alignleft" style="width: 265px"><a\nhref="http://ee-screenshots.s3.amazonaws.com/2011/03/event-cart.gif"><img\nclass="   " title="Event Cart" src="http://ee-screenshots.s3.amazonaws.com/2011/03/event-cart.gif" alt="Event Cart" width="255" height="311" /></a><p\nclass="wp-caption-text">Event Cart</p></div> ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:83:"http://eventespresso.com/2011/05/available-multiple-event-registration-add-on/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"0";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:7;a:6:{s:4:"data";s:21:"                     ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:30:"Mobile Ticketing Apps Released";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:64:"http://eventespresso.com/2011/05/mobile-ticketing-apps-released/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:73:"http://eventespresso.com/2011/05/mobile-ticketing-apps-released/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Thu, 19 May 2011 18:25:52 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:12:{i:0;a:5:{s:4:"data";s:6:"Addons";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:1;a:5:{s:4:"data";s:11:"Development";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:2;a:5:{s:4:"data";s:12:"Registration";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:3;a:5:{s:4:"data";s:9:"Ticketing";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:4;a:5:{s:4:"data";s:9:"Wordpress";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:5;a:5:{s:4:"data";s:17:"Wordpress Plugins";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:6;a:5:{s:4:"data";s:7:"android";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:7;a:5:{s:4:"data";s:3:"ios";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:8;a:5:{s:4:"data";s:6:"iphone";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:9;a:5:{s:4:"data";s:4:"ipod";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:10;a:5:{s:4:"data";s:6:"Mobile";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:11;a:5:{s:4:"data";s:9:"ticketing";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:32:"http://eventespresso.com/?p=4588";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:355:"We&#8217;d like to announce today that we have released the Event Espresso Mobile Ticketing Apps for iphone, iPod, and Android mobile devices. These mobile platforms bring event managers and organizers even more autonomy and power to setup their own registration system. The Event Espresso plugin for WordPress and our iOS and Android apps: Speed up [...]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:5:"Garth";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:2524:"<div\nclass="wp-caption alignleft" style="width: 240px"><a\nhref="http://eventespresso.com/download/mobile-ticketing-apps/"><img\nclass="  " title="Event Espresso Mobile Ticketing Apps" src="http://ee-screenshots.s3.amazonaws.com/2011/05/App1.png" alt="Event Espresso Mobile Ticketing Apps" width="230" height="346" /></a><p\nclass="wp-caption-text">Event Espresso Mobile Ticketing Apps</p></div><p>We&#8217;d like to announce today that we have released the Event Espresso <a\ntitle="Event Espresso Mobile Ticketing Apps" href="http://eventespresso.com/download/mobile-ticketing-apps/">Mobile Ticketing Apps</a> for iphone, iPod, and Android mobile devices. These mobile platforms bring event managers and organizers even more autonomy and power to setup their own registration system.</p><p>The Event Espresso plugin for WordPress and our iOS and Android apps:</p><ul><li>Speed up registrations at the door</li><li>Integrates in real-time with the attendee list in Event Espresso</li><li>Allows  for multiple check-in “stations”. Eg. Use multiple iPhones/Android  phones to log into to the same attendee list so employees can scan  tickets using multiple different mobile devices</li><li>Send an e-mail to the  ticket holder with a “Thank you for Attending” – This will save time  from currently having to check the name off and having attendees sign a  confirmation that they were present at the event. This will help to  avoid refund situations (coming soon)</li><li>Keep your events “<a\nhref="http://en.wikipedia.org/wiki/Environmentally_friendly" target="_blank">Green</a>” by providing an environmentally friendly ticketing solution</li><li>Custom tickets can double as a name badge</li><li>Makes your organization very official and innovative</li></ul><p>Download the <a\ntitle="wordpress event ticketing mobile app" href="http://eventespresso.com/download/mobile-ticketing-apps/">Mobile Ticketing Apps</a> | Purchase the <a\nhref="../2011/02/2011/01/customizable-printable-event-tickets-qr-code/">QR Code ticketing addon</a></p><p><em>Requirements</em>: Event Espresso <a\nhref="../download/forums/category/premium-plugin-support/news-and-updates/">version</a> 3.0.19.p.34 or greater and purchase of the <a\nhref="../download/2011/02/2011/01/customizable-printable-event-tickets-qr-code/">QR Code ticketing addon</a>.  Note: the ticketing app will work with some earlier versions of Event  Espresso, but 3.0.19.p.34 has the ability to check people in/out of the  event if the ticketing addon is installed.</p> ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:69:"http://eventespresso.com/2011/05/mobile-ticketing-apps-released/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"1";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:8;a:6:{s:4:"data";s:13:"             ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:46:"Drag-and-Drop Questions Into Order or Sequence";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:71:"http://eventespresso.com/2011/05/drag-and-drop-question-order-sequence/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:80:"http://eventespresso.com/2011/05/drag-and-drop-question-order-sequence/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Thu, 12 May 2011 19:51:31 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:4:{i:0;a:5:{s:4:"data";s:8:"Features";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:1;a:5:{s:4:"data";s:12:"New Versions";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:2;a:5:{s:4:"data";s:4:"News";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:3;a:5:{s:4:"data";s:17:"Wordpress Plugins";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:32:"http://eventespresso.com/?p=4548";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:378:"We&#8217;ve made it even easier for you to create custom registration forms with drag-and-drop technology. Simply drag-and-drop the questions into place, or in the order, you want them displayed on the registration form. We also incorporated this technology into the question groups. Question Groups can be organized or re-ordered by dragging and dropping individual table [...]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:5:"Garth";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:1182:"<p>We&#8217;ve made it even easier for you to create <a\ntitle="Custom Event Registration Forms" href="http://eventespresso.com/features/custom-registration-forms/">custom registration forms</a> with drag-and-drop technology. Simply drag-and-drop the questions into place, or in the order, you want them displayed on the registration form.</p><p>We also incorporated this technology into the question groups. Question Groups can be organized or re-ordered by dragging and dropping individual table rows into the desired positions.</p><p>This improvement was just released today and is available in<a\ntitle="Event Espresso Updates" href="http://eventespresso.com/forums/category/premium-plugin-support/news-and-updates/"> versions</a> 3.0.19.P31 and later.</p><p\nstyle="text-align: center;"><div\nclass="wp-caption aligncenter" style="width: 584px"><a\nhref="http://ee-screenshots.s3.amazonaws.com/2011/05/drag-and-drop.gif"><img\nclass=" " title="Drag-and-Drop Question Manager" src="http://ee-screenshots.s3.amazonaws.com/2011/05/drag-and-drop.gif" alt="Drag-and-Drop Question Manager" width="574" height="170" /></a><p\nclass="wp-caption-text">Drag-and-Drop Question Manager</p></div> ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:76:"http://eventespresso.com/2011/05/drag-and-drop-question-order-sequence/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"1";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:9;a:6:{s:4:"data";s:20:"                    ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:40:"Coming Soon: Multiple Event Registration";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:73:"http://eventespresso.com/2011/04/coming-soon-multiple-event-registration/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:82:"http://eventespresso.com/2011/04/coming-soon-multiple-event-registration/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Mon, 25 Apr 2011 15:33:03 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:11:{i:0;a:5:{s:4:"data";s:6:"Addons";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:1;a:5:{s:4:"data";s:11:"Development";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:2;a:5:{s:4:"data";s:16:"Event Management";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:3;a:5:{s:4:"data";s:6:"Events";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:4;a:5:{s:4:"data";s:4:"News";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:5;a:5:{s:4:"data";s:12:"Registration";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:6;a:5:{s:4:"data";s:9:"Ticketing";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:7;a:5:{s:4:"data";s:18:"event registration";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:8;a:5:{s:4:"data";s:11:"multi-event";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:9;a:5:{s:4:"data";s:14:"multiple event";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:10;a:5:{s:4:"data";s:15:"single checkout";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:32:"http://eventespresso.com/?p=4188";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:322:"Updated: The Multi-Event Registration Add-on is now available. I don&#8217;t know how else to put it, except to say that this is really awesome functionality! Gone are the days when people can only register for one event at a time. We have been developing a system that allows people to register and pay for multiple [...]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:5:"Garth";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:2790:"<p>Updated: The <a\nhref="http://eventespresso.com/download/plugins-and-addons/multiple-event-registration/" alt="multiple event registration form" title="multiple multi-event registration event registration">Multi-Event Registration Add-on</a> is now available.</p><p><a\nhref="http://ee-screenshots.s3.amazonaws.com/2011/03/multiple-tickets.gif"><img\nclass="alignright" title="Multiple Event Registration" src="http://ee-screenshots.s3.amazonaws.com/2011/03/multiple-tickets.gif" alt="Multi-Event Registration" width="200" height="188" /></a>I don&#8217;t know how else to put it, except to say that this is really awesome functionality!</p><p>Gone are the days when people can only register for one event at a time. We have been developing a system that allows people to register and pay for multiple events at one time. The theory is that when it&#8217;s easier for your attendees to register for more events you will sell more tickets; and with the Multi-Event Registration System it couldn&#8217;t be easier.</p><p>Some of the features of the multi-event registration system <a\nhref="http://eventespresso.com/download/plugins-and-addons/">addon</a> include:</p><ul><li>Register or Add to Cart and Add More Events links &#8211; This gives the person the opportunity to immediately register for the single event or continue shopping to add more events to their cart.</li><li>Multiple Event Payment &#8211; The person registering can pay for an unlimited number of events at one time (paid or free events), all from one page.</li><li>Single Registration Page &#8211; The person registering can register for all the tickets they are purchasing all from one page. They can click a check box to reuse an attendee&#8217;s information or enter all new information for a different person.</li></ul><p>This new addon will be very useful in situations when you want attendees to register for a main event and also sub-events such as conference breakout sessions; when your events are for the entire family, but you want each member of the family to register for separate events; etc.</p><p>This new addon has taken a long time to construct but it&#8217;s nearly done. We are accepting <a\nhref="http://eventespresso.com/beta-test-application/">applications to beta test the multiple event registration addon</a>, and you can follow the <a\nhref="http://eventespresso.com/forums/2011/01/multi-event-registration-feedback-requested/">multi-event registration development</a> progress in the forums.</p><p>In order to keep the base-price of Event Espresso low for those who do not need this functionality, this addon will be sold separately for about $40.</p><p>We encourage all Event Espresso users to consider how the multi-event registration system can help you save time and sell more tickets.</p> ";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:78:"http://eventespresso.com/2011/04/coming-soon-multiple-event-registration/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:2:"20";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}}}s:27:"http://www.w3.org/2005/Atom";a:1:{s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:0:"";s:7:"attribs";a:1:{s:0:"";a:3:{s:4:"href";s:30:"http://eventespresso.com/feed/";s:3:"rel";s:4:"self";s:4:"type";s:19:"application/rss+xml";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:44:"http://purl.org/rss/1.0/modules/syndication/";a:2:{s:12:"updatePeriod";a:1:{i:0;a:5:{s:4:"data";s:6:"hourly";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:15:"updateFrequency";a:1:{i:0;a:5:{s:4:"data";s:1:"1";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}}}}}}}}s:4:"type";i:128;s:7:"headers";a:9:{s:4:"date";s:29:"Thu, 10 Nov 2011 21:21:05 GMT";s:6:"server";s:86:"Apache mod_fcgid/2.3.6 mod_auth_passthrough/2.1 mod_bwlimited/1.4 FrontPage/5.0.2.2635";s:10:"x-pingback";s:35:"http://eventespresso.com/xmlrpc.php";s:4:"etag";s:34:""028ba8fbff8ac23280847dec0b9d0652"";s:12:"x-powered-by";s:22:"W3 Total Cache/0.9.1.3";s:13:"last-modified";s:29:"Tue, 08 Nov 2011 01:25:40 GMT";s:4:"vary";s:26:"User-Agent,Accept-Encoding";s:12:"content-type";s:23:"text/xml; charset=UTF-8";s:10:"connection";s:5:"close";}s:5:"build";s:14:"20090627192103";}', 'no');
INSERT INTO `wp_options` (`option_id`, `blog_id`, `option_name`, `option_value`, `autoload`) VALUES
(475, 0, '_transient_timeout_feed_mod_dcef1f8abdbc2ff3e2274fce36e6f763', '1321003267', 'no'),
(476, 0, '_transient_feed_mod_dcef1f8abdbc2ff3e2274fce36e6f763', '1320960067', 'no'),
(424, 0, '_transient_timeout_feed_180a350ea4dfbf80d71e6c688d245b4e', '1320553512', 'no'),
(425, 0, '_transient_feed_180a350ea4dfbf80d71e6c688d245b4e', 'a:4:{s:5:"child";a:1:{s:0:"";a:1:{s:3:"rss";a:1:{i:0;a:6:{s:4:"data";s:3:"\n\n\n";s:7:"attribs";a:1:{s:0:"";a:1:{s:7:"version";s:3:"2.0";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:1:{s:0:"";a:1:{s:7:"channel";a:1:{i:0;a:6:{s:4:"data";s:50:"\n	\n	\n	\n	\n	\n	\n	\n	\n	\n		\n		\n		\n		\n		\n		\n		\n		\n		\n		\n	";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:3:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:21:"Event Espresso Forums";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:31:"http://eventespresso.com/forums";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:0:"";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:13:"lastBuildDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Fri, 04 Nov 2011 19:44:22 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"language";a:1:{i:0;a:5:{s:4:"data";s:2:"en";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:9:"generator";a:1:{i:0;a:5:{s:4:"data";s:29:"http://wordpress.org/?v=3.2.1";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"item";a:10:{i:0;a:6:{s:4:"data";s:41:"\n		\n		\n		\n		\n		\n				\n\n		\n		\n			\n			\n		\n		";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:20:"Event Expresso Blank";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:61:"http://eventespresso.com/forums/2011/11/event-expresso-blank/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:70:"http://eventespresso.com/forums/2011/11/event-expresso-blank/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Fri, 04 Nov 2011 19:44:22 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:1:{i:0;a:5:{s:4:"data";s:15:"General Support";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:61:"http://eventespresso.com/forums/2011/11/event-expresso-blank/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:325:"Hello We purchased the Event Espresso Basic 1 Support License, have received the download link have downloaded it and started to install as per the instruction inclosed. After installation there are two or three screen that are blank and it caused my entire dashboard to become blank. I have since went into c panel and [...]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:21:"Roddrick Duncanson Sr";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:561:"<p>Hello</p>\n<p> We purchased the Event Espresso Basic 1 Support License, have received the download link have downloaded it and started to install as per the instruction inclosed.</p>\n<p>After installation there are two or three screen that are blank and it caused my entire dashboard to become blank.</p>\n<p>I have since went into c panel and phpmyadmin and disable the plugin and everything came back.&#8217;</p>\n<p>Please help on getting the plugin up and running, also I need information on running it for volunteer database as well.</p>\n<p>Thanks Rod</p>\n";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:66:"http://eventespresso.com/forums/2011/11/event-expresso-blank/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"3";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:1;a:6:{s:4:"data";s:44:"\n		\n		\n		\n		\n		\n				\n		\n\n		\n		\n			\n			\n		\n		";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:13:"Category List";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:56:"http://eventespresso.com/forums/2011/11/category-list-2/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:65:"http://eventespresso.com/forums/2011/11/category-list-2/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Fri, 04 Nov 2011 19:26:09 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:2:{i:0;a:5:{s:4:"data";s:19:"Features & Requests";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:1;a:5:{s:4:"data";s:23:"EVENT_ESPRESSO_CATEGORY";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:56:"http://eventespresso.com/forums/2011/11/category-list-2/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:74:"What is the best way to list all the categories? [EVENT_ESPRESSO_CATEGORY]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:12:"Dave jackson";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:90:"<p>What is the best way to list all the categories?</p>\n<p>[EVENT_ESPRESSO_CATEGORY] </p>\n";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:61:"http://eventespresso.com/forums/2011/11/category-list-2/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"0";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:2;a:6:{s:4:"data";s:41:"\n		\n		\n		\n		\n		\n				\n\n		\n		\n			\n			\n		\n		";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:15:"WordPress Only?";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:55:"http://eventespresso.com/forums/2011/11/wordpress-only/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:64:"http://eventespresso.com/forums/2011/11/wordpress-only/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Fri, 04 Nov 2011 17:17:31 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:1:{i:0;a:5:{s:4:"data";s:19:"Pre-sales Questions";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:55:"http://eventespresso.com/forums/2011/11/wordpress-only/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:200:"Our church&#8217;s web site isa built with Expression Web. Can EE be used in conjunction with EW? If not, what suggestions might you have for how I can use EE and not build a totally new site? Thanks!";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:11:"Jack Taylor";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:217:"<p>Our church&#8217;s web site isa built with Expression Web.  Can EE be used in conjunction with EW?  If not, what suggestions might you have for how I can use EE and not build a totally new site?</p>\n<p>Thanks!</p>\n";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:60:"http://eventespresso.com/forums/2011/11/wordpress-only/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"1";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:3;a:6:{s:4:"data";s:41:"\n		\n		\n		\n		\n		\n				\n\n		\n		\n			\n			\n		\n		";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:50:"Manual Entry of Attendees – Problems with Totals";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:87:"http://eventespresso.com/forums/2011/11/manual-entry-of-attendees-problems-with-totals/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:96:"http://eventespresso.com/forums/2011/11/manual-entry-of-attendees-problems-with-totals/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Fri, 04 Nov 2011 14:22:17 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:1:{i:0;a:5:{s:4:"data";s:11:"Bug Reports";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:87:"http://eventespresso.com/forums/2011/11/manual-entry-of-attendees-problems-with-totals/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:349:"When manually entering attendees for an event, the total in the Amount field of Payment Details becomes a progressive tally. This in turn causes issues with the invoices. Examples Manually entered attendee 1 &#8211; cost $200 &#8211; Amount = $200 Manually entered attendee 2 &#8211; cost $200 &#8211; Amount = $400 Manually entered attendee 3 [...]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:8:"Danielle";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:494:"<p>When manually entering attendees for an event, the total in the Amount field of Payment Details becomes a progressive tally.  This in turn causes issues with the invoices.</p>\n<p>Examples<br />\nManually entered attendee 1 &#8211; cost $200 &#8211; Amount = $200<br />\nManually entered attendee 2 &#8211; cost $200 &#8211; Amount = $400<br />\nManually entered attendee 3 &#8211; cost $200 &#8211; Amount = $600</p>\n<p>..etc</p>\n<p>have you seen this before?  How do I go about fixing it?</p>\n";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:92:"http://eventespresso.com/forums/2011/11/manual-entry-of-attendees-problems-with-totals/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"1";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:4;a:6:{s:4:"data";s:41:"\n		\n		\n		\n		\n		\n				\n\n		\n		\n			\n			\n		\n		";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:22:"Payment Overview Email";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:63:"http://eventespresso.com/forums/2011/11/payment-overview-email/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:72:"http://eventespresso.com/forums/2011/11/payment-overview-email/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Fri, 04 Nov 2011 14:01:19 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:1:{i:0;a:5:{s:4:"data";s:15:"General Support";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:63:"http://eventespresso.com/forums/2011/11/payment-overview-email/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:370:"I am using Version 3.1.12.P and experiencing issues after registrants submit their payment. The problem comes when looking at the the &#8216;Payment status link&#8217; and the &#8216;Payment overview email&#8217; sent to registrants. I should mention that it only affects those who register additional attendees as well. Here is the issue: my event is $75. Someone [...]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:11:"Jeff Becker";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:640:"<p>I am using Version 3.1.12.P and experiencing issues after registrants submit their payment. The problem comes when looking at the the &#8216;Payment status link&#8217; and the &#8216;Payment overview email&#8217; sent to registrants. I should mention that it only affects those who register additional attendees as well. Here is the issue: my event is $75. Someone who registers a total of 3 is charged $225. However after they submit their payment through PayPal, the amount shown in the Payment overview email and payment status link is $675. It takes the amount of attendees x the amount paid. Any suggestions on how to fix this?</p>\n";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:68:"http://eventespresso.com/forums/2011/11/payment-overview-email/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"0";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:5;a:6:{s:4:"data";s:47:"\n		\n		\n		\n		\n		\n				\n		\n		\n\n		\n		\n			\n			\n		\n		";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:36:"ESPRESSO_STAFF not working correctly";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:77:"http://eventespresso.com/forums/2011/11/espresso_staff-not-working-correctly/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:86:"http://eventespresso.com/forums/2011/11/espresso_staff-not-working-correctly/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Fri, 04 Nov 2011 12:30:54 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:3:{i:0;a:5:{s:4:"data";s:15:"General Support";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:1;a:5:{s:4:"data";s:16:"[ESPRESSO_STAFF]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:2;a:5:{s:4:"data";s:5:"staff";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:77:"http://eventespresso.com/forums/2011/11/espresso_staff-not-working-correctly/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:161:"When using the following code All I wish to display is the the staff name ie Bob the builder I also have a requirement for the image and desciption both seperate";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:12:"Dave jackson";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:922:"<p>When using the following code</p>\n<pre class="brush: plain; title: ; notranslate">[/code]\n\nI still get the staff details and titles?\n\nThis is what is produced\n\n1&lt;span class=&quot;name&quot;&gt;&lt;div class=&quot;event_staff&quot;&gt;\n&lt;p class=&quot;event_person&quot;&gt;&lt;strong&gt;Bod the Builder&lt;/strong&gt; - Co_ordinator&lt;/p&gt;\n&lt;p&gt;A desc of Bod eeeeeeeeee\n&lt;/p&gt;&lt;p class=&quot;event_person&quot;&gt;Company: &lt;br&gt;Title: &lt;br&gt;Industry: &lt;br&gt;City: &lt;br&gt;Country: &lt;br&gt;Website: &lt;a target=&quot;_blank&quot; href=&quot;&quot;&gt;&lt;/a&gt;&lt;br&gt;Twitter: &lt;a target=&quot;_blank&quot; href=&quot;http://twitter.com/#!/&quot;&gt;@&lt;/a&gt;&lt;br&gt;Phone: 087 12311233&lt;/p&gt;\n&lt;/div&gt;\n&lt;/span&gt;</pre>\n<p>All I wish to display is the the staff name ie Bob the builder</p>\n<p>I also have a requirement for the image and desciption both seperate</p>\n";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:82:"http://eventespresso.com/forums/2011/11/espresso_staff-not-working-correctly/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"0";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:6;a:6:{s:4:"data";s:47:"\n		\n		\n		\n		\n		\n				\n		\n		\n\n		\n		\n			\n			\n		\n		";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:12:"No Attendees";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:53:"http://eventespresso.com/forums/2011/11/no-attendees/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:62:"http://eventespresso.com/forums/2011/11/no-attendees/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Fri, 04 Nov 2011 09:43:52 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:3:{i:0;a:5:{s:4:"data";s:22:"Template Customization";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:1;a:5:{s:4:"data";s:8:"attendee";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:2;a:5:{s:4:"data";s:13:"Attendee lost";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:53:"http://eventespresso.com/forums/2011/11/no-attendees/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:303:"Hi, I was setting up the free version of Event Espresso &#8211; 3.1.12.L. We need the rgistration page for parties where people add their name, their e-Mail an the number of people who join them. From my point of view the free version will do this perfectly So I added or changed one address field [...]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:14:"Stephan Kohler";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:707:"<p>Hi,<br />\nI was setting up the free version of Event Espresso &#8211; 3.1.12.L.</p>\n<p>We need the rgistration page for parties where people add their name, their e-Mail an the number of people who join them. From my point of view the free version will do this perfectly</p>\n<p>So I added or changed one address field (text) for entering the number of people and added it to my testevent.</p>\n<p>The event shows up as I wanted it.</p>\n<p>For testing I added firstname, lastname, e-mail and the one address field and clicked on submit.</p>\n<p>But nothing happens afterwards. The Attendee can not be seen in the event in the WP-admin?</p>\n<p>Do I need to do anything else ?</p>\n<p>Regards<br />\nKohli </p>\n";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:58:"http://eventespresso.com/forums/2011/11/no-attendees/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"0";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:7;a:6:{s:4:"data";s:41:"\n		\n		\n		\n		\n		\n				\n\n		\n		\n			\n			\n		\n		";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:25:"Attendees exceeded limit?";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:65:"http://eventespresso.com/forums/2011/11/attendees-exceeded-limit/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:74:"http://eventespresso.com/forums/2011/11/attendees-exceeded-limit/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Fri, 04 Nov 2011 00:37:19 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:1:{i:0;a:5:{s:4:"data";s:15:"General Support";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:65:"http://eventespresso.com/forums/2011/11/attendees-exceeded-limit/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:251:"I have a limit of 6 attendees set for this class and it allowed 7 to book? It has closed it off now&#8230; at 7 http://www.lightaddicts.com/?page_id=475&#038;regevent_action=register&#038;event_id=378 Does anyone know why this might be? Thanks, Amanda";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:11:"amanda kerr";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:287:"<p>I have a limit of 6 attendees set for this class and it allowed 7 to book? It has closed it off now&#8230; at 7</p>\n<p>http://www.lightaddicts.com/?page_id=475&#038;regevent_action=register&#038;event_id=378</p>\n<p>Does anyone know why this might be?</p>\n<p>Thanks,</p>\n<p>Amanda</p>\n";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:70:"http://eventespresso.com/forums/2011/11/attendees-exceeded-limit/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"1";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:8;a:6:{s:4:"data";s:50:"\n		\n		\n		\n		\n		\n				\n		\n		\n		\n\n		\n		\n			\n			\n		\n		";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:38:"Event Espresso for Multilingual site ?";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:77:"http://eventespresso.com/forums/2011/11/event-espresso-for-multilingual-site/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:86:"http://eventespresso.com/forums/2011/11/event-espresso-for-multilingual-site/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Fri, 04 Nov 2011 00:11:55 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:4:{i:0;a:5:{s:4:"data";s:19:"Pre-sales Questions";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:1;a:5:{s:4:"data";s:9:"languages";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:2;a:5:{s:4:"data";s:17:"multilingual site";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}i:3;a:5:{s:4:"data";s:8:"presales";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:77:"http://eventespresso.com/forums/2011/11/event-espresso-for-multilingual-site/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:306:"Hi, I need to add event management/calendars etc in a website that will be diplayed in 3 languages. I use WPML for that and I was wondering if EE would work with WPML ? I dont mind having the back-end monolingual(english is fine) but I need the ability to show the events/calendars in three languages [...]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:14:"Gabriel Chabot";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:415:"<p>Hi,<br />\nI need to add event management/calendars etc in a website that will be diplayed in 3 languages.<br />\nI use WPML for that and I was wondering if EE would work with WPML ?<br />\nI dont mind having the back-end monolingual(english is fine) but I need the ability to show the events/calendars in three languages (according to the site users initial language choice).<br />\nThanks for letting me know!</p>\n";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:82:"http://eventespresso.com/forums/2011/11/event-espresso-for-multilingual-site/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"0";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}i:9;a:6:{s:4:"data";s:41:"\n		\n		\n		\n		\n		\n				\n\n		\n		\n			\n			\n		\n		";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";s:5:"child";a:5:{s:0:"";a:7:{s:5:"title";a:1:{i:0;a:5:{s:4:"data";s:18:"Individual Tickets";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:59:"http://eventespresso.com/forums/2011/11/individual-tickets/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:68:"http://eventespresso.com/forums/2011/11/individual-tickets/#comments";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:7:"pubDate";a:1:{i:0;a:5:{s:4:"data";s:31:"Thu, 03 Nov 2011 23:25:18 +0000";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:8:"category";a:1:{i:0;a:5:{s:4:"data";s:6:"Addons";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:4:"guid";a:1:{i:0;a:5:{s:4:"data";s:59:"http://eventespresso.com/forums/2011/11/individual-tickets/";s:7:"attribs";a:1:{s:0:"";a:1:{s:11:"isPermaLink";s:5:"false";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:11:"description";a:1:{i:0;a:5:{s:4:"data";s:305:"Hello, I wanted to know if it is possible using either the Advanced License or the Mobile Ticketing Add on to general individual tickets for each attendee. Lets say John Doe buys 10 tickets so this conference, I want John to be able to have 10 unique tickets for each registrant. The tickets can all [...]";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:32:"http://purl.org/dc/elements/1.1/";a:1:{s:7:"creator";a:1:{i:0;a:5:{s:4:"data";s:7:"Matthew";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:40:"http://purl.org/rss/1.0/modules/content/";a:1:{s:7:"encoded";a:1:{i:0;a:5:{s:4:"data";s:517:"<p>Hello,</p>\n<p>I wanted to know if it is possible using either the Advanced License or the Mobile Ticketing Add on to general individual tickets for each attendee.  Lets say John Doe buys 10 tickets so this conference, I want John to be able to have 10 unique tickets for each registrant.  The tickets can all still be under John&#8217;s name, but I want him to be able to hand out these tickets to his staff so they do not have to check in to the conference at the same time.  Is this possible?</p>\n<p>Thanks.</p>\n";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:36:"http://wellformedweb.org/CommentAPI/";a:1:{s:10:"commentRss";a:1:{i:0;a:5:{s:4:"data";s:64:"http://eventespresso.com/forums/2011/11/individual-tickets/feed/";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:38:"http://purl.org/rss/1.0/modules/slash/";a:1:{s:8:"comments";a:1:{i:0;a:5:{s:4:"data";s:1:"0";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}}}s:27:"http://www.w3.org/2005/Atom";a:1:{s:4:"link";a:1:{i:0;a:5:{s:4:"data";s:0:"";s:7:"attribs";a:1:{s:0:"";a:3:{s:4:"href";s:37:"http://eventespresso.com/forums/feed/";s:3:"rel";s:4:"self";s:4:"type";s:19:"application/rss+xml";}}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}s:44:"http://purl.org/rss/1.0/modules/syndication/";a:2:{s:12:"updatePeriod";a:1:{i:0;a:5:{s:4:"data";s:6:"hourly";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}s:15:"updateFrequency";a:1:{i:0;a:5:{s:4:"data";s:1:"1";s:7:"attribs";a:0:{}s:8:"xml_base";s:0:"";s:17:"xml_base_explicit";b:0;s:8:"xml_lang";s:0:"";}}}}}}}}}}}}s:4:"type";i:128;s:7:"headers";a:11:{s:4:"date";s:29:"Sat, 05 Nov 2011 16:25:20 GMT";s:6:"server";s:86:"Apache mod_fcgid/2.3.6 mod_auth_passthrough/2.1 mod_bwlimited/1.4 FrontPage/5.0.2.2635";s:13:"last-modified";s:29:"Sat, 05 Nov 2011 16:24:44 GMT";s:13:"accept-ranges";s:5:"bytes";s:4:"vary";s:22:"Accept-Encoding,Cookie";s:10:"x-pingback";s:42:"http://eventespresso.com/forums/xmlrpc.php";s:12:"x-powered-by";s:22:"W3 Total Cache/0.9.2.4";s:10:"keep-alive";s:17:"timeout=5, max=75";s:12:"content-type";s:15:"application/xml";s:14:"content-length";s:5:"16382";s:10:"connection";s:5:"close";}s:5:"build";s:14:"20090627192103";}', 'no'),
(426, 0, '_transient_timeout_feed_mod_180a350ea4dfbf80d71e6c688d245b4e', '1320553512', 'no'),
(427, 0, '_transient_feed_mod_180a350ea4dfbf80d71e6c688d245b4e', '1320510312', 'no'),
(428, 0, '_site_transient_timeout_browser_33ec5db4780dc8020a776aa036c1d7bb', '1321227727', 'yes'),
(429, 0, '_site_transient_browser_33ec5db4780dc8020a776aa036c1d7bb', 'a:9:{s:8:"platform";s:7:"Windows";s:4:"name";s:6:"Chrome";s:7:"version";s:12:"14.0.835.202";s:10:"update_url";s:28:"http://www.google.com/chrome";s:7:"img_src";s:49:"http://s.wordpress.org/images/browsers/chrome.png";s:11:"img_src_ssl";s:48:"https://wordpress.org/images/browsers/chrome.png";s:15:"current_version";s:2:"13";s:7:"upgrade";b:0;s:8:"insecure";b:0;}', 'yes'),
(479, 0, '_transient_timeout_dash_20494a3d90a6669585674ed0eb8dcd8f', '1321016408', 'no'),
(480, 0, '_transient_dash_20494a3d90a6669585674ed0eb8dcd8f', '<p><strong>RSS Error</strong>: WP HTTP Error: Could not open handle for fopen() to http://blogsearch.google.com/blogsearch_feeds?scoring=d&ie=utf-8&num=10&output=rss&partner=wordpress&q=link:http://localhost/apsn/</p>', 'no'),
(481, 0, '_transient_timeout_dash_4077549d03da2e451c8b5f002294ff51', '1321016409', 'no'),
(482, 0, '_transient_dash_4077549d03da2e451c8b5f002294ff51', '<div class="rss-widget"><p><strong>RSS Error</strong>: WP HTTP Error: Could not open handle for fopen() to http://wordpress.org/news/feed/</p></div>', 'no'),
(483, 0, '_transient_timeout_dash_aa95765b5cc111c56d5993d476b1c2f0', '1321016409', 'no'),
(484, 0, '_transient_dash_aa95765b5cc111c56d5993d476b1c2f0', '<div class="rss-widget"><p><strong>RSS Error</strong>: WP HTTP Error: Could not open handle for fopen() to http://planet.wordpress.org/feed/</p></div>', 'no'),
(485, 0, '_transient_timeout_dash_de3249c4736ad3bd2cd29147c4a0d43e', '1321016410', 'no'),
(486, 0, '_transient_dash_de3249c4736ad3bd2cd29147c4a0d43e', '', 'no'),
(487, 0, '_transient_random_seed', 'bc778484b9c829508471882043db2d84', 'yes'),
(468, 0, 'theme_mods_twentyeleven', 'a:2:{s:12:"header_image";s:74:"http://localhost/apsn/wp-content/uploads/2011/11/cropped-cropped-apsn1.jpg";s:16:"header_textcolor";s:5:"blank";}', 'yes'),
(469, 0, '_site_transient_timeout_browser_eedbe0e62e9178f4304688856a27b8c4', '1321564859', 'yes'),
(470, 0, '_site_transient_browser_eedbe0e62e9178f4304688856a27b8c4', 'a:9:{s:8:"platform";s:7:"Windows";s:4:"name";s:6:"Chrome";s:7:"version";s:12:"15.0.874.106";s:10:"update_url";s:28:"http://www.google.com/chrome";s:7:"img_src";s:49:"http://s.wordpress.org/images/browsers/chrome.png";s:11:"img_src_ssl";s:48:"https://wordpress.org/images/browsers/chrome.png";s:15:"current_version";s:2:"13";s:7:"upgrade";b:0;s:8:"insecure";b:0;}', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `wp_postmeta`
--

CREATE TABLE IF NOT EXISTS `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `wp_postmeta`
--

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 4, '_edit_last', '1'),
(3, 4, '_edit_lock', '1320975821:1'),
(5, 6, '_edit_last', '1'),
(6, 6, '_wp_page_template', 'default'),
(7, 6, '_edit_lock', '1320392794:1'),
(8, 9, '_edit_lock', '1320383885:1'),
(9, 2, '_edit_lock', '1320968701:1'),
(10, 2, '_edit_last', '1'),
(11, 6, 'ctx_ps_security', '1'),
(12, 16, '_edit_last', '1'),
(13, 16, '_wp_page_template', 'default'),
(14, 16, '_edit_lock', '1320968695:1'),
(15, 2, 'ctx_ps_security', '1'),
(16, 16, 'ctx_ps_security', '1'),
(17, 20, '_edit_last', '1'),
(18, 20, '_edit_lock', '1320382850:1'),
(19, 20, '_wp_page_template', 'default'),
(20, 20, 'ctx_ps_security', '1'),
(21, 22, '_edit_last', '1'),
(22, 22, '_edit_lock', '1320382607:1'),
(23, 22, '_wp_page_template', 'default'),
(24, 22, 'ctx_ps_security', '1'),
(25, 9, '_edit_last', '1'),
(26, 9, '_wp_page_template', 'default'),
(27, 43, '_edit_last', '1'),
(28, 43, '_wp_page_template', 'default'),
(29, 43, '_edit_lock', '1320968726:1'),
(30, 45, '_edit_last', '1'),
(31, 45, '_wp_page_template', 'default'),
(32, 45, '_edit_lock', '1320968667:1'),
(33, 47, '_edit_last', '1'),
(34, 47, '_wp_page_template', 'default'),
(35, 47, '_edit_lock', '1320968677:1'),
(36, 39, '_wp_trash_meta_status', 'publish'),
(37, 39, '_wp_trash_meta_time', '1320960380'),
(38, 41, '_wp_trash_meta_status', 'publish'),
(39, 41, '_wp_trash_meta_time', '1320960380'),
(40, 40, '_wp_trash_meta_status', 'publish'),
(41, 40, '_wp_trash_meta_time', '1320960380'),
(42, 42, '_wp_trash_meta_status', 'publish'),
(43, 42, '_wp_trash_meta_time', '1320960380'),
(44, 54, '_edit_last', '1'),
(45, 54, '_wp_page_template', 'default'),
(46, 54, '_edit_lock', '1320968648:1'),
(47, 56, '_edit_last', '1'),
(48, 56, '_wp_page_template', 'default'),
(49, 56, '_edit_lock', '1320968655:1'),
(50, 58, '_edit_last', '1'),
(51, 58, '_wp_page_template', 'default'),
(52, 58, '_edit_lock', '1320968689:1'),
(53, 58, 'ctx_ps_security', '1'),
(54, 54, 'ctx_ps_security', '1'),
(55, 56, 'ctx_ps_security', '1'),
(56, 45, 'ctx_ps_security', '1'),
(57, 47, 'ctx_ps_security', '1'),
(58, 43, 'ctx_ps_security', '1'),
(59, 61, '_wp_attached_file', '2011/11/cropped-cropped-apsn1.jpg'),
(60, 61, '_wp_attachment_context', 'custom-header'),
(61, 61, '_wp_attachment_metadata', 'a:6:{s:5:"width";s:4:"1000";s:6:"height";s:3:"288";s:14:"hwstring_small";s:23:"height=''36'' width=''128''";s:4:"file";s:33:"2011/11/cropped-cropped-apsn1.jpg";s:5:"sizes";a:3:{s:9:"thumbnail";a:3:{s:4:"file";s:33:"cropped-cropped-apsn1-150x150.jpg";s:5:"width";s:3:"150";s:6:"height";s:3:"150";}s:6:"medium";a:3:{s:4:"file";s:32:"cropped-cropped-apsn1-300x86.jpg";s:5:"width";s:3:"300";s:6:"height";s:2:"86";}s:13:"small-feature";a:3:{s:4:"file";s:33:"cropped-cropped-apsn1-500x144.jpg";s:5:"width";s:3:"500";s:6:"height";s:3:"144";}}s:10:"image_meta";a:10:{s:8:"aperture";s:1:"0";s:6:"credit";s:0:"";s:6:"camera";s:0:"";s:7:"caption";s:0:"";s:17:"created_timestamp";s:1:"0";s:9:"copyright";s:0:"";s:12:"focal_length";s:1:"0";s:3:"iso";s:1:"0";s:13:"shutter_speed";s:1:"0";s:5:"title";s:0:"";}}'),
(62, 61, '_wp_attachment_is_custom_header', 'twentyeleven'),
(63, 1, '_wp_trash_meta_status', 'publish'),
(64, 1, '_wp_trash_meta_time', '1320975750'),
(65, 1, '_wp_trash_meta_comments_status', 'a:1:{i:1;s:1:"1";}');

-- --------------------------------------------------------

--
-- Table structure for table `wp_posts`
--

CREATE TABLE IF NOT EXISTS `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` text NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `wp_posts`
--

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2011-09-30 02:34:08', '2011-09-30 02:34:08', 'Welcome to WordPress. This is your first post. Edit or delete it, then start blogging!', 'Hello world!', '', 'trash', 'open', 'open', '', 'hello-world', '', '', '2011-11-11 01:42:30', '2011-11-11 01:42:30', '', 0, 'http://localhost/apsn/?p=1', 0, 'post', '', 1),
(2, 1, '2011-09-30 02:34:08', '2011-09-30 02:34:08', '', 'Pending Applications', '', 'publish', 'open', 'open', '', 'sample-page', '', '', '2011-11-04 04:56:18', '2011-11-04 04:56:18', '', 0, 'http://localhost/apsn/?page_id=2', 2, 'page', '', 0),
(13, 1, '2011-11-03 16:43:41', '2011-11-03 16:43:41', '<!--cforms name="Part 1"-->', 'New page', '', 'inherit', 'open', 'open', '', '6-autosave', '', '', '2011-11-03 16:43:41', '2011-11-03 16:43:41', '', 6, 'http://localhost/apsn/?p=13', 0, 'revision', '', 0),
(14, 1, '2011-10-27 20:55:25', '2011-10-27 20:55:25', '<!--cforms name="Part 1"-->', 'New page', '', 'inherit', 'open', 'open', '', '6-revision-3', '', '', '2011-10-27 20:55:25', '2011-10-27 20:55:25', '', 6, 'http://localhost/apsn/?p=14', 0, 'revision', '', 0),
(36, 1, '2011-11-04 06:45:55', '2011-11-04 06:45:55', '', 'Sign Up Form', '', 'inherit', 'open', 'open', '', '6-revision-6', '', '', '2011-11-04 06:45:55', '2011-11-04 06:45:55', '', 6, 'http://localhost/apsn/?p=36', 0, 'revision', '', 0),
(15, 1, '2011-11-02 15:24:53', '2011-11-02 15:24:53', '', 'Sample Page', '', 'inherit', 'open', 'open', '', '2-revision-2', '', '', '2011-11-02 15:24:53', '2011-11-02 15:24:53', '', 2, 'http://localhost/apsn/?p=15', 0, 'revision', '', 0),
(17, 1, '2011-11-03 18:44:23', '2011-11-03 18:44:23', '', 'Auto Draft', '', 'inherit', 'open', 'open', '', '16-revision', '', '', '2011-11-03 18:44:23', '2011-11-03 18:44:23', '', 16, 'http://localhost/apsn/?p=17', 0, 'revision', '', 0),
(45, 1, '2011-11-10 21:21:18', '2011-11-10 21:21:18', '', 'Events', '', 'publish', 'open', 'open', '', 'events-2', '', '', '2011-11-10 21:21:18', '2011-11-10 21:21:18', '', 0, 'http://localhost/apsn/?page_id=45', 0, 'page', '', 0),
(16, 1, '2011-11-04 04:42:46', '2011-11-04 04:42:46', '', 'Approved Applications', '', 'publish', 'open', 'closed', '', 'approved-applications', '', '', '2011-11-04 04:56:27', '2011-11-04 04:56:27', '', 0, 'http://localhost/apsn/?page_id=16', 1, 'page', '', 0),
(4, 1, '2011-09-30 02:35:13', '2011-09-30 02:35:13', 'Click on login on the sidebar to login.\r\n\r\nTo end the session, click on logout.\r\n\r\nWe hope you have a pleasant session', 'Welcome to APSN Volunteer Portal', '', 'publish', 'open', 'open', '', 'hello-world-2', '', '', '2011-11-11 01:43:40', '2011-11-11 01:43:40', '', 0, 'http://localhost/apsn/?p=4', 0, 'post', '', 0),
(5, 1, '2011-09-30 02:34:32', '2011-09-30 02:34:32', '', 'Hello world!', '', 'inherit', 'open', 'open', '', '4-revision', '', '', '2011-09-30 02:34:32', '2011-09-30 02:34:32', '', 4, 'http://localhost/apsn/?p=5', 0, 'revision', '', 0),
(6, 1, '2011-09-30 02:37:27', '2011-09-30 02:37:27', '<!--cforms name="Part 1"-->', 'Sign Up Form', '', 'publish', 'open', 'open', '', 'new-page', '', '', '2011-11-04 07:46:33', '2011-11-04 07:46:33', '', 0, 'http://localhost/apsn/?page_id=6', 5, 'page', '', 0),
(7, 1, '2011-09-30 02:37:23', '2011-09-30 02:37:23', '', 'Auto Draft', '', 'inherit', 'open', 'open', '', '6-revision', '', '', '2011-09-30 02:37:23', '2011-09-30 02:37:23', '', 6, 'http://localhost/apsn/?p=7', 0, 'revision', '', 0),
(8, 1, '2011-09-30 02:37:27', '2011-09-30 02:37:27', '', 'New page', '', 'inherit', 'open', 'open', '', '6-revision-2', '', '', '2011-09-30 02:37:27', '2011-09-30 02:37:27', '', 6, 'http://localhost/apsn/?p=8', 0, 'revision', '', 0),
(9, 1, '2011-10-28 05:55:31', '2011-10-28 05:55:31', '[theme-my-login]', 'Login', '', 'publish', 'closed', 'closed', '', 'login', '', '', '2011-11-04 04:57:11', '2011-11-04 04:57:11', '', 0, 'http://localhost/apsn/?page_id=9', 6, 'page', '', 0),
(10, 1, '2011-11-02 13:37:48', '2011-11-02 13:37:48', '[theme-my-login]', 'Login', '', 'inherit', 'open', 'open', '', '9-autosave', '', '', '2011-11-02 13:37:48', '2011-11-02 13:37:48', '', 9, 'http://localhost/apsn/?p=10', 0, 'revision', '', 0),
(11, 1, '2011-11-02 15:18:15', '2011-11-02 15:18:15', 'This is an example page. It''s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\n<blockquote>Hi there! I''m a bike messenger by day, aspiring actor by night, and this is my blog. I live in Los Angeles, have a great dog named Jack, and I like piña coladas. (And gettin'' caught in the rain.)</blockquote>\n...or something like this:\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickies to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\nAs a new WordPress user, you should go to <a href="http://localhost/apsn/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'inherit', 'open', 'open', '', '2-autosave', '', '', '2011-11-02 15:18:15', '2011-11-02 15:18:15', '', 2, 'http://localhost/apsn/?p=11', 0, 'revision', '', 0),
(12, 1, '2011-09-30 02:34:08', '2011-09-30 02:34:08', 'This is an example page. It''s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\n\n<blockquote>Hi there! I''m a bike messenger by day, aspiring actor by night, and this is my blog. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin'' caught in the rain.)</blockquote>\n\n...or something like this:\n\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickies to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\n\nAs a new WordPress user, you should go to <a href="http://localhost/apsn/wp-admin/">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'inherit', 'open', 'open', '', '2-revision', '', '', '2011-09-30 02:34:08', '2011-09-30 02:34:08', '', 2, 'http://localhost/apsn/?p=12', 0, 'revision', '', 0),
(46, 1, '2011-11-10 21:21:07', '2011-11-10 21:21:07', '', 'Auto Draft', '', 'inherit', 'open', 'open', '', '45-revision', '', '', '2011-11-10 21:21:07', '2011-11-10 21:21:07', '', 45, 'http://localhost/apsn/?p=46', 0, 'revision', '', 0),
(20, 1, '2011-11-03 22:23:18', '2011-11-03 22:23:18', '', 'Edit Profile', '', 'publish', 'open', 'open', '', 'edit-profile', '', '', '2011-11-04 04:56:56', '2011-11-04 04:56:56', '', 0, 'http://localhost/apsn/?page_id=20', 3, 'page', '', 0),
(21, 1, '2011-11-03 22:23:13', '2011-11-03 22:23:13', '', 'Edit Profile', '', 'inherit', 'open', 'open', '', '20-revision', '', '', '2011-11-03 22:23:13', '2011-11-03 22:23:13', '', 20, 'http://localhost/apsn/?p=21', 0, 'revision', '', 0),
(22, 1, '2011-11-04 04:36:23', '2011-11-04 04:36:23', '', 'Application Status', '', 'publish', 'open', 'open', '', 'application-status', '', '', '2011-11-04 04:56:47', '2011-11-04 04:56:47', '', 0, 'http://localhost/apsn/?page_id=22', 4, 'page', '', 0),
(23, 1, '2011-11-04 04:36:10', '2011-11-04 04:36:10', '', 'Application', '', 'inherit', 'open', 'open', '', '22-revision', '', '', '2011-11-04 04:36:10', '2011-11-04 04:36:10', '', 22, 'http://localhost/apsn/?p=23', 0, 'revision', '', 0),
(24, 1, '2011-11-03 18:44:46', '2011-11-03 18:44:46', '', 'Approved Applications', '', 'inherit', 'open', 'open', '', '16-revision-2', '', '', '2011-11-03 18:44:46', '2011-11-03 18:44:46', '', 16, 'http://localhost/apsn/?p=24', 0, 'revision', '', 0),
(25, 1, '2011-11-04 04:53:15', '2011-11-04 04:53:15', '', 'Approved Applications', '', 'inherit', 'open', 'open', '', '16-revision-3', '', '', '2011-11-04 04:53:15', '2011-11-04 04:53:15', '', 16, 'http://localhost/apsn/?p=25', 0, 'revision', '', 0),
(26, 1, '2011-11-04 04:53:33', '2011-11-04 04:53:33', '', 'Approved Applications', '', 'inherit', 'open', 'open', '', '16-revision-4', '', '', '2011-11-04 04:53:33', '2011-11-04 04:53:33', '', 16, 'http://localhost/apsn/?p=26', 0, 'revision', '', 0),
(27, 1, '2011-11-04 04:53:47', '2011-11-04 04:53:47', '', 'Approved Applications', '', 'inherit', 'open', 'open', '', '16-revision-5', '', '', '2011-11-04 04:53:47', '2011-11-04 04:53:47', '', 16, 'http://localhost/apsn/?p=27', 0, 'revision', '', 0),
(28, 1, '2011-11-03 18:03:38', '2011-11-03 18:03:38', '', 'Pending Applications', '', 'inherit', 'open', 'open', '', '2-revision-3', '', '', '2011-11-03 18:03:38', '2011-11-03 18:03:38', '', 2, 'http://localhost/apsn/?p=28', 0, 'revision', '', 0),
(29, 1, '2011-11-04 04:56:08', '2011-11-04 04:56:08', '', 'Approved Applications', '', 'inherit', 'open', 'open', '', '16-revision-6', '', '', '2011-11-04 04:56:08', '2011-11-04 04:56:08', '', 16, 'http://localhost/apsn/?p=29', 0, 'revision', '', 0),
(30, 1, '2011-11-03 22:23:18', '2011-11-03 22:23:18', '', 'Edit Profile', '', 'inherit', 'open', 'open', '', '20-revision-2', '', '', '2011-11-03 22:23:18', '2011-11-03 22:23:18', '', 20, 'http://localhost/apsn/?p=30', 0, 'revision', '', 0),
(31, 1, '2011-11-04 04:36:23', '2011-11-04 04:36:23', '', 'Application Status', '', 'inherit', 'open', 'open', '', '22-revision-2', '', '', '2011-11-04 04:36:23', '2011-11-04 04:36:23', '', 22, 'http://localhost/apsn/?p=31', 0, 'revision', '', 0),
(32, 1, '2011-11-04 04:56:35', '2011-11-04 04:56:35', '', 'Edit Profile', '', 'inherit', 'open', 'open', '', '20-revision-3', '', '', '2011-11-04 04:56:35', '2011-11-04 04:56:35', '', 20, 'http://localhost/apsn/?p=32', 0, 'revision', '', 0),
(33, 1, '2011-11-03 18:03:26', '2011-11-03 18:03:26', '<!--cforms name="Part 1"-->', 'Sign Up Form', '', 'inherit', 'open', 'open', '', '6-revision-4', '', '', '2011-11-03 18:03:26', '2011-11-03 18:03:26', '', 6, 'http://localhost/apsn/?p=33', 0, 'revision', '', 0),
(34, 1, '2011-10-28 05:55:31', '2011-10-28 05:55:31', '[theme-my-login]', 'Login', '', 'inherit', 'open', 'open', '', '9-revision', '', '', '2011-10-28 05:55:31', '2011-10-28 05:55:31', '', 9, 'http://localhost/apsn/?p=34', 0, 'revision', '', 0),
(35, 1, '2011-11-04 04:57:04', '2011-11-04 04:57:04', '<!--cforms name="Part 1"-->', 'Sign Up Form', '', 'inherit', 'open', 'open', '', '6-revision-5', '', '', '2011-11-04 04:57:04', '2011-11-04 04:57:04', '', 6, 'http://localhost/apsn/?p=35', 0, 'revision', '', 0),
(38, 1, '2011-11-04 06:49:58', '2011-11-04 06:49:58', '', 'Sign Up Form', '', 'inherit', 'open', 'open', '', '6-revision-8', '', '', '2011-11-04 06:49:58', '2011-11-04 06:49:58', '', 6, 'http://localhost/apsn/?p=38', 0, 'revision', '', 0),
(37, 1, '2011-11-04 06:47:31', '2011-11-04 06:47:31', '<!--cforms name="Part 1"-->', 'Sign Up Form', '', 'inherit', 'open', 'open', '', '6-revision-7', '', '', '2011-11-04 06:47:31', '2011-11-04 06:47:31', '', 6, 'http://localhost/apsn/?p=37', 0, 'revision', '', 0),
(39, 1, '2011-11-05 16:25:14', '2011-11-05 16:25:14', '[ESPRESSO_EVENTS]', 'Event Registration', '', 'trash', 'closed', 'open', '', 'event-registration', '', '', '2011-11-10 21:26:20', '2011-11-10 21:26:20', '', 0, 'http://localhost/apsn/?page_id=39', 0, 'page', '', 0),
(40, 1, '2011-11-05 16:25:14', '2011-11-05 16:25:14', '[ESPRESSO_PAYMENTS]', 'Thank You', '', 'trash', 'closed', 'open', '', 'thank-you', '', '', '2011-11-10 21:26:20', '2011-11-10 21:26:20', '', 0, 'http://localhost/apsn/?page_id=40', 0, 'page', '', 0),
(41, 1, '2011-11-05 16:25:14', '2011-11-05 16:25:14', 'You have cancelled your registration.', 'Registration Cancelled', '', 'trash', 'closed', 'open', '', 'registration-cancelled', '', '', '2011-11-10 21:26:20', '2011-11-10 21:26:20', '', 0, 'http://localhost/apsn/?page_id=41', 0, 'page', '', 0),
(42, 1, '2011-11-05 16:25:14', '2011-11-05 16:25:14', '[ESPRESSO_TXN_PAGE]', 'Transactions', '', 'trash', 'closed', 'open', '', 'transactions', '', '', '2011-11-10 21:26:20', '2011-11-10 21:26:20', '', 0, 'http://localhost/apsn/?page_id=42', 0, 'page', '', 0),
(43, 1, '2011-11-05 17:31:56', '2011-11-05 17:31:56', '', 'Events', '', 'publish', 'open', 'open', '', 'events', '', '', '2011-11-10 23:45:26', '2011-11-10 23:45:26', '', 0, 'http://localhost/apsn/?page_id=43', 0, 'page', '', 0),
(44, 1, '2011-11-05 17:31:38', '2011-11-05 17:31:38', '', 'Auto Draft', '', 'inherit', 'open', 'open', '', '43-revision', '', '', '2011-11-05 17:31:38', '2011-11-05 17:31:38', '', 43, 'http://localhost/apsn/?p=44', 0, 'revision', '', 0),
(47, 1, '2011-11-10 21:22:19', '2011-11-10 21:22:19', '', 'Manage Events', '', 'publish', 'open', 'open', '', 'manage-events', '', '', '2011-11-10 21:22:19', '2011-11-10 21:22:19', '', 0, 'http://localhost/apsn/?page_id=47', 0, 'page', '', 0),
(48, 1, '2011-11-10 21:22:10', '2011-11-10 21:22:10', '', 'Auto Draft', '', 'inherit', 'open', 'open', '', '47-revision', '', '', '2011-11-10 21:22:10', '2011-11-10 21:22:10', '', 47, 'http://localhost/apsn/?p=48', 0, 'revision', '', 0),
(49, 1, '2011-11-05 17:31:56', '2011-11-05 17:31:56', '', 'Events', '', 'inherit', 'open', 'open', '', '43-revision-2', '', '', '2011-11-05 17:31:56', '2011-11-05 17:31:56', '', 43, 'http://localhost/apsn/?p=49', 0, 'revision', '', 0),
(61, 1, '2011-11-11 00:16:14', '2011-11-11 00:16:14', 'http://localhost/apsn/wp-content/uploads/2011/11/cropped-cropped-apsn1.jpg', 'cropped-cropped-apsn1.jpg', '', 'inherit', 'closed', 'open', '', 'cropped-cropped-apsn1-jpg', '', '', '2011-11-11 00:16:14', '2011-11-11 00:16:14', '', 0, 'http://localhost/apsn/wp-content/uploads/2011/11/cropped-cropped-apsn1.jpg', 0, 'attachment', 'image/jpeg', 0),
(50, 1, '2011-11-05 16:25:14', '2011-11-05 16:25:14', '[ESPRESSO_EVENTS]', 'Event Registration', '', 'inherit', 'open', 'open', '', '39-revision', '', '', '2011-11-05 16:25:14', '2011-11-05 16:25:14', '', 39, 'http://localhost/apsn/?p=50', 0, 'revision', '', 0),
(51, 1, '2011-11-05 16:25:14', '2011-11-05 16:25:14', 'You have cancelled your registration.', 'Registration Cancelled', '', 'inherit', 'open', 'open', '', '41-revision', '', '', '2011-11-05 16:25:14', '2011-11-05 16:25:14', '', 41, 'http://localhost/apsn/?p=51', 0, 'revision', '', 0),
(52, 1, '2011-11-05 16:25:14', '2011-11-05 16:25:14', '[ESPRESSO_PAYMENTS]', 'Thank You', '', 'inherit', 'open', 'open', '', '40-revision', '', '', '2011-11-05 16:25:14', '2011-11-05 16:25:14', '', 40, 'http://localhost/apsn/?p=52', 0, 'revision', '', 0),
(53, 1, '2011-11-05 16:25:14', '2011-11-05 16:25:14', '[ESPRESSO_TXN_PAGE]', 'Transactions', '', 'inherit', 'open', 'open', '', '42-revision', '', '', '2011-11-05 16:25:14', '2011-11-05 16:25:14', '', 42, 'http://localhost/apsn/?p=53', 0, 'revision', '', 0),
(54, 1, '2011-11-10 22:01:07', '2011-11-10 22:01:07', '', 'Create Event', '', 'publish', 'open', 'open', '', 'create-event', '', '', '2011-11-10 22:01:07', '2011-11-10 22:01:07', '', 0, 'http://localhost/apsn/?page_id=54', 0, 'page', '', 0),
(55, 1, '2011-11-10 22:00:58', '2011-11-10 22:00:58', '', 'Auto Draft', '', 'inherit', 'open', 'open', '', '54-revision', '', '', '2011-11-10 22:00:58', '2011-11-10 22:00:58', '', 54, 'http://localhost/apsn/?p=55', 0, 'revision', '', 0),
(56, 1, '2011-11-10 22:01:35', '2011-11-10 22:01:35', '', 'Event Edit', '', 'publish', 'open', 'open', '', 'event-edit', '', '', '2011-11-10 22:01:35', '2011-11-10 22:01:35', '', 0, 'http://localhost/apsn/?page_id=56', 0, 'page', '', 0),
(57, 1, '2011-11-10 22:01:30', '2011-11-10 22:01:30', '', 'Auto Draft', '', 'inherit', 'open', 'open', '', '56-revision', '', '', '2011-11-10 22:01:30', '2011-11-10 22:01:30', '', 56, 'http://localhost/apsn/?p=57', 0, 'revision', '', 0),
(58, 1, '2011-11-10 23:41:30', '2011-11-10 23:41:30', '', 'Rejected Applications', '', 'publish', 'open', 'open', '', 'rejected-applications', '', '', '2011-11-10 23:41:30', '2011-11-10 23:41:30', '', 0, 'http://localhost/apsn/?page_id=58', 0, 'page', '', 0),
(59, 1, '2011-11-10 23:41:22', '2011-11-10 23:41:22', '', 'Auto Draft', '', 'inherit', 'open', 'open', '', '58-revision', '', '', '2011-11-10 23:41:22', '2011-11-10 23:41:22', '', 58, 'http://localhost/apsn/?p=59', 0, 'revision', '', 0),
(60, 1, '2011-11-10 21:25:34', '2011-11-10 21:25:34', '', 'Events (V)', '', 'inherit', 'open', 'open', '', '43-revision-3', '', '', '2011-11-10 21:25:34', '2011-11-10 21:25:34', '', 43, 'http://localhost/apsn/?p=60', 0, 'revision', '', 0),
(62, 1, '2011-11-11 01:00:07', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2011-11-11 01:00:07', '0000-00-00 00:00:00', '', 0, 'http://localhost/apsn/?p=62', 0, 'post', '', 0),
(63, 1, '2011-09-30 02:34:08', '2011-09-30 02:34:08', 'Welcome to WordPress. This is your first post. Edit or delete it, then start blogging!', 'Hello world!', '', 'inherit', 'open', 'open', '', '1-revision', '', '', '2011-09-30 02:34:08', '2011-09-30 02:34:08', '', 1, 'http://localhost/apsn/?p=63', 0, 'revision', '', 0),
(64, 1, '2011-11-11 01:43:35', '2011-11-11 01:43:35', 'Click on login on the sidebar to login.\n\nTo end the session, click on logout.\n\nWe hope you have a pleasant session', 'Welcome to APSN Volunteer Portal', '', 'inherit', 'open', 'open', '', '4-autosave', '', '', '2011-11-11 01:43:35', '2011-11-11 01:43:35', '', 4, 'http://localhost/apsn/?p=64', 0, 'revision', '', 0),
(65, 1, '2011-09-30 02:35:13', '2011-09-30 02:35:13', 'HI!', 'Hello world!', '', 'inherit', 'open', 'open', '', '4-revision-2', '', '', '2011-09-30 02:35:13', '2011-09-30 02:35:13', '', 4, 'http://localhost/apsn/?p=65', 0, 'revision', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_ps_groups`
--

CREATE TABLE IF NOT EXISTS `wp_ps_groups` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `group_title` varchar(40) NOT NULL COMMENT 'The name of the group',
  `group_description` text COMMENT 'A description of or notes about the group',
  `group_creator` bigint(20) unsigned DEFAULT NULL COMMENT 'The id of the user who created the group',
  `group_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'The datetime the group was created',
  `group_system_id` varchar(5) DEFAULT NULL COMMENT 'A unique system id for system groups',
  `group_site_access` varchar(20) DEFAULT 'none' COMMENT 'If site security is enabled, this dictates how much access this group has. Values: none,limited,full',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `group_system_id` (`group_system_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `wp_ps_groups`
--

INSERT INTO `wp_ps_groups` (`ID`, `group_title`, `group_description`, `group_creator`, `group_date`, `group_system_id`, `group_site_access`) VALUES
(1, 'Registered Users', 'This group automatically applies to all authenticated users.', 0, '2011-10-28 05:58:39', 'CPS01', 'none'),
(2, 'Volunteers', 'Approved Applicants', 1, '2011-11-03 18:50:45', NULL, 'none'),
(3, 'Management', '', 1, '2011-11-03 22:18:50', NULL, 'none');

-- --------------------------------------------------------

--
-- Table structure for table `wp_ps_group_relationships`
--

CREATE TABLE IF NOT EXISTS `wp_ps_group_relationships` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `grel_group_id` bigint(20) unsigned NOT NULL COMMENT 'The group id that the user is attached to',
  `grel_user_id` bigint(20) unsigned NOT NULL COMMENT 'The user id to attach to the group',
  `grel_expires` datetime DEFAULT NULL COMMENT 'If set, user cannot access content after this date',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `wp_ps_group_relationships`
--

INSERT INTO `wp_ps_group_relationships` (`ID`, `grel_group_id`, `grel_user_id`, `grel_expires`) VALUES
(14, 2, 3, NULL),
(15, 2, 4, NULL),
(16, 2, 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wp_ps_security`
--

CREATE TABLE IF NOT EXISTS `wp_ps_security` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sec_protect_type` varchar(10) NOT NULL DEFAULT 'post' COMMENT 'What type of item is being protected? (post, term, media, archive, etc)',
  `sec_protect_id` bigint(20) unsigned NOT NULL COMMENT 'The id of the item (post, page, etc)',
  `sec_access_type` varchar(10) NOT NULL DEFAULT 'group' COMMENT 'Specifies whether this security entry pertains to a user, group, or role.',
  `sec_access_id` bigint(20) NOT NULL COMMENT 'The id of the user, group, or role this pertains to.',
  `sec_setting` varchar(10) NOT NULL DEFAULT 'allow' COMMENT 'Set to either allow or restrict',
  `sec_cascades` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'If true, these settings inherit down through the pages ancestors. If false (default), settings affect this page only.',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `wp_ps_security`
--

INSERT INTO `wp_ps_security` (`ID`, `sec_protect_type`, `sec_protect_id`, `sec_access_type`, `sec_access_id`, `sec_setting`, `sec_cascades`) VALUES
(1, 'post', 6, 'group', 1, 'allow', 1),
(2, 'post', 2, 'group', 3, 'allow', 1),
(3, 'post', 16, 'group', 3, 'allow', 1),
(4, 'post', 20, 'group', 2, 'allow', 1),
(5, 'post', 22, 'group', 1, 'allow', 1),
(6, 'post', 22, 'group', 2, 'allow', 1),
(7, 'post', 58, 'group', 3, 'allow', 1),
(8, 'post', 54, 'group', 3, 'allow', 1),
(9, 'post', 56, 'group', 3, 'allow', 1),
(10, 'post', 45, 'group', 3, 'allow', 1),
(11, 'post', 47, 'group', 3, 'allow', 1),
(12, 'post', 43, 'group', 2, 'allow', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_termmeta`
--

CREATE TABLE IF NOT EXISTS `wp_termmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wp_terms`
--

CREATE TABLE IF NOT EXISTS `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0),
(2, 'Blogroll', 'blogroll', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_relationships`
--

CREATE TABLE IF NOT EXISTS `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 2, 0),
(2, 2, 0),
(3, 2, 0),
(4, 2, 0),
(5, 2, 0),
(6, 2, 0),
(7, 2, 0),
(1, 1, 0),
(4, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1),
(2, 2, 'link_category', '', 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `wp_usermeta`
--

CREATE TABLE IF NOT EXISTS `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=126 ;

--
-- Dumping data for table `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'first_name', ''),
(2, 1, 'last_name', ''),
(3, 1, 'nickname', 'admin'),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'comment_shortcuts', 'false'),
(7, 1, 'admin_color', 'fresh'),
(8, 1, 'use_ssl', '0'),
(9, 1, 'show_admin_bar_front', 'true'),
(10, 1, 'show_admin_bar_admin', 'false'),
(11, 1, 'aim', ''),
(12, 1, 'yim', ''),
(13, 1, 'jabber', ''),
(14, 1, 'wp_capabilities', 'a:1:{s:13:"administrator";s:1:"1";}'),
(15, 1, 'wp_user_level', '10'),
(16, 1, 'wp_dashboard_quick_press_last_post_id', '62'),
(17, 1, 'wp_user-settings', 'tml1=4&tml0=2&m8=c&m7=c&m6=c&m9=c&m5=c&m4=c'),
(18, 1, 'wp_user-settings-time', '1320975476'),
(19, 2, 'first_name', 'anshu'),
(20, 2, 'last_name', 'garodia'),
(21, 2, 'nickname', 'anshu'),
(22, 2, 'description', ''),
(23, 2, 'rich_editing', 'true'),
(24, 2, 'comment_shortcuts', 'false'),
(25, 2, 'admin_color', 'fresh'),
(26, 2, 'use_ssl', '0'),
(27, 2, 'show_admin_bar_front', 'true'),
(28, 2, 'show_admin_bar_admin', 'false'),
(29, 2, 'aim', ''),
(30, 2, 'yim', ''),
(31, 2, 'jabber', ''),
(32, 2, 'wp_capabilities', 'a:1:{s:10:"subscriber";s:1:"1";}'),
(33, 2, 'wp_user_level', '0'),
(34, 3, 'first_name', 'akhand'),
(35, 3, 'last_name', 'rana'),
(36, 3, 'nickname', 'akhand'),
(37, 3, 'description', ''),
(38, 3, 'rich_editing', 'true'),
(39, 3, 'comment_shortcuts', 'false'),
(40, 3, 'admin_color', 'fresh'),
(41, 3, 'use_ssl', '0'),
(42, 3, 'show_admin_bar_front', 'true'),
(43, 3, 'show_admin_bar_admin', 'false'),
(44, 3, 'aim', ''),
(45, 3, 'yim', ''),
(46, 3, 'jabber', ''),
(47, 3, 'wp_capabilities', 'a:1:{s:10:"subscriber";s:1:"1";}'),
(48, 3, 'wp_user_level', '0'),
(49, 4, 'first_name', 'atif'),
(50, 4, 'last_name', 'saleem'),
(51, 4, 'nickname', 'atif'),
(52, 4, 'description', ''),
(53, 4, 'rich_editing', 'true'),
(54, 4, 'comment_shortcuts', 'false'),
(55, 4, 'admin_color', 'fresh'),
(56, 4, 'use_ssl', '0'),
(57, 4, 'show_admin_bar_front', 'true'),
(58, 4, 'show_admin_bar_admin', 'false'),
(59, 4, 'aim', ''),
(60, 4, 'yim', ''),
(61, 4, 'jabber', ''),
(62, 4, 'wp_capabilities', 'a:1:{s:10:"subscriber";s:1:"1";}'),
(63, 4, 'wp_user_level', '0'),
(64, 5, 'first_name', 'marshall'),
(65, 5, 'last_name', 'mathers'),
(66, 5, 'nickname', 'marshall'),
(67, 5, 'description', ''),
(68, 5, 'rich_editing', 'true'),
(69, 5, 'comment_shortcuts', 'false'),
(70, 5, 'admin_color', 'fresh'),
(71, 5, 'use_ssl', '0'),
(72, 5, 'show_admin_bar_front', 'true'),
(73, 5, 'show_admin_bar_admin', 'false'),
(74, 5, 'aim', ''),
(75, 5, 'yim', ''),
(76, 5, 'jabber', ''),
(77, 5, 'wp_capabilities', 'a:1:{s:10:"subscriber";s:1:"1";}'),
(78, 5, 'wp_user_level', '0'),
(79, 6, 'first_name', ''),
(80, 6, 'last_name', ''),
(81, 6, 'nickname', 'birlaakhand'),
(82, 6, 'description', ''),
(83, 6, 'rich_editing', 'true'),
(84, 6, 'comment_shortcuts', 'false'),
(85, 6, 'admin_color', 'fresh'),
(86, 6, 'use_ssl', '0'),
(87, 6, 'show_admin_bar_front', 'true'),
(88, 6, 'show_admin_bar_admin', 'false'),
(89, 6, 'aim', ''),
(90, 6, 'yim', ''),
(91, 6, 'jabber', ''),
(92, 6, 'wp_capabilities', 'a:1:{s:10:"subscriber";s:1:"1";}'),
(93, 6, 'wp_user_level', '0'),
(94, 6, 'default_password_nag', '1'),
(121, 8, 'aim', ''),
(120, 8, 'show_admin_bar_admin', 'false'),
(119, 8, 'show_admin_bar_front', 'true'),
(118, 8, 'use_ssl', '0'),
(117, 8, 'admin_color', 'fresh'),
(116, 8, 'comment_shortcuts', 'false'),
(115, 8, 'rich_editing', 'true'),
(114, 8, 'description', ''),
(113, 8, 'nickname', 'atif.saleem'),
(112, 8, 'last_name', 'Saleem'),
(111, 8, 'first_name', 'Atif'),
(122, 8, 'yim', ''),
(123, 8, 'jabber', ''),
(124, 8, 'wp_capabilities', 'a:1:{s:10:"subscriber";s:1:"1";}'),
(125, 8, 'wp_user_level', '0');

-- --------------------------------------------------------

--
-- Table structure for table `wp_users`
--

CREATE TABLE IF NOT EXISTS `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'admin', '$P$BWXMKz1bnCAdAcFl.fI51kUTni6MVV.', 'admin', 'athifsaleem@gmail.com', '', '2011-09-30 02:34:08', '', 0, 'admin'),
(2, 'anshu', '$P$Bh07o0c7KDks.cYaw4OdiHnq4twgu4.', 'anshu', 'anshugarodia@gmail.com', '', '2011-11-03 21:45:47', '', 0, 'anshu'),
(3, 'akhand', '$P$BEOP7cBlqjwtpwXQfp94u2V.nAdy2n/', 'akhand', 'akhand@gmail.com', '', '2011-11-03 22:22:20', '', 0, 'akhand'),
(4, 'atif', '$P$B7/zwKhgDYD3hP4jI9BpTR7rs5gZjj1', 'atif', 'atif1@e.ntu.edu.sg', '', '2011-11-04 05:06:53', '', 0, 'atif'),
(5, 'marshall', '$P$BWs5VQQsM3AC1HiotVN9OtdnBbGTvX1', 'marshall', 'xma1@e.ntu.edu.sg', '', '2011-11-04 05:07:19', '', 0, 'marshall'),
(6, 'birlaakhand', '$P$Br6HCu/1ayrl7hFrHW6ZnbFReC/zj80', 'birlaakhand', 'birlaakhand@gmail.com', '', '2011-11-11 01:34:42', '', 0, 'birlaakhand'),
(8, 'atif.saleem', '$P$B9t1mJPq2WLsIUQaZE4eY4NwkFQBd3/', 'atif-saleem', 'atif.saleem@me.com', 'http://localhost/apsn', '2011-11-11 01:40:57', '', 0, 'atif.saleem');

-- --------------------------------------------------------

--
-- Table structure for table `wp_volunteers_details`
--

CREATE TABLE IF NOT EXISTS `wp_volunteers_details` (
  `Email` varchar(80) NOT NULL,
  `Title` varchar(11) NOT NULL,
  `First Name` varchar(20) NOT NULL,
  `Last Name` varchar(20) NOT NULL,
  `Sex` varchar(11) NOT NULL,
  `NRIC` varchar(11) NOT NULL,
  `Date of Birth` date NOT NULL,
  `Nationality` varchar(25) NOT NULL,
  `Race` varchar(20) NOT NULL,
  `Religion` varchar(20) NOT NULL,
  `Singapore PR?` varchar(11) NOT NULL,
  `Country of Birth` varchar(30) NOT NULL,
  `Marital Status` varchar(11) NOT NULL,
  `NS Status` varchar(11) NOT NULL,
  `Written` varchar(20) NOT NULL,
  `Spoken` varchar(20) NOT NULL,
  `Highest Educational Level Attained` varchar(11) NOT NULL,
  `Name of Diploma/Degree Attained` varchar(30) NOT NULL,
  `Home Address` varchar(80) NOT NULL,
  `Postal Code` int(6) NOT NULL,
  `Home Telephone` int(11) NOT NULL,
  `Pager/Handphone` int(11) NOT NULL,
  `Type of Dwelling` varchar(11) NOT NULL,
  `Others(Please Specify)` varchar(25) NOT NULL,
  `Name of the Employer/Company` varchar(30) NOT NULL,
  `Workplace Address` varchar(80) NOT NULL,
  `Office Number` varchar(15) NOT NULL,
  `Fax Number` varchar(15) NOT NULL,
  `Previous Volunteering Experience` varchar(4) NOT NULL,
  `If yes, please specify the name of the organization` varchar(50) NOT NULL,
  `Special Skills and Talents to Contribute` varchar(100) NOT NULL,
  `Children` varchar(5) NOT NULL,
  `Youth` varchar(5) NOT NULL,
  `Adults` varchar(5) NOT NULL,
  `instructional (eg cooking lessons, arts)` varchar(5) NOT NULL,
  `Please provide details` varchar(40) NOT NULL,
  `Organizing Activities` varchar(5) NOT NULL,
  `Admin/Instructional Support` varchar(5) NOT NULL,
  `Others (Please Specify)` varchar(5) NOT NULL,
  `Availability for routine regular school activities` varchar(5) NOT NULL,
  PRIMARY KEY (`Email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wp_volunteers_details`
--

INSERT INTO `wp_volunteers_details` (`Email`, `Title`, `First Name`, `Last Name`, `Sex`, `NRIC`, `Date of Birth`, `Nationality`, `Race`, `Religion`, `Singapore PR?`, `Country of Birth`, `Marital Status`, `NS Status`, `Written`, `Spoken`, `Highest Educational Level Attained`, `Name of Diploma/Degree Attained`, `Home Address`, `Postal Code`, `Home Telephone`, `Pager/Handphone`, `Type of Dwelling`, `Others(Please Specify)`, `Name of the Employer/Company`, `Workplace Address`, `Office Number`, `Fax Number`, `Previous Volunteering Experience`, `If yes, please specify the name of the organization`, `Special Skills and Talents to Contribute`, `Children`, `Youth`, `Adults`, `instructional (eg cooking lessons, arts)`, `Please provide details`, `Organizing Activities`, `Admin/Instructional Support`, `Others (Please Specify)`, `Availability for routine regular school activities`) VALUES
('athifsaleem@gmail.com', 'Ms.', 'sdf', 'DFGF', 'Female', 'DSFA', '1992-07-23', 'Dubai', 'adfklj', 'jasdklf', '1', 'asdhfjkasd', '1', '1', 'asdfh', '', '1', '', '', 0, 0, 8928392, '1', '', '', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', ''),
('ww@ww.com', 'Dr.', 'A', '2', '1', '1212', '1992-07-22', 'Indian', 'Indian', 'm', '1', 's', '1', '1', 'en', '2n', '1', 'ww', 'ww', 9232, 991, 991, '1', 'none', '', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', ''),
('007bond@president.pluto.com', 'Mr.', 'Akhand', 'Singh', 'Male', 'abcd', '1992-07-23', 'indian', 'indian', 'hindu', '0', 'india', '4', '3', 'english', 'angrezi', '1', 'kindergarten', '123,abc,pluto', 7, 7, 7, '5', '', '', '42, Pluto Street,Sun Core', '007', '007', '1', 'every organization', 'universal set', 'on', 'on', 'on', '-', 'every good looking,talented and smart cr', 'on', 'on', 'Overt', '3'),
('chillinout@gmail.com', 'Mdm.', 'Shelly', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('anshu@gmail.com', 'Mdm.', 'Anshu', 'Garodia', 'Female', '12323', '1992-07-23', 'Indian', 'Indian', 'Hindu', '1', 'India', '1', '1', 'Bhojpuri', 'Bhojpuri', '1', 'University', 'Nanyang Avenue', 4545, 12323, 12231, '1', 'adfsadf', '', 'Hello!', '234234', '234234', '0', 'None!', 'Singing!', 'on', 'on', 'on', 'on', 'dafsadf', 'on', 'on', 'asdfs', '1'),
('akhand@gmail.com', 'Mdm.', 'akhand', 'pratap', 'Male', '', '1992-07-23', '', '', '', '1', '', '1', '1', '', '', '1', '', '', 0, 0, 1231232, '1', '', '', '', '', '', '1', 'yes', '', '-', '-', '-', '-', '', '-', '-', '', '1'),
('atif1@e.ntu.edu.sg', 'Mr.', 'Atif ', 'Saleem', 'Male', 'G0979652K', '1992-07-23', 'Indian', 'Indian', 'Muslim', '0', 'UAE', '1', '3', 'English', 'English', '5', 'CBSE', '20 Nanyang Avenue', 97150, 98280444, 98280444, '1', 'HDB', '', 'Dubai', '042683367', '042683367', '1', 'Al Noor', 'Dance', 'on', '-', 'on', 'on', 'Interesting in painting', 'on', 'on', 'Inter', '1'),
('ar@gmail.com', 'Mr.', 'Atif ', 'Saleem', '-', '', '1992-07-23', '', '', '', '1', '', '1', '1', '', '', '1', '', '', 0, 0, 98280444, '1', '', '', '', '', '', '0', '', '', '-', '-', '-', '-', '', '-', '-', '', '1'),
('atif.saleem@me.com', 'Mr.', 'Rick', 'Lim', 'Male', '', '1992-07-23', '', '', '', '1', '', '1', '1', '', '', '1', '', '', 0, 0, 98280444, '1', '', '', '', '', '', '1', '', '', '-', '-', 'on', 'on', '', 'on', 'on', '', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
