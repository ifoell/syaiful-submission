#1
SELECT * FROM employees;

#2
SELECT COUNT(*) jumlah_karyawan_manager FROM employees
WHERE job_title = 'Manager';

#3
SELECT NAME, salary FROM employees
WHERE department IN ('Sales', 'Marketing');

#4
SELECT AVG(salary) FROM employees
WHERE YEAR(joined_date) >= (YEAR(CURRENT_DATE())-5) AND YEAR(joined_date) <= (YEAR(CURRENT_DATE()))
GROUP BY joined_date;

#5
SELECT NAME FROM employees emp
JOIN sales s ON emp.id = s.employee_id
ORDER BY sales DESC
LIMIT 5;

#6
SELECT NAME, salary FROM employees
WHERE salary > (SELECT AVG(salary) FROM employees)

#7
SELECT NAME, SUM(sales) AS total_penjualan, RANK() OVER (
    ORDER BY total_penjualan DESC
) AS rank_no 
FROM employees emp
JOIN sales s ON emp.id = s.employee_id
GROUP BY NAME
ORDER BY rank_no;

#8
DELIMITER //

CREATE PROCEDURE employee_by_department(
    byDepartment VARCHAR(50)
)
BEGIN
    SELECT NAME, salary FROM employees
    WHERE department COLLATE utf8mb4_unicode_ci = byDepartment COLLATE utf8mb4_unicode_ci;
END //

DELIMITER ;

#execute the procedure
CALL employee_by_department("Marketing")