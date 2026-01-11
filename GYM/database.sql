USE brofit_gym;

CREATE TABLE fitness_profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    height INT,
    weight DECIMAL(5,2),
    age INT,
    gender VARCHAR(20),
    goal VARCHAR(50),
    bodyfat INT,
    activity VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
