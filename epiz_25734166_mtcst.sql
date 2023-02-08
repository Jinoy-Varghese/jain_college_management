-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql200.epizy.com
-- Generation Time: Feb 14, 2022 at 11:54 PM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_25734166_mtcst`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `a_num` int(11) NOT NULL,
  `a_sem` varchar(255) NOT NULL,
  `a_course` varchar(255) NOT NULL,
  `a_subject` varchar(255) NOT NULL,
  `a_dept` varchar(255) NOT NULL,
  `a_email` varchar(255) NOT NULL,
  `mark` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`a_num`, `a_sem`, `a_course`, `a_subject`, `a_dept`, `a_email`, `mark`, `date`) VALUES
(5, 's5', 'bsc computer science', 'System Software', 'Computer Science', 'arun@gmail.com', 4, '2021-03-30 13:01:10'),
(6, 's5', 'bsc computer science', 'System Software', 'Computer Science', 'devan@gmail.com', 4, '2021-03-30 13:01:10'),
(7, 's5', 'bsc computer science', 'System Software', 'Computer Science', 'jinoy.v2000@gmail.com', 5, '2021-03-30 13:01:10'),
(8, 's5', 'bsc computer science', 'System Software', 'Computer Science', 'ashly@gmail.com', 3, '2021-03-30 13:01:10'),
(9, 's5', 'bsc computer science', 'System Software', 'Computer Science', 'arun@gmail.com', 0, '2021-03-30 13:04:01'),
(10, 's5', 'bsc computer science', 'System Software', 'Computer Science', 'devan@gmail.com', 0, '2021-03-30 13:04:01'),
(11, 's5', 'bsc computer science', 'System Software', 'Computer Science', 'jinoy.v2000@gmail.com', 2, '2021-03-30 13:04:01'),
(12, 's5', 'bsc computer science', 'System Software', 'Computer Science', 'ashly@gmail.com', 1, '2021-03-30 13:04:01'),
(13, 's5', 'bsc computer science', 'System Software', 'Computer Science', 'arun@gmail.com', 5, '2021-04-13 11:43:44'),
(14, 's5', 'bsc computer science', 'System Software', 'Computer Science', 'devan@gmail.com', 3, '2021-04-13 11:43:44'),
(15, 's5', 'bsc computer science', 'System Software', 'Computer Science', 'jinoy.v2000@gmail.com', 3, '2021-04-13 11:43:44'),
(16, 's5', 'bsc computer science', 'System Software', 'Computer Science', 'ashly@gmail.com', 3, '2021-04-13 11:43:44');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submit`
--

CREATE TABLE `assignment_submit` (
  `assign_id` int(11) NOT NULL,
  `assign_by` varchar(255) NOT NULL,
  `assign_sem` varchar(255) NOT NULL,
  `assign_subject` varchar(255) NOT NULL,
  `assign_to` varchar(255) NOT NULL,
  `assign_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `assign_file` varchar(255) NOT NULL,
  `assign_topic` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment_submit`
--

INSERT INTO `assignment_submit` (`assign_id`, `assign_by`, `assign_sem`, `assign_subject`, `assign_to`, `assign_date`, `assign_file`, `assign_topic`) VALUES
(1, 'devan@gmail.com', 's5', 'System Software', 'Rachana Jayan', '2021-07-13 18:30:00', 'assets/img/assignments/Certificate.pdf', 'SIC and SIC/XE');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_topic`
--

CREATE TABLE `assignment_topic` (
  `as_id` int(11) NOT NULL,
  `as_by` varchar(255) NOT NULL,
  `as_topic` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `last_date` date NOT NULL,
  `course` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignment_topic`
--

INSERT INTO `assignment_topic` (`as_id`, `as_by`, `as_topic`, `subject`, `semester`, `last_date`, `course`) VALUES
(1, 'rachana@gmail.com', 'SIC and SIC/XE', 'System Software', 's5', '2021-05-27', 'bsc computer science'),
(2, 'bincy@gmail.com', 'Data Mining and Data Warehousing', 'Data Mining', 's5', '2021-05-22', 'bsc computer science'),
(3, 'rachana@gmail.com', 'CSS and JavaScript', 'Web Programming', 's4', '2021-05-24', 'bsc computer science');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `num` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `s_sem` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `s_attendance` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`num`, `s_id`, `s_sem`, `timestamp`, `s_attendance`) VALUES
(5, 2, 's1', '2021-01-01 18:30:00', 'present'),
(6, 3, 's1', '2021-01-01 18:30:00', 'present'),
(9, 3, 's3', '2021-01-23 18:30:00', 'present'),
(10, 10, 's3', '2021-01-23 18:30:00', 'present'),
(11, 3, 's3', '2021-02-02 18:30:00', 'present'),
(12, 10, 's3', '2021-02-02 18:30:00', 'present'),
(13, 3, 's3', '2021-06-30 18:30:00', 'present'),
(14, 10, 's3', '2021-07-20 18:30:00', 'present'),
(15, 2, 's5', '2021-07-13 18:30:00', 'present'),
(16, 3, 's5', '2021-07-13 18:30:00', 'present'),
(17, 11, 's5', '2021-07-13 18:30:00', 'present'),
(18, 12, 's5', '2021-07-13 18:30:00', 'present'),
(19, 2, 's5', '2021-07-06 18:30:00', 'present'),
(20, 3, 's5', '2021-07-06 18:30:00', 'absent'),
(21, 11, 's5', '2021-07-06 18:30:00', 'present'),
(22, 12, 's5', '2021-07-06 18:30:00', 'absent');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `copies` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `about` varchar(255) DEFAULT NULL,
  `b_times` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `copies`, `author`, `about`, `b_times`) VALUES
(3, 'Harry Porter', 4, 'J K Rowling', 'Most Sold book', 0),
(7, 'Oliver twist', 2, 'charles dikens', 'A famous book', 0),
(8, 'The Hobbit', 7, 'Tolkien', 'Most valuable', 2),
(9, 'Wings of Fire', 3, 'A P J Abdul Kalam', 'Book of old Indian President', 2),
(10, 'To Kill a Mockingbird', 1, 'Harper Lee', 'Published in 1960', 1),
(11, 'The Lord of the Rings', 11, 'J.R.R. Tolkien', 'The complete best selling classic', 0),
(12, 'Little Women', 7, 'Louisa May Alcott', '', 1),
(13, 'Jane Eyre', 6, 'Charlotte Bronte', '', 0),
(14, 'Animal Farm', 2, 'George Orwell', '', 1),
(15, 'Charlotte’s Web', 1, 'E.B. White', '', 1),
(16, 'The Kite Runner', 3, 'Khaled Hosseini', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_issues`
--

CREATE TABLE `book_issues` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `issue_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `return_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_issues`
--

INSERT INTO `book_issues` (`id`, `book_id`, `borrower_id`, `issue_date`, `status`, `return_date`) VALUES
(36, 8, 1, '2020-11-23 18:30:00', 'returned', '2020-11-26'),
(37, 9, 9, '2020-11-23 18:30:00', 'returned', '2020-11-24'),
(38, 9, 1, '2020-11-24 18:30:00', 'issued', '2020-11-26'),
(39, 10, 9, '2020-11-24 18:30:00', 'issued', '2020-11-25'),
(40, 12, 14, '2020-11-24 18:30:00', 'returned', '2020-11-28'),
(41, 15, 14, '2020-11-25 18:30:00', 'returned', '2020-11-26'),
(42, 14, 20, '2020-12-05 05:32:35', 'issued', '2020-12-12'),
(43, 8, 32, '2021-04-28 06:22:47', 'issued', '2021-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_event` datetime NOT NULL,
  `end_event` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `title`, `start_event`, `end_event`) VALUES
(4, 'Meeting with Mike', '2019-11-11 15:30:00', '2019-11-11 16:30:00'),
(54, 'new : inaguration', '2021-03-16 00:00:00', '2021-03-17 00:00:00'),
(58, '5 Day Workshop', '2021-07-05 00:00:00', '2021-07-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `course_list`
--

CREATE TABLE `course_list` (
  `course_num` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `gradguation` varchar(255) NOT NULL,
  `sem_num` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_list`
--

INSERT INTO `course_list` (`course_num`, `department`, `gradguation`, `sem_num`, `course_name`) VALUES
(1, 'Computer Science', 'UG', 6, 'bsc computer science'),
(3, 'Computer Science', 'PG', 4, 'msc computer science');

-- --------------------------------------------------------

--
-- Table structure for table `exam_marks`
--

CREATE TABLE `exam_marks` (
  `num` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `mark_obtained` float NOT NULL,
  `exam_id` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `subject` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `sem` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_marks`
--

INSERT INTO `exam_marks` (`num`, `student_id`, `mark_obtained`, `exam_id`, `date`, `subject`, `course`, `sem`) VALUES
(0, 'ashly@gmail.com', 6, 's5System Software1505926921', '2021-07-29 16:06:45', 'System Software', 'bsc computer science', 's5'),
(0, 'arun@gmail.com', 0, 's5System Software971706589', '2021-11-23 09:27:12', 'System Software', 'bsc computer science', 's5'),
(0, 'arun@gmail.com', 0, 's5System Software470152405', '2021-11-23 09:27:58', 'System Software', 'bsc computer science', 's5');

-- --------------------------------------------------------

--
-- Table structure for table `exam_questions`
--

CREATE TABLE `exam_questions` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `question_by` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `exam_id` varchar(255) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `time` time NOT NULL,
  `scheduled_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_questions`
--

INSERT INTO `exam_questions` (`id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `answer`, `question_by`, `course`, `semester`, `subject`, `date`, `exam_id`, `question_id`, `time`, `scheduled_date`, `last_date`) VALUES
(13, 'The physical devices of a computer ', 'Software', 'Package', 'Hardware', 'System Software', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-04-20 10:01:25', 's5System Software470152405', 1, '00:31:15', '2021-04-23 11:18:00', '2021-06-01 04:57:00'),
(14, 'Which of the following is designed to control the operations of a computer', 'Application Software', 'System Software', 'Utility Software', 'User', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-04-20 10:01:25', 's5System Software470152405', 2, '00:31:15', '2021-04-23 11:18:00', '2021-06-01 04:57:00'),
(17, 'How are you', 'fine', 'not fine', 'ok', 'none of these', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-04-21 11:41:59', 's5System Software971706589', 1, '01:00:00', '2021-04-22 08:18:33', '2021-04-23 16:47:00'),
(18, 'Class ?', '1', '2', '3', '4', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-04-21 11:41:59', 's5System Software971706589', 2, '01:00:00', '2021-04-22 08:18:33', '2021-04-23 16:47:00'),
(19, 'Briefly explain the place that you live and the environment which you live in one word by selecting anyone of the following ?', 'good', 'bad', 'excellect', 'really bad', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-04-21 11:41:59', 's5System Software971706589', 3, '01:00:00', '2021-04-22 08:18:33', '2021-04-23 16:47:00'),
(20, 'name', 'no name', 'anonymous', 'debugger', 'none of these', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-04-21 11:41:59', 's5System Software971706589', 4, '01:00:00', '2021-04-22 08:18:33', '2021-04-23 16:47:00'),
(21, 'are you hungry', 'yes', 'no', 'never', 'need food', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-04-21 11:41:59', 's5System Software971706589', 5, '01:00:00', '2021-04-22 08:18:33', '2021-04-23 16:47:00'),
(0, 'Which of the following highly uses the concept of an array?', 'Binary Search tree', 'Caching', 'Spatial locality', 'Scheduling of Processes', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 1, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'Which one of the following is the process of inserting an element in the stack?', 'Insert', 'Add', 'Push', 'None of the above', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 2, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'Which of the following is the infix expression?', 'A+B*C', '+A*BC', 'ABC+*', 'None of the above', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 3, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'What is the outcome of the prefix expression +, -, *, 3, 2, /, 8, 4, 1?', '12', '11', '5', '4', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 4, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'Banker\'s algorithm is used?', 'To prevent deadlock', 'To deadlock recovery', 'To solve the deadlock', 'None of these', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 5, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'BIOS is used?', 'By operating system', 'By compiler', 'By interpreter', 'By application software', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 6, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'What is bootstrapping called?', 'Cold boot', 'Cold hot boot', 'Cold hot strap', 'Hot boot', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 7, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'Which of the following is a single-user operating system?', 'Windows', 'MAC', 'Ms-Dos', 'none', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 8, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'Which of the following is a condition that causes deadlock?', 'Mutual exclusion', 'Hold and wait', 'Circular wait', 'All of these', 'd', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 9, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'Who provides the interface to access the services of the operating system?', 'API', 'System call', 'Library', 'Assembly instruction', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 10, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'Which one of the following given statements possibly contains the error?', 'select * from emp where empid = 10003;', 'select empid from emp where empid = 10006;', 'select empid from emp;', 'select empid where empid = 1009 and Lastname = \'GELLER\';', 'd', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 11, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'What do you mean by one to many relationships?', 'One class may have many teachers', 'One teacher can have many classes', 'Many classes may have many teachers', 'Many teachers may have many classes', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 12, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'A Database Management System is a type of _________software.', 'It is a type of system software', 'It is a kind of application software', 'It is a kind of general software', 'Both A and C', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 13, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'The term \"FAT\" is stands for_____', 'File Allocation Tree', 'File Allocation Table', 'File Allocation Graph', 'All of the above', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 14, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'The term \"NTFS\" refers to which one of the following?', 'New Technology File System', 'New Tree File System', 'New Table type File System', 'Both A and C', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 15, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'Which of the following refers to the number of tuples in a relation?', 'Entity', 'Column', 'Cardinality', 'None of the above', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 16, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'Which one of the following is a type of Data Manipulation Command?', 'Create', 'Alter', 'Delete', 'All of the above', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 17, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'Which of the following is not an OOPS concept?', 'Encapsulation', 'Polymorphism', 'Exception', 'Abstraction', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 18, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'Which operator from the following can be used to illustrate the feature of polymorphism?', 'Overloading <<', 'Overloading &&', 'Overloading | |', 'Overloading +=', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 19, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'Which member function is assumed to call first when there is a case of using function overloading or abstract class?', 'Global function', 'Local function', 'Function with lowest priority', 'Function with the highest priority', 'd', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-26 15:34:17', 's5System Software968124147', 20, '00:30:15', '0000-00-00 00:00:00', '2021-07-28 00:44:00'),
(0, 'Consider a machine in which all memory reference instructions have only one memory address, for them we need at least _____ frame(s).', '1', '2', '3', 'none of these', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 1, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, 'The maximum number of frames per process is defined by ____________', 'the amount of available physical memory', ' operating System', 'instruction set architecture', 'none of the mentioned', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 2, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, ' The algorithm in which we allocate memory to each process according to its size is known as ____________', 'proportional allocation algorithm', 'equal allocation algorithm', ' split allocation algorithm', 'None of the above', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 3, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, ' ________ replacement generally results in greater system throughput.', 'Local', 'Global', 'Universal', 'Public', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 4, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, 'The bounded buffer problem is also known as ____________', 'Readers – Writers problem', 'Dining – Philosophers problem', 'Producer – Consumer problem', 'None of the mentioned', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 5, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, 'To ensure difficulties do not arise in the readers – writers problem _______ are given exclusive access to the shared object.', 'readers', 'writers', 'readers and writers', 'none of the mentioned', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 6, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, 'Which of the following comment is correct when a macro definition includes arguments?', 'The opening parenthesis should immediately follow the macro name.', 'There should be at least one blank between the macro name and the opening parenthesis.', 'There should be only one blank between the macro name and the opening parenthesis.', 'All the above comments are correct.', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 7, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, 'How many times will the following loop execute?           for(j = 1; j <= 10; j = j-1)  ', 'Forever', 'Never', '0', '1', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 8, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, ' How many characters can a string hold when declared as follows?         char name[20]:  ', '18', '19', '20', 'none', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 9, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, 'Which of the following statement is not true?', 'A pointer to an int and a pointer to a double are of the same size.', 'A pointer must point to a data item on the heap (free store).', 'A pointer can be reassigned to point to another data item.', 'A pointer can point to an array.', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 10, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, 'Let p1 be an integer pointer with a current value of 2000. What is the content of p1 after the expression p1++ has been evaluated?', '2001', '2002', '2004', '2008', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 11, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, 'What is the time complexity to count the number of elements in the linked list?', 'O(1)', 'O(n)', 'O(logn)', 'O(n2)', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 12, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, 'The attribute name could be structured as an attribute consisting of first name, middle initial, and last name. This type of attribute is called', 'Simple attribute', 'Composite attribute', 'Multivalued attribute', 'Derived attribute', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 13, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, 'In a relation between the entities the type and condition of the relation should be specified. That is called as______attribute.', 'Desciptive', 'Derived', 'Recursive', 'Relative', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 14, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, 'What is the process by which we can control what parts of a program can access the members of a class?', 'Polymorphism', 'Abstraction', 'Encapsulation', 'Recursion', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 15, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, 'Which of the following statements are incorrect?', 'public members of class can be accessed by any code in the program', 'private members of class can only be accessed by other members of the class', 'private members of class can be inherited by a subclass, and become protected members in subclass', 'protected members of a class can be inherited by a subclass, and become private members of the subclass', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 16, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, 'Which of these access specifier must be used for class so that it can be inherited by another subclass?', 'public', 'private', 'protected', ' none of the mentioned', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 17, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, 'Which is a bottom-up approach to database design that design by examining the relationship between attributes:', 'Functional dependency', 'Database modeling', 'Normalization', 'Decomposition', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 18, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, 'Which-one ofthe following statements about normal forms is FALSE?', 'BCNF is stricter than 3 NF', 'Lossless, dependency -preserving decomposition into 3 NF is always possible', 'Loss less, dependency – preserving decomposition into BCNF is always possible', 'Any relation with two attributes is BCNF', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 19, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, 'Which of the following is not an advantage of optimised bubble sort over other sorting techniques in case of sorted elements?', ' It is faster', 'Consumes less memory', 'Detects whether the input is already sorted', 'Consumes less time', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-27 15:32:57', 's5System Software1589908338', 20, '00:39:15', '2021-07-28 01:10:00', '2021-07-29 00:36:00'),
(0, ' The average time required to reach a storage location in memory and obtain its contents is called the _____', 'Seek time', 'Turnaround time', 'Access time', 'Transfer time', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-28 15:36:22', 's5System Software1868680356', 1, '00:33:15', '0000-00-00 00:00:00', '2021-07-30 00:45:00'),
(0, 'Add the two BCD numbers: 1001 + 0100 = ?', '10101111', '01010000', '00010011', '00101011', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-28 15:36:22', 's5System Software1868680356', 2, '00:33:15', '0000-00-00 00:00:00', '2021-07-30 00:45:00'),
(0, ' A three digit decimal number requires ________ for representation in the conventional BCD format.', '3 bits', '6 bits', '12 bits', '24 bits', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-28 15:36:22', 's5System Software1868680356', 3, '00:33:15', '0000-00-00 00:00:00', '2021-07-30 00:45:00'),
(0, 'When numbers, letters or words are represented by a special group of symbols, this process is called __________', 'Decoding', 'Encoding', 'Digitizing', 'Inverting', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-28 15:36:22', 's5System Software1868680356', 4, '00:33:15', '0000-00-00 00:00:00', '2021-07-30 00:45:00'),
(0, 'A top-to-bottom relationship among the items in a database is established by a', 'Hierarchical schema', 'Network schema', 'Relational schema', 'All of the mentioned', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-28 15:36:22', 's5System Software1868680356', 5, '00:33:15', '0000-00-00 00:00:00', '2021-07-30 00:45:00'),
(0, 'The highest level in the hierarchy of data organization is called', 'Data bank', 'Data base', 'Data file', 'Data record', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-28 15:36:22', 's5System Software1868680356', 6, '00:33:15', '0000-00-00 00:00:00', '2021-07-30 00:45:00'),
(0, 'Which of the following allows simultaneous write and read operations?', 'ROM', 'EROM', 'RAM', 'None of the above', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-28 15:36:22', 's5System Software1868680356', 7, '00:33:15', '0000-00-00 00:00:00', '2021-07-30 00:45:00'),
(0, 'Which of the following operations is/are performed by the ALU?', 'Data manipulation', 'Exponential', 'Square root', 'All of the above', 'd', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-28 15:36:22', 's5System Software1868680356', 8, '00:33:15', '0000-00-00 00:00:00', '2021-07-30 00:45:00'),
(0, 'Which of the following format is used to store data?', 'Decimal', 'Octal', 'BCD', 'Hexadecimal', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-28 15:36:22', 's5System Software1868680356', 9, '00:33:15', '0000-00-00 00:00:00', '2021-07-30 00:45:00'),
(0, 'Which of the following memory of the computer is used to speed up the computer processing?', 'Cache memory', 'RAM', 'ROM', 'None of the above', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-28 15:36:22', 's5System Software1868680356', 10, '00:33:15', '0000-00-00 00:00:00', '2021-07-30 00:45:00'),
(0, ' Computer address bus is ', 'Multidirectional', 'Bidirectional', 'Unidirectional', 'None of the above', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-28 15:36:22', 's5System Software1868680356', 11, '00:33:15', '0000-00-00 00:00:00', '2021-07-30 00:45:00'),
(0, 'Which of the following circuit convert the binary data into a decimal?', 'Decoder', 'Encoder', 'Code converter', 'Multiplexer', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-28 15:36:22', 's5System Software1868680356', 12, '00:33:15', '0000-00-00 00:00:00', '2021-07-30 00:45:00'),
(0, 'Subtraction in computers is carried out by -', '1\'s complement', '2\'s complement', '3\'s complement', '9\'s complement', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-28 15:36:22', 's5System Software1868680356', 13, '00:33:15', '0000-00-00 00:00:00', '2021-07-30 00:45:00'),
(0, 'Which of the following memory unit communicates directly with the CPU?', 'Auxiliary memory', 'Main memory', 'Secondary memory', 'None of the above', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-28 15:36:22', 's5System Software1868680356', 14, '00:33:15', '0000-00-00 00:00:00', '2021-07-30 00:45:00'),
(0, 'Which of the following topology is used in Ethernet?', 'Ring topology', 'Bus topology', 'Mesh topology', 'Star topology', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-28 15:36:22', 's5System Software1868680356', 15, '00:33:15', '0000-00-00 00:00:00', '2021-07-30 00:45:00'),
(0, '1. A collection of related data.', 'Information', 'Valuable information', 'Database', 'Metadata', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-29 14:54:21', 's5System Software1505926921', 1, '00:30:15', '2021-07-30 01:05:00', '2021-07-31 00:13:00'),
(0, 'DBMS manages the interaction between __________ and database.', 'Users', 'Clients', 'End Users', 'Stake Holders', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-29 14:54:21', 's5System Software1505926921', 2, '00:30:15', '2021-07-30 01:05:00', '2021-07-31 00:13:00'),
(0, ' Because of virtual memory, the memory can be shared among ____________', 'processes', 'threads', 'instructions', 'none of the mentioned', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-29 14:54:21', 's5System Software1505926921', 3, '00:30:15', '2021-07-30 01:05:00', '2021-07-31 00:13:00'),
(0, 'When a program tries to access a page that is mapped in address space but not loaded in physical memory, then ____________', 'segmentation fault occurs', ' fatal error occurs', 'page fault occurs', 'no error occurs', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-29 14:54:21', 's5System Software1505926921', 4, '00:30:15', '2021-07-30 01:05:00', '2021-07-31 00:13:00'),
(0, 'In FIFO page replacement algorithm, when a page must be replaced ____________', 'oldest page is chosen', 'newest page is chosen', 'random page is chosen', 'none of the mentioned', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-29 14:54:21', 's5System Software1505926921', 5, '00:30:15', '2021-07-30 01:05:00', '2021-07-31 00:13:00'),
(0, 'Which algorithm chooses the page that has not been used for the longest period of time whenever the page required to be replaced?', 'first in first out algorithm', 'additional reference bit algorithm', 'least recently used algorithm', 'counting based page replacement algorithm', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-29 14:54:21', 's5System Software1505926921', 6, '00:30:15', '2021-07-30 01:05:00', '2021-07-31 00:13:00'),
(0, 'Working set model for page replacement is based on the assumption of ____________', 'modularity', 'locality', 'globalization', 'random access', 'b', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-29 14:54:21', 's5System Software1505926921', 7, '00:30:15', '2021-07-30 01:05:00', '2021-07-31 00:13:00'),
(0, 'The NOR gate output will be high if the two inputs are __________', '00', '01', '10', '11', 'a', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-29 14:54:21', 's5System Software1505926921', 8, '00:30:15', '2021-07-30 01:05:00', '2021-07-31 00:13:00'),
(0, 'A universal logic gate is one which can be used to generate any logic function. Which of the following is a universal logic gate?', 'OR', 'AND', 'XOR', 'NAND', 'd', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-29 14:54:21', 's5System Software1505926921', 9, '00:30:15', '2021-07-30 01:05:00', '2021-07-31 00:13:00'),
(0, 'The gates required to build a half adder are __________', 'EX-OR gate and NOR gate', 'EX-OR gate and OR gate', 'EX-OR gate and AND gate', 'EX-NOR gate and AND gate', 'c', 'rachana@gmail.com', 'bsc computer science', 's5', 'System Software', '2021-07-29 14:54:21', 's5System Software1505926921', 10, '00:30:15', '2021-07-30 01:05:00', '2021-07-31 00:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `num` int(11) NOT NULL,
  `course` varchar(255) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `fee` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`num`, `course`, `sem`, `fee`, `date`) VALUES
(1, 'bsc computer science', 's5', 1, '2021-04-26 04:50:13'),
(2, 'bsc computer science', 's3', 1, '2021-04-26 04:56:09');

-- --------------------------------------------------------

--
-- Table structure for table `fees_paid`
--

CREATE TABLE `fees_paid` (
  `num` int(11) NOT NULL,
  `paid_by` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fees_paid`
--

INSERT INTO `fees_paid` (`num`, `paid_by`, `amount`, `sem`, `course`, `date`) VALUES
(1, 'arun@gmail.com', 4400, 's4', 'bsc computer science', '2021-04-26 18:30:00'),
(2, 'jinoy.v2000@gmail.com', 2300, 's1', 'bsc computer science', '2021-05-02 18:30:00'),
(3, 'hyfa@gmail.com', 3840, 's1', 'bsc computer science', '2021-05-02 18:30:00'),
(4, 'ashly@gmail.com', 1000, 's5', 'bsc computer science', '2021-06-02 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `img_file` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `img_file`, `title`, `date`) VALUES
(1, 'assets/img/gallery/arts.jpg', 'Arts Fest', '2021-07-12 06:23:25'),
(2, 'assets/img/gallery/sports.jpg', 'Sports', '2021-07-12 06:26:17'),
(3, 'assets/img/gallery/food_fest.jpg', 'food fest', '2021-07-12 06:26:38'),
(5, 'assets/img/gallery/m_11.jpg', 'Sports', '2021-07-12 21:55:37'),
(7, 'assets/img/gallery/add_on_course.jpg', 'add_on_course', '2021-07-13 20:05:47'),
(8, 'assets/img/gallery/alumini.jpg', 'alumini', '2021-07-13 20:06:03'),
(9, 'assets/img/gallery/arts.jpg', 'Arts', '2021-07-13 20:06:18'),
(10, 'assets/img/gallery/college_day.jpg', 'College Day', '2021-07-13 20:06:33'),
(11, 'assets/img/gallery/food_fest.jpg', 'Food Fest', '2021-07-13 20:07:12'),
(12, 'assets/img/gallery/onam_fest.jpg', 'Onam Celebration', '2021-07-13 20:07:34'),
(13, 'assets/img/gallery/nss.jpg', 'NSS Field Work', '2021-07-13 20:08:00'),
(14, 'assets/img/gallery/seminar.jpg', 'Seminar', '2021-07-13 20:08:16'),
(15, 'assets/img/gallery/women_cell.jpg', 'Women Cell', '2021-07-13 20:09:00'),
(16, 'assets/img/gallery/flash_mob.jpg', 'Flash Mob', '2021-07-13 20:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `hod_data`
--

CREATE TABLE `hod_data` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `u_education` varchar(255) NOT NULL,
  `u_set` varchar(255) NOT NULL,
  `u_net` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hod_data`
--

INSERT INTO `hod_data` (`id`, `email`, `dept`, `dob`, `u_education`, `u_set`, `u_net`) VALUES
(6, 'cspsycoo@gmail.com', 'Computer Science', '2020-10-07', '', '', ''),
(8, 'prameela@gmail.com', 'Electronics', '1996-02-07', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `incharge_list`
--

CREATE TABLE `incharge_list` (
  `incharge_num` int(11) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `user_incharge` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `incharge_dept` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `incharge_list`
--

INSERT INTO `incharge_list` (`incharge_num`, `semester`, `user_incharge`, `course`, `timestamp`, `incharge_dept`) VALUES
(7, 's2', 'bincy@gmail.com', 'bsc computer science', '2021-01-15 05:04:10', 'Computer Science'),
(8, 's1', 'rachana@gmail.com', 'bsc computer science', '2021-01-15 05:14:26', 'Computer Science'),
(9, 's3', 'rachana@gmail.com', 'bsc computer science', '2021-01-24 12:47:54', 'Computer Science'),
(10, 's1', 'rachana@gmail.com', 'bsc computer science', '2021-02-12 09:17:52', 'Computer Science'),
(11, 's5', 'rachana@gmail.com', 'bsc computer science', '2021-02-12 09:18:54', 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `lab_assistant_data`
--

CREATE TABLE `lab_assistant_data` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `u_education` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lab_assistant_data`
--

INSERT INTO `lab_assistant_data` (`id`, `email`, `dept`, `dob`, `u_education`) VALUES
(1, 'jinesh@gmail.com', 'Computer Science', '1992-11-13', '');

-- --------------------------------------------------------

--
-- Table structure for table `lab_complaints`
--

CREATE TABLE `lab_complaints` (
  `complaint_id` int(11) NOT NULL,
  `sym_no` varchar(255) NOT NULL,
  `complaint` varchar(255) NOT NULL,
  `register_by` varchar(255) NOT NULL,
  `registered_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fixed_on` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lab_complaints`
--

INSERT INTO `lab_complaints` (`complaint_id`, `sym_no`, `complaint`, `register_by`, `registered_on`, `fixed_on`, `status`) VALUES
(1, 'Com 05', 'Windows Not Working', 'rachana@gmail.com', '2021-04-20 19:54:16', '20-04-2021', 0),
(2, 'com 21', 'xampp cracked', 'rachana@gmail.com', '2021-04-20 20:07:11', '20-04-2021', 0),
(3, 'com12', 'System not working', 'rachana@gmail.com', '2021-04-21 02:24:03', '21-04-2021', 0),
(4, 'com37', 'System fails while loading bootloader.', 'rachana@gmail.com', '2021-04-21 02:22:38', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lab_record`
--

CREATE TABLE `lab_record` (
  `num` int(11) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `mark` int(11) NOT NULL,
  `dept` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lab_record`
--

INSERT INTO `lab_record` (`num`, `sem`, `course`, `subject`, `email`, `date`, `mark`, `dept`) VALUES
(1, 's5', 'bsc computer science', 'Python Lab', 'arun@gmail.com', '2021-04-30 05:54:09', 1, 'Computer Science'),
(2, 's5', 'bsc computer science', 'Python Lab', 'devan@gmail.com', '2021-04-30 05:54:09', 3, 'Computer Science'),
(3, 's5', 'bsc computer science', 'Python Lab', 'jinoy.v2000@gmail.com', '2021-04-30 05:54:09', 4, 'Computer Science'),
(4, 's5', 'bsc computer science', 'Python Lab', 'ashly@gmail.com', '2021-04-30 05:54:09', 2, 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `librarian_data`
--

CREATE TABLE `librarian_data` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `u_education` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `librarian_data`
--

INSERT INTO `librarian_data` (`id`, `email`, `dob`, `u_education`) VALUES
(3, 'librarian1@gmail.com', '2020-10-08', '');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_data`
--

CREATE TABLE `meeting_data` (
  `id` int(11) NOT NULL,
  `meet_by` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(3) NOT NULL,
  `course` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `sem` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meeting_data`
--

INSERT INTO `meeting_data` (`id`, `meet_by`, `date`, `status`, `course`, `subject`, `sem`) VALUES
(1, 'rachana@gmail.com', '2021-04-24 09:18:54', 0, 'bsc computer science', 'System Software', 's5'),
(2, 'sreejith@gmail.com', '2021-04-24 09:31:27', 1, 'bsc computer science', 'Computer Graphics', 's5'),
(3, 'rachana@gmail.com', '2021-04-24 11:48:05', 0, 'bsc computer science', 'System Software', 's5'),
(6, 'rachana@gmail.com', '2021-04-24 15:40:11', 0, 'bsc computer science', 'System Software', 's5'),
(7, 'rachana@gmail.com', '2021-04-25 06:18:47', 0, 'bsc computer science', 'System Software', 's5'),
(8, 'rachana@gmail.com', '2021-04-25 06:22:30', 0, 'bsc computer science', 'System Software', 's5'),
(9, 'rachana@gmail.com', '2021-04-25 06:25:11', 0, 'bsc computer science', 'System Software', 's5'),
(10, 'rachana@gmail.com', '2021-04-25 06:26:25', 0, 'bsc computer science', 'System Software', 's5'),
(15, 'rachana@gmail.com', '2021-07-14 10:44:16', 0, 'bsc computer science', 'Web Programming', 's4');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `news_file` varchar(255) NOT NULL,
  `file_by` varchar(255) NOT NULL,
  `news` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `news_file`, `file_by`, `news`) VALUES
(5, 'assets/img/news/IMG-20210712-WA0005.jpg', 'cspsycoo@gmail.com', 'Essay Competition'),
(6, 'assets/img/news/IMG-20210712-WA0004.jpg', 'cspsycoo@gmail.com', 'Poster Design Contest'),
(7, 'assets/img/news/s_2.png', 'cspsycoo@gmail.com', 'First Rank Holder'),
(8, 'assets/img/news/signal-2021-07-14-105239.jpeg', 'cspsycoo@gmail.com', 'Wrestling Competition'),
(9, 'assets/img/news/signal-2021-07-14-105254.jpeg', 'cspsycoo@gmail.com', 'Batminton Competition'),
(10, 'assets/img/news/signal-2021-07-14-105356.jpeg', 'cspsycoo@gmail.com', 'Poster Design'),
(11, 'assets/img/news/s_7.jpeg', 'cspsycoo@gmail.com', 'Memorial Fund');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note_num` int(11) NOT NULL,
  `note_for` varchar(255) NOT NULL,
  `note_by` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `note_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `note_heading` varchar(255) NOT NULL,
  `note_desc` varchar(255) NOT NULL,
  `note_subject` varchar(255) NOT NULL,
  `note_file` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `description`, `date`, `name`) VALUES
(10, '5th sem result published\r\n', '2021-04-21 12:23:41', 'cspsycoo@gmail.com'),
(11, 'College new block inaguration is on 20-5-2021', '2021-04-21 12:24:15', 'cspsycoo@gmail.com'),
(12, 'Sports festival is condecting on 20-4-2021', '2021-04-21 12:24:45', 'cspsycoo@gmail.com'),
(13, 'A grand 2 day seminar is contecting on 30-3-2021', '2021-04-21 12:27:09', 'cspsycoo@gmail.com'),
(14, 'Nss camp in going to start in 20-Dec-21', '2021-04-21 12:27:37', 'cspsycoo@gmail.com'),
(15, 'Food festival program name published as \"Restuka\"', '2021-04-21 12:28:40', 'cspsycoo@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `office_data`
--

CREATE TABLE `office_data` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `office_data`
--

INSERT INTO `office_data` (`id`, `email`, `dob`) VALUES
(1, 'office@gmail.com', '1969-05-12');

-- --------------------------------------------------------

--
-- Table structure for table `parent_data`
--

CREATE TABLE `parent_data` (
  `parent_num` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `s_mail` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent_data`
--

INSERT INTO `parent_data` (`parent_num`, `email`, `s_mail`, `dept`) VALUES
(1, 'radhakrishnan@gmail.com', 'devan@gmail.com', 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `pps_mark`
--

CREATE TABLE `pps_mark` (
  `num` int(11) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `mark` int(11) NOT NULL,
  `dept` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pps_mark`
--

INSERT INTO `pps_mark` (`num`, `sem`, `course`, `subject`, `email`, `date`, `mark`, `dept`) VALUES
(1, 's5', 'bsc computer science', 'Python Lab', 'arun@gmail.com', '2021-04-30 05:59:22', 4, 'Computer Science'),
(2, 's5', 'bsc computer science', 'Python Lab', 'devan@gmail.com', '2021-04-30 05:59:22', 5, 'Computer Science'),
(3, 's5', 'bsc computer science', 'Python Lab', 'jinoy.v2000@gmail.com', '2021-04-30 05:59:22', 4, 'Computer Science'),
(4, 's5', 'bsc computer science', 'Python Lab', 'ashly@gmail.com', '2021-04-30 05:59:22', 5, 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `principal_data`
--

CREATE TABLE `principal_data` (
  `principal_num` int(11) NOT NULL,
  `principal_email` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `u_education` varchar(255) NOT NULL,
  `u_net` varchar(255) NOT NULL,
  `u_set` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `principal_data`
--

INSERT INTO `principal_data` (`principal_num`, `principal_email`, `dob`, `u_education`, `u_net`, `u_set`) VALUES
(1, 'joseph@gmail.com', '1979-02-15', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `professor_data`
--

CREATE TABLE `professor_data` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `meet_status` int(11) NOT NULL,
  `u_education` varchar(255) NOT NULL,
  `u_set` varchar(255) NOT NULL,
  `u_net` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `professor_data`
--

INSERT INTO `professor_data` (`id`, `email`, `dept`, `dob`, `meet_status`, `u_education`, `u_set`, `u_net`) VALUES
(1, 'rachana@gmail.com', 'Computer Science', '1988-07-21', 0, '', '', ''),
(2, 'sonia@gmail.com', 'Polymer Chemistry', '1986-07-17', 1, '', '', ''),
(3, 'bincy@gmail.com', 'Computer Science', '1989-07-12', 0, '', '', ''),
(4, 'sreejith@gmail.com', 'Computer Science', '1984-10-23', 0, '', '', ''),
(5, 'reshmi@gmail.com', 'Computer Science', '1989-02-02', 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `req_for_proff`
--

CREATE TABLE `req_for_proff` (
  `req_id` int(11) NOT NULL,
  `req_subject` varchar(255) NOT NULL,
  `req_semester` varchar(255) NOT NULL,
  `req_course` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `dept` varchar(255) NOT NULL,
  `req_for_dept` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `student_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `s_sem` varchar(255) NOT NULL,
  `s_status` int(11) NOT NULL,
  `s_course` varchar(255) NOT NULL,
  `u_sslc` varchar(255) NOT NULL,
  `u_plustwo` varchar(255) NOT NULL,
  `u_sslcboard` varchar(255) NOT NULL,
  `u_plusboard` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`student_id`, `email`, `dept`, `dob`, `s_sem`, `s_status`, `s_course`, `u_sslc`, `u_plustwo`, `u_sslcboard`, `u_plusboard`) VALUES
(2, 'arun@gmail.com', 'Computer Science', '2000-04-01', 's5', 2, 'bsc computer science', '95', '90', '', ''),
(3, 'devan@gmail.com', 'Computer Science', '2000-02-08', 's5', 2, 'bsc computer science', '', '', '', ''),
(10, 'febin@gmail.com', 'Computer Science', '2021-01-07', 's3', 2, 'bsc computer science', '', '', '', ''),
(11, 'jinoy.v2000@gmail.com', 'Computer Science', '2000-06-05', 's5', 2, 'bsc computer science', '', '', '', ''),
(12, 'ashly@gmail.com', 'Computer Science', '2000-10-22', 's5', 2, 'bsc computer science', '', '', '', ''),
(13, 'hyfa@gmail.com', 'Computer Science', '1999-08-18', 's2', 2, 'bsc computer science', '', '', '', ''),
(14, 'tisha@gmail.com', 'Computer Science', '2000-09-15', 's2', 2, 'bsc computer science', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sub_num` int(11) NOT NULL,
  `sub_name` varchar(255) NOT NULL,
  `sub_dept` varchar(255) NOT NULL,
  `sub_sem` varchar(255) NOT NULL,
  `is_lab` varchar(255) NOT NULL,
  `sub_course` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`sub_num`, `sub_name`, `sub_dept`, `sub_sem`, `is_lab`, `sub_course`) VALUES
(1, 'Data Mining', 'Computer Science', '5', 'theory', 'bsc computer science'),
(2, 'System Software', 'Computer Science', '5', 'theory', 'bsc computer science'),
(3, 'Data Mining', 'Computer Science', '2', 'theory', 'bsc computer science'),
(4, 'Computer Graphics', 'Computer Science', '5', 'theory', 'bsc computer science'),
(5, 'Web Programming', 'Computer Science', '4', 'theory', 'bsc computer science'),
(6, 'Computer Graphics Lab', 'Computer Science', '5', 'lab', 'bsc computer science'),
(7, 'Web Programming Lab', 'Computer Science', '4', 'lab', 'bsc computer science'),
(8, 'Python Lab', 'Computer Science', '5', 'lab', 'bsc computer science'),
(9, 'Operating System', 'Computer Science', '3', 'theory', 'bsc computer science'),
(10, 'Python', 'Computer Science', '5', 'theory', 'bsc computer science'),
(11, 'Electronics', 'Computer Science', '1', 'theory', 'bsc computer science');

-- --------------------------------------------------------

--
-- Table structure for table `subject_assigned`
--

CREATE TABLE `subject_assigned` (
  `sub_num` int(11) NOT NULL,
  `teacher_id` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `sem` varchar(255) NOT NULL,
  `sub_dept` varchar(255) NOT NULL,
  `sub_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sub_course` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_assigned`
--

INSERT INTO `subject_assigned` (`sub_num`, `teacher_id`, `subject`, `sem`, `sub_dept`, `sub_date`, `sub_course`) VALUES
(3, 'bincy@gmail.com', 'Data Mining', 's5', 'Computer Science', '2021-03-10 08:28:16', 'bsc computer science'),
(6, 'reshmi@gmail.com', 'Data Mining', 's2', 'Computer Science', '2021-03-28 16:11:45', 'bsc computer science'),
(7, 'sreejith@gmail.com', 'Computer Graphics', 's5', 'Computer Science', '2021-04-24 09:30:49', 'bsc computer science'),
(8, 'rachana@gmail.com', 'System Software', 's5', 'Computer Science', '2021-04-28 04:00:30', 'bsc computer science'),
(9, 'rachana@gmail.com', 'Web Programming', 's4', 'Computer Science', '2021-04-28 03:50:16', 'bsc computer science'),
(10, 'rachana@gmail.com', 'Python Lab', 's5', 'Computer Science', '2021-04-30 05:46:21', 'bsc computer science');

-- --------------------------------------------------------

--
-- Table structure for table `subject_attendance`
--

CREATE TABLE `subject_attendance` (
  `num` int(11) NOT NULL,
  `s_id` varchar(255) NOT NULL,
  `s_sem` varchar(255) NOT NULL,
  `s_attendance` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `course` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_attendance`
--

INSERT INTO `subject_attendance` (`num`, `s_id`, `s_sem`, `s_attendance`, `subject`, `date`, `course`, `dept`) VALUES
(1, 'arun@gmail.com', 's5', 'present', 'System Software', '2021-04-24 17:14:40', 'bsc computer science', 'Computer Science'),
(2, 'devan@gmail.com', 's5', 'absent', 'System Software', '2021-04-24 17:14:40', 'bsc computer science', 'Computer Science'),
(3, 'jinoy.v2000@gmail.com', 's5', 'present', 'System Software', '2021-04-24 17:14:40', 'bsc computer science', 'Computer Science'),
(4, 'ashly@gmail.com', 's5', 'absent', 'System Software', '2021-04-24 17:14:40', 'bsc computer science', 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `time_stamp` datetime NOT NULL DEFAULT current_timestamp(),
  `u_image` varchar(255) NOT NULL DEFAULT 'assets/img/no-profile.jpg',
  `user_status` int(3) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `address`, `phone`, `gender`, `time_stamp`, `u_image`, `user_status`) VALUES
(1, 'Management', 'management@gmail.com', '823da4223e46ec671a10ea13d7823534', 'Super Admin', 'Management of Marthoma College of Science and Technology', '9207224063', 'm', '2020-09-20 09:54:33', 'assets/img/profile/2df1d067398cbfcd1c71bd2842c5a920.jpg', 1),
(9, 'Jinoy Varghese', 'cspsycoo@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'hod', 'Parayil house Mathra po Punalur', '9207224063', 'm', '2020-10-02 11:37:06', 'assets/img/profile/what-is-teacher-burnout.jpg', 1),
(14, 'Mark Otto', 'librarian1@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'librarian', 'library of marthoma college', '987654321', 'm', '2020-10-07 11:08:49', 'assets/img/profile/istock-1130461533.jpg', 1),
(15, 'Rachana Jayan', 'rachana@gmail.com', '823da4223e46ec671a10ea13d7823534', 'professor', 'Punalur', '9495731568', 'f', '2020-11-26 13:46:30', 'assets/img/profile/original.jpg', 1),
(17, 'Arun Ayyappan', 'arun@gmail.com', '823da4223e46ec671a10ea13d7823534', 'student', 'ayyappa bhavan', '9605703421', 'm', '2020-11-27 10:32:10', 'assets/img/profile/7ca95e9e08213050c1565bbc7ea6f0e9.jpg', 1),
(18, 'Sonia K', 'sonia@gmail.com', '823da4223e46ec671a10ea13d7823534', 'professor', 'sonia bhavan', '9876543210', 'f', '2020-11-27 12:10:31', 'assets/img/no-profile.jpg', 1),
(19, 'Jinesh V', 'jinesh@gmail.com', '823da4223e46ec671a10ea13d7823534', 'lab assistant', 'jinesh house punalur', '9876543210', 'm', '2020-11-27 12:12:35', 'assets/img/no-profile.jpg', 1),
(20, 'Devadathan R', 'devan@gmail.com', '823da4223e46ec671a10ea13d7823534', 'student', 'devan bhavan', '7306889088', 'm', '2020-11-27 12:19:51', 'assets/img/no-profile.jpg', 1),
(22, 'Radhakrishnan M', 'radhakrishnan@gmail.com', '823da4223e46ec671a10ea13d7823534', 'parent', 'devan bhavan', '9876543210', 'm', '2020-11-28 12:00:50', 'assets/img/no-profile.jpg', 1),
(23, 'Bincy Thomas', 'bincy@gmail.com', '823da4223e46ec671a10ea13d7823534', 'professor', 'bincy vilasam', '9876543210', 'f', '2020-12-18 11:56:04', 'assets/img/no-profile.jpg', 1),
(24, 'Sreejith S R', 'sreejith@gmail.com', '823da4223e46ec671a10ea13d7823534', 'professor', 'sreejith bhavan', '9876543210', 'm', '2020-12-18 11:57:29', 'assets/img/no-profile.jpg', 1),
(25, 'reshmi m', 'reshmi@gmail.com', '823da4223e46ec671a10ea13d7823534', 'professor', 'reshmi villa', '9876543210', 'f', '2020-12-18 12:00:15', 'assets/img/no-profile.jpg', 1),
(32, 'Febin Mathew', 'febin@gmail.com', '823da4223e46ec671a10ea13d7823534', 'student', 'febin villa', '9876543210', 'm', '2021-01-24 19:18:46', 'assets/img/no-profile.jpg', 1),
(33, 'Prameela M', 'prameela@gmail.com', '823da4223e46ec671a10ea13d7823534', 'hod', 'prameela bhavan', '9876543210', 'f', '2021-01-25 10:21:46', 'assets/img/no-profile.jpg', 1),
(37, 'Joseph Mathai', 'joseph@gmail.com', '823da4223e46ec671a10ea13d7823534', 'principal', 'Joseph Villa, Ayur', '9876543210', 'm', '2021-03-22 15:49:43', 'assets/img/profile/wp5988791.jpg', 1),
(38, 'Jinoy Varghese', 'jinoy.v2000@gmail.com', '823da4223e46ec671a10ea13d7823534', 'student', 'Parayil house Mathra po Punalur', '9207224063', 'm', '2021-03-30 09:50:17', 'assets/img/no-profile.jpg', 1),
(39, 'Ashly J Philip', 'ashly@gmail.com', '823da4223e46ec671a10ea13d7823534', 'student', 'Ashly  Bhavan', '7902323151', 'f', '2021-03-30 10:13:14', 'assets/img/profile/IMG_20210726_210810.jpg', 1),
(40, 'Hyfa Hakkim', 'hyfa@gmail.com', '823da4223e46ec671a10ea13d7823534', 'student', 'No Address', '8765987654', 'f', '2021-04-28 09:09:55', 'assets/img/no-profile.jpg', 1),
(41, 'Tisha Joy Mathew', 'tisha@gmail.com', '823da4223e46ec671a10ea13d7823534', 'student', 'Edhen Villa', '9876543210', 'f', '2021-04-28 09:12:14', 'assets/img/no-profile.jpg', 1),
(42, 'Swapna S ', 'office@gmail.com', '823da4223e46ec671a10ea13d7823534', 'office', 'Office Vilasam', '9876543210', 'f', '2021-04-28 09:26:02', 'assets/img/no-profile.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fees_paid`
--
ALTER TABLE `fees_paid`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office_data`
--
ALTER TABLE `office_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent_data`
--
ALTER TABLE `parent_data`
  ADD PRIMARY KEY (`parent_num`);

--
-- Indexes for table `pps_mark`
--
ALTER TABLE `pps_mark`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `principal_data`
--
ALTER TABLE `principal_data`
  ADD PRIMARY KEY (`principal_num`);

--
-- Indexes for table `professor_data`
--
ALTER TABLE `professor_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `req_for_proff`
--
ALTER TABLE `req_for_proff`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`sub_num`);

--
-- Indexes for table `subject_assigned`
--
ALTER TABLE `subject_assigned`
  ADD PRIMARY KEY (`sub_num`);

--
-- Indexes for table `subject_attendance`
--
ALTER TABLE `subject_attendance`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fees_paid`
--
ALTER TABLE `fees_paid`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `office_data`
--
ALTER TABLE `office_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parent_data`
--
ALTER TABLE `parent_data`
  MODIFY `parent_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pps_mark`
--
ALTER TABLE `pps_mark`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `principal_data`
--
ALTER TABLE `principal_data`
  MODIFY `principal_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `professor_data`
--
ALTER TABLE `professor_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `req_for_proff`
--
ALTER TABLE `req_for_proff`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `sub_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subject_assigned`
--
ALTER TABLE `subject_assigned`
  MODIFY `sub_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subject_attendance`
--
ALTER TABLE `subject_attendance`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
