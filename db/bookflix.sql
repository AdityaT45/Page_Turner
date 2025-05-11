-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 11, 2025 at 09:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookflix`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_info`
--

CREATE TABLE `book_info` (
  `bid` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `category` varchar(50) NOT NULL,
  `language` varchar(50) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `binding` varchar(50) NOT NULL,
  `no_of_pages` int(11) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `publisher_date` date DEFAULT NULL,
  `height` decimal(10,2) NOT NULL,
  `spine_width` decimal(10,2) NOT NULL,
  `width` decimal(10,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_info`
--

INSERT INTO `book_info` (`bid`, `name`, `author`, `price`, `category`, `language`, `publisher`, `binding`, `no_of_pages`, `weight`, `publisher_date`, `height`, `spine_width`, `width`, `image`, `description`, `date`) VALUES
(1, 'Agnes', 'Anne Bronte', 500, 'Novel', 'marathi', 'sad', 'qsad', 231, 1.00, '0000-00-00', 0.00, 0.00, 0.00, 'Agnes.jpg', '', '2024-04-03 20:10:02'),
(3, 'Darwin', 'Darwin D', 799, 'Knowledge', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'Darwins-Doubt.jpg', '', '2024-04-09 22:24:58'),
(4, 'Capture The Crown ', 'Jennifer E.', 633, 'Magical', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'CaptureTheCrown.jpg', '', '2024-04-09 22:25:39'),
(5, 'Crush The King ', 'Jennifer L', 566, 'Knowledge', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'CrushTheKing.jpg', '', '2024-04-09 22:26:30'),
(7, 'Stephen King', 'Carre', 455, 'Adventure', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'StephenKing.jpg', '', '2024-04-09 22:29:33'),
(8, 'Chhawa', 'Shivaji Sawant', 499, 'Novel', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'ChhawaBook.jpg', '', '2024-04-09 22:30:55'),
(9, 'The Winter King', 'Christ C', 65, 'Knowledge', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'TheWinterKing.jpg', '', '2024-04-09 22:32:08'),
(10, 'Ray Bearer', 'Jordan I', 999, 'Magical', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'RayBearer.jpg', '', '2024-04-09 22:37:05'),
(11, 'Love Boat', 'Abile Hing', 499, 'Adventure', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'LoveBoat.jpg', '\"Love Boat\" by Abigail Hing Wen is a young adult contemporary novel that follows Ever Wong, a Chinese-American teenager whose strict parents send her to a summer program in Taiwan. Expecting a rigid academic environment, she instead discovers \"Love Boat\"—a place where freedom, romance, and self-discovery thrive. As Ever navigates friendships, love interests, and cultural expectations, she begins to question her future and what she truly wants.', '2024-04-09 22:40:40'),
(12, 'india', 'yash pawar', 1900, 'Knowledge', '', '', '', 0, 0.00, NULL, 0.00, 0.00, 0.00, 'india.jpg', 'Timepass', '2024-04-25 18:02:31'),
(14, 'asd', 'sda', 123, 'Adventure', 'marathi', 'asd', 'sda', 123, 12345.00, '2025-03-27', 12.00, 21.00, 12.00, '95032642_709659699772027_2394568349125181440_n.jpg', 'asddsfdgsfdsafgfdgfe,n,dbfjkdsfkjd fjfhkjdsbkfjbasdfjkbdas', '2025-03-27 00:00:00'),
(15, 'Shivaji: The Great Maratha', 'Babasaheb Purandare', 399, 'Adventure', 'Marathi', 'Continental Prakashan', 'Hardcover', 350, 500.00, '2019-01-01', 22.00, 4.00, 15.00, '81GE3rZoJ1L._UF1000,1000_QL80_.jpg', 'This book captures the thrilling and courageous life of Chhatrapati Shivaji Maharaj, one of the greatest warriors and strategists of Indian history. It narrates his daring escapes, fearless battles, and strategic mountain fort-building in an engaging, adventurous tone. Readers will experience his inspirational journey from a young boy with a dream to a king who challenged empires and protected his people. This book not only depicts Shivaji Maharaj’s bravery but also highlights his governance, diplomacy, and commitment to Hindavi Swarajya. It is perfect for readers looking for a historical adventure that ignites patriotic fervor.', '2025-05-09 19:14:38'),
(16, 'Mrutyunjay', 'Shivaji Sawant', 449, 'Adventure', 'Marathi', 'Mehta Publishing', 'Paperback', 540, 600.00, '2018-06-15', 24.00, 5.00, 16.00, '61-ynJt5XFL._AC_UF1000,1000_QL80_.jpg', 'Mrutyunjay is the epic retelling of the life of Karna, one of the most enigmatic characters of the Mahabharata, in a first-person narrative. It takes readers on an emotional and adventurous journey through his struggles, inner conflict, and heroic battles. This novel beautifully portrays Karna’s valour, his loyalty to Duryodhana, and his undying spirit despite being denied his rightful place in society. It is a tale of courage and sacrifice, with moments of intense emotional and physical adventure. For anyone fascinated by epic adventures with a philosophical core, this is a must-read.', '2025-05-09 19:14:38'),
(17, 'Baji Prabhu Deshpande', 'Shivkumar Joshi', 299, 'Adventure', 'Marathi', 'Utkarsha Prakashan', 'Paperback', 280, 450.00, '2020-07-10', 21.00, 3.00, 14.00, 'images.jpeg', 'This biographical account of Baji Prabhu Deshpande, a legendary warrior in Shivaji Maharaj’s army, is filled with valiant acts and strategic brilliance. The narrative centers around the iconic battle at Ghodkhind where Baji Prabhu held back thousands of enemies with a small battalion, allowing Shivaji Maharaj to escape. The bravery, loyalty, and patriotism displayed in the book inspire a strong sense of adventure and sacrifice. The battle scenes are vivid, gripping, and keep the reader engaged throughout. This book serves as a tribute to one of Maharashtra’s greatest unsung heroes.', '2025-05-09 19:14:38'),
(18, 'Shunya', 'Sushrut Bagul', 350, 'Adventure', 'Marathi', 'Majestic Prakashan', 'Paperback', 320, 480.00, '2021-03-25', 20.00, 4.00, 14.00, 'shunya-original-imafyehsfaqzbbxz.jpg', 'Shunya takes readers on a modern-day adventure through time and philosophy. It is a tale that combines spiritual depth with thrilling escapades as the protagonist travels across India in search of ancient knowledge. Along the way, he faces challenges that test his courage, intellect, and willpower. The journey is sprinkled with historical references, mysterious characters, and ancient wisdom, making it a cerebral adventure. The story blurs the lines between myth and reality, keeping the reader intrigued till the last page.', '2025-05-09 19:14:38'),
(19, 'Chandrakanta', 'Devaki Nandan Khatri', 499, 'Adventure', 'Hindi', 'Rajkamal Prakashan', 'Hardcover', 400, 520.00, '2015-02-01', 23.00, 4.00, 15.00, 'chandrkanta.jpeg', 'Chandrakanta is one of the earliest Hindi fantasy-adventure novels that introduced readers to the world of tilism (magic) and ayyars (spies). The plot revolves around the love story of Princess Chandrakanta and Prince Virendra Singh, interwoven with magical realms, hidden forts, secret codes, and daring rescues. The novel is packed with suspense, mystery, and thrilling confrontations. As one of the foundational texts of Indian fantasy literature, Chandrakanta continues to enchant readers of all ages. It is a must-read for adventure lovers interested in classical Indian storytelling.', '2025-05-09 19:14:38'),
(20, 'Raktanchal', 'Pavan Rajput', 279, 'Adventure', 'Hindi', 'Pustak Mahal', 'Paperback', 290, 460.00, '2019-09-15', 21.00, 3.00, 14.00, 'raktanchal.jpg', 'Raktanchal is an intense action-adventure novel based on real events and personalities from the rugged terrain of eastern Uttar Pradesh. It features a gritty tale of revenge, power struggle, and ambition. The protagonist, caught in a world of crime and politics, embarks on a dangerous journey where each decision could be fatal. The story blends crime, adventure, and socio-political commentary, keeping the reader on edge. This book is ideal for those who enjoy realistic adventure fiction rooted in Indian soil.', '2025-05-09 19:14:38'),
(21, 'Durg Rakshak', 'Vishwas Patil', 399, 'Adventure', 'Marathi', 'Lokwangmay Gruh', 'Paperback', 310, 470.00, '2017-11-10', 22.00, 4.00, 15.00, 'durgrakshak.jpeg', 'Durg Rakshak presents the strategic importance and defense of forts during Shivaji Maharaj’s era. Through gripping narratives, it tells the stories of brave fort commanders who risked everything to protect their territories. Each chapter showcases valor, strategy, and an unshakable dedication to duty. The vivid battlefield descriptions and heroic tales make it an immersive experience for any reader who enjoys real-life adventure rooted in history. It’s a salute to the guardians of Maharashtra’s mighty forts.', '2025-05-09 19:14:38'),
(22, 'Ajatshatru', 'Acharya Chatursen', 369, 'Adventure', 'Hindi', 'Hindi Sahitya Sadan', 'Hardcover', 360, 490.00, '2016-08-20', 23.00, 4.00, 15.00, 'ajatshatru.jpeg', 'Ajatshatru is a historical adventure that narrates the life of the king who lived in Buddha’s time. This novel explores palace intrigue, battlefield strategies, and the transformation of a ruler into a monk. The tale is filled with thrilling episodes from the ancient past, including war planning, assassination attempts, and intense personal conflicts. It brilliantly balances action with philosophical reflections, offering readers both excitement and depth. A classic for readers interested in India’s ancient kingdoms and spiritual legacies.', '2025-05-09 19:14:38'),
(23, 'Prawas', 'Nitin Gokhale', 420, 'Adventure', 'Marathi', 'BookGanga', 'Paperback', 330, 500.00, '2022-05-05', 22.00, 4.00, 14.00, 'pravas.jpg', 'Prawas is a modern adventure that takes readers across borders and cultural landscapes as a journalist uncovers a major international story. Packed with espionage, high-speed chases, and geopolitical tension, the story remains grounded with a strong protagonist and Indian ethos. This book brings global adventure into Marathi literature, making it a thrilling read for young adults and professionals alike. Every chapter is a pulse-pounding ride, crafted with journalistic realism and fictional tension.', '2025-05-09 19:14:38'),
(25, 'Vishwavinashi', 'Shankar Patil', 350, 'Magical', 'Marathi', 'Shubham Prakashan', 'Paperback', 310, 480.00, '2020-08-01', 22.00, 4.00, 14.00, 'vishvvanshi.jpeg', 'Vishwavinashi is a unique tale that blends elements of magic, science, and fantasy. It narrates the story of a group of adventurers who stumble upon a magical artifact that allows them to bend the laws of nature. Their journey to unlock its secrets takes them across mystical lands where magic is not only real but an essential part of the universe’s fabric. This book weaves together themes of adventure, friendship, and courage as the characters navigate through magical challenges and discoveries. The world-building in this novel is intricate, and the magical elements are rich with history and mystery.', '2025-05-09 19:21:18'),
(26, 'Brahmandbhraman', 'Vishal Gawande', 400, 'Magical', 'Marathi', 'Vishal Publications', 'Paperback', 280, 460.00, '2021-11-15', 23.00, 4.00, 15.00, 'bramha.jpeg', 'Brahmandbhraman is an enthralling adventure set in a universe filled with intergalactic magic. The protagonist, a young wizard from a remote village, discovers that his magical abilities are linked to the cosmic forces of the universe. He embarks on a magical journey across realms and galaxies, encountering mythical creatures, powerful spells, and ancient prophecies. The book explores themes of destiny, self-discovery, and the responsibilities that come with great power. With a mix of space fantasy and Indian mythology, this book promises to captivate readers who enjoy magical adventures.', '2025-05-09 19:21:18'),
(27, 'Andhakarva', 'Sharad Pawar', 329, 'Magical', 'Marathi', 'Bhatkal & Sen', 'Paperback', 315, 490.00, '2019-04-20', 22.00, 4.00, 14.00, 'andhkar.jpeg', 'Andhakarva is a magical thriller that takes readers into the realm of darkness and light. The protagonist, who discovers a hidden power within him, faces a battle between ancient dark magic and a group of mystical protectors. This intense adventure moves through different dimensions, where the protagonist learns the art of light magic to counter the forces of darkness. Filled with intense magic duels, mystery, and suspense, this book also explores the psychological aspects of wielding power and the consequences of misusing it.', '2025-05-09 19:21:18'),
(28, 'Beeja ka Jaadu ', 'Anita Desai', 275, 'Magical', 'Hindi', 'Vikas Prakashan', 'Paperback', 330, 450.00, '2017-06-10', 21.00, 3.00, 14.00, 'beeja.jpg', 'Jadoo Ki Kahani is a fascinating magical adventure that transports readers into a world where magic is not just a fantasy but a way of life. The story follows a young girl who discovers an ancient spellbook that opens the doors to magical realms. Each chapter of the book reveals a new magical secret and a new adventure, as the girl encounters mythical creatures, ancient wizards, and magical obstacles. The plot intertwines themes of bravery, wisdom, and self-discovery, making it a perfect read for anyone who loves magic and mystery.', '2025-05-09 19:21:18'),
(29, 'Chamatkari Parvat', 'Manoj Shukla', 399, 'Magical', 'Hindi', 'Prabhat Prakashan', 'Hardcover', 410, 500.00, '2018-02-28', 23.00, 5.00, 15.00, '', 'Chamatkari Parvat is a gripping adventure that follows a young explorer’s journey to a mystical mountain known for its magical powers. Legends tell of hidden treasures and secrets guarded by ancient spirits. As the protagonist ventures deeper into the heart of the mountain, he encounters magical beasts, puzzles, and trials that test his wit and courage. The narrative unfolds with elements of magic, suspense, and adventure, immersing readers in an otherworldly experience that blends folklore with modern-day adventure.', '2025-05-09 19:21:18'),
(30, 'Aakash Ganga', 'Chandrakant Kumar', 410, 'Magical', 'Hindi', 'Rupa Publications', 'Paperback', 370, 520.00, '2020-12-15', 22.00, 4.00, 14.00, '', 'Aakash Ganga is an extraordinary magical story about a young boy who inherits the power to control the weather. As he learns to master his abilities, he realizes that with great power comes great responsibility. His journey takes him through enchanted lands, battling magical creatures and protecting innocent lives from a group of dark sorcerers seeking to steal his powers. The book explores themes of responsibility, self-doubt, and the eternal struggle between good and evil, while delivering a thrilling magical adventure.', '2025-05-09 19:21:18'),
(31, 'Divya Shakti', 'Amit Ghosh', 359, 'Magical', 'Hindi', 'HarperCollins India', 'Paperback', 320, 480.00, '2021-03-05', 23.00, 5.00, 15.00, '', 'Divya Shakti introduces readers to a magical world where the laws of nature are controlled by powerful forces. The protagonist, a young man with no magical lineage, discovers his hidden abilities and embarks on a journey to unlock his potential. Along the way, he uncovers long-forgotten magical secrets, faces deadly opponents, and learns that the most powerful magic is the strength within. This book blends magic with adventure, making it a captivating read for fans of both genres.', '2025-05-09 19:21:18'),
(32, 'Vishwakarma Ki Kahani', 'Rajesh Kumar', 499, 'Magical', 'Hindi', 'Srishti Publishers', 'Hardcover', 400, 550.00, '2019-09-12', 23.00, 4.00, 14.00, '', 'Vishwakarma Ki Kahani is a magical adventure that revolves around the legendary architect and craftsman of the gods, Vishwakarma. The protagonist, a young architect, is chosen by the gods to unlock the secrets of creating divine structures. He must journey across mystical lands, face magical trials, and learn the ancient art of crafting impossible things. Along the way, he battles against dark forces who want to control the magic of creation for their own gain. It’s a tale of wonder, imagination, and discovery.', '2025-05-09 19:21:18'),
(33, 'Kailas Parvat', 'Sujay Nair', 379, 'Magical', 'Marathi', 'Prabhat Prakashan', 'Paperback', 290, 460.00, '2021-07-25', 21.00, 3.00, 14.00, '', 'Kailas Parvat follows a group of adventurers who embark on a perilous journey to the mystical Kailas mountain, a place said to hold the secrets of eternal life. The novel mixes elements of magic, mythology, and adventure as the characters encounter magical creatures and ancient prophecies. The adventure is full of suspense, and each chapter is filled with revelations about the true nature of magic and its place in the universe. With captivating storytelling and rich world-building, this book is a must-read for fans of magical adventures.', '2025-05-09 19:21:18'),
(34, 'Tantra Vidya', 'Yogesh Patil', 329, 'Magical', 'Marathi', 'Manohar Publications', 'Paperback', 310, 480.00, '2020-04-05', 22.00, 4.00, 14.00, '', 'Tantra Vidya is an exploration of the world of black magic and occult powers. The protagonist, a young man from a remote village, stumbles upon an ancient text on tantra that opens the gateway to magical realms. As he delves deeper into the mystical world, he becomes entangled in a series of dangerous events, including encounters with powerful sorcerers and dark forces that seek to control his powers. The book weaves together adventure, magic, and suspense in a story filled with twists and turns.', '2025-05-09 19:21:18'),
(35, 'Jeevan Vidya', 'Pandurang Shastri Athavale', 350, 'Knowledge', 'Marathi', 'Swarajya Prakashan', 'Paperback', 320, 480.00, '2019-08-10', 21.00, 4.00, 14.00, '', 'Jeevan Vidya is a philosophical and practical guide that explores the essence of life through the teachings of Pandurang Shastri Athavale. The book emphasizes universal values like compassion, respect, and duty, aiming to create a balanced society. It covers deep spiritual topics and makes them understandable for the common reader, offering practical solutions to everyday struggles. Rooted in Indian tradition, it inspires readers to lead meaningful and ethical lives, promoting unity and peace through self-realization and knowledge.', '2025-05-10 11:13:04'),
(36, 'Gyankosh', 'Dr. Ramesh Deshmukh', 299, 'Knowledge', 'Marathi', 'Marathi Granth Sangrahalaya', 'Paperback', 280, 460.00, '2018-12-20', 22.00, 4.00, 15.00, '', 'Gyankosh is a knowledge treasure that compiles scientific facts, inventions, cultural history, and notable contributions of Indian thinkers in one volume. Aimed at students and curious minds, the book presents information in a simple, engaging format. It explains complex ideas with clarity and real-life examples, covering topics like astronomy, chemistry, ancient Indian science, and world history. It’s a must-read for learners who wish to expand their general knowledge and awareness of human progress.', '2025-05-10 11:13:04'),
(37, 'Bhartiya Itihas', 'Yashwant Kher', 330, 'Knowledge', 'Marathi', 'Continental Publications', 'Hardcover', 340, 510.00, '2020-03-15', 23.00, 5.00, 16.00, '', 'Bhartiya Itihas is a well-structured book that presents the vast history of India in a clear, concise manner. It begins with the Indus Valley Civilization and journeys through the Maurya, Gupta, Mughal, and British periods. The book uses storytelling to keep readers engaged while providing historically accurate information supported by archaeological evidence. It highlights the contributions of key historical figures and social reformers. This book is a perfect companion for students preparing for competitive exams and history enthusiasts.', '2025-05-10 11:13:04'),
(38, 'Vigyan Ek Drishtikon', 'Dr. R. T. Kulkarni', 280, 'Knowledge', 'Marathi', 'Lokprabha Prakashan', 'Paperback', 260, 430.00, '2017-09-05', 21.00, 3.00, 14.00, '', 'Vigyan Ek Drishtikon is a science awareness book written in Marathi that makes scientific concepts easy for non-technical readers. The book introduces topics like electricity, magnetism, genetics, and the environment through examples from everyday life. Each chapter builds curiosity and provides foundational knowledge that helps the reader develop a scientific attitude. It also includes stories of Indian scientists, innovations, and how science affects our lifestyle, making it suitable for students and adult learners alike.', '2025-05-10 11:13:04'),
(39, 'Manav Sharir Gyan', 'Dr. Amol Datar', 320, 'Knowledge', 'Marathi', 'Nirali Prakashan', 'Paperback', 300, 470.00, '2021-06-25', 22.00, 4.00, 14.00, '', 'Manav Sharir Gyan is a detailed introduction to the human body, its functions, and internal systems. Written in simple Marathi, the book covers anatomy and physiology topics such as the digestive, circulatory, respiratory, and nervous systems. It also includes charts and illustrations to aid understanding. It’s especially useful for biology students, nursing trainees, and general readers interested in health education. The book promotes health awareness and body literacy in a regional language context.', '2025-05-10 11:13:04'),
(40, 'Bharat Ek Khoj', 'Jawaharlal Nehru', 349, 'Knowledge', 'Hindi', 'National Book Trust', 'Paperback', 400, 500.00, '2015-04-14', 23.00, 5.00, 15.00, '', 'Bharat Ek Khoj is a historic and cultural journey through the soul of India, penned by Jawaharlal Nehru. This Hindi adaptation of \"The Discovery of India\" combines scholarly research with personal reflections. It explores India’s past, the rise and fall of empires, cultural richness, and philosophical ideas. The book brings out the unity in diversity of India and is written in a conversational yet insightful tone, making it an accessible and powerful source of knowledge for readers.', '2025-05-10 11:13:04'),
(41, 'Rashtra Nirmaan Mein Yuva', 'Dr. A.P.J. Abdul Kalam', 390, 'Knowledge', 'Hindi', 'Prabhat Prakashan', 'Hardcover', 280, 470.00, '2018-10-01', 22.00, 4.00, 15.00, '', 'Rashtra Nirmaan Mein Yuva focuses on the role of youth in nation-building. Written by former President Dr. Kalam, this motivational book emphasizes the power of education, science, innovation, and moral integrity. It contains inspiring stories and real-life examples that encourage young readers to dream big, work hard, and contribute positively to society. The book motivates readers to develop leadership qualities and think beyond personal success, aiming instead for national development.', '2025-05-10 11:13:04'),
(42, 'Vigyan Ke Anokhe Tathya', 'Vivek Sharma', 260, 'Knowledge', 'Hindi', 'Saraswati House', 'Paperback', 250, 420.00, '2020-11-20', 21.00, 3.00, 14.00, '', 'Vigyan Ke Anokhe Tathya is an engaging collection of unusual and fascinating scientific facts from physics, biology, space, and nature. Each page presents bite-sized nuggets of knowledge that spark curiosity and imagination. Aimed especially at school-going children and quiz enthusiasts, it offers a playful yet informative approach to learning. The book is full of illustrations and trivia that makes science approachable and fun, ideal for those who wish to explore science beyond textbooks.', '2025-05-10 11:13:04'),
(43, 'Hindi Sahitya Ka Itihas', 'Dr. Ramchandra Shukla', 399, 'Knowledge', 'Hindi', 'Lokbharti Prakashan', 'Paperback', 450, 540.00, '2016-05-18', 24.00, 5.00, 16.00, '', 'Hindi Sahitya Ka Itihas is a comprehensive and scholarly work that explores the development of Hindi literature across centuries. Written by the legendary Ramchandra Shukla, the book explains various literary eras, from Bhakti and Ritikaal to modern poetry and prose. It analyses key writers and texts, providing context and critique. It’s an essential reference for literature students, researchers, and anyone interested in the richness of Indian literary tradition.', '2025-05-10 11:13:04'),
(44, 'Parmanu Urja Ki Duniya', 'Dr. Sandeep Gupta', 289, 'Knowledge', 'Hindi', 'Vani Prakashan', 'Paperback', 310, 470.00, '2019-07-12', 22.00, 4.00, 14.00, '', 'Parmanu Urja Ki Duniya delves into the fascinating world of atomic energy and nuclear science. Written in accessible Hindi, the book explains atomic structure, nuclear reactors, fusion, fission, and India’s nuclear achievements. It addresses both the scientific and ethical aspects of atomic power. Ideal for science lovers and competitive exam aspirants, it builds awareness about India’s energy future and the potential of nuclear technology to solve energy and environmental challenges.', '2025-05-10 11:13:04'),
(45, 'Antariksh Yaan', 'Rajendra Joshi', 320, 'Sci-Fi', 'Marathi', 'Rohan Prakashan', 'Paperback', 290, 450.00, '2018-02-15', 21.00, 4.00, 14.00, '', 'Antariksh Yaan is a thrilling Marathi science fiction novel that follows the story of a team of Indian astronauts sent on a space mission to Mars. As they encounter strange atmospheric behavior, technical failures, and alien artifacts, the mission turns into a fight for survival. The book blends realistic space science with fictional discoveries, making it both educational and exciting. Aimed at young adults and science enthusiasts, it opens up the universe of imagination with scientific logic rooted in Indian space research.', '2025-05-10 11:14:35'),
(46, 'Kalokh', 'Vishwas Patil', 299, 'Sci-Fi', 'Marathi', 'Continental Publications', 'Paperback', 280, 430.00, '2017-11-10', 20.00, 3.00, 13.00, '', 'Kalokh is a gripping Marathi sci-fi novel where darkness envelops a futuristic city after an energy core failure. The story follows a young engineer who uncovers the secrets of a failed experiment meant to harness black energy. Blending quantum theories and emotional human responses, the book crafts a deep narrative on ethics in science and the unknown consequences of playing with nature. It’s a mind-expanding read that balances emotion and invention.', '2025-05-10 11:14:35'),
(47, 'Kritrim Buddhimatta', 'Dr. Sushant Bendre', 360, 'Sci-Fi', 'Marathi', 'Sakal Prakashan', 'Hardcover', 340, 480.00, '2019-08-08', 22.00, 4.00, 14.00, '', 'Kritrim Buddhimatta explores a dystopian future where artificial intelligence controls every aspect of life. The Marathi narrative revolves around a rebel programmer who discovers the dark side of AI and tries to fight back. The novel weaves modern issues like surveillance, digital ethics, and machine learning into an engaging story that warns of a world overtaken by logic and devoid of emotion. A must-read for fans of futuristic fiction.', '2025-05-10 11:14:35'),
(48, 'Manavi', 'Meena Kulkarni', 310, 'Sci-Fi', 'Marathi', 'Mehta Publishing', 'Paperback', 260, 420.00, '2020-04-04', 20.00, 3.00, 13.00, '', 'Manavi is a futuristic Marathi tale of the last surviving woman on Earth after a pandemic destroys the human genome. She is protected by a bio-engineered AI who develops emotions along the way. The novel blends biotechnology, climate disaster, and gender identity into a profound narrative of survival and evolution. It’s a poignant yet thrilling journey of what it means to be human in a world dominated by science.', '2025-05-10 11:14:35'),
(49, 'Naav Nebula', 'Sandeep Gokhale', 299, 'Sci-Fi', 'Marathi', 'Diamond Books', 'Paperback', 250, 410.00, '2016-12-20', 21.00, 3.00, 14.00, '', 'Naav Nebula is a Marathi space adventure where a spacecraft gets sucked into a mysterious nebula. The crew must solve strange quantum puzzles to escape. The story fuses Marathi cultural references with hard science fiction concepts like wormholes and dark energy. Richly imaginative and fast-paced, it’s a compelling read for space lovers.', '2025-05-10 11:14:35'),
(50, 'Aakhri Yudh', 'Anurag Pandey', 325, 'Sci-Fi', 'Hindi', 'Rajkamal Prakashan', 'Paperback', 300, 470.00, '2018-07-07', 22.00, 4.00, 15.00, '', 'Aakhri Yudh is a Hindi science fiction epic where the Earth faces extinction from a rogue planet. Scientists unite across nations to devise a planetary shield, while a hidden group manipulates events. The book offers fast-paced storytelling filled with political intrigue, advanced physics, and the question of morality in crisis. It appeals to young readers and science buffs alike.', '2025-05-10 11:14:35'),
(51, 'Manav Machine', 'Yashpal Saxena', 340, 'Sci-Fi', 'Hindi', 'Prabhat Prakashan', 'Hardcover', 330, 490.00, '2021-03-15', 23.00, 4.00, 16.00, '', 'Manav Machine is set in a near future where humans implant devices in their brains to access the internet directly. But when a massive AI hack leads to mass manipulation, a lone teenager must stop the system. The story raises important questions on identity, memory, and autonomy. With vivid world-building and thought-provoking dialogue, it’s a must-read Hindi sci-fi title.', '2025-05-10 11:14:35'),
(52, 'Rakt Grah Rahasya', 'Vivek Mishra', 300, 'Sci-Fi', 'Hindi', 'Navneet Prakashan', 'Paperback', 270, 440.00, '2017-10-10', 21.00, 3.00, 14.00, '', 'Rakt Grah Rahasya tells the story of a research team sent to Mars who accidentally awaken an ancient alien virus. What follows is a race against time to save not only the mission but humanity. With suspense, genetics, and extraterrestrial horror, it’s a Hindi sci-fi gem that explores the unknown corners of space and life.', '2025-05-10 11:14:35'),
(53, 'Paraloksafar', 'Deepa Verma', 310, 'Sci-Fi', 'Hindi', 'Vani Prakashan', 'Paperback', 280, 450.00, '2019-09-18', 21.00, 3.00, 14.00, '', 'Paraloksafar is a time-travel novel in Hindi, where a teenager stumbles upon a hidden time machine built by an ancient Indian sage. As he travels across centuries, he learns secrets about humanity’s past and future. The book mixes mythology, history, and speculative science, appealing to both young and mature readers.', '2025-05-10 11:14:35'),
(54, 'Antriksh Ka Dwar', 'Dr. Mohan Srivastava', 365, 'Sci-Fi', 'Hindi', 'Hindi Sahitya Mandal', 'Hardcover', 350, 500.00, '2020-02-02', 23.00, 5.00, 15.00, '', 'Antriksh Ka Dwar is a Hindi science fiction tale involving a secret wormhole near Earth. As global superpowers race to control it, a group of Indian scientists discovers the gateway leads to a mirror universe. The book explores themes of parallel realities, power struggles, and science vs. ethics. Engaging and mind-bending, it’s a powerful addition to Hindi sci-fi literature.', '2025-05-10 11:14:35'),
(55, 'Premgatha', 'Sudha Murty (Translated)', 299, 'Love', 'Marathi', 'Mehta Publishing', 'Paperback', 240, 390.00, '2017-04-15', 20.00, 3.00, 13.00, '', 'Premgatha is a heartwarming Marathi novel that explores love in its most unassuming form. The protagonist is a young woman from a rural background who unexpectedly finds herself entangled in a journey of self-discovery and affection. The story unfolds in layers—childhood romance, sacrifices, and second chances—all of which are rooted in strong Indian values. It gracefully portrays the emotional maturity required to nurture love. The book has a poetic touch with realistic situations that strike a chord with readers across generations. With its descriptive storytelling and relatable characters, Premgatha becomes a reflection of the reader’s own longing and emotional connections.', '2025-05-10 11:15:44'),
(56, 'Manachya Rekhavar', 'Shruti Deshpande', 310, 'Love', 'Marathi', 'Continental Prakashan', 'Paperback', 270, 420.00, '2018-08-01', 21.00, 3.00, 14.00, '', 'Manachya Rekhavar is a beautiful Marathi novel that revolves around two college students who fall in love amidst familial expectations and personal ambitions. The plot thickens when circumstances force them apart. The strength of the story lies in its character depth, inner conflicts, and emotionally rich dialogues. It captures the innocence of young love and the dilemmas of adult responsibilities. Readers feel every joy and pain with the protagonists, making this an immersive read that leaves a lasting impression.', '2025-05-10 11:15:44'),
(57, 'Ti Ani Me', 'Kiran Borkar', 320, 'Love', 'Marathi', 'Rohan Prakashan', 'Paperback', 280, 440.00, '2019-11-20', 21.00, 3.00, 14.00, '', 'Ti Ani Me is a modern-day Marathi love story that brings together two very different people—a poet and a tech professional—who cross paths unexpectedly. As their bond grows, they face social, cultural, and emotional challenges. The novel’s strength lies in its poetic narration and meaningful conversations that explore the fragility and power of human relationships. It is a tender tale that discusses love in the age of digital disconnection and revives the idea of soulful romance.', '2025-05-10 11:15:44'),
(58, 'Pratiksha', 'Neelima Joshi', 295, 'Love', 'Marathi', 'Majestic Publications', 'Paperback', 250, 400.00, '2020-02-10', 20.00, 3.00, 13.00, '', 'Pratiksha tells the story of a young woman who waits years for her childhood love to return from abroad. The story beautifully captures the emotional turmoil of waiting and the strength it requires to hold on to hope. Set against the backdrop of a small town in Maharashtra, the book explores themes of loyalty, heartbreak, and emotional endurance. It’s a poignant story about how time tests love and how memories hold us together when everything else fades.', '2025-05-10 11:15:44'),
(59, 'Tumhi Aahat Tar', 'Rahul Karandikar', 305, 'Love', 'Marathi', 'Sakal Prakashan', 'Paperback', 260, 410.00, '2021-03-08', 21.00, 3.00, 14.00, '', 'Tumhi Aahat Tar is a touching Marathi novel where the protagonist navigates grief, healing, and newfound love after losing his partner. The novel delicately handles themes of emotional trauma, rediscovery, and the complexities of loving again. With poetic prose and layered storytelling, it takes the reader through a journey of pain and hope. It inspires readers to believe in the magic of second chances and emotional resilience.', '2025-05-10 11:15:44'),
(60, 'Tum Bin', 'Ravindra Jain', 320, 'Love', 'Hindi', 'Rajkamal Prakashan', 'Paperback', 290, 450.00, '2017-12-10', 22.00, 3.00, 15.00, '', 'Tum Bin is a Hindi romantic novel that captures the anguish and beauty of love lost and found. The story revolves around a young man who meets the love of his life only to be separated by fate. Years later, their paths cross again under surprising circumstances. The book explores emotional healing, guilt, and the power of forgiveness. Rich in poetic expression, it resonates with readers who believe in soulful connections and destiny.', '2025-05-10 11:15:44'),
(61, 'Mohabbat Ke Rang', 'Anjali Verma', 330, 'Love', 'Hindi', 'Vani Prakashan', 'Paperback', 300, 460.00, '2018-09-14', 22.00, 4.00, 15.00, '', 'Mohabbat Ke Rang is a collection of short romantic stories in Hindi that delve into different shades of love—innocent crushes, passionate affairs, long-distance relationships, and mature companionship. The author skillfully portrays emotional depth with relatable characters and engaging narration. Each story leaves the reader with a warm afterglow and a reflection on what love means in today’s world. It’s a timeless book for Hindi readers of all ages.', '2025-05-10 11:15:44'),
(62, 'Dil Se', 'Kavita Mishra', 299, 'Love', 'Hindi', 'Prabhat Prakashan', 'Paperback', 260, 420.00, '2019-05-05', 21.00, 3.00, 14.00, '', 'Dil Se is a heartfelt Hindi novel that tells the story of a self-made woman who finds unexpected love in a co-worker during a corporate project. Set in modern urban India, the book highlights real emotional struggles—career conflicts, trust issues, and past baggage—all handled with grace. The conversations are natural, the pace gripping, and the message clear: love is simple when expressed with honesty.', '2025-05-10 11:15:44'),
(63, 'Tera Intezaar', 'Manoj Bhatnagar', 310, 'Love', 'Hindi', 'Diamond Books', 'Paperback', 280, 440.00, '2020-10-20', 21.00, 3.00, 14.00, '', 'Tera Intezaar is a bittersweet Hindi romantic story set against the backdrop of a train journey. A chance encounter between two strangers blossoms into a heartfelt connection that stays even after they part ways. The novel reflects on fleeting moments, unspoken emotions, and the eternal wait that defines true love. It’s poetic, philosophical, and emotionally satisfying.', '2025-05-10 11:15:44'),
(64, 'Ek Tha Pyar', 'Sanjay Tripathi', 340, 'Love', 'Hindi', 'Navbharat Sahitya', 'Paperback', 310, 470.00, '2021-08-01', 22.00, 4.00, 15.00, '', 'Ek Tha Pyar tells the story of two school sweethearts whose lives diverge drastically after college. Fate brings them together again, forcing them to question their current choices and rekindle old emotions. The book portrays the pain of lost opportunities, the excitement of rekindling love, and the courage it takes to follow one’s heart. It’s a Hindi novel that speaks directly to the soul.', '2025-05-10 11:15:44'),
(65, 'आहारातून आरोग्य', 'G. M. Deshpande', 250, 'Health', 'Marathi', 'Exotic India Art', 'Paperback', 240, 400.00, '2015-06-10', 21.00, 3.00, 14.00, '', 'आहारातून आरोग्य हे पुस्तक आयुर्वेदाच्या सिद्धांतांवर आधारित आहे आणि आहाराच्या माध्यमातून आरोग्य कसे सुधारता येईल यावर प्रकाश टाकते. लेखकाने विविध प्रकारच्या आहाराच्या सवयी, त्यांचे शरीरावर होणारे परिणाम आणि संतुलित आहाराचे महत्त्व यावर सखोल चर्चा केली आहे. पुस्तकात दिलेल्या मार्गदर्शक तत्त्वांमुळे वाचकांना त्यांच्या दैनंदिन आहारात सकारात्मक बदल घडवता येतील.', '2025-05-10 11:19:29'),
(66, 'आहारसूत्र', 'Dr. Anil Patil', 280, 'Health', 'Marathi', 'Menaka Prakashan', 'Paperback', 220, 380.00, '2018-09-15', 20.00, 3.00, 13.00, '', 'आहारसूत्र हे पुस्तक आधुनिक आहारशास्त्र आणि पारंपरिक आयुर्वेद यांचा समन्वय साधते. डॉ. अनिल पाटील यांनी आहाराच्या विविध पैलूंवर, जसे की पोषणमूल्ये, आहाराचे वेळापत्रक, आणि ऋतुनुसार आहार यावर सविस्तर माहिती दिली आहे. हे पुस्तक वाचकांना त्यांच्या आरोग्यासाठी योग्य आहार निवडण्यास मदत करते.', '2025-05-10 11:19:29'),
(67, 'Heal Your Gut, Mind and Emotions', 'Dimple Jangda', 299, 'Health', 'Hindi', 'Amazon Publishing', 'Paperback', 260, 420.00, '2024-09-23', 21.00, 3.00, 14.00, '', 'यह पुस्तक आंतों के स्वास्थ्य, मानसिक स्थिति और भावनाओं के बीच के संबंध को समझाने में मदद करती है। डिंपल जांगड़ा ने आयुर्वेदिक दृष्टिकोण से आहार, जीवनशैली और ध्यान के माध्यम से समग्र स्वास्थ्य प्राप्त करने के उपाय प्रस्तुत किए हैं। यह पुस्तक पाठकों को अपने शरीर और मन के बीच संतुलन स्थापित करने के लिए प्रेरित करती है।', '2025-05-10 11:19:29'),
(68, 'Swasthya Ke Liye Vichar Niyam', 'Unknown', 225, 'Health', 'Hindi', 'Get Happy Thoughts', 'Paperback', 200, 350.00, '2017-05-20', 20.00, 3.00, 13.00, '', 'स्वास्थ्य के लिए विचार नियम पुस्तक में मानसिक स्वास्थ्य और सकारात्मक सोच के महत्व पर प्रकाश डाला गया है। यह पुस्तक पाठकों को उनके विचारों को नियंत्रित करने और जीवन में सकारात्मक परिवर्तन लाने के लिए प्रेरित करती है। इसमें दिए गए सिद्धांत और अभ्यास जीवन की गुणवत्ता को बेहतर बनाने में सहायक हैं।', '2025-05-10 11:19:29'),
(69, 'Atomic Habits', 'James Clear', 350, 'Health', 'English', 'Penguin Random House', 'Paperback', 320, 450.00, '2018-10-16', 22.00, 4.00, 15.00, '', 'Atomic Habits offers a proven framework for improving every day. James Clear, one of the world\'s leading experts on habit formation, reveals practical strategies that will teach you exactly how to form good habits, break bad ones, and master the tiny behaviors that lead to remarkable results. The book emphasizes the importance of making small changes that compound over time, leading to significant improvements in personal and professional life.', '2025-05-10 11:19:29'),
(70, 'Why We Sleep', 'Matthew Walker', 400, 'Health', 'English', 'Simon & Schuster', 'Paperback', 360, 480.00, '2017-10-03', 23.00, 4.00, 16.00, '', 'Why We Sleep delves into the purpose and power of slumber. Neuroscientist and sleep expert Matthew Walker provides a comprehensive exploration of sleep, examining how it affects every aspect of our physical and mental well-being. The book discusses the consequences of sleep deprivation and offers insights into how to improve sleep quality, ultimately enhancing health, productivity, and longevity.', '2025-05-10 11:19:29'),
(71, 'Outlive: The Science and Art of Longevity', 'Peter Attia', 450, 'Health', 'English', 'Harmony Books', 'Hardcover', 400, 500.00, '2023-03-28', 24.00, 5.00, 17.00, '', 'Outlive presents a new approach to extending lifespan and improving healthspan. Dr. Peter Attia explores the latest scientific research on aging and longevity, offering practical advice on nutrition, exercise, sleep, and emotional health. The book emphasizes proactive strategies to prevent chronic diseases and enhance quality of life, making it a valuable resource for anyone interested in living a longer, healthier life.', '2025-05-10 11:19:29'),
(72, 'Super Agers: An Evidence-Based Approach to Longevi', 'Dr. Eric Topol', 420, 'Health', 'English', 'Scripps Publishing', 'Hardcover', 380, 490.00, '2025-05-08', 23.00, 5.00, 16.00, '', 'Super Agers explores the science behind aging and how certain individuals maintain exceptional health and cognitive function well into their later years. Dr. Eric Topol examines the roles of genetics, lifestyle, and medical interventions in promoting longevity. The book provides evidence-based strategies for readers to enhance their own aging process, focusing on personalized medicine and healthy behaviors.', '2025-05-10 11:19:29'),
(73, 'Diet And Lifestyle For Health In 21st Century', 'Dr. Shantaram Kane', 320, 'Health', 'Marathi', 'APK Publishers', 'Paperback', 240, 400.00, '2011-12-01', 21.00, 3.00, 14.00, '', 'हे पुस्तक २१व्या शतकातील आरोग्याच्या समस्यांवर उपाय सुचवते. डॉ. शांताराम काणे यांनी आहार आणि जीवनशैलीतील बदलांद्वारे आरोग्य सुधारण्याचे मार्ग सांगितले आहेत. पुस्तकात आधुनिक जीवनशैलीमुळे उद्भवणाऱ्या आरोग्याच्या समस्यांवर सखोल चर्चा केली आहे आणि त्यावर उपाय सुचवले आहेत.', '2025-05-10 11:19:29'),
(74, 'Indian Superfoods', 'Rujuta Diwekar', 299, 'Health', 'Hindi', 'Audible Studios', 'Audiobook', 0, 0.00, '2023-07-19', 0.00, 0.00, 0.00, '', 'यह पुस्तक भारतीय सुपरफूड्स के महत्व और उनके स्वास्थ्य लाभों पर केंद्रित है। रुजुता दिवेकर ने पारंपरिक भारतीय आहार के तत्वों को आधुनिक पोषण विज्ञान के साथ जोड़कर प्रस्तुत किया है। पुस्तक में दिए गए सुझाव सरल, व्यावहारिक और सांस्कृतिक रूप से प्रासंगिक हैं, जो पाठकों को स्वस्थ जीवनशैली अपनाने के लिए प्रेरित करते हैं।', '2025-05-10 11:19:29'),
(75, 'मृत्युंजय', 'Shivaji Sawant', 350, 'Novel', 'Marathi', 'Continental Prakashan', 'Paperback', 450, 500.00, '1967-01-01', 22.00, 4.00, 15.00, '', 'मृत्युंजय ही शिवाजी सावंत यांची महाभारतातील कर्णाच्या जीवनावर आधारित कादंबरी आहे. कर्णाच्या दृष्टिकोनातून महाभारताची कथा सांगणारी ही कादंबरी त्याच्या संघर्षमय जीवनाचे चित्रण करते.', '2025-05-10 11:22:49'),
(76, 'श्यामची आई', 'Sane Guruji', 200, 'Novel', 'Marathi', 'Sane Guruji Prakashan', 'Paperback', 180, 300.00, '1933-01-01', 20.00, 3.00, 13.00, '', 'श्यामची आई ही साने गुरुजी यांची आत्मकथनात्मक कादंबरी आहे, ज्यात त्यांनी आपल्या आईच्या आठवणी आणि संस्कारांचे वर्णन केले आहे. ही कादंबरी मातृत्वाचे महत्त्व अधोरेखित करते.', '2025-05-10 11:22:49'),
(77, 'गुनाहों का देवता', 'Dharamvir Bharati', 250, 'Novel', 'Hindi', 'Bharatiya Jnanpith', 'Paperback', 220, 350.00, '1949-01-01', 21.00, 3.00, 14.00, '', 'गुनाहों का देवता धर्मवीर भारती की प्रसिद्ध हिंदी उपन्यास है, जो प्रेम, त्याग और सामाजिक बंधनों की कहानी है। यह उपन्यास चंदर और सुधा के बीच के जटिल संबंधों को दर्शाता है.', '2025-05-10 11:22:49'),
(78, 'गोदान', 'Munshi Premchand', 300, 'Novel', 'Hindi', 'Lokbharti Prakashan', 'Paperback', 300, 400.00, '1936-01-01', 22.00, 4.00, 15.00, '', 'गोदान मुंशी प्रेमचंद का अंतिम और सबसे प्रसिद्ध उपन्यास है, जो ग्रामीण भारत की सामाजिक और आर्थिक समस्याओं का यथार्थ चित्रण करता है। यह होरी नामक किसान की कहानी है.', '2025-05-10 11:22:49'),
(79, 'To Kill a Mockingbird', 'Harper Lee', 350, 'Novel', 'English', 'J.B. Lippincott & Co.', 'Paperback', 281, 400.00, '1960-07-11', 21.00, 3.00, 14.00, '', 'To Kill a Mockingbird is a classic novel by Harper Lee, addressing serious issues like racial injustice and moral growth through the eyes of young Scout Finch in the American South.', '2025-05-10 11:22:49'),
(80, '1984', 'George Orwell', 320, 'Novel', 'English', 'Secker & Warburg', 'Paperback', 328, 420.00, '1949-06-08', 21.00, 3.00, 14.00, '', '1984 is a dystopian novel by George Orwell that explores themes of totalitarianism, surveillance, and individualism in a society under constant government control.', '2025-05-10 11:22:49'),
(81, 'The Great Gatsby', 'F. Scott Fitzgerald', 300, 'Novel', 'English', 'Charles Scribner\'s Sons', 'Paperback', 180, 350.00, '1925-04-10', 20.00, 3.00, 13.00, '', 'The Great Gatsby is a novel by F. Scott Fitzgerald that critiques the American Dream through the tragic story of Jay Gatsby and his unrequited love for Daisy Buchanan.', '2025-05-10 11:22:49'),
(82, 'Pride and Prejudice', 'Jane Austen', 280, 'Novel', 'English', 'T. Egerton, Whitehall', 'Paperback', 279, 360.00, '1813-01-28', 21.00, 3.00, 14.00, '', 'Pride and Prejudice is a romantic novel by Jane Austen that delves into issues of class, marriage, and societal expectations in 19th-century England.', '2025-05-10 11:22:49'),
(83, 'One Hundred Years of Solitude', 'Gabriel García Márquez', 400, 'Novel', 'English', 'Harper & Row', 'Paperback', 417, 450.00, '1970-06-05', 22.00, 4.00, 15.00, '', 'One Hundred Years of Solitude is a landmark novel by Gabriel García Márquez, chronicling the multi-generational story of the Buendía family in the fictional town of Macondo.', '2025-05-10 11:22:49'),
(84, 'The Catcher in the Rye', 'J.D. Salinger', 280, 'Novel', 'English', 'Little, Brown and Company', 'Paperback', 214, 340.00, '1951-07-16', 20.00, 3.00, 13.00, '', 'The Catcher in the Rye is a novel by J.D. Salinger that explores teenage angst and alienation through the experiences of protagonist Holden Caulfield in New York City.', '2025-05-10 11:22:49'),
(85, 'Charles Meyers', 'Dolore placeat modi', 255, 'Novel', 'Sint voluptatem Eaq', 'Nostrum suscipit in ', 'Animi omnis quibusd', 6, 35.00, '2015-08-17', 38.00, 99.00, 50.00, '81GE3rZoJ1L._UF1000,1000_QL80_.jpg', 'Nisi soluta totam qu', '2025-05-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `book_id` int(20) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(20) NOT NULL,
  `image` varchar(25) NOT NULL,
  `quantity` int(25) NOT NULL,
  `total` double(10,2) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `book_id`, `user_id`, `name`, `price`, `image`, `quantity`, `total`, `date`) VALUES
(8, 6, 5, 'Agnipankh', 999, 'agnipankh.jpg', 1, 999.00, '2024-04-25 21:13:02'),
(46, 10, 11, 'Ray Bearer', 999, 'RayBearer.jpg', 1, 999.00, '2025-04-29 19:06:29'),
(51, 12, 11, 'india', 1900, 'india.jpg', 1, 1.00, '2025-04-30 10:53:08'),
(52, 11, 11, 'Love Boat', 499, 'LoveBoat.jpg', 1, 499.00, '2025-04-30 11:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sender` enum('user','admin') NOT NULL,
  `admin_reply` text DEFAULT NULL,
  `reply_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `user_id`, `message`, `sender`, `admin_reply`, `reply_time`, `timestamp`) VALUES
(1, 3, 'asad', 'user', NULL, '2025-03-06 11:40:55', '2025-03-06 11:40:55'),
(2, 3, 'asad', 'user', NULL, '2025-03-06 11:41:00', '2025-03-06 11:41:00'),
(3, 3, 'asad', 'user', 'fsdfs', '2025-03-06 11:42:33', '2025-03-06 11:42:33'),
(4, 3, 'sd', 'user', NULL, '2025-03-06 11:42:36', '2025-03-06 11:42:36'),
(5, 3, 'dsa', 'user', NULL, '2025-03-06 11:42:46', '2025-03-06 11:42:46'),
(6, 3, 'as', 'user', NULL, '2025-03-06 11:43:44', '2025-03-06 11:43:44');

-- --------------------------------------------------------

--
-- Table structure for table `confirm_order`
--

CREATE TABLE `confirm_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `total_books` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` date NOT NULL DEFAULT curdate(),
  `payment_id` varchar(255) DEFAULT NULL,
  `payment_status` enum('pending','success','failed') NOT NULL DEFAULT 'pending',
  `delivery_staff_id` int(11) DEFAULT NULL,
  `order_status` varchar(50) DEFAULT 'Pending',
  `district` varchar(255) NOT NULL,
  `taluka` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `confirm_order`
--

INSERT INTO `confirm_order` (`id`, `user_id`, `name`, `number`, `email`, `address`, `total_books`, `total_price`, `order_date`, `payment_id`, `payment_status`, `delivery_staff_id`, `order_status`, `district`, `taluka`) VALUES
(11, 3, 'Shubham Pawar', '', 'shubham@gmail.com', 'at wakodi,post darewadi,tal nagar, dist ahmednagar.414002', 'aditya  x 1, Chhawa x 1, Darwin x 1', 1529.00, '2025-03-27', 'pay_QBlSGBnwl5O0Z7', 'success', 1, 'Assigned', '', ''),
(13, 3, 'aditya todmal', '', 'adi@gmail.com', 'NARHE TAL-HAVELI,DISTRICT-PUNE', 'aditya  x 1, india x 1', 2131.00, '2025-03-29', 'pay_QCYUNyeuhZSZOR', 'success', 1, 'pending', '', ''),
(14, 3, 'aditya todmal', '', 'adi@gmail.com', 'NARHE TAL-HAVELI,DISTRICT-PUNE', 'india x 1', 1900.00, '2025-03-29', 'pay_QCYe0lVgnv2UhZ', 'success', 4, 'delivered', 'Ahmednagar', 'Karjat'),
(15, 3, 'aditya todmal', '', 'adi@gmail.com', 'NARHE TAL-HAVELI,DISTRICT-PUNE', 'india x 1', 1900.00, '2025-04-01', 'pay_QDgz032djZY1be', 'success', 4, 'Assigned', 'Ahmednagar', 'Karjat'),
(16, 3, 'aditya todmal', '', 'adi@gmail.com', 'NARHE TAL-HAVELI,DISTRICT-PUNE', 'Ray Bearer x 1, india x 1', 2899.00, '2025-04-14', 'pay_QIsa0EDOQOtQzo', 'success', NULL, 'Pending', 'Ahmednagar', 'Karjat'),
(17, 3, 'aditya todmal', '', 'adi@gmail.com', 'NARHE TAL-HAVELI,DISTRICT-PUNE', 'india x 1', 1900.00, '2025-04-15', 'pay_QJBXPycPqkfSUV', 'success', 3, 'Assigned', 'Ahmednagar', 'Karjat'),
(18, 11, 'x x', '', 'x@gmail.com', 'at wakodi,post darewadi,tal nagar, dist ahmednagar.414002', 'Darwin x 1', 799.00, '2025-04-29', 'pay_QOsihz8sO5yZct', 'success', NULL, 'Pending', 'Jalgaon', 'Muktainagar'),
(19, 7, 'aditya todmal', '', 'a@gmail.com', 'at wakodi,post darewadi,tal nagar, dist ahmednagar.414002', 'Ray Bearer x 1', 999.00, '2025-05-09', 'pay_QSqCpOlQ9R0zMF', 'success', 4, 'delivered', 'Ahmednagar', 'Akole'),
(20, 7, 'aditya todmal', '', 'a@gmail.com', 'at wakodi,post darewadi,tal nagar, dist ahmednagar.414002', 'Mrutyunjay x 1', 449.00, '2025-05-10', 'pay_QTHiAlC4QU8Vaf', 'success', NULL, 'Pending', 'Ahmednagar', 'Akole');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_staff`
--

CREATE TABLE `delivery_staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `state` varchar(255) NOT NULL DEFAULT 'Maharashtra',
  `district` varchar(255) NOT NULL,
  `taluka` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_staff`
--

INSERT INTO `delivery_staff` (`id`, `name`, `email`, `phone`, `password`, `status`, `created_at`, `state`, `district`, `taluka`) VALUES
(2, 'asdas', 'adityatodmal416@gmail.com', '08767062627', '123', 'Inactive', '2025-03-29 10:15:09', 'Maharashtra', 'Ahmednagar', 'Karjat'),
(3, 'ganesh', 'g@gmail.com', '9876543210', '1122', 'Active', '2025-03-29 10:26:50', 'Maharashtra', 'Ahmednagar', 'Akole, Jamkhed, Karjat, Kopargaon, Nevasa, Parner'),
(4, 'sangram', 'sp@gmail.com', '9876543211', '$2y$10$ke/KXAbuj4F7dwvDpgmyhe1xLyMmExERJ7xLYrgXh1oRlJNlkGjeC', 'Active', '2025-03-30 07:15:08', 'Maharashtra', 'Ahmednagar', 'Akole, Jamkhed, Karjat, Shrigonda, Shrirampur'),
(5, 'ruturaj', 'r@gmail.com', '9876541234', '$2y$10$BG28diO.4fUwyp8rzCCL/un7N5m1RkR3VtZazhkMZS9l1SuJ48RPC', 'Active', '2025-03-30 18:40:10', 'Maharashtra', 'Pune', 'Baramati, Bhor, Daund, Haveli, Indapur, Junnar, Khed');

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `number` int(20) NOT NULL,
  `msg` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`id`, `user_id`, `name`, `email`, `number`, `msg`, `date`) VALUES
(1, 3, 'Shubham Pustake', 'shubham@gmail.com', 2147483647, 'Is any book of cooking is available \r\n', '2024-04-20 00:00:02'),
(2, 7, 'zxxzczc', 'admin@gmail.com', 2147483647, 'sadfgbvv', '2025-03-03 20:23:15');

-- --------------------------------------------------------

--
-- Table structure for table `otp_verification`
--

CREATE TABLE `otp_verification` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp_verification`
--

INSERT INTO `otp_verification` (`id`, `email`, `otp`, `created_at`) VALUES
(9, 'gandhibapu009@gmail.com', '364562', '2025-03-31 17:18:38'),
(10, 'gandhibapu009@gmail.com', '708456', '2025-03-31 17:25:06'),
(18, 'adityatodmal47@gmail.com', '511835', '2025-03-31 18:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `query` text DEFAULT NULL,
  `response` text DEFAULT NULL,
  `status` enum('Pending','Answered') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`id`, `user_id`, `query`, `response`, `status`, `created_at`) VALUES
(1, 3, 'hello when will delivered myparsel', NULL, 'Pending', '2025-03-06 10:47:16'),
(2, 3, 'hello when will delivered myparsel', NULL, 'Pending', '2025-03-06 10:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'asasda', 'asdf@gmail.com', '$2y$10$4aXbDyS2lvje4HYe4EhnweFA7WANnuE19odcRzFGSRcy0YL1RgXzy', '2025-03-04 13:58:52'),
(4, 'ganesh', 'g@gmail.com', '$2y$10$nin9VncsrZ1voWL1k/AaFOVtxemgjm7Txs3GF7CJNghW.5CzJMk22', '2025-05-10 09:25:15'),
(5, 'ritesh', 'r@gmail.com', '$2y$10$kjBZtI5dA4viGIMXnfDf.uGO.D4CFQOMm7SUdIZNyNONG9gXuYz3W', '2025-05-10 09:27:39'),
(6, 'akash', 'a@gmail.com', '$2y$10$oGnkApYiux65vP7aS1qJ/eyo4bQXPk55kd/iy1VzNMPRTIk6WaRbm', '2025-05-10 09:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE `users_info` (
  `Id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `address` varchar(255) NOT NULL,
  `district` varchar(100) DEFAULT NULL,
  `taluka` varchar(100) DEFAULT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL DEFAULT 'India',
  `pincode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`Id`, `name`, `surname`, `username`, `email`, `password`, `user_type`, `address`, `district`, `taluka`, `state`, `country`, `pincode`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@pageturner.com', 'admin', 'Admin', '', NULL, NULL, '', 'India', ''),
(3, 'aditya', 'todmal', 'a45', 'adi@gmail.com', '1122', 'User', 'NARHE TAL-HAVELI,DISTRICT-PUNE', 'Ahmednagar', 'Karjat', 'Maharashtra', 'India', '414002'),
(7, 'aditya', 'todmal', 'user', 'a@gmail.com', 'a123456', 'User', 'at wakodi,post darewadi,tal nagar, dist ahmednagar.414002', 'Ahmednagar', 'Akole', 'Maharashtra', 'India', '414002'),
(8, 'm', 'm', 'm', 'm@gmail.com', '$2y$10$7gECUvcAMEOZi', 'user', '', NULL, NULL, '', 'India', ''),
(9, 'n', 'n', 'n', 'n@gmail.com', '$2y$10$Y6MssmQ4cFtnh', 'user', '', NULL, NULL, '', 'India', ''),
(10, 'z', 'z', 'z12', 'z@gmail.com', '$2y$10$e4YyTd0QYp.It', 'user', '', NULL, NULL, '', 'India', ''),
(11, 'x', 'x', 'x', 'x@gmail.com', 'xxxxxx', 'user', 'at wakodi,post darewadi,tal nagar, dist ahmednagar.414002', 'Jalgaon', 'Muktainagar', 'Maharashtra', 'India', '414002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_info`
--
ALTER TABLE `book_info`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `confirm_order`
--
ALTER TABLE `confirm_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_staff`
--
ALTER TABLE `delivery_staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_verification`
--
ALTER TABLE `otp_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_info`
--
ALTER TABLE `book_info`
  MODIFY `bid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `confirm_order`
--
ALTER TABLE `confirm_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `delivery_staff`
--
ALTER TABLE `delivery_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `msg`
--
ALTER TABLE `msg`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `otp_verification`
--
ALTER TABLE `otp_verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_info`
--
ALTER TABLE `users_info`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_info` (`Id`);

--
-- Constraints for table `queries`
--
ALTER TABLE `queries`
  ADD CONSTRAINT `queries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_info` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
