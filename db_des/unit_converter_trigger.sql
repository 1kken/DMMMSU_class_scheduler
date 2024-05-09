DELIMITER //
CREATE TRIGGER insert_unit_counter_trigger
AFTER INSERT ON SCHEDULE
FOR EACH ROW
BEGIN
    DECLARE time_counter INT;
    
    IF NEW.type = 'Lecture' THEN
        SET time_counter = TIMESTAMPDIFF(SECOND, NEW.start_time, NEW.end_time);
        INSERT INTO unit_counter (schedule_id, CODE, lecture_count)
        VALUES (NEW.schedule_id, NEW.code, time_counter / 1800 / 2);
    ELSEIF NEW.type = 'Laboratory' THEN
        SET time_counter = TIMESTAMPDIFF(SECOND, NEW.start_time, NEW.end_time);
        INSERT INTO unit_counter (schedule_id, CODE, laboratory_count)
        VALUES (NEW.schedule_id, NEW.code, time_counter / 1800 / 2 - 1);
    END IF;
END//
DELIMITER;

