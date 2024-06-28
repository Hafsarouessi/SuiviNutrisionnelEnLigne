-- Database: `suiviNutritionnel`
CREATE DATABASE suiviNutritionnel;
USE suiviNutritionnel;

-- Table structure for table `nutritioniste`
CREATE TABLE `nutritioniste` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `motDePasse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table `nutritioniste`
INSERT INTO `nutritioniste` (`id`, `nom`, `motDePasse`) VALUES
(1, 'hafsa', 'hafsa123');

-- Table structure for table `patients`
CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table `patients`
INSERT INTO `patients` (`id`, `prenom`, `nom`, `email`, `password`, `phone`, `posting_date`) VALUES
(13, 'hafsa', 'rouessi', 'hafsarouessi@gmail.com', 'hafsa@123', '1234567890', '2021-08-09 18:30:00');

-- Indexes for dumped tables

-- Indexes for table `nutritioniste`
ALTER TABLE `nutritioniste`
  ADD PRIMARY KEY (`id`);

-- Indexes for table `patients`
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

-- AUTO_INCREMENT for dumped tables

-- AUTO_INCREMENT for table `nutritioniste`
ALTER TABLE `nutritioniste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- AUTO_INCREMENT for table `patients`
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;