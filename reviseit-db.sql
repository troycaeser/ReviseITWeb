-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306

-- Generation Time: Jun 12, 2013 at 02:15 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `reviseit`
--

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `ImageID` int(11) NOT NULL AUTO_INCREMENT,
  `ImageName` int(11) NOT NULL,
  `ImageLink` mediumblob NOT NULL,
  `SubtopicID` int(11) NOT NULL,
  PRIMARY KEY (`ImageID`),
  KEY `FK_image` (`SubtopicID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `multichoice`
--

CREATE TABLE IF NOT EXISTS `multichoice` (
  `MultiChoiceID` int(11) NOT NULL AUTO_INCREMENT,
  `Question` text NOT NULL,
  `Answer1` text NOT NULL,
  `Answer2` text NOT NULL,
  `Answer3` text NOT NULL,
  `Answer4` text NOT NULL,
  `TestID` int(11) NOT NULL,
  `correctAns` varchar(10) NOT NULL,
  PRIMARY KEY (`MultiChoiceID`),
  KEY `FK_multichoice` (`TestID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `multichoice`
--

INSERT INTO `multichoice` (`MultiChoiceID`, `Question`, `Answer1`, `Answer2`, `Answer3`, `Answer4`, `TestID`, `correctAns`) VALUES
(1, 'How do you use an insert query in SQL', 'INSERT INTO ', 'INSERT NEW', 'ADD NEW', 'ADD RECORD', 2, '1'),
(2, 'How would you select all the columns from a table named "Persons"', 'SELECT [all] FROM Persons', 'SELECT *. Persons', 'SELECT * FROM Persons', 'SELECT Persons', 2, '3'),
(3, 'How do you select all the records from a table named "Persons" where the value of the column "FirstName" is "Peter"?', 'SELECT [all] FROM Persons WHERE Firstname = ''Peter''', 'SELECT * FROM Persons WHERE Firstname = ''Peter''', 'SELECT * FROM PERSONS WHERE FIRSTNAME<>''Peter''', 'SELECT [all] FROM PERSONS WHERE FIRSTNAME LIKE ''Peter''', 2, '2'),
(4, 'What does SQL stand for?', 'Strong Question Language', 'Structured Query Language', 'Structured Question Language', 'Strong query Language', 18, '2'),
(5, 'What are HTTP Post Requests usually mapped to', 'INSERT QUERIES', 'UPDATE QUERIES', 'SELECT QUERIES', 'DELETE QUERIES', 13, '1'),
(6, 'HTTP Post Requests are available...', 'In a browser', 'To a cURL command', 'Both of the above', 'None of the above', 13, '2'),
(7, 'Which of the Following could be get requests...', 'A link to another web-page', 'a web-page form submitted', 'A cURL command ', 'All of the above', 34, '4'),
(8, 'Which of the following is the beginning of a valid HTTP Put Request', 'curl -i -X PUT -H ', 'curl -i -X PUT -H -d ', 'curl -i -X PUT -H ', 'curl -i -X PUT', 35, '2'),
(9, 'An INSERT Query has the following purpose', 'Editing data in a field', 'Add an extra column to a table', 'Placing new data between existing cells', 'Adding a new row of data to a table', 1, '4'),
(10, 'Which CRUD Operation is mapped to the INSERT Query', 'Create', 'Read', 'Update', 'Delete', 1, '1'),
(11, 'Which of the following is a valid UPDATE Query', 'UPDATE * FROM table_name', 'UPDATE table_name (data = value, date = 2013-06-11)', 'UPDATE table_name (data, date) VALUES (value, 2013-06-11)', 'UPDATE table_name WHERE id = 4;', 3, '3'),
(12, 'An UPDATE Query...', 'Creates new data in a database', 'adds columns to a table', 'edits columns in a table', 'edits data in a table', 3, '4'),
(13, 'SELECT Queries are used to', 'SELECT Data to be edited', 'SELECT column names to be listed', 'SELECT data to be output', 'SELECT ids of records to be deleted', 37, '3'),
(14, 'Which of the following is a valid SELECT Query', 'SELECT * FROM column_name', 'SELECT example% FROM id_value', 'SELECT FROM table_name', 'SELECT * FROM *;', 37, ''),
(15, 'DELETE Queries DELETE ', 'Databases', 'Tables', 'Data', 'All of the Above', 38, '3'),
(16, 'Ajax Stands for', 'Asynchronous Javascript And XML', 'Absolute Java And XML', 'Absolute JQuery And XHTML', 'Absolute Javascript and XML', 2, '1'),
(17, 'Ajax calls are made using the programming language', 'Java', 'Javascript', 'Objective C', 'HTML5 and CSS3', 2, '2'),
(18, 'The Android Emulator contains', 'All Android Operating Systems', 'All Android Operating Systems since v1.5 Donut', 'All Android Operating Systems since v2.2 Froyo', 'All Android Operating Systems since v3.0 Gingerbread', 4, ''),
(19, 'Logcat Displays', 'All Errors in the app', 'System.out.println() statements output', 'Warnings about XML usage', 'All of the Above', 39, '2'),
(20, 'The Slim Framework allows the following requests to be made', 'GET', 'POST/PUT', 'DELETE', 'All of the Above', 6, '4'),
(21, 'Test Question with \\"QUOTE MARKS\\"', 'WRONG ANSWER \\"MATE\\"', 'RIGHT ANSWER \\"MATE\\"', 'WRONG AGAIN \\"MATE\\"', 'WRONG FOREVER \\"MATE\\"', 7, '2');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `ResultID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `TestID` int(11) DEFAULT NULL,
  `Result` int(11) DEFAULT NULL,
  PRIMARY KEY (`ResultID`),
  KEY `userid` (`UserID`),
  KEY `testid` (`TestID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=8 ;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`ResultID`, `UserID`, `TestID`, `Result`) VALUES
(1, 4, 1, 50),
(2, 2, 2, 90),
(3, 10, 2, 60),
(4, 3, 3, 50),
(5, 4, 1, 70),
(6, 15, 9, 75),
(7, 17, 19, 45);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `SubjectID` int(11) NOT NULL AUTO_INCREMENT,
  `SubjectCode` varchar(50) NOT NULL,
  `SubjectName` text NOT NULL,
  `UserID` int(11) NOT NULL,
  `Dateupdated` date NOT NULL,
  PRIMARY KEY (`SubjectID`),
  KEY `FK_subject` (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`SubjectID`, `SubjectCode`, `SubjectName`, `UserID`, `Dateupdated`) VALUES
(1, 'ICT31A', 'Mobile Apps with Android', 14, '2013-02-11'),
(2, 'ICT32A', 'Mobile Apps with IOS', 12, '2013-04-09'),
(3, 'ICT33A', 'Programming for the Cloud', 2, '2013-05-13'),
(4, 'CIT27B', 'Software Project', 11, '2013-06-11'),
(5, 'ICT22A', 'Mobile Applications 2', 8, '2013-05-05'),
(6, 'CPC50210', 'Diploma of Building & Constructions', 9, '2013-05-03'),
(7, 'SIT40307', 'Certificate IV in Hospitality', 13, '2013-05-10'),
(8, 'CLMF40408', 'Certificate IV in Interior Decoration', 18, '2013-06-03'),
(9, 'LLMT21707', 'Certificate II in Applied Fashion Design and Technology', 21, '2013-06-01'),
(10, '22203VIC', 'Certificate IV in Professional Writing and Editing', 27, '2013-06-02'),
(11, 'CUF50107', 'Diploma of Screen and Media ', 34, '2013-06-01'),
(12, 'CUV60411', 'Advanced Diploma of Graphic Design\r\n', 20, '2013-06-02'),
(13, 'CPC32408', 'Certificate III in Plumbing', 30, '2013-06-03'),
(14, 'CPC30108', 'Certificate III in Bricklaying ', 32, '2013-06-01'),
(15, 'BCG60103', 'Advanced Diploma of Building Surveying\n\n', 33, '2013-06-02'),
(16, '21953VIC', 'Advanced Diploma of Building Design ', 37, '2013-06-03'),
(17, 'HLT41812', 'Certificate IV in Pathology', 27, '2013-06-03'),
(18, 'FNS40611', 'Certificate IV in Accounting', 34, '2013-06-01'),
(19, 'BSB50407', 'Diploma of Business Administration\r\n', 35, '2013-06-03'),
(20, 'FNS50611', 'Diploma of Financial Planning', 36, '2013-06-01'),
(21, 'BSB60507', 'Advanced Diploma of Marketing\r\n', 38, '2013-06-01'),
(22, 'HLT50512', 'Diploma of Dental Technology', 39, '2013-06-01'),
(23, 'CHC51408', 'Diploma of Youth Work', 40, '2013-06-01'),
(24, '22200VIC', 'Advanced Diploma of Justice', 42, '2013-06-03'),
(25, 'CHC41712', 'Certificate IV in Education Support', 41, '2013-06-04'),
(26, 'CHC50908', 'Diploma of Children''s Services\n', 47, '2013-06-04'),
(27, 'ICA40911', 'Certificate IV in Digital and Interactive Games', 48, '2013-06-03'),
(28, 'ICA40811', 'Certificate IV in Digital Media Technologies', 50, '2013-06-03'),
(29, 'SIS40210', 'Certificate IV in Fitness', 51, '2013-06-04'),
(30, 'SIS50610', 'Diploma of Sport ', 55, '2013-06-04'),
(31, 'AUR30805', 'Certificate III in Automotive Vehicle Body ', 56, '2013-06-04'),
(32, 'SIT50207', 'Diploma of Events', 54, '2013-06-05');

-- --------------------------------------------------------

--
-- Table structure for table `subtopic`
--

CREATE TABLE IF NOT EXISTS `subtopic` (
  `SubtopicID` int(11) NOT NULL AUTO_INCREMENT,
  `SubtopicName` varchar(50) NOT NULL,
  `TopicID` int(11) NOT NULL,
  `SubtopicBriefDescription` text NOT NULL,
  `Content` text NOT NULL,
  `Downloads` int(11) NOT NULL,
  `DateUpdated` date NOT NULL,
  PRIMARY KEY (`SubtopicID`),
  KEY `FK_subtopic` (`TopicID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=144 ;

--
-- Dumping data for table `subtopic`
--

INSERT INTO `subtopic` (`SubtopicID`, `SubtopicName`, `TopicID`, `SubtopicBriefDescription`, `Content`, `Downloads`, `DateUpdated`) VALUES
(1, 'Insert Query', 2, 'Learn about the insert SQL query and how they are set up.', 'This unit will be covering the SQL insert query and how it is used.<br><br>The insert query is used to insert data into a database using the following syntax:\n<br>INSERT INTO table_name VALUES(value1, value2, value3).\n<br><br>For e.g.<br>INSERT INTO Customers VALUES (\\''Cardinal\\'',\\''Tom B. Erichsen\\'',\\''Skagen 21\\'',\\''Stavanger\\'',\\''4006\\'',\\''Norway\\'');<br><br>If you wish to specify which columns will have values entered into, then the syntax would be:&nbsp;<br>INSERT INTO(column_name1, column_name2, column_name3)VALUES(value1, value2, value3);<br><br>For e.g. INSERT INTO Customers (CustomerName, ContactName, Address, City, PostalCode, Country)<br>VALUES (\\''Cardinal\\'',\\''Tom B. Erichsen\\'',\\''Skagen 21\\'',\\''Stavanger\\'',\\''4006\\'',\\''Norway\\'');<br>', 5, '2013-06-09'),
(2, 'Connect To WebService', 3, 'Learn how to connect to the web service and how to receive the data as a JSON string', 'To connect to a webservice, the data entered can either be JSON or XML. This subtopic, will be specialising in using JSON strings.<br><br>When using XML the syntax to display the data uses:<br>\n  <span>&lt;Product&gt;\n  <br>&lt;ProductID&gt;1&lt;/ProductID&gt;\n  <br>&lt;ProductCode&gt;p_1&lt;/ProductCode&gt;\n  <br>&lt;ProductName&gt;a Product 1&lt;/ProductName&gt;\n<br>&lt;/Product&gt;</span><br><br>XML also lets you invent your own tags. Say for example that you wanted to create a note, to store it as XML it would go as follows:<br><br>&lt;note&gt;<br>\n&lt;to&gt;Tove&lt;/to&gt;<br>\n&lt;from&gt;Jani&lt;/from&gt;<br>\n&lt;heading&gt;Reminder&lt;/heading&gt;<br>\n&lt;body&gt;Don''t forget me this weekend!&lt;/body&gt;<br>\n&lt;/note&gt;<br><br>But while JSON, the syntax is entirely different; which uses:<br>{\\"ProductID\\":1,\\"ProductName\\":\\"a Product 1\\"}.<br><br>You are also able to call either the web service using what is known as jquery. To retrieve the data from the web service, you must use the ajax method; the syntax to use it goes as follows:<br><span>$.ajax({\n<br>        type: "\\POST\\",\n        <br>data: \\"{\\''prefix\\'':\\''''}\\",\n<br>        url: \\"/YourWebService.asmx/MethodName\\",<br>&nbsp;contentType: \\"application/json; charset=utf-8\\",\n<br>        dataType: \\"json\\",\n        <br>success: functionToCallWhenSucceed,\n        <br>failure: </span><br>functionToCallWhenSucceed&nbsp; });<br><br>In the data parameter within the ajax function, you are able to call the web service 2 ways.<br>Without any parameters:<br>\\"{}\\"<br><br>With parameters:<br>data: \\”{\\‘SiteName\\’:\\’CodeProject\\’,\\’PostedDate\\’:\\’1 jan 2009\\’}\\”.<br><br>Both the success and failure items contain functions titled, functionToCallWhenSucceed and functionToCallWhenFailed. If the web service was successful, it would call the functionToCallWhenSucceed method and if it failed it would call the functionToCallWhenSucceed method instead.<br><br><br><br>', 5, '2013-06-08'),
(3, 'UPDATE query', 2, 'Learn what the syntax is to update records within a database', 'This unit covers how to update records within a database.<br>In order to update any record(s) int the table, you would use the UPDATE keyword, so the syntax would be:<br>UPDATE table_name SET column1=value1,column2=value2 WHERE some_column=some_value;<br><br>It''s important when updating records to use the WHERE clause, if you don''t an sql query like UPDATE Customers<br>\nSET ContactName=\\''Alfred Schmidt\\'', City=\\''Hamburg\\''; would update every ContactName to Alfred Schmidt and City to Hamburg. But, if you use the WHERE clause, then it would only update that specific record WHERE CustomerName=\\''Alfreds Futterkiste\\'';<br>', 1, '2013-06-09'),
(4, 'Android Emulator', 4, 'Learn how to receive and display the received JSON data within an android emulator', 'This unit covers how to use an android emulator in the program Eclipse.<br><br>The program used for developing Android applications is Eclipse.<br><br>To use Eclipse, you will need to download:<br><ul><li>an Android-sdk folder - that is used to store the emulators used within Eclipse</li></ul><br>Some useful commands to know when using the emulator is as follows:<br><ul><li>Press Home on the keyboard to go home on the android device</li><li>Press F2 or PgUp&nbsp;on the keyboard to access the Menu (Left softKey) on the android device</li><li>Press&nbsp;Shift-F2&nbsp;or&nbsp;PgDn on the keyboard to access the&nbsp;Star (right softkey)</li><li>Press Esc on keyboard to go back on the device</li><li>Press F3 to access the Call/dial button</li><li>Press F4 to hangup</li><li>Press F5 to&nbsp;Search</li><li>Press F7 to access the Power button</li><li>Press&nbsp;Ctrl-F11, to switch to previous layout orientation (e.g. portrait or landscape)</li><li>Press Ctrl-F12, to switch to next layout orientation (for example, portrait, landscape)</li></ul>To start an application, you first must right click on the application that you wish to run and then select \\''Run as\\'' and select \\''Android Application\\''. After that, the emulator should start running and the application will begin.<br>', 10, '2013-06-08'),
(5, 'While loops', 7, 'Learn how a while loop is used, what to use them for and what the syntax is when using a while loop', 'This unit covers how to use the while loop function in Java.\n\nThe syntax for it is:\nwhile (expression) \n{\n  statement(s)\n}', 5, '2013-02-11'),
(6, 'SLIM Framework Installation', 5, 'Learn how to successfully install the SLIM Framework', 'This unit covers how to install the SLIM Framework.<br><br>The <b>SLIM Framework</b> is used to write web applications and APIs. <br>To use this, you need to have basic a understanding of PHP because that is what will be used when coding with SLIM.<br><br>All you would need to do to download the SLIM framework is to go to the website,&nbsp;<a target="_blank" rel="nofollow" href="http://www.slimframework.com/">http://www.slimframework.com/</a>&nbsp;and click the \\''Install Now\\'' button, which will then ask whether you want to download the \\''Latest Release\\'' or the \\''Stable Release\\'', after you''ve chosen which you want you will then be&nbsp;prompted(depending on web browser used) where you want to save the .zip file to a location. After you have saved, you would extract the file.&nbsp;<br><br>When the folder has been extracted, then you are done.<br><br>To do the coding, you would do all that in the index.php file.<br><br><br>', 0, '2013-06-08'),
(7, 'If Statement', 6, 'Learn the syntax for an IF statement and how to successfully use it.', 'The syntax for using an if statement in java, or any programming goes as follows:;<br>If(condition)<br>execute statement.<br><br>For e.g.<br>if (isMoving)<br>{&nbsp;&nbsp;<br>&nbsp;// the \\"then\\" clause: decrease current speed&nbsp;<br>&nbsp;currentSpeed--;&nbsp;<br>}<br><br>There are many ways that an if statement can be used, in addition to that there is also the if-else command; which follows the same syntax as before, but instead it goes:<br>if(condition)<br>execute statement<br>else<br>execute other statement.<br><br>For e.g.&nbsp;<br><span>if (isMoving) <br>{\n<br>&nbsp;currentSpeed--;\n<br>} <br>else <br>{\n<br>&nbsp;System.err.println(\\"The bicycle has already stopped!\\");\n<br>}</span>', 0, '2013-06-08'),
(8, 'Dimension', 8, 'Learn about how dimension affects the perspective of houses', 'This unit covers how to do architectural drawings using the aspect of dimension, i.e. 2D, 3D etc.', 0, '2013-06-09'),
(9, 'Switch Statement', 9, 'Learn how to use a switch statement, and what syntax is used', 'This unit covers what a switch statement is used for and how the syntax goes.<br><br>switch (<i>n</i>)<br>{<br>case&nbsp;<i>label1:</i><br>&nbsp;&nbsp;<i>code to be executed if n=label1;</i><br>&nbsp;&nbsp;break;<br>case&nbsp;<i>label2:</i><br>&nbsp;&nbsp;<i>code to be executed if n=label2;</i><br>&nbsp;&nbsp;break;<br>default:<br>&nbsp;&nbsp;<i>code to be executed if n is different from both label1 and label2;</i><br><span>}<br></span><br>For e.g.<br>&lt;?php<br>$favcolor="red";<br>switch ($favcolor)<br>{<br>case "red":<br>&nbsp; echo "Your favorite color is red!";<br>&nbsp; break;<br>case "blue":<br>&nbsp; echo "Your favorite color is blue!";<br>&nbsp; break;<br>case "green":<br>&nbsp; echo "Your favorite color is green!";<br>&nbsp; break;<br>default:<br>&nbsp; echo "Your favorite color is neither red, blue, or green!";<br>}<br>?&gt;<br>', 0, '2013-06-10'),
(10, 'Input Types', 10, 'Learn about the different input types that are used within HTML5', 'There are some new HTML tags used in HTML5 that were not in previous versions of HTML.<br><br>These new tags include:<br><ul><li>autocomplete</li><li>autofocus</li><li>form</li><li>formaction</li><li>formenctype</li><li>formmethod</li><li>formnovalidate</li><li>formtarget</li><li>height</li><li>list</li><li>max</li><li>min</li><li>multiple</li><li>name</li><li>pattern</li><li>placeholder</li><li>required</li><li>step, and</li><li>width</li></ul>The autocomplete attribute is used when specifying whether or not a field has autocomplete enabled.<br>For e.g.<br><br>The autofocus attribute is used to specify which field gets automatically focused when the page loads.<br><span>For e.g.&nbsp;<br></span><br>The form attribute specifies which form(s) the input element belongs to.<br>For e.g.&nbsp;<br><br>The formaction attribute overrides the <b>action&nbsp;</b>attribute of the form element.<br>For e.g.&nbsp;<br><br>The&nbsp;formenctype tag is only used when the form method=\\"post\\" and it specifies how the form-data should be encoded when submitting to the server.<br>For e.g.&nbsp;<br><br>The formaction attribute is used to define what HTTP method for sending data to the URL.<br>For e.g.&nbsp;<span><br><br>The formnovalidate attribute specifies which input element should not be validated when the form is submitted.&nbsp;<br>For e.g.&nbsp;</span><span><br><br>The formtarget attribute specifies where to display the response after submitting the form.<br></span>For e.g.&nbsp;<br><br>The height attribute is only used with with the <br>For e.g.&nbsp;pixels\\<span>"&gt; where \\"pixels\\" could be 100 for example.<br><br>The list attribute refers to the <span> element that contains pre-defined values for an  element<br>For e.g. list = \\"value\\"&gt;</span></span><br><br>The max attribute specifies the maximum value for an , while the min attribute specifies the minimum value for an  element.<br>For e.g.&nbsp;<span> <span>min="1" max="5"&gt;<br><br>The multiple attribute element allows you to enter multiple values within an input element.<br>For e.g. multiple&gt;<span><br><br>The pattern attribute specifies a regular expression&nbsp;</span><span>that the  element''s value is checked against.<br>For e.g&nbsp;</span>pattern=\\"[A-Za-z]{3}\\"&gt;<br><br><span>The placeholder attribute specifies a short hint that describes the expected value of an input field<br></span>For e.g. <span>placeholder="Last name"&gt;<br><br>The required attribute specifies that a specific  field is required to be filled in before &nbsp;being submitted.<br>For e.g. required&gt;<br><br>The step attribute</span></span></span>&nbsp;specifies the legal number intervals for an  element. An example of that could be&nbsp;if step=\\"3\\", legal numbers could be -3, 0, 3, 6, etc.<span><br>For e.g. step=\\"3\\"&gt;<br><br>The width attribute specifies the width of the  element<br></span>width=\\"48\\"&gt;<br>', 0, '2013-06-08'),
(11, 'Introduction', 11, 'Learn how what jQuery mobile is and how to use it.', 'This unit covers what jQuery mobile is and what it is used for.<br><br>jQuery mobile can be used to create applications for all smartphones and tablets.<br><br>To understand how to use jQuery mobile, you need to have a basic understanding of HTML.<br>jQuery mobile uses a lot of HTML tags. Some examples of when you jquery mobile would be used would be:<br><ul><li>Dialog boxes &amp; transitions</li><li>Linking pages</li><li>Transitions</li><li>Theming a page</li></ul><br>To create a dialog box, all that you need to use is:&nbsp;data-rel=\\"dialog\\"&gt; at the end of the element. If you want a transition to occur afterwards you add&nbsp;<span>data-transition=\\"pop\\"&gt;. With the transitions, there are a variety of different transitions that can be used, they include:<br></span><ul><li>\\"pop\\"</li><li>\\"slidedown\\"</li><li>\\"flip\\"</li></ul>To link back to previous pages within a multi-page document, you''d use&nbsp;data-rel="back" in an anchor. In order to link within a multi-page document, you''d use:&nbsp;rel=\\"external\\"&gt;<br>', 0, '2013-06-08'),
(12, 'Incorporate PHP in Ajax', 12, 'Learn about how AJAX can be implemented to use PHP variables', 'This unit covers how you would incorporate PHP into an AJAX application.<br><br>AJAX stands for&nbsp;<span>Asynchronous JavaScript and XML.<br><br>It is used to create dynamic web pages, an example of an application that utilises AJAX would be the search bar on google. In order to understand how AJAX works, you need to have a decent understand of Javascript and PHP.</span>', 0, '2013-06-08'),
(13, 'Post', 1, 'Learn about the cURL \\"Post\\" command  that will be used', 'This unit will be covering the cURL command used to insert a record into a database within cURL.<br>', 2, '2013-06-09'),
(14, 'If Statement', 9, 'Learn the syntax for an IF statement and how to successfully use it.', 'The syntax of an if statement in PHP is identical to Java. The syntax for it goes&nbsp;<br>if (<i>condition</i>)<br>{<i><br>&nbsp; code to be executed if condition is true</i>;<i><br></i><span>}.<br><br>When coding in PHP, you need to have these tags before and at the end; &lt;?php ?&gt;.<br><br>An example of using an if statement in PHP could be:<br></span>&lt;?php<br>$t=date(\\"H\\");<br>if ($t&lt;\\"20\\")<br>{<br>&nbsp;echo \\"Have a good day!\\";<br>}<br><span>?&gt;<br></span><br>In addition to that, there is also the else statement used with an if statement. To use it, the syntax would be:<br>if (<i>condition</i>)<br>{<i><br>&nbsp; code to be executed if condition is true</i>;<i><br></i>}<br>else<br>{<i><br>&nbsp; code to be executed if condition is false</i>;<i><br></i>}<br><br>For e.g.<br>&lt;?php<br>$t=date(\\"H\\");<br>if ($t&lt;\\"20\\")<br>{<br>&nbsp;echo \\"Have a good day!\\";<br>}<br>else<br>{<br>&nbsp;echo \\"Have a good night!\\";<br>}<br>?&gt;<br>', 0, '2013-06-08'),
(15, 'Form Controls', 13, 'Learn what the different form controls are, and how they''re used', 'When creating a form in&nbsp;Visual Basic .NET, you can use multiple elements; they would be:<br><ul><li>Button</li><li>Checkbox</li><li>CheckedListBox</li><li>ComboBox</li><li>DateTimePicker</li><li>Label</li><li>LinkLabel</li><li>ListView</li><li>MaskedTextBox</li><li>MonthCalendar</li><li>NumericUpDown</li><li>RadioButton, and</li><li>TextBox</li></ul>To drag any of those icons onto a form, what you need to do is:<br><ol><li>Find the icon you wish to use</li><li>Double click the icon and it will be placed onto the form.</li></ol>', 0, '2013-06-08'),
(16, 'Coding Standard', 14, 'Learn what the coding standard is when it comes to Web Programming in general.\r\nIt varies with different programming languages', 'HTML stands for Hyper Text Markup Language.<br><br>When coding with HTML, the standard used for basic web pages is:<br>&lt;!DOCTYPE html&gt;<br>&lt;html&gt;<br>&lt;body&gt;<br><br>&lt;h1&gt;My First Heading&lt;/h1&gt;<br><br>&lt;p&gt;My first paragraph.&lt;/p&gt;<br><br>&lt;/body&gt;<br><span>&lt;/html&gt;.<br></span><br>The DOCTYPE declaration define the document type.<br>Any text between the &lt;HTML&gt;&lt;/HTML&gt; tags are to be displayed on the web page in the browser<br>Any text between the &lt;body&gt;&lt;/body&gt; tags, displays the content on the web page<br>Any text between the &lt;H1&gt;&lt;/H1&gt; tags, is displayed as a heading<br>Any text between &lt;p&gt; and &lt;/p&gt; is displayed as a paragraph', 2, '2013-06-08'),
(17, 'Database Administration', 15, 'Learn about the different user levels when it comes to database administration. i.e. Administrator, User etc.', 'This unit covers how to perform database administration duties, e.g. making backups, creating databases etc.', 5, '2013-06-08'),
(18, 'SQLyog and SQL Server', 15, 'Learn about different programs that can be used with executing different sql commands within a database.', 'This unit will be covering what sqlyog is and how it is used to perform sql queries, the unit will also be covering what sql server is and how it is used.', 10, '2013-06-08'),
(19, 'Sprites', 16, 'Learn what sprites are and how they''re used when creating/programming video games.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at magna eu orci laoreet rutrum. Vivamus ac venenatis nulla. Morbi arcu quam, faucibus quis blandit at, interdum eget velit. Ut congue viverra cursus. In ac sapien neque. Sed pharetra facilisis nisi, ut sollicitudin metus mollis nec. Suspendisse mollis scelerisque tortor at ullamcorper. Fusce non nisi arcu, iaculis consequat est. Maecenas eget consectetur sapien. Vivamus laoreet faucibus sodales. Aenean ultricies tempor lectus vitae aliquet.<linebreak/>\r\n\r\nDuis vitae augue est. Aliquam feugiat sem id ante tristique interdum. Nam a feugiat enim. In ac nulla sem. Nunc ultricies diam volutpat mauris feugiat a eleifend nisi pretium. Fusce eu metus in felis semper sagittis eget quis orci. Phasellus neque risus, eleifend pharetra tempor nec, vestibulum ac odio. Nunc ultrices, neque ut adipiscing vestibulum, elit purus condimentum est, ut accumsan magna leo sed sapien. Donec vitae pharetra odio.<linebreak/>\r\n\r\nVestibulum quis dignissim risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum tempus imperdiet nibh dictum sodales. Morbi quis dui erat. Sed pulvinar feugiat orci in lobortis. Aenean sit amet dui lectus, id pharetra justo. Aliquam metus ante, ullamcorper id consequat ac, blandit ac est. Pellentesque congue placerat sapien sit amet pretium. Nunc eu ultricies enim. Nam lobortis lacus id tellus posuere dictum. Praesent ut nibh erat. Donec dolor libero, lacinia in aliquam sed, feugiat nec mauris. Nunc varius porta lacus ut aliquam. <linebreak/>', 5, '2013-06-03'),
(20, 'Sprites Animation', 17, 'Learn how to animate sprites and the limitations that can be set.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at magna eu orci laoreet rutrum. Vivamus ac venenatis nulla. Morbi arcu quam, faucibus quis blandit at, interdum eget velit. Ut congue viverra cursus. In ac sapien neque. Sed pharetra facilisis nisi, ut sollicitudin metus mollis nec. Suspendisse mollis scelerisque tortor at ullamcorper. Fusce non nisi arcu, iaculis consequat est. Maecenas eget consectetur sapien. Vivamus laoreet faucibus sodales. Aenean ultricies tempor lectus vitae aliquet.<linebreak/>\r\n\r\nDuis vitae augue est. Aliquam feugiat sem id ante tristique interdum. Nam a feugiat enim. In ac nulla sem. Nunc ultricies diam volutpat mauris feugiat a eleifend nisi pretium. Fusce eu metus in felis semper sagittis eget quis orci. Phasellus neque risus, eleifend pharetra tempor nec, vestibulum ac odio. Nunc ultrices, neque ut adipiscing vestibulum, elit purus condimentum est, ut accumsan magna leo sed sapien. Donec vitae pharetra odio.<linebreak/>\r\n\r\nVestibulum quis dignissim risus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum tempus imperdiet nibh dictum sodales. Morbi quis dui erat. Sed pulvinar feugiat orci in lobortis. Aenean sit amet dui lectus, id pharetra justo. Aliquam metus ante, ullamcorper id consequat ac, blandit ac est. Pellentesque congue placerat sapien sit amet pretium. Nunc eu ultricies enim. Nam lobortis lacus id tellus posuere dictum. Praesent ut nibh erat. Donec dolor libero, lacinia in aliquam sed, feugiat nec mauris. Nunc varius porta lacus ut aliquam. <linebreak/>', 15, '2013-06-03'),
(21, 'Photoshop', 19, 'Learn how to use photoshop to edit images.', 'This unit covers how to use the program adobe photoshop to edit images.', 1, '2013-06-09'),
(22, 'Managing potential risks', 28, 'Learn how to possibly prevent minor/majors risks from occuring', 'This unit specifies the outcomes required to use a generic approach to identify hazards and assess and control OHS risks.<br>', 1, '2013-06-09'),
(23, 'Theory of design', 27, 'Learn the history of design and how to apply it to your own work', 'This unit describes the performance outcomes, skills and knowledge required to source information on design history and theory, and to apply that information to one''s area of work.', 0, '2013-06-09'),
(24, 'GIMP', 19, 'Learn how to use GIMP to edit images', 'This unit covers how to use the program GIMP to edit images.', 0, '2013-06-09'),
(25, 'Web Skills', 25, 'Learn some web typography skills', 'This unit covers most of the different web typography types that are used.', 0, '2013-06-09'),
(26, 'Colour', 25, 'Learn different colour typography skills', 'This unit covers how to add colour to your typography and different colour styles', 0, '2013-06-09'),
(27, 'AutoCAD', 26, 'Learn how to use the program AutoCAD.', 'This unit covers how to what the program AutoCAD is and how to use it.', 0, '2013-06-09'),
(28, 'Requirements and Processes', 22, 'Learn how to acquire requirements and use the information to process.', 'This unit specifies the outcomes required to manage risk within a project in order to avoid adverse effects on project outcomes. It covers determining, monitoring, and controlling project risks, and assessing risk management outcomes.&nbsp;', 0, '2013-06-09'),
(29, 'OHS System', 18, 'Learn how to maintain and establish an OHS system', 'This unit specifies how to main and establish an OHS system. ', 0, '2013-06-09'),
(30, 'Engagement', 20, 'Learn how to engage with the customer to be able to provide outstanding customer service.', 'This unit will be covering the engagement of customer service in the hospitality industry.', 0, '2013-06-09'),
(31, 'Providing Service', 30, 'This unit will be covering how to develop and update knowledge of food & beverage as well as providing service.', 'This unit will be covering how to provide food and beverage service, and knowledge of food and beverages.', 0, '2013-06-09'),
(32, 'Fire', 31, 'Learn what procedure to take if a fire starts occurring ', 'This unit ill be covering what procedures to take when a fire might break out.', 0, '2013-06-09'),
(33, 'Data Loss', 31, 'Learn what procedure to initiate when significant data loss has occurred.', 'This unit will be covering the procedures initialised when data loss has occurred.', 0, '2013-06-09'),
(34, 'Get', 1, 'Learn about the \\"Get\\" cURL command, and how the syntax is set up', 'This unit will be covering the cURL command used to retrieve a record from a database within cURL.', 0, '2013-06-09'),
(35, 'Put', 1, 'Learn about the \\"Put\\" cURL command and the syntax.', 'This unit will be covering the cURL command used to update a record from the&nbsp;database within cURL.', 0, '2013-06-09'),
(36, 'Delete', 1, 'Learn about the \\"Delete\\" cURL command', 'This unit will be covering the cURL command used to delete a record from the&nbsp;database within cURL.', 0, '2013-06-09'),
(37, 'Select Query', 2, 'Learn how to retrieve records from an database.', 'This unit will be covering how to retrieve data from a database.<br><br>To retrieve data from the database, you would use the SELECT keyword; note that sql is not case sensitive, so using select or SELECT will have the same desired effect.<br><br>The syntax used to retrieve data, would be:<br>SELECT * FROM table_name; But if you wanted to get specific columns from the database, the syntax then would be: SELECT column_name,column_name FROM table_name;<br>You can also obtain records that fulfill a specific criteria using the WHERE clause, an example of that would be:<br>SELECT * FROM table_name WHERE column_name operator value;<br><br>So for example, just say you wanted to get some customer records from mexico, the syntax would be: SELECT * FROM Customers<br>WHERE Country=\\''Mexico\\'';', 0, '2013-06-09'),
(38, 'Delete Query', 2, 'Learn what the syntax is to delete a record or table from a database.', 'This unit covers how to delete record(s) or table(s) from a database.<br><br>The syntax used used to delete a record&nbsp;is normally&nbsp;DELETE FROM&nbsp;table_name&nbsp;WHERE&nbsp;some_column=some_value; <br><br>But there may an instance where you need to delete an entire table. When that is needed then the syntax to delete entire tables is:&nbsp;DELETE FROM&nbsp;table_name;&nbsp;or&nbsp;DELETE * FROM&nbsp;table_name;', 0, '2013-06-09'),
(39, 'Logcat', 4, 'Learn what Logcat is and how it is used for debugging problems.', 'This unit explains what Logcar is used for in Eclipse, and how it can be used for debugging when problems arise', 0, '2013-06-09'),
(40, 'AJAX and Database', 12, 'Learn how Ajax can be used to display records from a database', 'This unit covers how records from a database can be displayed from using Ajax.', 0, '2013-06-09'),
(41, 'Try-Catch', 6, 'Learn what try-catch is and what it is used for.', 'This unit covers what a try-catch is and what it is used for.', 0, '2013-06-09'),
(42, 'Obligations', 29, 'Learn how to administer legal obligations of a building or construction contract', 'This unit covers all the legal obligations with building and construction contracts', 0, '2013-06-09'),
(43, '2D Forms', 36, 'Learn the necessary skills and knowledge with drawing 2D forms', 'This unit describes the performance outcomes, skills and knowledge required to explore and creatively apply the design process in creating 2 dimensional (2D) forms', 0, '2013-06-10'),
(44, '3D forms', 36, 'Learn the necessary skills and knowledge to draw 3D forms', 'This unit describes the performance outcomes, skills and knowledge required to explore and creatively apply the design process to the development to 3 dimensional (3D) forms', 0, '2013-06-10'),
(45, 'Calculating fabric quantites', 32, 'Learn how to calculate fabric quantities for coverings', 'This unit covers the competency to calculate fabric quantities for window coverings.<br>', 0, '2013-06-10'),
(46, 'Preparation', 37, 'Learn some ways to prepare a presentation to potential clients', 'This unit specifies the outcomes required to prepare a materials or sample board for client presentation, for interior decoration and design projects.', 0, '2013-06-10'),
(47, 'Client Input', 44, 'Learn how to refine a design brief based on the client''s input', 'This unit describes the performance outcomes, skills and knowledge required to work pro actively with a client or commissioning organisation to develop and negotiate a design brief', 0, '2013-06-10'),
(48, 'Concept design', 46, 'Learn how to take a concept design to a final realisation', 'This unit describes the performance outcomes, skills and knowledge required to manage the process of taking a design&nbsp;from concept to final realisation or production', 0, '2013-06-10'),
(49, 'Protecting IP', 45, 'Learn how to protect intellectual property from potential theft', 'This unit describes the performance outcomes, skills and knowledge required to manage intellectual protect and grow a business', 0, '2013-06-10'),
(50, 'Pipe Penetrations', 47, 'Learn how to perform pipe penetrations', 'This unit describes what pipe penetrations is and how to do it.', 0, '2013-06-10'),
(51, 'Water storage', 47, 'Learn about water storage', 'This unit describes about water storage and all possible ways to implement it ', 0, '2013-06-10'),
(52, 'Appliances', 48, 'Learn about the different household appliances that utilise gasfitting', 'This unit describes the purpose of installing gasfitting appliances into households', 0, '2013-06-10'),
(53, 'Central Heating', 49, 'Learn what central heating is and how to install it', 'This unit describes the performance outcomes, skills and knowledge required to install central heating', 0, '2013-06-10'),
(54, 'Statutory Interpretation rules', 53, 'Learn the rules of statutory interpretation in relation to building to building control legislation', 'This unit specifies the competency required to advise on building control activities in a court of law and present evidence in accordance with rules of evidence for civil and criminal trials.  It includes the identification and application of the rules of statutory interpretation as they relate to building control legislation.<br>', 0, '2013-06-10'),
(55, 'BCA', 54, 'Learn about what the BCA is and what the standards are.', 'This unit specifies the competency required to ensure the building process complies with the Building Code of Australia (BCA) and relevant Australian Standards.<br><span><br>This unit applies specifically to buildings up to three storeys and not exceeding a maximum floor area of 200m2.  It includes the evaluation and interpretation of building requirements, classification of buildings according to the Building Code of Australia criteria and identification of various strategies for compliance.</span>', 0, '2013-06-10'),
(56, 'Documentation', 62, 'Learn how to prepare documentation that will need filling out', 'This unit describes the functions involved in preparation and processing of routine financial documents, preparing journal entries, posting journals to ledgers, preparing, banking and reconciling financial receipts, and extracting a trial balance and interim reports.<br><br>This unit may apply to job roles subject to licensing, legislative, regulatory or certification requirements so the varying Commonwealth, State or Territory requirements should be confirmed with the relevant body.', 0, '2013-06-10'),
(57, 'Set up Computerised Accounting system', 63, 'Learn how to set up a computerised accounting system.', 'This unit covers the processes needed to set up a computerised account system', 0, '2013-06-10'),
(58, 'Operating computerised account systems', 63, 'Learn how to operate a computerised accounting system', 'This unit covers the processes needed for operating a computerised accounting system', 0, '2013-06-10'),
(59, 'Work relationships', 65, 'Learn how to establish work relationships and networks', 'This unit describes the performance outcomes, skills and knowledge required to develop and maintain effective work relationships and networks. <br><br>It covers the relationship building and negotiation skills required by workers within an organisation as well as freelance or contract workers.', 0, '2013-06-10'),
(60, 'Business Documents', 66, 'Learn how to design and develop business documents', 'This unit describes the performance outcomes, skills and knowledge required to design and develop business documents using complex technical features of word processing software.', 0, '2013-06-10'),
(61, 'Spreadsheets', 67, 'Learn how to create business spreadsheets', 'This unit describes the performance outcomes, skills and knowledge required to use spreadsheet software to complete business tasks and to produce complex documents.', 0, '2013-06-10'),
(62, 'Work relationships', 71, 'Learn how to establish work relationships and networks', 'This unit describes the performance outcomes, skills and knowledge required to develop and maintain effective work relationships and networks. It covers the relationship building and negotiation skills required by workers within an organisation as well as freelance or contract workers.', 0, '2013-06-10'),
(63, 'Management', 70, 'Learn how to manage the marketing process', 'This unit describes the performance outcomes, skills and knowledge required to strategically manage the marketing process and marketing personnel within an organisation.', 0, '2013-06-10'),
(64, 'Organisational Products', 69, 'Learn how to coordinate an organisation''s products', 'This unit describes the performance outcomes, skills and knowledge required to coordinate and review the promotion of an organisation''s products and services.', 0, '2013-06-10'),
(65, 'Work processes', 74, 'Learn about the workplace processes within an organisation', 'This unit describes the performance outcomes, skills and knowledge required to gather, organise and apply workplace information in the context of an organisation''s work processes.', 0, '2013-06-10'),
(66, 'Knowledge Management systems', 74, 'Learn about how management systems operate and how to use them', 'This unit describes the performance outcomes, skills and knowledge required to gather, organise and apply workplace information in the context of an organisation''s knowledge management systems.', 0, '2013-06-10'),
(67, 'Variation of tasks', 72, 'Learn about how to prepare a variety of tasks to be completed.', 'This unit describes the performance outcomes, skills and knowledge required to determine, administer and maintain resources and equipment to complete a variety of tasks.', 0, '2013-06-10'),
(68, 'Creating financial records', 73, 'Learn how to create financial records', 'This unit covers the performance outcomes, skills and knowledge required in creating financial records.', 0, '2013-06-10'),
(69, 'Monitoring client''s needs', 78, 'Learn how to monitor to the client''s needs', 'This unit describes the knowledge and skills required to identify, develop, implement, monitor and review programs to meet the needs of clients', 0, '2013-06-10'),
(70, 'Planning', 80, 'Learn how to plan what''s included in a case management document', 'This unit describes the knowledge and skills required to facilitate all aspects of case planning', 0, '2013-06-10'),
(71, 'Medical Assistance', 85, 'Learn how to provide some medical assistance when an injury has occurred ', 'This unit of competency describes the skills and knowledge required to provide first aid response, life support, management of casualty(s), the incident and other first aiders, until the arrival of medical or other assistance.', 0, '2013-06-10'),
(72, 'Java', 88, 'Learn how to do object oriented programming using Java', 'This unit covers the skills and knowledge required to perform object oriented programming with Java', 0, '2013-06-10'),
(73, 'C++', 88, 'Learn how to perform object oriented programming with C++', 'This unit covers the basic understand for object oriented programming using C++', 0, '2013-06-10'),
(74, 'Copyright', 91, 'Learn about copyright', 'This unit covers the basic principles of copyright and to avoid copyright infringement', 0, '2013-06-10'),
(75, 'Ethics', 91, 'Learn about ethics', 'This unit covers the principles of ethics', 0, '2013-06-10'),
(76, 'Privacy', 91, 'Learn about privacy', 'This unit covers the principles of privacy', 0, '2013-06-10'),
(77, 'Loose And Fitted Covers', 101, 'Learn how to fabricate and install loose and fitted covers', 'This unit covers how to fabricate and install loose and fitted covers ', 0, '2013-06-10'),
(78, 'Marine Covers', 101, 'Learn how to fabricate and install marine covers', 'This unit covers how to fabricate and install marine covers', 0, '2013-06-10'),
(79, 'Canvas Products', 101, 'Learn how to fabricate and install canvas products', 'This unit covers how to fabricate and install canvas products', 0, '2013-06-10'),
(80, 'Hammers', 21, 'Learn what you would use hammers for', 'This unit covers the usage of hammers', 0, '2013-06-10'),
(81, 'Saws', 21, 'Learn about the different types of saws that can be used', 'This unit covers the different selection of saws that are used when building and constructing.', 0, '2013-06-10'),
(82, 'Legal', 23, 'Learn about legal management', 'This unit covers specifies the skills and knowledge required for legal management', 0, '2013-06-10'),
(83, 'Risk', 23, 'Learn about risk management', 'This unit covers the skills and knowledge for risk management', 0, '2013-06-10'),
(84, 'Low rise projects', 24, 'Learn about the business codes and standards for low rise projects', 'This unit covers the business codes and standards that are applied to the construction for low rise projects', 0, '2013-06-10'),
(85, 'Mock Ups', 33, 'Learn about the use of mock ups', 'This unit covers how to create fashion mock ups for potential clients', 0, '2013-06-11'),
(86, 'Work Environment', 34, 'Learn about sustainable working environments', 'This unit covers the skills obtained for a sustainable working environment', 0, '2013-06-11'),
(87, 'Identifying standards', 35, 'Learn how to identify quality standards', 'This unit covers the skills, and knowledge to identifying and applying quality standards', 0, '2013-06-11'),
(88, 'Infringment', 38, 'Learn about copyright infringement', 'This unit covers all the possible attempts at copyright infringement that can occur', 0, '2013-06-11'),
(89, 'Teamwork', 39, 'Learn how to use team work', 'This unit covers how to use team work within an organisation', 0, '2013-06-11'),
(90, 'Designing documents', 40, 'Learn how to design business documents', 'This unit covers the skills to design business documents', 0, '2013-06-11'),
(91, 'Producing documents', 40, 'Learn how to produce business documents', 'This unit covers how the skills used for producing business documents', 0, '2013-06-11'),
(92, 'Questions', 43, 'Learn about creating questions relevant to interviewee', 'This unit covers how to create interview questions relevant to the person being interviewed', 0, '2013-06-11'),
(93, 'Ideas', 41, 'Learn how to brainstorm for programs or segments', 'This unit covers how to think of ideas for programs and segments', 0, '2013-06-11'),
(94, 'Finding Issue', 42, 'Learn how to locate a possible issue to explore on air', 'This unit covers the concept of finding an issue to report about.', 0, '2013-06-11'),
(95, 'Bullying', 42, 'Learn how to discuss bullying on air', 'This unit covers the topic of bullying and how to discuss it on programs or segments', 0, '2013-06-11'),
(96, 'Materials', 50, 'Learn what materials are to be used for reinforcement', 'This unit covers hat materials would be needed for reinforcement', 0, '2013-06-11'),
(97, 'Isolated piers', 51, 'Learn about isolated piers', 'This unit specifies the performance skills, outcomes and knowledge required to build isolated piers', 0, '2013-06-11'),
(98, 'Destruction', 52, 'Learn about demolition and how to destroy buildings', 'This unit covers the basic aspects of demolition and destruction', 0, '2013-06-11'),
(99, 'Site surveying', 55, 'Learn how to site survey', 'This unit covers the skills and knowledge needed for site surveying', 0, '2013-06-11'),
(100, 'Site Analysis', 55, 'Learn how to perform site analysis', 'This unit covers the aspects used for site analysis', 0, '2013-06-11'),
(101, 'Industry Standards', 57, 'Learn about the designing standards with the industry standards', 'This unit covers the industry standards used when designing.', 0, '2013-06-11'),
(102, 'ECG heterogeneity', 58, 'Learn what an ECG heterogeneity is and how it is used', 'This unit covers what an&nbsp;ECG heterogeneity is and how &nbsp;it is performed.', 0, '2013-06-11'),
(103, 'Recorder', 59, 'Learn how to use a recorder for an ECG', 'This unit covers how a records for an ECG is used for a patient', 0, '2013-06-11'),
(104, 'Analysing Software', 59, 'Learn how the analysis software is used to determine heart beats, rhythms etc. ', 'This unit covers how the analysis software is used to determine the heart beats, rhythms over a 24 - 48 hour period.', 0, '2013-06-11'),
(105, 'Obtain sample', 60, 'Learn how to obtain sample(s) from patients', 'This unit explains the steps taken to obtain a sample from a patient.', 0, '2013-06-11'),
(106, 'Achitectures', 56, 'Learn about administering achiectures', 'This unit covers how to manage architectures', 0, '2013-06-11'),
(107, 'Data', 61, 'Learn about obtaining the data needed to start preparing financial reports.', 'This unit covers the data that will be needed when preparing financial reports.', 0, '2013-06-11'),
(108, 'Reports', 64, 'Learn how to produce specified reports', 'This unit covers the skills and knowledge needed for when preparing reports.', 0, '2013-06-11'),
(109, 'Decisions', 68, 'Learn about how to decide when to implement superannuation', 'This unit covers the notion of deciding when to implement superannuation and how much percent each person receives.', 0, '2013-06-11'),
(110, 'Legislations', 76, 'Learn about the legislations acquired throughout the workplace', 'This unit explains the legislation for work practices.', 0, '2013-06-11'),
(111, 'Band-aid', 75, 'Learn about which injuries are in need of a band-aid.', 'This unit covers first-aid and which injuries would require the use of band-aids.', 0, '2013-06-11'),
(112, 'Anti-septic cream', 75, 'Learn about which injuries require the use of anti-septic cream', 'This unit covers the injuries that require the use anti-septic cream.', 0, '2013-06-11'),
(113, 'Children''s rights', 77, 'Learn about the children''s rights.', 'This unit covers the need for children''s rights.', 0, '2013-06-11'),
(114, 'Interviews', 81, 'Learn about interviews.', 'This unit covers the concept of interviews.', 0, '2013-06-11'),
(115, 'Litigation', 79, 'Learn to litigate legal proceedings.', 'This unit covers legal litigation.', 0, '2013-06-11'),
(116, 'Requirements', 82, 'Learn about the requirements needed for a legal and ethical framework.', 'This unit describes the knowledge and skills required to work within a legal and ethical framework that supports duty of care requirements.', 0, '2013-06-11'),
(117, 'Design care routines', 83, 'Learn ho to design care routines for children.', 'This unit covers the skills required to design care routines for children.', 0, '2013-06-11'),
(118, 'Implement care routine', 83, 'Learn how to implement a care routine.', 'This unit covers the skills and knowledge required to implement a care routine for children.', 0, '2013-06-11'),
(119, 'Monitoring', 84, 'Learn how to monitor children''s behaviour.', 'This unit covers the skills required for monitoring children''s behaviour.', 0, '2013-06-11'),
(120, 'Senses', 86, 'Learn about how to develop a children''s senses.', 'This unit covers the basis for developing children''s senses.', 0, '2013-06-11'),
(121, 'Respect', 87, 'Learn about respect.', 'This unit covers respect; whether it''s respecting someone else or yourself.', 0, '2013-06-11'),
(122, 'Levels', 89, 'Learn about the gaming principle of level design', 'This unit covers the performance skills, outcomes and knowledge required for level design.', 0, '2013-06-11'),
(123, 'Sound', 89, 'Learn about the importance of sound in a game.', 'This unit covers the performance outcomes, skills, and knowledge required for sound insertion into games.', 0, '2013-06-11'),
(124, 'Aesthetic', 90, 'Learn how to create an aesthetically pleasing Graphical User Interface.', 'This unit covers the performance outcomes, skills, and knowledge required to create an aesthetically pleasing Graphical User Interface for the gamer.', 0, '2013-06-11'),
(125, 'Level Editors', 92, 'Learn about level editors within games.', 'This unit covers the skills and knowledge of how to use level editors to create a game.', 0, '2013-06-11'),
(126, 'Macromedia Flash', 93, 'Learn about macromedia flash and how to create animations with it.', 'This unit covers the skills and knowledge required to use Macromedia Flash to create 2D and 3D animations.', 0, '2013-06-11'),
(127, 'Sponsors', 103, 'Learn about what sponsors do for events.', 'This unit covers how sponsors are used for events.', 0, '2013-06-11'),
(128, 'Budget', 105, 'Learn about how to allocate a budget for an event.', 'This unit covers the need for allocating budgets.', 0, '2013-06-11'),
(129, 'Exhibitions', 104, 'Learn about different event types.', 'This unit covers the different form of exhibitions that are displayed.', 0, '2013-06-11'),
(130, 'Agricultural', 104, 'Learn about agricultural events.', 'This unit covers the different agricultural exhibitions that are displayed.', 0, '2013-06-11'),
(131, 'Airbags', 102, 'Learn about different supplemental restraint systems.', 'This unit covers the installation and need for airbags.', 0, '2013-06-11'),
(132, 'Advice', 100, 'Learn how to provide general advice to customers.', 'This unit covers the notion of providing advice to customers relating to a query.', 0, '2013-06-11'),
(133, 'Businessmen', 97, 'Learn about different variety of stakeholders.', 'This unit covers one variety of stakeholders... Businessmen.', 0, '2013-06-11'),
(134, 'Promotions', 98, 'Learn how to pitch a promotional idea.', 'This unit covers how to implement a promotional item for a business.', 0, '2013-06-11'),
(135, 'Rehabilitation', 99, 'Learn how to provide rehab.', 'This unit covers the process of rehabilitation.', 0, '2013-06-11'),
(136, 'Fitness Test', 94, 'Learn about a variety of fitness tests.', 'This unit covers the different fitness tests.', 0, '2013-06-11'),
(137, 'Personal Training', 96, 'Learn about personal training.', 'This unit covers the basis of personal training.', 0, '2013-06-11'),
(138, 'Individual Differences', 95, 'Learn about the principle of individual differences', ' ', 0, '2013-06-11'),
(139, 'Overload', 95, 'Learn about the principle of overload.', 'This unit covers aspects of the principle of overload.', 0, '2013-06-11'),
(140, 'Progression', 95, 'Learn about the principle of progression.', 'This unit covers the aspects of the principle of progression.', 0, '2013-06-11'),
(141, 'Adaption', 95, 'Learn about the principle of adaptation.', 'This unit covers the aspects of the principle of adaptation.', 0, '2013-06-11'),
(142, 'Use/Disuse', 95, 'Learn about the principle of use/disuse.', 'This unit covers the aspects of the principle of use/disuse.', 0, '2013-06-11'),
(143, 'Specificity', 95, 'Learn about the principle of specificity.', 'This unit covers the aspects of the principle of specificity.', 0, '2013-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `TokenID` int(11) NOT NULL AUTO_INCREMENT,
  `TokenCode` varchar(20) NOT NULL,
  `TokenDate` date NOT NULL,
  PRIMARY KEY (`TokenID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`TokenID`, `TokenCode`, `TokenDate`) VALUES
(1, '10001', '2013-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
  `TopicID` int(5) NOT NULL AUTO_INCREMENT,
  `TopicName` text NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `SubjectCode` varchar(50) NOT NULL,
  `deletionStatus` tinyint(1) NOT NULL COMMENT '0 = display, 1 = not display',
  `dateupdated` date NOT NULL,
  PRIMARY KEY (`TopicID`),
  KEY `FK_topicsub` (`SubjectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=107 ;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`TopicID`, `TopicName`, `SubjectID`, `SubjectCode`, `deletionStatus`, `dateupdated`) VALUES
(1, 'cURL Commands', 1, 'ICT33A', 0, '2013-06-11'),
(2, 'SQL Query', 1, 'ICA50711', 0, '2013-05-17'),
(3, 'Restful Web Service', 3, 'ICT33A', 0, '2013-06-12'),
(4, 'Eclipse', 1, 'ICT33A', 0, '2013-06-09'),
(5, 'SLIM Framework', 3, 'ICT33A', 0, '2013-05-28'),
(6, 'Java', 1, 'ICT31A', 0, '2013-05-13'),
(7, 'Eclipse', 1, 'ICA50711', 0, '2013-06-11'),
(8, 'Architecture in Housing', 6, 'CPC50210', 0, '2013-05-05'),
(9, 'PHP', 3, 'ICA50712', 0, '2013-05-16'),
(10, 'HTML5', 2, 'ICT33A', 0, '2013-05-17'),
(11, 'jQuery Mobile', 2, 'ICA40511', 0, '2013-05-17'),
(12, 'Ajax', 2, 'ICA40511', 0, '2013-05-12'),
(13, 'Visual Basic', 3, 'ICA50712', 0, '2013-05-17'),
(14, 'Web Programming', 3, 'ICA50712', 0, '2013-06-12'),
(15, 'SQL Databases', 2, 'ICA40511', 0, '2013-05-17'),
(16, 'Games Programming', 2, 'ICA40511', 1, '2013-06-04'),
(17, 'Games 2', 2, 'ICA40511', 1, '2013-06-04'),
(18, 'OH&S', 7, 'SIT40307', 0, '2013-05-17'),
(19, 'Photo Imaging', 5, 'ICA40511', 0, '2013-05-17'),
(20, 'Customer Service', 7, 'SIT40307', 0, '2013-05-20'),
(21, 'Materials', 4, 'CPC40110', 0, '2013-05-31'),
(22, 'Project Quality', 6, 'CPC50210', 0, '2013-06-09'),
(23, 'Management', 4, 'CPC40110', 0, '2013-05-31'),
(24, 'Business codes &amp; standards', 4, 'CPC40110', 0, '2013-06-10'),
(25, 'Typography Techniques', 5, 'CUV40303', 0, '2013-05-31'),
(26, 'Technical Drawings', 5, 'CUV40303', 0, '2013-06-03'),
(27, 'History of Design', 5, 'CUV40303', 0, '2013-06-09'),
(28, 'OHS Project Risk', 6, 'CPC50210', 0, '2013-06-03'),
(29, 'Administer Contract', 6, 'CPC50210', 0, '2013-05-31'),
(30, 'Food & Beverage', 7, 'SIT40307', 0, '2013-06-03'),
(31, 'Health, Safety, and Security Procedures', 7, 'SIT40307', 0, '2013-06-03'),
(32, 'Window coverings', 8, 'CLMF40408', 0, '2013-06-07'),
(33, 'Fashion design processes', 9, 'LLMT21707', 0, '2013-06-07'),
(34, 'Sustainable work practices', 9, 'LLMT21707', 0, '2013-06-07'),
(35, 'Apply quality standards', 9, 'LLMT21707', 0, '2013-06-07'),
(36, 'Creative design process to forms', 8, 'CLMF40408', 0, '2013-06-09'),
(37, 'Client presentations', 8, 'CLMF40408', 0, '2013-06-07'),
(38, 'Use and respect of copyright', 10, '22203VIC', 0, '2013-06-07'),
(39, 'Working effectively in the creative arts industry', 10, '22203VIC', 0, '2013-06-07'),
(40, 'Design and produce business documents', 10, '22203VIC', 0, '2013-06-07'),
(41, 'Produce programs &amp; segments', 11, 'CUF50107', 0, '2013-06-10'),
(42, 'Explore Issue On Air', 11, 'CUF50107', 0, '2013-06-05'),
(43, 'Conduct Interviews', 11, 'CUF50107', 0, '2013-06-07'),
(44, 'Design Briefs', 12, 'CUV60411', 0, '2013-06-07'),
(45, 'Intellectual Property', 12, 'CUV60411', 0, '2013-06-07'),
(46, 'Design realisation', 12, 'CUV60411', 0, '2013-06-07'),
(47, 'Roofing', 13, 'CPC32408', 0, '2013-06-06'),
(48, 'Gasfitting', 13, 'CPC32408', 0, '2013-06-07'),
(49, 'Mechanical Services', 13, 'CPC32408', 0, '2013-06-07'),
(50, 'Place and fix reinforcement materials', 14, 'CPC30108', 0, '2013-06-07'),
(51, 'Masonry structural systems', 14, 'CPC30108', 0, '2013-06-07'),
(52, 'Demolition', 14, 'CPC30108', 0, '2013-06-07'),
(53, 'Apply legal procedures to building surveying', 15, 'BCG60103', 0, '2013-06-07'),
(54, '3 storey building risk management principles', 15, 'BCG60103', 0, '2013-06-07'),
(55, 'Undertake site survey and analysis to inform design process', 16, '21953VIC', 0, '2013-06-07'),
(56, 'Manage architectural project administration', 16, '21953VIC', 0, '2013-06-06'),
(57, 'Comply with codes and standards in the design of commercial buildings', 16, '21953VIC', 0, '2013-06-07'),
(58, 'Electrocardiography', 17, 'HLT41812', 0, '2013-06-07'),
(59, 'Perform Holter Monitoring', 17, 'HLT41812', 0, '2013-06-07'),
(60, 'Pathology procedures', 17, 'HLT41812', 0, '2013-06-07'),
(61, 'Preparing financial reports', 18, 'FNS40611', 0, '2013-06-05'),
(62, 'Financial transactions and interim reports', 18, 'FNS40611', 0, '2013-06-07'),
(63, 'Computerised Accounting Systems', 18, 'FNS40611', 0, '2013-06-06'),
(64, 'Produce desktop published documents', 19, 'BSB50407', 0, '2013-05-30'),
(65, 'Establish networks', 19, 'BSB50407', 0, '2013-06-07'),
(66, 'Design and develop complex text documents', 19, 'BSB50407', 0, '2013-05-23'),
(67, 'Creating complex test documents', 20, 'FNS50611', 0, '2013-06-07'),
(68, 'Implementing Superannuation', 20, 'FNS50611', 0, '2013-06-07'),
(69, 'Promote products &amp; services', 21, 'BSB60507', 0, '2013-06-10'),
(70, 'Marketing Process', 21, 'BSB60507', 0, '2013-06-10'),
(71, 'Networking', 21, 'BSB60507', 0, '2013-06-06'),
(72, 'Business Resources', 22, 'HLT50512', 0, '2013-06-07'),
(73, 'Financial Records', 22, 'HLT50512', 0, '2013-06-04'),
(74, 'Workplace Information', 22, 'HLT50512', 0, '2013-06-10'),
(75, 'Advanced First Aid', 23, 'CHC51408', 0, '2013-04-03'),
(76, 'Work practices', 23, 'CHC51408', 0, '2013-04-09'),
(77, 'Rights & Safety', 23, 'CHC51408', 0, '2013-06-27'),
(78, 'Clients needs', 23, 'CHC51408', 0, '2013-06-04'),
(79, 'Crime prevention strategies', 24, '22200VIC', 0, '2013-06-06'),
(80, 'Case Management', 24, '22200VIC', 0, '2013-06-04'),
(81, 'Investigative processes', 24, '22200VIC', 0, '2013-06-04'),
(82, 'Legal and ethical framework', 25, 'CHC41712', 0, '2013-06-11'),
(83, 'Care routines', 25, 'CHC41712', 0, '2013-06-11'),
(84, 'Children behaviour', 25, 'CHC41712', 0, '2013-05-29'),
(85, 'First aid', 26, 'CHC50908', 0, '2013-06-03'),
(86, 'Children''s developmental needs', 26, 'CHC50908', 0, '2013-05-31'),
(87, 'Professional practice', 26, 'CHC50908', 0, '2013-06-01'),
(88, 'Object oriented language skills', 27, 'ICA40911', 0, '2013-05-21'),
(89, 'Game design & game playing principles', 27, 'ICA40911', 0, '2013-06-03'),
(90, 'Graphical User Interface', 27, 'ICA40911', 0, '2013-06-03'),
(91, 'Copyright, ethics & privacy', 28, 'ICA40811', 0, '2013-06-05'),
(92, 'Online learning tools', 28, 'ICA40811', 0, '2013-06-05'),
(93, '2D & 3D animation', 28, 'ICA40811', 0, '2013-06-06'),
(94, 'Client health assessment', 29, 'SIS40210', 0, '2013-04-02'),
(95, 'Exercise science principles', 29, 'SIS40210', 0, '2013-03-28'),
(96, 'Fitness orientation and screening', 29, 'SIS40210', 0, '2013-01-31'),
(97, 'Stakeholders', 30, 'SIS40210', 0, '2013-05-14'),
(98, 'Marketing opportunities', 30, 'SIS40210', 0, '2013-03-18'),
(99, 'Officials fitness and recovery programs', 30, 'SIS40210', 0, '2013-05-07'),
(100, 'Customer relations', 31, 'AUR30805', 0, '2013-06-07'),
(101, 'Fabricate and Installation', 31, 'AUR30805', 0, '2013-03-26'),
(102, 'Supplementary Restraint Systems', 31, 'AUR30805', 0, '2013-06-02'),
(103, 'On-site management services', 32, 'SIT50207', 0, '2013-04-16'),
(104, 'Event concepts', 32, 'SIT50207', 0, '2013-05-19'),
(105, 'Finance management', 32, 'SIT50207', 0, '2013-06-03'),
(106, 'Objective C', 2, 'ICT32A', 0, '2013-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `truefalse`
--

CREATE TABLE IF NOT EXISTS `truefalse` (
  `TrueFalseID` int(11) NOT NULL AUTO_INCREMENT,
  `Question` text NOT NULL,
  `correctAns` varchar(10) NOT NULL,
  `TestID` int(11) NOT NULL,
  PRIMARY KEY (`TrueFalseID`),
  KEY `FK_truefalse` (`TestID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `truefalse`
--

INSERT INTO `truefalse` (`TrueFalseID`, `Question`, `correctAns`, `TestID`) VALUES
(1, 'SQL Stands for Structed Question Language?', 'false', 2),
(2, 'PHP is server side programming?', 'true', 2),
(3, 'Ajax stands for Asynchronous Javascript and XML?', 'true', 4),
(4, 'SQLyog can be used to establish referential integrity between tables?', 'true', 18),
(5, 'Photoshop is the only software application used to edit images?', 'false', 21),
(6, 'HTTP Post requests allow a request body to be uploaded', 'true', 13),
(7, 'HTTP Post requests are more secure in a web-application than Get Requests', 'true', 13),
(8, 'A get Request is the default type of web-request', 'true', 34),
(9, 'A PUT Request is more complex than a POST Request', 'false', 35),
(10, 'A DELETE Request will delete data from a database automatically', 'false', 36),
(11, 'A DELETE Request doesnt allow a request body to be uploaded', 'false', 36),
(12, 'An INSERT QUERY adds new data to a table', 'true', 1),
(13, 'An INSERT QUERY returns a list of columns and rows affected by the query', 'false', 1),
(14, 'AN UPDATE Query requires values to be specified', 'true', 3),
(15, 'An UPDATE Query does not require columns to be specified', 'false', 3),
(16, 'SELECT Queries are required to READ data', 'true', 37),
(17, 'SELECT Queries allow attributes to be specified and renamed', 'true', 37),
(18, 'Deleted data from a database can be easily recovered', 'false', 38),
(19, 'A mobile app that uses Ajax calls is written in JQuery Mobile', 'true', 2),
(20, 'Ajax always returns XML data', 'false', 2),
(21, 'The AVD allows Android Operating Systems to be booted up', 'true', 4),
(22, 'The Android Virtual Manager allows the SDK parts to be downloaded', 'true', 4),
(23, 'Logcat displays errors in red', 'true', 39),
(24, 'Logcat displays warnings in green', 'false', 39),
(25, 'Slim must be installed on a remote server for a mobile app to work', 'false', 6),
(26, 'Slim contains a lot of large and bulky files and requires several hours to install', 'false', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `fName` varchar(50) NOT NULL,
  `lName` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(1) NOT NULL COMMENT '1 = Admin, 2 = Coordinator, 3 = Teacher, 4 = Student',
  `locked` tinyint(1) NOT NULL COMMENT '0 = unlocked, 1 = locked',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `fName`, `lName`, `username`, `password`, `role`, `locked`) VALUES
(1, 'Kris', 'Vega', 'veg09287209', 'fbc2db3589db1c940aab88d247aace72', 1, 0),
(2, 'Alan', 'Schenk', 'sch01548357', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(3, 'Bill', 'Kaz', 'billk09540103', 'fbc2db3589db1c940aab88d247aace72', 3, 0),
(4, 'James', 'Smith', 'smit09468153', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(5, 'Mark', 'Jones', 'jon08134976', 'fbc2db3589db1c940aab88d247aace72', 3, 0),
(6, 'Adam', 'Francis', 'ada08136487', 'fbc2db3589db1c940aab88d247aace72', 3, 0),
(7, 'Glen', 'Holmes', 'hol12345678', 'fbc2db3589db1c940aab88d247aace72', 1, 0),
(8, 'Liam', 'Thompson', 'tom12345678', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(9, 'Jay', 'Chou', 'cho12345678', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(10, 'Stuart', 'Little', 'lit12345678', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(11, 'Johnny', 'Bravo', 'jho08245861', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(12, 'Nathan', 'Jones', 'naj07351844', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(13, 'Mary', 'Samson', 'mas09461587', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(14, 'Oliver ', 'Harrington', 'olo09785426', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(15, 'Timothy', 'Conway', 'tim08463521', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(16, 'Eric', 'Lon', 'eri07621488', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(17, 'Madeline', 'Gabriel', 'gab09765488', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(18, 'April', 'Jones', 'apr07154776', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(19, 'Kaleigh', 'Samson', 'sam07354865', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(20, 'Bartholomew', 'Ashton', 'ash08397155', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(21, 'Kaylee', 'Martha', 'kay10543158', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(22, 'Dean', 'Farne', 'far11033486', 'fbc2db3589db1c940aab88d247aace72', 3, 0),
(23, 'Francis', 'Richards', 'ric12475683', 'fbc2db3589db1c940aab88d247aace72', 1, 0),
(24, 'Sinclair', 'Terrance', 'ter09213843', 'fbc2db3589db1c940aab88d247aace72', 1, 0),
(25, 'Valerie', 'Rona', 'ron07315486', 'fbc2db3589db1c940aab88d247aace72', 1, 0),
(26, 'Marisa', 'Darell', 'dar10246759', 'fbc2db3589db1c940aab88d247aace72', 3, 0),
(27, 'Meryl', 'Constantine', 'con08123756', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(28, 'Alexia', 'Gareth', 'gar11487235', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(29, 'Kaylyn', 'Laurie', 'lau11547956', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(30, 'Ralph', 'Frank', 'fra12798687', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(31, 'Britney', 'Rose', 'ros11976534', 'fbc2db3589db1c940aab88d247aace72', 3, 0),
(32, 'Derek', 'Loreen', 'lor09145698', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(33, 'Zachary', 'Phillips', 'phi07351486', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(34, 'Kylie', 'Adams', 'kyl09456183', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(35, 'Kristen', 'Johnson', 'joh07159462', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(36, 'Renee', 'Lee', 'rel09398287', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(37, 'Hayden', 'Rylie', 'ryl12054932', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(38, 'Rikki', 'Hanson', 'han11548321', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(39, 'Louie', 'Godfrey', 'god11789354', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(40, 'Darcy', 'O''Reilly', 'ord09245365', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(41, 'Adrian', 'Adonis', 'ado06755132', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(42, 'Jennifer ', 'Mason', 'mas13486587', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(43, 'Lacey', 'Johnstone', 'lac11846210', 'fbc2db3589db1c940aab88d247aace72', 3, 0),
(44, 'Christie', 'Page', 'pag047852361', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(45, 'Cecilia', 'Shaw', 'sha13078549', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(46, 'Raquel', 'Diaz', 'dia11753248', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(47, 'Jade', 'Allison', 'all01763542', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(48, 'Miguel', 'Sanchez', 'san01953244', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(49, 'Phoebe', 'Clements', 'cle01758362', 'fbc2db3589db1c940aab88d247aace72', 3, 0),
(50, 'Samuel', 'Sosa', 'sos01753248', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(51, 'Sophia', 'Tyrrell', 'tyr11753421', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(52, 'Jennifer', 'Wyatt', 'wya12720451', 'fbc2db3589db1c940aab88d247aace72', 3, 0),
(53, 'Penny', 'Joyce', 'joy11759420', 'fbc2db3589db1c940aab88d247aace72', 3, 0),
(54, 'Lilian', 'Meade', 'mea01456258', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(55, 'Ben', 'Janis', 'jan01357426', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(56, 'Marcus', 'Garcia', 'gam01369257', 'fbc2db3589db1c940aab88d247aace72', 2, 0),
(57, 'Aaron', 'Dyson', 'dys11723450', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(58, 'Mary', 'Summer', 'sum12622487', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(59, 'Jessie', 'Henry', 'hen03574126', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(60, 'Gerald', 'Chapman', 'cha11438267', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(61, 'Alerta', 'Richards', 'ale00432687', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(62, 'Neil', 'Beck', 'bec99135620', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(63, 'Gabriella', 'Thornberry', 'tho97153246', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(64, 'Shane', 'Walker', 'wal05321761', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(65, 'Travis', 'Gibson', 'gib01426358', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(66, 'Judy', 'Ronaldo', 'jud12873245', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(67, 'Felicia', 'Peterson', 'pet12835790', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(68, 'Hayley', 'Richardson', 'hay13704652', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(69, 'Tom', 'Leighton', 'lei00537612', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(70, 'Harry', 'Newman', 'new12673481', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(71, 'Lou', 'Emerson', 'lou13025764', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(72, 'Jake', 'Meredith', 'mer12860435', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(73, 'Rebecca', 'Oakley', 'oak02458735', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(74, 'Alex', 'Cross', 'cro13480657', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(75, 'Lindsay', 'Cole', 'col12480635', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(76, 'Diana', 'Simpson', 'sim09462587', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(77, 'Tony', 'Norwood', 'nor01468520', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(78, 'Michael', 'Payne', 'pay01487253', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(79, 'Vickie', 'Lyons', 'lyo05713286', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(80, 'Nathan', 'Perkins', 'per02731946', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(81, 'Stacy', 'Wilson', 'wil01524863', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(82, 'Hugo', 'Bradley', 'bra03482516', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(83, 'Charles', 'Anderson', 'and03482571', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(84, 'Travis', 'Weaver', 'wea03486153', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(85, 'Amanda', 'Dickens', 'dic03146752', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(86, 'Ashton', 'Kersey', 'ker06248510', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(87, 'Issac', 'Reynolds', 'rey03475698', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(88, 'Maureen', 'Barrett', 'bar03647952', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(89, 'Jacki', 'Morrison', 'mor06135748', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(90, 'Helena', 'Walker', 'wal09134287', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(91, 'Cathy', 'Bell', 'bel08294367', 'fbc2db3589db1c940aab88d247aace72', 4, 0),
(92, 'Jared', 'Clarkson', 'cla05248761', 'fbc2db3589db1c940aab88d247aace72', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usersubject`
--

CREATE TABLE IF NOT EXISTS `usersubject` (
  `userID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  KEY `FK_usersubject` (`userID`),
  KEY `FK_subjectuser` (`SubjectID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usersubject`
--

INSERT INTO `usersubject` (`userID`, `SubjectID`) VALUES
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(10, 1),
(10, 3),
(10, 5),
(10, 2),
(10, 7),
(15, 7),
(15, 1),
(15, 2),
(15, 10),
(15, 9),
(15, 3),
(16, 1),
(16, 2),
(16, 32),
(16, 31),
(16, 30),
(16, 29),
(17, 30),
(17, 31),
(17, 32),
(17, 29),
(17, 20),
(19, 1),
(19, 3),
(19, 6),
(19, 12),
(19, 17),
(19, 19),
(29, 1),
(29, 29),
(29, 30),
(29, 15),
(29, 14),
(29, 13),
(44, 24),
(44, 22),
(45, 3),
(45, 11),
(45, 17),
(45, 18),
(45, 19),
(45, 20),
(46, 32),
(46, 1),
(46, 19),
(46, 10),
(46, 18),
(57, 31),
(57, 1),
(57, 2),
(57, 13),
(57, 12),
(57, 11),
(58, 11),
(58, 12),
(58, 13),
(58, 14),
(59, 15),
(59, 16),
(59, 17),
(59, 18),
(59, 29),
(60, 19),
(60, 20),
(60, 21),
(60, 22),
(60, 23),
(61, 1),
(61, 24),
(61, 25),
(61, 26),
(62, 26),
(62, 27),
(62, 28),
(62, 29),
(62, 3),
(63, 1),
(63, 2),
(63, 3),
(63, 4),
(63, 5),
(63, 6),
(64, 6),
(64, 7),
(64, 8),
(64, 9),
(64, 10),
(64, 11),
(64, 12),
(65, 13),
(65, 12),
(65, 14),
(65, 15),
(65, 16),
(66, 17),
(66, 18),
(66, 19),
(66, 20),
(66, 21),
(67, 21),
(67, 22),
(67, 23),
(67, 24),
(67, 25),
(67, 26),
(68, 26),
(68, 27),
(68, 28),
(68, 29),
(68, 30),
(69, 1),
(69, 2),
(69, 31),
(69, 32),
(69, 3),
(69, 11),
(70, 1),
(70, 2),
(70, 3),
(70, 4),
(70, 5),
(71, 6),
(71, 7),
(71, 8),
(71, 9),
(71, 10),
(72, 11),
(72, 12),
(72, 13),
(72, 14),
(72, 15),
(73, 16),
(73, 17),
(73, 18),
(73, 19),
(73, 20),
(74, 21),
(74, 22),
(74, 23),
(74, 24),
(74, 25),
(75, 26),
(75, 27),
(75, 28),
(75, 29),
(75, 30),
(76, 31),
(76, 32),
(76, 1),
(76, 2),
(76, 3),
(77, 4),
(77, 5),
(77, 6),
(77, 7),
(77, 8),
(78, 9),
(78, 10),
(78, 11),
(78, 12),
(78, 13),
(78, 14),
(78, 15),
(79, 16),
(79, 17),
(79, 18),
(79, 19),
(79, 20),
(80, 21),
(80, 22),
(80, 23),
(80, 24),
(80, 25),
(81, 26),
(81, 27),
(81, 28),
(81, 29),
(81, 30),
(82, 31),
(82, 32),
(82, 1),
(82, 2),
(82, 3),
(83, 4),
(83, 5),
(83, 6),
(83, 7),
(83, 8),
(83, 9),
(83, 10),
(84, 11),
(84, 12),
(84, 13),
(84, 14),
(84, 15),
(84, 16),
(84, 17),
(84, 18),
(84, 19),
(84, 20),
(85, 21),
(85, 22),
(85, 23),
(85, 24),
(85, 25),
(86, 26),
(86, 27),
(86, 28),
(86, 29),
(86, 30),
(87, 31),
(87, 32),
(87, 1),
(87, 2),
(87, 3),
(88, 4),
(88, 5),
(88, 5),
(88, 6),
(88, 7),
(88, 8),
(89, 9),
(89, 10),
(89, 11),
(89, 12),
(89, 13),
(89, 14),
(89, 15),
(90, 16),
(90, 17),
(90, 18),
(90, 19),
(90, 20),
(91, 21),
(91, 22),
(91, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_image` FOREIGN KEY (`SubtopicID`) REFERENCES `subtopic` (`SubtopicID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `multichoice`
--
ALTER TABLE `multichoice`
  ADD CONSTRAINT `FK_multichoice` FOREIGN KEY (`TestID`) REFERENCES `subtopic` (`SubtopicID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `FK_results` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_resultsTest` FOREIGN KEY (`TestID`) REFERENCES `subtopic` (`SubtopicID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `FK_subject` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subtopic`
--
ALTER TABLE `subtopic`
  ADD CONSTRAINT `FK_subtopic` FOREIGN KEY (`TopicID`) REFERENCES `topic` (`TopicID`);

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `FK_topicsub` FOREIGN KEY (`SubjectID`) REFERENCES `subject` (`SubjectID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `truefalse`
--
ALTER TABLE `truefalse`
  ADD CONSTRAINT `FK_truefalse` FOREIGN KEY (`TestID`) REFERENCES `subtopic` (`SubtopicID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usersubject`
--
ALTER TABLE `usersubject`
  ADD CONSTRAINT `FK_subjectuser` FOREIGN KEY (`SubjectID`) REFERENCES `subject` (`SubjectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_usersubject` FOREIGN KEY (`userID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
