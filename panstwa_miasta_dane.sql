INSERT INTO kraje (id_kraju, nazwa, kontynent, region_swiata, powierzchnia, rok_uzyskania_niepodleglosci, ilosc_ludnosci, sredni_dozywany_wiek, PNB, stolica) VALUES
('USA', 'Stany Zjednoczone', 'ameryka północna', 'Ameryka Północna', 9372610.00, 1776, 331002651, 78.5, 21433225.00, 1),
('FRA', 'Francja', 'europa', 'Zachodnia Europa', 551695.00, 843, 65273511, 82.4, 2715518.00, 2),
('JPN', 'Japonia', 'azja', 'Wschodnia Azja', 377975.00, 660, 126476461, 84.6, 5398000.00, 3),
('BRA', 'Brazylia', 'ameryka południowa', 'Ameryka Łacińska', 8515767.00, 1822, 212559417, 76.6, 2055500.00, 4),
('KEN', 'Kenia', 'afryka', 'Wschodnia Afryka', 580367.00, 1963, 53771296, 66.5, 95.50, 5);

INSERT INTO jezyk_narodowy (kod_kraju, jezyk_urzedowy, czy_jezyk_urzedowy_jest_oficjalny, jaki_procent_ludnosci_uzywa_jezyka_urzedowego) VALUES
('USA', 'Angielski', 'T', 100.0),
('FRA', 'Francuski', 'T', 99.0),
('JPN', 'Japoński', 'T', 98.0),
('BRA', 'Portugalski', 'T', 98.0),
('KEN', 'Suahili', 'T', 75.0);

INSERT INTO stolica_krajowa (ID, nazwa, kod_kraju, populacja) VALUES
(1, 'Waszyngton', 'USA', 705749),
(2, 'Paryż', 'FRA', 2148327),
(3, 'Tokio', 'JPN', 13929286),
(4, 'Brasilia', 'BRA', 3015268),
(5, 'Nairobii', 'KEN', 4397072);
