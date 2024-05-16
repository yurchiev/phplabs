![image](https://github.com/yurchiev/phplabs/assets/50412211/72b6e4f2-09a6-4a92-a1a5-1f5a29312171)
![image](https://github.com/yurchiev/phplabs/assets/50412211/35099314-684e-41d4-932d-ff87288efe6b)
![image](https://github.com/yurchiev/phplabs/assets/50412211/cda4a165-6bea-400b-a76e-609ed99d380c)
![image](https://github.com/yurchiev/phplabs/assets/50412211/d3baad3d-5796-4f4c-ae5f-95f3b9049c43)
![image](https://github.com/yurchiev/phplabs/assets/50412211/558ef88d-34a9-4d7c-9fcd-bdc47de6b9ca)
![image](https://github.com/yurchiev/phplabs/assets/50412211/38e6cce2-5ba4-44f5-b4e3-b2d27455f12e)
![image](https://github.com/yurchiev/phplabs/assets/50412211/e73c8ae3-454d-43c7-a9a1-7fe1e4265625)
![image](https://github.com/yurchiev/phplabs/assets/50412211/4139b4d6-cf53-4c6f-9533-a408a4cc7216)
![image](https://github.com/yurchiev/phplabs/assets/50412211/89b2e767-dd8e-43fd-a1a9-f0a6f99c7d07)
![image](https://github.com/yurchiev/phplabs/assets/50412211/32aecbd0-898b-4b05-958e-088e8266e3f8)
![image](https://github.com/yurchiev/phplabs/assets/50412211/36296b65-d1b1-4739-b5f1-a3b80a0ec0fc)
![image](https://github.com/yurchiev/phplabs/assets/50412211/57bfa3b9-c9d9-4087-8732-dd66663d950d)
![image](https://github.com/yurchiev/phplabs/assets/50412211/16c02e1a-1f05-4892-8575-0312f5aaee0c)

-- Створення таблиці викладачів
CREATE TABLE IF NOT EXISTS Lecturers (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    lecturer_name VARCHAR(100) NOT NULL
);

-- Додавання даних про викладачів
INSERT INTO Lecturers (lecturer_name)
VALUES 
('Скутар Ігор'),
('Сопронюк Тетяна'),
('Романенко Наталія'),
('Шепетюк Богдан'),
('Мельник Галина'),
('Бігун Ярослав');

-- Створення таблиці предметів
CREATE TABLE IF NOT EXISTS Subjects (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(100) NOT NULL,
    semester_number INT(2) NOT NULL,
    hours INT(3) NOT NULL,
    assessment_type VARCHAR(50) NOT NULL,
    lecturer_id INT(6) UNSIGNED,
    FOREIGN KEY (lecturer_id) REFERENCES Lecturers(id)
);

-- Додавання даних про предмети
INSERT INTO Subjects (subject_name, semester_number, hours, assessment_type, lecturer_id)
VALUES 
('Серверна мова програмування PHP', 1, 150, 'Екзамен', 1),
('Системне програмування', 2, 120, 'Екзамен', 2),
('Проектування програмних систем', 3, 130, 'Залік', 3),
('Теорія інформації та кодування', 5, 120, 'Залік', 4),
('Платформи корпоративних інформаційних систем', 4, 110, 'Залік', 5),
('Числові методи', 6, 120, 'Залік', 6);
